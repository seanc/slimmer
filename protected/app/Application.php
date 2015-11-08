<?php

/**
 * Created by PhpStorm.
 * User: sean
 * Date: 11/6/15
 * Time: 5:21 PM
 */

use \Slim;

class Application
{

    private static $instance;

    private $app;
    private $config;
    private $slim_config = array();

    public static function getInstance() {
        if(null == static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    protected function __construct() {}

    public function load() {
        session_start();

        $this->loadDepedencies();

        $this->slim_config = array(
          'view' => new \Slim\Views\Twig()
        );
        $this->app = new \Slim\Slim($this->slim_config);

        $view = $this->app->view();
        $view->setTemplatesDirectory('protected/views');
        $view->parserExtensions = array(
          new Slim\Views\TwigExtension()
        );

        $this->app->config = new Config();
        $this->app->config->loadConfig();

        $this->app->db = Database::getInstance();
        $this->app->db->connect(array(
            'host' => $this->app->config->get('db')['host'],
            'name' => $this->app->config->get('db')['name']
        ), $this->app->config->get('db')['user'], $this->app->config->get('db')['pass']);

        $this->config = $this->app->config;

        $this->loadControllers();
    }

    private function loadDepedencies() {
        require('vendor/autoload.php');
        require('protected/config/Config.php');
        require('protected/helpers/Database.php');
    }

    private function loadControllers() {
        $app = $this->app;
        $controllers = $this->glob_recursive('protected/controllers/*.php');
        foreach($controllers as $controller) {
            require($controller);
        }
    }

    private function glob_recursive($pattern, $flags = 0) {
        $files = glob($pattern, $flags);
        foreach(glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
            $files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
        }
        return $files;
    }

    public function enableDebug($bool) {
        $this->slim_config['debug'] = $bool;
    }

    public function getApp() {
        return $this->app;
    }

    public function getConfig() {
        return $this->config;
    }

}