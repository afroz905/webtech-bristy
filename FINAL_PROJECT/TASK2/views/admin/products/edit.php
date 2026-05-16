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
$data = $product->getById($_GET['id']);

if($_SERVER['REQUEST_METHOD']=="POST"){

    // 🔥 default old image
    $imageName = $data['image_path'];

    // 🔥 new image upload
    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image'];
        $filename = time()."_".$image['name'];

        move_uploaded_file(
            $image['tmp_name'],
            "../../../public/uploads/products/".$filename
        );

        // 🔥 OLD IMAGE DELETE
        if(!empty($data['image_path']) && file_exists("../../../public/uploads/products/".$data['image_path'])){
            unlink("../../../public/uploads/products/".$data['image_path']);
        }

        $imageName = $filename;
    }

    $update = [
        'name'=>$_POST['name'],
        'description'=>$_POST['description'],
        'manufacturer_review'=>$_POST['manufacturer_review'],
        'price'=>$_POST['price'],
        'category_id'=>$_POST['category_id'],
        'brand_id'=>$_POST['brand_id'],
        'stock'=>$_POST['stock'],
        'image_path'=>$imageName
    ];

    $product->update($_GET['id'], $update);

    header("Location: index.php");
    exit;
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

<h2>✏ Edit Product</h2>

<!-- 🔥 CURRENT IMAGE -->
<div style="text-align:center; margin-bottom:15px;">
    <img src="../../../public/uploads/products/<?= $data['image_path'] ?>" width="100">
</div>

<form method="POST" enctype="multipart/form-data">

<label>Product Name</label>
<input name="name" value="<?= $data['name'] ?>" required>

<label>Description</label>
<textarea name="description"><?= $data['description'] ?></textarea>

<label>Manufacturer Review</label>
<textarea name="manufacturer_review"><?= $data['manufacturer_review'] ?></textarea>

<label>Price</label>
<input type="number" name="price" value="<?= $data['price'] ?>" required>

<label>Category ID</label>
<input type="number" name="category_id" value="<?= $data['category_id'] ?>" required>

<label>Brand ID</label>
<input type="number" name="brand_id" value="<?= $data['brand_id'] ?>" required>

<label>Stock</label>
<input type="number" name="stock" value="<?= $data['stock'] ?>" required>

<label>Change Image</label>
<input type="file" name="image">

<button type="submit">Update Product</button>

</form>

</div>

</body>
</html>