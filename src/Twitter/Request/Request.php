<?php

namespace App\Twitter\Request;

use App\Twitter\Request\Connection;

/**
 * Simple class for making requests to Twitter
 */
class Request
{
    private $twitterConnection;

    public function __construct(Connection $twitterConnection)
    {
        $this->twitterConnection = $twitterConnection->makeConnection();
    }

    public function getData(string $urlString, array $requestData = null)
    {
        return $this->twitterConnection->get($urlString, $requestData);
    }
}
