<?php
if (!class_exists('VeoliaPluginAjax')) {
    class VeoliaPluginAjax
    {
        //construct functions to define the ajax post function
        public function __construct()
        {
            add_action('wp_ajax_veolia_lms_removefrom_cart', 'veolia_lms_removefrom_cart');
            add_action('wp_ajax_veolia_lms_addto_cart', 'veolia_lms_addto_cart');
            add_action('wp_ajax_nopriv_veolia_lms_removefrom_cart', 'veolia_lms_removefrom_cart');
            add_action('wp_ajax_nopriv_veolia_lms_addto_cart', 'veolia_lms_addto_cart');
            add_action('wp_ajax_veolia_lms_insert_order_creation', 'veolia_lms_insert_order_creation');
            add_action('wp_ajax_nopriv_veolia_lms_insert_order_creation', 'veolia_lms_insert_order_creation');
            add_action('wp_ajax_veolia_lms_course_status_update', 'veolia_lms_course_status_update');
            add_action('wp_ajax_nopriv_veolia_lms_course_status_update', 'veolia_lms_course_status_update');
            add_action('wp_ajax_veolia_lms_order_list_filter', 'veolia_lms_order_list_filter');
            add_action('wp_ajax_nopriv_veolia_lms_order_list_filter', 'veolia_lms_order_list_filter');
            add_action('wp_ajax_veolia_lms_contact_instrutor_mail', 'veolia_lms_contact_instrutor_mail');
            add_action('wp_ajax_nopriv_veolia_lms_contact_instrutor_mail', 'veolia_lms_contact_instrutor_mail');
       
        }
        
    }
}
//creating a  new obj
$veolia_ajax = new VeoliaPluginAjax();

//function to add learning path into the cart
function veolia_lms_addto_cart()
{
    if (isset($_POST['veolia_lms_addcart_learning_id'])) {
        require_once plugin_dir_path( __FILE__ ) . 'services/add-courses-to-cart.php';
        wp_die();
    }
    wp_die();
}
//function to remove learning path from the cart
function veolia_lms_removefrom_cart()
{
    if (isset($_POST['veolia_lms_removecart_learning_id'])) {
        require_once plugin_dir_path( __FILE__ ) . 'services/remove-courses-from-cart.php';
        wp_die();
    }
}
// function to insert order creation
function veolia_lms_insert_order_creation() {
    require_once plugin_dir_path( __FILE__ ) . 'services/insert-order-creation.php';
    wp_die();

}
// function to course status update
function veolia_lms_course_status_update() {
    require_once plugin_dir_path( __FILE__ ) . 'services/course-status-update.php';
    wp_die();

}

// function for order filter
function veolia_lms_order_list_filter() {
    require_once plugin_dir_path( __FILE__ ) . 'services/order-list-filter.php';
    wp_die();
}

// function for contact instrutor mail
function veolia_lms_contact_instrutor_mail() {
    require_once plugin_dir_path( __FILE__ ) . 'services/contact_instrutor_mail.php';
    wp_die();
}