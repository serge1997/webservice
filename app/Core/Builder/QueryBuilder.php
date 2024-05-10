<?php
namespace App\Core\Builder;

use stdClass;

class QueryBuilder implements SqlQueryBuilderInterface
{
    protected $query;


    public function set()
    {
        $this->query = new stdClass();
    }
    public function insert(string $table, array $fields, array $values): SqlQueryBuilderInterface
    {
        $this->set();
        $this->query->type = "insert";
        $this->query->insert = "INSERT INTO $table(". implode(",",  $fields) .") VALUES(". implode(", ", $values) . ")";

        return $this;
    }

    public function exec()
    {
        $sql = "";
        if ($this->query->type == "insert")
        {
            $sql .= $this->query->insert;
            return $sql;
        }
    }
}