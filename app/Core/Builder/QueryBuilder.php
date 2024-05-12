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

    public function select(string $table, ?array $fields = [])
    {
        $this->set();
        $this->query->type = "select";
        $this->query->select = "";
        if ( is_null($fields) ) {
            $this->query->select .= "SELECT * FROM {$table}";
            return $this;
        }
        $this->query->select .= "SELECT ". implode(',', $fields) . " FROM {$table}";
        return $this;
    }

    public function where(string $field, $operator, string $value)
    {
        //$this->set();
        //$this->query->type = "select";
        if ( $this->query->type == "select" ) {
            if ( ! str_contains($this->query->select, "WHERE" ) ) {
                $this->query->select .= " WHERE ". $field . $operator . "'$value'";
                return $this;
            }else{
                $this->query->select .= " AND {$field} {$operator} '{$value}'";
                return $this;
            }
        }
    }

    public function insert(string $table, array $fields, array $values): SqlQueryBuilderInterface
    {
        $this->set();
        $this->query->type = "insert";
        $this->query->insert = "INSERT INTO $table(" . implode(",",  $fields) .") VALUES(". "'" . implode("','", $values) . "'" . ")";

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

    public function get()
    {
        $sql = "";
        return $sql .= $this->query->select;
        
    }
}