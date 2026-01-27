<?php
include 'includes/header.php';
include 'includes/navbar.php';

$cart = $_SESSION['cart'] ?? [];
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/cart.css">

<main class="cart-page">

    <h1>Your Cart</h1>

    <?php if (empty($cart)) { ?>
        <p class="empty-cart">Your cart is empty.</p>
    <?php } else { ?>

    <form action="update-cart.php" method="post">

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

            foreach ($cart as $id => $qty) {
                $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
                $product = mysqli_fetch_assoc($res);

                $total = $product['price'] * $qty;
                $grandTotal += $total;
            ?>

            <tr>
                <td class="cart-product">
                    <img src="<?php echo $base_url; ?>assets/images/products/<?php echo $product['image']; ?>">
                    <span><?php echo htmlspecialchars($product['name']); ?></span>
                </td>

                <td>₹<?php echo number_format($product['price'], 2); ?></td>

                <td>
                    <input type="number" name="qty[<?php echo $id; ?>]" value="<?php echo $qty; ?>" min="1">
                </td>

                <td>₹<?php echo number_format($total, 2); ?></td>

                <td>
                    <a href="remove-from-cart.php?id=<?php echo $id; ?>" class="remove-btn">✕</a>
                </td>
            </tr>

            <?php } ?>
        </table>

        <div class="cart-actions">
            <button type="submit">Update Cart</button>
            <a href="checkout.php" class="checkout-btn">Checkout</a>
        </div>

        <h3 class="grand-total">
            Grand Total: ₹<?php echo number_format($grandTotal, 2); ?>
        </h3>

    </form>

    <?php } ?>

</main>

<?php include 'includes/footer.php'; ?>
