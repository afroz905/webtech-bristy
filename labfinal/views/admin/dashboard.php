<?php
require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();

// PRODUCTS COUNT
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM products");
$stmt->execute();
$totalProducts = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// CATEGORY COUNT
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM categories");
$stmt->execute();
$totalCategories = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// BRAND COUNT
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM brands");
$stmt->execute();
$totalBrands = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// LOW STOCK
$stmt = $conn->prepare("SELECT name, stock FROM products WHERE stock < 5");
$stmt->execute();
$lowStock = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../../public/assets/css/style.css">

<h2>Admin Dashboard</h2>

<div style="display:flex; gap:30px;">

    <div>
        <h3>Total Products</h3>
        <p><?= $totalProducts ?></p>
    </div>

    <div>
        <h3>Total Categories</h3>
        <p><?= $totalCategories ?></p>
    </div>

    <div>
        <h3>Total Brands</h3>
        <p><?= $totalBrands ?></p>
    </div>

</div>

<hr>

<h3>Low Stock Products</h3>

<?php if(count($lowStock) > 0){ ?>

    <ul>
        <?php foreach($lowStock as $item){ ?>
            <li>
                <?= $item['name'] ?> - Stock: <?= $item['stock'] ?>
            </li>
        <?php } ?>
    </ul>

<?php } else { ?>
    <p>No low stock products</p>
<?php } ?>