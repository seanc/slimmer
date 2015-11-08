<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 11/6/15
 * Time: 6:03 PM
 */
//error_reporting(-1);
//ini_set('display_errors', 'On');
require('protected/app/Application.php');

$app = Application::getInstance();
$app->load();
$app->enableDebug(true);
$app->getApp()->run();