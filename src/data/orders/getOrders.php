<?php

function get_orders() {
    global $wpdb;

    $args = array(
        'limit' => 1, 
    );

    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $orders_data = [];

    foreach ($orders as $order) {
    
        echo "order =>". $order;
        echo '<br>';
        $order_id = $order->get_id();
        $order_parent_id=$order->get_parent_id(); 
        $order_status = $order->get_status();
 
        $orders_data[] = array(
            'id' => $order_id,
            'parent_id'=>$order_parent_id,
            'status' => $order_status
        );
    }

    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';

}


?>
