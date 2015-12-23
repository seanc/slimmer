<?php

$app->get('/', function($req, $res, $args) {
    $this->view->render($res, 'base.twig');
    //return $this->view->render($res, 'base.twig');
})->add($helloWorld);

?>
