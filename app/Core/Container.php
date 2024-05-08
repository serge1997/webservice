<?php
namespace App\Core;

use Exception;

class Container
{
    protected $bindings = [];

    public function bind($key, $callable)
    {
        $this->bindings[$key] = $callable;
    }

    public function resolve($key)
    {
       if ( ! array_key_exists($key, $this->bindings) ) {
            throw new Exception("Class not found " . $key);
       }
       return call_user_func($this->bindings[$key]);
    }
}