<?php

require_once "../controllers/CategoryController.php";
require_once "../controllers/BrandController.php";
require_once "../controllers/ProductController.php";

$category = new CategoryController();
$brand = new BrandController();
$product = new ProductController();

if(isset($_POST['category'])){
    $category->store();
}

if(isset($_POST['brand'])){
    $brand->store();
}

if(isset($_POST['submit'])){
    $product->store();
}
?>