<?php


namespace Schierproducts\UserEngagementApi\Interfaces;


use Illuminate\Http\Client\Response;
use Schierproducts\UserEngagementApi\Exceptions\InvalidEndpoint;
use Schierproducts\UserEngagementApi\Exceptions\InvalidKey;
use Schierproducts\UserEngagementApi\Exceptions\InvalidValue;

trait HandleErrors
{
    /**
     * @param Response $response
     * @throws \Exception
     * @throws InvalidEndpoint
     * @throws InvalidKey
     * @throws InvalidValue
     */
    protected function parseErrors(Response $response)
    {
        $status = $response->status();
        switch ($status) {
            case 400:
                throw new \Exception('We were not able to handle your request.', 400);
            case 401:
            case 403:
                throw InvalidKey::key();
            case 404:
                throw InvalidEndpoint::notFound();
            case 422:
                throw InvalidValue::validation($response->json());
        }
    }
}
