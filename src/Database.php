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
    public function insert(string $table, array $data): bool
    {
        $columns = array_keys($data);
        $columns_string = implode(',', $columns);
        $values =  array_values($data);
        $value_placeholders = "";

        for ($i = 0; $i < count($values); $i++) {
            if ($i === 0) {
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
    public function select_where(string $table, string $identifier, string $value): array
    {
        $select_query = $this->pdo->prepare("SELECT * FROM $table WHERE $identifier = ?");
        $select_query->execute([$value]);
        $results = $select_query->fetchAll(PDO::FETCH_ASSOC);
        if (isset($results[0])) {
            return $results[0];
        }

        return [];
    }

    //select all results from database
    public function select_all_where(string $table, array $conditions): array
    {
        $query_string = "SELECT * FROM $table";

        $i = 0;
        foreach($conditions as $condition => $value){
            if($i === 0){
                $query_string .= " WHERE $condition = ?";
            } else {
                $query_string .= " AND $condition = ?";
            }

            $i++;
        }


        $values = array_values($conditions);

        $select_query = $this->pdo->prepare($query_string);
        $select_query->execute($values);
        $results = $select_query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //select all from database
    public function select_all(string $table, string $sort_by = "", string $order = ""): array
    {
        $query_string = "SELECT * FROM $table";
        if ($sort_by !== "") {
            $query_string .= " ORDER BY $sort_by";
        }
        if ($order !== "") {
            $order = strtoupper($order);
            $query_string .= " $order";
        }

        $select_query = $this->pdo->prepare($query_string);
        $select_query->execute();
        $results = $select_query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function select_limit(string $table, int $limit, string $sort_by = "id", string $order = "DESC"): array
    {
        $select_query = $this->pdo->prepare("SELECT * FROM $table ORDER BY $sort_by $order LIMIT :limit");
        $select_query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $select_query->execute();
        $results = $select_query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    //update database row
    public function update_where(string $table, array $data, string $identifier, string $value): bool
    {
        $update_keys = array_keys($data);
        $update_values = array_values($data);

        $update_string = "";
        $i = 0;

        foreach ($update_keys as $key) {
            if ($i === 0) {
                $update_string .= "$key = ?";
            } else {
                $update_string .= ", $key = ?";
            }

            $i++;
        }

        $query_string = "UPDATE $table SET $update_string WHERE $identifier = ?";
        var_dump($query_string);
        $update_query = $this->pdo->prepare($query_string);
        return $update_query->execute([...$update_values,$value]);
    }

    public function delete_where(string $table, string $identifier, string $value): bool
    {
        $delete_query = $this->pdo->prepare("DELETE FROM $table WHERE $identifier = ?");
        return $delete_query->execute([$value]);
    }
}
