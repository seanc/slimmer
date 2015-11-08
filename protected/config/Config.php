<?php

/**
 * Created by PhpStorm.
 * User: sean
 * Date: 11/6/15
 * Time: 6:51 PM
 */
class Config
{

    private $config;

    public function loadConfig($path = 'protected/config/config.json') {
        if(!file_exists($path)) {
            echo 'Unable to get config file ' . $path;
            return;
        }

        $file = file_get_contents($path);
        $json = json_decode($file, true);
        $this->config = $json;
    }

    public function get($key = null) {
        if(is_null($key)) {
            return $this->config;
        }
        $token = explode('.', $key);
        $config = $this->config;
        $value = null;

        foreach($token as $item) {
            if(isset($config[$item])) {
                $value = $config[$item];
            } else {
                $value = 'Unable to get ' . $key;
            }
        }

        return $value;
    }


}