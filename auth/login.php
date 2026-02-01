<?php
include_once '../includes/header.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    $stmt = mysqli_prepare($conn,
        "SELECT id, name, password FROM users WHERE email = ?"
    );
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($res)) {
        if (password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email']; 

            header("Location: ../index.php");
            exit;
        }
    }

    $error = "Invalid email or password";
}
?>

<link rel="stylesheet" href="../assets/css/auth.css">

<div class="auth-page">
    <div class="auth-box">
        <h2>Login</h2>

        <?php if ($error) { ?>
            <p class="auth-error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="post">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">

            <button type="submit">Login</button>
        </form>

        <p class="auth-link">
            New user?
            <a href="register.php">Create account</a>
        </p>
    </div>
</div>
