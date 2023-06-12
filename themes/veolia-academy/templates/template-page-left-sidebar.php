<?php
/*

Template Name: Page with left sidebar

*/


get_header(); ?>
<section class="explore">
  <div class="container">
    <div class="row gx-md-5">
      <div class="col-lg-3 col-md-4">
        <div class="sidebar-content-area" id="sidebar-primary">
          <div class="course-options p-4">            
          <?php if ( is_active_sidebar( 'left-sidebar-content' ) ) 
                dynamic_sidebar( 'left-sidebar-content' ); ?>
          </div>

        </div>
      </div>
      <div class="col-lg-9 col-md-8">
        <div class="primary-content-wrap" id="primary">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>