<?php

namespace MoredianSDK;

class Logs
{
    protected $debug = false;
    protected $path = 'moredian.log';

    public function __construct(array $config)
    {
        if(isset($config['debug'])){
            $this->debug = $config['debug'];
        }

        if(isset($config['path'])){
            $this->path = $config['path'];
        }
    }

    public function debug($url,$data,$result)
    {

        $message = 'url: '.$url.PHP_EOL;
        $message .= 'param: '.print_r($data, true).PHP_EOL;
        $message .= 'result: '.print_r($result, true).PHP_EOL;

        $this->info($message);
    }

    public function info($message)
    {
        if ($this->debug) {


            if (is_array($message)) {
                $message = print_r($message, true);
            }

            $date = date('Y-m-d H:i:s');

            $contents = $date . PHP_EOL;
            $contents .= $message . PHP_EOL;

            file_put_contents($contents, $this->path, $message, FILE_APPEND);
        }

    }
}