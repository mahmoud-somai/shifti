<?php

// Function to get orders
function get_orders() {
    global $wpdb;

    // SQL query to retrieve orders
    $args = array(
        'limit' => -1, // -1 retrieves all orders
    );

    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();

    echo "Number of Orders: " . sizeof($orders) . "<br>";
    echo '<br>';
    echo '<br>';

    $orders_data = [];
    echo "orders => ".$orders;
    echo '<br>';
    foreach ($orders as $order) {
        echo "order =>". $order;
        echo '<br>';
        $order_id = $order->get_id();
 
        $orders_data[] = array(
            'order_id' => $order_id
        );
    }

    // Output order IDs
    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';


    foreach ($orders_data as $order_data) {
        echo 'Order ID: ' . $order_data['order_id'] . '<br>';
    }
}


?>
