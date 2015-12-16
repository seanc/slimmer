<?php

require_once '../vendor/autoload.php';

/** Create new slim instance */
$app = new \Slim\Slim(array(
   'view' => new \Slim\Views\Twig(),
   'debug' => true
));

/** Setup slim views with twig */
$view = $app->view();
$view->setTemplatesDirectory('../protected/views');
$view->parserExtensions = array(
   new \Slim\Views\TwigExtension()
);

/** Load dependencies, models & routes */
require_once 'depends/depends.php';
require_once 'models/models.php';
require_once 'routes/routes.php';

?>
