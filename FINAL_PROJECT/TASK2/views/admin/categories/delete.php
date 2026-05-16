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

if(isset($_GET['id'])){

    $result = $cat->delete($_GET['id']);

    if(!$result){
        echo "❌ Cannot delete: Category has child or products!";
        exit;
    }

    header("Location: index.php");
}
?>