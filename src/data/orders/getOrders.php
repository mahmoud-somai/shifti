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
echo $result;
        array_push($orders_data, $result);
    }
  




    // Encode orders data as JSON and output$
    echo "hello world";

    
    echo json_encode($orders_data);
    echo '<script src="' . plugins_url('shifti-import/src/scripts/index.js') . '"></script>';
}




?>













 