<?php
require_once '../includes/header.php';

$user_id = $_SESSION['user_id'];
$product_id = (int)$_POST['product_id'];

mysqli_query($conn, "
    DELETE FROM wishlist 
    WHERE user_id=$user_id AND product_id=$product_id
");

echo "Removed from wishlist";
