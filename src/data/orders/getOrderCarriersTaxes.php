<?php
function get_ord_car_tx() {
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
        $shipping_items = $order->get_items('shipping');
        $tax_items = $order->get_items('tax');

        // Store tax rates by item ID for easier lookup later
        $tax_rates = [];
        foreach ($tax_items as $item) {  
            $tax_item_rate_id = $item->get_rate_id();
            $tax_rates[] = $tax_item_rate_id; // Collect all tax rate IDs
        }

        // Iterate over shipping items
        foreach ($shipping_items as $item) {
            $id = method_exists($item, 'get_id') ? $item->get_id() : null;
            $total = method_exists($item, 'get_total_tax') ? $item->get_total_tax() : null;

            // Fetch the first tax_id from the collected tax rates
            $tax_id = !empty($tax_rates) ? reset($tax_rates) : null;

            $line_item = array(
                'foreign_id' => $id,
                'total' => floatval($total),
                'tax_id' => $tax_id
            );
            $line_items_data[] = $line_item;
        }
    }
    // echo json_encode($line_items_data);
    return json_encode($line_items_data);
}
?>
