<?php
namespace App\Models;
require_once __DIR__.'/../../public/bootstrap.php';
use App\Core\Database;
use App\Core\App;
use App\Core\Builder\QueryBuilder;
use InvalidArgumentException;

class Restaurant
{
    private $db;
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
        $this->db = App::get()->resolve(Database::class);
    }
    CONST TABLE = 'restaurants';

    public static function beforeSave(string $restaurant): bool
    {
        $db = App::get()->resolve(Database::class);
        $sql = (new QueryBuilder())
            ->select(self::TABLE, ['rest_name'])
                ->where('rest_name', '=', $restaurant)
                    ->get();
        $statement = $db->connection->prepare($sql);
        $statement->execute();
        if (!empty($statement->fetch(\PDO::FETCH_ASSOC))) {
            return true;
        };
        return false;
    }

    public static function create(Restaurant $restaurant)
    {
        $db = App::get()->resolve(Database::class);
        self::beforeSave($restaurant->rest_name);
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
    public static function update(Restaurant $restaurant)
    {
        $db = App::get()->resolve(Database::class);
        $sql = (new QueryBuilder())
            ->where('rest_name', '=', $restaurant->rest_name)
                ->update(self::TABLE, [
                    'rest_name' => $restaurant->rest_name,
                    'rest_email' => $restaurant->rest_email,
                    'rest_cnpj' => $restaurant->rest_cnpj,
                    'res_city' => $restaurant->res_city,
                    'res_neighborhood' => $restaurant->res_neighborhood,
                    'rest_streetName' => $restaurant->rest_streetName,
                    'rest_StreetNumber' => $restaurant->rest_StreetNumber,
                    'res_open' => $restaurant->res_open,
                    'res_close' => $restaurant->res_close
                ])->exec();
        $statement =  $db->connection->prepare($sql);
        $statement->execute();
    }
}