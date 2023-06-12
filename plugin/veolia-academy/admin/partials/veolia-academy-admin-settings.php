<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Veolia_Academy
 * @subpackage Veolia_Academy/admin/partials
 */
// print_r($learning_table);

?>

<div class="wrap">
    <div id="admin_settings_wrap">
        <div class="container-fluid">
            <div class="row">
                <h1>Veolia Academy</h1>
                <div id="veolia_academy_overview_wrap" class="my-3">
                    <nav id="veolia_academy_overview-tab">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <?php
                            $tab_index = isset($_GET['tab']) ? $_GET['tab'] : '';

                            $active_tab3 = '';
                            $active_show3 = '';
                            $active_tab1 = '';
                            $active_show1 = '';
                            if (isset($tab_index) && $tab_index == 3) {
                                $active_tab3 = 'active';
                                $active_show3 = 'show';
                            } else {
                                $active_tab1 = 'active';
                                $active_show1 = 'show';
                            }
                            ?>
                            <button class="nav-link <?= $active_tab1; ?>" id="veolia-order-list-tab" data-bs-toggle="tab" data-bs-target="#veolia-academy-order-list" type="button" role="tab" aria-controls="veolia-academy-order-list" aria-selected="false">Orders</button>
                            <button class="nav-link" id="veolia-learning-track-tab" data-bs-toggle="tab" data-bs-target="#veolia-academy-learning-track" type="button" role="tab" aria-controls="veolia-academy-learning-track" aria-selected="false">Learning Track</button>
                            <button class="nav-link <?= $active_tab3; ?>" id="veolia-settings-tab" data-bs-toggle="tab" data-bs-target="#veolia-academy-settings" type="button" role="tab" aria-controls="veolia-academy-settings" aria-selected="true">Settings</button>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade <?= $active_tab3 . ' ' . $active_show3; ?>" id="veolia-academy-settings" role="tabpanel" aria-labelledby="veolia-settings-tab" tabindex="0">
                            <div id="veolia-academy-credentials-settings">

                                <form name="api_credentials_form_id" action="<?= $_SERVER['PHP_SELF'] . '?page=veolia-academy-settings&tab=3'; ?>" method="post">
                                    <table class="form-table" role="presentation">
                                        <tbody>
                                            <tr>
                                                <br>
                                                <?= $result ?>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="ispring_acc_url"> <span>iSpring Account Url</span></label></th>
                                                <td>
                                                    <input name="ispring_acc_url" type="text" id="ispring_acc_url" value="<?= $retrieved_data->ispring_account_url; ?>" class="regular-text">
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row"><label for="ispring_acc_email"> <span>iSpring Email</span></label></th>
                                                <td><input name="ispring_acc_email" type="text" id="ispring_acc_email" value="<?= $retrieved_data->ispring_account_email; ?>" class="regular-text">

                                                </td>
                                            </tr>


                                            <tr>
                                                <th scope="row"><label for="ispring_acc_password">iSpring Account Password</label></th>
                                                <td><input name="ispring_acc_password" type="text" id="ispring_acc_password" value="<?= base64_decode($retrieved_data->ispring_account_password); ?>" class="regular-text">
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row"><label for="department_internal">Department ID (Internal)</label></th>
                                                <td><input name="department_internal" type="text" id="department_internal" value="<?= $retrieved_data->department_internal; ?>" class="regular-text">

                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="department_external">Department ID (External)</label></th>
                                                <td><input name="department_external" type="text" id="department_external" value="<?= $retrieved_data->department_external; ?>" class="regular-text">

                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row"><label for="default_cost">Cost in $</label>


                                                <td>

                                                    <input name="default_cost" type="number" id="default_cost" value="<?= $retrieved_data->cost; ?>" class="regular-text">

                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                    <div class="update-btn-wrap">
                                        <button type="submit" name="update-credentials-btn" id="update-credentials-btn" class="button button-primary">
                                            Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="veolia-academy-learning-track" role="tabpanel" aria-labelledby="veolia-learning-track-tab" tabindex="0">
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <!-- <h1 class="wp-heading-inline">Learning Track</h1> -->
                                <form name="learning_track_form_id" id="learning_track_form_id" method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" enctype="multipart/form-data">
                                    <table class="form-table" id="learning_track_table" role="presentation">
                                        <tbody>
                                            <tr>
                                                <br>
                                                <span class="text-danger" id="form-errors"></span>
                                                <span class="text-success" id="form-success"></span>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="veolia_learning_track_titles">Learning Tracks</label></th>
                                                <td>
                                                    <div class="wp-core-ui">
                                                        <select name="learning_track_select" class="regular-text" id="learning_track_select">
                                                            <option value="" disabled selected>Select Learning Track</option>
                                                            <?php
                                                            foreach ($learning_table as $ldata) {

                                                                $option_select = "";

                                                                if (isset($ldata['title'])) {

                                                            ?>
                                                                    <option value="<?= $ldata['contentItemId']; ?>"> <?= $ldata['title']; ?></option>

                                                                <?php

                                                                } else {

                                                                ?>

                                                                    <option value="">No Record Found!</option>

                                                            <?php

                                                                }
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="d-none" id="loader_delay_select"><img src="<?= plugin_dir_url(__DIR__) . "/images/loader.gif"; ?>" width="30" height="30"></span>
                                                </td>
                                            </tr>
                                            <?php
                                            if (function_exists('wp_enqueue_media')) {
                                                wp_enqueue_media();
                                            } else {
                                                wp_enqueue_style('thickbox');
                                                wp_enqueue_script('media-upload');
                                                wp_enqueue_script('thickbox');
                                            }
                                            ?>
                                            <tr>
                                                <th scope="row"><label for="veolia_learning_track_image">Image</label></th>
                                                <td class="custom-flex-td">
                                                    <img src="<?= plugin_dir_url(__DIR__) . 'images/veolia.png' ?>" id="veolia_learning_track_image" alt='' class="img-fluid" width="280" height="250">
                                                    <button name="courseFileToUpload" style="max-width:74px;" type="button" class="button button-primary mt-4" id="veolia_learning_track_upload">Upload</button>
                                                    <input id="lt_image_url" type="hidden" name="upload_image_url" size="60" value="">

                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row"><label for="veolia_learning_track_price">Price in $</label></th>
                                                <td>

                                                    <input name="veolia_learning_track_price" type="number" id="veolia_learning_track_price" value="" class="regular-text">

                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="veolia_learning_instructor_name">Instructor</label></th>
                                                <td>
                                                    <input name="veolia_learning_instructor_name" type="text" id="veolia_learning_instructor_name" value="" class="regular-text">
                                                    <span class="text-danger" id="instructorErr"></span>

                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <th scope="row"><label for="veolia_learning_track_level">Levels</label></th>
                                                <td>
                                                    <div class="wp-core-ui">
                                                        <select name="veolia_learning_track_level_select" class="regular-text" id="veolia_learning_track_level_select">
                                                            <option value="" selected>Select Levels</option>
                                                            <option value="Basic">Basic</option>
                                                            <option value="Advanced">Advanced</option>
                                                            <option value="Expert">Expert</option>
                                                        </select>
                                                    </div>



                                                </td>
                                            </tr> -->

                                        </tbody>
                                    </table>
                                    <div class="update-btn-wrap">
                                        <button type="submit" name="update-courses-btn" id=" update-courses-btn" class="button button-primary">
                                            Save</button>

                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="tab-pane fade <?= $active_tab1 . ' ' . $active_show1; ?>" id="veolia-academy-order-list" role="tabpanel" aria-labelledby="veolia-order-list-tab" tabindex="0">
                            <div id="order_list_wrapper">
                                <?php
                                require_once plugin_dir_path(__FILE__) . 'class-veolia-academy-list-table.php';
                                $learning_table = new Order_Detail_List();
                                echo '<div class="row my-3">';
                                $learning_table->prepare_items();

                                echo "<form method ='post' name='frm_search_post' action='" . $_SERVER['PHP_SELF'] . "?page=veolia-academy-settings'>";
                                $learning_table->search_box("Search orders", "search_orders_id");
                                echo "</form>";
                                echo "<div class='my-3'";
                                $learning_table->display();
                                echo "</div></div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal show fade" data-bs-backdrop="static" id="adminOrderViewModel" tabindex="-1" aria-labelledby="adminOrderViewModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="adminOrderViewModelTitle">Order details</h1>
                <button type="button" onclick="orderModelClose()" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="vro-lms-order-course-view" class="order-course-view-wrap">
                    <div class="row vro-lms-order-details bg-white">
                        <div class="col-lg-12">
                            <div class="vro-lms-orderdnumber"></div>
                            <div class="vro-lms-orderddate">
                                <span class="vro-lms-orderlcol1 font-weight-bold">Sales order: </span>
                                <span id="vro-lms-order-serial-num"></span>
                            </div>
                            <div class="vro-lms-orderddate">
                                <span class="vro-lms-orderlcol1 font-weight-bold">Order date: </span>
                                <span id="vro-lms-order-serial-date"></span>
                            </div>
                            <div class="vro-lms-orderddate">
                                <span class="vro-lms-orderlcol1 font-weight-bold">Status: </span>
                                <span id="vro-lms-order-serial-status">

                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="row vro-lms-order-details bg-white mt-3">
                        <input type="hidden" value="<?= plugin_dir_url(__DIR__) . "/images/loader.gif"; ?>" id="admin_order_loading_input">
                        <table class="table table-striped" id="vro-lms-order-course-table-view">
                            <thead>
                                <tr>
                                    <th scope="col">Order #</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody id="courseTableViewTBody">

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<div id="modal-backdrop-custom"></div>