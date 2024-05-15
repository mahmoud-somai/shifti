<?php


function get_addresses() {
    global $wpdb;
    $args = array(
        'limit' => -1, 
    );
    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $orders_data = [];
    foreach ($orders as $order) {


        $billing = [];
        $billing['foreign_id'] = method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null;

        $billing['first_name'] = method_exists($order, 'get_billing_first_name') ? $order->get_billing_first_name() : null;
        $billing['last_name'] = method_exists($order, 'get_billing_last_name') ? $order->get_billing_last_name() : null;
        $billing['company'] = method_exists($order, 'get_billing_company') ? $order->get_billing_company() : null;
        $billing['address_1'] = method_exists($order, 'get_billing_address_1') ? $order->get_billing_address_1() : null;
        $billing['address_2'] = method_exists($order, 'get_billing_address_2') ? $order->get_billing_address_2() : null;
        $billing['city'] = method_exists($order, 'get_billing_city') ? $order->get_billing_city() : null;
        $billing['woo_state'] = method_exists($order, 'get_billing_state') ? $order->get_billing_state() : null;
        $billing['postcode'] = method_exists($order, 'get_billing_postcode') ? $order->get_billing_postcode() : null;
        $billing['woo_country'] = method_exists($order, 'get_billing_country') ? $order->get_billing_country() : null;
        $billing['phone'] = method_exists($order, 'get_billing_phone') ? $order->get_billing_phone() : null;


        $orders_data[] = $billing;


    }
    return json_encode($orders_data);
}
?>
