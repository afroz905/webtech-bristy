<?php
session_start();

$_SESSION['role'] = "admin"; // test

if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
    header("Location: views/admin/dashboard.php");
    exit;
}else{
    echo "❌ Please login as admin first";
}