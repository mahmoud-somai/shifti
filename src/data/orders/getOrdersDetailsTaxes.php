<?php
// function get_ord_det_tx() {
//     global $wpdb;

//     $args = array(
//         'limit' => -1, 
//     );
//     $orders_query = new WC_Order_Query($args);
//     $orders = $orders_query->get_orders();
//     $line_items_data = [];
//     foreach ($orders as $order) {
//         // Check if customer_id is not 0 or null
//         $customer_id = method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null;
//         if ($customer_id === 0 || $customer_id === null) {
//             continue;
//         }
        
//         $order_id = $order->get_id();
//         $items = $order->get_items();
//         foreach ($items as $item) {
//             $id = method_exists($item, 'get_id') ? $item->get_id() : null;
//             $tax_class      = method_exists($item, 'get_tax_class') ? $item->get_tax_class() : null;
//             $total_tax      = method_exists($item, 'get_total_tax') ? $item->get_total_tax() : null;
//             $tax_subtotal   = method_exists($item, 'get_subtotal_tax') ? $item->get_subtotal_tax() : null;
           
            
//             $line_item = array(
               
//                 'order_detail_id' => $id,
//                 'tax_class' => $tax_class,
//                 'total' => floatval($total_tax),
//                 'subtotal' =>floatval($tax_subtotal),
              
                
//             );
//             $line_items_data[] = $line_item;
//         }
//     }
//     echo json_encode($line_items_data);
//     return json_encode($line_items_data);
// }
function get_ord_det_tx() {
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
            $tax_class = method_exists($item, 'get_tax_class') ? $item->get_tax_class() : null;
            $total_tax = method_exists($item, 'get_total_tax') ? $item->get_total_tax() : null;
            $tax_subtotal = method_exists($item, 'get_subtotal_tax') ? $item->get_subtotal_tax() : null;

            // Get the first tax ID
            $tax_id = null;
            $taxes = $item->get_taxes();
            if (isset($taxes['total'])) {
                foreach ($taxes['total'] as $id => $tax_total) {
                    $tax_id = $id;
                    break; // Take the first tax ID found
                }
            }
            
            $line_item = array(
                'order_detail_id' => $id,
                'tax_class' =>(int) $tax_class,
                'total' => floatval($total_tax),
                'subtotal' => floatval($tax_subtotal),
                'tax_id' => $tax_id,
            );
            $line_items_data[] = $line_item;
        }
    }
    echo json_encode($line_items_data);
    return json_encode($line_items_data);
}



?>



