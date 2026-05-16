
<?php
require_once "../../../config/database.php";
require_once "../../../models/Brand.php";

$db = new Database();
$conn = $db->connect();

$brand = new Brand($conn);
$result = $brand->getAll();
?>

<link rel="stylesheet" href="../../public/assets/css/style.css">

<h2>Brand List</h2>

<a href="create.php">+ Add Brand</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category ID</th>
        <th>Action</th>
    </tr>

    <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['category_id'] ?></td>

        <td>
            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>