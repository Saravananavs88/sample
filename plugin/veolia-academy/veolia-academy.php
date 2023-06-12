<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.veolia-academy.com/
 * @since             1.0.0
 * @package           Veolia_Academy
 *
 * @wordpress-plugin
 * Plugin Name:       LMS
 * Plugin URI:        http://www.veolia-academy.com/
 * Description:       A plugin to implement the features of Veolia Academy.
 * Version:           1.0.0
 * Author:            Zuci Systems
 * Author URI:        https://www.zucisystems.com/
 * License:           GPL-2.0+
 * License URI:       http://www.veolia-academy.com/gpl-2.0.txt
 * Text Domain:       veolia-academy
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VEOLIA_ACADEMY_VERSION', '1.12.6.23' );
define('MY_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ROOTDIR', plugin_dir_path(__FILE__));

$error = 0;
if ( ! class_exists( 'Veolia_Academy_Setup' ) ) {
	require_once(ROOTDIR . 'includes/setup.php');
	$veolia_academy_setup = new Veolia_Academy_Setup();
	$error = $veolia_academy_setup->init();
}


if($error==0)
{	
	function veolia_widgets_init() {
 
		register_sidebar( array(
			'name' => __( 'Home Page Banner Content', 'wpb' ),
			'id' => 'home-banner',
		));
		
		register_sidebar( array(
			'name' => __( 'Home Page Banner Boxes', 'wpb' ),
			'id' => 'home-banner-boxes',
		));

		register_sidebar( array(
			'name' => __( 'Course List Content', 'wpb' ),
			'id' => 'course-list-content',
		));

		register_sidebar( array(
			'name' => __( 'Course Detail Content', 'wpb' ),
			'id' => 'course-detail-content',
		));

		register_sidebar( array(
			'name' => __( 'Left Sidebar Content', 'wpb' ),
			'id' => 'left-sidebar-content',
		));

		register_sidebar( array(
			'name' => __( 'Right Sidebar Content', 'wpb' ),
			'id' => 'right-sidebar-content',
		));
		
	}
	 
	add_action( 'widgets_init', 'veolia_widgets_init' );

	add_action('after_setup_theme', 'remove_admin_bar');

	function remove_admin_bar() {
		if (!current_user_can('administrator') && !is_admin()) {
			show_admin_bar(false);
		}
	}

	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-veolia-academy-activator.php
	 */
	function activate_veolia_academy() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-veolia-academy-activator.php';
		Veolia_Academy_Activator::activate();
	}

	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-veolia-academy-deactivator.php
	 */
	function deactivate_veolia_academy() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-veolia-academy-deactivator.php';
		Veolia_Academy_Deactivator::deactivate();
	}

	register_activation_hook( __FILE__, 'activate_veolia_academy' );
	register_deactivation_hook( __FILE__, 'deactivate_veolia_academy' );

	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 */

	require plugin_dir_path( __FILE__ ) . 'includes/constants.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-veolia-academy-ajax.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-veolia-academy.php';

	/** 
	 * admin-specific  
	 */

	require_once(ROOTDIR . 'admin/index.php');

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function run_veolia_academy() {

		$plugin = new Veolia_Academy();
		$plugin->run();

	}
	run_veolia_academy();
}
?>