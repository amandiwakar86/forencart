<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please login first";
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$product_id = (int)($_POST['product_id'] ?? 0);

if ($product_id === 0) {
    echo "Invalid product";
    exit;
}

$check = mysqli_query($conn, "
    SELECT id FROM wishlist 
    WHERE user_id=$user_id AND product_id=$product_id
");

if (mysqli_num_rows($check) > 0) {
    echo "Already in wishlist ❤️";
    exit;
}

mysqli_query($conn, "
    INSERT INTO wishlist (user_id, product_id)
    VALUES ($user_id, $product_id)
");

echo "Added to wishlist ❤️";
