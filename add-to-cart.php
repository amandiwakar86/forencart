<?php
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: shop.php");
    exit;
}

$product_id = (int) $_GET['id'];

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Increase quantity if already exists
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]++;
} else {
    $_SESSION['cart'][$product_id] = 1;
}

header("Location: cart.php");
exit;
