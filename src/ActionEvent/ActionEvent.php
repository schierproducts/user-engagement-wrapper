<?php


namespace Schierproducts\UserEngagementApi\ActionEvent;


use Schierproducts\UserEngagementApi\Exceptions\InvalidEndpoint;
use Schierproducts\UserEngagementApi\Exceptions\InvalidKey;
use Schierproducts\UserEngagementApi\Exceptions\InvalidValue;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventInterface;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventQuery;
use Schierproducts\UserEngagementApi\Interfaces\HandleErrors;
use Schierproducts\UserEngagementApi\Requests\ApiRequest;

class ActionEvent implements ActionEventProvider
{
    use HandleErrors;

    protected $request;

    public function __construct()
    {
        $this->request = new ApiRequest;
    }

    /**
     * Retrieve a list of action events based on passed parameters
     *
     * @param ActionEventQuery $query
     * @throws InvalidEndpoint
     * @throws InvalidKey|InvalidValue|\Exception
     */
    public function list(ActionEventQuery $query)
    {
        $response = $this->request->client
            ->get('/api/v1/action-event', $query->url());

        if ($response->successful()) {
            return $response->json()['data'];
        } else {
            $this->parseErrors($response);
        }
    }

    /**
     * Create a new instance of the action event
     *
     * @param ActionEventInterface $actionEvent
     * @return mixed
     * @throws InvalidEndpoint
     * @throws InvalidKey
     * @throws InvalidValue
     */
    public function create(ActionEventInterface $actionEvent)
    {
        $response = $this->request->client
            ->post('/api/v1/action-event', $actionEvent->toArray());

        if ($response->successful()) {
            return $response->json();
        } else {
            $this->parseErrors($response);
        }
    }

    /**
     * Retrieves an action event by ID
     *
     * @param int $id
     * @return array
     * @throws InvalidEndpoint
     * @throws InvalidKey
     * @throws InvalidValue
     */
    public function retrieve(int $id)
    {
        $response = $this->request->client
            ->get('/api/v1/action-event/'.$id);

        if ($response->successful()) {
            return $response->json();
        } else {
            $this->parseErrors($response);
        }
    }
}
