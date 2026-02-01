<?php
require_once '../includes/header.php';

$user_id = $_SESSION['user_id'];

$orders = mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE user_id = $user_id 
    ORDER BY id DESC
");
?>

<h2>My Orders</h2>

<?php if (mysqli_num_rows($orders) == 0) { ?>
    <p>No orders found.</p>
<?php } else { ?>
<table border="1" cellpadding="10">
    <tr>
        <th>Order ID</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
    </tr>

    <?php while ($o = mysqli_fetch_assoc($orders)) { ?>
    <tr>
        <td>#<?php echo $o['id']; ?></td>
        <td>₹<?php echo $o['total']; ?></td>
        <td><?php echo $o['status']; ?></td>
        <td><?php echo date('d M Y', strtotime($o['created_at'])); ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>

<?php include '../includes/footer.php'; ?>
