<?php
$base_url = "http://localhost/forencart/";
?>
<?php
$categoryIcons = [
    'electronics' => 'fa-laptop',
    'mobiles' => 'fa-mobile-screen',
    'laptops' => 'fa-laptop-code',
    'fashion' => 'fa-shirt',
    'men' => 'fa-user-tie',
    'women' => 'fa-person-dress',
    'home-kitchen' => 'fa-kitchen-set',
    'books' => 'fa-book',
    'beauty' => 'fa-spa',
    'sports' => 'fa-dumbbell',
    'toys' => 'fa-puzzle-piece'
];
?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/navbar.css">

<header class="main-header">

    <div class="top-bar">
        <div class="container-fluid">
            <div class="top-left">
                Default welcome msg! 
                <a href="#">Register</a> or <a href="#">Login</a>
            </div>

            <div class="top-right">
                <ul>
                    <li><a href="#">Login</a></li>
                    <li class="has-small-dropdown">
                        <a href="#">My Account <i class="fa-solid fa-angle-down"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="middle-bar">
        <div class="container-fluid">

            <div class="logo">
                <a href="<?php echo $base_url; ?>" style="text-decoration: none;">
                    <h1>Foren<span>Cart</span></h1>
                    <small>Shop all you want</small>
                </a>
            </div>

            <form class="search-box" method="get" action="#">
                <div class="search-category">
                    <select name="category">
                        <option>All Categories</option>
                        <option>Electronics</option>
                        <option>Fashion</option>
                    </select>
                </div>
                <input type="text" name="s" placeholder="Search...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <div class="contact-info">
                <div class="icon-circle">
                    <i class="fa-solid fa-headphones"></i>
                </div>
                <div class="contact-text">
                    <span class="label">Call Us Now: <span class="highlight">+123-456-789</span></span>
                    <span class="email">Email: contact@forencart.com</span>
                </div>
            </div>

        </div>
    </div>

    <nav class="bottom-nav">
        <div class="container-fluid no-padding">

            <div class="all-departments">
    <i class="fa-solid fa-bars"></i> ALL DEPARTMENTS

                <div class="departments-dropdown">

                    <?php
                    // Main categories
                    $mainCats = mysqli_query($conn, "
                        SELECT * FROM categories 
                        WHERE parent_id IS NULL AND status = 1
                        ORDER BY name ASC
                    ");

                    while ($cat = mysqli_fetch_assoc($mainCats)) {

                        $icon = $categoryIcons[$cat['slug']] ?? 'fa-folder';

                        // Fetch subcategories
                        $subCats = mysqli_query($conn, "
                            SELECT * FROM categories 
                            WHERE parent_id = {$cat['id']} AND status = 1
                        ");
                    ?>

                    <div class="dept-item">

                        <a href="<?php echo $base_url; ?>shop.php?category=<?php echo $cat['slug']; ?>">
                            <i class="fa-solid <?php echo $icon; ?>"></i>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </a>

                        <?php if (mysqli_num_rows($subCats) > 0) { ?>
                            <div class="sub-departments">
                                <?php while ($sub = mysqli_fetch_assoc($subCats)) { ?>
                                    <a href="<?php echo $base_url; ?>shop.php?category=<?php echo $sub['slug']; ?>">
                                        <?php echo htmlspecialchars($sub['name']); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>

                    </div>

                    <?php } ?>

                </div>
            </div>


            <ul class="nav-links">
                <li><a href="<?php echo $base_url; ?>">HOME</a></li>
                <li><a href="<?php echo $base_url; ?>shop.php">SHOP</a></li>
                <li><a href="<?php echo $base_url; ?>shop.php?type=new">NEW ARRIVALS</a></li>
                <li><a href="<?php echo $base_url; ?>shop.php?type=best">BEST SELLERS</a></li>
                <li><a href="<?php echo $base_url; ?>shop.php?type=best">OFFERS</a></li>
                <li><a href="<?php echo $base_url; ?>blog.php">BLOG</a></li>
                <li><a href="<?php echo $base_url; ?>contact.php">CONTACT</a></li>
               
            </ul>

            <div class="nav-icons">
                <a href="#"><i class="fa-regular fa-heart"></i></a>
                <a href="#"><i class="fa-solid fa-arrows-rotate"></i></a>
                <a href="#" class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="count">0</span>
                </a>
                <a href="javascript:void(0);" class="mobile-toggle"><i class="fa-solid fa-bars"></i></a>
            </div>

        </div>
    </nav>

</header>