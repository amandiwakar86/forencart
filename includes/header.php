<?php
// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForenCart</title>

    <!-- 🔹 GLOBAL CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/navbar.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/hero.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/categories.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/featured-products.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/why-us.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/shop.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/footer.css">
   
    <!-- 🔹 BASE URL FOR JS -->
    <script>
        const BASE_URL = "<?php echo $base_url; ?>";
    </script>

    <!-- 🔹 GLOBAL JS (FUNCTIONALITY) -->
    <script src="<?php echo $base_url; ?>assets/js/navbar.js" defer></script>
    <script src="<?php echo $base_url; ?>assets/js/hero.js" defer></script>
    <script src="<?php echo $base_url; ?>assets/js/shop.js" defer></script>
    <script src="<?php echo $base_url; ?>assets/js/wishlist.js" defer></script>
</head>
<body>
