

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
   // $args = array(
    //    'limit' => -1, 
   // );
    // Define the specific order IDs you want to retrieve
    $specific_order_ids = array(28); //50771
  

    $args = array(
        'post__in' => $specific_order_ids, // Include only the orders with the specified IDs
    );


    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();

   
    $orders_data = [];

    foreach ($orders as $order) {
        echo '<br>';
        echo 'order ==> <br>';
       // echo json_encode($order->get_data());
       
        echo '<br>';
        echo '<br>';
        
        $coupons=$order->get_coupons();
        // foreach($coupons as $coupon){
        //     echo 'coupon ==> <br>';
        //     echo $coupon;
        //     echo '<br>';
        //     echo $coupon->get_id();
        //     echo '<br>';
        //     echo $coupon->get_code();
        //     echo '<br>';
        //     echo $coupon->get_discount();;
        //     echo '<br>';
        //     echo $coupon->get_discount_tax();
        //     echo '<br>';
      
           
        // }

        // echo 'coupon ==> <br>';
        // echo json_encode($order->get_used_coupons());
        // echo '<br>';
        // echo json_encode($order->get_discount_total());
        // echo '<br>';
        // echo json_encode($order->get_discount_tax());
        // echo '<br>';
        // echo json_encode($order->get_discount_to_display());






      //  echo json_encode($order->get_total_refunded());
      //echo json_encode($order->get_item_count_refunded());
    

      // refund properties
        $refunds = $order->get_refunds();
  
        echo '<br>';
        echo '<br>';
        echo 'One refund ==> <br>';
        $order_refunded=[];
        foreach ($refunds as $refund) {
            //echo $refund;
            echo '<br>';
            $order_refund_id = $refund->get_id();
            $order_refund_reason = $refund->get_reason();
            $order_refund_amount = $refund->get_amount();
            $order_refund_date_created = $refund->get_date_created() ? $refund->get_date_created()->format('Y-m-d H:i:s.u'): null;
            $order_refunded_by = $refund->get_refunded_by();
            $order_parent_id = $refund->get_parent_id();

            
            try {
                // Assuming $refund is an instance of a class with the method get_refunded_payment()
                $refunded_payment = $refund->get_refunded_payment();

                
                if ($refunded_payment === true) {
                    echo "Payment has been refunded.";
                    $refunded_payment=true;
                } elseif ($refunded_payment === false) {
                    echo "Payment has not been refunded.";
                    $refunded_payment=false;
                } else {
                    echo "Unexpected result";
                }
            } catch (Exception $e) {
                echo "Error occurred: " . $e->getMessage();
            }
            $order_refunded_payment = $refunded_payment;
        }
        $order_refunded[] = array(
            'order_refund_id' => $order_refund_id,
            'order_refund_reason' => $order_refund_reason,
            'order_refund_amount' => $order_refund_amount,
            'order_refund_date_created' => $order_refund_date_created,
            'order_refunded_by' => $order_refunded_by,
            'order_parent_id' => $order_parent_id,
            'order_refunded_payment' => $order_refunded_payment,
        );

        echo '<br>';
        echo '<br>';





        //tax lines properties
        $product_tax_lines = [];

        try {
            $tax_items = $order->get_items('tax');
            
            if (empty($tax_items)) {
                throw new Exception('No tax items found');
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
            echo 'Error: ' . $e->getMessage();
            // Return an empty array if tax items are empty
            $product_tax_lines = [];
        }
        

        //shipping lines properties

        $product_shipping_lines = [];
        foreach( $order->get_items( 'shipping' ) as $item_id => $item ){
            $order_item_name             = $item->get_name();
            $order_item_type             = $item->get_type();
            $shipping_method_title       = $item->get_method_title();
            $shipping_method_id          = $item->get_method_id(); // The method ID
            $shipping_method_instance_id = $item->get_instance_id(); // The instance ID
            $shipping_method_total       = $item->get_total();
            $shipping_method_total_tax   = $item->get_total_tax();
            $shipping_method_taxes       = $item->get_taxes();
        }
        $product_shipping_lines= array(
            'shipping_method_instance_id' => $shipping_method_instance_id,
            'order_item_name' => $order_item_name,
            'order_item_type' => $order_item_type,

            'shipping_method_title' => $shipping_method_title,
            'shipping_method_id' => $shipping_method_id,
            'shipping_method_total' => $shipping_method_total,
            'shipping_method_total_tax' => $shipping_method_total_tax,
            'shipping_method_taxes' => $shipping_method_taxes,
        );

        //line items properties

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
           $discount_type=item-> get_meta("discount_type",true);
        }
        $product_items[] = array(
            'product_name' => $product_name,
            'product_id' => $product_id,
            'variation_id' => $variation_id,
            'quantity' => $quantity,
            'tax_class' => $tax_class,
            'subtotal' => $subtotal,
            'subtotal_tax' => $tax_subtotal,
            'total' => $total,   
            //total_tax & taxes (tax line ) & metadata & sku & price 
            'tax status' => $tax_status,    
            'discount type'=> $discount_type,    
        );


        //order properties
        $order_id = $order->get_id();
        $order_parent_id=$order->get_parent_id(); 
        $order_number = $order->get_order_number();
        $order_key = $order->get_order_key();
        $created_via = $order->get_created_via();
        $version = $order->get_version();
        $order_status = $order->get_status();
        $order_currency = $order->get_currency();
        $date_created = $order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u'): null;
        $date_modified = $order->get_date_modified() ? $order->get_date_modified()->format('Y-m-d H:i:s.u'): null;
        $discount_total = $order->get_discount_total();
        $discount_tax = $order->get_discount_tax();
        $shipping_total = $order->get_shipping_total();
        $shipping_tax = $order->get_shipping_tax();
        $cart_tax = $order->get_cart_tax();
        $total = $order->get_total();
        $total_tax = $order->get_total_tax();
        $prices_include_tax = $order->get_prices_include_tax();
        


     


        $customer_id = $order->get_customer_id();
        $customer_ip_address = $order->get_customer_ip_address();
        $customer_user_agent = $order->get_customer_user_agent();
        $customer_note = $order->get_customer_note();
//billing and shipping

        $payment_method = $order->get_payment_method();
        $payment_method_title = $order->get_payment_method_title();
        $transaction_id = $order->get_transaction_id();
        $date_paid = $order->get_date_paid() ? $order->get_date_paid()->format('Y-m-d H:i:s.u') : null;
        $date_completed = $order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null;
        $cart_hash = $order->get_cart_hash();

        //metadata & line_items & tax_lines & shipping_lines & fee_lines & coupon_lines & refunds & set_paid
        
        
        

        

        
        //billing properties
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


        // Shipping properties
        $shipping_first_name = $order->get_shipping_first_name();
        $shipping_last_name = $order->get_shipping_last_name();
        $shipping_company = $order->get_shipping_company();
        $shipping_address_1 = $order->get_shipping_address_1();
        $shipping_address_2 = $order->get_shipping_address_2();
        $shipping_city = $order->get_shipping_city();
        $shipping_state = $order->get_shipping_state();
        $shipping_postcode = $order->get_shipping_postcode();
        $shipping_country = $order->get_shipping_country();
        $shipping_phone = $order->get_shipping_phone(); //+++




        
        $order_stock_reduced = $order->get_order_stock_reduced();
       // $download_permissions_granted = $order->get_download_permissions_granted();
       // $new_order_email_sent = $order->get_new_order_email_sent();
       // $recorded_sales = $order->get_recorded_sales();
      //  $recorded_coupon_usage_counts = $order->get_recorded_coupon_usage_counts();
       // $order_number = $order->get_order_number();
        //$meta_data=$order->get_meta_data();

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
            'shipping_line' => $product_shipping_lines,
            'currency' => $order_currency,
         
          //  'tax_lines' => $product_tax_lines,
          //  'refunds' => $order_refunded,
            //'meta_data' => $meta_data,
           // 'line_items' => $line_items,
            //'tax_lines' => $tax_lines,
            //'shipping_lines' => $shipping_lines,
            //'fee_lines' => $fee_lines,
           // 'coupon_lines' => $coupon_lines,
        );
    }

    echo '<br> Orders Data: <br>';
    echo json_encode($orders_data);
    echo '<br>';
}

?>
