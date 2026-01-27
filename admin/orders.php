<?php
include 'includes/admin-header.php';
include 'includes/admin-sidebar.php';

$orders = mysqli_query($conn, "
    SELECT * FROM orders
    ORDER BY id DESC
");
?>

<main class="admin-content">

    <h1>Orders</h1>

    <table class="admin-table">
        <tr>
            <th>Order ID</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php if (mysqli_num_rows($orders) > 0) { ?>
            <?php while ($o = mysqli_fetch_assoc($orders)) { ?>
            <tr>
                <td>#<?php echo $o['id']; ?></td>
                <td>₹<?php echo number_format($o['total'], 2); ?></td>
                <td><?php echo ucfirst($o['status']); ?></td>
                <td><?php echo date("d M Y", strtotime($o['created_at'])); ?></td>
                <td>
                    <a href="order-view.php?id=<?php echo $o['id']; ?>">
                        View
                    </a>
                </td>
            </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">No orders found.</td>
            </tr>
        <?php } ?>

    </table>

</main>

</body>
</html>
