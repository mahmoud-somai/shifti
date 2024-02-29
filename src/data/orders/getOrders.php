<?php
function get_orders() {
    global $wpdb;
    $args = array(
        'limit' => -1, 
    );
    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $orders_data = [];
    foreach ($orders as $order) {

        // Initialize an array to store order data
        $order_data = [];

        // Retrieve order properties
        $order_data['id'] = $order->get_id();
        $order_data['parent_id'] = $order->get_parent_id(); 
        $order_data['status'] = $order->get_status();
        $order_data['version'] = $order->get_version();
        $order_data['prices_include_tax'] = $order->get_prices_include_tax();
        $order_data['date_created'] = $order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u'): null;
        $order_data['date_modified'] = $order->get_date_modified() ? $order->get_date_modified()->format('Y-m-d H:i:s.u'): null;
        $order_data['discount_total'] = $order->get_discount_total();
        $order_data['discount_tax'] = $order->get_discount_tax();
        $order_data['shipping_total'] = $order->get_shipping_total();
        $order_data['shipping_tax'] = $order->get_shipping_tax();
        $order_data['cart_tax'] = $order->get_cart_tax();
        $order_data['total'] = $order->get_total();
        $order_data['total_tax'] = $order->get_total_tax();
        $order_data['customer_id'] = $order->get_customer_id();
        $order_data['order_key'] = $order->get_order_key();
        
        // Billing details
        $order_data['billing_first_name'] = $order->get_billing_first_name();
        $order_data['billing_last_name'] = $order->get_billing_last_name();
        $order_data['billing_company'] = $order->get_billing_company();
        $order_data['billing_address_1'] = $order->get_billing_address_1();
        $order_data['billing_address_2'] = $order->get_billing_address_2();
        $order_data['billing_city'] = $order->get_billing_city();
        $order_data['billing_state'] = $order->get_billing_state();
        $order_data['billing_postcode'] = $order->get_billing_postcode();
        $order_data['billing_country'] = $order->get_billing_country();
        $order_data['billing_email'] = $order->get_billing_email();
        $order_data['billing_phone'] = $order->get_billing_phone();

        // Shipping details
        $order_data['shipping_first_name'] = $order->get_shipping_first_name();
        $order_data['shipping_last_name'] = $order->get_shipping_last_name();
        $order_data['shipping_company'] = $order->get_shipping_company();
        $order_data['shipping_address_1'] = $order->get_shipping_address_1();
        $order_data['shipping_address_2'] = $order->get_shipping_address_2();
        $order_data['shipping_city'] = $order->get_shipping_city();
        $order_data['shipping_state'] = $order->get_shipping_state();
        $order_data['shipping_postcode'] = $order->get_shipping_postcode();
        $order_data['shipping_country'] = $order->get_shipping_country();
        $order_data['shipping_phone'] = $order->get_shipping_phone();
        
        $order_data['payment_method'] = $order->get_payment_method();
        $order_data['payment_method_title'] = $order->get_payment_method_title();
        $order_data['transaction_id'] = $order->get_transaction_id();
        $order_data['customer_ip_address'] = $order->get_customer_ip_address();
        $order_data['customer_user_agent'] = $order->get_customer_user_agent();
        $order_data['created_via'] = $order->get_created_via();
        $order_data['customer_note'] = $order->get_customer_note();
        $order_data['date_completed'] = $order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null;
        $order_data['date_paid'] = $order->get_date_paid() ? $order->get_date_paid()->format('Y-m-d H:i:s.u') : null;
        $order_data['cart_hash'] = $order->get_cart_hash();
        $order_data['order_stock_reduced'] = $order->get_order_stock_reduced(); 

        // Add order data to orders_data array
        $orders_data[] = $order_data;
    }
    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';
}
?>
