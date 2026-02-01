<?php
require_once '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

$user_id  = $_SESSION['user_id'];
$order_id = (int) ($_GET['order_id'] ?? 0);

/* Fetch order */
$orderQ = mysqli_query($conn, "
    SELECT * FROM orders
    WHERE id = $order_id AND user_id = $user_id
");
$order = mysqli_fetch_assoc($orderQ);

if (!$order) {
    die("Order not found");
}

/* Fetch items */
$items = mysqli_query($conn, "
    SELECT p.name, oi.quantity, oi.price
    FROM order_items oi
    JOIN products p ON p.id = oi.product_id
    WHERE oi.order_id = $order_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice #<?php echo $order_id; ?></title>
    <style>
        body { font-family: Arial; background:#f5f5f5; }
        .invoice-box {
            max-width: 800px;
            margin: 40px auto;
            background:#fff;
            padding: 30px;
            border:1px solid #ddd;
        }
        h2 { text-align:center; }
        table { width:100%; border-collapse: collapse; }
        table th, table td {
            border:1px solid #ccc;
            padding:10px;
            text-align:left;
        }
        .total { text-align:right; font-size:18px; font-weight:bold; }
        .print-btn {
            margin:20px 0;
            text-align:center;
        }
        @media print {
            .print-btn { display:none; }
        }
    </style>
</head>
<body>

<div class="invoice-box">

    <h2>ForenCart Invoice</h2>

    <p><strong>Order ID:</strong> #<?php echo $order['id']; ?></p>
    <p><strong>Date:</strong> <?php echo date('d M Y, h:i A', strtotime($order['created_at'])); ?></p>
    <p><strong>Customer:</strong> <?php echo $_SESSION['user_name']; ?> (<?php echo $_SESSION['user_email']; ?>)</p>

    <table>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>

        <?php $grand = 0; ?>
        <?php while ($row = mysqli_fetch_assoc($items)) { 
            $line = $row['quantity'] * $row['price'];
            $grand += $line;
        ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>₹<?php echo number_format($row['price'],2); ?></td>
            <td>₹<?php echo number_format($line,2); ?></td>
        </tr>
        <?php } ?>

        <tr>
            <td colspan="3" class="total">Grand Total</td>
            <td class="total">₹<?php echo number_format($grand,2); ?></td>
        </tr>
    </table>

    <div class="print-btn">
        <button onclick="window.print()">🧾 Print / Save as PDF</button>
    </div>

</div>

</body>
</html>
