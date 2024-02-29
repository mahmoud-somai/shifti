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

        // Retrieve order properties with null coalescing operator
        $order_data['id'] = $order->get_id() ?? null;
        $order_data['parent_id'] = $order->get_parent_id() ?? null; 
        
        $order_data['order_key'] = method_exists($order, 'get_order_key') ? $order->get_order_key() : null;
        $order_data['created_via'] = method_exists($order, 'get_created_via') ? $order->get_created_via() : null;
        $order_data['order_version'] = method_exists($order, 'get_version') ? $order->get_version() : null;
        $order_data['status'] = method_exists($order, 'get_status') ? $order->get_status() : null;
        $order_data['currency'] = method_exists($order, 'get_currency') ? $order->get_currency() : null;
        $order_data['date_created'] = method_exists($order, 'get_date_created') ? ($order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u') : null) : null;
        $order_data['date_modified'] = method_exists($order, 'get_date_modified') ? ($order->get_date_modified() ? $order->get_date_modified()->format('Y-m-d H:i:s.u') : null) : null;
        $order_data['discount_total'] = method_exists($order, 'get_discount_total') ? $order->get_discount_total() : null;
        $order_data['discount_tax'] = method_exists($order, 'get_discount_tax') ? $order->get_discount_tax() : null;
        $order_data['shipping_total'] = method_exists($order, 'get_shipping_total') ? $order->get_shipping_total() : null;
        $order_data['shipping_tax'] = method_exists($order, 'get_shipping_tax') ? $order->get_shipping_tax() : null;
        $order_data['cart_tax'] = method_exists($order, 'get_cart_tax') ? $order->get_cart_tax() : null;
        $order_data['total'] = method_exists($order, 'get_total') ? $order->get_total() : null;
        $order_data['total_tax'] = method_exists($order, 'get_total_tax') ? $order->get_total_tax() : null;
        $order_data['prices_include_tax'] = method_exists($order, 'get_prices_include_tax') ? $order->get_prices_include_tax() : null;

        $order_data['customer_id'] = method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null;
        $order_data['customer_ip_address'] = method_exists($order, 'get_customer_ip_address') ? $order->get_customer_ip_address() : null;
        $order_data['customer_user_agent'] = method_exists($order, 'get_customer_user_agent') ? $order->get_customer_user_agent() : null;
        $order_data['customer_note'] = method_exists($order, 'get_customer_note') ? $order->get_customer_note() : null;

        $order_data['payment_method'] = method_exists($order, 'get_payment_method') ? $order->get_payment_method() : null;
        $order_data['payment_method_title'] = method_exists($order, 'get_payment_method_title') ? $order->get_payment_method_title() : null;
        $order_data['transaction_id'] = method_exists($order, 'get_transaction_id') ? $order->get_transaction_id() : null ;

        $order_data['date_completed'] = method_exists($order, 'get_date_completed') ? ($order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null) : null;
        $order_data['date_paid'] = method_exists($order, 'get_date_paid') ? ($order->get_date_paid() ? $order->get_date_paid()->format('Y-m-d H:i:s.u') : null) : null;
        
        
        $cart_hash = method_exists($order, 'get_cart_hash') ? $order->get_cart_hash() : null;
        $order_data['cart_hash'] = !empty($cart_hash) ? $cart_hash : null;

// -----------------------------------------------------  Billing Details  -----------------------------------------------------------


        $order_data['billing_first_name'] = method_exists($order, 'get_billing_first_name') ? $order->get_billing_first_name() : null;
        $order_data['billing_last_name'] = method_exists($order, 'get_billing_last_name') ? $order->get_billing_last_name() : null;
        $order_data['billing_company'] = method_exists($order, 'get_billing_company') ? $order->get_billing_company() : null;
        $order_data['billing_address_1'] = method_exists($order, 'get_billing_address_1') ? $order->get_billing_address_1() : null;
        $order_data['billing_address_2'] = method_exists($order, 'get_billing_address_2') ? $order->get_billing_address_2() : null;
        $order_data['billing_city'] = method_exists($order, 'get_billing_city') ? $order->get_billing_city() : null;
        $order_data['billing_state'] = method_exists($order, 'get_billing_state') ? $order->get_billing_state() : null;
        $order_data['billing_postcode'] = method_exists($order, 'get_billing_postcode') ? $order->get_billing_postcode() : null;
        $order_data['billing_country'] = method_exists($order, 'get_billing_country') ? $order->get_billing_country() : null;
        $order_data['billing_email'] = method_exists($order, 'get_billing_email') ? $order->get_billing_email() : null;
        $order_data['billing_phone'] = method_exists($order, 'get_billing_phone') ? $order->get_billing_phone() : null;


       
        // // Billing details
        // $order_data['billing_first_name'] = $order->get_billing_first_name() ?? null;
        // $order_data['billing_last_name'] = $order->get_billing_last_name() ?? null;
        // $order_data['billing_company'] = $order->get_billing_company() ?? null;
        // $order_data['billing_address_1'] = $order->get_billing_address_1() ?? null;
        // $order_data['billing_address_2'] = $order->get_billing_address_2() ?? null;
        // $order_data['billing_city'] = $order->get_billing_city() ?? null;
        // $order_data['billing_state'] = $order->get_billing_state() ?? null;
        // $order_data['billing_postcode'] = $order->get_billing_postcode() ?? null;
        // $order_data['billing_country'] = $order->get_billing_country() ?? null;
        // $order_data['billing_email'] = $order->get_billing_email() ?? null;
        // $order_data['billing_phone'] = $order->get_billing_phone() ?? null;

        // // Shipping details
        // $order_data['shipping_first_name'] = $order->get_shipping_first_name() ?? null;
        // $order_data['shipping_last_name'] = $order->get_shipping_last_name() ?? null;
        // $order_data['shipping_company'] = $order->get_shipping_company() ?? null;
        // $order_data['shipping_address_1'] = $order->get_shipping_address_1() ?? null;
        // $order_data['shipping_address_2'] = $order->get_shipping_address_2() ?? null;
        // $order_data['shipping_city'] = $order->get_shipping_city() ?? null;
        // $order_data['shipping_state'] = $order->get_shipping_state() ?? null;
        // $order_data['shipping_postcode'] = $order->get_shipping_postcode() ?? null;
        // $order_data['shipping_country'] = $order->get_shipping_country() ?? null;
        // $order_data['shipping_phone'] = $order->get_shipping_phone() ?? null;
        
        // $order_data['payment_method'] = $order->get_payment_method() ?? null;
        // $order_data['payment_method_title'] = $order->get_payment_method_title() ?? null;
        // $order_data['transaction_id'] = $order->get_transaction_id() ?? null;
        // $order_data['customer_ip_address'] = $order->get_customer_ip_address() ?? null;
        // $order_data['customer_user_agent'] = $order->get_customer_user_agent() ?? null;
    
        // $order_data['customer_note'] = $order->get_customer_note() ?? null;
        // $order_data['date_completed'] = $order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null;
        // $order_data['date_paid'] = $order->get_date_paid() ? $order->get_date_paid()->format('Y-m-d H:i:s.u') : null;
        // $order_data['cart_hash'] = $order->get_cart_hash() ?? null;
        // $order_data['order_stock_reduced'] = $order->get_order_stock_reduced() ?? null; 

        // Add order data to orders_data array
        $orders_data[] = $order_data;
    }
    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';
}
?>
