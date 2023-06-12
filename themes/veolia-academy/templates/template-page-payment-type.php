<?php
/*

Template Name: Payment Complete

*/
get_header(); ?>

<section class="explore">
  <div class="container">

  <?php 
          if ( class_exists( 'Veolia_Academy_Public' ) )
          {
              $veolia_public = new Veolia_Academy_Public('veolia-academy','1.0.0');
              $response = $veolia_public->payment_status();
         
         extract($response);     
  ?>
    
    <?php if($status=='success'): ?>
        <h3>Your payment was successful.</h3>
        <p style="font-size: 20 px;">The payment that you intiated was successful. Please press continue to start the course. Email us at vrotraining@veolia.com if you have any questions or concerns. </p>
        <div class="align-items-center">
           <center><a target="_blank" href="<?php echo $_SESSION['ssoRedirectUrl']; ?>" class="wp-block-button__link wp-element-button">Continue</a></center>
        </div>
   <?php endif; ?>

   <?php if($status=='failure'): ?>
        <h3>Your payment was failed.</h3>
        <p style="font-size: 20 px;">Looks like your payment was failed. Please click continue to browse courses. </p>
        <div class="align-items-center">
        <center><a target="_blank" href="<?php echo site_url("shopping-cart/"); ?>" class="wp-block-button__link wp-element-button">Continue</a></center>
        </div>
   <?php endif; ?>

    <?php if($status=='enroll_success'): ?>
        <h3>Your enrollment was successful.</h3>
        <p style="font-size: 20 px;">You have been enrolled to the course successfully. Please press continue to start the course. Email us at vrotraining@veolia.com if you have any questions or concerns. </p>
        <div class="align-items-center">
        <center><a target="_blank" href="<?php echo site_url("my-course-list/"); ?>" class="wp-block-button__link wp-element-button">Continue</a></center>
        </div>
   <?php endif; ?>

   <?php if($status=='enroll_failure'): ?>
        <h3>Your enrollment was failure.</h3>
        <p style="font-size: 20 px;">Looks like your enrollment was failed. Please click continue to browse courses. </p>
        <div class="align-items-center">
        <center><a href="<?php echo site_url("shopping-cart/"); ?>" class="wp-block-button__link wp-element-button">Continue</a></center>
        </div>
   <?php endif; ?>
<?php } ?>
   </div>
</section>
<?php  get_footer(); ?>