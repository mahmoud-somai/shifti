<?php
function get_billing() {
    global $wpdb;
    $args = array(
        'limit' => -1, 
    );
    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $all_orders_data = []; // Array to store shipping data for all orders

    foreach ($orders as $order) {
        // Check if customer_id is not 0 or null
        $customer_id = method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null;
        if ($customer_id === 0 || $customer_id === null) {
            continue;
        }

        $order_id = $order->get_id();
        $billing = [];
        $billing['order_id'] = $order_id;
        $billing['first_name'] = method_exists($order, 'get_billing_first_name') ? $order->get_billing_first_name() : null;
        $billing['last_name'] = method_exists($order, 'get_billing_last_name') ? $order->get_billing_last_name() : null;
        $billing['company'] = method_exists($order, 'get_billing_company') ? $order->get_billing_company() : null;
        $billing['address_1'] = method_exists($order, 'get_billing_address_1') ? $order->get_billing_address_1() : null;
        $billing['address_2'] = method_exists($order, 'get_billing_address_2') ? $order->get_billing_address_2() : null;
        $billing['city'] = method_exists($order, 'get_billing_city') ? $order->get_billing_city() : null;
        $billing['state'] = method_exists($order, 'get_billing_state') ? $order->get_billing_state() : null;
        $billing['postcode'] = method_exists($order, 'get_billing_postcode') ? $order->get_billing_postcode() : null;
        $billing['country'] = method_exists($order, 'get_billing_country') ? $order->get_billing_country() : null;
        $billing['email'] = method_exists($order, 'get_billing_email') ? $order->get_billing_email() : null;
        $billing['phone'] = method_exists($order, 'get_billing_phone') ? $order->get_billing_phone() : null;

        // Add the shipping data to the all_orders_data array
        $all_orders_data[] = $billing;
    }

    // Return the JSON-encoded array of all orders' shipping data
    return json_encode($all_orders_data);
}
?>
