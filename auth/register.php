<?php
include_once '../includes/header.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    if (empty($name) || empty($email) || empty($pass)) {
        $error = "All fields are required";
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn,
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hash);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Email already exists";
        }
    }
}
?>

<link rel="stylesheet" href="../assets/css/auth.css">

<div class="auth-page">
    <div class="auth-box">
        <h2>Create Account</h2>

        <?php if ($error) { ?>
            <p class="auth-error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="post">
            <input type="text" name="name" placeholder="Full Name">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">

            <button type="submit">Register</button>
        </form>

        <p class="auth-link">
            Already have an account?
            <a href="login.php">Login</a>
        </p>
    </div>
</div>
