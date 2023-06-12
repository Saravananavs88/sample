<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/public/partials
 */

?>


<main class="vro-lms-pg-main">
    <h1 class="vro-lms-page-entry-title"><?php echo the_title(); ?></h1>
    <div class="vro-lms-breadcrumbs">
        <a href="<?php echo site_url(); ?>">Home</a> <em class="fa fa-chevron-right"></em>
        <a href="<?php echo site_url() . "/order-list"; ?>">Orders</a> <em class="fa fa-chevron-right"></em>
        <span class="breadcrumb_last" id="breadcrumb_last">Order Detail</span>
    </div>
    <div class="vro-lms-pg-contaniner">
        <?php if ($is_vrolms_order_exists == 1) { ?>

            <?php if ($vro_lms_orders_data["order_status"] == 'success') : ?>

                <div style="display: flex; justify-content: end;">
                    <button class="btn btn-sm <?php echo $vro_lms_status_btn; ?> text-white" onclick="downloadOrderInvoice()">Download Invoice</button>
                </div>
                <br>
            <?php endif; ?>

            <div class="row vro-lms-order-details bg-white">

                <div class="col-md-6 vro-lms-order-dleft">
                    <div class="vro-lms-orderdnumber"></div>
                    <div class="vro-lms-orderddate">
                        <span class="vro-lms-orderlcol1">SALES ORDER</span>
                        <span class="vro-lms-orderrcol1">#<?php echo "000" . $vro_lms_orders_data["order_id"]; ?></span>
                    </div>
                    <div class="vro-lms-orderddate">
                        <span class="vro-lms-orderlcol1">ORDER DATE</span>
                        <span class="vro-lms-orderrcol1"><?php echo date("d F Y", strtotime($vro_lms_orders_data["order_created_datetime"])); ?></span>
                    </div>
                    <div class="vro-lms-orderddate">
                        <span class="vro-lms-orderlcol1">STATUS</span>
                        <span class="vro-lms-orderrcol1"><strong><?php echo $vro_lms_orders_data["order_status"]; ?></strong>

                        </span>
                    </div>
                </div>
                <div class="col-md-6 row vro-lms-order-dright">
                    <?php if ($is_vrolms_payment_done == 1) { ?>
                        <div class="col-md-6 vro-lms-order-billaddr">
                            <div class="vro-lms-order-addrhead">BILLING ADDRESS</div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vro_lms_userfullname) ? $vro_lms_userfullname : ''; ?></div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vro_lms_useraddr) ? $vro_lms_useraddr : ''; ?></div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vrolms_paymentdata["payment_phone_number"]) ? $vrolms_paymentdata["payment_phone_number"] : ''; ?></div>
                        </div>
                        <div class="col-md-6 vro-lms-order-shipaddr">
                            <div class="vro-lms-order-addrhead">SHIPPING ADDRESS</div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vro_lms_userfullname) ? $vro_lms_userfullname : ''; ?></div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vro_lms_useraddr) ? $vro_lms_useraddr : ''; ?></div>
                            <div class="vro-lms-order-addrdetail"><?php echo isset($vrolms_paymentdata["payment_phone_number"]) ? $vrolms_paymentdata["payment_phone_number"] : ''; ?></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--vro-lms-order-details-->
        <?php } ?>
        <?php if (!empty($vro_lms_orders_detail_list)) { ?>
            <div class="vro-lms-ordered-data bg-white">
                <div>
                    <table class="table table-striped vro-lms-order-table" aria-describedby="">
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
                                <td colspan=3>
                                    <div class="vro-lms-order-totaltext">Discount</div>
                                </td>
                                <td>
                                    <div class="vro-lms-order-totalprice">$<?php echo $total; ?></div>
                                </td>
                            </tr>
                            <tr class="vro-lms-order-total">
                                <td colspan=3>
                                    <div class="vro-lms-order-totaltext">Total</div>
                                </td>
                                <td>
                                    <div class="vro-lms-order-totalprice">$0</div>
                                </td>
                            </tr>
                        <?php else : ?>
                            <tr class="vro-lms-order-total">
                                <td colspan=3>
                                    <div class="vro-lms-order-totaltext">Total</div>
                                </td>
                                <td>
                                    <div class="vro-lms-order-totalprice">$<?php echo $total; ?></div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div><!-- container-->
</main>

