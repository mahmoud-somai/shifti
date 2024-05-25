<?php
function get_odr_fee() {
    global $wpdb;
    $args = array(
        'limit' => -1, 
    );
    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $order_fees_data = [];
    foreach ($orders as $order) {
        // Check if customer_id is not 0 or null
        $customer_id = method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null;
        if ($customer_id === 0 || $customer_id === null) {
            continue;
        }
        
        $order_id = $order->get_id();
        $fees = $order->get_fees();
        foreach ($fees as $fee_id => $fee) {
            $fee_name       = $fee->get_name();
            $fee_tax_class  = $fee->get_tax_class();
            $fee_total      = $fee->get_total();
            $fee_total_tax  = $fee->get_total_tax();

            $order_fees = array(
                'order_id' => $order_id,
                'fee_name'       => $fee_name,
                'fee_tax_class'  => $fee_tax_class,
                'total'      => $fee_total,
                'total_tax'  => $fee_total_tax,
            );
            $order_fees_data[]=$order_fees;
        }

       
    }
    return json_encode($order_fees_data);
}
?>
