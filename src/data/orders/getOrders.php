

<?php
/*


function get_orders() {
    global $wpdb;

    $args = array(
        'limit' => 1, 
    );

    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $orders_data = [];

    foreach ($orders as $order) {

        $items = $order->get_items();
        $product_items = [];
        foreach ($items as $item) {
            echo "items ==> <br>" .$item;
            echo"<br>";
            $product_name    = $item->get_name();
            $product_id      = $item->get_product_id();
            $variation_id    = $item->get_variation_id();
      
            $quantity        = $item->get_quantity();
            $tax_class       = $item->get_tax_class();
            $subtotal        = $item->get_subtotal();
            $tax_subtotal    = $item->get_subtotal_tax();
            $total           = $item->get_total();
            //$product         = $item->get_product(); // Product object gives you access to all product data
            $tax_status      = $item->get_tax_status();
           // $all_meta_data   = $item->get_meta_data();
          //  $product_type    = $item->get_type();
        }
        $product_items[] = array(
            'product_name' => $product_name,
            'product_id' => $product_id,
            'variation_id' => $variation_id,
            'quantity' => $quantity,
            'tax_class' => $tax_class,
            'subtotal' => $subtotal,
            'tax_subtotal' => $tax_subtotal,
            'total' => $total,   
            'tax status' => $tax_status,        
        );

        echo "order =>". $order;
        echo '<br>';
        $order_id = $order->get_id();
        $order_parent_id=$order->get_parent_id(); 
        $order_status = $order->get_status();
        $order_currency = $order->get_currency();
        $version = $order->get_version();
        $prices_include_tax = $order->get_prices_include_tax();
        $date_created = $order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u'): null;
        $date_modified = $order->get_date_modified() ? $order->get_date_modified()->format('Y-m-d H:i:s.u'): null;
        $discount_total = $order->get_discount_total();
        $discount_tax = $order->get_discount_tax();
        $shipping_total = $order->get_shipping_total();
        $shipping_tax = $order->get_shipping_tax();
        $cart_tax = $order->get_cart_tax();
        $total = $order->get_total();
        $total_tax = $order->get_total_tax();
        $customer_id = $order->get_customer_id();
        $order_key = $order->get_order_key();

        
        //billing details
        $billing_first_name = $order->get_billing_first_name();
        $billing_last_name = $order->get_billing_last_name();
        $billing_company = $order->get_billing_company();
        $billing_address_1 = $order->get_billing_address_1();
        $billing_address_2 = $order->get_billing_address_2();
        $billing_city = $order->get_billing_city();
        $billing_state = $order->get_billing_state();
        $billing_postcode = $order->get_billing_postcode();
        $billing_country = $order->get_billing_country();
        $billing_email = $order->get_billing_email();
        $billing_phone = $order->get_billing_phone();


            // Shipping details
        $shipping_first_name = $order->get_shipping_first_name();
        $shipping_last_name = $order->get_shipping_last_name();
        $shipping_company = $order->get_shipping_company();
        $shipping_address_1 = $order->get_shipping_address_1();
        $shipping_address_2 = $order->get_shipping_address_2();
        $shipping_city = $order->get_shipping_city();
        $shipping_state = $order->get_shipping_state();
        $shipping_postcode = $order->get_shipping_postcode();
        $shipping_country = $order->get_shipping_country();
        $shipping_phone = $order->get_shipping_phone();

        $payment_method = $order->get_payment_method();
        $payment_method_title = $order->get_payment_method_title();
        $transaction_id = $order->get_transaction_id();

        $customer_ip_address = $order->get_customer_ip_address();
        $customer_user_agent = $order->get_customer_user_agent();
        $created_via = $order->get_created_via();
        $customer_note = $order->get_customer_note();

        $date_completed = $order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null;
        $date_paid = $order->get_date_paid() ? $order->get_date_paid()->format('Y-m-d H:i:s.u') : null;


        $cart_hash = $order->get_cart_hash();
        $order_stock_reduced = $order->get_order_stock_reduced();
       // $download_permissions_granted = $order->get_download_permissions_granted();
       // $new_order_email_sent = $order->get_new_order_email_sent();
       // $recorded_sales = $order->get_recorded_sales();
      //  $recorded_coupon_usage_counts = $order->get_recorded_coupon_usage_counts();
       // $order_number = $order->get_order_number();
        //$meta_data=$order->get_meta_data();
        
 
    


 
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


            'billing_first_name' => $billing_first_name,
            'billing_last_name' => $billing_last_name,
            'billing_company' => $billing_company,
            'billing_address_1' => $billing_address_1,
            'billing_address_2' => $billing_address_2,
            'billing_city' => $billing_city,
            'billing_state' => $billing_state,
            'billing_postcode' => $billing_postcode,
            'billing_country' => $billing_country,
            'billing_email' => $billing_email,
            'billing_phone' => $billing_phone,


            'shipping_first_name' => $shipping_first_name,
            'shipping_last_name' => $shipping_last_name,
            'shipping_company' => $shipping_company,
            'shipping_address_1' => $shipping_address_1,
            'shipping_address_2' => $shipping_address_2,
            'shipping_city' => $shipping_city,
            'shipping_state' => $shipping_state,
            'shipping_postcode' => $shipping_postcode,
            'shipping_country' => $shipping_country,
            'shipping_phone' => $shipping_phone,


            'payment_method' => $payment_method,
            'payment_method_title' => $payment_method_title,
            'transaction_id' => $transaction_id,
            'customer_ip_address' => $customer_ip_address,
            'customer_user_agent' => $customer_user_agent,
            'created_via' => $created_via,
            'customer_note' => $customer_note,
            'date_completed' => $date_completed,
            'date_paid' => $date_paid,
            'cart_hash' => $cart_hash,
            'order_stock_reduced' => $order_stock_reduced,
          //  'download_permissions_granted' => $download_permissions_granted,
           // 'new_order_email_sent' => $new_order_email_sent,
           /// 'recorded_sales' => $recorded_sales,
            //'recorded_coupon_usage_counts' => $recorded_coupon_usage_counts,
            //'order_number' => $order_number,
           //'all_meta_data' => $meta_data

           'product_items' => $product_items,
          


            
            
        );
    }

    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';

}


*/ 

function get_orders() {
    global $wpdb;

    // Define the specific order IDs you want to retrieve
    $specific_order_ids = array(28);

    $args = array(
        'post__in' => $specific_order_ids, // Include only the orders with the specified IDs
    );

    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();

   
    $orders_data = [];

    foreach ($orders as $order) {
        echo '<br>';
        echo 'order ==> <br>';
        echo json_encode($order->get_data());
        echo '<br>';
        $items = $order->get_items();
        $product_items = [];
        foreach ($items as $item) {
            $product_name    = $item->get_name();
            $product_id      = $item->get_product_id();
            $variation_id    = $item->get_variation_id();
            $quantity        = $item->get_quantity();
            $tax_class       = $item->get_tax_class();
            $subtotal        = $item->get_subtotal();
            $tax_subtotal    = $item->get_subtotal_tax();
            $total           = $item->get_total();
            $tax_status      = $item->get_tax_status();
        }
        $product_items[] = array(
            'product_name' => $product_name,
            'product_id' => $product_id,
            'variation_id' => $variation_id,
            'quantity' => $quantity,
            'tax_class' => $tax_class,
            'subtotal' => $subtotal,
            'tax_subtotal' => $tax_subtotal,
            'total' => $total,   
            'tax status' => $tax_status,        
        );

        $order_id = $order->get_id();
        $order_parent_id = $order->get_parent_id(); 
        $order_status = $order->get_status();
        $order_currency = $order->get_currency();
        $version = $order->get_version();
        $prices_include_tax = $order->get_prices_include_tax();
        $date_created = $order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u'): null;
        $date_modified = $order->get_date_modified() ? $order->get_date_modified()->format('Y-m-d H:i:s.u'): null;
        $discount_total = $order->get_discount_total();
        $discount_tax = $order->get_discount_tax();
        $shipping_total = $order->get_shipping_total();
        $shipping_tax = $order->get_shipping_tax();
        $cart_tax = $order->get_cart_tax();
        $total = $order->get_total();
        $total_tax = $order->get_total_tax();
        $customer_id = $order->get_customer_id();
        $order_key = $order->get_order_key();

        $billing_first_name = $order->get_billing_first_name();
        $billing_last_name = $order->get_billing_last_name();
        $billing_company = $order->get_billing_company();
        $billing_address_1 = $order->get_billing_address_1();
        $billing_address_2 = $order->get_billing_address_2();
        $billing_city = $order->get_billing_city();
        $billing_state = $order->get_billing_state();
        $billing_postcode = $order->get_billing_postcode();
        $billing_country = $order->get_billing_country();
        $billing_email = $order->get_billing_email();
        $billing_phone = $order->get_billing_phone();

        $shipping_first_name = $order->get_shipping_first_name();
        $shipping_last_name = $order->get_shipping_last_name();
        $shipping_company = $order->get_shipping_company();
        $shipping_address_1 = $order->get_shipping_address_1();
        $shipping_address_2 = $order->get_shipping_address_2();
        $shipping_city = $order->get_shipping_city();
        $shipping_state = $order->get_shipping_state();
        $shipping_postcode = $order->get_shipping_postcode();
        $shipping_country = $order->get_shipping_country();
        $shipping_phone = $order->get_shipping_phone();

        $payment_method = $order->get_payment_method();
        $payment_method_title = $order->get_payment_method_title();
        $transaction_id = $order->get_transaction_id();
        $customer_ip_address = $order->get_customer_ip_address();
        $customer_user_agent = $order->get_customer_user_agent();
        $created_via = $order->get_created_via();
        $customer_note = $order->get_customer_note();
        $date_completed = $order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null;
        $date_paid = $order->get_date_paid() ? $order->get_date_paid()->format('Y-m-d H:i:s.u') : null;
        $cart_hash = $order->get_cart_hash();
        $order_stock_reduced = $order->get_order_stock_reduced();

        $orders_data[] = array(
            'id' => $order_id,
            'parent_id' => $order_parent_id,
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
            'billing_first_name' => $billing_first_name,
            'billing_last_name' => $billing_last_name,
            'billing_company' => $billing_company,
            'billing_address_1' => $billing_address_1,
            'billing_address_2' => $billing_address_2,
            'billing_city' => $billing_city,
            'billing_state' => $billing_state,
            'billing_postcode' => $billing_postcode,
            'billing_country' => $billing_country,
            'billing_email' => $billing_email,
            'billing_phone' => $billing_phone,
            'shipping_first_name' => $shipping_first_name,
            'shipping_last_name' => $shipping_last_name,
            'shipping_company' => $shipping_company,
            'shipping_address_1' => $shipping_address_1,
            'shipping_address_2' => $shipping_address_2,
            'shipping_city' => $shipping_city,
            'shipping_state' => $shipping_state,
            'shipping_postcode' => $shipping_postcode,
            'shipping_country' => $shipping_country,
            'shipping_phone' => $shipping_phone,
            'payment_method' => $payment_method,
            'payment_method_title' => $payment_method_title,
            'transaction_id' => $transaction_id,
            'customer_ip_address' => $customer_ip_address,
            'customer_user_agent' => $customer_user_agent,
            'created_via' => $created_via,
            'customer_note' => $customer_note,
            'date_completed' => $date_completed,
            'date_paid' => $date_paid,
            'cart_hash' => $cart_hash,
            'order_stock_reduced' => $order_stock_reduced,
            'product_items' => $product_items,
        );
    }

    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';
}

?>
