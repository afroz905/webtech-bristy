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

if(isset($_GET['id'])){
    $product->delete($_GET['id']);
    header("Location: index.php");
}
?>