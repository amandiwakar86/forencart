<?php
include_once 'includes/header.php';
include_once 'includes/navbar.php';

/* CATEGORY FILTER */
$categorySlug = $_GET['category'] ?? '';

$where = "";
if (!empty($categorySlug)) {
    $where = "WHERE categories.slug = '" . mysqli_real_escape_string($conn, $categorySlug) . "'";
}

/* FETCH PRODUCTS */
$products = mysqli_query($conn, "
    SELECT products.*, categories.name AS category_name
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    $where
    ORDER BY products.id DESC
");

/* FETCH CATEGORIES */
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY name ASC");
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/shop.css">

<main class="shop-page">

    <h1 class="shop-title">Shop Products</h1>

    <div class="shop-layout">

        <!-- SIDEBAR -->
        <aside class="shop-sidebar">
            <h3>Categories</h3>
            <ul>
                <li>
                    <a href="<?php echo $base_url; ?>shop.php"
                       class="<?php echo empty($categorySlug) ? 'active' : ''; ?>">
                        All Products
                    </a>
                </li>

                <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                    <li>
                        <a href="<?php echo $base_url; ?>shop.php?category=<?php echo $cat['slug']; ?>"
                           class="<?php echo $categorySlug === $cat['slug'] ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </aside>

        <!-- PRODUCTS -->
        <section class="shop-products">

            <?php if (mysqli_num_rows($products) > 0) { ?>
                <?php while ($product = mysqli_fetch_assoc($products)) { ?>
                    <div class="product-card">

                        <a href="<?php echo $base_url; ?>product.php?id=<?php echo $product['id']; ?>">
                            <img 
                                src="<?php echo $base_url; ?>assets/images/products/<?php echo $product['image'] ?: 'placeholder.png'; ?>"
                                alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </a>

                        <div class="product-info">
                            <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                            <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>

                            <a href="<?php echo $base_url; ?>product.php?id=<?php echo $product['id']; ?>"
                               class="view-btn">
                                View Product
                            </a>
                        </div>

                    </div>
                <?php } ?>
            <?php } else { ?>
                <p class="no-products">No products found.</p>
            <?php } ?>

        </section>

    </div>

</main>
