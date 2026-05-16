<?php
class Brand {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        return $this->conn->query("SELECT * FROM brands");
    }

    public function getById($id){
        $stmt = $this->conn->prepare("SELECT * FROM brands WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $category_id){
        $stmt = $this->conn->prepare("INSERT INTO brands(name, category_id) VALUES(?,?)");
        return $stmt->execute([$name, $category_id]);
    }

    public function update($id, $name, $category_id){
        $stmt = $this->conn->prepare("UPDATE brands SET name=?, category_id=? WHERE id=?");
        return $stmt->execute([$name, $category_id, $id]);
    }

    public function delete($id){

        // check product exists
        $check = $this->conn->prepare("SELECT COUNT(*) FROM products WHERE brand_id=?");
        $check->execute([$id]);

        if($check->fetchColumn() > 0){
            return false;
        }

        $stmt = $this->conn->prepare("DELETE FROM brands WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function getByCategory($category_id){
        $stmt = $this->conn->prepare("SELECT * FROM brands WHERE category_id=?");
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}