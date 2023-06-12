(function($) {
    "use strict";

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
})(jQuery);
var base_url = window.location.origin;

//var pathArray = window.location.pathname.split("/");
//if (pathArray[1] != "") base_url = base_url + "/" + pathArray[1];

var AjaxURL = base_url + "/wp-admin/admin-ajax.php";

//function to add cart items in cart page.
function veolia_lms_add_to_cart(learning_id) {
    jQuery("#veolia-lms-start-loader").removeClass("d-none");
    jQuery("#veolia_lms_add_to_cart").attr("disabled", true);
    var datacartcount = {
        action: "veolia_lms_addto_cart",
        veolia_lms_addcart_learning_id: learning_id,
    };
    jQuery.post(AjaxURL, datacartcount, function(response) {
        var jdata = JSON.parse(response);
        if (jdata["is_error"] == "0") {
            jQuery("#veolia-lms-my-cart-list-count").html(jdata["cart_count"]);
            let course_details_title =
                jQuery("#vro-lms-course-details-title").text() +
                " " +
                "Course has been added to your cart";
            toastr.options.timeOut = 3000;
            toastr.success(course_details_title);
            jQuery("#veolia-lms-start-loader").addClass("d-none");
            jQuery("#veolia_lms_add_to_cart").html("<i class='fas fa-shopping-basket pe-2'></i> Already added to cart");
            // window.location.href = base_url + '/shopping-cart';
        }
    });
}

function veolia_lms_remove_course_model(learning_id, learning_fees, is_paid) {
    jQuery("#veolia_lms_learning_id").val(learning_id);
    jQuery("#veolia_lms_learning_fees").val(learning_fees);
    jQuery("#veolia_lms_is_paid").val(is_paid);
    jQuery("#model-backdrop-fade").addClass("modal-backdrop");
    jQuery("#model-backdrop-fade").addClass("show");
    jQuery("#model-course-remove").show();
}

function veolia_lms_remove_from_close_model() {
    jQuery("#model-course-remove").hide();
    jQuery("#model-backdrop-fade").removeClass("modal-backdrop");
    jQuery("#model-backdrop-fade").removeClass("show");
}

//function to remove cart items from the cart page
function veolia_lms_remove_from_cart() {
    jQuery("#model-course-remove").hide();
    jQuery("#model-backdrop-fade").removeClass("modal-backdrop");

    jQuery("#model-backdrop-fade").removeClass("show");
    let learning_id = jQuery("#veolia_lms_learning_id").val();
    let learning_fees = jQuery("#veolia_lms_learning_fees").val();
    let is_paid = jQuery("#veolia_lms_is_paid").val();
    var veolia_get_prev_subtotal = jQuery(
        "#veolia-lms-course-subtotal-val"
    ).val();
    var veolia_next_subtotal = parseFloat(learning_fees);
    if (is_paid == "0") {
        veolia_next_subtotal =
            parseFloat(veolia_get_prev_subtotal) - parseFloat(learning_fees);
    }
    veolia_next_subtotal = veolia_next_subtotal.toFixed(2);
    var dataordertotal = {
        action: "veolia_lms_removefrom_cart",
        veolia_lms_removecart_learning_id: learning_id,
    };
    jQuery.ajax({
        url: AjaxURL,
        type: "POST",
        data: dataordertotal,
        success: function(result) {
            let redirect_course_url = base_url + "/course-list";
            var jdata = JSON.parse(result);
            if (jdata["is_error"] == "0") {              
                jQuery("#veolia-lms-course-subtotal-html").html(
                    "$" + veolia_next_subtotal
                );
                jQuery("#veolia-lms-course-subtotal-val").val(veolia_next_subtotal);
                jQuery("#veolia-lms-cart-list" + learning_id).remove();
                jQuery("#veolia-lms-my-cart-list-count").html(jdata["cart_count"]);
                if (jdata["cart_count"] == 0) {
                    jQuery("#veolia-lms-cart-payment-grid").css("display", "none");
                    //jQuery("#vro-lms-section-right").addClass("d-none");
                    //jQuery("#vro-lms-section-left").addClass("col-md-12");
                    jQuery("#veolia-lms-mycart-checkout").addClass("card mb-3 d-flex flex-column align-items-center");
                    jQuery("#veolia-lms-mycart-checkout").html('<p>Your cart is empty</p>');
                    // jQuery("#vro-lms-redirct-url").attr("href", redirect_course_url);
                     jQuery("#vro-lms-continue-div").removeClass("d-none");
                     jQuery("#veolia-lms-cart-checkout-btn").prop('disabled', true);
                    
                    // jQuery("#veolia-lms-mycart-checkout").addClass(
                    //     "veolia-lms-mycart-checkout"
                    // );
                } else {
                    jQuery("#veolia-lms-mycart-checkout").removeClass(
                        "veolia-lms-mycart-checkout"
                    );
                }
                if (veolia_next_subtotal <= 0) {
                    jQuery("#veolia-lms-cart-checkout-btn").prop('disabled', true);
                    jQuery("#veolia-lms-cart-payment-grid").css("display", "none");
                   jQuery("#veolia-lms-mycart-checkout").addClass("card mb-3 d-flex flex-column align-items-center");
                    jQuery("#veolia-lms-mycart-checkout").text("Your cart is empty");
                    jQuery("#vro-lms-redirct-url").attr("href", redirect_course_url);
                    jQuery("#vro-lms-continue-div").removeClass("d-none");
                }
            }
        },
    });
}

function veolia_lms_cart_checkout(user_id, first_name, last_name, user_email) {
    if (user_id == 0)
        window.location.href = base_url + "/wp-login.php?action_redirect=checkout";
    else
        veolia_lms_ispring_login("shopping-cart", user_id, first_name, last_name, user_email);
}

function veolia_lms_buynow_checkout(
    user_id,
    first_name,
    last_name,
    user_email,
    learning_id,
    name,
    fees
) {
    if (user_id == 0)
        window.location.href = base_url + "/wp-login.php?action_redirect=buynow=" + learning_id;
    else
        veolia_lms_ispring_login(
            "buy-now",
            user_id,
            first_name,
            last_name,
            user_email,
            learning_id,
            name,
            fees
        );
}


function veolia_lms_cart_enroll(user_id, first_name, last_name, user_email) {

    if (user_id == 0)
        window.location.href = base_url + "/wp-login.php?action_redirect=checkout";
    else {
    var veolia_pgm_payment_data = [];
    jQuery(
        "#veolia-lms-mycart-checkout .veolia-lms-checkout-list-fr45987"
    ).each(function() {
        var veolia_lms_pgm_id = jQuery(this).val();
        var veolia_lms_pgm_fees = jQuery(this).data("fees");
        var veolia_lms_pgm_name = jQuery(this).data("name");
        var veolia_lms_payobj = {
            id: veolia_lms_pgm_id,
            fees: veolia_lms_pgm_fees,
            name: veolia_lms_pgm_name,
        };
        veolia_pgm_payment_data.push(veolia_lms_payobj);
    });
    veolia_lms_insert_order_creation(veolia_pgm_payment_data, first_name, last_name, user_email, 'enroll');
    }
}

function veolia_lms_buynow_enroll(
    user_id,
    first_name,
    last_name,
    user_email,
    learning_id,
    name,
    fees
) {
    if (user_id == 0)
        window.location.href = base_url + "/wp-login.php?action_redirect=buynow=" + learning_id;
    else {
        var veolia_pgm_payment_data = [];
        var veolia_lms_payobj = { id: learning_id, fees: fees, name: name };
        veolia_pgm_payment_data.push(veolia_lms_payobj);
        veolia_lms_insert_order_creation(veolia_pgm_payment_data, first_name, last_name, user_email, 'enroll');
    }
}


// login alert and redirection on login inside shopping cart page
function veolia_lms_ispring_login(
    page_link,
    user_id,
    first_name,
    last_name,
    user_email,
    learning_id = "",
    name = "",
    fees = ""
) {
    var veolia_pgm_payment_data = [];
    if (learning_id != "" && page_link == "buy-now") {
        var veolia_lms_payobj = { id: learning_id, fees: fees, name: name };
        veolia_pgm_payment_data.push(veolia_lms_payobj);
    } else {
        jQuery(
            "#veolia-lms-mycart-checkout .veolia-lms-checkout-list-fr45987"
        ).each(function() {
            var veolia_lms_pgm_id = jQuery(this).val();
            var veolia_lms_pgm_fees = jQuery(this).data("fees");
            var veolia_lms_pgm_name = jQuery(this).data("name");
            var veolia_lms_payobj = {
                id: veolia_lms_pgm_id,
                fees: veolia_lms_pgm_fees,
                name: veolia_lms_pgm_name,
            };
            veolia_pgm_payment_data.push(veolia_lms_payobj);
        });
    }
    veolia_lms_insert_order_creation(veolia_pgm_payment_data, first_name, last_name, user_email, 'payment');
}

function veolia_lms_ispring_after_login(first_name, last_name, user_email, veolia_pgm_payment_data) {
    veolia_lms_insert_order_creation(veolia_pgm_payment_data, first_name, last_name, user_email, 'payment');
}

function veolia_lms_insert_order_creation(veolia_pgm_payment_data, first_name, last_name, user_email, type) {
    var veolia_pgm_reference_no = veolia_lms_randomstring();
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
    var visitor_time = hours + ":" + minutes + ":" + seconds;

    jQuery.ajax({
        type: "POST",
        url: AjaxURL,
        data: {
            action: "veolia_lms_insert_order_creation",
            veolia_pgm_payment_data: veolia_pgm_payment_data,
            order_reference_no: veolia_pgm_reference_no,
            order_time: visitor_time
        },
        success: function(response) {
            if (response == 'success') {

                if (type == 'payment') {
                    var encrypt_response = veolia_lms_payment_encrypt(first_name, last_name, user_email, veolia_pgm_payment_data, 'v_' + veolia_pgm_reference_no, veolia_pgm_reference_no);
                    //Dev URL
                    var veolia_payment_us_url = "https://secure1.paymentus.com/rotp/vanm?itok=" + encrypt_response;
                    //Prod URL
                    //var veolia_payment_us_url = "https://ipn.paymentus.com/rotp/vanm?itok=" + encrypt_response;
                    window.location.href = veolia_payment_us_url;
                } else {
                    window.location.href = base_url + '/payment-status?action_redirect=enroll&ref_no=' + veolia_pgm_reference_no;
                }
            } else {
                alert("Technial Error, Please retry after sometime.");
            }
        },
        error: function(response) {
            alert("Technial Error, Please retry after sometime.");
        },
    });
}


jQuery(function() {

    jQuery("#contact_instrutor_form_submit").submit(function(e) {
        e.preventDefault();
        let pattern = /^[a-z A-Z ]{2,50}$/;
        let message = jQuery("#contact_instrutor_message").val();
        let validuser = pattern.test(message);
        if (message == "") {
            jQuery("#contact_instrutor_error_message").text("Please enter the field");

        } else if (!validuser) {
            jQuery("#contact_instrutor_error_message").text("Please enter only alphabets and numbers");
        } else {
            jQuery.ajax({
                type: "POST",
                url: AjaxURL,
                data: {
                    action: "veolia_lms_contact_instrutor_mail",
                    message: message,
                },
                success: function(response) {
                    if (response == "Success") {
                        toastr.options.timeOut = 3000;
                        toastr.success("Message sent to instructor.");

                    } else {
                        toastr.options.timeOut = 3000;
                        toastr.danger("Failed to send Message to instructor.");
                    }
                    jQuery("#model-contact-instrutor").hide();
                    jQuery("#contact_instrutor_message").val("");
                    jQuery("#model-backdrop-fade").removeClass("modal-backdrop");
                    jQuery("#model-backdrop-fade").removeClass("show");
                },
                error: function(response) {
                    console.log(response);
                },
            });
        }
    });
});

function contact_instrutor_model_open() {
    jQuery("#model-contact-instrutor").show();
    jQuery("#model-backdrop-fade").addClass("modal-backdrop");
    jQuery("#model-backdrop-fade").addClass("show");
}

function contact_instrutor_model_close() {
    jQuery("#model-contact-instrutor").hide();
    jQuery("#model-backdrop-fade").removeClass("modal-backdrop");
    jQuery("#model-backdrop-fade").removeClass("show");
    jQuery("#contact_instrutor_message").text("");
}

//function for order filter
function veolia_lms_order_filter() {

    var veolia_lms_order_fdate = jQuery("#veolia-lms-order-fdate").val();
    var veolia_lms_order_tdate = jQuery("#veolia-lms-order-tdate").val();
    var veolia_lms_order_id = jQuery("#veolia-lms-order-id").val();
    var veolia_lms_order_status = jQuery('#veolia-lms-order-status').find(":selected").val();
    var dataorderfilter = {
        action: "veolia_lms_order_list_filter",
        veolia_lms_filter_order_id: veolia_lms_order_id,
        veolia_lms_filter_order_fdate: veolia_lms_order_fdate,
        veolia_lms_filter_order_tdate: veolia_lms_order_tdate,
        veolia_lms_filter_order_status: veolia_lms_order_status,
    };
    jQuery.post(AjaxURL, dataorderfilter, function(response) {
        jQuery("#veolia_lms_order_list").html(response);
    });
}

function veolia_lms_order_filter_clear() {
    jQuery("#veolia-lms-order-fdate").val("");
    jQuery("#veolia-lms-order-tdate").val("");
    jQuery("#veolia-lms-order-id").val("");
    jQuery('#veolia-lms-order-status').prop('selectedIndex', 0);
    veolia_lms_order_fdate = "";
    veolia_lms_order_tdate = "";
    veolia_lms_order_id = "";
    veolia_lms_order_status = "";

    var dataorderfilter = {
        action: "veolia_lms_order_list_filter",
        veolia_lms_filter_order_id: veolia_lms_order_id,
        veolia_lms_filter_order_fdate: veolia_lms_order_fdate,
        veolia_lms_filter_order_tdate: veolia_lms_order_tdate,
        veolia_lms_filter_order_status: veolia_lms_order_status,
    };
    jQuery.post(AjaxURL, dataorderfilter, function(response) {
        jQuery("#veolia_lms_order_list").html(response);
    });
}

function veolia_lms_course_status_update(keyword,page) {	
    jQuery.ajax({	
        type: "POST",	
        url: AjaxURL,	
        data: {	
            action: "veolia_lms_course_status_update",	
            keyword: keyword,	
            page: page,	
        },	
        success: function(response) {	
            jQuery(".course-list-ajax").html(response);	
            jQuery('#filter_load').hide();	
        },	
        error: function(response) {	
            console.log(response);	
        },	
    });	
}	


function downloadOrderInvoice() {

    jQuery.ajax({
        type: "POST",
        url: AjaxURL,
        data: {
            action: "veolia_lms_order_invoice_download",
        },
        success: function(response) {
            console.log(response);
            if (response != '') {

                const dataStr = "data:application/pdf;base64," + response;
                //jQuery("#hiddenReportData").val(dataStr);
                //let report_data = jQuery("#hiddenReportData").val();
                if (dataStr !== "") {
                    const downloadAnchorNode = document.createElement("a");
                    downloadAnchorNode.setAttribute("href", dataStr);
                    downloadAnchorNode.setAttribute("id", "anchor");
                    downloadAnchorNode.setAttribute("download", "order_invoice" + ".pdf");
                    document.body.appendChild(downloadAnchorNode);
                    downloadAnchorNode.click();
                }
            }
        },
        error: function(response) {
            console.log(response);
        },
    });

}

// function to create a random 10 digit number
function veolia_lms_randomstring(length = 10) {
    var result = "";
    const d = new Date();
    let uniqueval = d.getTime();
    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result + uniqueval;
}