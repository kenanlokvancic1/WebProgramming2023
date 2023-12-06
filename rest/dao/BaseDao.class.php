<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once dirname(__FILE__).'/../Config.class.php';

class BaseDao {
    private $connection;
    private $table;

    public function __construct($table) {
        try {
            $this -> table = $table;
            $hostname = Config::DB_HOST();
            $schema = Config::DB_SCHEMA();
            $username = Config::DB_USERNAME();
            $password = Config::DB_PASSWORD();
            $port = Config::DB_PORT();

            $this -> connection = new PDO("mysql:host=$hostname;port=$port;dbname=$schema", $username, $password);
            $this -> connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            echo "Error: " . $e -> getMessage();
        }
    }

    public function add($entity){
        $query = "INSERT INTO " . $this -> table . " (";
        foreach($entity as $column => $value){
            $query .= $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach($entity as $column => $value){
            $query .= ":" . $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
        
        $statement = $this->connection -> prepare($query);
        $statement -> execute($entity);
        $entity["id"] = $this->connection -> lastInsertId();
        return $entity;
    }

    public function get() {
        $query = $this -> connection -> prepare("SELECT * FROM " . $this -> table);
        $query -> execute();
        return $query -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_by_id($id) {
        $query = $this -> connection -> prepare("SELECT * FROM " . $this -> table . " WHERE id = :id");
        $query -> bindParam(":id", $id);
        $query -> execute();
        return $query -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($entity, $id, $id_column = "id") {
        $query = "UPDATE " . $this -> table . " SET ";
        foreach($entity as $column => $value) {
            $query .= $column . "=:" . $column . ", ";
        }

        $query = substr($query, 0, -2);
        $query .= " WHERE {$id_column} = :id";
        $entity["id"] = $id;
        $statement = $this -> connection -> prepare($query);
        $statement -> execute($entity);
    }

    public function delete($id) {
        $query = $this -> connection -> prepare("DELETE FROM " .$this -> table . " WHERE id = :id");
        $query -> bindParam(":id", $id);
        $query -> execute();
    }
}
?>
?>