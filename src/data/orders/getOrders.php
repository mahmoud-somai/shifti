<?php

// Function to get orders
function get_orders() {
    global $wpdb;

    // SQL query to retrieve orders
    $query = "
        SELECT ID, post_status, post_date, post_modified
        FROM {$wpdb->posts}
        WHERE post_type = 'shop_order'
    ";

    $results = $wpdb->get_results($query);

    $orders_data = array();

    foreach ($results as $result) {
        $order_id = $result->ID;
        $order_status = $result->post_status;
        $created_at = $result->post_date;
        $modified_at = $result->post_modified;

        // Add additional fields as needed

        // Construct order data array
        $order_data = array(
            'order_id' => $order_id,
            'status' => $order_status,
            'created_at' => $created_at,
            'modified_at' => $modified_at,
            // Add more fields here
        );

        // Push order data to orders array
        $orders_data[] = $order_data;
    }

    // Encode orders data as JSON and output
    echo json_encode($orders_data);
    echo '<script src="' . plugins_url('shifti-import/src/scripts/index.js') . '"></script>';
}




?>













 