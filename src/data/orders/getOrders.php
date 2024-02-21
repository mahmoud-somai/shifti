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

    $orders_data = array();

    foreach ($orders as $order) {
        $order_id = $order->get_id();
        $orders_data[] = $order_id;
    }

    // Output order IDs
    echo '<pre>';
    print_r($orders_data);
    echo '</pre>';
}

// Call the function to get orders
get_orders();

?>
