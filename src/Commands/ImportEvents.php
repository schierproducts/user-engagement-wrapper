<?php


namespace Schierproducts\UserEngagementApi\Commands;

use Illuminate\Console\Command;
use Schierproducts\UserEngagementApi\Enums\ActionEventType;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventInterface;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerInterface;
use Schierproducts\UserEngagementApi\UserEngagementApi;

class ImportEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-engagement:import-events {table : The table to be pulled in.} {column : The value to grabbed.} {--exists : The indicated column does not have a null value.} {--project : The model provided is a project.} {event : The event to be recorded} {--query=* : The value that you want to searched against.} {--user_model=\App\User : The model that represents the user table} {--user=user_id : The column that references the user id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports a series of events based on the table and associated columns.';

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
        $table = $this->argument('table');
        if (empty($table)) {
            $this->error('Please provide a valid DB table.');
            return;
        }
        $column = $this->argument('column');
        if (empty($column)) {
            $this->error('Please provide a valid DB column.');
            return;
        }
        $event = $this->argument('event');
        if (empty($event) || !ActionEventType::hasValue($event)) {
            $this->error('Please provide a valid event.');
            return;
        }
        $query = $this->option('query');
        $exists = $this->option('exists');
        $userModel = $this->option('user_model');
        $user = $this->option('user');

        $this->info('Importing events...');

        $dbQuery = \Illuminate\Support\Facades\DB::table($table);
        if ($query) {
            $finalQuery = $query[0];
            if ($finalQuery === "true") {
                $finalQuery = 1;
            } elseif ($finalQuery === "false") {
                $finalQuery = 0;
            }
            $dbQuery = $dbQuery->where($column, $finalQuery);
        } elseif ($exists) {
            $dbQuery = $dbQuery->where($column, '<>', null);
        }
        $numberOfResults = $dbQuery->count('id');
        $bar = $this->output->createProgressBar($numberOfResults);

        try {
            $columnsToSelect = ['id', $column];
            if (!in_array($user, $columnsToSelect)) {
                array_push($columnsToSelect, $user);
            }
            $dbQuery->select($columnsToSelect)->orderBy('created_at')->chunk(300, function ($results) use ($bar, $user, $userModel, $event) {
                foreach ($results as $result) {
                    $resultUser = $userModel::find($result->$user);

                    if ($resultUser) {
                        $actionEvent = new ActionEventInterface(
                            $event,
                            ActionEventType::getDescription($event),
                            $this->option('project') ? $result->id : null,
                            null,
                            $resultUser->email,
                            ['via' => 'import']
                        );
                        UserEngagementApi::actionEvent()->create($actionEvent);
                    }

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
