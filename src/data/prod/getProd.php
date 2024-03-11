<?php

function get_prod(){

    global $wpdb;

    $args = array(
        'limit' => -1,
        'status'=> array( 'draft', 'pending', 'private', 'publish' ),
    );

    $products = wc_get_products($args);
    
    echo "<h2>Products</h2>";


    $tab_prod=[];

    foreach ($products as $product) {

        $temp_prod=array();

        $temp_prod['id']=$product->get_id();
        $temp_prod['name']=$product->get_name();
        $temp_prod['slug']=$product->get_slug();
        $temp_prod['permalink']=$product->get_permalink();
        $temp_prod['date_created']=$product->get_date_created()->date('Y-m-d H:i:s');
        $temp_prod['date_modified']=$product->get_date_modified()->date('Y-m-d H:i:s');
        $temp_prod['type']=$product->get_type(); 
        $temp_prod['status']=$product->get_status();
        $temp_prod['catalog visibility']=$product->get_catalog_visibility();
        // $temp_prod['description']=$product->get_description();
        //$temp_prod['short_description']=$product->get_short_description();
        $temp_prod['sku']=$product->get_sku();
        $temp_prod['price']=$product->get_price();
        $temp_prod['regular_price']=$product->get_regular_price();
        $temp_prod['sale_price']=$product->get_sale_price();
        $temp_prod['date_on_sale_from']=$product->get_date_on_sale_from();
        $temp_prod['date_on_sale_to']=$product->get_date_on_sale_to();
        



        $tab_prod[] = $temp_prod;
    }

    echo json_encode($tab_prod);
}
?>
