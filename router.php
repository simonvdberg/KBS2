<?php

if (isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) {
    $action = explode("/", $_SERVER['PATH_INFO']);
    $method = array_pop($action);
    $className = implode("\\", $action);
    $class = new $className();
//    exit($className . ' ' . $method);
  $t = $class->$method();
  exit();
}

