

<?php

require_once dirname(__FILE__) . '/../form/form.php';



function header_html(){


 
    echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';


    echo '<div style="text-align: center; padding: 20px; background-color: #f0f0f0;">';
        echo '<img src="' . plugins_url( 'shifti-import/src/img/logo.png') . '" alt="Logo" style="width: 150px; height: 100px;">';
        echo '<h1 style="font-size: 24px; margin-top: 20px;">Welcome to Shifti WordPress Plugin</h1>';
        echo '<p style="font-size: 16px; margin-top: 10px;">Here you can import the data of your shop</p>';
        echo '<p style="font-size: 16px;">By entering your plugin shop secret key and pressing import, you can import your WooCommerce data to your shop!</p>';
        form_html();

        echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
        echo '<input type="hidden" name="action" value="download_category_json">';
        echo '<button type="submit">Download Categories JSON</button>';
        echo '</form>';

        echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
        echo '<input type="hidden" name="action" value="download_orders_json">';
        echo '<button type="submit">Download Orders JSON</button>';
        echo '</form>';

        echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
        echo '<input type="hidden" name="action" value="download_customers_json">';
        echo '<button type="submit">Download Customers JSON</button>';
        echo '</form>';

        echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
        echo '<input type="hidden" name="action" value="download_orders_notes_json">';
        echo '<button type="submit">Download Orders Notes JSON</button>';
        echo '</form>';
        
        echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
        echo '<input type="hidden" name="action" value="download_taxes_json">';
        echo '<button type="submit">Download Taxes JSON</button>';
        echo '</form>';

        echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
        echo '<input type="hidden" name="action" value="download_products_json">';
        echo '<button type="submit">Download products JSON</button>';
        echo '</form>';
       
        echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
        echo '<input type="hidden" name="action" value="fetch_golang_data">'; // Set the action to call fetch_golang_data
        echo '<button type="submit" id="fetch-golang-data-button">Fetch Data from Golang API</button>';
        echo '</form>';
    
        // Add the necessary JavaScript directly here
        echo '<script type="text/javascript">
                jQuery(document).ready(function($) {
                    $("#fetch-golang-data-button").click(function(event) {
                        event.preventDefault(); // Prevent the default form submission
                        $.ajax({
                            url: "' . admin_url('admin-ajax.php') . '", // URL of admin-ajax.php
                            method: "POST", // Method for the AJAX request
                            data: {
                                action: "fetch_golang_data" // Specify the action for your AJAX handler
                            },
                            success: function(response) {
                                console.log("Data from Golang API:", response);
                            },
                            error: function(xhr, status, error) {
                                console.error("Error fetching data:", error);
                            }
                        });
                    });
                });
            </script>';
    
    

    echo '</div>';
    
   
}