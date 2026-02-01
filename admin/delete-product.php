<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/includes/admin-header.php";
$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM products WHERE id=$id");

header("Location: products.php");
exit;
