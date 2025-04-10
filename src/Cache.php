<?php

namespace MoredianSDK;

class Cache
{
    protected $client;

    public function __construct()
    {
        $this->client = new \Redis();
        $this->client->connect('192.168.2.5',6379);
        $this->client->auth('xxxx');
    }
    public function getClient(){
        return $this->client;
    }

    /**
     * @param \Redis $client
     */
    public function setClient(\Redis $client): void
    {
        $this->client = $client;
    }
}