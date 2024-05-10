<?php
use Router\Router;
use App\Models\Restaurant;
use GuzzleHttp\Client;
use App\Core\Builder\QueryBuilder;

Restaurant::create();
if (isMethod('POST')) {
    Restaurant::create();
    $inputApi = file_get_contents("php://input");
    $inputs = json_decode($inputApi, true);
    var_dump($inputs);
}

Router::view('dashboard.view.php', [

]);