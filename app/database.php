<?php
use Illuminate\Database\Capsule\Manager as DatabaseConnection;

$database = new DatabaseConnection;

$database->addConnection([
  'driver' => 'mysql',
  'host' => '127.0.0.1',
  'database' => '${database_name}',
  'username' => '${database_user}',
  'password' => '${database_pass}',
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix' => ''
]);

$database->setAsGlobal();
$database->bootEloquent();