<?php
session_start();

// TEMP (later login system use korba)
$_SESSION['role'] = 'admin';

if($_SESSION['role'] !== 'admin'){
    echo "Access Denied";
    exit;
}

require_once __DIR__ . "/../../config/database.php";

$db = new Database();
$conn = $db->connect();

$totalProducts = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalCategories = $conn->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$totalBrands = $conn->query("SELECT COUNT(*) FROM brands")->fetchColumn();

$lowStock = $conn->query("SELECT * FROM products WHERE stock < 5");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="/bristy/public/assets/css/style.css">

<style>

/* HEADER */
.brand {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

/* TITLE */
h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* DASHBOARD GRID */
.dashboard {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* CARD */
.card {
    text-decoration: none;
    color: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    display: block;
    transition: 0.3s;
}

/* DIFFERENT COLORS */
.products { background: #3498db; }
.categories { background: #9b59b6; }
.brands { background: #27ae60; }

/* HOVER */
.card:hover {
    transform: scale(1.05);
    cursor: pointer;
}

/* LOW STOCK */
.low-stock {
    margin-top: 30px;
}

</style>

</head>

<body>

<div class="container">

    <!-- BRAND -->
    <div class="brand">💻 Computer Shop</div>

    <!-- TITLE -->
    <h2>📊 Admin Dashboard</h2>

    <!-- CLICKABLE CARDS -->
    <div class="dashboard">

        <!-- PRODUCTS -->
        <a href="products/index.php" class="card products">
            <h3>📦 Products</h3>
            <p><?= $totalProducts ?></p>
        </a>

        <!-- CATEGORIES -->
        <a href="categories/index.php" class="card categories">
            <h3>📂 Categories</h3>
            <p><?= $totalCategories ?></p>
        </a>

        <!-- BRANDS -->
        <a href="brands/index.php" class="card brands">
            <h3>🏷 Brands</h3>
            <p><?= $totalBrands ?></p>
        </a>

    </div>

    <!-- LOW STOCK -->
    <div class="low-stock">
        <h3>⚠ Low Stock Products</h3>

        <?php if($lowStock->rowCount() == 0): ?>
            <p>No low stock products ✅</p>
        <?php endif; ?>

        <?php while($row = $lowStock->fetch(PDO::FETCH_ASSOC)){ ?>
            <p><?= $row['name'] ?> (<?= $row['stock'] ?>)</p>
        <?php } ?>
    </div>

</div>

</body>
</html>