<?php
require_once '../includes/db.php';
$base_url = "http://localhost/forencart/";
$category = $_POST['category'] ?? '';
$min      = $_POST['min'] ?? '';
$max      = $_POST['max'] ?? '';

$where = "WHERE products.status = 1";

/* CATEGORY FILTER */
if (!empty($category)) {
    $slug = mysqli_real_escape_string($conn, $category);

    $where .= " AND products.category_id = (
        SELECT id FROM categories WHERE slug = '$slug' LIMIT 1
    )";
}

/* PRICE FILTER */
if ($min !== '' && is_numeric($min)) {
    $where .= " AND products.price >= " . (float)$min;
}

if ($max !== '' && is_numeric($max)) {
    $where .= " AND products.price <= " . (float)$max;
}

$query = mysqli_query($conn, "
    SELECT products.* 
    FROM products
    $where
    ORDER BY products.id DESC
");

if (!$query || mysqli_num_rows($query) === 0) {
    echo "<p class='no-products'>No products found.</p>";
    exit;
}

while ($p = mysqli_fetch_assoc($query)) {
?>
<div class="product-card">
    <a href="../product.php?id=<?php echo $p['id']; ?>">
            <img 
                src="<?php echo $base_url; ?>assets/images/products/<?php echo $p['image'] ?: 'placeholder.png'; ?>"
                alt="<?php echo htmlspecialchars($p['name']); ?>"
            >
    </a>

    <div class="product-info">
        <h4><?php echo htmlspecialchars($p['name']); ?></h4>
        <p class="price">₹<?php echo number_format($p['price'], 2); ?></p>

        <a 
            href="./product.php?id=<?php echo $p['id']; ?>" 
            class="view-btn"
        >
            View Product
        </a>
    </div>
</div>
<?php } ?>
