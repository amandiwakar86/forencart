<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "forencart_db";

$conn = mysqli_connect("localhost", "root", "", "forencart_db", 3307);

if (!$conn) {
    die("Database connection failed");
}
?>
