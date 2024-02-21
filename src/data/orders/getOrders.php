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
    echo $results;

    $orders_data =array();


    // Encode orders data as JSON and output$
    echo "hello world";

    
    echo json_encode($orders_data);
    echo '<script src="' . plugins_url('shifti-import/src/scripts/index.js') . '"></script>';
}




?>













 