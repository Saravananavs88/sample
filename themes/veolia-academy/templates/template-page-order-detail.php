<?php
/*

Template Name: Order Details

*/
get_header('order-detail'); ?>

<section class="explore">
  <div class="container">

  <?php 
          if ( class_exists( 'Veolia_Academy_Public' ) )
          {
              $veolia_public = new Veolia_Academy_Public('veolia-academy','1.0.0');
              $response = $veolia_public->order_detail();
         
         extract($response);     
  ?>
    <div class="vro-lms-pg-contaniner">
    <?php if ($is_vrolms_order_exists == 1) { ?>
        <div class="row">
            <div class="col-md-9">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-2 wp-block-heading heading-text-color">Order items</h5>
                    <?php if ($vro_lms_orders_data["order_status"] == 'success') : ?>

                        <div class="wp-block-button">
                            <button class="wp-block-button__link wp-element-button" onclick="downloadOrderInvoice()">Download Invoice</button>
                        </div>

                    <?php endif; ?>
                </div>
                <?php if (!empty($vro_lms_orders_detail_list)) { ?>
                    <div class="vro-lms-ordered-data bg-white">
                        <table class="table wp-block-table my-2" aria-describedby="">
                            <thead>
                                <tr>
                                    <th>Items</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                    <th>Total</th>
                                <tr>
                            </thead>
                            <?php
                            $total = 0;
                            foreach ($vro_lms_orders_detail_list as $data) {
                            ?>
                                <tr>
                                    <td><?php echo $data["order_detail_learning_program"]; ?> <br>
                                        <div class="vro-lms-pdt-order">order #<?php echo $data["order_detail_id"]; ?></div>
                                    </td>
                                    <td><?php echo $data["order_detail_qty"]; ?></td>
                                    <td>$<?php echo $data["order_detail_learning_program_fee"]; ?></td>
                                    <td>$<?php echo $data["order_detail_learning_program_fee"]; ?></td>
                                </tr>
                            <?php $total += $data["order_detail_learning_program_fee"];
                            } ?>
                            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal') : ?>
                                <tr class="vro-lms-order-total">
                                    <td colspan=3 class="text-end">
                                        <div class="vro-lms-order-totaltext">Discount</div>
                                    </td>
                                    <td>
                                        <div class="vro-lms-order-totalprice">$<?php echo $total; ?></div>
                                    </td>
                                </tr>
                                <tr class="vro-lms-order-total">
                                    <td colspan=3 class="text-end">
                                        <div class="vro-lms-order-totaltext">Total</div>
                                    </td>
                                    <td>
                                        <div class="vro-lms-order-totalprice">$0</div>
                                    </td>
                                </tr>
                            <?php else : ?>
                                <tr class="vro-lms-order-total">
                                    <td colspan=3 class="text-end">
                                        <div class="vro-lms-order-totaltext">Total</div>
                                    </td>
                                    <td>
                                        <div class="vro-lms-order-totalprice">$<?php echo $total; ?></div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>

                    </div>
                <?php } ?>
            </div>
            <div class="col-md-3">
                <?php if ($is_vrolms_payment_done == 1) { ?>
                    <div class="sidebar-wrap-container p-4 mb-3">
                        <h5 class="mb-2 wp-block-heading heading-text-color">Customer details</h5>
                        <div class="vro-lms-order-billaddr mb-2">
                            <div class="vro-lms-order-addrhead fw-bold">Billing Address:</div><br>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vro_lms_userfullname) ? $vro_lms_userfullname : ''; ?></div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vro_lms_useraddr) ? $vro_lms_useraddr : ''; ?></div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vrolms_paymentdata["payment_phone_number"]) ? $vrolms_paymentdata["payment_phone_number"] : ''; ?></div>
                        </div>
                        <div class="vro-lms-order-shipaddr mb-2">
                            <div class="vro-lms-order-addrhead fw-bold">Shipping Address:</div><br>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vro_lms_userfullname) ? $vro_lms_userfullname : ''; ?></div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vro_lms_useraddr) ? $vro_lms_useraddr : ''; ?></div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vrolms_paymentdata["payment_phone_number"]) ? $vrolms_paymentdata["payment_phone_number"] : ''; ?></div>
                        </div>

                    </div>
                <?php } ?>
                <div class="sidebar-wrap-container p-4">
                    <h5 class="mb-2 wp-block-heading heading-text-color">Order details</h5>
                    <div class="vro-lms-orderddate mb-2">
                        <span class="vro-lms-orderlcol1 fw-bold">Sales Order:</span><br>
                        <span class="vro-lms-orderrcol1">#<?php echo "000" . $vro_lms_orders_data["order_id"]; ?></span>
                    </div>
                    <div class="vro-lms-orderddate mb-2">
                        <span class="vro-lms-orderlcol1 fw-bold">Order Date:</span><br>
                        <span class="vro-lms-orderrcol1"><?php echo date("d F Y", strtotime($vro_lms_orders_data["order_created_datetime"])); ?></span>
                    </div>
                    <div class="vro-lms-orderddate mb-2">
                        <span class="vro-lms-orderlcol1 fw-bold">Status:</span><br>
                        <span class="vro-lms-orderrcol1"><?php echo $vro_lms_orders_data["order_status"]; ?>
                        </span>
                    </div>

                </div>

            </div>
        </div>
        <!--vro-lms-order-details-->
    <?php } ?>

</div><!-- container-->

    <?php    
    }
    ?>
    </div>
</section>
<?php get_footer(); ?>