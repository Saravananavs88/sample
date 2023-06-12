<?php
/*

Template Name: Shopping Cart

*/
get_header(); ?>

<section class="explore">
    <div class="container">

        <?php
        if (class_exists('Veolia_Academy_Public')) {
            $veolia_public = new Veolia_Academy_Public('veolia-academy', '1.0.0');
            $response = $veolia_public->shopping_cart();

            extract($response);
        ?>
            <div class="row p-2 justify-content-center align-content-center custom-flex-column">
                <?php
                $addClass = '';
                //if (empty($my_cart_list)) {
                //$addClass = 'col-md-12';
                //}
                ?>
                <div class="course-overview col-md-8 col-xl-8 col-xxl-6 order-2 order-md-1 <?= $addClass ?>" id="vro-lms-section-left">
                    <div id="veolia-lms-mycart-checkout">
                        <?php
                        if (!empty($my_cart_list)) {
                            foreach ($my_cart_list as $result) {

                                $cost = $result['cost'];

                        ?>
                                <div class="card mb-3" id="veolia-lms-cart-list<?php echo $result['contentItem']['contentItemId']; ?>">
                                    <div class="vro-lms-cart-list">
                                        <?php //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                                            <input type="hidden" class="veolia-lms-checkout-list-fr45987" value="<?php echo $result['contentItem']['contentItemId']; ?>" data-fees="0" data-name="<?php echo $result['contentItem']['title']; ?>">
                                        <?php //else : ?>
                                            <?php /* <input type="hidden" class="veolia-lms-checkout-list-fr45987" value="<?php echo $result['contentItem']['contentItemId']; ?>" data-fees="<?php echo $cost; ?>" data-name="<?php echo $result['contentItem']['title']; ?>"> */ ?>
                                        <?php //endif; ?>
                                        <div class="cart-details row">
                                            <div class="col"> <img src="../wp-content/plugins/veolia-academy/public/images/veolia.png" class="rounded img-fluid" alt="..."> </div>
                                            <div class="col flex-grow-1">
                                                <h5><?php echo $result['contentItem']['title']; ?></h5>
                                                <?php if (isset($result['is_paid']) && $result['is_paid'] != 0) : ?>
                                                    <?php //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                                                        <p class="course-price">$0 <br><s>$<?php echo $cost; ?></s></p>
                                                    <?php //else : ?>
                                                        <?php /* <p class="course-price"><s>$<?php echo $cost; ?></s></p> */ ?>
                                                    <?php //endif; ?>
                                                <?php else : ?>
                                                    <?php //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                                                        <p class="course-price">$0 <br><s>$<?php echo $cost; ?></s></p>
                                                    <?php //else : ?>
                                                        <?php /* <p class="course-price">$<?php echo $cost; ?></p> */ ?>
                                                    <?php //endif; ?>
                                                <?php endif; ?>

                                                <p><i class="fas fa-file-alt pe-2"></i> <?php echo $result['courses']; ?> Courses</p>
                                                <?php

                                                if (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'internal' && isset($result['is_paid']) && $result['is_paid'] != 0) {

                                                ?>
                                                    <div class='p-2 fw-bold text-primary flex-fill'>Already Paid</div>
                                                <?php }  ?>

                                                <?php
                                                if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && isset($result['is_paid']) && $result['is_paid'] != 0) {


                                                ?>
                                                    <div class='p-2 fw-bold text-primary flex-fill'>Already Enrolled</div>
                                                <?php }  ?>
                                            </div>
                                            <div class="col flex-shrink-1">
                                                <button type="button" class="btn-close float-end" aria-label="Close" onclick="veolia_lms_remove_course_model('<?php echo $result['contentItem']['contentItemId']; ?>',<?php echo $cost; ?>,<?php echo isset($result['is_paid']) ? $result['is_paid'] : 0; ?>)"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="card mb-3">
                                <div class="d-flex flex-column align-items-center">
                                    <p>Your cart is empty</p>
                                    <!--<p class="text-center mt-2 small"><a href="<?php //echo site_url() . "/course-list"; 
                                                                                    ?>"><i class="fas fa-shopping-basket pe-2"></i> Continue Shopping</a></p>-->
                                </div>
                            </div>
                        <?php
                        } ?>
                        <div class="text-center my-2 d-none" id="vro-lms-continue-div"><a href='' id="vro-lms-redirct-url" class='vro-lms-contin-shop'><i class="fas fa-shopping-basket pe-2"></i> Continue Shopping</a></div>
                    </div>

                </div>
                <?php

                $addClassDisplay = '';
                $button_state = '';
                if (empty($my_cart_list)) {
                    //$addClassDisplay = 'd-none';
                    $button_state = 'disabled';
                }
                ?>
                <?php //if (!empty($my_cart_list) && $veolia_lms_sub_total > 0) {
                $addClassFlex = '';
                //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) {
                    $addClassFlex = "flex-column";
                //}
                ?>

                <div class="course-options col-md-4 col-xl-4 col-xxl-3 p-4 order-1 order-md-2 mb-3 <?= $addClassDisplay; ?>" id="vro-lms-section-right">

                    <h5 class="cart-header">Your Order</h5>
                    <div class="d-flex <?= $addClassFlex; ?>">
                        <?php //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div><strong>Discount</strong></div>
                                <div id="veolia-lms-course-subtotal-html">
                                    $<?php echo $veolia_lms_sub_total_view; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center"><strong>Total</strong>
                                <div id="veolia-lms-course-subtotal-html">
                                    $0
                                </div>
                            </div>

                        <?php //else : ?>
                            <?php /* <div class="p-2 flex-fill"><strong>Total</strong></div>
                            <div class="p-2 flex-fill text-right" id="veolia-lms-course-subtotal-html">$<?php echo $veolia_lms_sub_total_view; ?></div> */ ?>
                        <?php //endif; ?>

                    </div>
                    <hr />
                    <div class="cart-cta d-grid gap-2 mt-3 ">
                        <input type="hidden" value="<?php echo $veolia_lms_pay_transaction_val; ?>" id="veolia-lms-payment-transaction">
                        <input type="hidden" value="<?php echo $veolia_lms_sub_total_view; ?>" id="veolia-lms-course-subtotal-val">
                        <?php //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                            <button <?php echo $button_state; ?> class="wp-block-button__link" id="veolia-lms-cart-checkout-btn" onclick="veolia_lms_cart_enroll('<?php echo $userid; ?>','<?php echo $first_name; ?>','<?php echo $last_name; ?>','<?php echo $user_email; ?>')">Enroll <i class="fal fa-check-circle ps-2"></i></button>
                        <?php //else : ?>
                            <?php /*<button <?php echo $button_state; ?> class="wp-block-button__link" id="veolia-lms-cart-checkout-btn" onclick="veolia_lms_cart_checkout('<?php echo $userid; ?>','<?php echo $first_name; ?>','<?php echo $last_name; ?>','<?php echo $user_email; ?>')">CHECKOUT <i class="fal fa-check-circle ps-2"></i></button>*/ ?>

                        <?php //endif; ?>
                    </div>
                    <p class="text-center mt-2 small"><a href="<?php echo site_url() . "/course-list"; ?>"><i class="fas fa-shopping-basket pe-2"></i> Continue Shopping</a></p>
                    <?php if ($userid == 0) { ?>
                        <p class="text-muted mt-4">**NOTE: If you don't have an account with us, you will be redirected to iSpring Learn to create an account before purchasing the course. If you do have an account, you will be redirected to iSpring Learn to sign in before proceeding further. </p>
                    <?php } ?>

                </div>
                <?php //} else {   
                ?>
                <!--<div class="col-md-4 col-xl-4 col-xxl-3 p-4 order-1 order-md-2 <? //= $addClassDisplay; 
                                                                                    ?>" id="vro-lms-section-right">
        </div>-->
                <?php //} 
                ?>
            </div>


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
                            <button type="button" class="is-style-outline wp-block-button" onclick="veolia_lms_remove_from_close_model()">Close</button>
                            <div class="wp-block-button">
                                <button type="button" class="wp-block-button__link" onclick="veolia_lms_remove_from_cart()">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- model backdrop -->
            <div id="model-backdrop-fade"></div>
        <?php
        }
        ?>
    </div>
</section>
<?php get_footer(); ?>