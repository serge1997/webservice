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
        private string $rest_city,
        private string $rest_neighborhood,
        private string $rest_cep,
        private string $rest_streetName,
        private string $rest_streetNumber,
        private ?string $rest_logo,
        private ?string $res_open,
        private ?string $res_close,
        private string $longitude,
        private string $latitude,
        private string $created_at,
        private string $updated_at
    )
    {
        static::$db = App::get()->resolve(Database::class);
    }
    CONST TABLE = 'restaurants';

    public static function create()
    {
        $db = App::get()->resolve(Database::class);
        $sql = (new QueryBuilder())
            ->insert(self::TABLE, 
                [
                    'rest_name', 
                    'rest_email'
                ], 
                [
                    'casino bar',
                    'builder@.com'
                ]
                )->exec();
        dd($sql);
        $statement =  $db->connection->prepare($sql);
        $statement->execute();
    }
}