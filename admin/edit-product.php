<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/includes/admin-header.php";
if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit;
}

$id = (int)$_GET['id'];

$product = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM products WHERE id = $id")
);

$categories = mysqli_query($conn, "SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $price = (float) $_POST['price'];
    $cat   = (int) $_POST['category_id'];

    // IMAGE UPDATE
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../assets/images/products/$image"
        );

        mysqli_query($conn, "
            UPDATE products 
            SET name='$name',
                price='$price',
                category_id='$cat',
                image='$image'
            WHERE id=$id
        ");
    } else {
        mysqli_query($conn, "
            UPDATE products 
            SET name='$name',
                price='$price',
                category_id='$cat'
            WHERE id=$id
        ");
    }

    header("Location: products.php");
    exit;
}
?>

<main class="admin-content">

    <h1>Edit Product</h1>

    <form method="post" enctype="multipart/form-data" class="admin-form">

        <label>Product Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label>Price</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>

        <label>Category</label>
        <select name="category_id" required>
            <?php while ($c = mysqli_fetch_assoc($categories)) { ?>
                <option value="<?php echo $c['id']; ?>"
                    <?php if ($product['category_id'] == $c['id']) echo 'selected'; ?>
                >
                    <?php echo $c['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Change Image (optional)</label>
        <input type="file" name="image">

        <div class="form-group">
            <label>Product Tags</label>
            <input 
                type="text" 
                name="tags" 
                placeholder="e.g. clothes, fashion, shirt, men"
                class="form-control"
            >
            <small>Comma separated keywords</small>
        </div>


        <button type="submit">Update Product</button>

    </form>

</main>

</body>
</html>
