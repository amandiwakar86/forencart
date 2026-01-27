<?php
include 'includes/admin-header.php';
include 'includes/admin-sidebar.php';

$id = $_GET['id'] ?? 0;

// Fetch banner
$banner = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM banners WHERE id = $id")
);

if (!$banner) {
    echo "<p>Banner not found</p>";
    exit;
}

if (isset($_POST['update'])) {

    $title       = mysqli_real_escape_string($conn, $_POST['title']);
    $subtitle    = mysqli_real_escape_string($conn, $_POST['subtitle']);
    $button_text = mysqli_real_escape_string($conn, $_POST['button_text']);
    $button_link = mysqli_real_escape_string($conn, $_POST['button_link']);
    $is_active   = isset($_POST['is_active']) ? 1 : 0;

    $image = $banner['image'];

    // Image replace
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../assets/images/hero/" . $image
        );
    }

    mysqli_query($conn, "
        UPDATE banners SET
        title='$title',
        subtitle='$subtitle',
        button_text='$button_text',
        button_link='$button_link',
        image='$image',
        is_active=$is_active
        WHERE id=$id
    ");

    header("Location: banners.php");
    exit;
}
?>

<main class="admin-content">
<h1>Edit Banner</h1>

<form method="post" enctype="multipart/form-data" class="admin-form">

    <label>Title</label>
    <input type="text" name="title" value="<?php echo $banner['title']; ?>" required>

    <label>Subtitle</label>
    <input type="text" name="subtitle" value="<?php echo $banner['subtitle']; ?>">

    <label>Button Text</label>
    <input type="text" name="button_text" value="<?php echo $banner['button_text']; ?>">

    <label>Button Link</label>
    <input type="text" name="button_link" value="<?php echo $banner['button_link']; ?>">

    <label>Current Image</label><br>
    <img src="<?php echo $base_url; ?>assets/images/hero/<?php echo $banner['image']; ?>"
         class="banner-thumb"><br><br>

    <label>Replace Image</label>
    <input type="file" name="image">

    <label>
        <input type="checkbox" name="is_active" <?php if ($banner['is_active']) echo 'checked'; ?>>
        Active
    </label>

    <button type="submit" name="update" class="admin-btn">Update Banner</button>
    <a href="banners.php" class="admin-btn secondary">Cancel</a>

</form>
</main>

</div>
</body>
</html>
