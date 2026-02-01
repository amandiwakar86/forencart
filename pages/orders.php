<?php
require_once '../includes/header.php';
require_once '../includes/navbar.php';

/* 🔐 Login check */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = (int) $_SESSION['user_id'];

/* 📦 Fetch orders */
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

    <?php while ($order = mysqli_fetch_assoc($orders)) { ?>

        <!-- LANDSCAPE ORDER CARD -->
        <div class="order-landscape-card">

            <!-- LEFT : IMAGE (first product preview) -->
            <div class="order-image">
                <?php
                $preview = mysqli_query($conn, "
                    SELECT p.image
                    FROM order_items oi
                    JOIN products p ON p.id = oi.product_id
                    WHERE oi.order_id = {$order['id']}
                    LIMIT 1
                ");
                $prev = mysqli_fetch_assoc($preview);
                ?>
                <img src="<?php echo $base_url; ?>assets/images/products/<?php echo $prev['image'] ?? 'placeholder.png'; ?>">
            </div>

            <!-- CENTER : ORDER INFO -->
            <div class="order-info">
                <h3>Order #<?php echo $order['id']; ?></h3>

                <div class="meta">
                    <span>📅 <?php echo date('d M Y, h:i A', strtotime($order['created_at'])); ?></span>
                </div>

                <p class="total">
                    Total: ₹<?php echo number_format($order['total'], 2); ?>
                </p>
            </div>

            <!-- RIGHT : STATUS + ACTIONS -->
            <div class="order-actions">
                <span class="status <?php echo strtolower($order['status']); ?>">
                    <?php echo ucfirst($order['status']); ?>
                </span>

                <button class="btn view toggle-items"
                        data-order="<?php echo $order['id']; ?>">
                    View Items ⌄
                </button>

                <a href="<?php echo $base_url; ?>pages/shop.php" class="btn shop">
                    Shop More →
                </a>
            </div>
        </div>

        <!-- 🔽 EXPANDABLE PRODUCTS LIST -->
        <div class="order-items" id="items-<?php echo $order['id']; ?>">

            <?php
            $items = mysqli_query($conn, "
                SELECT p.name, p.image, oi.quantity, oi.price
                FROM order_items oi
                JOIN products p ON p.id = oi.product_id
                WHERE oi.order_id = {$order['id']}
            ");
            ?>

            <?php while ($it = mysqli_fetch_assoc($items)) { ?>
                <div class="order-item">
                    <img src="<?php echo $base_url; ?>assets/images/products/<?php echo $it['image']; ?>">

                    <div>
                        <p class="item-name"><?php echo htmlspecialchars($it['name']); ?></p>
                        <p class="item-meta">
                            Qty: <?php echo $it['quantity']; ?> × ₹<?php echo number_format($it['price'], 2); ?>
                        </p>
                    </div>

                    <strong>
                        ₹<?php echo number_format($it['quantity'] * $it['price'], 2); ?>
                    </strong>
                </div>
            <?php } ?>

        </div>

    <?php } ?>
</div>

<script src="<?php echo $base_url; ?>assets/js/orders.js"></script>

<?php include '../includes/footer.php'; ?>
