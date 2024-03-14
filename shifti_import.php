<?php
/*
 * Plugin Name:       Shifti Import 
 * Description:       This is a plugin to import woocommerce data from your shop.
 * Version:           1.0.0
 * Author:            Feres Guedich
 * License:           MIT License
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed 
}

if (!defined('WPINC')) {
    die("Please don't run via command line.");
}

require_once plugin_dir_path(__FILE__) . 'src/pages/home/home-page.php';
//require_once plugin_dir_path(__FILE__) . 'src/data/products/getProducts.php';
require_once plugin_dir_path(__FILE__) . 'src/data/orders/getOrders.php';
require_once plugin_dir_path(__FILE__) . 'src/data/categories/getCategories.php';
require_once plugin_dir_path(__FILE__) . 'src/data/customers/getCustomers.php';
require_once plugin_dir_path(__FILE__) . 'src/data/notes/getOrderNotes.php';
require_once plugin_dir_path(__FILE__) . 'src/data/taxes/getTaxes.php';
require_once plugin_dir_path(__FILE__) . 'src/data/prod/getProd.php';


add_action('wp_ajax_download_category_json', 'download_category_json');
function download_category_json() {
    
    $json_data = get_ctg();

    // $category = get_ctg();
    // $category = array_slice($category, 0, 10);
    // $json_data = json_encode($category);

  
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="categories.json"');

 
    echo $json_data;
    exit();
}

add_action('wp_ajax_download_orders_json', 'download_orders_json');
function download_orders_json() {

    $json_data = get_orders();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="orders.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_download_customers_json', 'download_customers_json');
function download_customers_json() {

    $json_data = get_customers();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="cutomers.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_download_orders_notes_json', 'download_orders_notes_json');
function download_orders_notes_json() {

    $json_data = get_orders_notes();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="orders_notes.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_download_taxes_json', 'download_taxes_json');
function download_taxes_json() {

    $json_data = get_txs();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="taxes.json"');

    echo $json_data;
    exit();
}
add_action('wp_ajax_download_products_json', 'download_products_json');
function download_products_json() {

    $json_data = get_prod();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="products.json"');

    echo $json_data;
    exit();
}



// add_action('wp_ajax_send_orders_notes_to_api', 'send_orders_notes_to_api');
// function send_orders_notes_to_api() {
//     $api_url = 'http://localhost:8080/api/ordersnote';

//     $response = wp_remote_post($api_url, array(
//         'timeout'   => 15,
//         'body'      => array()
//     ));

//     if (is_wp_error($response)) {
//         wp_send_json_error($response->get_error_message());
//     } else {
//         $response_code = wp_remote_retrieve_response_code($response);
//         $response_body = wp_remote_retrieve_body($response);
//         if ($response_code === 200) {
//             wp_send_json_success($response_body);
//         } else {
//             wp_send_json_error('Error sending orders notes to API. Response code: ' . $response_code);
//         }
//     }
//     exit;
// }


// Define the URL of your API endpoint
$api_url = 'http://localhost:8080/api/ordersnote';

// Prepare the data to be sent in the request body
$data = array(
    array(
        'id_foreign' => 123,
        'date' => '2024-03-13T12:00:00Z',
        'author' => 'John Doe',
        'content' => 'This is a sample note for an order.'
    ),
    array(
        'id_foreign' => 456,
        'date' => '2024-03-14T12:00:00Z',
        'author' => 'Jane Smith',
        'content' => 'Another sample note for an order.'
    )
);

// Prepare the arguments for the wp_remote_post function
$args = array(
    'body' => json_encode($data), // Convert the data array to JSON format
    'headers' => array(
        'Content-Type' => 'application/json', // Specify JSON content type
    ),
);

// Send the POST request to the API endpoint
$response = wp_remote_post($api_url, $args);

// Check if the request was successful
if (!is_wp_error($response)) {
    $response_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);
    // Process the response as needed
    echo 'Response code: ' . $response_code . '<br>';
    echo 'Response body: ' . $response_body;
} else {
    // Handle the error if the request failed
    $error_message = $response->get_error_message();
    echo 'Error: ' . $error_message;
}







function page_render_callback() {
    header_html();
   //  get_products();
    get_orders();
    get_ctg();
    get_customers();
    get_orders_notes();
    get_txs();
    get_prod();

}

class Shifti_Import {
    function __construct() {
        add_action('admin_menu', array($this, 'shifti_import_menu_page'));
    }

    function activate() {
        flush_rewrite_rules();
    }

    function deactivate() {
        flush_rewrite_rules();
    }

    function uninstall() {
        // Clean up any plugin-specific data if needed
    }

    function shifti_import_menu_page() {
        add_menu_page(__('Testing', 'textdomain'), 'Shifti', 'manage_options', 'testing', 'page_render_callback', 'dashicons-store', '6');
    }
}

if (class_exists('Shifti_Import')) {
    $plugin_shifti = new Shifti_Import();

    // Register activation and deactivation hooks
    register_activation_hook(__FILE__, array($plugin_shifti, 'activate'));
    register_deactivation_hook(__FILE__, array($plugin_shifti, 'deactivate'));
}
