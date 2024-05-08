<?php
namespace App\Core;

use PDOException;

class Database
{
    const txt = "hello";
    public $connection;

    public function __construct()
    {
       try{
            $this->connection = new \PDO("mysql:host=localhost;port=3306;dbname=webservice;user=root;charset=utf8");
       }catch(PDOException $e){
            echo $e->getMessage();
            exit();
       }
    }
}