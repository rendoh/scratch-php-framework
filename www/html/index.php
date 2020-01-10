<?php

require '../bootstrap.php';

use core\Router;
use core\Request;
use core\Response;

$request = new Request();

$router = new Router([
  '/users' => ['controller' => 'foo'],
  '/users/detail' => ['controller' => 'foo'],
  '/users/detail/:id' => ['controller' => 'foo'],
]);

$result = $router->resolve($request->getPathInfo());
$response = new Response();

$response->setContent($result);
$response->send();
