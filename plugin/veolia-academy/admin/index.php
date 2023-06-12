<?php

/**
 * Register menu elements and do other global tasks.
 *
 * @since 1.0.0
 */


class Veolia_Academy_Admin_Menu
{

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{

		// Let's make some menus.
		add_action('admin_menu', [$this, 'veolia_academy_menu'], 9);
	}
	// function to add menu items detail
	public function veolia_academy_menu()
	{
		// Default Forms top level menu item.
		add_menu_page(
			'Veolia Academy Settings',
			'LMS',
			'manage_options',
			'veolia-academy-settings',
			[$this, 'veolia_academy_settings']
		);

	}

	public function veolia_academy_settings()
	{
		ob_start();
		require_once plugin_dir_path(__FILE__) . 'class-veolia-academy-admin.php';
		$veolia_lms_admin = new Veolia_Academy_Admin(null, null);
		$veolia_lms_admin->veolia_academy_settings();
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}
	
}

new Veolia_Academy_Admin_Menu();
