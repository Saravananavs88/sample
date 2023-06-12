<?php
global $wpdb;
$payment_data = $_POST['veolia_pgm_payment_data'];
$order_reference_no = $_POST['order_reference_no'];
$order_time = $_POST['order_time'];
$order_total = 0;
foreach ($payment_data as $data) {
    $order_total += $data['fees'];
}

$get_user_id = get_current_user_id();
$table_wp_veolia_academy_order = $wpdb->prefix . "veolia_academy_order";
$inital_order_status = "pending";
$payment_id = 0;
$wpdb->insert(
    $table_wp_veolia_academy_order,
    array(
        'order_user_id' => $get_user_id,
        'order_payment_id' => $payment_id,
        'order_sub_total' => $order_total,
        'order_total' =>  $order_total,
        'order_status' =>  $inital_order_status,
        'order_reference_no' => 'v_'.$order_reference_no,
        'order_created_datetime' => date('Y-m-d') .' '.$order_time        
    ),
    array('%d', '%d', '%s', '%s', '%s','%s','%s')
);
$lastid_order_table = $wpdb->insert_id;
foreach ($payment_data as $data) {

    $inital_course_status = "";
    $payment_type='';
    if(str_contains(strtolower($data['name']),strtolower("Wastewater Collection"))){
        $payment_type='WASTECOL';
    }
    else if(str_contains(strtolower($data['name']),strtolower("Wastewater"))){			
        $payment_type='WASTETREAT';
    } 
    else if(str_contains(strtolower($data['name']),strtolower("Water Treatment"))){
        $payment_type='WATERTREAT';
    }		 
    else if(str_contains(strtolower($data['name']),strtolower("Water Distribution"))){
        $payment_type='WATERDIS';
    }
    else if(str_contains(strtolower($data['name']),strtolower("Ohio"))){
        $payment_type='WASTEOHIO';
    }
    else if(str_contains(strtolower($data['name']),strtolower("Akron"))){
        $payment_type='AKRONWATER';
    }
    else if(str_contains(strtolower($data['name']),strtolower("Laboratory"))){
        $payment_type='LAB';
    }
    else if(str_contains(strtolower($data['name']),strtolower("Maintenance"))){
        $payment_type='MAINTENANCE';
    }
    else if(str_contains(strtolower($data['name']),strtolower("Collection Systems"))){
        $payment_type='COLLECTIONSSYS';
    }
    $inital_course_status = $payment_type."|##|".$data['fees'];
    $table_wp_veolia_academy_order_detail_course = $wpdb->prefix . "veolia_academy_order_detail_course";
    $insert_order_detail_course_table = $wpdb->insert(
        $table_wp_veolia_academy_order_detail_course,
        array(
            'order_detail_id' => $lastid_order_table,
            'course_id' => $data['id'],
            'user_id' =>  $get_user_id,
            'order_detail_course_status' => $inital_course_status
        ),
        array('%d', '%s', '%d', '%s')
    );
}
if($lastid_order_table !='')
    echo "success";
else    
    echo "failure";

      
?>