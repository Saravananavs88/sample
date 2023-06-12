<?php
/*

Template Name: Course Details

*/

if ( class_exists( 'Veolia_Academy_Public' ) )
{
    $veolia_public = new Veolia_Academy_Public('veolia-academy','1.0.0');
    $response = $veolia_public->course_detail();

extract($response);
$args = array();
$args['learning_track'] = $learning_track;     
get_header('course-details',$args); ?>
<section class="explore">
  <div class="container">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="row mt-3 justify-content-center align-content-center">
    <div class="course-overview col-md-8 col-xl-8 col-xxl-6 order-2 order-md-1">
    <span class="d-none" id="vro-lms-course-details-title"><?php echo $learning_track['contentItem']['title']; ?></span>
        <h4 class="mb-4">Courses:</h4>
        <div class="card mb-3">
            <p class="text-muted">If you want a more comprehensive training on a topic or topics, follow this link to view our available courses.</p>
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
        <p class="price-info text-center">your price: <?php //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
            <b><s><small>$<?php echo $learning_track['learning_track_mapping']['price']; ?></s></small></b>&nbsp;<b>$0</b>
            <?php //else : ?>
                <?php /* <b>$<?php echo $learning_track['learning_track_mapping']['price']; ?></b> */ ?>
            <?php //endif; ?>
        </p>
        <div class="cart-cta d-grid gap-2 mt-3">

            <?php if ($check_paid == 0) : ?>
                <button id="veolia_lms_add_to_cart" onclick="veolia_lms_add_to_cart('<?php echo $_GET['id']; ?>')" <?= $my_checkout_cart_data[$counter]['cart_btn_disable']; ?> class="wp-block-button__link wp-element-button vro-lms-startbtn"><i class="fas fa-shopping-basket pe-2"></i><?= $my_checkout_cart_data[$counter]['is_course_added_status']; ?><span class="vro-lms-start-loader d-none" id="veolia-lms-start-loader"></span></button>
                <?php //if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal' && $userid != 0) : ?>
                    <button id="veolia_lms_buy_now" onclick="veolia_lms_buynow_enroll('<?php echo $userid; ?>','<?php echo $first_name; ?>','<?php echo $last_name; ?>','<?php echo $user_email; ?>','<?php echo $learning_track['contentItem']['contentItemId']; ?>','<?php echo $learning_track['contentItem']['title']; ?>','0')" class="wp-block-button__link wp-element-button vro-lms-startbtn"><i class="fas fa-shopping-basket pe-2"></i>Enroll Now<span class="vro-lms-start-loader d-none" id="vro-lms-start-loader"></span></button>
                <?php //else : ?>
                    <?php /*<button id="veolia_lms_buy_now" onclick="veolia_lms_buynow_checkout('<?php echo $userid; ?>','<?php echo $first_name; ?>','<?php echo $last_name; ?>','<?php echo $user_email; ?>','<?php echo $learning_track['contentItem']['contentItemId']; ?>','<?php echo $learning_track['contentItem']['title']; ?>','<?php echo $learning_track['learning_track_mapping']['price']; ?>')" class="wp-block-button__link wp-element-button vro-lms-startbtn"><i class="fas fa-shopping-basket pe-2"></i>Buy Now<span class="vro-lms-start-loader d-none" id="vro-lms-start-loader"></span></button>*/ ?>
                <?php //endif; ?>
            <?php else : ?>

                <div class="">
                    <center style="margin-bottom:10px;"><span style="font-size:14px;padding-bottom:10px;" class="vro-lms-course-price2">Status : <strong><?php echo ($course_status == 'Complete') ? "Completed" : $course_status; ?></strong></span></center>
                </div>
                <div class="progress" style="margin-left:10%;margin-right:10%;">
                    <div class="progress-bar <?php echo ($course_status == 'Complete') ? "bg-success" : "bg-primary"; ?>" role="progressbar" aria-label="Success example" style="width: <?php echo $course_percentage; ?>%" aria-valuenow="<?php echo $course_percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <center><?php echo $course_percentage; ?>%</center>
                <div>&nbsp;</div>
                <div class="cart-cta d-grid"><a href="<?php echo site_url() . "/my-course-list"; ?>" target="_blank" class="wp-block-button__link wp-element-button"> <?php if ($started == 0) : ?>START LEARNING
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
            <a href='<?php echo site_url() . "/course-list"; ?>' class='vro-lms-contin-shop'><em class='fas fa-shopping-basket pe-2'></em> Continue Shopping</a>
        </div>

        <h5 class="mt-4">What the course includes:</h5>
        <ul class="list-unstyled">
            <li><i class="wp-block-social-link fas fa-file-video pe-2"></i> <?php echo count($courses); ?> Courses</li>
        </ul>
        
        <?php if ( is_active_sidebar( 'course-detail-content' ) ) 
                dynamic_sidebar( 'course-detail-content' ); ?>
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
</div>
</section>
<?php
}
else
{
    get_header(); ?>
   <section class="explore">
      <div class="container">
        <?php the_content(); ?>
      </div>
    </section>

<?php } get_footer(); ?>