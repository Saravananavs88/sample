<?php
/*

Template Name: Order List

*/
get_header(); ?>

<section class="explore">
    <div class="container">

        <?php
        if (class_exists('Veolia_Academy_Public')) {
            $veolia_public = new Veolia_Academy_Public('veolia-academy', '1.0.0');
            $response = $veolia_public->order_list();

            extract($response);
        ?>
            <link rel='stylesheet' href='https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css' media='all' />
            <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css' media='all' />

            <div class="vro-lms-order-list">

                <?php if (count($veolia_lms_orders_list) > 0) {  ?>
                    <div class="d-flex justify-content-center">
                        <!-- <h5 class="mb-4 wp-block-heading heading-text-color">Order list</h5> -->
                        <div class="vro-lms-order-filter">

                            <div class="row vro-lms-order-filterform" style="width:100%">
                                <div class="col-md-2 mb-2"><input type="text" placeholder="Order No" class="form-control" id="veolia-lms-order-id"></div>
                                <div class="col-md-3 mb-2"><input type="text" placeholder="From Date" class="form-control" id="veolia-lms-order-fdate"></div>
                                <div class="col-md-3 mb-2"><input type="text" placeholder="To Date" class="form-control" id="veolia-lms-order-tdate"></div>
                                <div class="col-md-2 mb-2">
                                    <select class="form-select" id="veolia-lms-order-status" name="veolia-lms-order-status">
                                        <option value="">All</option>
                                        <option value="success">Success</option>
                                        <option value="failure">Failure</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2 wp-block-button d-flex"><button class="wp-block-button__link wp-element-button veolia-button" id="veolia-lms-order-filter" onclick="veolia_lms_order_filter()">Filter</button>&nbsp;
                                    <button class="wp-block-button__link wp-element-button veolia-button" id="veolia-lms-order-filter_clear" onclick="veolia_lms_order_filter_clear()">Clear</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="vro-lms-orderlist-data my-2" id="veolia_lms_order_list">
                        <table id="order_list" class="table table-responsive wp-block-table w-100" aria-describedby="vrolmsdesc">
                            <thead>
                                <tr>
                                    <th>Orders#</th>
                                    <th>Purchased On</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($veolia_lms_orders_list as $data) {
                                ?>
                                    <tr>
                                        <td>#<?php echo $data["order_id"]; ?></td>
                                        <td><?php echo date("d-M-Y h:i:s a", strtotime($data["order_created_datetime"])); ?></td>
                                        <td><?php echo $data["order_status"]; ?></td>
                                        <td>$<?php echo $data["order_total"]; ?></td>
                                        <td> <span  class="wp-block-button"><a href="<?php echo $veolia_lms_order_view_uri . "?id=" . $data["order_id"]; ?>" class="wp-block-button__link wp-element-button veolia-button">View</a></span></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php  } else { ?>
                    <div class="d-flex flex-column align-items-center content-box">No order items found</div>
                <?php } ?>
            </div>


            <script>
                jQuery(document).ready(function($) {
                    var table = jQuery('#order_list').DataTable({
                        responsive: true,
                        searching: false,
                        paging: true,
                        ordering: false,
                        lengthChange: false,
                        info: false
                    });
                });
            </script>

            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
            <script src='https://code.jquery.com/jquery-3.5.1.js'></script>
            <script src='https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js'></script>
            <script src='https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js'></script>
            <script src='https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js'></script>
            <script src='https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js'></script>

            <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

            <script>
                jQuery(function() {
                    jQuery("#veolia-lms-order-fdate").datepicker();
                    jQuery("#veolia-lms-order-tdate").datepicker();
                });
            </script>
        <?php
        }
        ?>
    </div>

</section>
<?php get_footer(); ?>