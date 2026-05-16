<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../../../index.php");
    exit;
}

require_once "../../../config/database.php";
require_once "../../../models/Product.php";

$db = new Database();
$conn = $db->connect();

$product = new Product($conn);

if($_SERVER['REQUEST_METHOD']=="POST"){

$image = $_FILES['image'];
$filename = time()."_".$image['name'];

move_uploaded_file(
$image['tmp_name'],
"../../../public/uploads/products/".$filename
);

$data = [
'name'=>$_POST['name'],
'description'=>$_POST['description'],
'manufacturer_review'=>$_POST['manufacturer_review'],
'price'=>$_POST['price'],
'category_id'=>$_POST['category_id'],
'brand_id'=>$_POST['brand_id'],
'image_path'=>$filename,
'stock'=>$_POST['stock']
];

$product->create($data);

header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../../../public/assets/css/style.css">
<script src="../../../public/assets/js/app.js"></script>
</head>
<body>

<div class="container">

<div class="brand">💻 Computer Shop</div>

<h2>➕ Add Product</h2>

<form method="POST" enctype="multipart/form-data">

<label>Product Name</label>
<input name="name" placeholder="Enter product name" required>

<label>Description</label>
<textarea name="description"></textarea>

<label>Manufacturer Review</label>
<textarea name="manufacturer_review"></textarea>

<label>Price</label>
<input type="number" name="price" required>

<label>Category ID</label>
<input type="number" name="category_id" required>

<label>Brand ID</label>
<input type="number" name="brand_id" required>

<label>Product Image</label>
<input type="file" name="image" required>

<label>Stock</label>
<input type="number" name="stock" required>

<button type="submit">Save Product</button>

</form>

</div>

</body>
</html>