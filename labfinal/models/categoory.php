<?php

class Category {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($name, $parent_id){

        $query = "INSERT INTO categories(name, parent_id, created_at)
                  VALUES(:name, :parent_id, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":parent_id", $parent_id);

        return $stmt->execute();
    }

    public function delete($id){

        $check = "SELECT id FROM categories WHERE parent_id=:id";
        $stmt = $this->conn->prepare($check);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return false;
        }

        $query = "DELETE FROM categories WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}
?>