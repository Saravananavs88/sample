<?php
session_start();
//To store the success and failure response received from paymentus
if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $payment_type_array=array();
    $reference_no_array=array();

    //changing array value from paymentus into string.
    for($i=0;$i<count($_POST);$i++){
        $payment_type =  isset($_POST["paymentType$i"]) ? array_push($payment_type_array,$_POST["paymentType$i"]) : ''; 
        $reference_no =  isset($_POST["referenceNumber$i"]) ? array_push($reference_no_array,$_POST["referenceNumber$i"]) : ''; 
    }
    //$payment_type = implode(',', $payment_type_array);
    $reference_number = implode(',', $reference_no_array);

    $table_payment = $wpdb->prefix . 'veolia_academy_payment';
    

    $emailid=  isset($_POST['customer_email0'])?$_POST['customer_email0']:null;  
    //get the current login userid
    $user = get_user_by( 'email', $emailid );
    $userId = $user->ID;
        
	$status = isset($_POST['status0'])?$_POST['status0']:null;   
	$firstName =  isset($_POST['customer_firstName0'])?$_POST['customer_firstName0']:null;
	$lastName =  isset($_POST['customer_lastName0'])?$_POST['customer_lastName0']:null;  
	$email = isset($_POST['customer_email0'])?$_POST['customer_email0']:null;   
	$amount = isset($_POST['amount0'])?$_POST['amount0']:null;  
	$conveniencefee = isset($_POST['convenienceFee0'])?$_POST['convenienceFee0']:null;    
	$payment_method_type = isset($_POST['paymentMethod_type0'])?$_POST['paymentMethod_type0']:null;  
	$paymentdate = isset($_POST['paymentDate0'])?$_POST['paymentDate0']:null; 
	$accountNumber = isset($_POST['accountNumber0'])?$_POST['accountNumber0']:null; 
	$cardNumber = isset($_POST['paymentMethod_cardNumber0'])?$_POST['paymentMethod_cardNumber0']:null;
	$phone_number = isset($_POST['customer_dayPhone0'])?$_POST['customer_dayPhone0']:null;
	$zipCode0 = isset($_POST['customer_address_zipCode0'])?$_POST['customer_address_zipCode0']:null;  
	$country = isset($_POST['customer_address_country0'])?$_POST['customer_address_country0']:null; 
    $learning =  isset($_POST['customer_address_line10'])?$_POST['customer_address_line10']:null; 

    $auth = isset($_POST['accountToken0'])?$_POST['accountToken0']:null;  
    $transact_no  = isset($_POST['externalReferenceNumber0'])?$_POST['externalReferenceNumber0']:null;  
    $currentdatetime = date('Y-m-d H:i:s');
    $order_total = $amount+$conveniencefee;    
    $table_order = $wpdb->prefix . 'veolia_academy_order';
    if($status=='ACCEPTED'){
        $order_status='success';
        
        if(isset($_SESSION["veolia_lms_my_cart_list"]) && !empty($_SESSION["veolia_lms_my_cart_list"])){
            unset($_SESSION["veolia_lms_my_cart_list"]);
        }

        if(isset($_SESSION['my_checkout_cart_data']))
        {
            unset($_SESSION['my_checkout_cart_data']);
        }
   

    $wpdb->insert(
        $table_payment,
        array(
            'payment_user_id' => $userId,
            'payment_firstname'=>$firstName,
            'payment_lastname'=>$lastName, 
            'payment_email'=>$email,
            'payment_reference_no'=>$reference_number,
            'payment_amount'=>$amount,
            'payment_convenience_fee'=>$conveniencefee,
            'payment_type'=>$payment_method_type,
            'payment_date'=>$paymentdate,
            'payment_account_number'=>$accountNumber,
            'payment_card_number'=>$cardNumber,
            'payment_phone_number'=>$phone_number,
            'payment_zipcode'=>$zipCode0,
            'payment_country'=>$country,
            'payment_status'=>$status,
            'payment_updated_datetime'=>$currentdatetime
        ),
        array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );
    
    //echo "<pre>";
    //print_r($payment_type_array);
    //exit;
    if($order_status=='success')
    { 
        $table_order_details = $wpdb->prefix . 'veolia_academy_order_detail_course';
        $order_details = $wpdb->get_results("SELECT a.* FROM $table_order_details a,$table_order b WHERE a.order_detail_id=b.order_id AND  b.order_reference_no = '$auth' AND a.user_id ='$userId'", "ARRAY_A");
        foreach($order_details as $order_detail)
        {   
            $course_items = explode('|##|',$order_detail['order_detail_course_status']); 
            if(!in_array($course_items[0],$payment_type_array))
            {
                $order_detail_course_id = $order_detail['order_detail_course_id'];
                $delete_course_price = $course_items[1];
                $delete_order_course = $wpdb->query($wpdb->prepare("DELETE from $table_order_details where order_detail_course_id = $order_detail_course_id "));
                $update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET  order_sub_total = order_sub_total - $delete_course_price, order_total = order_total - $delete_course_price  where order_reference_no = '$auth' "));
            }
        }
    }

    $payment_id = $wpdb->insert_id;
    $update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET  order_payment_id = $payment_id,order_status='$order_status'  where order_reference_no = '$auth' "));
    enroll_course($wpdb,$user,$auth);
    }else{
        $order_status='failure';
        $update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET  order_status='$order_status'  where order_reference_no = '$auth' "));
        wp_redirect(home_url('/') . 'failure.php');
    }   

}

if(isset($_GET['s']) && $_GET['s']=='FAILURE')
{
    $current_user = wp_get_current_user();
	$userid = $current_user->ID;
    $table_order = $wpdb->prefix . 'veolia_academy_order';
    $order_id = $wpdb->get_var("SELECT order_id from $table_order where order_user_id = $userid order by order_id desc limit 1");
    $update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET order_status='failure' where order_id = $order_id and order_user_id = $userid"));

}

if(isset($_GET['action_redirect']) && $_GET['action_redirect']=='enroll' && isset($_GET['ref_no']) && $_GET['ref_no']!='')
{
    veolia_enroll_user($_GET['ref_no'],$wpdb);
}

function veolia_enroll_user($reference_number,$wpdb)
{
    $reference_number = 'v_'.$reference_number;
    $table_order = $wpdb->prefix . 'veolia_academy_order';
    //$userId = $wpdb->get_var("SELECT order_user_id from $table_order where order_reference_no = '$reference_number'");
    $userId = $_SESSION["userId"];
    $user = get_user_by('id', $userId);
    if($_SESSION['user_type'] == 'internal')
    {
        $update_order_query = $wpdb->query($wpdb->prepare("UPDATE $table_order SET order_status='success' where order_reference_no = '$reference_number' and order_user_id = $userId"));
        if(isset($_SESSION["veolia_lms_my_cart_list"]) && !empty($_SESSION["veolia_lms_my_cart_list"])){
            unset($_SESSION["veolia_lms_my_cart_list"]);
        }
        if(isset($_SESSION['my_checkout_cart_data']))
        {
            unset($_SESSION['my_checkout_cart_data']);
        }
        enroll_course($wpdb,$user,$reference_number); 
    }
    else
        wp_redirect(home_url('/') . 'enroll-failure.php');
}

function enroll_course($wpdb,$user,$auth)
{
    
    global $enrollement_api,$learning_track_course_mapping_api,$course_list_api,$cost;
    $table_order = $wpdb->prefix . 'veolia_academy_order';
    $table_order_details = $wpdb->prefix . 'veolia_academy_order_detail_course';
    $learner_id='';
    $userId = $user->ID;
    $all_meta_for_user = get_user_meta($user->ID);
    $course_detail_list = array();
    $enroll_success = 1;
    $order_id = $wpdb->get_var("SELECT order_id from $table_order where order_user_id = $userId and order_reference_no='$auth'");
    $order_details = $wpdb->get_results("SELECT a.* FROM $table_order_details a,$table_order b WHERE a.order_detail_id=b.order_id AND  b.order_reference_no = '$auth' AND a.user_id ='$userId' AND b.order_status='success'", "ARRAY_A");
		if (isset($all_meta_for_user['ispring_user_id'][0]))
        { 
            $learner_id = $all_meta_for_user['ispring_user_id'][0];
            foreach($order_details as $order_detail)
            {
                $api = new Veolia_Academy_API();
                //Learning track enrollment
                $data = '<?xml version="1.0" encoding="UTF-8"?>
				    <request>
					    <courseIds><id>'.$order_detail['course_id'].'</id></courseIds>
					    <learnerIds><id>'.$learner_id.'</id></learnerIds>
                        <accessDate>'.date('Y-m-d h:m:s').'</accessDate>
	                    <dueDateType>unlimited</dueDateType>
				    </request>';
                    
			    $result = $api->callAPI('POST',$enrollement_api,$data);
                
                if (isset($result['code']) && $result['code'] != 201)
                    $enroll_success = 0;

                $data = '';
                $learning_track = $api->callAPI('GET', $course_list_api . '/' . $order_detail['course_id'], $data);
				$course_detail_list[] = isset($learning_track['contentItem']['title']) ? $learning_track['contentItem']['title'] : '';
                
                //Course enrollment
                
                $courses = $api->callAPI('GET',$learning_track_course_mapping_api.$order_detail['course_id'],$data);
                foreach($courses as $course)
                {
			        $data = '<?xml version="1.0" encoding="UTF-8"?>
				        <request>
					        <courseIds><id>'.$course['courseId'].'</id></courseIds>
					        <learnerIds><id>'.$learner_id.'</id></learnerIds>
                            <accessDate>'.date('Y-m-d h:m:s').'</accessDate>
	                        <dueDateType>unlimited</dueDateType>
				        </request>';
			        $result = $api->callAPI('POST',$enrollement_api,$data);
                    //if (isset($result['code']) && $result['code'] != 201)
                        //$enroll_success = 0;

                }
                
            }

        }
        else
        {
            //if (isset($result['code']) && $result['code'] != 201)
                $enroll_success = 0;
        }
        
        if(empty($user))
        return '';
        
        if($enroll_success==1)
        {
            $subject = 'Veolia Academy : New Enrollment Notification';
            $course_titles = '<ul>';
            foreach($course_detail_list as $course)
                $course_titles .= '<li>'.$course.'</li>';
            $course_titles .= '</ul>';
            $message = "<br>SALES ORDER : ".$order_id;  
            $message .= "<br>The user <b>".$user->display_name."</b> has enrolled for the courses below:<br>";
            $message .= $course_titles;
            $message .= "<br>Best,<br>Veolia Academy Team";
            
           
        }
        else
        {
            $subject = 'Veolia Academy : Important alert! Enrollment Failed';
            $message = "<br>The user <b>".$user->display_name."</b> has purchased the course but it is not enrolled in the application. Please try to enroll it manually by refering the order details below:  <br>";
            //fetch order detail
            $total = 0;
            $message .= "<br>SALES ORDER : ".$order_id;
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
                if($learning_track_price != '')
                    $cost = $learning_track_price;
                               
                
                //$message .= "<br>ORDER DATE : ".$orderdata['order_created_datetime'];
                
                                
                $message .=    "<tr>
                                        <td>".$learning_track['contentItem']['title']." <br>
                                            <div class='vro-lms-pdt-order'>order #".$orderdata['order_detail_id']."</div>
                                        </td>
                                        <td>1</td>
                                        <td>$".$cost."</td>
                                        <td>$".$cost."</td>
                                    </tr>";
                                $total += $cost; 
                 } 
                                if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='internal')
                                {
                                    $message .= "<tr class='vro-lms-order-total'>
                                        <td colspan=3>
                                            <div class='vro-lms-order-totaltext'>Discount</div>
                                        </td>
                                        <td>
                                            <div class='vro-lms-order-totalprice'>$".$total."</div>
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
                                }
                                else
                                {
                                    $message .= "<tr class='vro-lms-order-total'>
                                    <td colspan=3>
                                        <div class='vro-lms-order-totaltext'>Total</div>
                                    </td>
                                    <td>
                                        <div class='vro-lms-order-totalprice'>$".$total."</div>
                                    </td>
                                </tr>";
                                }
            
            $message .= "</table>";

        }

        include_once "wp-content/plugins/veolia-academy/public/templates/email_template.php";
        $custom_logo_id = get_theme_mod('custom_logo');
        $image = wp_get_attachment_image_src($custom_logo_id, 'full');
        $homepage = get_option('siteurl'); 
        $headers = 'Content-type: text/html';
        $message = send_email($homepage, $image[0], $message, '');
        wp_mail("arunkumarmca2010@gmail.com",$subject,$message, $headers);
}

