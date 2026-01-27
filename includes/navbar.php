<?php
$base_url = "http://localhost/forencart/";
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
                    <li class="has-small-dropdown">
                        <a href="#">English <i class="fa-solid fa-angle-down"></i></a>
                    </li>
                    <li class="has-small-dropdown">
                        <a href="#">$ US Dollar <i class="fa-solid fa-angle-down"></i></a>
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
                    <a href="#"><i class="fa-solid fa-laptop"></i> Electronics</a>
                    <a href="#"><i class="fa-solid fa-shirt"></i> Fashion</a>
                    <a href="#"><i class="fa-solid fa-mobile-screen"></i> Mobiles</a>
                    <a href="#"><i class="fa-solid fa-kitchen-set"></i> Home & Kitchen</a>
                </div>
            </div>

            <ul class="nav-links">
                <li><a href="<?php echo $base_url; ?>">HOME</a></li>
                <li>
                    <a href="#">FEATURES <span class="badge blue">NEW</span> <i class="fa-solid fa-angle-down"></i></a>
                </li>
                <li class="has-dropdown">
                    <a href="#">PAGES <i class="fa-solid fa-angle-down"></i></a>
                    <!-- <ul class="dropdown-menu">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul> -->
                </li>
                <li>
                    <a href="#">CATEGORIES <span class="badge orange">HOT</span> <i class="fa-solid fa-angle-down"></i></a>
                </li>
                <li><a href="#">ACCESSORIES</a></li>
                <li><a href="#">BLOG</a></li>
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