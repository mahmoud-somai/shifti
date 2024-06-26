<?php


function get_orders() {
    global $wpdb;
    $args = array(
        'limit' => -1, 
    );
    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $orders_data = [];
    foreach ($orders as $order) {

        // Initialize an array to store order data
        $order_data = [];

        // Retrieve order properties with null coalescing operator
        $order_data['id'] = $order->get_id() ?? null;
        $order_data['parent_id'] = $order->get_parent_id() ?? null; 
        
        $order_data['order_key'] = method_exists($order, 'get_order_key') ? $order->get_order_key() : null;
        $order_data['created_via'] = method_exists($order, 'get_created_via') ? $order->get_created_via() : null;
        $order_data['order_version'] = method_exists($order, 'get_version') ? $order->get_version() : null;
        $order_data['status'] = method_exists($order, 'get_status') ? $order->get_status() : null;
        $order_data['currency'] = method_exists($order, 'get_currency') ? $order->get_currency() : null;
        $order_data['date_created'] = method_exists($order, 'get_date_created') ? ($order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u') : null) : null;
        $order_data['date_modified'] = method_exists($order, 'get_date_modified') ? ($order->get_date_modified() ? $order->get_date_modified()->format('Y-m-d H:i:s.u') : null) : null;
        $order_data['discount_total'] = method_exists($order, 'get_discount_total') ? $order->get_discount_total() : null;
        $order_data['discount_tax'] = method_exists($order, 'get_discount_tax') ? $order->get_discount_tax() : null;
        $order_data['shipping_total'] = method_exists($order, 'get_shipping_total') ? $order->get_shipping_total() : null;
        $order_data['shipping_tax'] = method_exists($order, 'get_shipping_tax') ? $order->get_shipping_tax() : null;
        $order_data['cart_tax'] = method_exists($order, 'get_cart_tax') ? $order->get_cart_tax() : null;
        $order_data['total'] = method_exists($order, 'get_total') ? $order->get_total() : null;
        $order_data['total_tax'] = method_exists($order, 'get_total_tax') ? $order->get_total_tax() : null;
        $order_data['prices_include_tax'] = method_exists($order, 'get_prices_include_tax') ? $order->get_prices_include_tax() : null;

        $order_data['customer_id'] = method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null;
        $order_data['customer_ip_address'] = method_exists($order, 'get_customer_ip_address') ? $order->get_customer_ip_address() : null;
        $order_data['customer_user_agent'] = method_exists($order, 'get_customer_user_agent') ? $order->get_customer_user_agent() : null;
        $order_data['customer_note'] = method_exists($order, 'get_customer_note') ? $order->get_customer_note() : null;

        $order_data['payment_method'] = method_exists($order, 'get_payment_method') ? $order->get_payment_method() : null;
        $order_data['payment_method_title'] = method_exists($order, 'get_payment_method_title') ? $order->get_payment_method_title() : null;
        $order_data['transaction_id'] = method_exists($order, 'get_transaction_id') ? $order->get_transaction_id() : null ;

        $order_data['date_completed'] = method_exists($order, 'get_date_completed') ? ($order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null) : null;
        $order_data['date_paid'] = method_exists($order, 'get_date_paid') ? ($order->get_date_paid() ? $order->get_date_paid()->format('Y-m-d H:i:s.u') : null) : null;
        
        
        $cart_hash = method_exists($order, 'get_cart_hash') ? $order->get_cart_hash() : null;
        $order_data['cart_hash'] = !empty($cart_hash) ? $cart_hash : null;

// -----------------------------------------------------  Billing Details  -----------------------------------------------------------

        $billing = [];

        $billing['first_name'] = method_exists($order, 'get_billing_first_name') ? $order->get_billing_first_name() : null;
        $billing['last_name'] = method_exists($order, 'get_billing_last_name') ? $order->get_billing_last_name() : null;
        $billing['company'] = method_exists($order, 'get_billing_company') ? $order->get_billing_company() : null;
        $billing['address_1'] = method_exists($order, 'get_billing_address_1') ? $order->get_billing_address_1() : null;
        $billing['address_2'] = method_exists($order, 'get_billing_address_2') ? $order->get_billing_address_2() : null;
        $billing['city'] = method_exists($order, 'get_billing_city') ? $order->get_billing_city() : null;
        $billing['state'] = method_exists($order, 'get_billing_state') ? $order->get_billing_state() : null;
        $billing['postcode'] = method_exists($order, 'get_billing_postcode') ? $order->get_billing_postcode() : null;
        $billing['country'] = method_exists($order, 'get_billing_country') ? $order->get_billing_country() : null;
        $billing['email'] = method_exists($order, 'get_billing_email') ? $order->get_billing_email() : null;
        $billing['phone'] = method_exists($order, 'get_billing_phone') ? $order->get_billing_phone() : null;

// -----------------------------------------------------  Shipping Details  -----------------------------------------------------------
        $shipping = [];

        $shipping['first_name'] = method_exists($order, 'get_shipping_first_name') ? $order->get_shipping_first_name() : null;
        $shipping['last_name'] = method_exists($order, 'get_shipping_last_name') ? $order->get_shipping_last_name() : null;
        $shipping['company'] = method_exists($order, 'get_shipping_company') ? $order->get_shipping_company() : null;
        $shipping['address_1'] = method_exists($order, 'get_shipping_address_1') ? $order->get_shipping_address_1() : null;
        $shipping['address_2'] = method_exists($order, 'get_shipping_address_2') ? $order->get_shipping_address_2() : null;
        $shipping['city'] = method_exists($order, 'get_shipping_city') ? $order->get_shipping_city() : null;
        $shipping['state'] = method_exists($order, 'get_shipping_state') ? $order->get_shipping_state() : null;
        $shipping['postcode'] = method_exists($order, 'get_shipping_postcode') ? $order->get_shipping_postcode() : null;
        $shipping['country'] = method_exists($order, 'get_shipping_country') ? $order->get_shipping_country() : null;
        $shipping['phone'] = method_exists($order, 'get_shipping_phone') ? $order->get_shipping_phone() : null;
       
      
// -----------------------------------------------------  Line Items  -----------------------------------------------------------

$product_items = []; 

if (method_exists($order, 'get_items')) {
    $items = $order->get_items();
} else {
    $items = [];
}

foreach ($items as $item) {
    $id             = method_exists($item, 'get_id') ? $item->get_id() : null;
    $product_name   = method_exists($item, 'get_name') ? $item->get_name() : null;
    $product_id     = method_exists($item, 'get_product_id') ? $item->get_product_id() : null;
    $variation_id   = method_exists($item, 'get_variation_id') ? $item->get_variation_id() : null;
    $quantity       = method_exists($item, 'get_quantity') ? $item->get_quantity() : null;
    $tax_class      = method_exists($item, 'get_tax_class') ? $item->get_tax_class() : null;
    $subtotal       = method_exists($item, 'get_subtotal') ? $item->get_subtotal() : null;
    $tax_subtotal   = method_exists($item, 'get_subtotal_tax') ? $item->get_subtotal_tax() : null;
    $total          = method_exists($item, 'get_total') ? $item->get_total() : null;
    $tax_status     = method_exists($item, 'get_tax_status') ? $item->get_tax_status() : null;
    $total_tax      = method_exists($item, 'get_total_tax') ? $item->get_total_tax() : null;
  //  $sku            = method_exists($item->get_product(), 'get_sku') ? $item->get_product()->get_sku() : null;
    //$item_price     = method_exists($item->get_product(), 'get_price') ? $item->get_product()->get_price() : null;
   // $item_product_meta_data_array = method_exists($item, 'get_meta_data') ? $item->get_meta_data() : null;

    $product_items[] = array(
        'id' => $id,
        'product_name' => $product_name,
        'product_id' => $product_id,
        'variation_id' => $variation_id,
        'quantity' => $quantity,
        'tax_class' => $tax_class,
        'subtotal' => $subtotal,
        'subtotal_tax' => $tax_subtotal,
        'total' => $total,
        'tax status' => $tax_status,
        'total_tax' => $total_tax,
        //'sku' => $sku,
        //'price' => $item_price,
        //'meta_data' => $item_product_meta_data_array,
    );
}


//______________________________________________________  taxe Line   ______________________________________________________

$product_tax_lines = [];

//solution one

// try {
//     $tax_items = $order->get_items('tax');
    
//     if (empty($tax_items)) {
//         throw new Exception('No tax items found');
//     }

//     foreach ($tax_items as $item_id => $item) {
//         $tax_item_name = $item->get_name();
//         $tax_item_rate_code = $item->get_rate_code();
//         $tax_item_rate_label = $item->get_label();
//         $tax_item_rate_id = $item->get_rate_id();
//         $tax_item_tax_total = $item->get_tax_total();
//         $tax_item_shipping_tax_total = $item->get_shipping_tax_total();
//         $tax_item_is_compound = $item->is_compound();
//         $tax_item_compound = $item->get_compound();

//         $product_tax_lines[] = array(
//             'tax_item_name' => $tax_item_name, // Tax name
//             'tax_item_rate_code' => $tax_item_rate_code,
//             'tax_item_rate_id' => $tax_item_rate_id,
//             'tax_item_rate_label' => $tax_item_rate_label,
//             'tax_item_is_compound' => $tax_item_is_compound,
//             'tax_item_compound' => $tax_item_compound,
//             'tax_item_tax_total' => $tax_item_tax_total,
//             'tax_item_shipping_tax_total' => $tax_item_shipping_tax_total,
//         );
//     }
// } catch (Exception $e) {
//     // Handle the exception here
//     echo 'Error: ' . $e->getMessage();
//     // Return an empty array if tax items are empty
//     $product_tax_lines = [];
// }



    if (method_exists($order, 'get_items')) {
        $tax_items = $order->get_items('tax');
        if (!empty($tax_items)) {
            foreach ($tax_items as $item_id => $item) {
                $tax_item_id = $item->get_id();
                $tax_item_name = $item->get_name();
                $tax_item_rate_code = $item->get_rate_code();
                $tax_item_rate_label = $item->get_label();
                $tax_item_rate_id = $item->get_rate_id();
                $tax_item_tax_total = $item->get_tax_total();
                $tax_item_shipping_tax_total = $item->get_shipping_tax_total();
                $tax_item_is_compound = $item->is_compound();
                $tax_item_compound = $item->get_compound();

                $product_tax_lines[] = array(
                    'tax_item_id' => $tax_item_id,
                    'tax_item_name' => $tax_item_name,
                    'tax_item_rate_code' => $tax_item_rate_code,
                    'tax_item_rate_id' => $tax_item_rate_id,
                    'tax_item_rate_label' => $tax_item_rate_label,
                    'tax_item_is_compound' => $tax_item_is_compound,
                    'tax_item_compound' => $tax_item_compound,
                    'tax_item_tax_total' => $tax_item_tax_total,
                    'tax_item_shipping_tax_total' => $tax_item_shipping_tax_total,
                );
            }
        } else {
   
            $product_tax_lines = [
                'tax_item_id' => null,
                'tax_item_name' => null,
                'tax_item_rate_code' => null,
                'tax_item_rate_id' => null,
                'tax_item_rate_label' => null,
                'tax_item_is_compound' => null,
                'tax_item_compound' => null,
                'tax_item_tax_total' => null,
                'tax_item_shipping_tax_total' => null,
            ];
        }
    } else {
        echo 'Unable to retrieve tax items.';
    }
    
// echo '<br> Tax Lines: <br>';
//     echo json_encode($product_tax_lines);
//     echo '<br>';



//solution 2

    // if (method_exists($order, 'get_items')) {
    // $tax_items = $order->get_items('tax');

    // foreach ($tax_items as $item_id => $item) {
    //     $tax_item_name = $item->get_name();
    //     $tax_item_rate_code = $item->get_rate_code();
    //     $tax_item_rate_label = $item->get_label();
    //     $tax_item_rate_id = $item->get_rate_id();
    //     $tax_item_tax_total = $item->get_tax_total();
    //     $tax_item_shipping_tax_total = $item->get_shipping_tax_total();
    //     $tax_item_is_compound = $item->is_compound();
    //     $tax_item_compound = $item->get_compound();

    //     $product_tax_lines[] = array(
    //         'tax_item_name' => $tax_item_name, // Tax name
    //         'tax_item_rate_code' => $tax_item_rate_code,
    //         'tax_item_rate_id' => $tax_item_rate_id,
    //         'tax_item_rate_label' => $tax_item_rate_label,
    //         'tax_item_is_compound' => $tax_item_is_compound,
    //         'tax_item_compound' => $tax_item_compound,
    //         'tax_item_tax_total' => $tax_item_tax_total,
    //         'tax_item_shipping_tax_total' => $tax_item_shipping_tax_total,
    //     );
    // }
    // } else {
    // echo 'Unable to retrieve tax items.';
    // }


//______________________________________________________  Shipping Line   ______________________________________________________

    $product_shipping_lines = [];
    if (method_exists($order, 'get_items')) {
        $shipping_items = $order->get_items('shipping');
    
        // If there are shipping items, populate the array
        if (!empty($shipping_items)) {
            foreach ($shipping_items as $item_id => $item) {
                $shipping_item_id            = $item->get_id();
                $shipping_method_title       = $item->get_method_title();
                $shipping_method_id          = $item->get_method_id(); // The method ID
                $shipping_method_total       = $item->get_total();
                $shipping_method_total_tax   = $item->get_total_tax();
                $shipping_method_taxes       = $item->get_taxes();
            }
    
            // Add shipping item data to the array
            $product_shipping_lines = array(
               'shipping_id' => $shipping_item_id,
                'shipping_method_title' => $shipping_method_title,
                'shipping_method_id' => $shipping_method_id,
                'shipping_method_total' => $shipping_method_total,
                'shipping_method_total_tax' => $shipping_method_total_tax,
                'shipping_method_taxes' => $shipping_method_taxes,
            );
        } else {
            // If there are no shipping items, set all attributes to null
            $product_shipping_lines = array(
                'shipping_id' => null,
                'shipping_method_title' => null,
                'shipping_method_id' => null,
                'shipping_method_total' => null,
                'shipping_method_total_tax' => null,
                'shipping_method_taxes' => null,
            );
        }
    } else {
        // If the method doesn't exist, indicate that shipping items couldn't be retrieved
        echo 'Unable to retrieve shipping items.';
    }



    //_______________________________________________________ fees Line   ______________________________________________________


    $order_fees = [];

// Check if the method exists before calling it
    if (method_exists($order, 'get_fees')) {
    // Check if there are any fees associated with the order
    $fees = $order->get_fees();

    // If there are fees, populate the array
    if (!empty($fees)) {
        foreach ($fees as $fee_id => $fee) {
            $fee_name       = $fee->get_name();
            $fee_tax_class  = $fee->get_tax_class();
            $fee_tax_status = $fee->get_tax_status();
            $fee_total      = $fee->get_total();
            $fee_total_tax  = $fee->get_total_tax();

            // Add fee details to the order_fees array
            $order_fees[] = array(
                'fee_name'       => $fee_name,
                'fee_tax_class'  => $fee_tax_class,
                'fee_tax_status' => $fee_tax_status,
                'fee_total'      => $fee_total,
                'fee_total_tax'  => $fee_total_tax,
            );
        }
    } else {
        // If there are no fees, set the order_fees array to an empty array
        $order_fees = [];
    }
} else {
    // If the method doesn't exist, indicate that fees couldn't be retrieved
    echo 'Unable to retrieve fees.';
}



// ________________________________________________________  Coupon Line   ______________________________________________________

$coupon_tab = [];

if (method_exists($order, 'get_coupons')) {
    $coupons = $order->get_coupons();

    if (!empty($coupons)) {
        foreach ($order->get_coupon_codes() as $coupon_code) {
            $coupon = new WC_Coupon($coupon_code);

            $discount_type = $coupon->get_discount_type();
            $coupon_amount = $coupon->get_amount();
            $coupon_id     = $coupon->get_id();
            $coupon_code   = $coupon->get_code();

            $coupon_tab[] = array(
                'coupon_id'           => $coupon_id,
                'coupon_code'         => $coupon_code,
                'coupon_amount'       => $coupon_amount,
                'coupon_discount_type'=> $discount_type,
            );
        }
    } else {
        $coupon_tab = [];
    }
} else {
    echo 'Unable to retrieve coupons.';
}


// ________________________________________________________  Refund Line   ______________________________________________________


$order_refunded = [];
if (method_exists($order, 'get_refunds')) {
    $refunds = $order->get_refunds();

    foreach ($refunds as $refund) {
        $order_refund_id = method_exists($refund, 'get_id') ? $refund->get_id() : null;
        $order_refund_reason = method_exists($refund, 'get_reason') ? $refund->get_reason() : null;
        $order_refund_amount = method_exists($refund, 'get_amount') ? $refund->get_amount() : null;
        $order_refund_date_created = method_exists($refund, 'get_date_created') ? ($refund->get_date_created() ? $refund->get_date_created()->format('Y-m-d H:i:s.u') : null) : null;
        $order_refunded_by = method_exists($refund, 'get_refunded_by') ? $refund->get_refunded_by() : null;
        $order_parent_id = method_exists($refund, 'get_parent_id') ? $refund->get_parent_id() : null;

        try {
            $refunded_payment = method_exists($refund, 'get_refunded_payment') ? $refund->get_refunded_payment() : null;

            if ($refunded_payment === true) {
                $refunded_payment = true;
            } elseif ($refunded_payment === false) {
                $refunded_payment = false;
            } else {
                $refunded_payment = null;
            }
        } catch (Exception $e) {
            $refunded_payment = null;
        }

        $order_refunded[] = array(
            'order_refund_id' => $order_refund_id ?? null,
            'order_refund_reason' => $order_refund_reason ?? null,
            'order_refund_amount' => $order_refund_amount ?? null,
            'order_refund_date_created' => $order_refund_date_created ?? null,
            'order_refunded_by' => $order_refunded_by ?? null,
            'order_parent_id' => $order_parent_id ?? null,
            'order_refunded_payment' => $refunded_payment ?? null,
        );
    }
}








        $order_data['refund_lines'] = $order_refunded;
        $order_data['coupon_lines'] = $coupon_tab;
        $order_data['fee_lines'] = $order_fees;
        $order_data['shipping_lines'] = $product_shipping_lines;
        $order_data['tax_lines'] = $product_tax_lines;
        $order_data['line_items'] = $product_items;
        $order_data['Billing'] = $billing;
        $order_data['Shipping'] = $shipping;
        $orders_data[] = $order_data;


    }


    
    // echo '<br> Orders Data: <br>';
    // echo json_encode($orders_data);
    // echo '<br>';

    return json_encode($orders_data);
}



?>
