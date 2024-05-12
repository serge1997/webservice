<?php
namespace App\Core\Builder;

use mysqli_sql_exception;
use stdClass;

use function PHPSTORM_META\type;

class QueryBuilder implements SqlQueryBuilderInterface
{
    protected $query;
    public function __construct()
    {
        $this->query = new stdClass();
    }

    public function select(string $table, ?array $fields = [])
    {
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
        $this->query->where[] = " {$field} {$operator} '{$value}'";
        return $this;
       
    }

    public function orWhere(string $field, $operator, string $value)
    {
        $this->query->orWhere[] = "{$field} {$operator} '{$value}'";
        return $this;
    }

    public function update(string $table, array $fieldsValues)
    {
        $this->query->type = "update";
        $setSynthax = array_combine(array_keys($fieldsValues), array_values($fieldsValues));
        $set = function() use ($setSynthax){
            $up = "";
            foreach ($setSynthax as $key => $value) {
                $up .= "{$key} = '{$value}',";
            }
            return $up;
        };
        $this->query->update = "UPDATE {$table} SET ". $set();
        return $this;

    }

    public function insert(string $table, array $fields, array $values): SqlQueryBuilderInterface
    {
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
        if (empty($this->query->where) && !empty($this->query->orWhere)){
            throw new mysqli_sql_exception("Mysql erro: orWhere mthod need where close firstly");
        }
        if ($this->query->type == "select"){
            $sql .= $this->query->select;
            if (!empty($this->query->where)){
                $sql .= " WHERE ". implode(" AND ", $this->query->where);
            }

            if (!empty($this->query->orWhere)) {
                $sql .= " OR ". implode(', OR ', $this->query->orWhere);
            }
        }
        return $sql;
    }
}