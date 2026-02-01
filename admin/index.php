<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/includes/admin-header.php";
?>

<main class="admin-content">

    <h1>Dashboard</h1>
    <p class="subtitle">Welcome to ForenCart Admin Panel</p>

    <div class="dashboard-cards">

        <div class="dash-card">
            <h3>Banners</h3>
            <p>Manage homepage sliders</p>
            <a href="<?php echo $base_url; ?>admin/banners.php">Manage</a>
        </div>

        <div class="dash-card">
            <h3>Products</h3>
            <p>Add & manage products</p>
            <a href="<?php echo $base_url; ?>admin/products.php">Manage</a>
        </div>

        <div class="dash-card">
            <h3>Orders</h3>
            <p>Track customer orders</p>
            <a href="<?php echo $base_url; ?>admin/orders.php">Manage</a>
        </div>

    </div>

</main>

</div> <!-- admin-wrapper -->
</body>
</html>
