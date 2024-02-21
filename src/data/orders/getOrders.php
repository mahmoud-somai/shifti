<?php
function get_orders() {
    global $wpdb;

    $query = "
      SELECT p.ID, p.post_type, p.post_title, p.post_content, p.post_excerpt, p.post_status
      FROM wp_posts p
      WHERE p.post_type = 'order'
    ";
    
    $results = $wpdb->get_results($query);
    
    $orders = [];

    foreach ($results as $result) {
        $order_id = $result->ID;
        $order = wc_get_order($order_id);

        $order_data = array(
            'order_id' => $order_id,
            'order_status' => $order->get_status(),
            // Add more order data as needed
        );

        $orders[] = $order_data;
        echo "<h2>orders</h2>".$orders;
     
    }

    echo json_encode($orders);
}

// Call the function to get orders
get_orders();
?>
