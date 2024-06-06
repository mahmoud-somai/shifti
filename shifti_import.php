<?php
/*
 * Plugin Name:       Shifti sOLUTIONS 
 * Description:       This is a plugin to Export woocommerce data from your shop.
 * Version:           1.0.0
 * Author:            SHIFTI SOLUTIONS
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
// require_once plugin_dir_path(__FILE__) . 'src/data/orders/getOrders.php';
require_once plugin_dir_path(__FILE__) . 'src/data/categories/getCategory.php';
require_once plugin_dir_path(__FILE__) . 'src/data/customers/getCustomer.php';
require_once plugin_dir_path(__FILE__) . 'src/data/workers/getWorkers.php';
require_once plugin_dir_path(__FILE__) . 'src/data/notes/getOrderNotes.php';
require_once plugin_dir_path(__FILE__) . 'src/data/taxes/getTaxes.php';
require_once plugin_dir_path(__FILE__) . 'src/data/prod/getProduct.php';
require_once plugin_dir_path(__FILE__) . 'src/data/orders/getOrder.php';

require_once plugin_dir_path(__FILE__) . 'src/data/addresses/getAddresses.php';
require_once plugin_dir_path(__FILE__) . 'src/data/orders/getOrderDetails.php';
require_once plugin_dir_path(__FILE__) . 'src/data/orders/getOrderFees.php';
require_once plugin_dir_path(__FILE__) . 'src/data/orders/getOrderCarriers.php';
require_once plugin_dir_path(__FILE__) . 'src/data/orders/getOrderTaxes.php';
require_once plugin_dir_path(__FILE__) . 'src/data/shipping/getShipping.php';
require_once plugin_dir_path(__FILE__) . 'src/data/billing/getBilling.php';
require_once plugin_dir_path(__FILE__) . 'src/data/missingdata/complete.php';
require_once plugin_dir_path(__FILE__) . 'src/data/orders/getOrderCarriersTaxes.php';
require_once plugin_dir_path(__FILE__) . 'src/data/orders/getOrdersDetailsTaxes.php';

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

add_action('wp_ajax_get_category_data', 'get_category_data');
function get_category_data() {
    $json_data = get_ctg_one();  // Assuming get_ctg_one() returns the desired category data in JSON format

    wp_send_json_success($json_data);
}

add_action('wp_ajax_download_orders_json', 'download_orders_json');
function download_orders_json() {

    $json_data = get_orders();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="orders.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_get_orders_data', 'get_orders_data');
function get_orders_data() {
    $json_data = get_orders();  

    wp_send_json_success($json_data);
}



add_action('wp_ajax_download_orders_details_json', 'download_orders_details_json');
function download_orders_details_json() {

    $json_data = get_ord_det();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="order_details.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_get_orders_det_data', 'get_orders_det_data');
function get_orders_det_data() {
    $json_data = get_ord_det();  // Function to get the order details data

    wp_send_json_success($json_data);
}

add_action('wp_ajax_download_orders_fees_json', 'download_orders_fees_json');
function download_orders_fees_json() {

    $json_data = get_odr_fee();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="order_fees.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_get_orders_fees_data', 'get_orders_fees_data');
function get_orders_fees_data() {
    $json_data = get_odr_fee();  

    wp_send_json_success($json_data);
}

add_action('wp_ajax_download_orders_carriers_json', 'download_orders_carriers_json');
function download_orders_carriers_json() {

    $json_data = get_ord_car();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="order_carriers.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_get_orders_carriers_data', 'get_orders_carriers_data');
function get_orders_carriers_data() {
    $json_data = get_ord_car();  

    wp_send_json_success($json_data);
}


add_action('wp_ajax_download_orders_taxes_json', 'download_orders_taxes_json');
function download_orders_taxes_json() {

    $json_data = get_ord_txs();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="order_taxes.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_get_orders_taxes_data', 'get_orders_taxes_data');
function get_orders_taxes_data() {
    $json_data = get_ord_txs();  

    wp_send_json_success($json_data);
}


add_action('wp_ajax_download_shipping_json', 'download_shipping_json');
function download_shipping_json() {

    $json_data = get_shipping();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="Shipping.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_get_shipping_data', 'get_shipping_data');
function get_shipping_data() {
    $json_data = get_shipping();  

    wp_send_json_success($json_data);
}

add_action('wp_ajax_download_billing_json', 'download_billing_json');
function download_billing_json() {

    $json_data = get_billing();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="Billing.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_get_billing_data', 'get_billing_data');
function get_billing_data() {
    $json_data = get_billing();  

    wp_send_json_success($json_data);
}


add_action('wp_ajax_download_customers_json', 'download_customers_json');
function download_customers_json() {

    $json_data = get_customers();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="cutomers.json"');

    echo $json_data;
    exit();
}
add_action('wp_ajax_get_customers_data', 'get_customers_data');
function get_customers_data() {
    $json_data = get_customers_with_billing();  // Assuming get_ctg_one() returns the desired category data in JSON format

    wp_send_json_success($json_data);
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

add_action('wp_ajax_get_tax_data', 'get_tax_data');
function get_tax_data() {
    $json_data = get_txs();  // Assuming get_ctg_one() returns the desired category data in JSON format

    wp_send_json_success($json_data);
}


add_action('wp_ajax_download_products_json', 'download_products_json');
function download_products_json() {

    $json_data = get_prods();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="products.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_get_prods_data', 'get_prods_data');
function get_prods_data() {
    $json_data = get_prods();  

    wp_send_json_success($json_data);
}

add_action('wp_ajax_download_workers_json', 'download_workers_json');
function download_workers_json() {

    $json_data = get_workers();

    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="Workers.json"');

    echo $json_data;
    exit();
}

add_action('wp_ajax_get_order_carrier_taxes_data', 'get_order_carrier_taxes_data');
function get_order_carrier_taxes_data() {
    $json_data = get_ord_car_tx();  

    wp_send_json_success($json_data);
}

add_action('wp_ajax_get_order_details_taxes_data', 'get_order_details_taxes_data');
function get_order_details_taxes_data() {
    $json_data = get_ord_det_tx();  

    wp_send_json_success($json_data);
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


function store_shop_data() {
    if (isset($_POST['shop_id']) && isset($_POST['tenant_id'])) {
        $shop_id = sanitize_text_field($_POST['shop_id']);
        $tenant_id = sanitize_text_field($_POST['tenant_id']);
        
        update_option('shifti_shop_id', $shop_id);
        update_option('shifti_tenant_id', $tenant_id);
        
        wp_send_json_success('Data stored successfully');
    } else {
        wp_send_json_error('Missing data');
    }
}
add_action('wp_ajax_store_shop_data', 'store_shop_data');


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


// add_action('wp_ajax_some_data_json', 'download_some_data_json');
// function download_some_data_json() {

//     $json_data = get_some();

//     header('Content-Type: application/json');
//     header('Content-Disposition: attachment; filename="some.json"');

//     echo $json_data;
//     exit();
// }


function page_render_callback() {
    header_html();
   //  get_products();
     get_orders();
    get_ctg_one();
    get_customers();
    get_orders_notes();
    get_txs();
    //get_prod();
    get_workers();
    get_customers_with_billing();
    get_prods();
    get_ord_det();
    get_odr_fee();
    get_ord_car();
    get_ord_txs();
    get_shipping();
    get_billing();


    get_some();

   
    get_ord_car_tx();
    get_ord_det_tx();

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