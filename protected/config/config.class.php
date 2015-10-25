<?php

class Config {

  private $config;

  public function __construct($xmlConfig = 'protected/config/config.xml') {
    $this->loadConfig($xmlConfig);
  }

  public function loadConfig($xmlConfig = 'config.xml') {
    if(file_exists($xmlConfig)) {
      $this->config = simplexml_load_file($xmlConfig);
    } else {
      die('Couldn\'t find configuration: ' . $xmlConfig);
    }
  }

  public function get($key = null) {
    $path = explode('.', $key);
    $key = implode('/', $path);

    if(!empty($key)) {
      $val = $this->config->xpath($key);
      if(is_array($val)) {
        if(count($val) == 1) {
          if(empty(trim((string)$val[0]))) {
            return $val[0];
          }
          return (string)$val[0];
        }
        if(count($val) == 0) {
          return 'No value found';
        }
        return $val;
      }
      if(empty($val)) {
        return 'No key found';
      }
    }

    return $this->config;
  }

}
