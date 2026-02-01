<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/includes/admin-header.php";
$id = $_GET['id'] ?? 0;

mysqli_query($conn, "
    UPDATE banners
    SET is_active = IF(is_active=1,0,1)
    WHERE id = $id
");

header("Location: banners.php");
exit;
