<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/admin
 * @author     Arunkumar <arunkumar@zucisystems.com>
 */
class Veolia_Academy_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Bootstrap cdn include hook
		$page = isset($_GET['page']) ? trim($_GET['page']) : "";
		if ($page == 'veolia-academy-settings') {


			wp_register_style('veolia-academy-bootstrap-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css');
			wp_enqueue_style('veolia-academy-bootstrap-cdn');
			wp_register_style('veolia-academy-font-awesome-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css');
			wp_enqueue_style('veolia-academy-font-awesome-cdn');
			wp_register_style('veolia-academy-select2-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css');
			wp_enqueue_style('veolia-academy-select2-cdn');
		}
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/veolia-academy-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$page = isset($_GET['page']) ? trim($_GET['page']) : "";
		if ($page == 'veolia-academy-settings') {

			wp_register_script('bootstrap-jQuery', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js', false, false, true);
			wp_enqueue_script('bootstrap-jQuery');
			wp_register_script('select2-jQuery', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js', false, false, true);
			wp_enqueue_script('select2-jQuery');
		}
		wp_enqueue_script('veolia-academy-admin-style', plugin_dir_url(__FILE__) . 'js/veolia-academy-admin.js', array('jquery'), $this->version, true);
		wp_localize_script('veolia-academy-admin-style', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
	}



	public function veolia_academy_settings()
	{
		$slug_name = $_GET['page'];
		if ($slug_name == 'veolia-academy-settings') {

			$retrieved_data = $this->fetch_ispring_credentials();
			$learning_table = $this->get_courses_from_api();

			if (empty($retrieved_data)) {

				$error404 = '<h2>Oops, This Page Could Not Be Found!</h2>
							<div class="fusion-column col-lg-4 col-md-4 col-sm-4 fusion-error-page-404">
								<div class="error-message">404</div>
							</div>';

				return $error404;
			} else {
				$config_id = $retrieved_data->id;

				$result = $this->ispring_credentials_validation($config_id);
				$retrieved_data = $this->fetch_ispring_credentials();
				require_once(plugin_dir_path(__FILE__) . 'partials/veolia-academy-admin-settings.php');
			}
		}
	}

	public function fetch_learning_track_ajax()
	{
		global $wpdb;
		$learning_track_id = $_POST['learning_track_id'];
		$result = array();
		if (isset($learning_track_id)  && $learning_track_id != '') {
			$veolia_academy_learning_track_mapping = $wpdb->prefix . "veolia_academy_learning_track_mapping";
			$fetch_data = $wpdb->get_results("SELECT * FROM $veolia_academy_learning_track_mapping where learning_track_id='$learning_track_id'");

			if (empty($fetch_data)) {
				$result['image_url'] = plugin_dir_url(__DIR__) . 'admin/images/veolia.png';
				$result['price'] =  '';
			} else {
				$result = $fetch_data[0];
			}
		}
		$data = json_encode($result);
		echo $data;
		wp_die();
	}

	public function learning_track_ajax()
	{
		global $wpdb;
		$content_id = $_POST['content_id'];
		$price = (int) $_POST['price'];
		$image = $_POST['image_url'];
		$instructor = $_POST['instructor'];		

		if ($image != '') {
			$image_url = $image;
		} else {
			$image_url = plugin_dir_url(__DIR__) . 'admin/images/veolia.png';
		}

		$learning_track_mapping = $wpdb->prefix . "veolia_academy_learning_track_mapping";

		if ($content_id != '' && $price != '' && $instructor != '') {

			$fetch_data = $wpdb->get_results("SELECT * FROM  {$wpdb->prefix}veolia_academy_learning_track_mapping where learning_track_id='$content_id'");
			$ispring_url = $fetch_data[0];
			$total = count((array)$ispring_url);
			if ($total == 0 && !$total >= 1) {
				$inserted = $wpdb->insert(
					$learning_track_mapping,
					array(
						'learning_track_id' => $content_id,
						'image_url' => $image_url,
						'price' => $price,
						'instructor' => $instructor

					),
					array('%s', '%s', '%d','%s')
				);

				if ($inserted == true) {

					$result['success'] = 'Inserted';
				} else {
					$result['danger'] = 'Failed';
				}
			} else {
				// update ispring url
				$updated = $wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}veolia_academy_learning_track_mapping SET price='$price', image_url='$image_url', instructor='$instructor'
				WHERE learning_track_id='$content_id'"));


				if ($updated == true) {

					$result['success'] = 'Updated';
				} else {

					$result['danger'] = 'Failed';
				}
			}
			$response_json = wp_json_encode($result);
			print_r($response_json);
			wp_die();
		}
	}

	public function admin_order_course_view_ajax()
	{
		global $wpdb, $course_list_api, $cost;
		$vro_lms_order_id = (int) $_POST['order_id'];
		$userid = (int) $_POST['order_user_id'];
		$vro_lms_order_status = $_POST['order_status'];
		$vro_lms_user_email = $_POST['order_user_email'];

		if (isset($vro_lms_order_id) && isset($userid)  && isset($vro_lms_user_email)  &&  isset($vro_lms_order_status) && $vro_lms_order_id != "" && $userid != ""  && $vro_lms_user_email != "" && $vro_lms_order_status != "") {

			$table_order_details = $wpdb->prefix . 'veolia_academy_order_detail_course';
			$vrolms_ordersdetail = $wpdb->get_results("SELECT * FROM $table_order_details where user_id= '" . $userid . "' and  order_detail_id= '" . $vro_lms_order_id . "' ", "ARRAY_A");
			$vro_lms_orders_detail_list = array();
			$is_error = 0;
			$veolia_user_type = '';
			$price = $cost;
			foreach ($vrolms_ordersdetail as $orderdata) {
				$api = new Veolia_Academy_API();
				$data = '';
				$learning_track = $api->callAPI('GET', $course_list_api . '/' . $orderdata["course_id"], $data);
				$table_learning_track_mapping = $wpdb->prefix . 'veolia_academy_learning_track_mapping';
				$learning_track_price = '';
				$learning_track_price = $wpdb->get_var("SELECT price from $table_learning_track_mapping WHERE learning_track_id = '" . $learning_track['contentItem']['contentItemId'] . "'");
				if ($learning_track_price != '')
					$price = (int) $learning_track_price;
				else
					$price = (int) $cost;
				$vro_lms_orders_detail_list[] = array(
					"order_detail_id" => $orderdata["order_detail_course_id"],
					"order_detail_learning_program" => isset($learning_track['contentItem']['title']) ? $learning_track['contentItem']['title'] : '',
					"order_detail_qty" => 1,
					"order_detail_learning_program_fee" => $price,
				);
			}
			if (!empty($vro_lms_orders_detail_list)) {
				$veolia_user_type = 'internal';
				// $user_email = explode("@", $vro_lms_user_email);
				// if ($user_email[1] == 'veolia.com') {
				// 	$veolia_user_type = 'internal';
				// } else {
				// 	$veolia_user_type = 'external';
				// }
			} else {
				$is_error = 1;
			}
			$result_resp = array(
				"is_error" => $is_error,
				"data" => $vro_lms_orders_detail_list,
				"user_type" => $veolia_user_type
			);
			$result_encode = wp_json_encode($result_resp);
			print_r($result_encode);
		}
		wp_die();
	}


	public function fetch_ispring_credentials()
	{

		$slug_name = $_GET['page'];
		if ($slug_name == 'veolia-academy-settings') {
			global $wpdb;
			$veolia_academy_settings = $wpdb->prefix . "veolia_academy_settings";
			$fetch_data = $wpdb->get_results("SELECT * FROM $veolia_academy_settings where 1");
			$data = $fetch_data[0];
			return $data;
		}
	}

	public function ispring_credentials_validation($config_id)
	{

		if (isset($_POST['update-credentials-btn'])) {
			$id = $config_id;
			$ispring_account_url = $_POST['ispring_acc_url'];
			$ispring_account_email = $_POST['ispring_acc_email'];
			$ispring_password = $_POST['ispring_acc_password'];
			$ispring_account_password = base64_encode($ispring_password);
			$department_internal = $_POST['department_internal'];
			$department_external = $_POST['department_external'];
			$default_cost = $_POST['default_cost'];


			if ($ispring_account_url != '' && $ispring_account_email != '' && $ispring_account_password != '' && $department_internal != '' &&  $department_external != '' && $default_cost != '') {

				global $wpdb;
				$veolia_academy_settings = $wpdb->prefix . "veolia_academy_settings";
				$updated = $wpdb->query($wpdb->prepare("UPDATE $veolia_academy_settings SET ispring_account_url='$ispring_account_url',
				ispring_account_email='$ispring_account_email', cost=$default_cost, ispring_account_password='$ispring_account_password', department_internal='$department_internal', department_external='$department_external'
				
				 WHERE id='$id'"));


				return "<span class='text-success'>Updated successfully.</span>";
			} else {
				return "<span class='text-danger'>Please enter all fields!</span>";
			}
			return '';
		}
	}


	public function get_courses_from_api()
	{
		global $course_list_api, $learning_track_course_mapping_api, $cost;
		$api = new Veolia_Academy_API();
		$data = '';
		$results = $api->callAPI('GET', $course_list_api, $data);
		$learning_tracks = array();
		$counter = 0;
		if (isset($results['contentItem'])) {
			foreach ($results['contentItem'] as $result) {
				if ($result['type'] == 'Learning Track') {
					$learning_tracks[$counter] = $result;
					$mapping_courses = $api->callAPI('GET', $learning_track_course_mapping_api . $result['contentItemId'], $data);
					$learning_tracks[$counter]['course_count'] = isset($mapping_courses['learningTrackCourse']) ? count($mapping_courses['learningTrackCourse']) : 0;
					$counter++;
				}
			}
		}

		return $learning_tracks;
	}


	public function custom_post_about_portfolio()
	{
		$labels = array(
			'name'               => _x('About us portfolio', 'post type general name'),
			'singular_name'      => _x('portfolio', 'post type singular name'),
			'add_new'            => _x('Add New', 'profile'),
			'add_new_item'       => __('Add New profiles'),
			'edit_item'          => __('Edit profiles'),
			'new_item'           => __('New profiles'),
			'all_items'          => __('All profiles'),
			'view_item'          => __('View profiles'),
			'search_items'       => __('Search profiles'),
			'not_found'          => __('No products found'),
			'not_found_in_trash' => __('No products found in the Trash'),
			'parent_item_colon'  => '',
			'menu_name'          => 'About Portfolio'
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Holds our portfolios and profiles specific data',
			'public'        => true,
			'menu_position' => 30,
			'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
			'has_archive'   => true,
		);
		register_post_type('portfolio', $args);
	}
}
