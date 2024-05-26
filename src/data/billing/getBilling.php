<?php
function get_billing() {
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
        foreach ($shipping_items as $item_id => $item) {
            $id = method_exists($item, 'get_id') ? $item->get_id() : null;
            $shipping_name = method_exists($item, 'get_method_title') ? $item->get_method_title() : null;
            $shipping_cost_tax_excl = method_exists($item, 'get_total') ? $item->get_total() : null;
            $shipping_cost_tax_incl =  method_exists($item, 'get_total_tax') ? $item->get_total_tax() : null;
            $line_item = array(
                'order_id' => $order_id,
                'foreign_id' => $id,
                'name' => $shipping_name,
                'shipping_cost_tax_excl' => floatval($shipping_cost_tax_excl),
                'shipping_cost_tax_incl' =>floatval($shipping_cost_tax_incl),
                'order_invoice' => null,
                "weight" => null,
                "tracking_number" => null,
                "date_added" => null,
                "carrier_id" => null,
                


            );
            $line_items_data[] = $line_item;
        }


    }
    return json_encode($line_items_data);

}
?>
