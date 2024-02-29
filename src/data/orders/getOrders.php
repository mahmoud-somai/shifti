

<?php


function get_orders() {
    global $wpdb;
    $args = array(
        'limit' => -1, 
    );
    // $specific_order_ids = array(24); //50771


    // $args = array(
    //     'post__in' => $specific_order_ids, // Include only the orders with the specified IDs
    // );
    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
  
    $orders_data = [];
    foreach ($orders as $order) {

        // Order properties
        $order_id = $order->get_id();
        $order_parent_id = $order->get_parent_id() !== false ? $order->get_parent_id() : null;
        $order_number = $order->get_order_number() ?: null;
        $order_key = $order->get_order_key() ?: null;
        $created_via = $order->get_created_via() ?: null;
        $version = $order->get_version() ?: null;
        $order_status = $order->get_status() ?: null;
        $order_currency = $order->get_currency() ?: null;
        $date_created = $order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u') : null;
        $date_modified = $order->get_date_modified() ? $order->get_date_modified()->format('Y-m-d H:i:s.u') : null;
        $discount_total = $order->get_discount_total() !== false ? $order->get_discount_total() : null;
        $discount_tax = $order->get_discount_tax() !== false ? $order->get_discount_tax() : null;
        $shipping_total = $order->get_shipping_total() !== false ? $order->get_shipping_total() : null;
        $shipping_tax = $order->get_shipping_tax() !== false ? $order->get_shipping_tax() : null;
        $cart_tax = $order->get_cart_tax() !== false ? $order->get_cart_tax() : null;
        $total = $order->get_total() !== false ? $order->get_total() : null;
        $total_tax = $order->get_total_tax() !== false ? $order->get_total_tax() : null;
        $prices_include_tax = $order->get_prices_include_tax() !== false ? $order->get_prices_include_tax() : null;
        $customer_id = $order->get_customer_id() !== false ? $order->get_customer_id() : null;
        $customer_ip_address = $order->get_customer_ip_address() ?: null;
        $customer_user_agent = $order->get_customer_user_agent() ?: null;
        $customer_note = $order->get_customer_note() ?: null;
        // Billing and shipping
        $payment_method = $order->get_payment_method() ?: null;
        $payment_method_title = $order->get_payment_method_title() ?: null;
        $transaction_id = $order->get_transaction_id() ?: null;
        $date_paid = $order->get_date_paid() ? $order->get_date_paid()->format('Y-m-d H:i:s.u') : null;
        $date_completed = $order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null;
        $cart_hash = $order->get_cart_hash() ?: null;
    
        // Billing properties
        $billing_first_name = $order->get_billing_first_name() ?: null;
        $billing_last_name = $order->get_billing_last_name() ?: null;
        $billing_company = $order->get_billing_company() ?: null;
        $billing_address_1 = $order->get_billing_address_1() ?: null;
        $billing_address_2 = $order->get_billing_address_2() ?: null;
        $billing_city = $order->get_billing_city() ?: null;
        $billing_state = $order->get_billing_state() ?: null;
        $billing_postcode = $order->get_billing_postcode() ?: null;
        $billing_country = $order->get_billing_country() ?: null;
        $billing_email = $order->get_billing_email() ?: null;
        $billing_phone = $order->get_billing_phone() ?: null;
        // Shipping properties
        $shipping_first_name = $order->get_shipping_first_name() ?: null;
        $shipping_last_name = $order->get_shipping_last_name() ?: null;
        $shipping_company = $order->get_shipping_company() ?: null;
        $shipping_address_1 = $order->get_shipping_address_1() ?: null;
        $shipping_address_2 = $order->get_shipping_address_2() ?: null;
        $shipping_city = $order->get_shipping_city() ?: null;
        $shipping_state = $order->get_shipping_state() ?: null;
        $shipping_postcode = $order->get_shipping_postcode() ?: null;
        $shipping_country = $order->get_shipping_country() ?: null;
        $shipping_phone = $order->get_shipping_phone() ?: null; // Assign null if empty
        
        $order_stock_reduced = $order->get_order_stock_reduced() ?: null;

    
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
            'currency' => $order_currency,
            'order_number' => $order_number,
          
        );
        
    }
    
    // Output orders data
    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';
    echo sizeof($orders_data);
    echo '<br>';
}


?>