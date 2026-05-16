<?php
require_once "../../../config/database.php";
require_once "../../../models/Product.php";

$db = new Database();
$conn = $db->connect();

$product = new Product($conn);
$result = $product->getAll();
?>
<link rel="stylesheet" href="../../public/assets/css/style.css"><link rel="stylesheet" href="../../public/assets/css/style.css">
<h2>Product List</h2>

<a href="create.php">+ Add Product</a>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Image</th>
        <th>Action</th>
    </tr>

    <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['price'] ?></td>
        <td><?= $row['stock'] ?></td>

        <td>
            <img src="../../../public/uploads/products/<?= $row['image_path'] ?>" width="50">
        </td>

        <td>
            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>