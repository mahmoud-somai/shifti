

<?php


function get_orders() {
    global $wpdb;
    $orders = wc_get_orders( array( 'numberposts' => -1 ) );
    echo json_encode($orders);

    foreach ( $orders->get_items() as $item_id => $item ) {
        echo $item;
        echo '<br>';

}
}


?>