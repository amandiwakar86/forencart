<?php
// Load config & database
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/db.php';

// Cart Count
function cartCount() {
    if (!isset($_SESSION['cart'])) {
        return 0;
    }
    return array_sum($_SESSION['cart']);
}

// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base URL (GLOBAL)
// define("$base_url", "http://192.168.1.5/forencart/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForenCart</title>

    <!-- Main CSS -->
   <!-- /* These lines of code are linking external CSS files to the HTML document. */ -->
 
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/navbar.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/hero.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/why-us.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/shop.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/products.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/product.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/mixed-products.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/featured-products.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/contact.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/checkout.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/categories.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/cart.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/blog.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/auth.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/admin.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/admin-products.css">

    <!-- Main JS -->
    <script src="<?php echo $$base_url; ?>assets/js/navbar.js"></script>
    <script src="<?php echo $$base_url; ?>assets/js/shop.js"></script>
    <script src="<?php echo $$base_url; ?>assets/js/hero.js"></script>

</head>
<body>
