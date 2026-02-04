<?php
require_once '../includes/header.php';
include_once '../includes/navbar.php';

/* URL se category & search */
$initialCategory = $_GET['category'] ?? '';
$search = $_GET['q'] ?? '';

/* FETCH CATEGORIES (SIDEBAR KE LIYE) */
$categories = mysqli_query(
    $conn,
    "SELECT * FROM categories WHERE status = 1 ORDER BY name ASC"
);
?>


<main class="shop-page">

    <h1 class="shop-title">Shop Products</h1>

    <?php if (!empty($search)) { ?>
        <p class="search-result">
            Showing results for "<strong><?php echo htmlspecialchars($search); ?></strong>"
        </p>
    <?php } ?>

    <div class="shop-layout">

        <!-- SIDEBAR -->
        <aside class="shop-sidebar">

            <h3>Categories</h3>
            <ul id="categoryList">
                <li>
                    <a href="#" data-category="">All Products</a>
                </li>

                <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                    <li>
                        <a href="#" data-category="<?php echo $cat['slug']; ?>">
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <h3>Filter by Price</h3>
            <form id="priceFilter">
                <input type="number" id="minPrice" placeholder="Min ₹">
                <input type="number" id="maxPrice" placeholder="Max ₹">
                <button type="submit">Apply</button>
            </form>

        </aside>

        <!-- PRODUCTS -->
        <section class="shop-products" id="shopProducts">
            <!-- Products AJAX se load honge -->
        </section>

    </div>

</main>

<!-- PHP se JS ko data pass -->
<script>
    window.SHOP_INITIAL_CATEGORY = "<?php echo htmlspecialchars($initialCategory); ?>";
    window.SHOP_INITIAL_SEARCH = "<?php echo htmlspecialchars($search); ?>";
</script>

<!-- SHOP JS -->
<?php include_once '../includes/footer.php'; ?>
