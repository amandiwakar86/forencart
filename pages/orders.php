<?php
require_once '../includes/header.php';
require_once '../includes/navbar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$orders = mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE user_id = $user_id 
    ORDER BY id DESC
");
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/orders.css">

<div class="orders-container">
    <h2>📦 My Orders</h2>

    <?php if (mysqli_num_rows($orders) == 0) { ?>
        <p>You have not placed any orders yet.</p>
    <?php } else { ?>

        <?php while ($order = mysqli_fetch_assoc($orders)) { ?>
            <div class="order-card">
                <div class="order-top">
                    <span><b>Order #<?php echo $order['id']; ?></b></span>
                    <span><?php echo date('d M Y', strtotime($order['created_at'])); ?></span>
                </div>

                <p>Total: ₹<?php echo number_format($order['total'], 2); ?></p>
                <p>Status: <b><?php echo $order['status']; ?></b></p>
            </div>
        <?php } ?>

    <?php } ?>
</div>

<?php include '../includes/footer.php'; ?>
