<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../../../index.php");
    exit;
}

require_once "../../../config/database.php";
require_once "../../../models/Brand.php";

$db = new Database();
$conn = $db->connect();

$brand = new Brand($conn);
$data = $brand->getById($_GET['id']);

if($_SERVER['REQUEST_METHOD']=="POST"){
    $brand->update($_GET['id'], $_POST['name'], $_POST['category_id']);
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

<h2>✏ Edit Brand</h2>

<form method="POST">

<label>Brand Name</label>
<input type="text" name="name" value="<?= $data['name'] ?>">

<label>Category ID</label>
<input type="number" name="category_id" value="<?= $data['category_id'] ?>">

<button type="submit">Update Brand</button>

</form>

</div>

</body>
</html>