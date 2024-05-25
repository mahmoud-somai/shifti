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
        $order_data['reference'] = $order->get_id() ?? null;

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


        $items = $order->get_items();
        foreach ($items as $item) {
           
          //  $sku            = method_exists($item->get_product(), 'get_sku') ? $item->get_product()->get_sku() : null;
            //$item_price     = method_exists($item->get_product(), 'get_price') ? $item->get_product()->get_price() : null;
           // $item_product_meta_data_array = method_exists($item, 'get_meta_data') ? $item->get_meta_data() : null;
        

            $order_data["product_id"]=method_exists($item, 'get_id') ? $item->get_id() : null;
            $order_data["product_name"]=method_exists($item, 'get_name') ? $item->get_name() : null;
            $order_data["product_quantity"]=method_exists($item, 'get_quantity') ? $item->get_quantity() : null;
            $order_data["product_price"]=method_exists($item, 'get_subtotal') ? $item->get_subtotal() : null;
        }



        $orders_data[] = $order_data;
    }

    return json_encode($orders_data);
}
?>
