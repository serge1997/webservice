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
        if (Restaurant::beforeSave($inputs['rest_name'])){
            Restaurant::update($restaurantBuilder);
            echo "Teegz web service: updated successfully";
            return;
        }else{
            Restaurant::create($restaurantBuilder);
            echo "Teegz web service: Created Successfuly";
           return;
        }
    }catch(\Exception $e){
        echo "Web service returned an error: ". $e->getMessage();
        exit();
    }
}

Router::view('dashboard.view.php', [

]);