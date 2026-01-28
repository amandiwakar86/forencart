<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "forencart_db";

$conn = mysqli_connect("localhost", "root", "", "forencart_db", 3306);

if (!$conn) {
    die("Database connection failed");
}
?>
