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

    //insert new row in database
    public function insert(string $table,array $data) : bool
    {
        $columns = array_keys($data);
        $columns_string = implode(',',$columns);
        $values =  array_values($data);
        $value_placeholders = "";

        for($i=0;$i<count($values);$i++){
            if($i===0){
                $value_placeholders .= "?";
            } else {
                $value_placeholders .= ",?";
            }
        }

        $query_string = "INSERT INTO $table ($columns_string) values ($value_placeholders)";
        $insert_query = $this->pdo->prepare($query_string);
        return $insert_query->execute($values);

    }

    //select the first result in database
    public function select_where (string $table, string $identifier, string $value) : array
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
    public function select_all (string $table, string $sort_by = "" ,string $order = "") : array
    {
        $query_string = "SELECT * FROM $table";
        if($sort_by!==""){
            $query_string .= " ORDER BY $sort_by";
        }
        if($order!==""){
            $order = strtoupper($order);
            $query_string .= " $order";
        }

        $select_query = $this->pdo->prepare($query_string);
        $select_query->execute();
        $results = $select_query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //update database row
    public function update_where (string $table, array $data, string $identifier, string $value) : bool 
    {
        $update_string = "";
        $i = 0;
        foreach($data as $update_key => $update_value){
            if($i===0){
                $update_string .= "$update_key = '$update_value'";
            } else {
                $update_string .= ", $update_key = '$update_value'";
            }
            $i++;
        }

        $query_string ="UPDATE $table SET $update_string WHERE $identifier = $value";
        $update_query = $this->pdo->prepare($query_string);
        return $update_query->execute();
    }
}
