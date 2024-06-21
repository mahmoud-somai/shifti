<?php

function form_html() {
    $home_url = home_url();
  
    echo '<link rel="stylesheet" href="' . plugins_url('shifti-import/src/styles/form.css') . '">';

    echo '<form id="export-form" method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<div class="stf-form">';
    echo '<h2>Link Shop</h2>'; 
    echo '<div class="form-group">';
    echo '<span>Plugin Token : </span>';
    echo '<input type="text" name="plugin-token" id="token">';
    echo '<input type="hidden" name="action" value="post_data">';
    echo '<button type="submit" id="export-button" class="button-sft" disabled>Export Your Shop!</button>';
    echo '</div>';
    echo '</div>';
    echo '</form>';
    
    // Progress Overlay HTML
    echo '<div id="progress-overlay">';
    echo '    <div class="progress-container">';
    echo '        <h1>Export Data</h1>'; 
    echo '        <div style="text-align: center;">';
    echo '            <progress id="progress-bar" max="100" value="0"></progress>'; 
    echo '            <div id="progress-status">0%</div>';
    echo '            <div id="success-messages"></div>';
    echo '            <div class="button-container">'; 
    echo '                <button id="cancel-button" class="button-sft">Cancel</button>';
    echo '                <button id="done-button" class="button-sft">Done</button>';
    echo '            </div>'; 
    echo '        </div>';
    echo '    </div>';
    echo '</div>';

    // Invalid Credentials Overlay HTML
    echo '<div id="invalid-credentials-overlay" style="display:none; background-color: red; color: white; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; border-radius: 5px;">';
    echo '    <div class="overlay-container">';
    echo '        <h1>Invalid Credentials</h1>';
    echo '    </div>';
    echo '</div>';
    
    echo '<script type="text/javascript">
    jQuery(document).ready(function($) {
        var homeUrl = "' . $home_url . '";
        var fetchUrl = "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/shop?url=" + encodeURIComponent(homeUrl)+"/";
        var exportButton = $("#export-button");
        var tenantId = "";
        
        // Automatically fetch data when the page loads
        $.ajax({
            url: fetchUrl,
            method: "GET",
            success: function(response) {
                console.log("Data fetched successfully:", response);
                tenantId = response.tenant_id; // Store the tenant_id
                // Send fetched data to server to store it
                $.ajax({
                    url: "' . admin_url('admin-ajax.php') . '",
                    method: "POST",
                    data: {
                        action: "store_shop_data",
                        shop_id: response.shop_id,
                        tenant_id: response.tenant_id
                    },
                    success: function(storeResponse) {
                        console.log("Data stored successfully:", storeResponse);
                        // Enable the export button after successful data fetch and store
                        exportButton.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        console.log("Error storing data:", error);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.log("Error fetching data:", error);
            }
        });

        $("#export-form").submit(function(event) {
            event.preventDefault();
            var inputVal = $("#token").val();
            var progressOverlay = $("#progress-overlay");
            var invalidCredentialsOverlay = $("#invalid-credentials-overlay");

            if (inputVal === tenantId) {
                // Proceed with the export process if tenantId matches
                progressOverlay.show();
                performExport();
            } else {
               
                $("#token").css("border", "2px solid red");
                invalidCredentialsOverlay.show();
                setTimeout(function() {
                    invalidCredentialsOverlay.hide();
                    $("#token").css("border", "");
                }, 5000);
            }
        });

        var performExport = function() {
            var progressBar = $("#progress-bar");
            var progressStatus = $("#progress-status");
            var successMessages = $("#success-messages");
            var doneButton = $("#done-button");
            var cancelExport = false;

            progressBar.val(0);
            progressStatus.text("0%");
            successMessages.html("");

            var updateProgress = function(progress, message) {
                progressBar.val(progress);
                progressStatus.text(progress + "%");
                successMessages.append("<p>" + message + "</p>");
            };

            var actions = [
                {action: "get_category_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/category", message: "Categories exported with success"},
                {action: "get_customers_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/customer", message: "Customers exported with success"},
                {action: "get_tax_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/taxe", message: "Taxes exported with success"},
                {action: "get_prods_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/product", message: "Products exported with success"},
                {action: "get_orders_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/order", message: "Orders exported with success"},
                {action: "get_orders_det_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/orderdetails", message: "Order details exported with success"},
                {action: "get_orders_fees_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/orderFees", message: "Order fees exported with success"},
                {action: "get_orders_carriers_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/orderCarriers", message: "Order carriers exported with success"},
                {action: "get_orders_taxes_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/orderTaxes", message: "Order taxes exported with success"},
                {action: "get_billing_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/billing", message: "Billing exported with success"},
                {action: "get_shipping_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/shipping", message: "Shipping exported with success"},
                {action: "get_order_carrier_taxes_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/orderCarrierTax", message: "Order Carriers Taxes exported with success"},
                {action:"get_order_details_taxes_data", url: "https://bs9ksq1d-8082.euw.devtunnels.ms/woocommerce/orderDetailsTax", message: "Order details taxes exported with success"},
            ];

            var currentAction = 0;
            var totalActions = actions.length;
            var increment = 100 / totalActions;

            var performNextAction = function() {
                if (cancelExport) {
                    progressOverlay.hide();
                    return;
                }

                if (currentAction < totalActions) {
                    var action = actions[currentAction];
                    $.ajax({
                        url: "' . admin_url('admin-ajax.php') . '",
                        method: "POST",
                        data: { action: action.action },
                        success: function(response) {
                            if (response.success) {
                                var data = response.data;
                                $.ajax({
                                    url: action.url,
                                    method: "POST",
                                    data: data,
                                    contentType: "application/json",
                                    success: function() {
                                        console.log("POST request for " + action.action + " successful.");
                                        currentAction++;
                                        updateProgress(Math.round(currentAction * increment), action.message);
                                        performNextAction();
                                    },
                                    error: function(xhr, status, error) {
                                        console.log("Error posting data for " + action.action + ": " + error);
                                        progressOverlay.hide();
                                    }
                                });
                            } else {
                                console.log("Error fetching data for " + action.action);
                                progressOverlay.hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error fetching data via AJAX for " + action.action + ": " + error);
                            progressOverlay.hide();
                        }
                    });
                } else {
                    doneButton.show();
                }
            };

            performNextAction();

            $("#cancel-button").click(function() {
                cancelExport = true;
                progressOverlay.hide();
            });

            doneButton.click(function() {
                progressOverlay.hide();
            });
        };
    });
    </script>';

    // echo '<script src="' . plugins_url('shifti-import/src/scripts/index.js') . '"></script>';
}

?>
