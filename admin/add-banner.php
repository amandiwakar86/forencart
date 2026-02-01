<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/includes/admin-header.php";

if (isset($_POST['save_banner'])) {

    $title       = mysqli_real_escape_string($conn, $_POST['title']);
    $subtitle    = mysqli_real_escape_string($conn, $_POST['subtitle']);
    $button_text = mysqli_real_escape_string($conn, $_POST['button_text']);
    $button_link = mysqli_real_escape_string($conn, $_POST['button_link']);
    $is_active   = isset($_POST['is_active']) ? 1 : 0;

    $image = "";

    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../assets/images/hero/" . $image
        );
    }

    mysqli_query($conn, "
        INSERT INTO banners 
        (title, subtitle, button_text, button_link, image, is_active)
        VALUES 
        ('$title', '$subtitle', '$button_text', '$button_link', '$image', '$is_active')
    ");

    header("Location: banners.php");
    exit;
}
?>

<main class="admin-content">

    <h1>Add New Banner</h1>
    <p class="subtitle">Create a hero banner for homepage slider</p>

    <form method="post" enctype="multipart/form-data" class="admin-form">

        <div class="form-row">
            <div class="form-group">
                <label>Banner Title</label>
                <input type="text" name="title" placeholder="Big headline text" required>
            </div>

            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" name="subtitle" placeholder="Short supporting text">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Button Text</label>
                <input type="text" name="button_text" placeholder="Shop Now">
            </div>

            <div class="form-group">
                <label>Button Link</label>
                <input type="text" name="button_link" placeholder="/shop.php">
            </div>
        </div>

        <div class="form-group">
            <label>Banner Image</label>
            <input type="file" name="image" required>
            <small>Recommended size: 1200 × 450 px</small>
        </div>

        <div class="form-group checkbox">
            <label>
                <input type="checkbox" name="is_active" checked>
                Activate banner immediately
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" name="save_banner" class="admin-btn">
                Save Banner
            </button>

            <a href="banners.php" class="admin-btn secondary">
                Cancel
            </a>
        </div>

    </form>

</main>

</div>
</body>
</html>
