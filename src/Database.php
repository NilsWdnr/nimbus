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
        if(isset($results[0])){
            return $results[0];
        } 
        
        return [];
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
    public function select_all (string $table, string $order = "") : array
    {
        $query_string = "SELECT * FROM $table";
        if($query_string!==""){
            $query_string .= " ORDER BY $order";
        }

        $select_query = $this->pdo->prepare($query_string);
        $select_query->execute();
        $results = $select_query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
