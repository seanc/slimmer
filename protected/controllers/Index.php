<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 11/6/15
 * Time: 6:04 PM
 */

require('protected/middleware/Example.php');
require('protected/models/User.php');


//Example Route
$app->get('/', $helloWorld, function() use ($app) {

    $user = new User($app->db);
    echo "Database Debug - <br>";
    print_r($user->getUsers());

    $app->render('index.twig', array(
        'message' => 'Hello World from a Template!'
    ));

});