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
        $order_data['shop_id'] = 1;
        $order_data['lang_id'] = 1;
        $order_data['tenant_id'] = "tenant_id_159";
        $order_data['foreign_id'] = (int) ($order->get_id() ?? null);
        $order_data['reference'] = $order->get_id() ?? null;

        $order_data['woo_status'] = method_exists($order, 'get_status') ? $order->get_status() : null;
        $order_data['woo_currency'] = method_exists($order, 'get_currency') ? $order->get_currency() : null;
        $order_data['invoice_date'] = method_exists($order, 'get_date_created') ? ($order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u') : null) : null;
        $order_data['total_discounts'] = (float) (method_exists($order, 'get_discount_total') ? $order->get_discount_total() : null);
        $order_data['total_shipping'] = (float) (method_exists($order, 'get_shipping_total') ? $order->get_shipping_total() : null);
        $order_data['total_paid'] = (float) (method_exists($order, 'get_total') ? $order->get_total() : null);
        $order_data['total_paid_real'] = (float) (method_exists($order, 'get_total') ? $order->get_total() : null);
        $order_data['customer_id'] = (int) (method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null);

        // Skip orders where customer_id is 0 or null
        if ($order_data['customer_id'] === 0 || $order_data['customer_id'] === null) {
            continue;
        }

        $order_data['payment'] = method_exists($order, 'get_payment_method_title') ? $order->get_payment_method_title() : null;
        $order_data['note'] = method_exists($order, 'get_customer_note') ? $order->get_customer_note() : null;
        $order_data['delivery_date'] = method_exists($order, 'get_date_completed') ? ($order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null) : null;

        $order_data['address_delivery_id'] = 1; 
        $order_data['address_invoice_id'] = 1; 
        $order_data['cart_id'] = 1; 
        $order_data['currency_id'] = 10; 
        $order_data['carrier_id'] = 1; 
        $order_data['module'] = null; 
        $order_data['total_paid_tax_incl'] = null; 
        $order_data['total_paid_tax_excl'] = null; 
        $order_data['total_products'] = (int) count($order->get_items());
        $order_data['total_products_wt'] = (int) count($order->get_items());
        $order_data['conversion_rate'] = null; 
        $order_data['invoice_number'] = ''; 
        $order_data['delivery_number'] = ''; 
        $order_data['carrier_tax_rate'] = null; 
        $order_data['shipping_number'] = ''; 
        $order_data['total_wrapping'] = null; 
        $order_data['valid'] = ''; 
        $order_data['current_state'] = null; 
        $order_data['shop_group_id_foreign'] = null; 
        $order_data['secure_key'] = ''; 
        $order_data['recyclable'] = false; 
        $order_data['gift'] = false; 
        $order_data['gift_message'] = ''; 
        $order_data['mobile_theme'] = false; 
        $order_data['total_discounts_tax_incl'] = null; 
        $order_data['total_discounts_tax_excl'] = null; 
        $order_data['total_shipping_tax_incl'] = null; 
        $order_data['total_shipping_tax_excl'] = null; 
        $order_data['total_wrapping_tax_incl'] = null; 
        $order_data['total_wrapping_tax_excl'] = null; 
        $order_data['round_mode'] = null; 
        $order_data['round_type'] = null; 
        $order_data['date_add_foreign'] = method_exists($order, 'get_date_created') ? ($order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s') : null) : null;

        $product_items = []; 

        if (method_exists($order, 'get_items')) {
            $items = $order->get_items();
        } else {
            $items = [];
        }
        
        foreach ($items as $item) {
            $id = method_exists($item, 'get_id') ? $item->get_id() : null;
            $product_name = method_exists($item, 'get_name') ? $item->get_name() : null;
            $product_id = method_exists($item, 'get_product_id') ? $item->get_product_id() : null;
            $quantity = method_exists($item, 'get_quantity') ? $item->get_quantity() : null;
            $subtotal = method_exists($item, 'get_subtotal') ? $item->get_subtotal() : null;

            $product_items[] = array(
                'foreign_id' => $id,
                'product_name' => $product_name,
                'product_id' => $product_id,
                'product_quantity' => $quantity,  
                'product_price' => $subtotal, 
                'product_attribute_id' => null,
                "tax_rules_group_id" => null,
                "order_invoice_id" => null,
                "id_warehouse_id" => null,
                "customization_id" => null,
                'product_quantity_reinjected' => null,
                'group_reduction' => null,
                'discount_quantity_applied' => null,
                'download_hash' => null,
                'download_deadline' => null,
                'product_quantity_in_stock' => null,
                'product_quantity_return' => null,
                'product_quantity_refunded' => null,
                'reduction_percent' => null,
                'reduction_amount' => null,
                'reduction_amount_tax_incl' => null,
                'reduction_amount_tax_excl' => null,
                'product_quantity_discount' => null,
                'product_ean13' => null,
                'product_isbn' => null,
                'product_upc' => null,
                'product_mpn' => null,
                'product_reference' => null,
                'product_supplier_reference' => null,
                'product_weight' => null,
                'tax_computation_method' => null,
                'ecotax' => null,
                'ecotax_tax_rate' => null,
                'download_nb' => null,
                'unit_price_tax_incl' => null,
                'unit_price_tax_excl' => null,
                'total_price_tax_incl' => null,
                'total_price_tax_excl' => null,
                'total_shipping_price_tax_excl' => null,
                'total_shipping_price_tax_incl' => null,
                'purchase_supplier_price' => null,
                'original_product_price' => null,
                'original_wholesale_price' => null,
                'total_refunded_tax_excl' => null,
                'total_refunded_tax_inclt' => null,


                
            );
        }
        
        $order_data['line_items'] = $product_items;
        $orders_data[] = $order_data;
    }

    return json_encode($orders_data);
}
?>
