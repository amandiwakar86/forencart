<?php
require_once '../includes/db.php';

$category = $_POST['category'] ?? '';
$min      = $_POST['min'] ?? '';
$max      = $_POST['max'] ?? '';
$page     = $_POST['page'] ?? 1;

$limit  = 12;
$offset = ($page - 1) * $limit;

$where = "WHERE products.status = 1";

if (!empty($category)) {
    $slug = mysqli_real_escape_string($conn, $category);
    $where .= " AND products.category_id IN (
        SELECT id FROM categories 
        WHERE slug = '$slug'
        OR parent_id = (
            SELECT id FROM categories WHERE slug = '$slug'
        )
    )";
}

if ($min !== '') {
    $where .= " AND products.price >= " . (float)$min;
}

if ($max !== '') {
    $where .= " AND products.price <= " . (float)$max;
}

$query = mysqli_query($conn, "
    SELECT products.*, categories.name AS category_name
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    $where
    ORDER BY products.id DESC
    LIMIT $limit OFFSET $offset
");

if (mysqli_num_rows($query) === 0) {
    echo "<p class='no-products'>No products found.</p>";
    exit;
}

while ($p = mysqli_fetch_assoc($query)) {
?>
    <div class="product-card">
        <a href="product.php?id=<?php echo $p['id']; ?>">
            <img src="assets/images/products/<?php echo $p['image'] ?: 'placeholder.png'; ?>">
        </a>

        <div class="product-info">
            <h4><?php echo htmlspecialchars($p['name']); ?></h4>
            <p class="price">₹<?php echo number_format($p['price'],2); ?></p>
            <a href="product.php?id=<?php echo $p['id']; ?>" class="view-btn">
                View Product
            </a>
        </div>
    </div>
<?php } ?>
