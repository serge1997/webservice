<?php
namespace App\Models;
require_once __DIR__.'/../../public/bootstrap.php';
use App\Core\Database;
use App\Core\App;
use App\Core\Builder\QueryBuilder;


class Restaurant
{
    protected static $db;
    public function __construct(
        private string $rest_name,
        private string $rest_email,
        private string $rest_cnpj,
        private string $res_city,
        private string $rest_neighborhood,
        private string $rest_streetName,
        private string $rest_StreetNumber,
        private ?string $res_open,
        private ?string $res_close,
    )
    {
        static::$db = App::get()->resolve(Database::class);
    }
    CONST TABLE = 'restaurants';

    public static function create(Restaurant $restaurant)
    {
        $db = App::get()->resolve(Database::class);
        $sql = (new QueryBuilder())
            ->insert(self::TABLE, 
                [
                    'rest_name', 
                    'rest_email',
                    'rest_cnpj',
                    'res_city'
                ], 
                [
                    $restaurant->rest_name,
                    $restaurant->rest_email,
                    $restaurant->rest_cnpj,
                    $restaurant->res_city,
                ]
                )->exec();
       
        $statement =  $db->connection->prepare($sql);
        $statement->execute();
    }
}