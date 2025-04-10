<?php

namespace MoredianSDK;

class Config
{
    protected $appKey;
    protected $appId;
    protected $orgId;
    protected $orgAuthKey;

    public function __construct($config)
    {
        $this->appId = $config['appId'];
        $this->appKey = $config['appKey'];
        $this->orgId = $config['orgId'];
        $this->orgAuthKey = $config['orgAuthKey'];
    }


    public function getAppKey()
    {
        return $this->appKey;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function getOrgId()
    {
        return $this->orgId;
    }

    /**
     * @return mixed
     */
    public function getOrgAuthKey()
    {
        return $this->orgAuthKey;
    }

}