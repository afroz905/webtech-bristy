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
$result = $product->getAll();
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

<h2>📦 Product List</h2>

<a href="create.php" class="btn">+ Add Product</a>

<table>
<tr>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Image</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>
<tr>
<td><?= $row['name'] ?></td>
<td>৳ <?= $row['price'] ?></td>
<td><?= $row['stock'] ?></td>

<td>
<img src="../../../public/uploads/products/<?= $row['image_path'] ?>" class="product-img">
</td>

<td>
<a class="edit-btn" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
<a class="delete-btn" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
</td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>