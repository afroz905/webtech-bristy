<?php

require_once "../config/database.php";
require_once "../models/Product.php";

class ProductController {

    private $product;

    public function __construct(){
        $db = new Database();
        $this->product = new Product($db->connect());
    }

    public function store(){

        if(isset($_POST['submit'])){

            // 🔥 IMAGE UPLOAD START
            $image = $_FILES['image'];
            $filename = null;

            $allowed = ['image/jpeg', 'image/png'];

            if(in_array($image['type'], $allowed)){

                if($image['size'] <= 2000000){

                    $filename = time() . "_" . $image['name'];

                    move_uploaded_file(
                        $image['tmp_name'],
                        "../public/uploads/products/".$filename
                    );
                }
            }
            // 🔥 IMAGE UPLOAD END

            $data = [
                ":name" => $_POST['name'],
                ":description" => $_POST['description'],
                ":manufacturer_review" => $_POST['manufacturer_review'],
                ":price" => $_POST['price'],
                ":category_id" => $_POST['category_id'],
                ":brand_id" => $_POST['brand_id'],
                ":image_path" => $filename,
                ":stock" => $_POST['stock']
            ];

            $this->product->create($data);

            echo "Product Added Successfully";
        }
    }
}
?>