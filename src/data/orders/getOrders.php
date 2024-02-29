

<?php


function get_orders() {
    global $wpdb;
    args = array(
        'limit' => 1, // -1 retrieves all orders
    );

    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();

$data=[];
    foreach ( $orders->get_items() as $item_id => $item ) {
        echo json_encode($item) ;
        echo '<br>';
        array_push($data, $item);
    }
  
echo json_encode($data);
   
}


?>