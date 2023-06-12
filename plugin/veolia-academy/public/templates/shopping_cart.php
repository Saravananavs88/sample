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
        <a href="<?php echo site_url('course-list'); ?>">Training Options</a> <em class="fa fa-chevron-right"></em>
        <span class="breadcrumb_last" id="breadcrumb_last">Shopping cart</span>
    </div>
    <div>
        <div class="row">
            <?php
            $addClass = '';
            if (empty($my_cart_list)) {
                $addClass = 'col-md-12';
            }
            ?>
            <div class="col-md-8 bg-white vro-lms-section-left <?= $addClass ?>" id="vro-lms-section-left">

                <div class="row vro-lms-cart-content" id="veolia-lms-mycart-checkout">
                    <?php

                    if (!empty($my_cart_list)) {
                        foreach ($my_cart_list as $result) {

                            $cost = $result['cost'];

                    ?>
                            <div class="row vro-lms-cart-list " id="veolia-lms-cart-list<?php echo $result['contentItem']['contentItemId']; ?>">
                                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                                    <input type="hidden" class="veolia-lms-checkout-list-fr45987" value="<?php echo $result['contentItem']['contentItemId']; ?>" data-fees="0" data-name="<?php echo $result['contentItem']['title']; ?>">
                                <?php else : ?>
                                    <input type="hidden" class="veolia-lms-checkout-list-fr45987" value="<?php echo $result['contentItem']['contentItemId']; ?>" data-fees="<?php echo $cost; ?>" data-name="<?php echo $result['contentItem']['title']; ?>">
                                <?php endif; ?>
                                <div class="col-md-4 vro-lms-cart-image">
                                    <img alt='Learning Path Image' class="vro-lms-img-lazy-loadd img-fluid" src='../wp-content/plugins/veolia-academy/public/images/veolia.png'>
                                </div>
                                <div class="col-md-8 vro-lms-cart-detail">
                                    <div class="row">
                                        <div class="col-10">
                                            <?php if ($result['is_paid'] != 0) : ?>
                                                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                                                    <h2 class="vro-lms-cart-detail-price">$0<br><s style="font-size:16px;">$<?php echo $cost; ?></s></h2>
                                                <?php else : ?>
                                                    <h2 class="vro-lms-cart-detail-price"><s>$<?php echo $cost; ?></s></h2>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                                                    <h2 class="vro-lms-cart-detail-price">$0<br><s style="font-size:16px;">$<?php echo $cost; ?></s></h2>
                                                <?php else : ?>
                                                    <h2 class="vro-lms-cart-detail-price">$<?php echo $cost; ?></h2>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-1 vro-lms-cart-detail-remove"><em class="fa fa-remove" onclick="veolia_lms_remove_course_model('<?php echo $result['contentItem']['contentItemId']; ?>',<?php echo $cost; ?>,<?php echo $result['is_paid']; ?>)"></em></div>
                                    </div>

                                    <div class="vro-lms-cart-detail-title"><?php echo $result['contentItem']['title']; ?></div>
                                    <div class="vro-lms-cart-detail-item">
                                        <!-- <em class="fa fa-clock-o"></em> <?php //echo gmdate('H:i', $data['program_duration']); 
                                                                                ?> Hrs <span class="vro-lms-cart-item-divid">|</span> --> <em class="fa fa-file-o"></em> <?php echo $result['courses']; ?> Courses
                                    </div>
                                    <?php
                                    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'internal' && $result['is_paid'] != 0) {
                                    ?>
                                        <div class='vro-lms-paid-text'>Already Paid</div>
                                    <?php }  ?>

                                    <?php
                                    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $result['is_paid'] != 0) {
                                    ?>
                                        <div class='vro-lms-paid-text'>Already Enrolled</div>
                                    <?php }  ?>

                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="text-center">Your cart is empty</div>
                        <div class="text-center my-2"><a href='<?php echo site_url() . "/course-list"; ?>' class='vro-lms-contin-shop'><em class='fa fa-shopping-cart'></em> Continue Shopping</a></div>
                    <?php
                    } ?>
                </div>
                <div class="text-center my-2 d-none" id="vro-lms-continue-div"><a href='' id="vro-lms-redirct-url" class='vro-lms-contin-shop'><em class='fa fa-shopping-cart'></em> Continue Shopping</a></div>

            </div>

            <?php
            $addClassDisplay = '';
            if (empty($my_cart_list)  && $veolia_lms_sub_total > 0) {
                $addClassDisplay = 'd-none';
            }
            ?>
            <div class="col-md-3 vro-lms-section-right <?= $addClassDisplay; ?>" id="vro-lms-section-right">
                <?php if (!empty($my_cart_list) && $veolia_lms_sub_total > 0) { ?>
                    <div class="vro-lms-cart-payment-grid bg-white" id="vro-lms-cart-payment-grid">
                        <h2 class="vro-lms-cart-paygrid-title text-center">My Cart</h2>
                        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                            <div class="row vro-lms-cart-paygrid-desc">
                                <div class="col-6 vro-lms-cart-paygrid-dleft">Discount</div>
                                <div class="col-6 vro-lms-cart-paygrid-dright text-end" id="veolia-lms-course-subtotal-html">
                                    $<?php echo $veolia_lms_sub_total_view; ?>
                                </div>
                                <div class="col-6 vro-lms-cart-paygrid-dleft">Total</div>
                                <div class="col-6 vro-lms-cart-paygrid-dright text-end" id="veolia-lms-course-subtotal-html">
                                    $0
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="row vro-lms-cart-paygrid-desc">
                                <div class="col-6 vro-lms-cart-paygrid-dleft">Total</div>
                                <div class="col-6 vro-lms-cart-paygrid-dright text-end" id="veolia-lms-course-subtotal-html">
                                    $<?php echo $veolia_lms_sub_total_view; ?>
                                </div>
                            </div>
                        <?php endif; ?>


                        <div class="vro-lms-cart-paygrid-checkout text-center">
                            <input type="hidden" value="<?php echo $veolia_lms_pay_transaction_val; ?>" id="veolia-lms-payment-transaction">
                            <input type="hidden" value="<?php echo $veolia_lms_sub_total_view; ?>" id="veolia-lms-course-subtotal-val">
                            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                                <button class="btn btn-sm btn-success" id="veolia-lms-cart-checkout-btn" onclick="veolia_lms_cart_enroll('<?php echo $userid; ?>','<?php echo $first_name; ?>','<?php echo $last_name; ?>','<?php echo $user_email; ?>')">Enroll</button>
                            <?php else : ?>
                                <button class="btn btn-sm btn-success" id="veolia-lms-cart-checkout-btn" onclick="veolia_lms_cart_checkout('<?php echo $userid; ?>','<?php echo $first_name; ?>','<?php echo $last_name; ?>','<?php echo $user_email; ?>')">CHECKOUT</button>
                            <?php endif; ?>
                            <a href='<?php echo site_url() . "/course-list"; ?>' class='vro-lms-contin-shop'><em class='fa fa-shopping-cart'></em> Continue Shopping</a>
                            <?php if ($userid == 0) { ?>
                                <div class='vro-lms-login-info-message'>
                                    ** If you don't have an account with us, you will be redirected to create an account before purchasing the course. If you do have an account, you will be redirected to sign in before proceeding further.
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
        <!--row-->
    </div>
    <!--container-->

    <!-- close course model -->
    <div class="modal" id="model-course-remove" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="vro-lms-coruse-start-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <input type="hidden" id="veolia_lms_learning_id" value="">
                <input type="hidden" id="veolia_lms_learning_fees" value="">
                <input type="hidden" id="veolia_lms_is_paid" value="">
                <div class="modal-body">
                    Are you sure you want remove this course from the cart?
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" onclick="veolia_lms_remove_from_close_model()">Close</button>
                    <button type="button" class="btn btn-success" onclick="veolia_lms_remove_from_cart()">Yes</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- model backdrop -->
<div id="model-backdrop-fade"></div>
