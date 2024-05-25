<?php
function get_ord_det() {
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
        $items = $order->get_items();
        foreach ($items as $item) {
            $id = method_exists($item, 'get_id') ? $item->get_id() : null;
            $product_name = method_exists($item, 'get_name') ? $item->get_name() : null;
            $product_id = method_exists($item, 'get_product_id') ? $item->get_product_id() : null;
            $quantity = method_exists($item, 'get_quantity') ? $item->get_quantity() : null;
            $subtotal = method_exists($item, 'get_subtotal') ? $item->get_subtotal() : null;
            $line_item = array(
                'order_id' => $order_id,
                'foreign_id' => $id,
                'product_name' => $product_name,
                'product_id' => $product_id,
                'product_quantity' => $quantity,
                'product_price' => $subtotal,
            );
            $line_items_data[] = $line_item;
        }
    }
    return json_encode($line_items_data);
}
?>
