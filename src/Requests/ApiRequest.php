<?php


namespace Schierproducts\UserEngagementApi\Requests;

use Illuminate\Support\Facades\Http;
use Schierproducts\UserEngagementApi\Exceptions\InvalidEndpoint;
use Schierproducts\UserEngagementApi\Exceptions\InvalidKey;

class ApiRequest
{
    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    public $client;

    /**
     * Constructor.
     * @throws InvalidEndpoint
     * @throws InvalidKey
     */
    public function __construct()
    {
        $baseUrl = config('user-engagement-api.base_url');
        if (empty($baseUrl)) {
            throw new InvalidEndpoint;
        }

        $key = config('user-engagement-api.app_key');
        if (empty($key)) {
            throw new InvalidKey;
        }

        $this->client = Http::withHeaders([
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->baseUrl($baseUrl)->withToken($key);
    }
}
