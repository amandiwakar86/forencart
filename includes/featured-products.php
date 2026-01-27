<?php
// Fetch latest 8 products
$products = mysqli_query($conn, "
    SELECT id, name, price, image 
    FROM products 
    ORDER BY created_at DESC 
    LIMIT 8
");
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/featured-products.css">

<section class="featured-products">

    <div class="container">

        <div class="section-header">
            <h2>Featured Products</h2>
            <a href="<?php echo $base_url; ?>shop.php" class="view-all">
                View All →
            </a>
        </div>

        <div class="products-grid">

            <?php if (mysqli_num_rows($products) > 0) { ?>
                <?php while ($product = mysqli_fetch_assoc($products)) { ?>

                    <div class="product-card">

                        <!-- IMAGE WRAPPER (IMPORTANT) -->
                        <a 
                            href="<?php echo $base_url; ?>product.php?id=<?php echo $product['id']; ?>" 
                            class="product-image"
                        >
                            <img 
                                src="<?php echo $base_url; ?>assets/images/products/<?php echo $product['image'] ?: 'placeholder.png'; ?>" 
                                alt="<?php echo htmlspecialchars($product['name']); ?>"
                            >
                        </a>

                        <!-- PRODUCT INFO -->
                        <div class="product-info">
                            <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                            <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>

                            <a 
                                href="<?php echo $base_url; ?>product.php?id=<?php echo $product['id']; ?>" 
                                class="btn"
                            >
                                View Product
                            </a>
                        </div>

                    </div>

                <?php } ?>
            <?php } else { ?>
                <p class="no-products">No products available.</p>
            <?php } ?>

        </div>

    </div>

</section>
