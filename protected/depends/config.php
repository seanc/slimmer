<?php

use Gorka\DotNotationAccess\DotNotationAccessArray;

function config($path, $default = null) {
   $path = explode('.', $path);
   $file = $path[0];
   $path = join('.', array_slice($path, 1));
   $config = require '../protected/config/' . $file . '.php';
   $dotaccess = new DotNotationAccessArray($config);
   if(is_null($default) && empty($dotaccess->get($path))) {
      return $default;
   } else {
      return $dotaccess->get($path);
   }
}

?>
