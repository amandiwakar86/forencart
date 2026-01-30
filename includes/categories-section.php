<?php
// Fetch categories with product count
$categories = mysqli_query($conn, "
    SELECT 
        categories.id,
        categories.name,
        categories.slug,
        COUNT(products.id) AS product_count
    FROM categories
    LEFT JOIN products ON products.category_id = categories.id
    GROUP BY categories.id
    ORDER BY categories.name ASC
");
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/categories.css">

<section class="categories-section">

    <div class="container">
        <h2 class="section-title">Shop by Categories</h2>

        <div class="categories-grid">

            <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                <a 
                    href="<?php echo $base_url; ?>pages/shop.php?category=<?php echo $cat['slug']; ?>" 
                    class="category-card"
                >
                    <div class="category-content">
                        <h3><?php echo htmlspecialchars($cat['name']); ?></h3>
                        <p><?php echo $cat['product_count']; ?> Products</p>
                    </div>
                </a>
            <?php } ?>

        </div>
    </div>

</section>
