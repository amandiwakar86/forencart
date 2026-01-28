<?php
include_once 'includes/header.php';
include_once 'includes/navbar.php';

/* ======================
   FETCH CATEGORIES
====================== */
$categories = mysqli_query(
    $conn,
    "SELECT * FROM categories WHERE status = 1 ORDER BY name ASC"
);
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/shop.css">

<main class="shop-page">

    <h1 class="shop-title">Shop Products</h1>

    <div class="shop-layout">

        <!-- ================= SIDEBAR ================= -->
        <aside class="shop-sidebar">

            <h3>Categories</h3>
            <ul id="categoryList">
                <li>
                    <a href="#" data-category="">All Products</a>
                </li>

                <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                    <li>
                        <a 
                            href="#" 
                            data-category="<?php echo $cat['slug']; ?>"
                        >
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <!-- PRICE FILTER -->
            <h3>Filter by Price</h3>

            <form id="priceFilter">
                <input type="number" id="minPrice" placeholder="Min ₹">
                <input type="number" id="maxPrice" placeholder="Max ₹">
                <button type="submit">Apply</button>
            </form>

        </aside>

        <!-- ================= PRODUCTS ================= -->
        <section class="shop-products" id="shopProducts">
            <!-- Products loaded by AJAX -->
        </section>

    </div>

</main>

<script src="<?php echo $base_url; ?>assets/js/shop.js"></script>

<?php include_once 'includes/footer.php'; ?>
