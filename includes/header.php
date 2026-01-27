<?php
// Load config & database
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/db.php';

// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ForenCart</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/responsive.css">

    <!-- Main JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/main.js" defer></script>
</head>
<body>
