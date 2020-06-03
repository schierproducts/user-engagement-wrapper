<?php

namespace Schierproducts\UserEngagementApi\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventInterface;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventQuery;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerQuery;
use Schierproducts\UserEngagementApi\UserEngagementApi;
use Schierproducts\UserEngagementApi\UserEngagementApiServiceProvider;

class ActionEventTest extends TestCase
{
    use WithFaker;

    protected function getPackageProviders($app)
    {
        return [UserEngagementApiServiceProvider::class];
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\ActionEvent\ActionEvent::list
     */
    public function can_receive_list_of_action_events_with_limit()
    {
        $query = new ActionEventQuery(0, 5);
        $response = UserEngagementApi::actionEvent()->list($query);

        $this->assertTrue(count($response) === 5);
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\ActionEvent\ActionEvent::list
     */
    public function can_receive_list_of_action_events_with_type()
    {
        $query = new ActionEventQuery(0, 50, [ 'loggedIn' ]);
        $response = UserEngagementApi::actionEvent()->list($query);
        $event = collect($response)->first();

        $this->assertTrue($event->type === 'Logged in');
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\ActionEvent\ActionEvent::create
     */
    public function can_create_action_event()
    {
        $newActionEvent = new ActionEventInterface([
            'type' => 'loggedIn',
            'description' => 'User has logged in',
            'engineer' => 1,
            'project' => $this->faker->numberBetween(1, 12000),
            'meta' => [ 'foo' => 'bar' ]
        ]);
        $response = UserEngagementApi::actionEvent()->create($newActionEvent);

        $this->assertTrue($response->description === 'User has logged in');
        $this->assertTrue($response->meta->foo === 'bar');
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\ActionEvent\ActionEvent::retrieve
     */
    public function can_get_action_event()
    {
        $response = UserEngagementApi::actionEvent()->retrieve(1);

        $this->assertTrue($response->id === 1);
    }

    /**
     * @test
     * @covers \Schierproducts\UserEngagementApi\ActionEvent\ActionEvent::emailLink
     */
    public function can_get_valid_email_url()
    {
        $newQuery = new EngineerQuery(0, 1);
        $list = UserEngagementApi::engineer()->list($newQuery);
        $firstEngineer = $list[0];
        $email = $firstEngineer->email;
        $url = 'https://greasemonkey.schierproducts.com';
        $emailLink = UserEngagementApi::actionEvent()->emailLink($url, $email);

        $this->assertTrue(strpos($emailLink, "email=".urlencode($email)) !== false);
        $this->assertTrue(strpos($emailLink, "link=".urlencode($url)) !== false);
    }
}
