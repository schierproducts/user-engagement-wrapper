<?php


namespace Schierproducts\UserEngagementApi\Engineer;


use Schierproducts\UserEngagementApi\Exceptions\InvalidEndpoint;
use Schierproducts\UserEngagementApi\Exceptions\InvalidKey;
use Schierproducts\UserEngagementApi\Exceptions\InvalidValue;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerInterface;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerQuery;
use Schierproducts\UserEngagementApi\Interfaces\Engineer\EngineerResult;
use Schierproducts\UserEngagementApi\Interfaces\HandleErrors;
use Schierproducts\UserEngagementApi\Requests\ApiRequest;

class Engineer implements EngineerProvider
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
     * Retrieve a list of engineers based on passed parameters
     *
     * @param EngineerQuery|null $query
     * @return EngineerResult[]
     * @throws InvalidEndpoint|InvalidKey|InvalidValue|\Exception
     */
    public function list(EngineerQuery $query = null)
    {
        if (!$query) {
            $query = new EngineerQuery();
        }

        $response = $this->request->client
            ->get('/api/v1/engineer', $query->url());

        if ($response->successful()) {
            return collect($response->json()['data'])->map(function($result) {
                return $this->buildResult($result);
            })->toArray();
        }
        $this->parseErrors($response);
    }

    /**
     * Create a new instance of the engineer
     *
     * @param EngineerInterface $engineer
     * @return EngineerResult
     * @throws InvalidEndpoint|InvalidKey|InvalidValue|\Exception
     */
    public function create(EngineerInterface $engineer)
    {
        $response = $this->request->client
            ->post('/api/v1/engineer', $engineer->toArray());

        if ($response->successful()) {
            $body = $response->json();
            return $this->buildResult($body);
        }
        $this->parseErrors($response);
    }

    /**
     * Retrieves an engineer by ID
     *
     * @param int $id
     * @return EngineerResult
     * @throws InvalidEndpoint|InvalidKey|InvalidValue|\Exception
     */
    public function retrieve(int $id)
    {
        $response = $this->request->client
            ->get('/api/v1/engineer/'.$id);

        if ($response->successful()) {
            $body = $response->json();
            return $this->buildResult($body);
        }
        $this->parseErrors($response);
    }

    /**
     * Updates an existing engineer
     *
     * @param EngineerInterface $engineer
     * @param int|null $id
     * @return EngineerResult
     * @throws InvalidEndpoint|InvalidKey|InvalidValue|\Exception
     */
    public function update(EngineerInterface $engineer, $id = null)
    {
        if ($id) {
            $response = $this->request->client
                ->put('/api/v1/engineer/'.$id, $engineer->toArray());
        } else {
            $response = $this->request->client
                ->put('/api/v1/engineer', $engineer->toArray());
        }

        if ($response->successful()) {
            $body = $response->json();
            return $this->buildResult($body);
        } else {
            $this->parseErrors($response);
        }
    }

    /**
     * Deletes an engineer
     *
     * @param int $id
     * @param string|null $email
     * @return bool
     * @throws InvalidEndpoint|InvalidKey|InvalidValue|\Exception
     */
    public function destroy(int $id = null, string $email = null) : bool
    {
        if ($id) {
            $response = $this->request->client
                ->delete('/api/v1/engineer/'.$id);
        } else {
            $response = $this->request->client
                ->delete('/api/v1/engineer', [
                    'email' => $email
                ]);
        }

        if ($response->successful()) {
            return true;
        } else {
            $this->parseErrors($response);
        }
    }

    /**
     * @param array $result
     * @return EngineerResult
     */
    private function buildResult(array $result)
    {
        return new EngineerResult(
            $result['id'],
            $result['first_name'],
            $result['last_name'],
            $result['email'],
            $result['registered'],
            $result['type'],
            $result['phone_number'],
            $result['company'],
            $result['postal_code'],
            $result['deleted']
        );
    }
}
