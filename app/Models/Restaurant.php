<?php
namespace App\Models;
use App\Core\Database;

class Restaurant
{
    protected $db;
    public function __construct(
    )
    {
        $this->db = new Database();
    }
    CONST TABLE = 'restaurants';

    public function create()
    {
        $sql = "INSERT INTO restaurants (rest_name) VALUES('casino bar')";
        $statement = $this->db->connection->prepare($sql);
        $statement->execute();
    }
}