<?php
// Load header (config + db + session + <head>)
include_once 'includes/header.php';

// Load navigation bar
include_once 'includes/navbar.php';
?>

<main class="container">

<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/hero.css">

<?php include 'includes/hero.php'; 
include 'includes/categories-section.php';
include 'includes/featured-products.php';
include 'includes/why-us.php';

?>

<script src="<?php echo $base_url; ?>assets/js/hero.js"></script>
</main>

<?php
// Load footer (if created later)
include_once 'includes/footer.php';
?>
