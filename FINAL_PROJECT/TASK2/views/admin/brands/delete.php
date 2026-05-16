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

if(isset($_GET['id'])){
    $result = $brand->delete($_GET['id']);

    if(!$result){
        echo "Cannot delete: Brand has products!";
        exit;
    }

    header("Location: index.php");
}
?>