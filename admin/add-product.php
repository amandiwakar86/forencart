<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/includes/admin-header.php";
// Fetch categories
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY name ASC");

if (isset($_POST['save_product'])) {

    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $category_id = $_POST['category_id'];
    $price       = $_POST['price'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Image upload
    $image_name = "";
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../assets/images/products/" . $image_name
        );
    }

    mysqli_query($conn, "
        INSERT INTO products (category_id, name, price, description, image)
        VALUES ('$category_id', '$name', '$price', '$description', '$image_name')
    ");

    header("Location: products.php");
    exit;
}
?>

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/admin-product.css">

<main class="admin-content">

    <h1>Add Product</h1>

    <form method="post" enctype="multipart/form-data" class="product-form">

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?php echo $cat['id']; ?>">
                        <?php echo $cat['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Price (₹)</label>
            <input type="number" name="price" step="0.01" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label>Product Image</label>
            <input type="file" name="image" required>
        </div>

        <button type="submit" name="save_product" class="admin-btn">
            Save Product
        </button>

    </form>

</main>

</div>
</body>
</html>
