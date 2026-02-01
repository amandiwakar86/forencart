<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/includes/admin-header.php";
$id = $_GET['id'] ?? 0;

$banner = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT image FROM banners WHERE id = $id")
);

if ($banner) {
    // Optional: delete image file
    $imgPath = "../assets/images/hero/" . $banner['image'];
    if (file_exists($imgPath)) {
        unlink($imgPath);
    }

    mysqli_query($conn, "DELETE FROM banners WHERE id = $id");
}

header("Location: banners.php");
exit;
