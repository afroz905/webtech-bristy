<?php
class Category {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        return $this->conn->query("SELECT * FROM categories");
    }

    public function getById($id){
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $parent_id){
        $stmt = $this->conn->prepare("INSERT INTO categories(name, parent_id) VALUES(?,?)");
        return $stmt->execute([$name, $parent_id ?: null]);
    }

    public function update($id, $name, $parent_id){
        $stmt = $this->conn->prepare("UPDATE categories SET name=?, parent_id=? WHERE id=?");
        return $stmt->execute([$name, $parent_id ?: null, $id]);
    }

    public function delete($id){

        // child category check
        $checkChild = $this->conn->prepare("SELECT COUNT(*) FROM categories WHERE parent_id=?");
        $checkChild->execute([$id]);
        if($checkChild->fetchColumn() > 0){
            return false;
        }

        // product check
        $checkProduct = $this->conn->prepare("SELECT COUNT(*) FROM products WHERE category_id=?");
        $checkProduct->execute([$id]);
        if($checkProduct->fetchColumn() > 0){
            return false;
        }

        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id=?");
        return $stmt->execute([$id]);
    }
}