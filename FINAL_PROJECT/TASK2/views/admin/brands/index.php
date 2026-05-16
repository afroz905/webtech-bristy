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
$result = $brand->getAll();
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

<h2>🏷 Brand List</h2>

<a href="create.php" class="btn">+ Add Brand</a>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Category ID</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['category_id'] ?></td>
<td>
<a class="edit-btn" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
<a class="delete-btn" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
</td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>