<?php error_reporting(0); if (is_front_page()) : get_header('home'); else : get_header(); endif; ?>

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