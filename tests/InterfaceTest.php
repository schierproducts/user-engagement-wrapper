<?php

namespace Schierproducts\UserEngagementApi\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventInterface;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerInterface;
use Schierproducts\UserEngagementApi\UserEngagementApiServiceProvider;

class InterfaceTest extends TestCase
{
    use WithFaker;

    protected function getPackageProviders($app)
    {
        return [UserEngagementApiServiceProvider::class];
    }

    /**
     * @test
     */
    public function action_event_interface_created_with_array()
    {
        $library = new ActionEventInterface([]);
        $types = $library->availableTypes();

        $type = $types[$this->faker->numberBetween(0, count($types) - 1)];
        $description = $this->faker->words(5, true);
        $project = $this->faker->numberBetween(1, 20000);
        $engineer = $this->faker->numberBetween(1, 20000);
        $meta = [
            'city' => $this->faker->city
        ];

        $interface = new ActionEventInterface([
            'type' => $type,
            'description' => $description,
            'project' => $project,
            'engineer' => $engineer,
            'meta' => $meta
        ]);

        $this->assertTrue($interface->type === $type);
        $this->assertTrue($interface->description === $description);
        $this->assertTrue($interface->project === $project);
        $this->assertTrue($interface->engineer === $engineer);
        $this->assertTrue($interface->meta === json_encode($meta));
    }

    /**
     * @test
     */
    public function action_event_interface_created_with_properties()
    {
        $library = new ActionEventInterface([]);
        $types = $library->availableTypes();

        $type = $types[$this->faker->numberBetween(0, count($types) - 1)];
        $description = $this->faker->words(5, true);
        $project = $this->faker->numberBetween(1, 20000);
        $engineer = $this->faker->numberBetween(1, 20000);
        $meta = [
            'city' => $this->faker->city
        ];

        $interface = new ActionEventInterface($type, $description, $project, $engineer, $meta);

        $this->assertTrue($interface->type === $type);
        $this->assertTrue($interface->description === $description);
        $this->assertTrue($interface->project === $project);
        $this->assertTrue($interface->engineer === $engineer);
        $this->assertTrue($interface->meta === json_encode($meta));
    }

    /**
     * @test
     */
    public function engineer_interface_created_with_array()
    {
        $library = new ActionEventInterface([]);
        $types = $library->availableTypes();

        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $email = $this->faker->email;
        $registered = $this->faker->unixTime;
        $phone = $this->faker->phoneNumber;
        $company = $this->faker->company;
        $postal_code = $this->faker->postcode;
        $type = [
            $this->faker->numberBetween(0, count($types) - 1),
            $this->faker->numberBetween(0, count($types) - 1)
        ];

        $interface = new EngineerInterface([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'registered' => $registered,
            'phone_number' => $phone,
            'company' => $company,
            'postal_code' => $postal_code,
            'type' => $type
        ]);

        $this->assertTrue($interface->first_name === $firstName);
        $this->assertTrue($interface->last_name === $lastName);
        $this->assertTrue($interface->email === $email);
        $this->assertTrue($interface->registered === $registered);
        $this->assertTrue($interface->phone_number === $phone);
        $this->assertTrue($interface->company === $company);
        $this->assertTrue($interface->postal_code === $postal_code);
        $this->assertTrue($interface->type === $type);
    }
}
