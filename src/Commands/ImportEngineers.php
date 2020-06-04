<?php


namespace Schierproducts\UserEngagementApi\Commands;

use Illuminate\Console\Command;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerInterface;
use Schierproducts\UserEngagementApi\UserEngagementApi;

class ImportEngineers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-engagement:import-engineers {model=\App\User : The model to be imported as an engineer.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports each of the passed model and creates an engineer within the Api.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $model = $this->argument('model');
        if (!class_exists($model)) {
            $this->error('The model provided doesn\'t exist.');
        }

        $this->info('Importing list of supplied model "'.$model.'"...');

        $numberOfUsers = $model::count();
        $bar = $this->output->createProgressBar($numberOfUsers);

        try {
            $model::chunk(200, function ($models) use ($bar) {
                foreach ($models as $model) {
                    if (!is_string($model->user_type)) {
                        $type = optional($model->user_type)->value;
                    } else {
                        $type = $model->user_type;
                    }

                    $newEngineer = new EngineerInterface([
                        'first_name' => $model->first_name,
                        'last_name' => $model->last_name,
                        'email' => $model->email,
                        'type' => $type,
                        'phone_number' => $model->phone_number,
                        'company' => $model->company,
                        'postal_code' => $model->postal_code,
                        'registered' => $model->created_at->timestamp
                    ]);
                    UserEngagementApi::engineer()->create($newEngineer);

                    $bar->advance();
                }
            });

            $bar->finish();

            $bar->clear();

            $this->info('The indicated model has been successfully imported.');
        } catch (\Exception $exception) {
            $bar->clear();
            $this->error($exception->getMessage());
        }
    }
}
