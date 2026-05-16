<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../../../index.php");
    exit;
}

require_once "../../../config/database.php";
require_once "../../../models/Category.php";

$db = new Database();
$conn = $db->connect();

$cat = new Category($conn);

// get current data
$data = $cat->getById($_GET['id']);

if($_SERVER['REQUEST_METHOD']=="POST"){

    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'];

    if($parent_id == $_GET['id']){
        echo "❌ Category cannot be its own parent!";
        exit;
    }

    $cat->update($_GET['id'], $name, $parent_id);

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

<h2>✏ Edit Category</h2>

<form method="POST">

<label>Category Name</label>
<input type="text" name="name" value="<?= $data['name'] ?>" required>

<label>Parent ID (optional)</label>
<input type="number" name="parent_id" value="<?= $data['parent_id'] ?>">

<button type="submit">Update Category</button>

</form>

</div>

</body>
</html>