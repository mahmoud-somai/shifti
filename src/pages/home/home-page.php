<?php

require_once dirname(__FILE__) . '/../form/form.php';

function header_html(){
    echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';
    echo '<div style="text-align: center; padding: 20px; background-color: #f0f0f0;">';
    echo '<img class="logo_img" src="' . plugins_url( 'shifti-import/src/img/logo.png') . '" alt="Logo">';
    echo '<h1>Welcome to the Shifti Data Connector module!</h1>';
    
    
    // Styling for the paragraph box with shadow
    echo '<div style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin: 20px;">';
    echo '<p>This versatile module allows seamless integration between your WooCommerce Shop and the Shifti web app. Easily configure the module using the intuitive form below. Experience enhanced data management and boost your sales with this powerful module.</p>';
    echo '<p>This plugin provides convenient options to download various data types from your WooCommerce store. You can download categories, orders, customers, order notes, taxes, and products in JSON format. Additionally, you can fetch data from a Go API endpoint for further integration.</p>';
    echo '</div>';
    form_html();
    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_category_json">';
    // echo '<button type="submit">Download Categories JSON</button>';
    // echo '</form>';

    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_orders_json">';
    // echo '<button type="submit">Download Orders JSON</button>';
    // echo '</form>';

    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_customers_json">';
    // echo '<button type="submit">Download Customers JSON</button>';
    // echo '</form>';

    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_orders_notes_json">';
    // echo '<button type="submit">Download Orders Notes JSON</button>';
    // echo '</form>';
    
    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_taxes_json">';
    // echo '<button type="submit">Download Taxes JSON</button>';
    // echo '</form>';

    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_products_json">';
    // echo '<button type="submit">Download products JSON</button>';
    // echo '</form>';
   
    // echo '<form id="fetch-golang-data-form">';
    // echo '<input type="hidden" name="action" value="fetch_golang_data">'; // Set the action to call fetch_golang_data
    // echo '<button type="submit" id="fetch-golang-data-button">Fetch Data from  DB</button>';
    // echo '</form>';
    
    // // Placeholder elements to display the endpoint and response
    // echo '<div id="endpoint-called"></div>';
    // echo '<div id="response-received"></div>';

    // // Add the necessary JavaScript directly here
    // echo '<script type="text/javascript">
    //         jQuery(document).ready(function($) {
    //             $("#fetch-golang-data-form").submit(function(event) {
    //                 event.preventDefault(); // Prevent the default form submission
    //                 $.ajax({
    //                     url: "http://192.168.1.15:8080/api/ordersnote", // URL of the Golang API endpoint
    //                     method: "GET", 
    //                     success: function(response) {
    //                         // Show the endpoint and response on the page
    //                         $("#endpoint-called").text("Endpoint called: http://192.168.1.15:8080/api/ordersnote");
    //                         $("#response-received").text("Response received: " + response);
    //                     },
    //                     error: function(xhr, status, error) {
    //                         console.error("Error fetching data:", error);
    //                     }
    //                 });
    //             });
    //         });
    //     </script>';

    // echo '</div>';
}
?>
