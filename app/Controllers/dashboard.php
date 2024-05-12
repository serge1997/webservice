<?php
use Router\Router;
use App\Models\Restaurant;
use App\Core\ModelsBuilder\RestaurantBuilder;
use GuzzleHttp\Client;
use App\Core\Builder\QueryBuilder;

$select = (new QueryBuilder())
    ->select("users", ['name', 'email'])
        ->where('name', '=', 'serge')
            ->where('name', '=', 'serge')
                ->get();

 var_dump($select);
if (isMethod('POST')) {
    $inputApi = file_get_contents("php://input");
    $inputs = json_decode($inputApi, true);
    $restaurantBuilder = (new RestaurantBuilder(
        $inputs['rest_name'],
        $inputs['rest_email'],
        $inputs['rest_cnpj'],
        $inputs['res_city'],
        $inputs['res_neighborhood'],
        $inputs['rest_streetName'],
        $inputs['rest_StreetNumber'],
        $inputs['res_open'],
        $inputs['res_close'],
    ))->build();
    Restaurant::create($restaurantBuilder);
    echo "Web service done successfully";
    exit();
}

Router::view('dashboard.view.php', [

]);