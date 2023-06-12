<?php
error_reporting(0);
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header('course-details'); ?>

<section class="explore">
  <div class="container">
  <?php 
    try{
      the_content(); 
    }
    catch(Error $e) {echo "Something went wrong! Please contact administrator.";}
    ?>
  </div>
</section>

<?php get_footer(); ?>