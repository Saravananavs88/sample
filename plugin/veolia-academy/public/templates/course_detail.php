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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="row mt-3 justify-content-center align-content-center">
    <div class="course-overview col-md-8 col-xl-8 col-xxl-6 order-2 order-md-1">
        <h4 class="mb-4">Curriculum for this course:</h4>
        <div class="card mb-3">
            <h5>Digital Classes</h5>
            <p class="text-muted">If you want a more comprehensive training on a topic or topics, follow this link to view our available classes.</p>
            <?php foreach ($courses as $course) : ?>
                <div class="d-flex course-option justify-content-between align-items-center">
                    <div class="p-2 flex-fill"><i class="wp-block-social-link fas fa-file-video pe-2"></i> <?php echo $course['contentItem']['title']; ?></div>
                    <div class="p-2 flex-end">
                        <?php if ($check_paid != 0) : ?>
                            <div class=" vro-lms-course-list-title">
                                <span class="badge <?php if ($course['course_status'] == 'Complete') {
                                                        echo 'bg-success';
                                                    } elseif ($course['course_status'] == 'In Progress') {
                                                        echo 'bg-primary';
                                                    } else {
                                                        echo 'bg-warning text-dark';
                                                    }
                                                    ?>"><?php echo ($course['course_status'] == 'Complete') ? "Completed" : $course['course_status']; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
    <div class="course-options col-md-4 col-xl-4 col-xxl-3 p-4 order-1 order-md-2">
        <p class="price-info text-center">your price: <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                <b>$<?php echo $learning_track['learning_track_mapping']['price']; ?></b>
            <?php else : ?>
                <b>$<?php echo $learning_track['learning_track_mapping']['price']; ?></b>
            <?php endif; ?>
        </p>
        <div class="cart-cta d-grid gap-2 mt-3">

            <?php if ($check_paid == 0) : ?>
                <button id="veolia_lms_add_to_cart" onclick="veolia_lms_add_to_cart('<?php echo $_GET['id']; ?>')" <?= $my_checkout_cart_data[$counter]['cart_btn_disable']; ?> class="wp-block-button__link wp-element-button vro-lms-startbtn"><?= $my_checkout_cart_data[$counter]['is_course_added_status']; ?><span class="vro-lms-start-loader d-none" id="veolia-lms-start-loader"></span></button>
                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                    <button id="veolia_lms_buy_now" onclick="veolia_lms_buynow_enroll('<?php echo $userid; ?>','<?php echo $first_name; ?>','<?php echo $last_name; ?>','<?php echo $user_email; ?>','<?php echo $learning_track['contentItem']['contentItemId']; ?>','<?php echo $learning_track['contentItem']['title']; ?>','0')" class="wp-block-button__link wp-element-button vro-lms-startbtn">Enroll Now<span class="vro-lms-start-loader d-none" id="vro-lms-start-loader"></span></button>
                <?php else : ?>
                    <button id="veolia_lms_buy_now" onclick="veolia_lms_buynow_checkout('<?php echo $userid; ?>','<?php echo $first_name; ?>','<?php echo $last_name; ?>','<?php echo $user_email; ?>','<?php echo $learning_track['contentItem']['contentItemId']; ?>','<?php echo $learning_track['contentItem']['title']; ?>','<?php echo $learning_track['learning_track_mapping']['price']; ?>')" class="wp-block-button__link wp-element-button vro-lms-startbtn">Buy Now<span class="vro-lms-start-loader d-none" id="vro-lms-start-loader"></span></button>
                <?php endif; ?>
            <?php else : ?>

                <div class="">
                    <center style="margin-bottom:10px;"><span style="font-size:14px;padding-bottom:10px;" class="vro-lms-course-price2">Status : <strong><?php echo ($course_status == 'Complete') ? "Completed" : $course_status; ?></strong></span></center>
                </div>
                <div class="progress" style="margin-left:10%;margin-right:10%;">
                    <div class="progress-bar <?php echo ($course_status == 'Complete') ? "bg-success" : "bg-primary"; ?>" role="progressbar" aria-label="Success example" style="width: <?php echo $course_percentage; ?>%" aria-valuenow="<?php echo $course_percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <center><?php echo $course_percentage; ?>%</center>
                <div>&nbsp;</div>
                <div class="cart-cta d-grid"><a href="<?php echo $redirectUrl; ?>" target="_blank" class="wp-block-button__link wp-element-button"> <?php if ($started == 0) : ?>START LEARNING
                    <?php else : ?>
                        CONTINUE LEARNING
                    <?php endif; ?> </a></div>



            <?php endif; ?>
        </div>
        <p class="text-center mt-2 small">
            <?php if ($userid == 0) { ?>
                <a href="<?php echo site_url() . "/wp-login.php"; ?>" class="btn btn-md btn-link">Already Paid? Login Here </a>
            <?php } ?>

        </p>
        <div class="mt-2 text-center">
            <a href='<?php echo site_url() . "/course-list"; ?>' class='vro-lms-contin-shop'><em class='fa fa-shopping-cart'></em> Continue Shopping</a>
        </div>
        <h5 class="mt-4">What the course includes:</h5>
        <ul class="list-unstyled">
            <li><i class="wp-block-social-link fas fa-file-video pe-2"></i> 8 Digital Classes</li>
            <li><i class="wp-block-social-link fas fa-file-edit pe-2"></i> 9 Practice Exams</li>
            <li><i class="wp-block-social-link fas fa-file-alt pe-2"></i> 5 Job Aids</li>
        </ul>
        <h5 class="mt-4">What you get:</h5>
        <p>Following successful completion of each training module, you will be awarded a certificate and validation letter for submittal to your employer and certification agency.</p>
        <hr />
        <div class="text-muted">
            <h6>Training 5 or more people?</h6>
            <p>Get your team access to this course with group rates.</p>
        </div>
        <img src="<?= plugin_dir_url(__DIR__) . 'images/course-certificate-sample.jpg' ?>" alt="" class="img-fluid" />

        <div class="d-grid gap-2 mt-3"> <a href="#" class="btn btn-outline-dark" id="vro-lms-contact-instrutor">Contact Us</a> </div>
    </div>
</div>



<!-- contact instrutor model-->
<div class="modal" id="model-contact-instrutor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="vro-lms-coruse-start-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="contact_instrutor_form_submit">
                <div class="modal-header">
                    <h4 class="modal-title" id="contact_instrutor_title">Contact Instrutor</h4>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="contact_instrutor_message" class="col-form-label">Please mention your queries here!</label>
                        <textarea class="form-control" id="contact_instrutor_message" rows="3"></textarea>
                        <span id="contact_instrutor_error_message" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" onclick="contact_instrutor_model_close()">Close</button>
                    <button type="submit" class="btn btn-success" id="contact_instrutor_model_submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- model backdrop -->
<div id="model-backdrop-fade"></div>
<?php
function limit_desc($x, $length)
{
    if (strlen($x) <= $length) {
        return $x;
    } else {
        $y = substr($x, 0, $length) . '...';
        return $y;
    }
}
?>