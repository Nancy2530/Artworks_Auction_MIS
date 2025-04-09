<?php
/*
 *   Crafted On Sat Mar 01 2025
 *   From his finger tips, through his IDE to your deployment environment at full throttle with no bugs, loss of data,
 *   fluctuations, signal interference, or doubt—it can only be
 *   the legendary coding wizard, Martin Mbithi (martin@devlan.co.ke, www.martmbithi.github.io)
 *   
 *   www.devlan.co.ke
 *   hello@devlan.co.ke
 *
 *
 *   The Devlan Solutions LTD Super Duper User License Agreement
 *   Copyright (c) 2022 Devlan Solutions LTD
 *
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
require_once('../app/settings/codeGen.php');
require_once('../app/settings/checklogin.php');
checklogin();
require_once('../app/helpers/orders.php');
require_once('../app/partials/backoffice_head.php');
/* Load This Page With Variable From GET Function */
$get_id = mysqli_real_escape_string($mysqli, $_GET['view']);
$product_sql = mysqli_query(
    $mysqli,
    "SELECT * FROM orders o  
    INNER JOIN products p ON p.product_id = o.order_product_id
    INNER JOIN users u ON u.user_id = o.order_user_id
    INNER JOIN categories c ON c.category_id = p.product_category_id
    WHERE u.user_delete_status = '0' 
    AND c.category_delete_status = '0'
    AND p.product_delete_status = '0'
    AND o.order_delete_status = '0' 
    AND o.order_code = '{$get_id}'
    GROUP BY o.order_code"
);
if (mysqli_num_rows($product_sql) > 0) {
    while ($product = mysqli_fetch_array($product_sql)) {

?>

        <body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-dark ec-header-light" id="body">

            <!-- WRAPPER -->
            <div class="wrapper">

                <!-- LEFT MAIN SIDEBAR -->
                <?php require_once('../app/partials/backoffice_sidebar.php'); ?>

                <!-- PAGE WRAPPER -->
                <div class="ec-page-wrapper">

                    <!-- Header -->
                    <?php require_once('../app/partials/backoffice_header.php'); ?>

                    <!-- CONTENT WRAPPER -->
                    <div class="ec-content-wrapper">
                        <div class="content">
                            <div class="breadcrumb-wrapper breadcrumb-contacts">
                                <div>
                                    <h1>
                                        <?php echo $product['order_code']; ?> Details
                                    </h1>
                                    <?php
                                    if ($product['order_status'] == 'Placed Orders') { ?>
                                        <span class="badge badge-warning">Bid Placed</span>
                                    <?php } else if ($product['order_status'] == 'Awaiting Fullfilment') { ?>
                                        <span class="badge badge-warning">Awaiting Fulfillment</span>
                                    <?php } else if ($product['order_status'] == 'Shipped') { ?>
                                        <span class="badge badge-primary">Shipped</span>
                                    <?php } else if ($product['order_status'] == 'Out For Delivery') { ?>
                                        <span class="badge badge-primary">Out For Delivery</span>
                                    <?php } else if ($product['order_status'] == 'Delivered') { ?>
                                        <span class="badge badge-success">Delivered</span>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">Cancelled</span>
                                    <?php } ?>
                                    <p class="breadcrumbs">
                                        <span><a href="dashboard">Home</a></span>
                                        <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_manage_orders">Bids</a>
                                        <span><i class="mdi mdi-chevron-right"></i></span><a href="backoffice_manage_orders">Manage Bids</a>
                                        <span><i class="mdi mdi-chevron-right"></i><?php echo $product['order_code']; ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="card bg-white profile-content">
                                <div class="row">
                                    <div class="col-lg-4 col-xl-4">
                                        <div class="profile-content-left profile-left-spacing">
                                            <div class="contact-info pt-4">
                                                <h5 class="text-dark">Customer Information</h5>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Names</p>
                                                <p><?php echo $product['user_first_name'] . ' ' . $product['user_last_name']; ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Email Address</p>
                                                <p><?php echo $product['user_email']; ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Phone Number</p>
                                                <p><?php echo $product['user_phone_number']; ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Birthday</p>
                                                <p><?php echo date('M, d Y', strtotime($product['user_dob'])); ?></p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">Delivery Address</p>
                                                <p><?php echo $product['user_default_address']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-xl-8">
                                        <div class="profile-content-right profile-right-spacing py-5">
                                            <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Items In The Bid Details</button>
                                                </li>

                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Payment History</button>
                                                </li>

                                            </ul>
                                            <div class="tab-content px-3 px-xl-5" id="myTabContent">

                                                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                                                    <div class="tab-pane-content mt-5">
                                                        <table class="table ec-table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Item SKU</th>
                                                                    <th scope="col">Item Name</th>
                                                                    <th scope="col">Item QTY</th>
                                                                    <th scope="col">Item Cost</th>
                                                                    <th scope="col">Total Cost</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $total_quantity = 0;
                                                                $total_price = 0;
                                                                $orders_sql = mysqli_query(
                                                                    $mysqli,
                                                                    "SELECT * FROM orders o  
                                                                    INNER JOIN products p ON p.product_id = o.order_product_id
                                                                    INNER JOIN users u ON u.user_id = o.order_user_id
                                                                    INNER JOIN categories c ON c.category_id = p.product_category_id
                                                                    WHERE u.user_delete_status = '0' 
                                                                    AND c.category_delete_status = '0'
                                                                    AND p.product_delete_status = '0'
                                                                    AND o.order_delete_status = '0'
                                                                    AND o.order_code = '{$get_id}'"
                                                                );
                                                                if (mysqli_num_rows($orders_sql) > 0) {
                                                                    while ($orders = mysqli_fetch_array($orders_sql)) {
                                                                        /* Sum Number Of Items In The Order */
                                                                        $query = "SELECT COUNT(*)  FROM orders WHERE order_code = '{$orders['order_code']}'";
                                                                        $stmt = $mysqli->prepare($query);
                                                                        $stmt->execute();
                                                                        $stmt->bind_result($items_in_my_order);
                                                                        $stmt->fetch();
                                                                        $stmt->close();
                                                                        /* Compute Quantity And Amount Supposed To Be Paid */
                                                                        $total_quantity += $orders["order_qty"];
                                                                        $total_price += $orders['order_cost'] * $orders['order_qty'];
                                                                        /* DeliverY Fee */
                                                                        $constant_delivery_fee = '1500';
                                                                ?>
                                                                        <tr>
                                                                            <td><span><?php echo $orders['product_sku_code']; ?></span></td>
                                                                            <td><span><?php echo $orders['product_name']; ?></span></td>
                                                                            <td><span><?php echo $orders['order_qty']; ?></span></td>
                                                                            <td><span>Ksh <?php echo number_format($orders['order_cost'], 2); ?></span></td>
                                                                            <td><span>Ksh <?php echo number_format(($orders['order_cost'] * $orders['order_qty']), 2); ?></span></td>
                                                                        </tr>

                                                                    <?php  } ?>
                                                                    <tr>
                                                                        <td data-label="Product" class="ec-cart-pro-name">
                                                                            <b>Sub Total Payable Amount</b>
                                                                        </td>
                                                                        <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                                        <td data-label="Price" class="ec-cart-pro-price"><span class="amount"><?php echo $total_quantity; ?></span></td>
                                                                        <td data-label="Price" class="ec-cart-pro-price text-center"><span class="amount"></span></td>
                                                                        <td data-label="Total" class="ec-cart-pro-subtotal">Ksh <?php echo number_format($total_price, 2); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td data-label="Product" class="ec-cart-pro-name">
                                                                            <b>Delivery Fee</b>
                                                                        </td>
                                                                        <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                                        <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                                        <td data-label="Price" class="ec-cart-pro-price text-center"><span class="amount"></span></td>
                                                                        <td data-label="Total" class="ec-cart-pro-subtotal">Ksh <?php echo number_format($constant_delivery_fee, 2); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td data-label="Product" class="ec-cart-pro-name">
                                                                            <b>Total Payable Amount</b>
                                                                        </td>
                                                                        <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                                        <td data-label="Price" class="ec-cart-pro-price"><span class="amount"></span></td>
                                                                        <td data-label="Price" class="ec-cart-pro-price text-center"><span class="amount"></span></td>
                                                                        <td data-label="Total" class="ec-cart-pro-subtotal">Ksh <?php echo number_format(($total_price + $constant_delivery_fee), 2); ?></td>
                                                                    </tr>

                                                                <?php } else { ?>
                                                                    <tr>
                                                                        <th scope="row">No Items In Your Bid</th>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="nav-home" role="tabpanel">
                                                    <div class="tab-pane-content mt-5">
                                                        <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Payment REF</th>
                                                                    <th>Payment Amount</th>
                                                                    <th class="d-none d-lg-table-cell">Payment Date</th>
                                                                    <th class="d-none d-lg-table-cell">Payment Means</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                /* Fetch All Orders Made To This Product - Sort Them By Date Added */
                                                                $payments_sql = mysqli_query(
                                                                    $mysqli,
                                                                    "SELECT * FROM payments p
                                                                    INNER JOIN orders o ON order_code = p.payment_order_code
                                                                    INNER JOIN payment_means pm ON pm.means_id = p.payment_means_id
                                                                    WHERE p.payment_order_code = '{$get_id}'
                                                                    AND p.payment_delete_status = '0'
                                                                    GROUP BY p.payment_order_code"
                                                                );
                                                                if (mysqli_num_rows($payments_sql) > 0) {
                                                                    while ($payment = mysqli_fetch_array($payments_sql)) {
                                                                ?>
                                                                        <tr>
                                                                            <td><?php echo $payment['payment_ref_code']; ?></td>
                                                                            <td class="d-none d-lg-table-cell">Ksh <?php echo number_format($payment['payment_amount']); ?></td>
                                                                            <td class="d-none d-lg-table-cell"><?php echo date('M, d Y', strtotime($payment['payment_date'])); ?></td>
                                                                            <td class="d-none d-lg-table-cell"><?php echo $payment['means_code'] . ' ' . $payment['means_name']; ?></td>
                                                                        </tr>
                                                                    <?php }
                                                                } else {
                                                                    /* No Payments To Fetch */ ?>
                                                                    <tr>
                                                                        <td colspan="6" class="text-center">
                                                                            <span class="text-danger">There are no current orders payments posted.</span><br>
                                                                            <span class="text-center">
                                                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#mark_as_paid">Add Payment</button>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                <?php
                                                                    include('../app/modals/mark_as_paid_modal.php');
                                                                } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End Content -->
                    </div> <!-- End Content Wrapper -->

                    <!-- Footer -->
                    <?php require_once('../app/partials/backoffice_footer.php'); ?>

                </div> <!-- End Page Wrapper -->
            </div>
            <!-- End Wrapper -->

            <?php require_once('../app/partials/backoffice_scripts.php'); ?>

        </body>

        </html>
<?php
    }
} else {
    /* LOad 404 Page */
    include('error_404.php');
} ?>