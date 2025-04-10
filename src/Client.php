<?php

namespace MoredianSDK;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RedirectMiddleware;

class Client
{


    protected $client;

    public function __construct()
    {

        $this->client = new GuzzleClient([
            'base_uri' => 'https://oapi.moredian.com',
            'timeout' => 10.0,
            'http_errors' => false,
            'decode_content' => true,
            'verify' => false,
            'cookies' => false,
            'idn_conversion' => false,
        ]);

        return $this->client;
    }

    /**
     * @return GuzzleClient
     */
    public function getClient()
    {
        return $this->client;
    }
}