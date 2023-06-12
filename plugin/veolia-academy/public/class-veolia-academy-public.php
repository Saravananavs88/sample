<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/public
 * @author     Arunkumar <arunkumar.ravindran@zucisystems.com>
 */
class Veolia_Academy_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	private $ispring_user_id;
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->ispring_user_id = '';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/veolia-academy-public.css', array(), $this->version, 'all');
	}

	public function enqueue_styles_login()
	{
		$custom_logo_id = get_theme_mod('custom_logo');
		$image = wp_get_attachment_image_src($custom_logo_id, 'full');
		if (isset($image[0]) && isset($image[1]) && isset($image[2])) {
			echo '<style type="text/css">
					#login h1 a, .login h1 a {
					background-image: url(' . $image[0] . ');
					height:40px;
					width:320px;
					background-size: contain;
					background-repeat: no-repeat;
					padding-bottom: 10px;
				}
				//.login .button.wp-hide-pw .dashicons {top : -0.75rem !important;}
				</style>';
		}
		echo '<script type="text/javascript" language="javascript">
                window.onload = function(){
                    document.getElementById("togglePassword").onclick = function() {
                        var x = document.getElementById("user_password");
                        var toggleId=document.getElementById("togglePassword");
                            if (x.type === "password") {
                                toggleId.classList.remove("dashicons-visibility");
                                x.type = "text";
                                toggleId.classList.add("dashicons-hidden");
                            } else {
                                toggleId.classList.add("dashicons-visibility");
                                x.type = "password";
                            }
                        }
                    document.getElementById("conformTogglePassword").onclick = function() {
                        var x = document.getElementById("confirm_password");
                        var ConfirmToggleId=document.getElementById("conformTogglePassword");
                            if (x.type === "password") {
                                ConfirmToggleId.classList.remove("dashicons-visibility");
                                x.type = "text";
                                ConfirmToggleId.classList.add("dashicons-hidden");
                            } else {
                                ConfirmToggleId.classList.add("dashicons-visibility");
                                x.type = "password";
                            }
                        }      
                    document.getElementById("wp-submit").onclick = function() {
                        //this.disabled = true;
                    }
                };
            </script>';
	}

	public function change_login_logo_url()
	{
		return home_url();
	}

	function change_login_logo_url_title()
	{
		return 'Veolia Academy';
	}

	public function adding_fields_register_form()
	{
		global $country_name,$area_of_interest_list,$job_list;
		$first_name = (!empty($_POST['first_name'])) ? trim($_POST['first_name']) : '';
		$last_name = (!empty($_POST['last_name'])) ? trim($_POST['last_name']) : '';
		$phone = (!empty($_POST['phone'])) ? trim($_POST['phone']) : '';
		$job_title = (!empty($_POST['job_title'])) ? trim($_POST['job_title']) : '';
		$country = (!empty($_POST['country'])) ? trim($_POST['country']) : '';
		$location = (!empty($_POST['location'])) ? trim($_POST['location']) : '';
		$training_area = (!empty($_POST['training_area'])) ? trim($_POST['training_area']) : '';
		$state = (!empty($_POST['state'])) ? trim($_POST['state']) : '';
		$user_password = (!empty($_POST['user_password'])) ? trim($_POST['user_password']) : '';
		$confirm_password = (!empty($_POST['confirm_password'])) ? trim($_POST['confirm_password']) : '';

		wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css', false, NULL, 'all');
		echo '<style type="text/css">
	        #login {
		      width: 600px !important;
	        }
			body{
				background-color:#f0f0f1 !important;
			}
			#login h1 a, .login h1 a {
				background-size: contain;
				padding-bottom:85px;
			}
			#registerform p label::after {
				content:" *";
				color: red;
			}
        </style>';
		$countryOptions = '<option value="0">Select Country</option>';
		foreach ($country_name as $key => $value) {
			$isSelectd = "";
			if (isset($country) && $country == $key)
				$isSelectd = "selected";
			$countryOptions .= '<option value="' . $key . '" ' . $isSelectd . '>' . $value . '</option>';
		}
		$areaInterestOptions = '<option value="0">Select primary area of interest</option>';
		foreach ($area_of_interest_list as $value1) {
			$isSelectd1 = "";
			if (isset($training_area) && $training_area == $value1)
				$isSelectd1 = "selected";
			$areaInterestOptions .= '<option value="' . $value1 . '" ' . $isSelectd1 . '>' . $value1 . '</option>';
		}
		$jobFunctionOption = '<option value="0">Select job function</option>';
		foreach ($job_list as $value2) {
			$isSelectd2 = "";
			if (isset($job_title) && $job_title == $value2)
				$isSelectd2 = "selected";
			$jobFunctionOption .= '<option value="' . $value2 . '" ' . $isSelectd2 . '>' . $value2 . '</option>';
		}
		echo '
		    <div class="form-row" style="display:flex">
				<div class="form-group col-md-6 mb-0">
					<label for="user_password">Password</label><span class="mandatory" style="color:red;"> *</span>
					<input type="password" name="user_password" id="user_password" class="input" value="' . esc_attr(wp_unslash($user_password)) . '" size="25" />
					<span class="dashicons dashicons-visibility" style="color: #2271b1 !important; background: #fff; margin-top: -55px;
					margin-right: 20px; position:relative; float:right; border-radius: 4px; padding: 8px; border-color: #2271b1 !important; vertical-align: top  !important;" aria-hidden="true" id="togglePassword"></span>
				</div>
				<div class="form-group col-md-6 mb-0">
					<label for="confirm_password">Confirm Password</label><span class="mandatory" style="color:red;"> *</span>
					<input type="password" name="confirm_password" id="confirm_password" class="input" value="' . esc_attr(wp_unslash($confirm_password)) . '" size="25" />
					<span class="dashicons dashicons-visibility" style="color: #2271b1 !important; background: #fff; margin-top: -55px;
					margin-right: 20px; position:relative; float:right; border-radius: 4px; padding: 8px; border-color: #2271b1 !important; vertical-align: top  !important;" aria-hidden="true" id="conformTogglePassword"></span>
				</div>
			</div>
			<div class="form-row" style="display:flex">
				<div class="form-group col-md-6">
					<label for="first_name">First Name</label><span class="mandatory" style="color:red;"> *</span>
				<input type="text" class="form-control" name="first_name" id="first_name" class="input" value="' . esc_attr(wp_unslash($first_name)) . '" />
				</div>
				<div class="form-group col-md-6">
					<label for="last_name">Last Name</label><span class="mandatory" style="color:red;"> *</span>
					<input type="text" class="form-control" name="last_name" id="last_name" value="' . esc_attr(wp_unslash($last_name)) . '" />
				</div>
			</div>

			<div class="form-row" style="display:flex">
				<div class="form-group col-md-6">
					<label for="country">Country</label>
					<select id="country" name="country" class="form-control" style="max-width:100%">
					' . $countryOptions . '	
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="phone">Phone</label>
					<input type="text" class="form-control mb-0" name="phone" id="phone" value="' . esc_attr(wp_unslash($phone)) . '" />
					<small class="text-muted">Format: +12345678900</small>
				</div>
			</div>

			<div class="form-row" style="display:flex">
				<div class="form-group col-md-6">
					<label for="state">State</label><span class="mandatory" style="color:red;"> *</span>
					<input type="text" class="form-control"  name="state" id="state" value="' . esc_attr(wp_unslash($state)) . '" />
				</div>
				<div class="form-group col-md-6">
					<label for="location">Location</label><span class="mandatory" style="color:red;"> *</span>
					<input type="text" class="form-control" name="location" id="location" class="input" value="' . esc_attr(wp_unslash($location)) . '" />
				</div>
			</div>

			<div class="form-row" style="display:flex">
				<div class="form-group col-md-6">
					<label for="training_area">Primary Area of Interest</label><span class="mandatory" style="color:red;"> *</span>
					<select id="training_area" name="training_area" class="form-control" style="max-width:100%">
					' . $areaInterestOptions . '	
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="job_title">Job Function</label><span class="mandatory" style="color:red;"> *</span>
					<select id="job_title" name="job_title" class="form-control" style="max-width:100%">
					' . $jobFunctionOption . '	
					</select>
			   </div>
			</div>';
	}

	public function new_user_notification_email($wp_new_user_notification_email, $user, $blogname, $timestamp = '')
	{
		include(plugin_dir_path(__FILE__) . 'templates/email_template.php');
		$custom_logo_id = get_theme_mod('custom_logo');
		$image = wp_get_attachment_image_src($custom_logo_id, 'full');
		$homepage = get_option('siteurl');
		$wp_new_user_notification_email['subject'] = 'Welcome to Veolia Academy!';
		$title = '';
		if ($timestamp != '') {

			$activation_link = get_option('siteurl') . "/user-activation?key=$user->user_activation_key&user=$user->ID&timestamp=$timestamp";
		} else {
			$activation_link = get_option('siteurl') . "/user-activation?key=$user->user_activation_key&user=$user->ID";
		}

		$message =  "There is one final step before you can begin your online training. Please click the link below to activate your account for Veolia Academy.<br>";
		$message .= '<br><cente><a class="btn btn-success" href="' . $activation_link . '">Click to activate your account now</a><br>';
		$message .= "<br>Once Activated, you will be all set to take any of the world class training content at Veolia Academy.<br>";
		$message .= "<br>Best,<br>Veolia Academy Team";
		$wp_new_user_notification_email['message'] = send_email($homepage, $image[0], $message, $title);
		$wp_new_user_notification_email['headers'] = 'Content-type: text/html';
		return $wp_new_user_notification_email;
	}

	public function logout_without_confirm($action, $result)
	{
		/**
		 * Allow logout without confirmation
		 */
		$redirect_to = get_option('siteurl') . "/wp-login.php?action=login";
		if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
			$location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
			header("Location: $location");
			die;
		}
	}

	public function registration_validations($errors, $sanitized_user_login, $user_email)
	{


		return $this->register_user_validation($errors, null, $_POST['first_name'], $_POST['last_name'], $sanitized_user_login, $user_email, 'user-register', $_POST['phone'], $_POST['job_title'], $_POST['state'], $_POST['country'],  $_POST['location'],  $_POST['training_area'], $_POST['user_password'], $_POST['confirm_password']);
	}

	public function register_user_validation($errors, $user_id, $userFirstname, $userLastname, $userLoginName, $regUserEmail, $type, $userPhoneNumber, $userJobTitle, $userState, $userCountry, $userLocation, $userTrainingArea, $password = "", $confirm_password = "")
	{
		global $register_api, $department_internal, $department_external, $default_password;
		$action = isset($_GET['action']) ? $_GET['action'] : '';
		if (empty($userFirstname))
			$errors->add('first_name_error', __('<strong>Error</strong>: Please enter a first name.', 'veolia-academy'));

		if (empty($userLastname))
			$errors->add('last_name_error', __('<strong>Error</strong>: Please enter a last name.', 'veolia-academy'));


		if (isset($userFirstname)) {
			if (!preg_match('/^[A-Za-z]{1,60}$/', $userFirstname)) {
				$errors->add('first_name_error', __('<strong>Error</strong>: The first name should contain only alphabets.', 'veolia-academy'));
			}
		}

		if (isset($userLastname)) {
			if (!preg_match('/^[A-Za-z -]{1,60}$/', $userLastname)) {
				$errors->add('last_name_error', __('<strong>Error</strong>: The last name should contain only alphabets,space and hypens.', 'veolia-academy'));
			}
		}

		if (empty($userJobTitle)) {
			$errors->add('job_title_error', __('<strong>Error</strong>: Please select a job function.', 'veolia-academy'));
		}

		if (empty($userState)) {
			$errors->add('state_error', __('<strong>Error</strong>: Please enter a state.', 'veolia-academy'));
		}

		if (empty($userLocation)) {
			$errors->add('location_error', __('<strong>Error</strong>: Please enter a location.', 'veolia-academy'));
		}

		if (empty($userTrainingArea)) {
			$errors->add('training_area_error', __('<strong>Error</strong>: Please select a primary area of interest.', 'veolia-academy'));
		}

		if ($action == 'register') {
			if (empty($password))
				$errors->add('user_password_error', __('<strong>Error</strong>: Please enter a password.', 'veolia-academy'));

			if (empty($confirm_password))
				$errors->add('confirm_password_error', __('<strong>Error</strong>: Please enter a confirm password.', 'veolia-academy'));

			if (isset($password) && $password != $confirm_password) {
				$errors->add('matchpassword_error', __('<strong>Error</strong>: Password and confirm password field do not match.', 'veolia-academy'));
			} else {
				if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $password)) {
					$errors->add('passwordregex_error', __('<strong>Error</strong>: Password must be a minimum of 8 characters and maximum of 20 characters – contain uppercase, lowercase, numeric and special character [!,@,#,$,%]. ', 'veolia-academy'));
				}
			}
		}


		$result = array();

		$get_admin_url = get_admin_url();
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$getslugname = str_replace($get_admin_url, '', $actual_link);
		$rmslash = preg_replace('|/|', '', $getslugname);

		$userEmail = explode("@", $regUserEmail);
		if ($userEmail[1] == 'veolia.com') {
			$department_id =  $department_internal;
		} else {
			$department_id =  $department_external;
		}
		//ispring API call for registration
		if (!empty($userLoginName) && count($errors->errors) == 0) {

			if ($rmslash == 'user-edit.php' && isset($user_id) != '') {

				// Update user
				$all_meta_for_user = get_user_meta($user_id);

				if (isset($all_meta_for_user['ispring_user_id'][0])) {
					$ispring_user_id = $all_meta_for_user['ispring_user_id'][0];
					$api = new Veolia_Academy_API();
					$data = '<?xml version="1.0" encoding="UTF-8"?>
				<request>
					<fields>	
						<login>' . $userLoginName . '</login>			
						<email>' . $regUserEmail . '</email>
						<first_name>' . $userFirstname . '</first_name>
						<last_name>' . $userLastname . '</last_name>
						<phone>' . $userPhoneNumber . '</phone>
						<job_title>' . $userJobTitle . '</job_title>
						<country>' . $userCountry . '</country>
						<USER_DEFINED_FIELD1>' . $userLocation . '</USER_DEFINED_FIELD1>
						<USER_DEFINED_FIELD2>' . $userTrainingArea . '</USER_DEFINED_FIELD2>
						<USER_DEFINED_FIELD3>' . $userState . '</USER_DEFINED_FIELD3>
					
					</fields>					
				</request>';

					$result = $api->callAPI('POST', $register_api . '/' . $ispring_user_id, $data);
				}
			} else {
				// insert user			
				$api = new Veolia_Academy_API();
				$data = '<?xml version="1.0" encoding="UTF-8"?>
					<request>
						<departmentId>' . $department_id . '</departmentId>
						<password>' . base64_encode($default_password) . '</password>
						<fields> 
							<login>' . $userLoginName . '</login>
							<email>' . $regUserEmail . '</email>
							<first_name>' . $userFirstname . '</first_name>
							<last_name>' . $userLastname . '</last_name>
							<phone>' . $userPhoneNumber . '</phone>
						    <job_title>' . $userJobTitle . '</job_title>
							<country>' . $userCountry . '</country>
						    <USER_DEFINED_FIELD1>' . $userLocation . '</USER_DEFINED_FIELD1>
						    <USER_DEFINED_FIELD2>' . $userTrainingArea . '</USER_DEFINED_FIELD2>
							<USER_DEFINED_FIELD3>' . $userState . '</USER_DEFINED_FIELD3>

						</fields> 
						<role>learner</role>
					</request>';

				$result = $api->callAPI('POST', $register_api, $data);
			}
		}
		
		$resultMessage = [];
		if (isset($result))
			$resultMessage = explode(' ', $result['message']);
		if (isset($result['code']) && $result['code'] != 200) {
			if ($rmslash == 'user-edit.php' && isset($user_id) != '') {
				$errors->add('user_login_error', __('<strong>Error</strong>: User is not registered in iSpring Learn' . '.', 'veolia-academy'));
			} else {
				if ($result['code'] == 400 && $resultMessage[0] == 'Duplicate') {
					$errors->add('email_error', __('<strong>Error</strong>: User is already registered!' . '.', 'veolia-academy'));
				} elseif ($result['code'] == 400 && $resultMessage[0] == 'Phone') {
					$errors->add('email_error', __('<strong>Error</strong>: Minimum Phone number length is more than 6' . '.', 'veolia-academy'));
				} else {
					$errors->add('email_error', __('<strong>Error</strong>: User not able to register, please contact administrator' . '.', 'veolia-academy'));
				}
			}
		} else {

			$this->ispring_user_id = isset($result[0]) ? $result[0] : '';
		}

		if (isset($errors->errors) && !empty($errors->errors) && $type == "manual-register") {
			$errors->add('is_add_user_error_exists', __('1', 'veolia-academy'));
			$this->admin_notice__error($errors->errors);
		}


		return $errors;
	}

	public function admin_notice__error($errors)
	{
		if (!empty($errors) && isset($errors["is_add_user_error_exists"])) {
			$errormessage = "";
			foreach ($errors as $eKey => $eVal) {
				if ($eKey != 'is_add_user_error_exists') {
					$errormessage .= $eVal[0] . "<br>";
				}
			}
			$class = 'notice notice-error';
			$message = __($errormessage, 'sample-text-domain');

			printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class),  $message);
		}
	}

	public function manual_registration_validations($errors, $update, $user)
	{

		$user_id = $user->ID;
		$role_is_subscriber = $user->role;
		$user_login = $user->user_login;
		$first_name = $user->first_name;
		$last_name = $user->last_name;
		$user_email = $user->user_email;
		$phone = $user->phone;
		$job_title = $user->job_title;
		$state = $user->state;
		$country = $user->country;
		$location = $user->location;
		$training_area = $user->training_area;

		if ($role_is_subscriber == 'subscriber') {

			return $this->register_user_validation($errors, $user_id, $first_name, $last_name, $user_login, $user_email, $phone, $job_title, $state, $country, $location, $training_area, 'manual-register');
		}
	}

	public function manual_delete_user($user_id)
	{
		global $register_api, $wpdb;
		//Delete user			
		$all_meta_for_user = get_user_meta($user_id);
		if (isset($all_meta_for_user['ispring_user_id'][0])) {
			$ispring_user_id = $all_meta_for_user['ispring_user_id'][0];
			$api = new Veolia_Academy_API();
			$api->callAPI('DELETE', $register_api . '/' . $ispring_user_id, $data = '');
		}

		// delete user from the wp_veolia_order_courses
		$table_order_detail_course = $wpdb->prefix . "veolia_academy_order_detail_course";
		$wpdb->delete($table_order_detail_course, array('user_id' => $user_id));

		// delete user from the wp_veolia_order
		$table_veolia_order = $wpdb->prefix . "veolia_academy_order";

		$wpdb->delete($table_veolia_order, array('order_user_id' => $user_id));


		// delete user from the wp_veolia_payment
		$veolia_academy_payment = $wpdb->prefix . "veolia_academy_payment";
		$wpdb->delete($veolia_academy_payment, array('payment_user_id' => $user_id));


		$user_data = get_userdata($user_id);
		include(plugin_dir_path(__FILE__) . 'templates/email_template.php');
		$custom_logo_id = get_theme_mod('custom_logo');
		$image = wp_get_attachment_image_src($custom_logo_id, 'full');
		$homepage = get_option('siteurl');
		$subject = 'User deleted from the Veolia academy application.';
		$title = '';
		$message = "<br>We are deleting your account, Your account at " . get_bloginfo() . " will be deleted.<br>";
		$message .= "<br>Best,<br>Veolia Academy Team";
		$message = send_email($homepage, $image[0], $message, $title);
		$headers = 'Content-type: text/html';
		wp_mail($user_data->user_email, $subject, $message, $headers);
	}

	public function before_authenticate_user($user, $username, $password)
	{
		global $register_api, $user_info_api;
		if (is_wp_error($user) && $username != '' && $password != '') {
			$api = new Veolia_Academy_API();
			$ispring_users = $api->callAPI('GET', $register_api, '');
			$username_match = 0;
			$ispring_user_match = '';
			//echo "<pre>"; print_r($ispring_users); exit;
			foreach ($ispring_users['userProfile'] as $ispring_user) {
				if ($ispring_user['role'] == 'learner' && $ispring_user['status'] == 1) {
					foreach ($ispring_user['fields']['field'] as $field) {
						if ($field['name'] == 'LOGIN' && $field['value'] == $username)
							$username_match = 1;
						if ($field['name'] == 'EMAIL' && $field['value'] == $username)
							$username_match = 1;
					}
				}
				if ($username_match == 1) {
					$ispring_user_match = $ispring_user;
					break;
				}
			}

			if ($ispring_user_match != '') {
				$first_name = '';
				$last_name = '';
				$email = '';
				foreach ($ispring_user_match['fields']['field'] as $field) {
					if ($field['name'] == 'EMAIL')
						$email = $field['value'];
					if ($field['name'] == 'FIRST_NAME')
						$first_name = $field['value'];
					if ($field['name'] == 'LAST_NAME')
						$last_name = $field['value'];
					if ($field['name'] == 'PHONE')
						$phone = $field['value'];
					if ($field['name'] == 'JOB_TITLE')
						$job_title = $field['value'];
					if ($field['name'] == 'COUNTRY')
						$country = $field['value'];
					if ($field['name'] == 'USER_DEFINED_FIELD1')
						$location = $field['value'];
					if ($field['name'] == 'USER_DEFINED_FIELD2')
						$training_area = $field['value'];
					if ($field['name'] == 'USER_DEFINED_FIELD3')
						$state = $field['value'];
				}
				$user_result  = wp_create_user($username, $password, $email);
				if (is_numeric($user_result)) {
					$user = get_userdatabylogin($username);
					$user_id = $user->ID;
					update_user_meta($user_id, 'ispring_user_id', $ispring_user_match['userId']);
					update_user_meta($user_id, 'first_name', $first_name);
					update_user_meta($user_id, 'last_name', $last_name);
					update_user_meta($user_id, 'phone', $phone);
					update_user_meta($user_id, 'job_title', $job_title);
					update_user_meta($user_id, 'country', $country);
					update_user_meta($user_id, 'location', $location);
					update_user_meta($user_id, 'training_area', $training_area);
					update_user_meta($user_id, 'state', $state);
					wp_set_current_user($user_id, $user->user_login);
					wp_set_auth_cookie($user_id);
					do_action('wp_login', $user->user_login);
				}
			}
		}

		return $user;
	}


	public function authenticate_user($user, $password)
	{
		global $user_info_api;
		$role = $user->roles[0];
		if ($user->user_status == 0 && $role == 'subscriber') {
			$error = new WP_Error();
			$error->add(403, 'User not activated, please use the activation link to activate your account.');

			return $error;
		} else {
			$all_meta_for_user = get_user_meta($user->ID);
			if (isset($all_meta_for_user['ispring_user_id'][0])) {
				$api = new Veolia_Academy_API();
				$data = '';
				$result = $api->callAPI('GET', $user_info_api . $all_meta_for_user['ispring_user_id'][0], $data);
				if (isset($result['code']) && $result['code'] != 200) {
					$error  = new WP_Error('authentication_failed', __('ERROR: Invalid username or incorrect password.'));
					return $error;
				}
			}
			$_SESSION['user_type'] = 'internal';
			// $user_email = explode("@", $user->user_email);
			// if ($user_email[1] == 'veolia.com')
			// 	$_SESSION['user_type'] = 'internal';
			// else
			// 	$_SESSION['user_type'] = 'external';
			$_SESSION['userId'] = $user->ID;
			return $user;
		}
	}

	public function redirect_on_login()
	{
		$homepage = get_option('siteurl');
		if (isset($_COOKIE['action_redirect']) && $_COOKIE['action_redirect'] != '') {
			$redirect_url = explode("=", $_COOKIE['action_redirect']);
			if (isset($redirect_url[1]) && ($redirect_url[1] == 'checkout' || $redirect_url[1] == 'buynow')) {
				if ($redirect_url[1] == 'buynow' && isset($redirect_url[2]) && $redirect_url[2] != '')
					wp_redirect($homepage . '/checkout-redirect?action_redirect=buynow&learning_id=' . $redirect_url[2]);
				else
					wp_redirect($homepage . '/checkout-redirect?action_redirect=checkout');
			} elseif (strpos($_COOKIE['action_redirect'], 'wp-login') !== false)
				wp_redirect($homepage);
			else
				wp_redirect($_COOKIE['action_redirect']);
		} else
			wp_redirect($homepage);
		exit;
	}

	public function register_session()
	{
		//creating a session start
		if (!session_id()) {
			session_start();
		}
	}

	public function registration_save($user_id)
	{
		global $wpdb;
		$action = isset($_GET['action']) ? $_GET['action'] : '';
		if ($action == 'register') {
			wp_set_password($_POST['user_password'], $user_id);

			$code = sha1($user_id . time());
			if ($user_id && !is_wp_error($user_id)) {
				$wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}users SET user_activation_key='$code' WHERE ID=$user_id"));
			}
		} else {

			$wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}users SET user_status=1 WHERE ID=$user_id"));
		}
		if (isset($_POST['first_name']))
			update_user_meta($user_id, 'first_name', $_POST['first_name']);

		if (isset($_POST['last_name']))
			update_user_meta($user_id, 'last_name', $_POST['last_name']);

		if (isset($_POST['phone']))
			update_user_meta($user_id, 'phone', $_POST['phone']);

		if (isset($_POST['job_title']))
			update_user_meta($user_id, 'job_title', $_POST['job_title']);

		if (isset($_POST['country']))
			update_user_meta($user_id, 'country', $_POST['country']);

		if (isset($_POST['location']))
			update_user_meta($user_id, 'location', $_POST['location']);

		if (isset($_POST['training_area']))
			update_user_meta($user_id, 'training_area', $_POST['training_area']);

		if (isset($_POST['state']))
			update_user_meta($user_id, 'state', $_POST['state']);

		update_user_meta($user_id, 'ispring_user_id', $this->ispring_user_id);
	}

	public function before_registration_save($user_login, $user_email, $errors)
	{
	}

	public function user_activation()

	{

		global $wpdb;
		$ID = isset($_GET['user']) ? $_GET['user'] : '';
		$Key = isset($_GET['key']) ? $_GET['key'] : '';
		$timestamp = isset($_GET['timestamp']) ? $_GET['timestamp'] : '';
		date_default_timezone_set('Asia/Kolkata');
		$current_Time = date('Y-m-d H:i:s');
		if ($timestamp != '') {
			$str_to_date = date('Y-m-d H:i:s', $timestamp);
			$expirytime = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($str_to_date)));
			if (strtotime($expirytime) < strtotime($current_Time)) {
				wp_redirect(home_url('/') . 'wp-login.php?user-activation=fail');
			} else {
				$wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}users SET user_activation_key='$Key',user_status=1 WHERE ID=$ID"));
				wp_redirect(home_url('/') . 'wp-login.php?user-activation=success');
			}
		} else {
			$insert_Time = $wpdb->get_results("SELECT user_registered FROM {$wpdb->prefix}users WHERE ID = $ID ");
			$time = $insert_Time[0]->user_registered;
			$expirytime = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($time)));
			if (strtotime($expirytime) < strtotime($current_Time)) {
				wp_redirect(home_url('/') . 'wp-login.php?user-activation=fail');
			} else {
				$wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}users SET user_activation_key='$Key',user_status=1
			WHERE ID=$ID"));
				wp_redirect(home_url('/') . 'wp-login.php?user-activation=success');
			}
		}
	}



	public function user_activation_message()
	{
		$message = isset($_GET['user-activation']) ? $_GET['user-activation'] : '';
		if ($message == 'fail')
			return '<p class="message">Activation link expired.</p>';
		if ($message == 'success')
			return '<p class="message">User activated successfully.</p>';
	}

	public function resend_activation_link()
	{


		$action = isset($_GET['action']) ? $_GET['action'] : '';

		if ($action == 'activatelink') {
			$_SESSION['resend_result_status'] = '';
			$_SESSION['resend_result_status_success'] = '';
			if (isset($_POST['resend_activation_submit'])) {
				$user_name_or_email = sanitize_user($_POST['user_login']);
				if (isset($user_name_or_email) && $user_name_or_email != '') {
					global $wpdb;
					$fetch_data = $wpdb->get_results("SELECT ID,user_login,user_email,user_activation_key,user_status FROM {$wpdb->prefix}users where user_login='$user_name_or_email' OR user_email='$user_name_or_email'");
					$user_data = $fetch_data[0];
					if (!empty($user_data)) {
						if ($user_data->user_status == 0) {
							date_default_timezone_set('Asia/Kolkata');
							$date = date('Y-m-d H:i:s');
							$timestamp = strtotime($date);
							$wp_new_user_notification_email = array();
							$wp_new_user_notification_email['to'] = $user_data->user_email;

							$result = $this->new_user_notification_email($wp_new_user_notification_email, $user_data, 'Veolia Academy', $timestamp);
							if (!empty($result)) {

								$sent = wp_mail($result['to'], $result['subject'], $result['message'], $result['headers']);
								if ($sent == true) {
									$_SESSION['resend_result_status_success'] = "A new activation link is sent. Please check your email.";
								} else {

									$_SESSION['resend_result_status'] = "<strong>ERROR:</strong> Failed to send activation link";
								}
							}
						} else {
							$_SESSION['resend_result_status'] = "<strong>ERROR:</strong> User is already activated, Please navigate to the <a href='" . site_url() . "/wp-login.php" . "' class='custom-login-link'>login page</a>.";
						}
					} else {
						$_SESSION['resend_result_status'] = "<strong>ERROR:</strong> There is no account with that username or email address.";
					}
				} else {

					$_SESSION['resend_result_status'] = '<strong>ERROR:</strong> Please enter a username or email address.';
				}
			}
			require_once plugin_dir_path(__DIR__) . 'public/templates/resend_active_link.php';
		}
	}




	public function remember_me_expiry($seconds, $user_id, $remember)
	{
		global $remember_me_expiry;
		//if "remember me" is checked;
		if ($remember) {
			//WP defaults to our configuration;
			$expiration = $remember_me_expiry * 24 * 60 * 60;
		} else {
			//WP defaults to 48 hrs/2 days;
			$expiration = 2 * 24 * 60 * 60; //UPDATE HERE;
		}
		//http://en.wikipedia.org/wiki/Year_2038_problem
		if (PHP_INT_MAX - time() < $expiration) {
			//Fix to a little bit earlier!
			$expiration =  PHP_INT_MAX - time() - 5;
		}
		return $expiration;
	}

	
	public function course_list()
	{
		global $course_list_api, $learning_track_course_mapping_api, $cost, $wpdb, $default_image;
		$course_keyword = '';
		
		$page = 1;
		
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
					$table_learning_track_mapping = $wpdb->prefix . 'veolia_academy_learning_track_mapping';
					$learning_track_mapping = $wpdb->get_results("SELECT image_url,price from $table_learning_track_mapping WHERE learning_track_id = '" . $result['contentItemId'] . "'", "ARRAY_A");
					$learning_track_mapping = isset($learning_track_mapping[0]) ? $learning_track_mapping[0] : array();
					if (empty($learning_track_mapping)) {
						$learning_track_mapping['price'] = $cost;
						$learning_track_mapping['image_url'] = $default_image;
					}
					$learning_tracks[$counter]['learning_track_mapping'] = $learning_track_mapping;
					$counter++;
				}
			}
		}
		$response = array();
		if(isset($_SESSION['course_list_data']))
			unset($_SESSION['course_list_data']);
		$response['learning_tracks'] = $learning_tracks;
		$response['course_keyword'] = $course_keyword;
		$response['page'] = $page;
		$_SESSION['course_list_data'] = $response;
		return $response;
		//require_once plugin_dir_path(__FILE__) . 'templates/course_list.php';
	}

	public function limit_desc($string, $limit)
	{
		$string = strip_tags($string);
		if (strlen($string) > $limit) {

			// truncate string
			$stringCut = substr($string, 0, $limit);
			$endPoint = strrpos($stringCut, ' ');

			//if the string doesn't contain any space then it will cut without word basis.
			$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
			$string .= '...';
		}
		return $string;
	}

	public function my_course_list()
	{
		$current_user = wp_get_current_user();
		$role = isset($current_user->roles[0]) ? $current_user->roles[0] : '';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-veolia-academy-authentication.php';
		//$homepage = get_option('siteurl');
		wp_redirect($redirectUrl);

		/*
		global $course_list_api, $learning_track_course_mapping_api, $cost, $wpdb;
		$current_user = wp_get_current_user();
		$role = $current_user->roles[0];
		$userid = $current_user->ID;
		if ($userid == 0) {
			wp_redirect(get_option('siteurl'));
			die();
		} else
			require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-veolia-academy-authentication.php';
		$api = new Veolia_Academy_API();
		$data = '';
		$results = $api->callAPI('GET', $course_list_api, $data);
		$learning_tracks = array();
		$counter = 0;
		$started = 0;
		if (isset($results['contentItem'])) {
			foreach ($results['contentItem'] as $result) {
				if ($result['type'] == 'Learning Track') {
					$table = $wpdb->prefix . 'veolia_academy_order_detail_course';
					$table_order = $wpdb->prefix . 'veolia_academy_order';
					$check_paid = $wpdb->get_var("SELECT COUNT(*) FROM $table as aod left join $table_order as ao on aod.order_detail_id=ao.order_id WHERE ao.order_status='success' and aod.course_id = '" . $result['contentItemId'] . "' and aod.user_id ='$userid' ");
					if ($check_paid == 0)
						continue;
					$learning_tracks[$counter] = $result;
					$mapping_courses = $api->callAPI('GET', $learning_track_course_mapping_api . $result['contentItemId'], $data);
					$learning_tracks[$counter]['course_count'] = isset($mapping_courses['learningTrackCourse']) ? count($mapping_courses['learningTrackCourse']) : 0;
					$course_progress = $api->callAPI('GET', $course_list_api . "/" . $result['contentItemId'] . "/final_statuses", $data);
					$all_meta_for_user = get_user_meta($userid);
					$learner_id = '';
					if (isset($all_meta_for_user['ispring_user_id'][0]))
						$learner_id = $all_meta_for_user['ispring_user_id'][0];

					$learning_tracks[$counter]['course_status'] = 'Not Started';
					$learning_tracks[$counter]['course_progress'] = 0;

					if (isset($course_progress["status"])) {
						if (!isset($course_progress["status"][0]))
							$course_progress["status"][0] = $course_progress["status"];

						foreach ($course_progress["status"] as $status) {
							$ispring_user_id = isset($status['userId']) ? $status['userId'] : '  ';
							if ($ispring_user_id == $learner_id) {
								if ($status['progress'] > 0)
									$started = 1;
								$learning_tracks[$counter]['course_status'] = $status['status'];
								$learning_tracks[$counter]['course_progress'] = $status['progress'];
							}
						}
					}
					$counter++;
				}
			}
		}
		require_once plugin_dir_path(__FILE__) . 'templates/my_course_list.php';
		*/
	}

	public function course_detail()
	{
		global $course_list_api, $learning_track_course_mapping_api, $cost, $wpdb, $default_image, $enrollement_api;
		$_SESSION['user_type'] = 'internal';
		$learning_track_id = isset($_GET['id']) ? $_GET['id'] : '';
		if ($learning_track_id == '')
			wp_redirect(site_url() . "/course-list");

		$current_user = wp_get_current_user();
		$role = isset($current_user->roles[0]) ? $current_user->roles[0] : '';
		$userid = $current_user->ID;
		$user_name = $current_user->display_name;
		$user_email = $current_user->user_email;

		$all_meta_for_user = get_user_meta($userid);
		$first_name = '';
		if (isset($all_meta_for_user['first_name'][0]))
			$first_name = $all_meta_for_user['first_name'][0];
		$last_name = '';
		if (isset($all_meta_for_user['last_name'][0]))
			$last_name = $all_meta_for_user['last_name'][0];


		$api = new Veolia_Academy_API();
		$data = '';


		$results = $api->callAPI('GET', $learning_track_course_mapping_api . $learning_track_id, $data);
		$learning_track = $api->callAPI('GET', $course_list_api . '/' . $learning_track_id, $data);
		$course_progress = $api->callAPI('GET', $course_list_api . "/" . $learning_track_id . "/final_statuses", $data);
		$all_meta_for_user = get_user_meta($userid);
		$learner_id = '';
		if (isset($all_meta_for_user['ispring_user_id'][0]))
			$learner_id = $all_meta_for_user['ispring_user_id'][0];
		$course_percentage = 0;
		$course_status = 'Not Started';

		if (isset($course_progress["status"])) {

			if (!isset($course_progress["status"][0]))
				$course_progress["status"][0] = $course_progress["status"];

			foreach ($course_progress["status"] as $status) {
				$ispring_user_id = isset($status['userId']) ? $status['userId'] : '  ';
				if ($ispring_user_id == $learner_id) {
					$course_status = $status['status'];
					$course_percentage = $status['progress'];
				}
			}
		}


		$table_learning_track_mapping = $wpdb->prefix . 'veolia_academy_learning_track_mapping';
		$learning_track_mapping = $wpdb->get_results("SELECT image_url,price,instructor from $table_learning_track_mapping WHERE learning_track_id = '" . $learning_track['contentItem']['contentItemId'] . "'", "ARRAY_A");
		$learning_track_mapping = isset($learning_track_mapping[0]) ? $learning_track_mapping[0] : array();
		if (empty($learning_track_mapping)) {
			$learning_track_mapping['price'] = $cost;
			$learning_track_mapping['image_url'] = $default_image;
			$learning_track_mapping['instructor'] = 'Kimberly Reeder';
		}
		$learning_track['learning_track_mapping'] = $learning_track_mapping;

		$check_paid = 0;
		if ($userid == 0) {
			$_SESSION['redirect_login'] = 2;
			$_SESSION['redirect_url_id'] = $learning_track_id;
		} else {
			$table = $wpdb->prefix . 'veolia_academy_order_detail_course';
			$table_order = $wpdb->prefix . 'veolia_academy_order';
			$check_paid = $wpdb->get_var("SELECT COUNT(*) FROM $table as aod left join $table_order as ao on aod.order_detail_id=ao.order_id WHERE ao.order_status='success' and aod.course_id = '$learning_track_id' and aod.user_id ='$userid' ");

			$enrollement_string = $enrollement_api . "?courseIds[]=" . $learning_track_id . "&learnerIds[]=" . $learner_id;
			$enrollement_result = $api->callAPI('GET', $enrollement_string, "");
			if (isset($enrollement_result['enrollment']['enrollmentId']) && $enrollement_result['enrollment']['enrollmentId'] != '')
				$check_paid = 1;
		}

		$courses = array();
		$counter = 0;
		$my_checkout_cart_data = array();

		$my_checkout_cart_data[$counter]['id'] = $learning_track['contentItem']['contentItemId'];
		$my_checkout_cart_data[$counter]['name'] = $learning_track['contentItem']['title'];
		$my_checkout_cart_data[$counter]['fees'] = $cost;
		$_SESSION['my_checkout_cart_data'] = json_encode($my_checkout_cart_data);
		$started = 0;
		if (isset($results['learningTrackCourse'])) {
			if (!isset($results['learningTrackCourse'][0])) {
				$temp = array();
				$temp[0] = $results['learningTrackCourse'];
				$results['learningTrackCourse'] = $temp;
			}
			foreach ($results['learningTrackCourse'] as $result) {
				$courses[$counter] = $api->callAPI('GET', $course_list_api . '/' . $result['courseId'], $data);
				$courses[$counter]['learning_track'] = $api->callAPI('GET', $course_list_api . '/' . $result['learningTrackId'], $data);

				$course_progress = $api->callAPI('GET', $course_list_api . "/" . $result['courseId'] . "/final_statuses", $data);

				$courses[$counter]['course_status'] = 'Not Started';
				$courses[$counter]['course_progress'] = 0;

				if (isset($course_progress["status"])) {
					if (!isset($course_progress["status"][0]))
						$course_progress["status"][0] = $course_progress["status"];

					foreach ($course_progress["status"] as $status) {
						$ispring_user_id = isset($status['userId']) ? $status['userId'] : '  ';
						if ($ispring_user_id == $learner_id) {
							$courses[$counter]['course_status'] = $status['status'];
							$courses[$counter]['course_progress'] = $status['progress'];
							if ($status['progress'] > 0)
								$started = 1;
						}
					}
				}


				$counter++;
			}
		}
		$cart_list_shopping_cart = isset($_SESSION["veolia_lms_my_cart_list"]) ? $_SESSION["veolia_lms_my_cart_list"] : '';
		$my_checkout_cart_data[$counter]['is_course_added_status'] = "Add to Cart";
		$my_checkout_cart_data[$counter]['cart_btn_disable'] = "";
		if (!empty($cart_list_shopping_cart)) {
			$array_match = in_array($learning_track_id, $cart_list_shopping_cart, true);
			if ($array_match == true) {
				$my_checkout_cart_data[$counter]['is_course_added_status'] = "Already added to cart";
				$my_checkout_cart_data[$counter]['cart_btn_disable'] = "disabled";
			} else {
				$my_checkout_cart_data[$counter]['is_course_added_status'] = "Add to Cart";
				$my_checkout_cart_data[$counter]['cart_btn_disable'] = "";
			}
		}

		$response = array();
		$response['learning_track'] = $learning_track;
		$response['userid'] = $userid;
		$response['courses'] = $courses;
		$response['my_checkout_cart_data'] = $my_checkout_cart_data;
		$response['first_name'] = $first_name;
		$response['last_name'] = $last_name;
		$response['user_email'] = $user_email;
		$response['course_status'] = $course_status;
		$response['course_percentage'] = $course_percentage;
		//$response['redirectUrl'] = $redirectUrl;
		$response['started'] = $started;
		$response['check_paid'] = $check_paid;
		$response['counter'] = $counter;
		return $response;

		//require_once plugin_dir_path(__FILE__) . 'templates/course_detail.php';
	}

	public function shopping_cart()
	{
		global $course_list_api, $learning_track_course_mapping_api, $cost, $wpdb;
		$_SESSION['user_type'] = 'internal';
		$current_user = wp_get_current_user();
		$userid = $current_user->ID;
		$user_name = $current_user->display_name;
		$user_email = $current_user->user_email;

		$all_meta_for_user = get_user_meta($userid);
		$first_name = '';
		if (isset($all_meta_for_user['first_name'][0]))
			$first_name = $all_meta_for_user['first_name'][0];
		$last_name = '';
		if (isset($all_meta_for_user['last_name'][0]))
			$last_name = $all_meta_for_user['last_name'][0];


		if ($userid == 0)
			$_SESSION['redirect_login'] = 1;

		$veolia_lms_sub_total = 0;
		$actual_cost = $cost;
		$cart_list = isset($_SESSION["veolia_lms_my_cart_list"]) ? $_SESSION["veolia_lms_my_cart_list"] : '';
		$my_cart_list = array();
		$my_checkout_cart_data = array();
		if (!empty($cart_list)) {
			$counter = 0;
			foreach ($cart_list as $cart_item) {
				$api = new Veolia_Academy_API();
				$data = '';
				$learning_track_id = isset($cart_item) ? $cart_item : '';
				$results = $api->callAPI('GET', $learning_track_course_mapping_api . $learning_track_id, $data);
				$learning_track = $api->callAPI('GET', $course_list_api . '/' . $learning_track_id, $data);
				$my_cart_list[$counter] = $learning_track;
				$my_cart_list[$counter]['courses'] = isset($results['learningTrackCourse']) ? count($results['learningTrackCourse']) : 0;
				$my_checkout_cart_data[$counter]['id'] = $learning_track['contentItem']['contentItemId'];
				$my_checkout_cart_data[$counter]['name'] = $learning_track['contentItem']['title'];
				$table_learning_track_mapping = $wpdb->prefix . 'veolia_academy_learning_track_mapping';
				$learning_track_price = '';
				$learning_track_price = $wpdb->get_var("SELECT price from $table_learning_track_mapping WHERE learning_track_id = '" . $learning_track_id . "'");

				$check_paid = 0;
				if ($userid != 0) {
					$table = $wpdb->prefix . 'veolia_academy_order_detail_course';
					$table_order = $wpdb->prefix . 'veolia_academy_order';
					$check_paid = $wpdb->get_var("SELECT COUNT(*) FROM $table as aod left join $table_order as ao on aod.order_detail_id=ao.order_id WHERE ao.order_status='success' and aod.course_id = '" . $learning_track_id . "' and aod.user_id ='$userid' ");
					$my_cart_list[$counter]['is_paid'] = $check_paid;
					$my_checkout_cart_data[$counter]['is_paid'] = $check_paid;
				}

				if ($learning_track_price == '') {
					$my_checkout_cart_data[$counter]['fees'] = $actual_cost;
					$cost = $actual_cost;
				} else {
					$my_checkout_cart_data[$counter]['fees'] = $learning_track_price;
					$cost = $learning_track_price;
				}
				$my_cart_list[$counter]['cost'] = $cost;
				if ($check_paid == 0)
					$veolia_lms_sub_total += $cost;
				$counter++;
			}
			$_SESSION['my_checkout_cart_data'] = json_encode($my_checkout_cart_data);
		}
		$veolia_lms_sub_total_view = number_format($veolia_lms_sub_total, 2, '.', '');
		$response = array();
		$response['my_cart_list'] = $my_cart_list;
		$response['veolia_lms_sub_total'] = $veolia_lms_sub_total;
		$response['veolia_lms_sub_total_view'] = $veolia_lms_sub_total_view;
		$response['userid'] = $userid;
		$response['first_name'] = $first_name;
		$response['last_name'] = $last_name;
		return $response;
		//require_once plugin_dir_path(__FILE__) . 'templates/shopping_cart.php';
	}

	public function payment_status()
	{
		global $wpdb;
		//To store the success and failure response received from paymentus
		$response = array();
		//$response['status'] = 'success';
		//return $response;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$payment_type_array = array();
			$reference_no_array = array();

			//changing array value from paymentus into string.
			for ($i = 0; $i < count($_POST); $i++) {
				//$payment_type =  isset($_POST["paymentType$i"]) ? array_push($payment_type_array,$_POST["paymentType$i"]) : ''; 
				$reference_no =  isset($_POST["referenceNumber$i"]) ? array_push($reference_no_array, $_POST["referenceNumber$i"]) : '';
			}
			//$payment_type = implode(',', $payment_type_array);
			$reference_number = implode(',', $reference_no_array);

			$table_payment = $wpdb->prefix . 'veolia_academy_payment';

			$emailid =  isset($_POST['customer_email0']) ? $_POST['customer_email0'] : null;
			//get the current login userid
			$user = get_user_by('email', $emailid);
			$userId = $user->ID;

			$status = isset($_POST['status0']) ? $_POST['status0'] : null;
			$firstName =  isset($_POST['customer_firstName0']) ? $_POST['customer_firstName0'] : null;
			$lastName =  isset($_POST['customer_lastName0']) ? $_POST['customer_lastName0'] : null;
			$email = isset($_POST['customer_email0']) ? $_POST['customer_email0'] : null;
			$amount = isset($_POST['amount0']) ? $_POST['amount0'] : null;
			$conveniencefee = isset($_POST['convenienceFee0']) ? $_POST['convenienceFee0'] : null;
			$payment_method_type = isset($_POST['paymentMethod_type0']) ? $_POST['paymentMethod_type0'] : null;
			$paymentdate = isset($_POST['paymentDate0']) ? $_POST['paymentDate0'] : null;
			$accountNumber = isset($_POST['accountNumber0']) ? $_POST['accountNumber0'] : null;
			$cardNumber = isset($_POST['paymentMethod_cardNumber0']) ? $_POST['paymentMethod_cardNumber0'] : null;
			$phone_number = isset($_POST['customer_dayPhone0']) ? $_POST['customer_dayPhone0'] : null;
			$zipCode0 = isset($_POST['customer_address_zipCode0']) ? $_POST['customer_address_zipCode0'] : null;
			$country = isset($_POST['customer_address_country0']) ? $_POST['customer_address_country0'] : null;
			$learning =  isset($_POST['customer_address_line10']) ? $_POST['customer_address_line10'] : null;

			$auth = isset($_POST['accountToken0']) ? $_POST['accountToken0'] : null;
			$transact_no  = isset($_POST['externalReferenceNumber0']) ? $_POST['externalReferenceNumber0'] : null;
			$currentdatetime = date('Y-m-d H:i:s');
			$order_total = $amount + $conveniencefee;
			$table_order = $wpdb->prefix . 'veolia_academy_order';
			if ($status == 'ACCEPTED') {
				$order_status = 'success';

				if (isset($_SESSION["veolia_lms_my_cart_list"]) && !empty($_SESSION["veolia_lms_my_cart_list"])) {
					unset($_SESSION["veolia_lms_my_cart_list"]);
				}

				if (isset($_SESSION['my_checkout_cart_data'])) {
					unset($_SESSION['my_checkout_cart_data']);
				}

				$wpdb->insert(
					$table_payment,
					array(
						'payment_user_id' => $userId,
						'payment_firstname' => $firstName,
						'payment_lastname' => $lastName,
						'payment_email' => $email,
						'payment_reference_no' => $reference_number,
						'payment_amount' => $amount,
						'payment_convenience_fee' => $conveniencefee,
						'payment_type' => $payment_method_type,
						'payment_date' => $paymentdate,
						'payment_account_number' => $accountNumber,
						'payment_card_number' => $cardNumber,
						'payment_phone_number' => $phone_number,
						'payment_zipcode' => $zipCode0,
						'payment_country' => $country,
						'payment_status' => $status,
						'payment_updated_datetime' => $currentdatetime
					),
					array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
				);

				$payment_id = $wpdb->insert_id;
				$update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET  order_payment_id = $payment_id,order_status='$order_status'  where order_reference_no = '$auth' "));
				$this->enroll_course($wpdb, $user, $auth);
				$response['status'] = 'success';
			} else {
				$order_status = 'failure';
				$update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET  order_status='$order_status'  where order_reference_no = '$auth' "));
				$response['status'] = 'failure';
			}
		} else if (isset($_GET['status']) && $_GET['status'] == 'failure') {
			$current_user = wp_get_current_user();
			$userid = $current_user->ID;
			$table_order = $wpdb->prefix . 'veolia_academy_order';
			$order_id = $wpdb->get_var("SELECT order_id from $table_order where order_user_id = $userid order by order_id desc limit 1");
			$update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET order_status='failure' where order_id = $order_id and order_user_id = $userid"));
			$response['status'] = 'failure';
		} else if (isset($_GET['status']) && $_GET['status'] == 'cancel') {
			$current_user = wp_get_current_user();
			$userid = $current_user->ID;
			$table_order = $wpdb->prefix . 'veolia_academy_order';
			$order_id = $wpdb->get_var("SELECT order_id from $table_order where order_user_id = $userid order by order_id desc limit 1");
			$update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET order_status='cancelled' where order_id = $order_id and order_user_id = $userid"));
			$response['status'] = 'cancel';
		} else if (isset($_GET['action_redirect']) && $_GET['action_redirect'] == 'enroll' && isset($_GET['ref_no']) && $_GET['ref_no'] != '') {
			$result = $this->veolia_enroll_user($_GET['ref_no'], $wpdb);
			$response['status'] = $result;
		} else
			$response['status'] = 'failure';
		return $response;
	}

	public function veolia_enroll_user($reference_number, $wpdb)
	{
		$reference_number = 'v_' . $reference_number;
		$table_order = $wpdb->prefix . 'veolia_academy_order';
		//$userId = $wpdb->get_var("SELECT order_user_id from $table_order where order_reference_no = '$reference_number'");
		$userId = $_SESSION["userId"];
		$user = get_user_by('id', $userId);
		if ($_SESSION['user_type'] == 'internal') {
			$update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET order_status='success' where order_reference_no = '$reference_number' and order_user_id = $userId"));
			if (isset($_SESSION["veolia_lms_my_cart_list"]) && !empty($_SESSION["veolia_lms_my_cart_list"])) {
				unset($_SESSION["veolia_lms_my_cart_list"]);
			}
			if (isset($_SESSION['my_checkout_cart_data'])) {
				unset($_SESSION['my_checkout_cart_data']);
			}
			$this->enroll_course($wpdb, $user, $reference_number);
			return "enroll_success";
		} else
			return "enroll_success";
	}

	public function enroll_course($wpdb, $user, $auth)
	{

		global $enrollement_api, $learning_track_course_mapping_api, $course_list_api, $cost;
		$table_order = $wpdb->prefix . 'veolia_academy_order';
		$table_order_details = $wpdb->prefix . 'veolia_academy_order_detail_course';
		$learner_id = '';
		$userId = $user->ID;
		$all_meta_for_user = get_user_meta($user->ID);
		$course_detail_list = array();
		$enroll_success = 1;
		$order_id = $wpdb->get_var("SELECT order_id from $table_order where order_user_id = $userId and order_reference_no='$auth'");
		$order_details = $wpdb->get_results("SELECT a.* FROM $table_order_details a,$table_order b WHERE a.order_detail_id=b.order_id AND  b.order_reference_no = '$auth' AND a.user_id ='$userId' AND b.order_status='success'", "ARRAY_A");
		if (isset($all_meta_for_user['ispring_user_id'][0])) {
			$learner_id = $all_meta_for_user['ispring_user_id'][0];
			foreach ($order_details as $order_detail) {
				$api = new Veolia_Academy_API();
				//Learning track enrollment
				$data = '<?xml version="1.0" encoding="UTF-8"?>
							<request>
								<courseIds><id>' . $order_detail['course_id'] . '</id></courseIds>
								<learnerIds><id>' . $learner_id . '</id></learnerIds>
								<accessDate>' . date('Y-m-d h:m:s') . '</accessDate>
								<dueDateType>unlimited</dueDateType>
							</request>';

				$result = $api->callAPI('POST', $enrollement_api, $data);

				if (isset($result['code']) && $result['code'] != 201)
					$enroll_success = 0;

				$data = '';
				$learning_track = $api->callAPI('GET', $course_list_api . '/' . $order_detail['course_id'], $data);
				$course_detail_list[] = isset($learning_track['contentItem']['title']) ? $learning_track['contentItem']['title'] : '';

				//Course enrollment

				$courses = $api->callAPI('GET', $learning_track_course_mapping_api . $order_detail['course_id'], $data);
				foreach ($courses as $course) {
					$data = '<?xml version="1.0" encoding="UTF-8"?>
								<request>
									<courseIds><id>' . isset($course['courseId']) ? $course['courseId'] : '' . '</id></courseIds>
									<learnerIds><id>' . $learner_id . '</id></learnerIds>
									<accessDate>' . date('Y-m-d h:m:s') . '</accessDate>
									<dueDateType>unlimited</dueDateType>
								</request>';
					$result = $api->callAPI('POST', $enrollement_api, $data);
					//if (isset($result['code']) && $result['code'] != 201)
					//$enroll_success = 0;

				}
			}
		} else {
			//if (isset($result['code']) && $result['code'] != 201)
			$enroll_success = 0;
		}

		if (empty($user))
			return '';

		if ($enroll_success == 1) {
			$subject = 'Veolia Academy : New Enrollment Notification';
			$course_titles = '<ul>';
			foreach ($course_detail_list as $course)
				$course_titles .= '<li>' . $course . '</li>';
			$course_titles .= '</ul>';
			$message = "<br>SALES ORDER : " . $order_id;
			$message .= "<br>The user <b>" . $user->display_name . "</b> has enrolled for the courses below:<br>";
			$message .= $course_titles;
			$message .= "<br>Best,<br>Veolia Academy Team";
		} else {
			$subject = 'Veolia Academy : Important alert! Enrollment Failed';
			$message = "<br>The user <b>" . $user->display_name . "</b> has purchased the course but it is not enrolled in the application. Please try to enroll it manually by refering the order details below:  <br>";
			//fetch order detail
			$total = 0;
			$message .= "<br>SALES ORDER : " . $order_id;
			$message .= "<br><table border='1' class='table table-striped vro-lms-order-table' aria-describedby=''>
										<thead>
											<tr>
												<th>Items</th>
												<th>Quantity</th>
												<th>Cost</th>
												<th>Total</th>
											<tr>
										</thead>";
			foreach ($order_details as $orderdata) {
				$api = new Veolia_Academy_API();
				$data = '';
				$learning_track = $api->callAPI('GET', $course_list_api . '/' . $orderdata["course_id"], $data);
				$table_learning_track_mapping = $wpdb->prefix . 'veolia_academy_learning_track_mapping';
				$learning_track_price = '';
				$learning_track_price = $wpdb->get_var("SELECT price from $table_learning_track_mapping WHERE learning_track_id = '" . $learning_track['contentItem']['contentItemId'] . "'");
				if ($learning_track_price != '')
					$cost = $learning_track_price;


				//$message .= "<br>ORDER DATE : ".$orderdata['order_created_datetime'];


				$message .=    "<tr>
												<td>" . $learning_track['contentItem']['title'] . " <br>
													<div class='vro-lms-pdt-order'>order #" . $orderdata['order_detail_id'] . "</div>
												</td>
												<td>1</td>
												<td>$" . $cost . "</td>
												<td>$" . $cost . "</td>
											</tr>";
				$total += $cost;
			}
			if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'internal') {
				$message .= "<tr class='vro-lms-order-total'>
												<td colspan=3>
													<div class='vro-lms-order-totaltext'>Discount</div>
												</td>
												<td>
													<div class='vro-lms-order-totalprice'>$" . $total . "</div>
												</td>
											</tr>
											<tr class='vro-lms-order-total'>
												<td colspan=3>
													<div class='vro-lms-order-totaltext'>Total</div>
												</td>
												<td>
													<div class='vro-lms-order-totalprice'>$0</div>
												</td>
											</tr>";
			} else {
				$message .= "<tr class='vro-lms-order-total'>
											<td colspan=3>
												<div class='vro-lms-order-totaltext'>Total</div>
											</td>
											<td>
												<div class='vro-lms-order-totalprice'>$" . $total . "</div>
											</td>
										</tr>";
			}

			$message .= "</table>";
		}

		include_once plugin_dir_path(__FILE__) . "templates/email_template.php";
		$custom_logo_id = get_theme_mod('custom_logo');
		$image = wp_get_attachment_image_src($custom_logo_id, 'full');
		$homepage = get_option('siteurl');
		$headers = 'Content-type: text/html';
		$message = send_email($homepage, $image[0], $message, '');

		$admin_email = get_option('admin_email');
		wp_mail($admin_email, $subject, $message, $headers);
		
		//PROD URL
		//wp_mail("us.vna.veolia-academy@veolia.com",$subject,$message, $headers);
		
	}

	public function resend_link($text)
	{
		if ($text == 'Lost your password?') {
			echo '<style>
			.login #nav {
				margin: 24px -20px 0 !important;
			}</style>';
			$text .= ' | <a href="' . home_url('/') . 'resend-activation-link?action=activatelink">Resend activation link</a>';
		}
		return $text;
	}

	public function shopping_cart_floating()
	{
		$veolia_lms_cart_badge_count = 0;
		if (isset($_SESSION["veolia_lms_my_cart_list"]) && !empty($_SESSION["veolia_lms_my_cart_list"])) {
			$veolia_lms_cart_list = $_SESSION["veolia_lms_my_cart_list"];
			$veolia_lms_cart_badge_count = count($veolia_lms_cart_list);
		}
		//if($veolia_lms_cart_badge_count>0)
		$veolia_lms_cart_redirect_uri = get_home_url() . "/shopping-cart";
		// require_once plugin_dir_path(__FILE__) . 'templates/shopping_cart_floating.php';
	}

	public function order_list()
	{
		global $wpdb;
		$userid = get_current_user_id();
		$veolia_lms_orders_list = array();
		$table_order = $wpdb->prefix . 'veolia_academy_order';
		$veolia_lms_orders_list = $wpdb->get_results("SELECT * FROM $table_order where order_user_id= '" . $userid . "' and (order_status != 'pending' or (order_status = 'pending' and order_created_datetime > now() - interval 24 hour)) order by order_id desc", "ARRAY_A");
		$veolia_lms_order_view_uri = get_home_url() . "/order-detail/";
		$response = array();
		$response['veolia_lms_orders_list'] = $veolia_lms_orders_list;
		$response['veolia_lms_order_view_uri'] = $veolia_lms_order_view_uri;
		$response['userid'] = $userid;
		return $response;

		//require_once plugin_dir_path(__FILE__) . 'templates/order_list.php';
	}
	public function order_detail()
	{
		global $wpdb, $course_list_api, $cost;
		$vro_lms_order_id = isset($_GET["id"]) ? $_GET["id"] : "";
		$userid = get_current_user_id();
		$vro_lms_orders_detail_list = $vro_lms_orders_data = $vrolms_paymentdata = array();
		$is_vrolms_order_exists = 0;
		$is_vrolms_payment_done = 0;
		if ($userid != 0 && $vro_lms_order_id != "") {

			$table_order = $wpdb->prefix . 'veolia_academy_order';
			$vro_lms_orders_data =   $wpdb->get_row("SELECT * FROM $table_order where order_user_id= '" . $userid . "' and order_id='" . $vro_lms_order_id . "' ", "ARRAY_A");

			//fetch payment data	
			if (is_array($vro_lms_orders_data) && !empty($vro_lms_orders_data)) {
				$is_vrolms_order_exists = 1;
				$table_payment = $wpdb->prefix . 'veolia_academy_payment';
				$vrolms_paymentdata = $wpdb->get_row("SELECT * FROM $table_payment where payment_user_id= '" . $userid . "' and  payment_id= '" . $vro_lms_orders_data["order_payment_id"] . "'", "ARRAY_A");
				if (is_array($vrolms_paymentdata) && !empty($vrolms_paymentdata)) {
					$is_vrolms_payment_done = 1;
					$vro_lms_userfullname = $vrolms_paymentdata["payment_firstname"] . " " . $vrolms_paymentdata["payment_lastname"];
					if ($vrolms_paymentdata["payment_country"] != "") {
						$vro_lms_useraddr = $vrolms_paymentdata["payment_country"] . "-" . $vrolms_paymentdata["payment_zipcode"];
					} else {
						$vro_lms_useraddr = $vrolms_paymentdata["payment_zipcode"];
					}
				}
				//fetch order detail 	
				$table_order_details = $wpdb->prefix . 'veolia_academy_order_detail_course';
				$vrolms_ordersdetail = $wpdb->get_results("SELECT * FROM $table_order_details where user_id= '" . $userid . "' and  order_detail_id= '" . $vro_lms_order_id . "' ", "ARRAY_A");
				$price = $cost;
				foreach ($vrolms_ordersdetail as $orderdata) {
					$api = new Veolia_Academy_API();
					$data = '';
					$learning_track = $api->callAPI('GET', $course_list_api . '/' . $orderdata["course_id"], $data);
					$table_learning_track_mapping = $wpdb->prefix . 'veolia_academy_learning_track_mapping';
					$learning_track_price = '';
					if (isset($learning_track['contentItem']['contentItemId']) && $learning_track['contentItem']['contentItemId'] != '')
						$learning_track_price = $wpdb->get_var("SELECT price from $table_learning_track_mapping WHERE learning_track_id = '" . $learning_track['contentItem']['contentItemId'] . "'");
					if ($learning_track_price != '')
						$price = $learning_track_price;
					else
						$price = $cost;
					$vro_lms_orders_detail_list[] = array(
						"order_detail_id" => $orderdata["order_detail_course_id"],
						"order_detail_learning_program" => isset($learning_track['contentItem']['title']) ? $learning_track['contentItem']['title'] : '',
						"order_detail_qty" => 1,
						"order_detail_learning_program_fee" => $price,
					);
				}
				if ($vro_lms_orders_data["order_status"] == "success") {
					$vro_lms_status_btn = "btn-success-custom";
				} elseif ($vro_lms_orders_data["order_status"] == "failed") {
					$vro_lms_status_btn = "btn-danger";
				} else {
					$vro_lms_status_btn = "btn-warning";
				}
			}
		}
		$_SESSION['invoice_data']['order_data'] = $vro_lms_orders_data;
		$_SESSION['invoice_data']['order_details_data'] = $vro_lms_orders_detail_list;
		$_SESSION['invoice_data']['vro_lms_userfullname'] = isset($vro_lms_userfullname) ? $vro_lms_userfullname : '';
		$_SESSION['invoice_data']['vro_lms_useraddr'] = isset($vro_lms_useraddr) ? $vro_lms_useraddr : '';
		$response = array();
		$response['is_vrolms_order_exists'] = $is_vrolms_order_exists;
		$response['vro_lms_orders_data'] = $vro_lms_orders_data;
		$response['vro_lms_orders_detail_list'] = $vro_lms_orders_detail_list;
		$response['vro_lms_userfullname'] = isset($vro_lms_userfullname) ? $vro_lms_userfullname : '';
		$response['vro_lms_useraddr'] = isset($vro_lms_useraddr) ? $vro_lms_useraddr : '';
		$response['is_vrolms_payment_done'] = $is_vrolms_payment_done;
		$response['vrolms_paymentdata'] = $vrolms_paymentdata;

		return $response;
		//require_once plugin_dir_path(__FILE__) . 'templates/order_detail.php';
	}

	public function veolia_lms_order_invoice_download()
	{
		$invoice_data = $this->invoice_report_generate();
		echo $invoice_data;
		wp_die();
	}

	public function invoice_report_generate()
	{
		require_once __DIR__ . '/mpdf/vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
		$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
		$mpdf->simpleTables = true;
		$mpdf->packTableData = true;
		$mpdf->keep_table_proportions = TRUE;
		$mpdf->shrink_tables_to_fit = 1;
		$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
		$mpdf->WriteHTML(utf8_encode($body));
		$order_id = $_SESSION['invoice_data']['order_data']["order_id"];
		$file_name = 'invoice_' . $order_id . '.pdf';
		$filePath = __DIR__ . "/uploads/" . $file_name;

		$custom_logo_id = get_theme_mod('custom_logo');
		$image = wp_get_attachment_image_src($custom_logo_id, 'full');
		include(plugin_dir_path(__FILE__) . 'templates/invoice_template.php');
		$mpdf->WriteHTML(get_content($image, $_SESSION['invoice_data']));

		// $mpdf->Output();
		$mpdf->Output($filePath, 'F');
		$report_pdf_url = plugin_dir_url(__FILE__) . "/uploads/" . $file_name;
		$invoice_data = base64_encode(file_get_contents($report_pdf_url));
		unlink($filePath);
		return $invoice_data;
	}


	public function checkout_redirect()
	{
		require_once plugin_dir_path(__FILE__) . 'templates/checkout_redirect.php';
	}

	public function password_reset_action($user, $new_pass)
	{
		/*global $change_password_api;
		$api = new Veolia_Academy_API();
		$data = '<?xml version="1.0" encoding="UTF-8"?>
				<request>
					<password>'.$new_pass.'</password>
				</request>';
		$result = $api->callAPI('POST',$change_password_api,$data);
		*/
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/veolia-academy-public.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name . "_encrypt", plugin_dir_url(__FILE__) . 'js/lms-encrypt.js', null, '');
		wp_enqueue_script($this->plugin_name . "_payment_encrypt", plugin_dir_url(__FILE__) . 'js/lms-payment-encrypt.js', null, '');
	}
}
