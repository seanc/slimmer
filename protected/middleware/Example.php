<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 11/7/15
 * Time: 8:25 PM
 */

// Can access the Application object with $this->app
$helloWorld = function() {
    echo $this->app->config->get('greeting') . "<br>";
};