<?php

function get_prods() {
    global $wpdb;
    $shop_id = get_option('shifti_shop_id');
    $tenant_id = get_option('shifti_tenant_id');

    $args = array(
        'limit' => -1,
        'status' => array('draft', 'pending', 'private', 'publish'),
    );

    $products = wc_get_products($args);

    $tab_prod = [];

    foreach ($products as $product) {
        $temp_prod = [];

        // Dimensions
        $dimensions_tab = [];
        $dimensions_tab['height'] = $product->get_height();
        $dimensions_tab['width'] = $product->get_width();
        $dimensions_tab['length'] = $product->get_length();

        $temp_prod['foreign_id'] = $product->get_id();
        $temp_prod['tenant_id'] = $tenant_id;
        $temp_prod['shop_id'] = (int) $shop_id;
        $temp_prod['lang_id'] = 1;
        $temp_prod['tax_id'] = 1;
        $temp_prod['ecotax'] = 0;

        $temp_prod['default_image_id'] = (int) $product->get_image_id();
        $temp_prod['name'] = $product->get_name();
        $temp_prod['reference'] = $product->get_sku();
        $temp_prod['slug'] = $product->get_slug();
        $temp_prod['type'] = $product->get_type();
        $temp_prod['status'] = $product->get_status();

        //$temp_prod['description'] = $product->get_description();
        //$temp_prod['short_description'] = $product->get_short_description();

        $temp_prod['price'] = floatval($product->get_price());

        $temp_prod['regular_price'] = $product->get_regular_price();
        $temp_prod['date_on_sale_from'] = $product->get_date_on_sale_from();
        $temp_prod['date_on_sale_to'] = $product->get_date_on_sale_to();
        $temp_prod['on_sale'] = $product->is_on_sale();

        $temp_prod['purchasable'] = $product->is_purchasable();
        $temp_prod['weight'] = floatval($product->get_weight());

        $temp_prod['height'] = $dimensions_tab['height'];
        $temp_prod['width'] = $dimensions_tab['width'];
        $temp_prod['length'] = $dimensions_tab['length'];

        $temp_prod['ean13'] = null;
        $temp_prod['isbn'] = null;
        $temp_prod['upc'] = null;
        $temp_prod['mpn'] = null;

        $temp_prod['meta_title'] = null;
        $temp_prod['meta_description'] = null;
        $temp_prod['meta_keywords'] = null;

        $temp_prod['ecotax'] = 0;
        $temp_prod['unity'] = null;
        $temp_prod['unit_price_ratio'] = null;
        $temp_prod['additional_shipping_cost'] = null;
        $temp_prod['file'] = null;
        $temp_prod['condition'] = null;
        $temp_prod['active'] = null;

        // Stock management
        $manage_stock = $product->get_manage_stock();
        $stock_quantity = $product->get_stock_quantity();
        $stock_status = $product->get_stock_status();

        // Add stock management details to the product array
        $temp_prod['manage_stock'] = $manage_stock;
        $temp_prod['stock_quantity'] = $stock_quantity;
        $temp_prod['stock_status'] = $stock_status;

        // Add the product to the array only if manage_stock is checked
        if ($manage_stock) {
            $tab_prod[] = $temp_prod;
        }
    }
    echo json_encode($tab_prod);
    return json_encode($tab_prod);
}
?>
