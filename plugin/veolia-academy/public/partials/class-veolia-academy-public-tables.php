<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/public/partials
 */

class database_table
{

    // wp_veolia_academy_order table
    function veolia_academy_order()
    {
        global $wpdb;
        $table_wp_users = $wpdb->prefix . "users";
        $table_wp_veolia_academy_order = $wpdb->prefix . "veolia_academy_order";
        $table_wp_veolia_academy_payment = $wpdb->prefix . "veolia_academy_payment";
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_wp_veolia_academy_order (
                    `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `order_user_id` bigint(20) UNSIGNED NOT NULL,
                    `order_payment_id` bigint(20) NULL,
                    `order_sub_total` varchar(255) NULL,
                    `order_other_charges` varchar(255) NULL,
                    `order_total` varchar(255) NULL,
                    `order_status` varchar(255) NULL,
                    `order_reference_no` varchar(255) NULL,
                    `order_created_datetime` datetime NULL DEFAULT current_timestamp(),
                    PRIMARY KEY (`order_id`),
                    FOREIGN KEY (`order_user_id`) REFERENCES $table_wp_users(`ID`)
                    -- FOREIGN KEY (`order_payment_id`) REFERENCES $table_wp_veolia_academy_payment(`payment_id`)
                ) $charset_collate; ";
        return $sql;
    }

    // wp_veolia_academy_learning_track_mapping
    function veolia_academy_learning_track_mapping()
    {
        global $wpdb;
        $table_wp_veolia_academy_learning_track_mapping = $wpdb->prefix . "veolia_academy_learning_track_mapping"; 
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_wp_veolia_academy_learning_track_mapping (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `learning_track_id` varchar(255) NOT NULL,
                    `image_url` varchar(255) NOT NULL,
                    `price` bigint(20) NULL DEFAULT 200,
                    `instructor` varchar(255) NULL,
                    PRIMARY KEY (`id`)                
                  ) $charset_collate; ";
             
        return $sql;
    }


    // wp_veolia_academy_order_detail_course table
    function veolia_academy_order_detail_course()
    {
        global $wpdb;
        $table_wp_veolia_academy_order = $wpdb->prefix . "veolia_academy_order";
        $table_wp_veolia_academy_order_detail_course = $wpdb->prefix . "veolia_academy_order_detail_course";
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_wp_veolia_academy_order_detail_course (
                    `order_detail_course_id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `order_detail_id` bigint(20) NOT NULL,
                    `course_id` varchar(255) NOT NULL,
                    `user_id` bigint(20) NOT NULL,
                    `is_course_completed` bigint(20) DEFAULT 0,
                    `order_detail_course_status` varchar(255) NULL,
                    `order_detail_course_created_datetime` datetime NULL DEFAULT current_timestamp(),
                    `course_completed_date` datetime NULL,
                    PRIMARY KEY (`order_detail_course_id`),
                    FOREIGN KEY (`order_detail_id`) REFERENCES $table_wp_veolia_academy_order(`order_id`)
                   ) $charset_collate; ";
        return $sql;
    }

    function veolia_academy_course_status()
    {
        global $wpdb;
        $table_wp_veolia_academy_course_status = $wpdb->prefix . "veolia_academy_course_status";
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_wp_veolia_academy_course_status (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `course_id` varchar(255) NOT NULL,
                    `user_id` bigint(20) NOT NULL,
                    `course_status` varchar(255) NULL,
                    `course_created_datetime` datetime NULL DEFAULT current_timestamp(),
                    `course_completed_date` datetime NULL,
                    PRIMARY KEY (`id`)
                    ) $charset_collate; ";
        return $sql;
    }
    function veolia_academy_admin_settings(){
        global $wpdb;
        $veolia_academy_settings = $wpdb->prefix . "veolia_academy_settings";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $veolia_academy_settings (
                `id` int(10) NOT NULL AUTO_INCREMENT,  
                `ispring_account_url` varchar(255) NOT NULL,                
                `ispring_account_email` varchar(255) NOT NULL,
                `ispring_account_password` varchar(255) NOT NULL,
                `department_internal` varchar(255) NOT NULL,
                `department_external` varchar(255) NOT NULL,
                `cost` bigint(20) NOT NULL, 
                PRIMARY KEY (`id`)
          ) $charset_collate; ";
        return $sql;
    }


    // wp_veolia_academy_payment table
    function veolia_academy_payment()
    {
        global $wpdb;
        $table_wp_users = $wpdb->prefix . "users";
        $table_wp_veolia_academy_payment = $wpdb->prefix . "veolia_academy_payment";
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_wp_veolia_academy_payment (
                    `payment_id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `payment_user_id` bigint(20) UNSIGNED NOT NULL,
                    `payment_transaction_id` varchar(255) NULL,
                    `payment_firstname` varchar(255) NULL,
                    `payment_lastname` varchar(255) NULL,
                    `payment_email` varchar(255) NULL,
                    `payment_reference_no` varchar(255) NULL,
                    `payment_amount` varchar(255) NULL,
                    `payment_convenience_fee` varchar(255) NULL,
                    `payment_type` varchar(255) NULL,
                    `payment_date` varchar(255) NULL,
                    `payment_account_number` varchar(255) NULL,
                    `payment_card_number` varchar(255) NULL,
                    `payment_phone_number` varchar(255) NULL,
                    `payment_zipcode` varchar(255) NULL,
                    `payment_country` varchar(255) NULL,
                    `payment_status` varchar(255) NULL,
                    `payment_created_datetime` datetime NULL DEFAULT current_timestamp(),
                    `payment_updated_datetime` datetime NULL,
                    PRIMARY KEY (`payment_id`),
                    FOREIGN KEY (`payment_user_id`) REFERENCES $table_wp_users(`ID`)
                   ) $charset_collate; ";
        return $sql;
    }

}
