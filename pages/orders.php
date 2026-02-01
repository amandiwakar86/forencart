<?php
require_once '../includes/header.php';
require_once '../includes/navbar.php';

/* 🔐 Login check */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];

/* ✅ ORDERS QUERY — MUST BE BEFORE HTML */
$orders = mysqli_query($conn, "
    SELECT * FROM orders
    WHERE user_id = $user_id
    ORDER BY created_at DESC
");

if (!$orders) {
    die("Orders query failed: " . mysqli_error($conn));
}
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/orders.css">

<div class="orders-page">
    <h2 class="orders-title">📦 My Orders</h2>

    <?php if (mysqli_num_rows($orders) === 0) { ?>
        <p>No orders found.</p>
    <?php } ?>

    <?php while ($order = mysqli_fetch_assoc($orders)) {

        /* 🔍 One product preview for card */
        $itemQuery = mysqli_query($conn, "
            SELECT p.name, p.image, p.description
            FROM order_items oi
            JOIN products p ON p.id = oi.product_id
            WHERE oi.order_id = {$order['id']}
            LIMIT 1
        ");

        $item = mysqli_fetch_assoc($itemQuery);
    ?>

    <div class="order-landscape-card">

        <!-- IMAGE -->
        <div class="order-image">
            <img src="<?php echo $base_url; ?>assets/images/products/<?php echo $item['image'] ?? 'placeholder.png'; ?>">
        </div>

        <!-- INFO -->
        <div class="order-info">
            <h3><?php echo htmlspecialchars($item['name'] ?? 'Product'); ?></h3>

            <p class="desc">
                <?php echo substr($item['description'] ?? '', 0, 90); ?>...
            </p>

            <div class="meta">
                <span>🧾 Order #<?php echo $order['id']; ?></span>
                <span>
                    📅 <?php echo date('d M Y, h:i A', strtotime($order['created_at'])); ?>
                </span>
            </div>

            <p class="total">
                Total: ₹<?php echo number_format($order['total'], 2); ?>
            </p>
        </div>

        <!-- ACTIONS -->
        <div class="order-actions">
            <span class="status <?php echo strtolower($order['status']); ?>">
                <?php echo ucfirst($order['status']); ?>
            </span>

            <a href="#" class="btn view">View Details</a>
            <a href="<?php echo $base_url; ?>pages/shop.php" class="btn shop">
                You may like →
            </a>
        </div>

    </div>

    <?php } ?>
</div>

<?php include '../includes/footer.php'; ?>
