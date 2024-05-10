<?php
require './../vendor/autoload.php';
require 'functions.php';
require_once 'bootstrap.php';
require base_path('Router/Router.php');
use Router\Router;
use GuzzleHttp\Client;
use App\Core\Database;
use App\Core\App;
use App\Models\Restaurant;


#$header = array("http" => ["Accept" => "application/json", "method" => "GET"]);
#$context = stream_context_create($header);
#$result = file_get_contents('https://selfservice.teegz.com/api/products', false, $context);
#dd($result);

$db = App::get()->resolve(Database::class);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$router = new Router();
$routes = require_once base_path('Router/routes.php');

$router->redirectTo($uri, $method);


