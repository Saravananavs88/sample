<?php
// for adding styles
function veolia_add_css()
{
   
   wp_register_style('veolia-theme-bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', false,'1.1',false);
   wp_enqueue_style( 'veolia-theme-bootstrap-style');   
   //wp_register_style('veolia-theme-googleapis-style', 'https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@300;400;500&display=swap', false,'1.1',false);
   //wp_enqueue_style( 'veolia-theme-googleapis-style');
   wp_register_style('veolia-theme-fontawesome-style', get_template_directory_uri() . '/assets/css/all.min.css', false,'1.1',false);
   wp_enqueue_style( 'veolia-theme-fontawesome-style');
   wp_register_style('veolia-theme-style', get_template_directory_uri() . '/assets/css/style.css', false,'2.2',false);
   wp_enqueue_style( 'veolia-theme-style');
   wp_register_style('veolia-theme-wp-style', get_template_directory_uri() . '/assets/css/theme.css', false,'1.1',false);
   wp_enqueue_style( 'veolia-theme-wp-style');


}
add_action('wp_enqueue_scripts', 'veolia_add_css');

// for adding scripts
function veolia_add_script()
{
   // wp_register_script('veolia-theme-js-script', get_template_directory_uri() . '/assets/js/jquery.3.6.slim.min.js', array ( 'jquery' ), 1.1, true);
   // wp_enqueue_script( 'veolia-theme-js-script');
   wp_register_script('veolia-theme-bootstrap-popper-script', get_template_directory_uri() . '/assets/js/popper.min.js', array ( 'jquery' ), 1.1, true);
   wp_enqueue_script( 'veolia-theme-bootstrap-popper-script');
   wp_register_script('veolia-theme-bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array ( 'jquery' ), 1.1, true);
   wp_enqueue_script( 'veolia-theme-bootstrap-script');
}
add_action('wp_enqueue_scripts', 'veolia_add_script');


?>