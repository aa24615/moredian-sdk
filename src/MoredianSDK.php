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

        if (isset($config['redis'])) {
            $cache = new Cache($config['redis']);
            $this->setCache($cache->getClient());
        }
    }


    public function getCache()
    {
        return $this->cache;
    }

    public function setCache($cache)
    {
        $this->cache = $cache;
    }

    public function getClient()
    {
        return $this->client->getClient();
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function postJson($url, array $data=[]): array
    {


        $url = $url . '?accessToken=' . $this->accessToken();

        $result = $this->getClient()->post($url, [
            'json' => $data,
        ]);

        $result = json_decode($result->getBody()->getContents(), true);

        return $result;
    }

    public function get($url, array $data = []): array
    {

        $accessToken = $this->accessToken();

        $data = array_merge([
            'accessToken' => $accessToken,
        ], $data);

        $result = $this->getClient()->get($url, [
            'query' => $data,
        ]);

        $result = json_decode($result->getBody()->getContents(), true);

        return $result;
    }



    public function accessToken()
    {

        if (!$this->getCache()) {
            throw new \Exception('请先设置缓存');
        }

        $key = 'MoredianSDK:accessToken:' . $this->config->getOrgId();
        $cache = $this->getCache();
        if ($accessToken = $cache->get($key)) {
            return $accessToken;
        }

        $data = [
            'appToken' => $this->appToken(),
            'orgId' => $this->config->getOrgId(),
            'orgAuthKey' => $this->config->getOrgAuthKey(),
        ];

        $response = $this->getClient()->post('/app/getOrgAccessToken', [
            'query' => $data,
        ]);


        $result = json_decode($response->getBody()->getContents(),true);



        if ($result['result'] != 0) {
            throw new \Exception('操作失败:' . $result['message']);
        }

        $accessToken = $result['data']['accessToken'];

        $cache->set($key, $accessToken);
        $cache->expire($key, 7200);

        return $accessToken;

    }




    public function appToken()
    {

        if (!$cache = $this->getCache()) {
            throw new \Exception('请先设置缓存');
        }

        $key = 'MoredianSDK:appToken:' . $this->config->getAppId();
        if ($appToken = $cache->get($key)) {
            return $appToken;
        }

        $data = [
            'appId' => $this->config->getAppId(),
            'appKey' => $this->config->getAppKey(),
        ];

        $response = $this->getClient()->get('/app/getAppToken', [
            'query' => $data,
        ]);


        $result = json_decode($response->getBody()->getContents(),true);

        if ($result['result'] != 0) {
            throw new \Exception('操作失败:' . $result['message']);
        }

        $appToken = $result['data']['appToken'];

        $cache->set($key, $appToken);
        $cache->expire($key, 7200);


        return $appToken;
    }
}