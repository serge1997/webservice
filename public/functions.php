<?php
CONST BASE_PATH = './../';

function base_path($path){
    return BASE_PATH. $path;
}

function dd($arg){
    var_dump("<p style='background:#333;color:yellow;padding:18px;'>". $arg . "</p>");
    die();
}

function view($path, $attributes){
    extract($attributes);
    return require_once './../views/'. $path;
}

function isMethod($method)
{
    return $_SERVER['REQUEST_METHOD'] == $method;
}