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

   
    echo $orders;
   
    echo sizeof($orders);
    $orders_data =array();

    foreach ($orders as $result) {
        // You can access all columns directly from $result object
        // For example: $result->ID, $result->post_status, $result->post_date, etc.

        // Add additional fields as needed

        // Construct order data array
        $order_data = array(
            'order_id' => $result->ID,
            'status' => $result->post_status,
            'created_at' => $result->post_date,
            'modified_at' => $result->post_modified,
            // Add more fields here
        );

        // Push order data to orders array
        array_push($orders_data, $order_data);
    }
  




    // Encode orders data as JSON and output$
    echo "hello world";

    
    echo json_encode($orders_data);
    echo '<script src="' . plugins_url('shifti-import/src/scripts/index.js') . '"></script>';
}




?>













 