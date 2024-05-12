<?php
namespace App\Core\ModelsBuilder;

use App\Models\Restaurant;

class RestaurantBuilder
{
    public function __construct(
        private string $rest_name,
        private string $rest_email,
        private string $rest_cnpj,
        private string $res_city,
        private string $res_neighborhood,
        private string $rest_streetName,
        private string $rest_streetNumber,
        private ?string $res_open,
        private ?string $res_close
    ){}

    public function build()
    {
        return new Restaurant(
            $this->rest_name,
            $this->rest_email,
            $this->rest_cnpj,
            $this->res_city,
            $this->res_neighborhood,
            $this->rest_streetName,
            $this->rest_streetNumber,
            $this->res_open,
            $this->res_close
        );
    }
}
