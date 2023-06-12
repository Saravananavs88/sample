<?php 
global $wpdb;
$current_user = wp_get_current_user();
$user_name = $current_user->display_name;
$user_email = $current_user->user_email;
$userid = $current_user->ID;

$all_meta_for_user = get_user_meta($userid);
$first_name = '';	
if (isset($all_meta_for_user['first_name'][0]))	
    $first_name = $all_meta_for_user['first_name'][0]; 
$last_name = '';	
if (isset($all_meta_for_user['last_name'][0]))	
    $last_name = $all_meta_for_user['last_name'][0]; 

if(isset($_SESSION['redirect_login']))
unset($_SESSION['redirect_login']);

$homepage = get_option('siteurl');
if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='internal')
{
    if(isset($_GET['action_redirect']) && $_GET['action_redirect']=='buynow' && isset($_GET['learning_id']) && $_GET['learning_id']!='')
        wp_redirect($homepage . '/course-detail?id='.$_GET['learning_id']); 
    else
    {       
        wp_redirect($homepage . '/shopping-cart');
    }
}

$check_paid = 0;
if(isset($_GET['action_redirect']) && $_GET['action_redirect']=='buynow' && isset($_GET['learning_id']) && $_GET['learning_id']!='')
{
    $learning_track_id = $_GET['learning_id'];
    $table = $wpdb->prefix . 'veolia_academy_order_detail_course';
	$table_order = $wpdb->prefix . 'veolia_academy_order';
	$check_paid = $wpdb->get_var("SELECT COUNT(*) FROM $table as aod left join $table_order as ao on aod.order_detail_id=ao.order_id WHERE ao.order_status='success' and aod.course_id = '$learning_track_id' and aod.user_id ='$userid' ");
	if($check_paid!=0)
        wp_redirect($homepage . '/course-detail?id='.$_GET['learning_id']); 
}
        

if(isset($_SESSION['my_checkout_cart_data']))
{
    if(isset($_GET['action_redirect']) && $_GET['action_redirect']=='checkout')
    {
        $already_paid = 0;
        $check_paid = 0;
        $cart_items = json_decode($_SESSION['my_checkout_cart_data']);
        foreach($cart_items as $cart_item)
        {
            if($check_paid == 0)
            {
                $learning_track_id = $cart_item->id;
                $table = $wpdb->prefix . 'veolia_academy_order_detail_course';
                $table_order = $wpdb->prefix . 'veolia_academy_order';
                $check_paid = $wpdb->get_var("SELECT COUNT(*) FROM $table as aod left join $table_order as ao on aod.order_detail_id=ao.order_id WHERE ao.order_status='success' and aod.course_id = '$learning_track_id' and aod.user_id ='$userid' ");
                if($check_paid!=0)
                    $already_paid = 1;
            }
            else
                break;
        }
        if($already_paid!=0)
            wp_redirect($homepage . '/shopping-cart'); 
    }
    
    $data =json_encode($_SESSION['my_checkout_cart_data']);
?>

<script type="text/javascript">
    veolia_lms_ispring_after_login('<?php echo $first_name; ?>','<?php echo $last_name; ?>','<?php echo $user_email; ?>', JSON.parse(<?php echo $data; ?>));
</script>

<?php } ?>