<?php
function get_shipping() {
    global $wpdb;
    $args = array(
        'limit' => -1, 
    );
    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $line_items_data = [];
    foreach ($orders as $order) {
        // Check if customer_id is not 0 or null
        $customer_id = method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null;
        if ($customer_id === 0 || $customer_id === null) {
            continue;
        }


        $order_id = $order->get_id();
        $line_items_data['order_id'] = $order_id;
        $line_items_data['first_name'] = method_exists($order, 'get_shipping_first_name') ? $order->get_shipping_first_name() : null;
        $line_items_data['last_name'] = method_exists($order, 'get_shipping_last_name') ? $order->get_shipping_last_name() : null;
        $line_items_data['company'] = method_exists($order, 'get_shipping_company') ? $order->get_shipping_company() : null;
        $line_items_data['address_1'] = method_exists($order, 'get_shipping_address_1') ? $order->get_shipping_address_1() : null;
        $line_items_data['address_2'] = method_exists($order, 'get_shipping_address_2') ? $order->get_shipping_address_2() : null;
        $line_items_data['city'] = method_exists($order, 'get_shipping_city') ? $order->get_shipping_city() : null;
        $line_items_data['state'] = method_exists($order, 'get_shipping_state') ? $order->get_shipping_state() : null;
        $line_items_data['postcode'] = method_exists($order, 'get_shipping_postcode') ? $order->get_shipping_postcode() : null;
        $line_items_data['country'] = method_exists($order, 'get_shipping_country') ? $order->get_shipping_country() : null;
        $line_items_data['phone'] = method_exists($order, 'get_shipping_phone') ? $order->get_shipping_phone() : null;
        }

        return json_encode($line_items_data);
    }
   


?>
