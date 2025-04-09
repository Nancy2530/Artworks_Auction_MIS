<?php
/*
 *
 *   1. LICENSE TO BE AWESOME
 *   Congrats, you lucky human! Devlan Solutions LTD hereby bestows upon you the magical,
 *   revocable, personal, non-exclusive, and totally non-transferable right to install this epic system
 *   on not one, but TWO separate computers for your personal, non-commercial shenanigans.
 *   Unless, of course, you've leveled up with a commercial license from Devlan Solutions LTD.
 *   Sharing this software with others or letting them even peek at it? Nope, that's a big no-no.
 *   And don't even think about putting this on a network or letting a crowd join the fun unless you
 *   first scored a multi-user license from us. Sharing is caring, but rules are rules!
 *
 *   2. COPYRIGHT POWER-UP
 *   This Software is the prized possession of Devlan Solutions LTD and is shielded by copyright law
 *   and the forces of international copyright treaties. You better not try to hide or mess with
 *   any of our awesome proprietary notices, labels, or marks. Respect the swag!
 *
 *
 *   3. RESTRICTIONS, NO CHEAT CODES ALLOWED
 *   You may not, and you shall not let anyone else:
 *   (a) reverse engineer, decompile, decode, decrypt, disassemble, or do any sneaky stuff to
 *   figure out the source code of this software;
 *   (b) modify, remix, distribute, or create your own funky version of this masterpiece;
 *   (c) copy (except for that one precious backup), distribute, show off in public, transmit, sell, rent,
 *   lease, or otherwise exploit the Software like it's your own.
 *
 *
 *   4. THE ENDGAME
 *   This License lasts until one of us says 'Game Over'. You can call it quits anytime by
 *   destroying the Software and all the copies you made (no hiding them under your bed).
 *   If you break any of these sacred rules, this License self-destructs, and you must obliterate
 *   every copy of the Software, no questions asked.
 *
 *
 *   5. NO GUARANTEES, JUST PIXELS
 *   DEVLAN SOLUTIONS LTD doesn’t guarantee this Software is flawless—it might have a few
 *   quirks, but who doesn’t? DEVLAN SOLUTIONS LTD washes its hands of any other warranties,
 *   implied or otherwise. That means no promises of perfect performance, marketability, or
 *   non-infringement. Some places have different rules, so you might have extra rights, but don’t
 *   count on us for backup if things go sideways. Use at your own risk, brave adventurer!
 *
 *
 *   6. SEVERABILITY—KEEP THE GOOD STUFF
 *   If any part of this License gets tossed out by a judge, don’t worry—the rest of the agreement
 *   still stands like a boss. Just because one piece fails doesn’t mean the whole thing crumbles.
 *
 *
 *   7. NO DAMAGE, NO DRAMA
 *   Under no circumstances will Devlan Solutions LTD or its squad be held responsible for any wild,
 *   indirect, or accidental chaos that might come from using this software—even if we warned you!
 *   And if you ever think you’ve got a claim, the most you’re getting out of us is the license fee you
 *   paid—if any. No drama, no big payouts, just pixels and code.
 *
 */

session_start();
require_once('../app/settings/config.php');
require_once('../app/partials/landing_head.php');
?>

<body class="shop_page">
    <div id="ec-overlay"><span class="loader_img"></span></div>

    <!-- Header start  -->
    <?php require_once('../app/partials/landing_navigation.php'); ?>
    <!-- Header End  -->



    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Products Under <?php echo $_GET['name']; ?></h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="../">Home</a></li>
                                <li class="ec-breadcrumb-item"><a href="">Categories</a></li>
                                <li class="ec-breadcrumb-item active">Products</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Shop page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-shop-rightside col-lg-12 order-lg-last col-md-12 order-md-first margin-b-30">
                    <!-- Shop Top Start -->
                    <div class="ec-pro-list-top d-flex">
                        <div class="col-md-6 ec-grid-list">
                            <div class="ec-gl-btn">
                                <button class="btn btn-grid active"><img src="../public/landing_assets/images/icons/grid.svg" class="svg_img gl_svg" alt="" /></button>
                                <button class="btn btn-list"><img src="../public/landing_assets/images/icons/list.svg" class="svg_img gl_svg" alt="" /></button>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Top End -->

                    <!-- Shop content Start -->
                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                            <div class="row">
                                <?php
                                $category_id = mysqli_real_escape_string($mysqli, $_GET['category']);
                                $products_sql = mysqli_query(
                                    $mysqli,
                                    "SELECT * FROM products p
                                    INNER JOIN users u ON u.user_id = p.product_seller_id
                                    INNER JOIN categories c ON c.category_id = p.product_category_id
                                    WHERE u.user_delete_status = '0' 
                                    AND c.category_delete_status = '0'
                                    AND p.product_delete_status = '0'
                                    AND c.category_id = '{$category_id}'
                                    "
                                );
                                if (mysqli_num_rows($products_sql) > 0) {
                                    while ($products = mysqli_fetch_array($products_sql)) {
                                        /* Image Directory */
                                        if ($products['product_image'] == '') {
                                            $image_dir = "../public/uploads/products/no_image.png";
                                        } else {
                                            $image_dir = "../public/uploads/products/" . $products['product_image'];
                                        }
                                        /* Only show available artworks */
                                        $availability = strtotime($products['product_available_from']);
                                        /* Show Available Artowkrs */
                                        if ($current_time >= $availability) {
                                ?>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                                <div class="ec-product-inner">
                                                    <div class="ec-pro-image-outer">
                                                        <div class="ec-pro-image">
                                                            <a href="landing_product?view=<?php echo $products['product_id']; ?>&category=<?php echo $products['category_id']; ?>" class="image">
                                                                <img class="main-image" src="<?php echo $image_dir; ?>" alt="Product" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ec-pro-content">
                                                        <h5 class="ec-pro-title">
                                                            <a href="landing_product?view=<?php echo $products['product_id']; ?>&category=<?php echo $products['category_id']; ?>" class="image">
                                                                <?php echo $products['product_name']; ?>
                                                            </a>
                                                        </h5>
                                                        <div class="ec-pro-list-desc">
                                                            <?php echo $products['product_details']; ?>
                                                        </div>
                                                        <span class="ec-price">
                                                            <span class="new-price">Ksh <?php echo number_format($products['product_price'], 2); ?></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    }
                                } else { ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="" class="image">
                                                        <img class="main-image" src="../public/uploads/products/no_image.png" alt="Product" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title">
                                                    No available artworks for the moment
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!--Shop content End -->
                </div>

            </div>
        </div>
    </section>
    <!-- End Shop page -->

    <!-- Footer Start -->
    <?php require_once('../app/partials/landing_footer.php'); ?>
    <!-- Footer Area End -->

    <!-- Vendor JS -->
    <?php require_once('../app/partials/landing_scripts.php'); ?>

</body>


</html>
