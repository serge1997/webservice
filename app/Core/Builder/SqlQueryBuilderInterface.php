<?php
namespace App\Core\Builder;

interface SqlQueryBuilderInterface
{
    public function select(string $table, ?array $fiels);
    public function where(string $field, $operator, string $value);
    public function insert(string $table, array $fields, array $values): SqlQueryBuilderInterface;
    public function exec();
}