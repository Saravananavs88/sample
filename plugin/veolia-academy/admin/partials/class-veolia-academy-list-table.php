<?php

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

// Order Detail List
class Order_Detail_List extends WP_List_Table
{

    /** Class constructor */
    public function __construct()
    {

        parent::__construct([
            'singular' => __('order', 'sp'), //singular name of the listed records
            'plural' => __('orders', 'sp'), //plural name of the listed records


        ]);
    }

    /**
     * Retrieve customer’s data from the database
     *
     * @param int $per_page
     * @param int $page_number
     *
     * @return mixed
     */
    public function get_order_list($search_term = '')
    {


        global $wpdb;
        if (!empty($search_term)) {
            $result = $wpdb->get_results(
                "SELECT * from {$wpdb->prefix}veolia_academy_order  as tblo left join {$wpdb->prefix}users as tblu on tblo.order_user_id=tblu.ID left join {$wpdb->prefix}veolia_academy_payment as tblp on tblo.order_payment_id=tblp.payment_id WHERE order_id LIKE '%$search_term%' OR display_name LIKE '%$search_term%' OR order_status LIKE '%$search_term%' OR order_total LIKE '%$search_term%' OR order_sub_total LIKE '%$search_term%' ORDER BY order_id DESC",
                'ARRAY_A'
            );
            $result = $this->fetch_order_list($result);

            return $result;
        } else {

            $sql = "SELECT * FROM {$wpdb->prefix}veolia_academy_order as tblo left join {$wpdb->prefix}users as tblu on tblo.order_user_id=tblu.ID left join {$wpdb->prefix}veolia_academy_payment as tblp on tblo.order_payment_id=tblp.payment_id ORDER BY order_id DESC";

            if (!empty($_REQUEST['orderby'])) {
                $sql .= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
                $sql .= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
            }


            $result = $wpdb->get_results($sql, 'ARRAY_A');
            $result = $this->fetch_order_list($result);
            return $result;
        }
    }

    public function fetch_order_list($result)
    {
        $i = 0;
        foreach ($result as $data) {
            $dollar_sign = '$';
            $result[$i]['order_total'] = (($data['order_total'] == '' || $data['order_total'] == null) ? '-' :  $dollar_sign . $data['order_total']);
            $result[$i]['order_other_charges'] = (($data['order_other_charges'] == '' || $data['order_other_charges'] == null) ? '-' : $dollar_sign . $data['order_other_charges']);
            $result[$i]['order_sub_total'] = (($data['order_sub_total'] == '' || $data['order_sub_total'] == null) ? '-' :  $dollar_sign . $data['order_sub_total']);
            $result[$i]['order_status'] = (($data['order_status'] == '' || $data['order_status'] == null) ? '-' :  $data['order_status']);
            $result[$i]['order_created_datetime'] = (($data['order_created_datetime'] == '' || $data['order_created_datetime'] == null) ? '-' :  $data['order_created_datetime']);
            $result[$i]['display_name'] = (($data['display_name'] == '' || $data['display_name'] == null) ? '-' :  $data['display_name']);
            $i++;
        }
        return $result;
    }
    public function prepare_items()
    {

        // search team

        $search_term = isset($_POST['s']) ? trim($_POST['s']) : "";

        $datas = $this->items = $this->get_order_list($search_term);
        $per_page = 15;
        $current_page = $this->get_pagenum();
        $total_items = count($datas);

        $this->set_pagination_args(array(
            "total_items" => $total_items,
            "per_page" => $per_page
        ));


        $start = ($current_page - 1) * $per_page;
        $this->items = array_slice($datas, $start, $per_page);
        $columns = $this->get_columns();
        $this->_column_headers = array($columns);
    }


    public function get_columns()
    {
        $columns = array(
            "order_id" => "S.No",
            "display_name" => "User",
            "order_sub_total" => "Sub-total",
            "order_other_charges" => "Other charges",
            "order_total" => "Total",
            "order_status" => "Status",
            "order_created_datetime" => "Order Created",
            "action" => "Action"


        );
        return $columns;
    }



    public function column_default($item, $column_name)
    {

        $order_user_id = $item['order_user_id'];
        $order_id = $item['order_id'];
        $order_status = $item['order_status'];
        $order_created_datetime = $item['order_created_datetime'];
        $user_email = $item['user_email'];
        switch ($column_name) {
            case 'order_id':
            case 'display_name':
            case 'order_sub_total':
            case 'order_other_charges':
            case 'order_total':
            case 'order_status':
            case 'order_created_datetime':
                return $item[$column_name];
            case 'action':
                return '<button type="button" id="admin_order_view_model" class="btn btn-sm btn-link" data-bs-toggle="modal"  onclick="admin_order_view_model(' .$order_user_id .",". $order_id . ',\'' . $order_status . '\',\'' . $order_created_datetime . '\',\'' . $user_email . '\')"><i class="fa fa-eye"></i> view</button>';
            default:
                return "No value found!";
        }
    }
}
