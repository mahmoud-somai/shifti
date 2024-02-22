<?php

function get_orders() {
    global $wpdb;

    $args = array(
        'limit' => 1, 
    );

    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $orders_data = [];

    foreach ($orders as $order) {
    
        echo "order =>". $order;
        echo '<br>';
        $order_id = $order->get_id();
        $order_parent_id=$order->get_parent_id(); 
        $order_status = $order->get_status();
        $order_currency = $order->get_currency();
        $version = $order->get_version();
        $prices_include_tax = $order->get_prices_include_tax();
        $date_created = $order->get_date_created();
        $date_modified = $order->get_date_modified();
        $discount_total = $order->get_discount_total();
        $discount_tax = $order->get_discount_tax();
        $shipping_total = $order->get_shipping_total();
        $shipping_tax = $order->get_shipping_tax();
        $cart_tax = $order->get_cart_tax();
        $total = $order->get_total();
        $total_tax = $order->get_total_tax();
        $customer_id = $order->get_customer_id();
        $order_key = $order->get_order_key();
        $billing = $order->get_billing();
        $shipping = $order->get_shipping();
        $created_via = $order->get_created_via();
        $customer_note = $order->get_customer_note();
        $date_completed = $order->get_date_completed();
        $date_paid = $order->get_date_paid() ;
        $order_stock_reduced = $order->get_order_stock_reduced();
        $download_permissions_granted = $order->get_download_permissions_granted();
        $new_order_email_sent = $order->get_new_order_email_sent();
        $recorded_sales = $order->get_recorded_sales();
        $recorded_coupon_usage_counts = $order->get_recorded_coupon_usage_counts();
        $number = $order->get_order_number();
        $meta_data = $order->get_meta_data();

 
        $orders_data[] = array(
            'id' => $order_id,
            'parent_id'=>$order_parent_id,
            'status' => $order_status,
            'version' => $version,
            'prices_include_tax' => $prices_include_tax,
            'date_created' => $date_created,
            'date_modified' => $date_modified,
            'discount_total' => $discount_total,
            'discount_tax' => $discount_tax,
            'shipping_total' => $shipping_total,
            'shipping_tax' => $shipping_tax,
            'cart_tax' => $cart_tax,
            'total' => $total,
            'total_tax' => $total_tax,
            'customer_id' => $customer_id,
            'order_key' => $order_key,
            'billing' => $billing,
            'shipping' => $shipping,
            'created_via' => $created_via,
            'customer_note' => $customer_note,
            'date_completed' => $date_completed,
            'date_paid' => $date_paid,
            'order_stock_reduced' => $order_stock_reduced,
            'download_permissions_granted' => $download_permissions_granted,
            'new_order_email_sent' => $new_order_email_sent,
            'recorded_sales' => $recorded_sales,
            'recorded_coupon_usage_counts' => $recorded_coupon_usage_counts,
            'number' => $number,
            'meta_data' => $meta_data,
        );
    }

    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';

}


?>
