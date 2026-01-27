<?php
include 'includes/admin-header.php';
include 'includes/admin-sidebar.php';

$products = mysqli_query($conn, "
    SELECT products.*, categories.name AS category
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    ORDER BY products.id DESC
");
?>

<main class="admin-content">

    <h1>Products</h1>

    <a href="add-product.php" class="admin-btn">+ Add Product</a>

    <table class="admin-table">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
        </tr>

        <?php while ($p = mysqli_fetch_assoc($products)) { ?>
        <tr>
            <td>
                <img src="<?php echo $base_url; ?>assets/images/products/<?php echo $p['image']; ?>"
                     class="product-thumb">
            </td>
            <td><?php echo htmlspecialchars($p['name']); ?></td>
            <td><?php echo $p['category']; ?></td>
            <td>₹<?php echo $p['price']; ?></td>
        </tr>
        <?php } ?>

    </table>

</main>

</div>
</body>
</html>
