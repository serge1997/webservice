<?php
use Router\Router;
use App\Models\Restaurant;
use App\Core\ModelsBuilder\RestaurantBuilder;
use GuzzleHttp\Client;
use App\Core\Builder\QueryBuilder;

if (isMethod('POST')) {
    try{
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
        Restaurant::beforeSave($inputs['rest_name']);
        Restaurant::create($restaurantBuilder);
        echo "Web service done successfully";
        exit();
    }catch(\Exception $e){
        echo "(update action) ". $e->getMessage(). "," . $e->getCode();
        exit();
    }
}

Router::view('dashboard.view.php', [

]);