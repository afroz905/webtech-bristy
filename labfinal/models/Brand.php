<?php

class Brand {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        $query = "SELECT * FROM brands";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($name, $category_id){

        $query = "INSERT INTO brands(name, category_id, created_at)
                  VALUES(:name, :category_id, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":category_id", $category_id);

        return $stmt->execute();
    }

    public function delete($id){

        $query = "DELETE FROM brands WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}
?>