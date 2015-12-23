<?php  

$helloWorld = function($req, $res, $next) {
    $res = $next($req, $res);
    $res->getBody()->write('<br> HELLO WORLD FROM MIDDLEWARE!');
    return $res;
};

?>