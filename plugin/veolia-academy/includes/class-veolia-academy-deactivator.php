<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/includes
 * @author     Arunkumar <arunkumar.ravindran@zucisystems.com>
 */
class Veolia_Academy_Deactivator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		
		self::page_deletion('course-list');
		self::page_deletion('course-detail');
		self::page_deletion('shopping-cart');
		self::page_deletion('checkout-redirect');
		self::page_deletion('my-course-list');
		self::page_deletion('order-list');
		self::page_deletion('order-detail');
		self::page_deletion('user-activation');
		self::page_deletion('resend-activation-link');
		self::page_deletion('payment-status');	
	}

	public static function page_deletion($page_slug)
	{
		global $wpdb;
		$get_data_slug = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT ID from " . $wpdb->prefix . "posts WHERE post_name = %s",
				$page_slug
			)
		);
		$page_id = $get_data_slug->ID;
		if ($page_id > 0) {
			wp_delete_post($page_id, true);
		}
	}
}
