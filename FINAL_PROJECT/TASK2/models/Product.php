<?php
class Product {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        return $this->conn->query("SELECT * FROM products");
    }

    public function getById($id){
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $stmt = $this->conn->prepare("
            INSERT INTO products
            (name, description, manufacturer_review, price, category_id, brand_id, image_path, stock)
            VALUES (?,?,?,?,?,?,?,?)
        ");

        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['manufacturer_review'],
            $data['price'],
            $data['category_id'],
            $data['brand_id'],
            $data['image_path'],
            $data['stock']
        ]);
    }

    // 🔥 FIXED UPDATE (image_path add)
    public function update($id, $data){
        $stmt = $this->conn->prepare("
            UPDATE products SET
            name=?, 
            description=?, 
            manufacturer_review=?, 
            price=?, 
            category_id=?, 
            brand_id=?, 
            image_path=?, 
            stock=?
            WHERE id=?
        ");

        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['manufacturer_review'],
            $data['price'],
            $data['category_id'],
            $data['brand_id'],
            $data['image_path'], // 🔥 important
            $data['stock'],
            $id
        ]);
    }

    public function delete($id){

        // 🔥 delete image first
        $product = $this->getById($id);
        if($product && file_exists("../../../public/uploads/products/".$product['image_path'])){
            unlink("../../../public/uploads/products/".$product['image_path']);
        }

        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        return $stmt->execute([$id]);
    }
}