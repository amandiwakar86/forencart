<?php
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; // 🔥 MOST IMPORTANT LINE

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header("Location: cart.php");
    exit;
}

// Calculate total
$total = 0;
foreach ($cart as $id => $qty) {
    $res = mysqli_query($conn, "SELECT price FROM products WHERE id = $id");
    $p = mysqli_fetch_assoc($res);
    $total += $p['price'] * $qty;
}

// ✅ Insert order WITH user_id
mysqli_query($conn, "
    INSERT INTO orders (user_id, total, status)
    VALUES ($user_id, $total, 'pending')
");

$order_id = mysqli_insert_id($conn);

// Insert order items
foreach ($cart as $id => $qty) {
    $res = mysqli_query($conn, "SELECT price FROM products WHERE id = $id");
    $p = mysqli_fetch_assoc($res);

    mysqli_query($conn, "
        INSERT INTO order_items (order_id, product_id, quantity, price)
        VALUES ($order_id, $id, $qty, {$p['price']})
    ");
}

// Clear cart
unset($_SESSION['cart']);

header("Location: order-success.php");
exit;
