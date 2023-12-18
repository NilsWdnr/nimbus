<?php

//this class should be used to extend all models

namespace nimbus;

use nimbus\Database;

abstract class Model {
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

}