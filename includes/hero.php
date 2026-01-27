<?php
$banners = mysqli_query(
    $conn,
    "SELECT * FROM banners WHERE is_active = 1 ORDER BY id DESC"
);
?>

<section class="hero-slider">

    <div class="slides">

        <?php $i = 0; while ($banner = mysqli_fetch_assoc($banners)) { ?>
            <div class="slide <?php echo $i === 0 ? 'active' : ''; ?>"
                 style="background-image: url('<?php echo $base_url; ?>assets/images/hero/<?php echo $banner['image']; ?>');">

                <div class="overlay"></div>

                <div class="slide-content">
                    <h1><?php echo htmlspecialchars($banner['title']); ?></h1>
                    <p><?php echo htmlspecialchars($banner['subtitle']); ?></p>

                    <?php if (!empty($banner['button_text'])) { ?>
                        <a href="<?php echo $banner['button_link']; ?>" class="hero-btn">
                            <?php echo htmlspecialchars($banner['button_text']); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php $i++; } ?>

    </div>

    <!-- DOTS -->
    <div class="hero-dots">
        <?php for ($d = 0; $d < $i; $d++) { ?>
            <span class="dot <?php echo $d === 0 ? 'active' : ''; ?>"></span>
        <?php } ?>
    </div>

</section>
