<?php

namespace MoredianSDK;

class Logs
{
    protected $debug;
    protected $path;

    public function __construct(array $config)
    {
        $this->debug = $config['debug'] ? true : false;
        $this->path = $config['path'];
    }

    public function debug($url,$data,$result)
    {


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