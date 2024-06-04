<?php

function form_html() {
    echo '<link rel="stylesheet" href="' . plugins_url('shifti-import/src/styles/main.css') . '">';

    echo '<form id="export-form" method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<div class="stf-form" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin: 20px auto; background-color: white; width: 50%; text-align: center;">';
    echo '<h2 style="width: 100%; margin-bottom: 10px;">Link Shop</h2>'; 
    echo '<div class="form-group" style="display: inline-block; width: 100%;">';
    echo '<span style="font-size: 16px; color: #333; width: 20%; text-align: left; display: inline-block;">Plugin Token : </span>';
    echo '<input type="text" name="plugin-token" id="token" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 40%; height:35px; display: inline-block;">';
    echo '<input type="hidden" name="action" value="post_data">';
    echo '<button type="submit" id="export-button" class="button-sft" style="background-color: #008DDA; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 30%; display: inline-block; margin-left:25px;">Export Your Shop!</button>';
    echo '</div>';
    echo '</div>';
    echo '</form>';

    // Overlay HTML
    echo '<div id="progress-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); z-index: 9999; display: none;">';
    echo '    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 30px; border-radius: 10px; width: 90%; max-width: 500px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">';
    echo '        <h1 style="margin-bottom: 20px; color: #00215E; font-size: 24px;">Export Data</h1>'; 
    echo '        <div style="text-align: center;">';
    echo '            <progress id="progress-bar" style="width: 100%; height: 20px; margin-bottom: 10px;"></progress>'; 
    echo '            <div id="progress-status" style="margin-top: 10px; font-size: 20px; color: #333;">0%</div>';
    echo '            <div id="success-messages" style="margin-top: 10px; text-align: left; font-size: 18px; color: #fff; background-color: #5BBCFF; padding: 10px; border-radius: 5px;"></div>';
    echo '            <div style="margin-top: 20px;">'; 
    echo '                <button id="cancel-button" class="button-sft" style="background-color: #ff5722; color: white; padding: 8px 20px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px;">Cancel</button>';
    echo '                <button id="done-button" class="button-sft" style="background-color: #4CAF50; color: white; padding: 8px 20px; border: none; border-radius: 4px; cursor: pointer; display: none;">Done</button>';
    echo '            </div>'; 
    echo '        </div>';
    echo '    </div>';
    echo '</div>';
    
    echo '<script src="' . plugins_url('shifti-import/src/scripts/index.js') . '"></script>';
    echo '<script type="text/javascript">
    jQuery(document).ready(function($) {
        var cancelExport = false;

        $("#export-form").submit(function(event) {
            event.preventDefault(); 
            var progressOverlay = $("#progress-overlay");
            var progressBar = $("#progress-bar");
            var progressStatus = $("#progress-status");
            var successMessages = $("#success-messages");
            var doneButton = $("#done-button");
            
            progressOverlay.show();
            progressBar.val(0);
            progressStatus.text("0%");
            successMessages.html("");
            cancelExport = false;
            
            var updateProgress = function(progress, message) {
                progressBar.val(progress);
                progressStatus.text(progress + "%");
                successMessages.append("<p>" + message + "</p>");
            };
            
            var actions = [
                {action: "get_category_data", url: "http://localhost:8080/woocommerce/category", message: "Categories exported with success"},
                {action: "get_customers_data", url: "http://localhost:8080/woocommerce/customer", message: "Customers exported with success"},
                {action: "get_tax_data", url: "http://localhost:8080/woocommerce/taxe", message: "Taxes exported with success"},
                {action: "get_prods_data", url: "http://localhost:8080/woocommerce/product", message: "Products exported with success"},
                {action: "get_orders_data", url: "http://localhost:8080/woocommerce/order", message: "Orders exported with success"},
                {action: "get_orders_det_data", url: "http://localhost:8080/woocommerce/orderdetails", message: "Order details exported with success"},
                {action: "get_orders_fees_data", url: "http://localhost:8080/woocommerce/orderFees", message: "Order fees exported with success"},
                {action: "get_orders_carriers_data", url: "http://localhost:8080/woocommerce/orderCarriers", message: "Order carriers exported with success"},
                {action: "get_orders_taxes_data", url: "http://localhost:8080/woocommerce/orderTaxes", message: "Order taxes exported with success"},
                {action: "get_billing_data", url: "http://localhost:8080/woocommerce/billing", message: "Billing exported with success"},
                {action: "get_shipping_data", url: "http://localhost:8080/woocommerce/shipping", message: "Shipping exported with success"}
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
        });
    });
    </script>';
}

?>
