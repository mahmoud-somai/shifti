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
        $order_data['shop_id']=1;
        $order_data['lang_id']=1;
        $order_data['tenant_id']="tenant_id_159";
        $order_data['foreign_id'] = (int) ($order->get_id() ?? null);
        $order_data['reference'] = (int) ($order->get_id() ?? null);

        $order_data['woo_status'] = method_exists($order, 'get_status') ? $order->get_status() : null;
        $order_data['woo_currency'] = method_exists($order, 'get_currency') ? $order->get_currency() : null;
        $order_data['invoice_date'] = method_exists($order, 'get_date_created') ? ($order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s.u') : null) : null;
        $order_data['total_discounts'] = (float) (method_exists($order, 'get_discount_total') ? $order->get_discount_total() : null);
        $order_data['total_shipping'] = (float) (method_exists($order, 'get_shipping_total') ? $order->get_shipping_total() : null);
        $order_data['total_paid'] = (float) (method_exists($order, 'get_total') ? $order->get_total() : null);
        $order_data['total_paid_real'] = (float) (method_exists($order, 'get_total') ? $order->get_total() : null);
        $order_data['customer_id'] = (int) (method_exists($order, 'get_customer_id') ? $order->get_customer_id() : null);
        $order_data['payment'] = method_exists($order, 'get_payment_method_title') ? $order->get_payment_method_title() : null;
        $order_data['note'] = method_exists($order, 'get_customer_note') ? $order->get_customer_note() : null;
        $order_data['delivery_date'] = method_exists($order, 'get_date_completed') ? ($order->get_date_completed() ? $order->get_date_completed()->format('Y-m-d H:i:s.u') : null) : null;

        $order_data['address_delivery_id'] = 1; // Placeholder, replace with actual logic
        $order_data['address_invoice_id'] = 1; // Placeholder, replace with actual logic
        $order_data['cart_id'] = 1; // Placeholder, replace with actual logic
        $order_data['currency_id'] = 10; // Placeholder, replace with actual logic
        $order_data['carrier_id'] = 1; // Placeholder, replace with actual logic
        $order_data['module'] = null; // Placeholder, replace with actual logic
        $order_data['total_paid_tax_incl'] = null; // Placeholder, replace with actual logic
        $order_data['total_paid_tax_excl'] = null; // Placeholder, replace with actual logic
        $order_data['total_products'] = (int) count($order->get_items());
        $order_data['total_products_wt'] = (int) count($order->get_items());
        $order_data['conversion_rate'] = null; // Placeholder, replace with actual logic
        $order_data['invoice_number'] = ''; // Placeholder, replace with actual logic
        $order_data['delivery_number'] = ''; // Placeholder, replace with actual logic
        $order_data['carrier_tax_rate'] = null; // Placeholder, replace with actual logic
        $order_data['shipping_number'] = ''; // Placeholder, replace with actual logic
        $order_data['total_wrapping'] = null; // Placeholder, replace with actual logic
        $order_data['valid'] = ''; // Placeholder, replace with actual logic
        $order_data['current_state'] = null; // Placeholder, replace with actual logic
        $order_data['shop_group_id_foreign'] = null; // Placeholder, replace with actual logic
        $order_data['secure_key'] = ''; // Placeholder, replace with actual logic
        $order_data['recyclable'] = false; // Placeholder, replace with actual logic
        $order_data['gift'] = false; // Placeholder, replace with actual logic
        $order_data['gift_message'] = ''; // Placeholder, replace with actual logic
        $order_data['mobile_theme'] = false; // Placeholder, replace with actual logic
        $order_data['total_discounts_tax_incl'] = null; // Placeholder, replace with actual logic
        $order_data['total_discounts_tax_excl'] = null; // Placeholder, replace with actual logic
        $order_data['total_shipping_tax_incl'] = null; // Placeholder, replace with actual logic
        $order_data['total_shipping_tax_excl'] = null; // Placeholder, replace with actual logic
        $order_data['total_wrapping_tax_incl'] = null; // Placeholder, replace with actual logic
        $order_data['total_wrapping_tax_excl'] = null; // Placeholder, replace with actual logic
        $order_data['round_mode'] = null; // Placeholder, replace with actual logic
        $order_data['round_type'] = null; // Placeholder, replace with actual logic
        $order_data['date_add_foreign'] = method_exists($order, 'get_date_created') ? ($order->get_date_created() ? $order->get_date_created()->format('Y-m-d H:i:s') : null) : null;

        $orders_data[] = $order_data;
    }

    return json_encode($orders_data);
}
?>
