<?php

// Function to get orders
function get_orders() {
    global $wpdb;

    // SQL query to retrieve orders
    $query = "
        SELECT *
        FROM wp_posts p
        WHERE p.post_type = 'shop_order'
    ";

    $results = $wpdb->get_results($query);

    $orders_data =array();
    $array1 = array('a','b','c');
    foreach ($results as $result) {
      

     
        $order_data = array(
            'order_id' => $order_id,
            'status' => $order_status,
            // Add more fields here
        );

        // Push order data to orders array
        $orders_data[] = $order_data;
    }

    // Encode orders data as JSON and output$
    echo "hello world";
    echo $array1;
    
    echo json_encode($orders_data);
    echo '<script src="' . plugins_url('shifti-import/src/scripts/index.js') . '"></script>';
}




?>













 