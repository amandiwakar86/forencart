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
 
   
    <!-- Main JS -->
    <script>
        const BASE_URL = "<?php echo $base_url; ?>";
    </script>
    <script src="<?php echo $base_url; ?>assets/js/wishlist.js"></script>

</head>
<body>
