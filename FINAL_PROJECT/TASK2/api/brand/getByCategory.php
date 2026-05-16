<?php
require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();

$id = $_GET['category_id'];

$stmt = $conn->prepare("SELECT * FROM brands WHERE category_id=?");
$stmt->execute([$id]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));