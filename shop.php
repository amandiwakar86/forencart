<?php
include_once 'includes/header.php';
include_once 'includes/navbar.php';

/* ======================
   FILTER INPUTS
====================== */

$categorySlug = $_GET['category'] ?? '';
$minPrice     = $_GET['min'] ?? '';
$maxPrice     = $_GET['max'] ?? '';
$page         = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$limit  = 12;
$offset = ($page - 1) * $limit;

/* ======================
   BUILD WHERE CLAUSE
====================== */

$where = "WHERE products.status = 1";

if (!empty($categorySlug)) {
    $slug = mysqli_real_escape_string($conn, $categorySlug);
    $where .= " AND products.category_id IN (
        SELECT id FROM categories 
        WHERE slug = '$slug'
        OR parent_id = (
            SELECT id FROM categories WHERE slug = '$slug'
        )
    )";
}

if ($minPrice !== '' && is_numeric($minPrice)) {
    $where .= " AND products.price >= " . (float)$minPrice;
}

if ($maxPrice !== '' && is_numeric($maxPrice)) {
    $where .= " AND products.price <= " . (float)$maxPrice;
}

/* ======================
   TOTAL PRODUCTS (FOR PAGINATION)
====================== */

$totalQuery = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM products 
    $where
");
$totalRow   = mysqli_fetch_assoc($totalQuery);
$totalItems = $totalRow['total'];
$totalPages = ceil($totalItems / $limit);

/* ======================
   FETCH PRODUCTS
====================== */

$products = mysqli_query($conn, "
    SELECT products.*, categories.name AS category_name
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    $where
    ORDER BY products.id DESC
    LIMIT $limit OFFSET $offset
");

/* ======================
   FETCH CATEGORIES
====================== */

$categories = mysqli_query(
    $conn,
    "SELECT * FROM categories 
     WHERE parent_id IS NULL AND status = 1 
     ORDER BY name ASC"
);
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/shop.css">

<main class="shop-page">

    <h1 class="shop-title">Shop Products</h1>

    <div class="shop-layout">

        <!-- ================= SIDEBAR ================= -->
        <aside class="shop-sidebar">

            <h3>Categories</h3>
            <ul>
                <li>
                    <a href="<?php echo $base_url; ?>shop.php">All Products</a>
                </li>

                <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                    <li>
                        <a href="<?php echo $base_url; ?>shop.php?category=<?php echo $cat['slug']; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <!-- PRICE FILTER -->
            <h3>Filter by Price</h3>

            <form method="get" class="price-filter">

                <?php if ($categorySlug) { ?>
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($categorySlug); ?>">
                <?php } ?>

                <input type="number" name="min" placeholder="Min ₹" value="<?php echo htmlspecialchars($minPrice); ?>">
                <input type="number" name="max" placeholder="Max ₹" value="<?php echo htmlspecialchars($maxPrice); ?>">

                <button type="submit">Apply</button>

            </form>

        </aside>

        <!-- ================= PRODUCTS ================= -->
        <section class="shop-products">

            <?php if (mysqli_num_rows($products) > 0) { ?>

                <?php while ($product = mysqli_fetch_assoc($products)) { ?>

                    <div class="product-card">

                        <a href="<?php echo $base_url; ?>product.php?id=<?php echo $product['id']; ?>">
                            <img 
                                src="<?php echo $base_url; ?>assets/images/products/<?php echo $product['image'] ?: 'placeholder.png'; ?>"
                                alt="<?php echo htmlspecialchars($product['name']); ?>"
                            >
                        </a>

                        <div class="product-info">
                            <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                            <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>

                            <a href="<?php echo $base_url; ?>product.php?id=<?php echo $product['id']; ?>" class="view-btn">
                                View Product
                            </a>
                        </div>

                    </div>

                <?php } ?>

            <?php } else { ?>
                <p class="no-products">No products found.</p>
            <?php } ?>

            <!-- ================= PAGINATION ================= -->
            <?php if ($totalPages > 1) { ?>
                <div class="pagination">

                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>

                        <a 
                            href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"
                            class="<?php echo ($i === $page) ? 'active' : ''; ?>"
                        >
                            <?php echo $i; ?>
                        </a>

                    <?php } ?>

                </div>
            <?php } ?>

        </section>

    </div>

</main>

<?php include_once 'includes/footer.php'; ?>
