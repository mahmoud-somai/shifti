<?php
/*
 * Plugin Name:       Shifti Import 
 * Description:       This is a plugin to Export woocommerce data from your shop.
 * Version:           1.0.0
 * Author:            Mahmoud Somai
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
require_once plugin_dir_path(__FILE__) . 'src/data/categories/getCategory.php';
require_once plugin_dir_path(__FILE__) . 'src/data/customers/getCustomer.php';
require_once plugin_dir_path(__FILE__) . 'src/data/workers/getWorkers.php';
require_once plugin_dir_path(__FILE__) . 'src/data/notes/getOrderNotes.php';
require_once plugin_dir_path(__FILE__) . 'src/data/taxes/getTaxes.php';
require_once plugin_dir_path(__FILE__) . 'src/data/prod/getProd.php';


require_once plugin_dir_path(__FILE__) . 'src/data/addresses/getAddresses.php';


add_action('wp_ajax_download_category_json', 'download_category_json');
function download_category_json() {
    
    $json_data = get_ctg_one();

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

add_action('wp_ajax_download_workers_json', 'download_workers_json');
function download_workers_json() {

    $json_data = get_workers();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="Workers.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_fetch_golang_data', 'fetch_golang_data');


add_action('wp_ajax_download_addresses_json', 'download_addresses_json');
function download_addresses_json() {

    $json_data = get_customers_with_billing();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="addresses.json"');

    echo $json_data;
    exit();
}


// Function to fetch data from Golang API and send it as JSON response
function fetch_golang_data() {
    // Make AJAX request to fetch data from the Golang API
    $url = ' http://localhost:8080/woocommerce/customer';



    $response = wp_remote_get($url);

    // Check if the request was successful
    if (!is_wp_error($response)) {
        // Log the response data to the console
        echo '<script>';
        echo 'console.log("Response from WP: ' . $response . '");';
        echo '</script>';
    } else {
        // Log an error message to the console
        echo '<script>';
        echo 'console.log("Error from WP: ' . $url . '");';
        echo '</script>';
    }
}











function page_render_callback() {
    header_html();
   //  get_products();
    get_orders();
    get_ctg_one();
    get_customers();
    get_orders_notes();
    get_txs();
    get_prod();
    get_workers();
    get_customers_with_billing();
   
    

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

function enqueue_fetch_golang_data_script() {
    wp_enqueue_script('fetch-golang-data-script', plugins_url('plugin-script.js', __FILE__), array('jquery'), null, true);
}

if (class_exists('Shifti_Import')) {
    $plugin_shifti = new Shifti_Import();

    // Register activation and deactivation hooks
    register_activation_hook(__FILE__, array($plugin_shifti, 'activate'));
    register_deactivation_hook(__FILE__, array($plugin_shifti, 'deactivate'));
}

?>