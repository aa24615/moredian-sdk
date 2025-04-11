<?php

namespace MoredianSDK;

class Cache
{
    protected $client;

    public function __construct(array $config)
    {
        $this->client = new \Redis();
        $this->client->connect($config['host'],$config['port']);
        $this->client->auth($config['password']);
    }

    public function getClient(){
        return $this->client;
    }

}