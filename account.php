<?php
include_once 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
?>

<h2>My Account</h2>

<p>Welcome, <strong><?php echo $_SESSION['user_name']; ?></strong></p>

<a href="auth/logout.php">Logout</a>
