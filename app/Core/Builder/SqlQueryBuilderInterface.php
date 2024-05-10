<?php
namespace App\Core\Builder;

interface SqlQueryBuilderInterface
{
    public function insert(string $table, array $fields, array $values): SqlQueryBuilderInterface;
    public function exec();
}