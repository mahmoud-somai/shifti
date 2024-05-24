<?php

function get_odr() {
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
        $order_data['foreign_id'] = $order->get_id() ?? null;
        $order_data['reference'] = $order->get_id() ?? null;

        $order_data['woo_status'] = method_exists($order, 'get_status') ? $order->get_status() : null;
        $order_data['woo_currency'] = method_exists($order, 'get_currency') ? $order->get_currency() : null;
        $order_data['invoice_date'] = method_exists($order, 'get_date_created') ? ($order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u') : null) : null;
        $order_data['total_discounts'] = method_exists($order, 'get_discount_total') ? $order->get_discount_total() : null;
        $order_data['total_shipping'] = method_exists($order, 'get_shipping_total') ? $order->get_shipping_total() : null;
        $order_data['total_paid'] = method_exists($order, 'get_total') ? $order->get_total() : null;
        $order_data['total_paid_real'] = method_exists($order, 'get_total') ? $order->get_total() : null;
        $order_data['customer_id'] = method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null;
        $order_data['payment'] = method_exists($order, 'get_payment_method_title') ? $order->get_payment_method_title() : null;
        $order_data['note'] = method_exists($order, 'get_customer_note') ? $order->get_customer_note() : null;
        $order_data['delivery_date'] = method_exists($order, 'get_date_completed') ? ($order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null) : null;

        // Check if the order object has a method 'get_items' and retrieve the items
        if (method_exists($order, 'get_items')) {
            $items = $order->get_items();
        } else {
            $items = [];
        }
        
        // Count the number of items
        $order_data['total_products'] = count($items);

        $orders_data[] = $order_data;
    }

    return json_encode($orders_data);
}
?>
