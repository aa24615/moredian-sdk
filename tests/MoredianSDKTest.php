<?php

namespace MoredianSDK\Tests;

use MoredianSDK\MoredianSDK;
use PHPUnit\Framework\TestCase;


class MoredianSDKTest extends TestCase
{

    public $config = [
        'appId' => 'xxx',
        'appKey' => 'xxx',
        'orgId' => 'xxx',
        'orgAuthKey' => 'xxx'
    ];

    public function testAppToken()
    {
        $sdk = new MoredianSDK($this->config);

        $appToken = $sdk->appToken();



        $this->assertTrue(true);
    }
    public function testPost()
    {


        $sdk = new MoredianSDK($this->config);


        $list = $sdk->postJson('/magicube/app/listOrg',[
            'size' => 10,
            'offset' => 0
        ]);

        var_dump($list);


        $this->assertTrue(true);

    }


    public function testDeviceId(){


        $sdk = new MoredianSDK($this->config);

        $accessToken = $sdk->accessToken();


        $data = [
            'accessToken' => $accessToken,
            'deviceSn' => '540219231123KN0053',
        ];

        $result = $sdk->get('/device/deviceId',$data);

        var_dump($result);

    }


    public function testUser(){

        $sdk = new MoredianSDK($this->config);



        $data = [
            'verifyFace' => file_put_contents(''),
            'personType' => ''
        ];


        $result = $sdk->postJson('/magicube/person/create',$data);

    }

//
//    public function testlistOrgAuthKey()
//    {
//
//        $sdk = new MoredianSDK($this->config);
//
//        $data = [
//            'appToken' => $sdk->appToken(),
//            'offset' => 0,
//            'size' =>10,
//            'createEndTime' => (time()-(86400*365))*1000,
//        ];
//        $result = $sdk->get('/oapi/magicube/app/listOrgAuthKey',$data);
//
//        var_dump($result);
//
//        $this->assertTrue(true);
//    }
}