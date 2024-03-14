

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



        echo '<script type="text/javascript">';
        echo 'function fetchOrdersNotesFromAPI() {';
        echo '    jQuery.ajax({';
        echo '        url: "http://localhost:8080/api/ordersnote",'; // URL of your Golang API endpoint
        echo '        method: "GET",'; // Make a GET request
        echo '        success: function(response) {';
        echo '            console.log("Data fetched successfully:", response);'; // Log success message
        echo '        },';
        echo '        error: function(xhr, status, error) {';
        echo '            console.error("Error fetching data:", error);'; // Log error message
        echo '        }';
        echo '    });';
        echo '}';
        echo '</script>';

        // Form to trigger sending orders notes to API
        echo '<form>';
        echo '<button type="button" onclick="sendOrdersNotesToAPI()">Send Orders Notes to API </button>';
        echo '</form>';


   
   

    echo '</div>';
    
   
}