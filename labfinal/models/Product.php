<?php

class Product {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){

        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function create($data){

        $query = "INSERT INTO products
        (name, description, manufacturer_review, price,
        category_id, brand_id, image_path, stock, created_at)

        VALUES

        (:name, :description, :manufacturer_review, :price,
        :category_id, :brand_id, :image_path, :stock, NOW())";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute($data);
    }
}
?>