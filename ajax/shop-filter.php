<?php
require_once '../includes/db.php';

$base_url = "http://localhost/forencart/";

$category = $_POST['category'] ?? '';
$min = $_POST['min'] ?? '';
$max = $_POST['max'] ?? '';

$where = "WHERE status = 1";

/* CATEGORY FILTER */
if ($category !== '') {
    $slug = mysqli_real_escape_string($conn, $category);

    $where .= " AND category_id = (
        SELECT id FROM categories WHERE slug = '$slug' LIMIT 1
    )";
}

/* PRICE FILTER */
if ($min !== '' && is_numeric($min)) {
    $where .= " AND price >= " . (float)$min;
}

if ($max !== '' && is_numeric($max)) {
    $where .= " AND price <= " . (float)$max;
}

$q = mysqli_query($conn, "SELECT * FROM products $where ORDER BY id DESC");

if (mysqli_num_rows($q) === 0) {
    echo "<p class='no-products'>No products found.</p>";
    exit;
}

while ($p = mysqli_fetch_assoc($q)) {
?>
<div class="product-card">
    <a href="<?php echo $base_url; ?>product.php?id=<?php echo $p['id']; ?>">
    <div class="product-image">
        <img src="<?php echo $base_url; ?>assets/images/products/<?php echo $p['image']; ?>">
    </div>
    </a>
    <h4><?php echo htmlspecialchars($p['name']); ?></h4>
    <p class="price">₹<?php echo number_format($p['price'],2); ?></p>
        <a 
    href="<?php echo $base_url; ?>product.php?id=<?php echo $product['id']; ?>" 
    class="btn">
    View Product</a>
</div>
<?php } ?>
