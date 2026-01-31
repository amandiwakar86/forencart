<?php
$base_url = "http://localhost/forencart/";
include_once '../includes/header.php';
// header.php already starts session + db + base_url
require_once "../includes/header.php";

$category = $_POST['category'] ?? '';
$search   = $_POST['search'] ?? '';
$min      = $_POST['min'] ?? '';
$max      = $_POST['max'] ?? '';

$where = "WHERE products.status = 1";

/* CATEGORY FILTER */
if (!empty($category)) {
    $cat = mysqli_real_escape_string($conn, $category);
    $where .= " AND categories.slug = '$cat'";
}

/* SEARCH FILTER */
if (!empty($search)) {
    $s = mysqli_real_escape_string($conn, $search);
    $where .= " AND (
        products.name LIKE '%$s%' 
        OR products.description LIKE '%$s%'
    )";
}

/* PRICE FILTER */
if ($min !== '' && is_numeric($min)) {
    $where .= " AND products.price >= " . (float)$min;
}

if ($max !== '' && is_numeric($max)) {
    $where .= " AND products.price <= " . (float)$max;
}

/* FETCH PRODUCTS */
$query = mysqli_query($conn, "
    SELECT products.*, categories.name AS category_name
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    $where
    ORDER BY products.id DESC
");

if (!$query || mysqli_num_rows($query) === 0) {
    echo "<p class='no-products'>No products found.</p>";
    exit;
}

/* OUTPUT PRODUCTS */
while ($p = mysqli_fetch_assoc($query)) {
?>
    <div class="product-card">

        <a href="<?php echo $base_url; ?>pages/product.php?id=<?php echo $p['id']; ?>">
            <img 
                src="<?php echo $base_url; ?>assets/images/products/<?php echo $p['image'] ?: 'placeholder.png'; ?>" 
                alt="<?php echo htmlspecialchars($p['name']); ?>"
            >
        </a>

        <div class="product-info">
            <h4><?php echo htmlspecialchars($p['name']); ?></h4>

            <p class="price">
                ₹<?php echo number_format($p['price'], 2); ?>
            </p>

            <a 
                href="<?php echo $base_url; ?>pages/product.php?id=<?php echo $p['id']; ?>" 
                class="view-btn"
            >
                View Product
            </a>
        </div>

    </div>
<?php } ?>
