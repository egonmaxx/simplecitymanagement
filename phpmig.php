<?php

use Phpmig\Adapter;
use Pimple\Container;
use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

$container = new Container();

$container['db'] = function () {
    $dbh = new PDO('mysql:dbname='.getenv('DATABASE_NAME').';host='.getenv('DATABASE_HOST').';charset='.getenv('DATABASE_CHARSET'), getenv('DATABASE_USER'), getenv('DATABASE_PASSWORD'));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
};

$container['phpmig.adapter'] = function ($c) {
    return new Adapter\PDO\Sql($c['db'], 'migrations');
};

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

return $container;