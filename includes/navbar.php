<?php
$base_url = "http://localhost/forencart/";

$categoryIcons = [
    'electronics'   => 'fa-laptop',
    'mobiles'       => 'fa-mobile-screen',
    'laptops'       => 'fa-laptop-code',
    'fashion'       => 'fa-shirt',
    'men'           => 'fa-user-tie',
    'women'         => 'fa-person-dress',
    'home-kitchen'  => 'fa-kitchen-set',
    'books'         => 'fa-book',
    'beauty'        => 'fa-spa',
    'sports'        => 'fa-dumbbell',
    'toys'          => 'fa-puzzle-piece'
];
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/navbar.css">

<header class="main-header">

            <!-- ================= TOP BAR ================= -->
            <div class="top-bar">
            <div class="container-fluid">
                
                 <!-- LEFT SIDE -->
            <div class="top-left">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>
                <?php } else { ?>
                    Default welcome msg!
                    <a href="<?php echo $base_url; ?>auth/register.php">Register</a>
                    or
                    <a href="<?php echo $base_url; ?>auth/login.php">Login</a>
                <?php } ?>
            </div>

                <!-- RIGHT SIDE -->
            <div class="top-right">
                <ul>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <li>
                            <a href="<?php echo $base_url; ?>account.php">My Account</a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>auth/logout.php">Logout</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo $base_url; ?>auth/login.php">Login</a>
                        </li>
                        <li>
                            <a href="<?php echo $base_url; ?>auth/register.php">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            </div>
        </div>


    <!-- ================= MIDDLE BAR ================= -->
    <div class="middle-bar">
        <div class="container-fluid">

            <div class="logo">
                <a href="<?php echo $base_url; ?>" style="text-decoration:none;">
                    <h1>Foren<span>Cart</span></h1>
                    <small>Shop all you want</small>
                </a>
            </div>
            <form class="search-box" method="get" action="<?php echo $base_url; ?>shop.php">
                <input type="text" name="q" placeholder="Search products..." required>
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>


            <div class="contact-info">
                <div class="icon-circle">
                    <i class="fa-solid fa-headphones"></i>
                </div>
                <div class="contact-text">
                    <span class="label">
                        Call Us Now: <span class="highlight">+123-456-789</span>
                    </span>
                    <span class="email">Email: contact@forencart.com</span>
                </div>
            </div>

        </div>
    </div>

    <!-- ================= NAV BAR ================= -->
    <nav class="bottom-nav">
        <div class="container-fluid no-padding">

            <!-- ===== ALL DEPARTMENTS ===== -->
            <div class="all-departments">
                <i class="fa-solid fa-bars"></i> ALL DEPARTMENTS

                <div class="departments-dropdown">
                    <?php
                    $mainCats = mysqli_query($conn, "
                        SELECT * FROM categories 
                        WHERE parent_id IS NULL AND status = 1
                        ORDER BY name ASC
                    ");

                    while ($cat = mysqli_fetch_assoc($mainCats)) {

                        $icon = $categoryIcons[$cat['slug']] ?? 'fa-folder';

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

            <!-- ===== MAIN MENU ===== -->
            <ul class="nav-links">
                <li><a href="<?php echo $base_url; ?>">HOME</a></li>
                <li><a href="<?php echo $base_url; ?>shop.php">SHOP</a></li>
                <li><a href="<?php echo $base_url; ?>shop.php">NEW ARRIVALS</a></li>
                <li><a href="<?php echo $base_url; ?>shop.php">BEST SELLERS</a></li>
                <li><a href="<?php echo $base_url; ?>shop.php">OFFERS</a></li>
                <li><a href="<?php echo $base_url; ?>blog.php">BLOG</a></li>
                <li><a href="<?php echo $base_url; ?>contact.php">CONTACT</a></li>
            </ul>

            <!-- ===== ICONS ===== -->
            <div class="nav-icons">
                <a href="#"><i class="fa-regular fa-heart"></i></a>
                <a href="#"><i class="fa-solid fa-arrows-rotate"></i></a>
                <a href="<?php echo $base_url; ?>cart.php" class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="count">0</span>
                </a>
            </div>

        </div>
    </nav>

</header>
