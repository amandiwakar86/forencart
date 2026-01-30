<?php
include_once '../includes/header.php';
include_once '../includes/navbar.php';

$cart = $_SESSION['cart'] ?? [];
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/cart.css">

<main class="cart-page">

<h1>Your Cart</h1>

<?php if (empty($cart)) { ?>
    <p>Your cart is empty.</p>
<?php } else { ?>

<table class="cart-table">
<tr>
    <th>Product</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Remove</th>
</tr>

<?php
$grandTotal = 0;

foreach ($cart as $pid => $qty) {
    $res = mysqli_query($conn, "SELECT name, price, image FROM products WHERE id=$pid");
    if ($p = mysqli_fetch_assoc($res)) {
        $total = $p['price'] * $qty;
        $grandTotal += $total;
?>
<tr>
    <td><?php echo htmlspecialchars($p['name']); ?></td>
    <td>₹<?php echo $p['price']; ?></td>
    <td><?php echo $qty; ?></td>
    <td>₹<?php echo $total; ?></td>
    <td>
        <a href="remove-from-cart.php?id=<?php echo $pid; ?>">❌</a>
    </td>
</tr>
<?php }} ?>

<tr>
    <td colspan="3"><strong>Grand Total</strong></td>
    <td colspan="2"><strong>₹<?php echo $grandTotal; ?></strong></td>
</tr>

</table>
<?php if (!empty($cart)) { ?>
    <div class="cart-actions">
        <a href="<?php echo $base_url; ?>pages/checkout.php" class="checkout-btn">
            Proceed to Checkout
        </a>
    </div>
<?php } ?>

<?php } ?>

</main>

<?php include_once '../includes/footer.php'; ?>
