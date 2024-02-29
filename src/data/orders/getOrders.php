

<?php


function get_orders() {
    global $wpdb;
    args = array(
        'limit' => -1, // -1 retrieves all orders
    );

    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();

    return $orders;
   
}


?>