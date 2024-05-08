<?php
use Router\Router;
use App\Models\Restaurant;
use GuzzleHttp\Client;


if (isMethod('POST')) {
    $client = new Client();
    var_dump('Caiu no api');
   return json_encode("Web service done");
}

Router::view('dashboard.view.php', [

]);