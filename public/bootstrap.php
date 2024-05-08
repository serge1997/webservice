<?php
use App\Core\Container;
use App\Core\App;
use App\Core\Database;

$container = new Container();

$db = $container->bind("App\Core\Database", function() {
    return new Database();
});


App::set($container);