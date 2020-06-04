<?php


namespace Schierproducts\UserEngagementApi\ActionEvent;


use Schierproducts\UserEngagementApi\Exceptions\InvalidEndpoint;
use Schierproducts\UserEngagementApi\Exceptions\InvalidKey;
use Schierproducts\UserEngagementApi\Exceptions\InvalidValue;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventInterface;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventQuery;
use Schierproducts\UserEngagementApi\Interfaces\ActionEvent\ActionEventResult;
use Schierproducts\UserEngagementApi\Interfaces\HandleErrors;
use Schierproducts\UserEngagementApi\Requests\ApiRequest;

class ActionEvent implements ActionEventProvider
{
    use HandleErrors;

    /**
     * @var ApiRequest
     */
    protected $request;

    public function __construct()
    {
        $this->request = new ApiRequest;
    }

    /**
     * Retrieve a list of action events based on passed parameters
     *
     * @param ActionEventQuery $query
     * @return ActionEventResult[]
     * @throws InvalidEndpoint
     * @throws InvalidKey|InvalidValue|\Exception
     */
    public function list(ActionEventQuery $query)
    {
        $response = $this->request->client
            ->get('/api/v1/action-event', $query->url());

        if ($response->successful()) {
            return collect($response->json()['data'])->map(function($result) {
                return $this->buildResult($result);
            })->toArray();
        } else {
            $this->parseErrors($response);
        }
    }

    /**
     * Create a new instance of the action event
     *
     * @param ActionEventInterface $actionEvent
     * @return ActionEventResult|void
     * @throws InvalidEndpoint
     * @throws InvalidKey
     * @throws InvalidValue
     */
    public function create(ActionEventInterface $actionEvent)
    {
        if (!config('user-engagement-api.log_events')) {
            return;
        }

        $response = $this->request->client
            ->post('/api/v1/action-event', $actionEvent->toArray());

        if ($response->successful()) {
            $body = $response->json();
            return $this->buildResult($body);
        } else {
            $this->parseErrors($response);
        }
    }

    /**
     * Retrieves an action event by ID
     *
     * @param int $id
     * @return ActionEventResult
     * @throws InvalidEndpoint
     * @throws InvalidKey
     * @throws InvalidValue
     */
    public function retrieve(int $id)
    {
        $response = $this->request->client
            ->get('/api/v1/action-event/'.$id);

        if ($response->successful()) {
            $body = $response->json();
            return $this->buildResult($body);
        } else {
            $this->parseErrors($response);
        }
    }

    /**
     * @inheritDoc
     */
    public function link(string $url, string $email, string $type = 'email')
    {
        $baseUrl = config('user-engagement-api.base_url');
        if (empty($baseUrl)) {
            throw new InvalidEndpoint;
        }

        return "$baseUrl?email=".urlencode($email)."&link=".urlencode($url)."&type=".urlencode($type);
    }

    /**
     * @param array $result
     * @return ActionEventResult
     */
    private function buildResult(array $result)
    {
        return new ActionEventResult(
            $result['id'],
            $result['type'],
            $result['description'],
            $result['created'],
            $result['meta'],
            $result['project'],
            $result['engineer'],
        );
    }
}
