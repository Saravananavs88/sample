(function ($) {
    
    "use strict";

    /**
     * All of the code for your admin-facing JavaScript source
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
     *
     */
    jQuery("#learning_track_select").select2({
        placeholder: "Select Learning Track",
        tags: true,
    });
    jQuery("#learning_track_select")
        .on("change", function () {
            let learning_track_id = jQuery(
                "#learning_track_select option:selected"
            ).val();

            if (learning_track_id != "") {
                jQuery.ajax({
                    type: "POST",
                    url: ajax_object.ajaxurl,
                    data: {
                        action: "fetch_learning_track_ajax",
                        learning_track_id: learning_track_id
                    },
                    beforeSend: function () {
                        jQuery("#form-success").text("");
                        jQuery("#form-errors").text("");
                        jQuery("#veolia_learning_track_price").val("");
                        jQuery("#veolia_learning_instructor_name").val("");
                        jQuery("#loader_delay_select").removeClass("d-none");
                        jQuery("#instructorErr").text("");
                    },
                    success: function (response) {
                        jQuery("#loader_delay_select").addClass("d-none");
                        let data = JSON.parse(response);
                        let price = data["price"];
                        let image_url = data["image_url"];
                        let instructor = data["instructor"];
                        jQuery("#veolia_learning_track_price").val(price);
                        jQuery("#veolia_learning_instructor_name").val(instructor);
                        if (image_url != "") {
                            jQuery("#veolia_learning_track_image").prop("src", image_url);
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    },
                });
            }
        })
        .on("select2:close", function () { });

    jQuery("#learning_track_form_id").submit(function (e) {
        e.preventDefault();
        let learning_track_id = jQuery(
            "#learning_track_select option:selected"
        ).val();
        let price = jQuery("#veolia_learning_track_price").val();        
        var image_url = jQuery("#lt_image_url").val();

        if (image_url == "") {
            image_url = jQuery("#veolia_learning_track_image").attr("src");
        }
        let instructor = jQuery("#veolia_learning_instructor_name").val();
        if (learning_track_id != "" && price != "" && image_url != "" && instructor != '') {                
            if (instructorNameValidation()) {                     
                jQuery.ajax({
                    type: "POST",
                    url: ajax_object.ajaxurl,
                    data: {
                        action: "learning_track_ajax",
                        content_id: learning_track_id,
                        price: price,
                        image_url: image_url,
                        instructor:instructor
                    },
                    beforeSend: function () {
                        jQuery("#instructorErr").text("");
                        jQuery("#form-success").text("");
                        jQuery("#form-errors").text("");
                    },
                    success: function (response) {
                        let data = JSON.parse(response);
                        let result_response = data.success;
                        if (result_response == "Inserted") {
                            jQuery("#form-success").text("Updated successfully");
                        }
                        if (result_response == "Updated") {
                            jQuery("#form-success").text("Updated successfully");
                        }
                        if (result_response == "Failed") {
                            jQuery("#form-errors").text("Failed");
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    },

                    complete: function (response) {
                        jQuery("#lt_image_url").val("");
                    },
                });
            }

        } else {
            jQuery("#form-errors").text("All fields are reqired!");
        }
    });
})(jQuery);

function instructorNameValidation() {  
    let pattern = /^[a-z A-Z -]{2,60}$/;
    let instructorName = jQuery("#veolia_learning_instructor_name").val();
    let validuser = pattern.test(instructorName);
 
    if (instructorName.length < 2) {
        jQuery("#instructorErr").html("Instructor name must be at least 2 characters long");
        return false;
    } else if (!validuser) {
        jQuery("#instructorErr").html("Please enter only alphabets");
        return false;
    } else {
        jQuery("#instructorErr").html(" ");
        return true;
    }
}


jQuery(document).ready(function () {
    jQuery("#veolia_learning_track_upload").click(function (e) {
        e.preventDefault();
        var custom_uploader = wp
            .media({
                title: "Custom Image",
                button: {
                    text: "Upload",
                },
                multiple: false, // Set this to true to allow multiple files to be selected
            })
            .on("select", function () {
                var attachment = custom_uploader
                    .state()
                    .get("selection")
                    .first()
                    .toJSON();
                jQuery("#veolia_learning_track_image").attr("src", attachment.url);
                jQuery("#lt_image_url").val(attachment.url);
            })
            .open();
    });
});

function course_img_upload(input) {
    var image = document.getElementById("veolia_learning_track_image");
    image.src = URL.createObjectURL(event.target.files[0]);
}

// course mapping edit model
function get_learing_courses(title) {
    let learning_title = title;
    jQuery("#learning_track_select").select2({
        data: learning_title,
        // minimumInputLength: 2
    });

    // let getCourseVal = jQuery("#select_admin_lpath").val();
    // window.location.href = getCourseVal;
}

function admin_order_view_model(
    order_user_id,
    order_id,
    order_status,
    order_date,
    order_user_email
) {
    jQuery("#adminOrderViewModel").css("display", "block");
    jQuery("#modal-backdrop-custom").addClass("modal-backdrop");
    jQuery("#modal-backdrop-custom").addClass("show");

    if (
        order_id != "" &&
        order_user_id != "" &&
        order_status != "" &&
        order_user_email != ""
    ) {
        jQuery("#vro-lms-order-serial-num").text(order_id);
        jQuery("#vro-lms-order-serial-date").text(order_date);
        jQuery("#vro-lms-order-serial-status").text(order_status);
        jQuery.ajax({
            type: "POST",
            url: ajax_object.ajaxurl,
            data: {
                action: "admin_order_course_view_ajax",
                order_id: order_id,
                order_user_id: order_user_id,
                order_status: order_status,
                order_user_email: order_user_email,
            },
            beforeSend: function () {
                jQuery("#courseTableViewTBody").html("");
                let loader_path = jQuery("#admin_order_loading_input").val();
                if (loader_path != "") {
                    jQuery("<tr class='text-center'>")
                        .html(
                            "<td colspan='5'><img src='" +
                            loader_path +
                            "' width='40' height='40' id='admin_order_loading_img'></td>"
                        )
                        .appendTo("#courseTableViewTBody");
                }
            },
            success: function (response) {
                jQuery("#courseTableViewTBody").html("");
                let order_data = JSON.parse(response);
                if (order_data["is_error"] == "0") {
                    let order_total = 0;
                    let internal_discount = 0;
                    jQuery.each(order_data["data"], function (i, item) {
                        order_total +=
                            order_data["data"][i].order_detail_learning_program_fee;
                        jQuery("<tr>")
                            .html(
                                "<td>#" +
                                order_data["data"][i].order_detail_id +
                                "</td><td>" +
                                order_data["data"][i].order_detail_learning_program +
                                "</td><td>" +
                                order_data["data"][i].order_detail_qty +
                                "</td> <td>$" +
                                order_data["data"][i].order_detail_learning_program_fee +
                                "</td>  <td>$" +
                                order_data["data"][i].order_detail_learning_program_fee +
                                "</td>"
                            )
                            .appendTo("#courseTableViewTBody");
                    });

                    if (order_data["user_type"] == "external") {
                        jQuery("<tr>")
                            .html(
                                "<td colspan='4'><div class='text-right-custom'>Total</div></td><td> <div class='vro-lms-order-totalprice'>$" +
                                order_total +
                                "</div></td>"
                            )
                            .appendTo("#courseTableViewTBody");
                    } else {
                        jQuery("<tr>")
                            .html(
                                "<td  colspan='4'><div class='text-right-custom'>Discount</div></td><td> <div class='vro-lms-order-totalprice'>$" +
                                order_total +
                                "</div></td>"
                            )
                            .appendTo("#courseTableViewTBody");
                        jQuery("<tr>")
                            .html(
                                "<td colspan='4'><div class='text-right-custom'>Total</div></td><td> <div class='vro-lms-order-totalprice'>$" +
                                internal_discount +
                                "</div></td>"
                            )
                            .appendTo("#courseTableViewTBody");
                    }
                } else {
                    jQuery("<tr>")
                        .html("No orders found")
                        .appendTo("#courseTableViewTBody");
                }
            },
            complete: function () {
                jQuery("#admin_order_loading").addClass("d-none");
            },
            error: function (response) {
                console.log(response);
            },
        });
    }
}

function orderModelClose() {
    jQuery("#adminOrderViewModel").css("display", "none");
    jQuery("#modal-backdrop-custom").removeClass("modal-backdrop");
    jQuery("#modal-backdrop-custom").removeClass("show");
}