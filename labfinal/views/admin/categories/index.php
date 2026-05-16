
<?php
require_once "../../../config/database.php";
require_once "../../../models/Category.php";

$db = new Database();
$conn = $db->connect();

$category = new Category($conn);
$result = $category->getAll();
?>

<link rel="stylesheet" href="../../public/assets/css/style.css">

<h2>Category List</h2>

<a href="create.php">+ Add Category</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Parent ID</th>
        <th>Action</th>
    </tr>

    <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['parent_id'] ?></td>

        <td>
            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>