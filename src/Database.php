<?php

namespace nimbus;

use PDO;
use PDOException;

final class Database
{
    public $pdo;

    public function __construct()
    {

        try {
            $this->pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo $exception;
        }
    }

    //select the first result in database
    public function select_where (string $table, string $identifier, string $value)
    {
        $select_query = $this->pdo->prepare("SELECT * FROM $table WHERE $identifier = ?");
        $select_query->execute([$value]);
        $results = $select_query->fetchAll(PDO::FETCH_ASSOC);
        $single_result = $results[0];
        return $single_result;
    }

    //select all results from database
    public function select_all_where (string $table, string $identifier, string $value) : array
    {
        $select_query = $this->pdo->prepare("SELECT * FROM $table WHERE $identifier = ?");
        $select_query->execute([$value]);
        $results = $select_query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //select all from database
    public function select_all ($table) : array
    {
        $select_query = $this->pdo->prepare("SELECT * FROM $table");
        $select_query->execute();
        $results = $select_query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
