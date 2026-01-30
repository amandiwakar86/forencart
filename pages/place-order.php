<?php
include '../includes/header.php';

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header("Location: cart.php");
    exit;
}

// Calculate total
$total = 0;
foreach ($cart as $id => $qty) {
    $res = mysqli_query($conn, "SELECT price FROM products WHERE id=$id");
    $p = mysqli_fetch_assoc($res);
    $total += $p['price'] * $qty;
}

// Insert order (user_id NULL for now)
mysqli_query($conn, "
    INSERT INTO orders (user_id, total, status)
    VALUES (NULL, $total, 'pending')
");

$order_id = mysqli_insert_id($conn);

// Insert order items
foreach ($cart as $id => $qty) {
    $res = mysqli_query($conn, "SELECT price FROM products WHERE id=$id");
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
