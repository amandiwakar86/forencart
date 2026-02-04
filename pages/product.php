
<?php
require_once '../includes/header.php';
include_once '../includes/navbar.php';

/* VALIDATE PRODUCT ID */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid product");
}

$product_id = (int) $_GET['id'];

/* FETCH PRODUCT */
$productQuery = mysqli_query($conn, "
    SELECT products.*, categories.name AS category_name, categories.id AS category_id
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    WHERE products.id = $product_id
    LIMIT 1
");

if (mysqli_num_rows($productQuery) === 0) {
    die("Product not found");
}

$product = mysqli_fetch_assoc($productQuery);

/* FETCH RELATED PRODUCTS */
$relatedProducts = mysqli_query($conn, "
    SELECT id, name, price, image
    FROM products
    WHERE category_id = {$product['category_id']} 
      AND id != $product_id
    LIMIT 4
");

?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/product.css">

<main class="product-page">

    <!-- PRODUCT DETAILS -->
    <div class="product-container">

        <!-- IMAGE -->
        <div class="product-image">
            <img 
                src="<?php echo $base_url; ?>assets/images/products/<?php echo $product['image'] ?: 'placeholder.png'; ?>"
                alt="<?php echo htmlspecialchars($product['name']); ?>"
            >
        </div>

        <!-- INFO -->
        <div class="product-info">
            

            <h1><?php echo htmlspecialchars($product['name']); ?></h1>

            <p class="category">
                Category: <?php echo htmlspecialchars($product['category_name']); ?>
            </p>

            <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>

            <p class="description">
                <?php echo nl2br(htmlspecialchars($product['description'])); ?>
            </p>

           <!-- ADD TO CART -->
            <a href="<?php echo $base_url; ?>pages/add-to-cart.php?id=<?php echo $product['id']; ?>" 
                class="add-to-cart">
                Add to Cart
            </a>
            <a href="javascript:void(0)"
            onclick="addToWishlist(<?php echo $p['id']; ?>)">
            ❤️ Add to Wishlist
            </a>

        </div>

    </div>

    <!-- RELATED PRODUCTS -->
    <?php if (mysqli_num_rows($relatedProducts) > 0) { ?>
        <section class="related-products">

            <h2>Related Products</h2>

            <div class="related-grid">
                <?php while ($rel = mysqli_fetch_assoc($relatedProducts)) { ?>
                    <div class="related-card">
                        <a href="<?php echo $base_url; ?>pages/product.php?id=<?php echo $rel['id']; ?>">
                            <img 
                                src="<?php echo $base_url; ?>assets/images/products/<?php echo $rel['image'] ?: 'placeholder.png'; ?>"
                                alt="<?php echo htmlspecialchars($rel['name']); ?>"
                            >
                            <h4><?php echo htmlspecialchars($rel['name']); ?></h4>
                            <p>₹<?php echo number_format($rel['price'], 2); ?></p>
                        </a>
                    </div>
                <?php } ?>
            </div>

        </section>
    <?php } ?>

</main>
<?php include_once '../includes/footer.php'; ?>
