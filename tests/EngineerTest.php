<?php

namespace Schierproducts\UserEngagementApi\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase;
use Schierproducts\UserEngagementApi\Enums\UserType;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerInterface;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerQuery;
use Schierproducts\UserEngagementApi\UserEngagementApi;
use Schierproducts\UserEngagementApi\UserEngagementApiServiceProvider;

class EngineerTest extends TestCase
{
    use WithFaker;

    protected function getPackageProviders($app)
    {
        return [UserEngagementApiServiceProvider::class];
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\Engineer\Engineer::list
     */
    public function can_receive_list_of_engineers_with_limit()
    {
        $query = new EngineerQuery(0, 5);
        $response = UserEngagementApi::engineer()->list($query);

        $this->assertTrue(count($response) === 5);
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\Engineer\Engineer::create
     */
    public function can_create_engineer()
    {
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $email = $this->faker->safeEmail;
        $type = UserType::getRandomValue();
        $phone = $this->faker->phoneNumber;
        $company = $this->faker->company;
        $post = $this->faker->postcode;
        $registered = $this->faker->unixTime;

        $newEngineer = new EngineerInterface([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'type' => $type,
            'phone_number' => $phone,
            'company' => $company,
            'postal_code' => $post,
            'registered' => $registered
        ]);
        $response = UserEngagementApi::engineer()->create($newEngineer);

        $this->assertTrue($response->first_name === $firstName);
        $this->assertTrue($response->last_name === $lastName);
        $this->assertTrue($response->email === $email);
        $this->assertTrue($response->type === $type);
        $this->assertTrue($response->phone_number === $phone);
        $this->assertTrue($response->company === $company);
        $this->assertTrue($response->postal_code === $post);
        $this->assertTrue($response->registered->timestamp === \Carbon\Carbon::createFromTimestamp($registered)->timestamp);
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\Engineer\Engineer::retrieve
     */
    public function can_get_engineer()
    {
        $response = UserEngagementApi::engineer()->retrieve(1);

        $this->assertTrue($response->id === 1);
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\Engineer\Engineer::update
     */
    public function can_update_engineer()
    {
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $company = $this->faker->company;

        $originalValue = UserEngagementApi::engineer()->retrieve(2);

        $updatedEngineer = new EngineerInterface([
            'first_name' => $originalValue->first_name,
            'last_name' => $originalValue->last_name,
            'email' => $email,
            'phone_number' => $phone,
            'company' => $company,
            'postal_code' => $originalValue->postal_code,
            'type' => $originalValue->type,
        ]);

        $updatedResponse = UserEngagementApi::engineer()->update($updatedEngineer, $originalValue->id);

        $this->assertTrue($updatedResponse->first_name === $originalValue->first_name);
        $this->assertTrue($updatedResponse->email === $email);
        $this->assertTrue($updatedResponse->phone_number === $phone);
        $this->assertTrue($updatedResponse->company === $company);

        // revert it back to allow for future tests
        $updatedEngineer = new EngineerInterface([
            'first_name' => $originalValue->first_name,
            'last_name' => $originalValue->last_name,
            'email' => $originalValue->email,
            'phone_number' => $originalValue->phone_number,
            'company' => $originalValue->company,
            'postal_code' => $originalValue->postal_code,
            'type' => $originalValue->type,
        ]);
        UserEngagementApi::engineer()->update($updatedEngineer, $originalValue->id);
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\Engineer\Engineer::update
     */
    public function can_update_engineer_just_with_email()
    {
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $company = $this->faker->company;

        $originalValue = UserEngagementApi::engineer()->retrieve(2);

        $updatedEngineer = new EngineerInterface([
            'first_name' => $originalValue->first_name,
            'last_name' => $originalValue->last_name,
            'email' => $email,
            'original_email' => $originalValue->email,
            'phone_number' => $phone,
            'company' => $company,
            'postal_code' => $originalValue->postal_code,
            'type' => $originalValue->type,
        ]);

        $updatedResponse = UserEngagementApi::engineer()->update($updatedEngineer);

        $this->assertTrue($updatedResponse->first_name === $originalValue->first_name);
        $this->assertTrue($updatedResponse->email === $email);
        $this->assertTrue($updatedResponse->phone_number === $phone);
        $this->assertTrue($updatedResponse->company === $company);

        // revert it back to allow for future tests
        $updatedEngineer = new EngineerInterface([
            'first_name' => $originalValue->first_name,
            'last_name' => $originalValue->last_name,
            'email' => $originalValue->email,
            'original_email' => $email,
            'phone_number' => $originalValue->phone_number,
            'company' => $originalValue->company,
            'postal_code' => $originalValue->postal_code,
            'type' => $originalValue->type,
        ]);
        UserEngagementApi::engineer()->update($updatedEngineer);
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\Engineer\Engineer::destroy
     */
    public function can_delete_engineer()
    {
        $list =  collect(UserEngagementApi::engineer()->list());
        $lastItem = $list->last();

        $response = UserEngagementApi::engineer()->destroy($lastItem->id);
        $this->assertTrue($response);
    }
}
