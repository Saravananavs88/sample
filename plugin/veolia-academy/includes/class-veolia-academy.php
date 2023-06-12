<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/includes
 * @author     Arunkumar <arunkumar.ravindran@zucisystems.com>
 */
class Veolia_Academy
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Veolia_Academy_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $veolia_academy    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('VEOLIA_ACADEMY_VERSION')) {
			$this->version = VEOLIA_ACADEMY_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'veolia-academy';

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Veolia_Academy_Loader. Orchestrates the hooks of the plugin.
	 * - Veolia_Academy_i18n. Defines internationalization functionality.
	 * - Veolia_Academy_Admin. Defines all hooks for the admin area.
	 * - Veolia_Academy_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-veolia-academy-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-veolia-academy-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-veolia-academy-public.php';

		/**
		 * The class responsible for defining all API's
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-veolia-academy-api.php';


		$this->loader = new Veolia_Academy_Loader();
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Veolia_Academy_Admin($this->get_veolia_academy(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		$this->loader->add_action('wp_ajax_fetch_learning_track_ajax', $plugin_admin, 'fetch_learning_track_ajax');
		$this->loader->add_action('wp_ajax_nopriv_fetch_learning_track_ajax', $plugin_admin, 'fetch_learning_track_ajax');
		$this->loader->add_action('wp_ajax_learning_track_ajax', $plugin_admin, 'learning_track_ajax');
		$this->loader->add_action('wp_ajax_nopriv_learning_track_ajax', $plugin_admin, 'learning_track_ajax');
		$this->loader->add_action('wp_ajax_admin_order_course_view_ajax', $plugin_admin, 'admin_order_course_view_ajax');
		$this->loader->add_action('wp_ajax_nopriv_admin_order_course_view_ajax', $plugin_admin, 'admin_order_course_view_ajax');
		$this->loader->add_action('init', $plugin_admin, 'custom_post_about_portfolio');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Veolia_Academy_Public($this->get_veolia_academy(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		//For overriding login page styles
		$this->loader->add_action('login_enqueue_scripts', $plugin_public, 'enqueue_styles_login');
		$this->loader->add_filter('login_headerurl', $plugin_public, 'change_login_logo_url');
		$this->loader->add_filter('login_headertext', $plugin_public, 'change_login_logo_url_title');

		//For overriding registration page
		$this->loader->add_action('register_form', $plugin_public, 'adding_fields_register_form');
		$this->loader->add_filter('registration_errors', $plugin_public, 'registration_validations', 10, 3);
		$this->loader->add_action('register_post', $plugin_public, 'before_registration_save', 10, 3);
		$this->loader->add_filter('user_profile_update_errors', $plugin_public, 'manual_registration_validations', 10, 3);
		$this->loader->add_filter('login_message',  $plugin_public, 'user_activation_message');
		$this->loader->add_action('admin_notices', $plugin_public, 'admin_notice__error');
		$this->loader->add_action('delete_user', $plugin_public, 'manual_delete_user', 10, 1);
		$this->loader->add_action('user_register', $plugin_public, 'registration_save', 10, 1);

		$this->loader->add_filter('wp_new_user_notification_email',  $plugin_public, 'new_user_notification_email', 10, 4);
		$this->loader->add_filter('check_admin_referer',  $plugin_public, 'logout_without_confirm', 10, 2);

		$this->loader->add_action('password_reset', $plugin_public, 'password_reset_action', 10, 2);
		$this->loader->add_filter('wp_authenticate_user', $plugin_public, 'authenticate_user', 10, 2);
		$this->loader->add_filter('wp_login', $plugin_public, 'redirect_on_login');
		$this->loader->add_action('init', $plugin_public, 'register_session');
		$this->loader->add_filter('authenticate', $plugin_public, 'before_authenticate_user', 30, 3);

		$this->loader->add_filter('gettext', $plugin_public, 'resend_link');

		//For remember me option expiry
		$this->loader->add_filter('auth_cookie_expiration', $plugin_public, 'remember_me_expiry', 99, 3);


		//for course list page
		if ($this->get_current_slug() == "course-list")
			$this->loader->add_filter('the_content', $plugin_public, 'course_list');

		//for course detail page
		if ($this->get_current_slug() == "course-detail")
			$this->loader->add_filter('the_content', $plugin_public, 'course_detail');

		//for shopping cart page
		if ($this->get_current_slug() == "shopping-cart")
			$this->loader->add_filter('the_content', $plugin_public, 'shopping_cart');

		//for checkout redirect page
		if ($this->get_current_slug() == "checkout-redirect")
			$this->loader->add_filter('the_content', $plugin_public, 'checkout_redirect');

		//for mycourses page
		if ($this->get_current_slug() == "my-course-list")
			$this->loader->add_filter('the_content', $plugin_public, 'my_course_list');

		//for myorders page
		if ($this->get_current_slug() == "order-list")
			$this->loader->add_filter('the_content', $plugin_public, 'order_list');

		//for myorder detail page
		if ($this->get_current_slug() == "order-detail")
			$this->loader->add_filter('the_content', $plugin_public, 'order_detail');

		// for user activation 
		if ($this->get_current_slug() == "user-activation")
			$this->loader->add_filter('the_content', $plugin_public, 'user_activation');

		// for resend activation
		if ($this->get_current_slug() == "resend-activation-link")
			$this->loader->add_filter('the_content', $plugin_public, 'resend_activation_link');
		
		// for about us
		if ($this->get_current_slug() == "payment-status")
			$this->loader->add_filter('the_content', $plugin_public, 'payment_status');	

		$this->loader->add_action('wp_footer', $plugin_public, 'shopping_cart_floating');

		$this->loader->add_action('wp_ajax_veolia_lms_order_invoice_download', $plugin_public, 'veolia_lms_order_invoice_download');
		$this->loader->add_action('wp_ajax_nopriv_veolia_lms_order_invoice_download', $plugin_public, 'veolia_lms_order_invoice_download');
	}

	public function get_current_slug()
	{
		$get_home_url = get_home_url();
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if ($_SERVER['REQUEST_URI'] != '/wp-login.php' && $_SERVER['REQUEST_URI'] != '/wp-admin/admin-ajax.php' && $_SERVER['REQUEST_URI'] != '/img/favicons/favicon-32x32.png')
			setcookie('action_redirect', $actual_link, time() + (86400 * 30), "/");
		$get_slug_name = str_replace($get_home_url, '', $actual_link);
		$get_slug_name = preg_replace('|/|', '', $get_slug_name);
		$get_slug_name =  explode("?", $get_slug_name);
		return  isset($get_slug_name[0]) ? $get_slug_name[0] : '';
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_veolia_academy()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Veolia_Academy_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
