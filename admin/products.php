<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/includes/admin-header.php";
$products = mysqli_query($conn, "
    SELECT p.*, c.name AS category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    ORDER BY p.id DESC
");
?>

<main class="admin-content">

    <h1>Products</h1>
    <a href="add-product.php" class="admin-btn">+ Add Product</a>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($p = mysqli_fetch_assoc($products)) { ?>
            <tr>
                <td><?php echo $p['id']; ?></td>

                <td>
                    <img 
                        src="../assets/images/products/<?php echo $p['image']; ?>" 
                        class="product-thumb"
                        alt=""
                    >
                </td>

                <td><?php echo htmlspecialchars($p['name']); ?></td>
                <td><?php echo $p['category_name']; ?></td>
                <td>₹<?php echo number_format($p['price'], 2); ?></td>

                <td class="actions">
                    <a href="edit-product.php?id=<?php echo $p['id']; ?>" class="edit-btn">Edit</a>
                    <a 
                        href="delete-product.php?id=<?php echo $p['id']; ?>" 
                        class="delete-btn"
                        onclick="return confirm('Are you sure you want to delete this product?')"
                    >
                        Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</main>

</body>
</html>
