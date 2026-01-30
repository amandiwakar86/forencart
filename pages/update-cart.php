<?php
include '../includes/header.php';

if (isset($_POST['qty'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        $qty = (int) $qty;
        if ($qty > 0) {
            $_SESSION['cart'][$id] = $qty;
        }
    }
}

header("Location: cart.php");
exit;
