<?php
//page content for order list filter page
$veolia_get_order_fdate = isset($_POST["veolia_lms_filter_order_fdate"]) ? $_POST["veolia_lms_filter_order_fdate"] : "";
$veolia_get_order_tdate = isset($_POST["veolia_lms_filter_order_tdate"]) ? $_POST["veolia_lms_filter_order_tdate"] : "";
$veolia_get_order_status = isset($_POST["veolia_lms_filter_order_status"]) ? $_POST["veolia_lms_filter_order_status"] : "";
$veolia_lms_order_id = isset($_POST["veolia_lms_filter_order_id"]) ? $_POST["veolia_lms_filter_order_id"] : "";
$userid = get_current_user_id();
$veolia_lms_order_fdate = "";
$veolia_lms_order_tdate = "";
if ($veolia_get_order_fdate != "") {
    $veolia_lms_order_fdate = date("Y-m-d", strtotime($veolia_get_order_fdate));
}
if ($veolia_get_order_tdate != "") {
    $veolia_lms_order_tdate = date("Y-m-d", strtotime($veolia_get_order_tdate));
}
$veolia_lms_orders_list = array();
if ($userid != 0) {
    $veolia_lms_orders_list = fetch_order_list_filter($userid, $veolia_lms_order_id, $veolia_lms_order_fdate, $veolia_lms_order_tdate,$veolia_get_order_status);
}
$veolia_lms_order_view_uri = get_home_url() . "/order-detail/";
if (count($veolia_lms_orders_list) > 0) {
?>
    <table class="table table-responsive wp-block-table w-100">
        <thead>
            <tr>
                <th>Orders#</th>
                <th>Purchased On</th>
                <th>Status</th>
                <th>Total</th>
                <th>Action</th>
            <tr>
        </thead>
        <?php
        foreach ($veolia_lms_orders_list as $data) {
        ?>
            <tr>
                <td>#<?php echo $data["order_id"]; ?></td>
                <td><?php echo date("d-M-Y H:i:s", strtotime($data["order_created_datetime"])); ?></td>
                <td><?php echo $data["order_status"]; ?></td>
                <td>$<?php echo $data["order_total"]; ?></td>
                <td><span  class="wp-block-button"><a href="<?php echo $veolia_lms_order_view_uri . "?id=" . $data["order_id"]; ?>" class="wp-block-button__link wp-element-button text-white">View</a></span></td>
            </tr>
        <?php } ?>
    </table>
<?php } else {
?>
    <div class="d-flex flex-column align-items-center content-box">No order items found</div>
<?php
}

function fetch_order_list_filter($user_id, $order_id, $from_date, $to_date,$status)
{
    global $wpdb;
    $table = $wpdb->prefix . 'veolia_academy_order';
    if ($order_id != "" && $from_date != "" && $to_date != "") {
        $filter_query = "SELECT * FROM $table where order_user_id='" . $user_id . "' and order_id='" . $order_id . "' and date(order_created_datetime) between '" . $from_date . "' and '" . $to_date . "'";
    } else if ($order_id != "" && $from_date != "") {
        $filter_query = "SELECT * FROM $table where order_user_id='" . $user_id . "' and order_id='" . $order_id . "' and date(order_created_datetime)='" . $from_date . "'";
    } else if ($order_id != "" && $to_date != "") {
        $filter_query = "SELECT * FROM $table where order_user_id='" . $user_id . "' and order_id='" . $order_id . "' and date(order_created_datetime)='" . $to_date . "'";
    } else if ($from_date != "" && $to_date != "") {
        $filter_query = "SELECT * FROM $table where order_user_id='" . $user_id . "' and date(order_created_datetime) between '" . $from_date . "' and '" . $to_date . "'";
    } else if ($order_id != "") {
        $filter_query = "SELECT * FROM $table where order_user_id='" . $user_id . "' and order_id='" . $order_id . "'";
    } else if ($from_date != "") {
        $filter_query = "SELECT * FROM $table where order_user_id='" . $user_id . "' and date(order_created_datetime)='" . $from_date . "'";
    } else if ($to_date != "") {
        $filter_query = "SELECT * FROM $table where order_user_id='" . $user_id . "' and date(order_created_datetime)='" . $to_date . "'";
    } else {
        $filter_query = "SELECT * FROM $table where order_user_id='" . $user_id . "'";
    }

    if($status != "")
         $filter_query .= " AND order_status ='" . $status . "'";
     
    return  $wpdb->get_results($filter_query." and (order_status != 'pending' or (order_status = 'pending' and order_created_datetime > now() - interval 24 hour)) order by order_id desc", "ARRAY_A");
}

?>