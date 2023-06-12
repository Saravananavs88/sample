<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/includes
 * @author     Arunkumar <arunkumar.ravindran@zucisystems.com>
 */
class Veolia_Academy_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

  		
		  // create table on plugin activation
		  require_once(ROOTDIR . 'public/partials/class-veolia-academy-public-tables.php');
		  $table_array = array(					
			'veolia_academy_order',
		    'veolia_academy_learning_track_mapping',
		    'veolia_academy_order_detail_course',
			'veolia_academy_admin_settings',
			'veolia_academy_course_status',
			'veolia_academy_payment'

		  );
		  $table_obj = new database_table();
		  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		  foreach ($table_array as $tablename) {
			  $sql = $table_obj->$tablename();
			  dbDelta($sql);
		  }
		  
		    // insert ispring configuration in table activation 

            global $wpdb;
			//$wpdb->query($table_obj->veolia_academy_essentials());

            $veolia_academy_settings = $wpdb->prefix . "veolia_academy_settings";

            // Default hardcode SMPT Values

            $ispring_account_url = 'https://test.ispringlearn.com/';
            $ispring_account_email = 'test@gmail.com';
            $ispring_password = 'test123';
            $department_internal = '0ddf65d2-d2be-11ed-82d1-e6cf5a446272';
			$department_external = '0dd8b840-d2be-11ed-bf82-e6cf5a446272';
			$ispring_account_password = base64_encode($ispring_password);
			$cost = 200;
			
            $get_results = $wpdb->get_results("SELECT * FROM $veolia_academy_settings");

            //   Insert credentials into wp_veolia_academy_settings table

            if (empty($get_results)){           
                $wpdb->insert(
                    $veolia_academy_settings,
                    array(
                        'ispring_account_url' => $ispring_account_url,
                        'ispring_account_email' => $ispring_account_email,
                        'ispring_account_password' => $ispring_account_password,
                        'department_internal' => $department_internal,
						'department_external' => $department_external,
						'cost' =>$cost
                    ),
                    array('%s', '%s', '%s','%s', '%s', '%d')
                );
            }

		self::page_creation('course-list','Training Options');
		self::page_creation('course-detail','Courses Details');
		self::page_creation('shopping-cart','Shopping Cart');
		self::page_creation('checkout-redirect','Checkout Redirect');
		self::page_creation('my-course-list','My Courses');
		self::page_creation('order-list','My Orders');
		self::page_creation('order-detail','My Order Detail');	
		self::page_creation('user-activation','User Activation');
		self::page_creation('resend-activation-link','Resend Activation');
		self::page_creation('payment-status','Payment Status');				
	}

	public static function page_creation($page_slug,$page_title)
	{
		global $wpdb;
		$get_data_slug = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT post_name from " . $wpdb->prefix . "posts WHERE post_name = %s",
				$page_slug
			)
		);
		if (empty($get_data_slug)) {
			$new_page = array(
				'post_type'     => 'page',
				'post_title'    => $page_title,
				'post_content'  => '',
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_name'     => $page_slug
			);

			if (!get_page_by_path($page_slug, OBJECT, 'page')) {
				$new_page_id = wp_insert_post($new_page);
			}
		}

	}

}

