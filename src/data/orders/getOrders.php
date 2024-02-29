

<?php


function get_orders() {
    global $wpdb;
   $args = array(
       'limit' => -1, 
   );

  // $specific_order_ids = array(50771); //50771
  

   //$args = array(
    //   'post__in' => $specific_order_ids, 
   //);


    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $orders_data = [];

    foreach ($orders as $order) {



        //fee lines properties


        $order_fees = [];

        if ($order->get_fees()) {
            foreach ($order->get_fees() as $fee_id => $fee) {
                $fee_name = $fee->get_name();
                $fee_tax_class = $fee->get_tax_class();
                $fee_tax_status = $fee->get_tax_status();
                $fee_total = $fee->get_total();
                $fee_total_tax = $fee->get_total_tax();
        
               
                $order_fees[] = array(
                    'fee_name' => $fee_name,
                    'fee_tax_class' => $fee_tax_class,
                    'fee_tax_status' => $fee_tax_status,
                    'fee_total' => $fee_total,
                    'fee_total_tax' => $fee_total_tax,
                );
            }
        }
        
        // echo json_encode($order_fees);
        
       





        //coupon lines properties
        $coupons = $order->get_coupons();
        $order_coupons = [];
        
        if (!empty($coupons)) {
            foreach ($order->get_coupon_codes() as $coupon_code) {
                $coupon = new WC_Coupon($coupon_code);
        
                $discount_type = $coupon->get_discount_type();
                $coupon_amount = $coupon->get_amount();
                $coupon_id = $coupon->get_id();
                $coupon_code = $coupon->get_code();
        
                $order_coupons[] = [
                    'coupon_id' => $coupon_id,
                    'coupon_code' => $coupon_code,
                    'coupon_amount' => $coupon_amount,
                    'coupon_discount_type' => $discount_type,
                ];
            }
        } else {
            // Assign null values to attributes
            $order_coupons[] = [
                'coupon_id' => null,
                'coupon_code' => null,
                'coupon_amount' => null,
                'coupon_discount_type' => null,
            ];
        }
        
        
      //  echo '<br> coupon tab ===> <br>';
       // echo json_encode($order_coupons);




        // echo 'coupon ==> <br>';
        // echo json_encode($order->get_used_coupons());
        // echo '<br>';
        // echo json_encode($order->get_discount_total());
        // echo '<br>';
        // echo json_encode($order->get_discount_tax());
        // echo '<br>';
        // echo json_encode($order->get_discount_to_display());







    

      // refund properties

//     $refunds = $order->get_refunds();
//     $order_refunded = [];

// if (!empty($refunds)) {
//     foreach ($refunds as $refund) {
//         $order_refund_id = $refund->get_id();
//         $order_refund_reason = $refund->get_reason();
//         $order_refund_amount = $refund->get_amount();
//         $order_refund_date_created = $refund->get_date_created() ? $refund->get_date_created()->format('Y-m-d H:i:s.u') : null;
//         $order_refunded_by = $refund->get_refunded_by();
//         $order_parent_id = $refund->get_parent_id();

//         $refunded_payment = $refund->get_refunded_payment();

//         // Add refund details to the array
//         $order_refunded[] = [
//             'order_refund_id' => $order_refund_id,
//             'order_refund_reason' => $order_refund_reason,
//             'order_refund_amount' => $order_refund_amount,
//             'order_refund_date_created' => $order_refund_date_created,
//             'order_refunded_by' => $order_refunded_by,
//             'order_parent_id' => $order_parent_id,
//             'order_refunded_payment' => $refunded_payment,
//         ];
//     }
// } else {
//     // Initialize the array with null values if there are no refunds
//     $order_refunded = [
//         [
//             'order_refund_id' => null,
//             'order_refund_reason' => null,
//             'order_refund_amount' => null,
//             'order_refund_date_created' => null,
//             'order_refunded_by' => null,
//             'order_parent_id' => null,
//             'order_refunded_payment' => null,
//         ]
//     ];
// }

      

        







        //tax lines properties
        $product_tax_lines = [];

        try {
            $tax_items = $order->get_items('tax');
            
            if (empty($tax_items)) {
                throw new Exception('<br> No tax items found <br>');
            }
        
            foreach ($tax_items as $item_id => $item) {
                $tax_item_name = $item->get_name();
                $tax_item_rate_code = $item->get_rate_code();
                $tax_item_rate_label = $item->get_label();
                $tax_item_rate_id = $item->get_rate_id();
                $tax_item_tax_total = $item->get_tax_total();
                $tax_item_shipping_tax_total = $item->get_shipping_tax_total();
                $tax_item_is_compound = $item->is_compound();
                $tax_item_compound = $item->get_compound();
        
                $product_tax_lines[] = array(
                    'tax_item_name' => $tax_item_name, // Tax name
                    'tax_item_rate_code' => $tax_item_rate_code,
                    'tax_item_rate_id' => $tax_item_rate_id,
                    'tax_item_rate_label' => $tax_item_rate_label,
                    'tax_item_is_compound' => $tax_item_is_compound,
                    'tax_item_compound' => $tax_item_compound,
                    'tax_item_tax_total' => $tax_item_tax_total,
                    'tax_item_shipping_tax_total' => $tax_item_shipping_tax_total,
                );
            }
        } catch (Exception $e) {
            // Handle the exception here
          //  echo 'Error: ' . $e->getMessage();
            // Return an array with null values for all attributes
            $product_tax_lines = [
                [
                    'tax_item_name' => null,
                    'tax_item_rate_code' => null,
                    'tax_item_rate_id' => null,
                    'tax_item_rate_label' => null,
                    'tax_item_is_compound' => null,
                    'tax_item_compound' => null,
                    'tax_item_tax_total' => null,
                    'tax_item_shipping_tax_total' => null,
                ]
            ];
        }
        

        //shipping lines properties

        $product_shipping_lines = [];

        try {
            $shipping_items = $order->get_items('shipping');
            
            if (empty($shipping_items)) {
                throw new Exception('<br> No shipping items found <br>');
            }
        
            foreach ($shipping_items as $item_id => $item) {
                $order_item_name = $item->get_name();
                $order_item_type = $item->get_type();
                $shipping_method_title = $item->get_method_title();
                $shipping_method_id = $item->get_method_id(); // The method ID
                $shipping_method_instance_id = $item->get_instance_id(); // The instance ID
                $shipping_method_total = $item->get_total();
                $shipping_method_total_tax = $item->get_total_tax();
                $shipping_method_taxes = $item->get_taxes();
        
                $product_shipping_lines[] = array(
                    'shipping_method_instance_id' => $shipping_method_instance_id,
                    'order_item_name' => $order_item_name,
                    'order_item_type' => $order_item_type,
                    'shipping_method_title' => $shipping_method_title,
                    'shipping_method_id' => $shipping_method_id,
                    'shipping_method_total' => $shipping_method_total,
                    'shipping_method_total_tax' => $shipping_method_total_tax,
                    'shipping_method_taxes' => $shipping_method_taxes,
                );
            }
        } catch (Exception $e) {
            // Handle the exception here
          //  echo 'Error: ' . $e->getMessage();
            // Return an array with null values for all attributes
            $product_shipping_lines = [
                [
                    'shipping_method_instance_id' => null,
                    'order_item_name' => null,
                    'order_item_type' => null,
                    'shipping_method_title' => null,
                    'shipping_method_id' => null,
                    'shipping_method_total' => null,
                    'shipping_method_total_tax' => null,
                    'shipping_method_taxes' => null,
                ]
            ];
        }
        



        

        //line items properties
        $items = $order->get_items();
        $product_items = []; // Initialize the product_items array
        
        try {
            if (empty($items)) {
                throw new Exception('<br> No items found <br>');
            }
        
            foreach ($items as $item) {
                // Retrieve item details
                $product_name = $item->get_name();
                $product_id = $item->get_product_id();
                $variation_id = $item->get_variation_id();
                $quantity = $item->get_quantity();
                $tax_class = $item->get_tax_class();
                $subtotal = $item->get_subtotal();
                $tax_subtotal = $item->get_subtotal_tax();
                $total = $item->get_total();
                $tax_status = $item->get_tax_status();
                $sku = $item->get_product()->get_sku();
                $item_price = $item->get_product()->get_price();
        
                // Add item details to the product_items array
                $product_items[] = array(
                    'product_name' => $product_name,
                    'product_id' => $product_id,
                    'variation_id' => $variation_id,
                    'quantity' => $quantity,
                    'tax_class' => $tax_class,
                    'subtotal' => $subtotal,
                    'subtotal_tax' => $tax_subtotal,
                    'total' => $total,
                    'tax status' => $tax_status,
                    'sku' => $sku,
                    'price' => $item_price,
                );
            }
        } catch (Exception $e) {
            // Handle the exception here
            //echo 'Error: ' . $e->getMessage();
            // Return an array with null values for all attributes
            $product_items = [
                [
                    'product_name' => null,
                    'product_id' => null,
                    'variation_id' => null,
                    'quantity' => null,
                    'tax_class' => null,
                    'subtotal' => null,
                    'subtotal_tax' => null,
                    'total' => null,
                    'tax status' => null,
                    'sku' => null,
                    'price' => null,
                ]
            ];
        }
        
        
        //echo json_encode($product_items);
        
       


        // =========================================================  order properties =========================================================
        $order_id = $order->get_id();
    $order_parent_id = $order->get_parent_id() ?? null; 
    $order_number = $order->get_order_number() ?? null;
    $order_key = $order->get_order_key() ?? null;
    $created_via = $order->get_created_via() ?? null;
    $version = $order->get_version() ?? null;
    $order_status = $order->get_status() ?? null;
    $order_currency = $order->get_currency() ?? null;
    $date_created = $order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u') : null;
    $date_modified = $order->get_date_modified() ? $order->get_date_modified()->format('Y-m-d H:i:s.u') : null;
    $discount_total = $order->get_discount_total() ?? null;
    $discount_tax = $order->get_discount_tax() ?? null;
    $shipping_total = $order->get_shipping_total() ?? null;
    $shipping_tax = $order->get_shipping_tax() ?? null;
    $cart_tax = $order->get_cart_tax() ?? null;
    $total = $order->get_total() ?? null;
    $total_tax = $order->get_total_tax() ?? null;
    $prices_include_tax = $order->get_prices_include_tax() ?? null;
    
    // Customer properties
    $customer_id = $order->get_customer_id() ?? null;
    $customer_ip_address = $order->get_customer_ip_address() ?? null;
    $customer_user_agent = $order->get_customer_user_agent() ?? null;
    $customer_note = $order->get_customer_note() ?? null;

    // Payment properties
    $payment_method = $order->get_payment_method() ?? null;
    $payment_method_title = $order->get_payment_method_title() ?? null;
    $transaction_id = $order->get_transaction_id() ?? null;
    $date_paid = $order->get_date_paid() ? $order->get_date_paid()->format('Y-m-d H:i:s.u') : null;
    $date_completed = $order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null;
    $cart_hash = $order->get_cart_hash() ?? null;

    // Billing properties
    $billing_first_name = $order->get_billing_first_name() ?? null;
    $billing_last_name = $order->get_billing_last_name() ?? null;
    $billing_company = $order->get_billing_company() ?? null;
    $billing_address_1 = $order->get_billing_address_1() ?? null;
    $billing_address_2 = $order->get_billing_address_2() ?? null;
    $billing_city = $order->get_billing_city() ?? null;
    $billing_state = $order->get_billing_state() ?? null;
    $billing_postcode = $order->get_billing_postcode() ?? null;
    $billing_country = $order->get_billing_country() ?? null;
    $billing_email = $order->get_billing_email() ?? null;
    $billing_phone = $order->get_billing_phone() ?? null;

    // Shipping properties
    $shipping_first_name = $order->get_shipping_first_name() ?? null;
    $shipping_last_name = $order->get_shipping_last_name() ?? null;
    $shipping_company = $order->get_shipping_company() ?? null;
    $shipping_address_1 = $order->get_shipping_address_1() ?? null;
    $shipping_address_2 = $order->get_shipping_address_2() ?? null;
    $shipping_city = $order->get_shipping_city() ?? null;
    $shipping_state = $order->get_shipping_state() ?? null;
    $shipping_postcode = $order->get_shipping_postcode() ?? null;
    $shipping_country = $order->get_shipping_country() ?? null;
    $shipping_phone = $order->get_shipping_phone() ?? null;

    // Other properties
    $order_stock_reduced = $order->get_order_stock_reduced() ?? null;

    // Add order data to the array
    $orders_data[] = [
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
        //'fee_lines' => null, // Assuming you're handling fees separately
        'order_number' => $order_number,
    ];
    }

    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';
}

?>
