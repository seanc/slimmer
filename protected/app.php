<?php

require_once '../vendor/autoload.php';

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/** Create new slim instance */
$app = new \Slim\App(array(
   'debug' => true
));

/** Setup slim views with twig */
$container = $app->getContainer();
$container['view'] = function($c) {
    $view = new \Slim\Views\Twig('../protected/views', array(
        'cache' => '../protected/cache/templates'
    ));
    $view->addExtension(new \Slim\Views\TwigExtension(
        $c['router'],
        $c['request']->getUri()
    ));
    return $view;
};

/** Load dependencies, models & routes */
require_once 'depends/depends.php';
require_once 'models/models.php';
require_once 'middleware/middleware.php';
require_once 'routes/routes.php';

?>
