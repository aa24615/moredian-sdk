<?php

namespace MoredianSDK;


class MoredianSDK
{

    protected $config;

    protected $cache;

    /*
     * @var MoredianClient
     */
    protected $client;

    public function __construct(array $config)
    {
        $this->config = new Config($config);
        $this->client = new Client();
        $this->cache = new Cache();
        $this->appToken();
    }


    public function getClient()
    {
        return $this->client->getClient();
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function setCache($cache)
    {
        $this->cache = $cache;
    }


    public function getCache()
    {
        return $this->cache->getClient();
    }

    public function postJson($url,array $data): array
    {

        $url = $url.'?accessToken='.$this->accessToken();
        
        $result = $this->getClient()->post($url, [
            'json' => $data,
        ]);

        $result = json_decode($result->getBody()->getContents(), true);

        return $result;
    }

    public function get($url,array $data): array
    {
        $result = $this->getClient()->get($url, [
            'query' => $data,
        ]);

        $result = json_decode($result->getBody()->getContents(), true);

        return $result;
    }


    public function appToken(){

        $key = 'MoredianSDK:appToken:'.$this->config->getAppId();
        $cache = $this->getCache();
        if($appToken = $cache->get($key)){
            return $appToken;
        }

        $data = [
            'appId' => $this->config->getAppId(),
            'appKey' => $this->config->getAppKey(),
        ];

        $result = $this->get('/app/getAppToken', $data);

        if($result['result']!=0){
            throw new \Exception('操作失败:' .$result['message']);
        }

        $appToken = $result['data']['appToken'];

        $cache->set($key,$appToken,7200);

        return $appToken;
    }


    public function accessToken(){

        $key = 'MoredianSDK:accessToken:'.$this->config->getOrgId();
        $cache = $this->getCache();
        if($accessToken = $cache->get($key)){
            return $accessToken;
        }

        $data = [
            'appToken' => $this->appToken(),
            'orgId' => $this->config->getOrgId(),
            'orgAuthKey' => $this->config->getOrgAuthKey(),
        ];

        $result = $this->get('/app/getOrgAccessToken', $data);

        if($result['result']!=0){
            throw new \Exception('操作失败:' .$result['message']);
        }

        $accessToken = $result['data']['accessToken'];

        $cache->set($key,$accessToken,7200);

        return $accessToken;

    }
}