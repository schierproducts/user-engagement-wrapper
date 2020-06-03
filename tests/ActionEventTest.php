<?php

namespace Schierproducts\UserEngagementApi\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventInterface;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventQuery;
use Schierproducts\UserEngagementApi\UserEngagementApi;
use Schierproducts\UserEngagementApi\UserEngagementApiServiceProvider;

class ActionEventTest extends TestCase
{
    use WithFaker;

    protected function getPackageProviders($app)
    {
        return [UserEngagementApiServiceProvider::class];
    }

    /** @test */
    public function can_receive_list_of_action_events_with_limit()
    {
        $instance = new UserEngagementApi;

        $query = new ActionEventQuery(0, 5);
        $response = $instance->actionEvent->list($query);

        $this->assertTrue(count($response) === 5);
    }

    /** @test */
    public function can_receive_list_of_action_events_with_type()
    {
        $instance = new UserEngagementApi;

        $query = new ActionEventQuery(0, 50, [ 'loggedIn' ]);
        $response = $instance->actionEvent->list($query);
        $event = collect($response)->first();

        $this->assertTrue($event['type'] === 'Logged in');
    }

    /** @test */
    public function can_create_action_event()
    {
        $instance = new UserEngagementApi;

        $newActionEvent = new ActionEventInterface([
            'type' => 'loggedIn',
            'description' => 'User has logged in',
            'engineer' => 1,
            'project' => $this->faker->numberBetween(1, 12000),
            'meta' => [ 'foo' => 'bar' ]
        ]);
        $response = $instance->actionEvent->create($newActionEvent);

        $this->assertTrue($response['description'] === 'User has logged in');
        $this->assertTrue($response['meta'] === json_encode([ 'foo' => 'bar' ]));
    }

    /** @test */
    public function can_get_action_event()
    {
        $instance = new UserEngagementApi;
        $response = $instance->actionEvent->retrieve(1);

        $this->assertTrue($response['id'] === 1);
    }
}
