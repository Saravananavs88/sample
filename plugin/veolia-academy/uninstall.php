<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
	exit;
}

// global $wpdb;

// // drop a custom table on plugin Uninstall

// $table_array = array(
// 	'veolia_academy_order_detail_course',
// 	'veolia_academy_order',
// 	'veolia_academy_learning_track_mapping',
// 	'veolia_academy_admin_settings',
// 	'veolia_academy_course_status',
// 	'veolia_academy_payment'


// );

// //execute query to delete tables
// foreach ($table_array as $table_name) {
// 	$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}$table_name");
// }

?>
