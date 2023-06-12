<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header('contact'); ?>

<div class="intro container">
    <div class="row mt-3 mb-5 justify-content-center align-items-center">
        <div class="col-lg-5 col-xl-6 col-xxl-4">
            <h1 class="mb-4"><?php wp_title('', true, false); ?></h1>
            <p class="lead mb-4"><?php try{ echo CFS()->get( 'short_description' ); }catch (Error $e) {} ?></p>
        </div>
        <!-- WEB FORM-->
        <div class="col-lg-6 col-xl-6 col-xxl-6">
        <div class="contact card">
            <div class="card-body">
                <?php the_content(); ?>

            </div>
          </div>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>