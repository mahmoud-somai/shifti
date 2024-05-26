<?php
function get_ord_txs() {
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
        $tax_items = $order->get_items('tax');
        foreach ($tax_items as $item_id => $item) {
            $tax_item_id = method_exists($item,'get_id')? $item->get_id() :null;
            $tax_item_rate_id = method_exists($item,'get_rate_id')? $item->get_rate_id() :null;
           

           
            $line_item = array(
                'order_id' => $order_id,
               // 'foreign_id' => $tax_item_id,
                'tax_id' => $tax_item_rate_id,
            );
            $line_items_data[] = $line_item;
        }


    }
    return json_encode($line_items_data);
}

?>
