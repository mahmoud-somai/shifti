<?php
require_once dirname(__FILE__) . '/../form/form.php';

function header_html(){
    $language = isset($_POST['language_toggle']) ? $_POST['language_toggle'] : 'english';

    // HTML content
    echo '<link rel="stylesheet" href="' . plugins_url( 'shifti-import/src/styles/main.css') . '">';
    echo '<div style="text-align: center; padding: 20px; background-color: #f0f0f0;">';
    echo '<img class="logo_img" src="' . plugins_url( 'shifti-import/src/img/logo.png') . '" alt="Logo Shifti">';
    echo '<h1>' . ($language === 'english' ? 'Welcome to the Shifti Data Connector Plugin !' : 'Bienvenue dans le plugin de connexion de données Shifti !') . '</h1>';

    echo '<div style="box-shadow: 8px 8px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin: 20px; background-color: white;">';
    echo '<p style="font-size: 15px;">' . ($language === 'english' ? 'This versatile module allows seamless integration between your WooCommerce Shop and the Shifti web app. Easily configure the module using the intuitive form below. Experience enhanced data management and boost your sales with this powerful module.' : 'Ce module polyvalent permet une intégration transparente entre votre boutique WooCommerce et l\'application web Shifti. Configurez facilement le module à l\'aide du formulaire intuitif ci-dessous. Bénéficiez d\'une gestion améliorée des données et boostez vos ventes avec ce module puissant.') . '</p>';
    echo '<p style="font-size: 15px;">' . ($language === 'english' ? 'This plugin provides convenient options to download various data types from your WooCommerce store. You can download categories, orders, customers, order notes, taxes, and products in JSON format. Additionally, you can fetch data from a Go API endpoint for further integration.' : 'Ce plugin offre des options pratiques pour télécharger différents types de données depuis votre boutique WooCommerce. Vous pouvez télécharger des catégories, des commandes, des clients, des notes de commande, des taxes et des produits au format JSON. De plus, vous pouvez récupérer des données à partir d\'un point d\'API Go pour une intégration ultérieure.') . '</p>';
    echo '</div>';

    echo '<div style="box-shadow: 8px 8px 8px rgba(0, 0, 0, 0.1); padding: 20px; margin: 20px; background-color: white; text-align: left;">';
    echo '<h2>' . ($language === 'english' ? 'Documentation' : 'Documentation') . '</h2>';
    echo '<p style="font-size: 15px;">' . ($language === 'english' ? '» You can download the PDF documentation for this module:' : '» Vous pouvez télécharger la documentation PDF pour ce module :') . '</p>';
    echo '<ul style="list-style-type: disc; padding-left: 50px; margin-left: 0;">'; // Set margin-left to 0

    // Add French documentation download link
    echo '<li style="margin-bottom: 20px; padding-left: 10px;">';
    echo '<a href="' . plugins_url( 'shifti-import/sample.pdf') . '" download style="font-size: 15px; padding: 15px 10px; text-decoration: underline;">' . ($language === 'english' ? 'French' : 'Français') . '</a>';
    echo '</li>';

    // Add English documentation download link
    echo '<li style="margin-bottom: 20px; padding-left: 10px;">';
    echo '<a href="' . plugins_url( 'shifti-import/sample.pdf') . '" download style="font-size: 15px; padding: 15px 10px; text-decoration: underline;">' . ($language === 'english' ? 'English' : 'Anglais') . '</a>';
    echo '</li>';

    echo '</ul>';

    // Language toggle button form
    echo '<form method="post">';
    echo '<input type="hidden" name="language_toggle" value="' . ($language === 'english' ? 'french' : 'english') . '">';
    echo '<button type="submit">' . ($language === 'english' ? 'Switch to French' : 'Switch to English') . '</button>';
    echo '</form>';

    echo '</div>';
    form_html();
    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_workers_json">';
    // echo '<button type="submit">Download Workers JSON</button>';
    // echo '</form>';


    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_category_json">';
    // echo '<button type="submit">Download Categories JSON</button>';
    // echo '</form>';

    // // Add a form to download orders JSON
    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_orders_json">';
    // echo '<button type="submit">Download Orders JSON</button>';
    // echo '</form>';

    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_orders_details_json">';
    // echo '<button type="submit">Download Details JSON</button>';
    // echo '</form>';

    echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<input type="hidden" name="action" value="download_orders_fees_json">';
    echo '<button type="submit">Download Fees JSON</button>';
    echo '</form>';

    echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<input type="hidden" name="action" value="download_orders_carriers_json">';
    echo '<button type="submit">Download Carriers JSON</button>';
    echo '</form>';

    echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<input type="hidden" name="action" value="download_orders_taxes_json">';
    echo '<button type="submit">Download Orders Taxes JSON</button>';
    echo '</form>';

    echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<input type="hidden" name="action" value="download_shipping_json">';
    echo '<button type="submit">Download Shipping JSON</button>';
    echo '</form>';

    echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<input type="hidden" name="action" value="download_billing_json">';
    echo '<button type="submit">Download Billing JSON</button>';
    echo '</form>';

    // Add a form to download customers JSON
    echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<input type="hidden" name="action" value="download_customers_json">';
    echo '<button type="submit">Download Customers JSON</button>';
    echo '</form>';

    // // Add a form to download orders notes JSON
    echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<input type="hidden" name="action" value="download_orders_notes_json">';
    echo '<button type="submit">Download Orders Notes JSON</button>';
    echo '</form>';

    // // Add a form to download taxes JSON
    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_taxes_json">';
    // echo '<button type="submit">Download Taxes JSON</button>';
    // echo '</form>';

    // // Add a form to download products JSON
    // echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    // echo '<input type="hidden" name="action" value="download_products_json">';
    // echo '<button type="submit">Download products JSON</button>';
    // echo '</form>';

    echo '<form method="post" action="' . admin_url('admin-ajax.php') . '">';
    echo '<input type="hidden" name="action" value="download_addresses_json">';
    echo '<button type="submit">Download Addresses JSON</button>';
    echo '</form>';

   
 // Add a form to post data to DB
 echo '<form method="post" id="post-data-form">';
 echo '<input type="hidden" name="action" value="post_data">';
 echo '<button type="submit">Post Data to DB</button>';
 echo '</form>';

 // JavaScript code to handle the form submission
 echo '<script type="text/javascript">
 jQuery(document).ready(function($) {
     $("#post-data-form").submit(function(event) {
         event.preventDefault(); // Prevent the default form submission
         
         // Fetch the category data using AJAX
         $.ajax({
             url: "' . admin_url('admin-ajax.php') . '",
             method: "POST",
             data: {
                 action: "get_category_data"
             },
             success: function(response) {
                 if (response.success) {
                     var categoryData = response.data;  // Get the category data
 
                     console.log("Button clicked. Posting category data...");
                     console.log("Category data:", categoryData);
 
                     var categoryUrl = "http://localhost:8080/woocommerce/category";
 
                     // Make an AJAX request to post the category data
                     $.ajax({
                         url: categoryUrl,
                         method: "POST",
                         data: categoryData, // Convert the data to JSON format
                         contentType: "application/json", // Set the content type to JSON
                         success: function(response) {
                             console.log("POST request for categories successful:", response);
 
                             // Fetch and post the customers data
                             $.ajax({
                                 url: "' . admin_url('admin-ajax.php') . '",
                                 method: "POST",
                                 data: {
                                     action: "get_customers_data"
                                 },
                                 success: function(response) {
                                     if (response.success) {
                                         var customersData = response.data;  // Get the customers data
 
                                         console.log("Posting customers data...");
                                         console.log("Customers data:", customersData);
 
                                         var customersUrl = "http://localhost:8080/woocommerce/customer";
 
                                         // Make an AJAX request to post the customers data
                                         $.ajax({
                                             url: customersUrl,
                                             method: "POST",
                                             data: customersData, // Convert the data to JSON format
                                             contentType: "application/json", // Set the content type to JSON
                                             success: function(response) {
                                                 console.log("POST request for customers successful:", response);
 
                                                 // Fetch and post the tax data
                                                 $.ajax({
                                                     url: "' . admin_url('admin-ajax.php') . '",
                                                     method: "POST",
                                                     data: {
                                                         action: "get_tax_data"
                                                     },
                                                     success: function(response) {
                                                         if (response.success) {
                                                             var taxData = response.data;  // Get the tax data
 
                                                             console.log("Posting tax data...");
                                                             console.log("Tax data:", taxData);
 
                                                             var taxUrl = "http://localhost:8080/woocommerce/taxe";
 
                                                             // Make an AJAX request to post the tax data
                                                             $.ajax({
                                                                 url: taxUrl,
                                                                 method: "POST",
                                                                 data: taxData, // Convert the data to JSON format
                                                                 contentType: "application/json", // Set the content type to JSON
                                                                 success: function(response) {
                                                                     console.log("POST request for taxes successful:", response);
 
                                                                     // Fetch and post the product data
                                                                     $.ajax({
                                                                         url: "' . admin_url('admin-ajax.php') . '",
                                                                         method: "POST",
                                                                         data: {
                                                                             action: "get_prods_data"
                                                                         },
                                                                         success: function(response) {
                                                                             if (response.success) {
                                                                                 var productData = response.data;  // Get the product data
 
                                                                                 console.log("Posting product data...");
                                                                                 console.log("Product data:", productData);
 
                                                                                 var productUrl = "http://localhost:8080/woocommerce/product";
 
                                                                                 // Make an AJAX request to post the product data
                                                                                 $.ajax({
                                                                                     url: productUrl,
                                                                                     method: "POST",
                                                                                     data: productData, // Convert the data to JSON format
                                                                                     contentType: "application/json", // Set the content type to JSON
                                                                                     success: function(response) {
                                                                                         console.log("POST request for products successful:", response);
                                                                                     },
                                                                                     error: function(xhr, status, error) {
                                                                                         console.log("Error posting product data:", error);
                                                                                     }
                                                                                 });
                                                                             } else {
                                                                                 console.log("Errors fetching product data");
                                                                             }
                                                                         },
                                                                         error: function(xhr, status, error) {
                                                                             console.log("Error fetching product data via AJAX:", error);
                                                                         }
                                                                     });
                                                                 },
                                                                 error: function(xhr, status, error) {
                                                                     console.log("Error posting tax data:", error);
                                                                 }
                                                             });
                                                         } else {
                                                             console.log("Errors fetching tax data");
                                                         }
                                                     },
                                                     error: function(xhr, status, error) {
                                                         console.log("Error fetching tax data via AJAX:", error);
                                                     }
                                                 });
                                             },
                                             error: function(xhr, status, error) {
                                                 console.log("Error posting customers data:", error);
                                             }
                                         });
                                     } else {
                                         console.log("Errors fetching customers data");
                                     }
                                 },
                                 error: function(xhr, status, error) {
                                     console.log("Error fetching customers data via AJAX:", error);
                                 }
                             });
                         },
                         error: function(xhr, status, error) {
                             console.log("Error posting category data:", error);
                         }
                     });
                 } else {
                     console.log("Errors fetching category data");
                 }
             },
             error: function(xhr, status, error) {
                 console.log("Error fetching category data via AJAX:", error);
             }
         });
     });
 });
 </script>';




    // Add a form to fetch data from the Go API endpoint
    // echo '<form id="fetch-golang-data-form">';
    // echo '<input type="hidden" name="action" value="fetch_golang_data">'; // Set the action to call fetch_golang_data
    // echo '<button type="submit" id="fetch-golang-data-button">Fetch Data from DB</button>';
    // echo '</form>';

    // // Placeholder elements to display the endpoint and response
    // echo '<div id="endpoint-called"></div>';
    // echo '<div id="response-received"></div>';

    // JavaScript code to handle the form submission for fetching data from the Go API endpoint
    // echo '<script type="text/javascript">
    // jQuery(document).ready(function($) {
    //     $("#fetch-golang-data-form").submit(function(event) {
    //         event.preventDefault(); // Prevent the default form submission
            
    //         // Get the URL from the form
    //         var url = "http://localhost:8080/api/ordersnote"; // HTTP endpoint
            
    //         // Make an AJAX request to the endpoint
    //         $.ajax({
    //             url: url,
    //             method: "GET",
    //             success: function(response) {
    //                 // Log the endpoint called
    //                 $("#endpoint-called").text("Endpoint called: " + url);
    //                 // Display the response
    //                 $("#response-received").text("Response received: " + (response));
    //             },
    //             error: function(xhr, status, error) {
    //                 // Log an error message if the request fails
    //                 console.log("Error fetching from this url : " + url);
    //             }
    //         });
    //     });
    // });
    // </script>';

    echo '</div>';
   
}
 
?>
