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
        private string $res_neighborhood,
        private string $rest_streetName,
        private string $rest_StreetNumber,
        private ?string $res_open,
        private ?string $res_close,
    )
    {
        static::$db = App::get()->resolve(Database::class);
    }
    CONST TABLE = 'restaurants';

    public function beforeSave(string $restaurant)
    {

    }
    
    public static function create(Restaurant $restaurant)
    {
        $db = App::get()->resolve(Database::class);
        $sql = (new QueryBuilder())
            ->insert(self::TABLE, 
                [
                    'rest_name', 
                    'rest_email',
                    'rest_cnpj',
                    'res_city',
                    'res_neighborhood',
                    'rest_streetName',
                    'rest_StreetNumber',
                    'res_open',
                    'res_close'

                ], 
                [
                    $restaurant->rest_name,
                    $restaurant->rest_email,
                    $restaurant->rest_cnpj,
                    $restaurant->res_city,
                    $restaurant->res_neighborhood,
                    $restaurant->rest_streetName,
                    $restaurant->rest_StreetNumber,
                    $restaurant->res_open,
                    $restaurant->res_close
                ]
                )->exec();
        $statement =  $db->connection->prepare($sql);
        $statement->execute();
    }
}