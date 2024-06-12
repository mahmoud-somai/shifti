<?php
function get_ord_det() {
    global $wpdb;
    $shop_id = get_option('shifti_shop_id');
    $tenant_id = get_option('shifti_tenant_id');
    $args = array(
        'limit' => -1, 
    );
    $orders_query = new WC_Order_Query($args);
    $orders = $orders_query->get_orders();
    $line_items_data = [];
    foreach ($orders as $order) {
        // Check if customer_id is not 0 or null
        $customer_id = method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null;
        if ($customer_id === 0 || $customer_id === null) {
            continue;
        }
        
        $order_id = $order->get_id();
        $items = $order->get_items();
        foreach ($items as $item) {
            $id = method_exists($item, 'get_id') ? $item->get_id() : null;
            $product_name = method_exists($item, 'get_name') ? $item->get_name() : null;
            $product_id = method_exists($item, 'get_product_id') ? $item->get_product_id() : null;
            $quantity = method_exists($item, 'get_quantity') ? $item->get_quantity() : null;
            $subtotal =  method_exists($item, 'get_subtotal') ? $item->get_subtotal() : null;
            $line_item = array(
                'shop_id' => (int)$shop_id, // '1' is the default value for the shop_id
                'order_id' => $order_id,
                'foreign_id' => $id,
                'product_name' => $product_name,
                'product_id' => $product_id,
                'product_quantity' => $quantity,
                'product_price' =>floatval( $subtotal),
                'product_attribute_id' => null,
                "tax_rules_group_id" => null,
                "order_invoice_id" => null,
                "warehouse_id" => null,
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
            $line_items_data[] = $line_item;
        }
    }
    return json_encode($line_items_data);
}
?>
