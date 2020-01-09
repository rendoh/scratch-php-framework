<?php

require '../bootstrap.php';

use core\Router;
use core\Request;

$request = new Request();

$router = new Router([
  '/users' => ['controller' => 'foo'],
  '/users/detail' => ['controller' => 'foo'],
  '/users/detail/:id' => ['controller' => 'foo'],
]);

$result = $router->resolve($request->getPathInfo());
var_dump($result);
