<?php

require 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Pimple\Container;

$container = new Container();

$container['db'] = function () {
    $dbh = new PDO(getenv('DB_DSN'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
};

$container['phpmig.adapter'] = function ($container) {
    return new Phpmig\Adapter\PDO\Sql($container['db'], 'migrations');
};

$container['phpmig.migrations_path'] = __DIR__.DIRECTORY_SEPARATOR.'migrations';

return $container;
