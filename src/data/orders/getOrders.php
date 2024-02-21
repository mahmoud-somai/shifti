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


    foreach ($orders as $order) {
        $order_id = $order->get_id();
        $new_order_object['order_id'] = $order_id;
        array_push($orders_data, $new_order_object);
        
    }

    // Output order IDs
    echo '<br>';
    echo $orders_data;
    echo '<br>';
}

// Call the function to get orders


?>
