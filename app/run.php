<?php
use Illuminate\Database\Capsule\Manager as DatabaseConnection;
session_start();
require '../vendor/autoload.php';
require 'database.php';

$app = new \Slim\Slim([
  'view' => new \Slim\Views\Twig(),
  'debug' => true
]);
$app->db = function() {
  return new DatabaseConnection;
};
$view = $app->view();
$view->setTemplatesDirectory('../app/views');
$view->parserExtensions = [
  new \Slim\Views\TwigExtension()
];

/** Load Routes */
if(!function_exists('glob_recursive')) {
  function glob_recursive($pattern, $flags = 0) {
    $files = glob($pattern, $flags);
    foreach(glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
      $files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
    }
    return $files;
  }
}
$routes = glob_recursive('../app/routes/*.r.php');
foreach($routes as $route) {
  require $route;
};
