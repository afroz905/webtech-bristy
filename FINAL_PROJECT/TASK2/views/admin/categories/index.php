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
$result = $cat->getAll();
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

<h2>📂 Category List</h2>

<a href="create.php" class="btn">+ Add Category</a>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Parent ID</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['parent_id'] ?? 'None' ?></td>
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