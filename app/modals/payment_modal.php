<!-- Add User Modal  -->
<div class="modal fade modal-add-contact" id="checkout_modal_<?php echo $order_code; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pay Ksh <?php echo number_format(($total_price + $constant_delivery_fee), 2); ?></h5>
                </div>

                <div class="modal-body px-4">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="firstName">Pay your order with:</label>
                                <input type="hidden" name="payment_order_code" value="<?php echo $order_code; ?>">
                                <input type="hidden" name="bid_id" value="<?php echo $_GET['view']; ?>">
                                <input type="hidden" name="payment_amount" value="<?php echo ($total_price + $constant_delivery_fee); ?>">
                                <input type="hidden" name="payment_ref_code" value="<?php echo $paycode; ?>">
                                <input type="hidden" name="user_email" value="<?php echo $_SESSION['user_email']; ?>">
                                <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
                                <input type="hidden" name="user_contacts" value="<?php echo $user_contacts; ?>">
                                <input type="hidden" name="payment_method_name" id="PaymentMethodName">
                                <select name="payment_means_id" class="form-control" id="PaymentMeansID" onchange="GetPaymentMeansName(this.value)">
                                    <option>Select Method</option>
                                    <?php
                                    /* Select Payment Method */
                                    $payment_methods_sql = mysqli_query($mysqli, "SELECT * FROM payment_means WHERE means_delete_status = '0'");
                                    if (mysqli_num_rows($payment_methods_sql) > 0) {
                                        while ($payment_methods = mysqli_fetch_array($payment_methods_sql)) {
                                    ?>
                                            <option value="<?php echo $payment_methods['means_id']; ?>"><?php echo $payment_methods['means_name']; ?></option>
                                        <?php }
                                    } else { ?>
                                        <option>No means available</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="Add_Payment" class="btn btn-primary btn-pill">Add Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>