<?php

/**
 * The template for displaying 404 pages (Not Found)
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<section class="explore">
    <div class="container">
        <div class="row gx-md-5">

            <div class="page-wrapper">
                <div class="page-content">
                    <h2><?php _e('This page doesn\'t seem to exist.'); ?></h2>
                    <p><?php _e('It looks like the link pointing here was faulty. Maybe try different URL!', 'veolia-academy'); ?></p>
                </div><!-- .page-content -->
            </div><!-- .page-wrapper -->

        </div><!-- #content -->
    </div><!-- #primary -->
</section>

<?php get_footer(); ?>