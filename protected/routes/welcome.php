<?php

$app->get('/', function() use ($app) {
   $app->render('base.twig');
});

?>
