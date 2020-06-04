<?php

namespace Model;

use Database\sql;

abstract class Base
{
    protected $mysqli;

    public function __construct()
    {
        $this->mysqli = new sql();
    }
}