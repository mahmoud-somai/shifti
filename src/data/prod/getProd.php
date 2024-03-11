<?php

function get_prod(){

    $args = array(
        'status'            => array( 'draft', 'pending', 'private', 'publish' ),
        'type'              => array_merge( array_keys( wc_get_product_types() ) ),
        'parent'            => null,
        'sku'               => '',
        'category'          => array(),
        'tag'               => array(),
        'limit'             => get_option( 'posts_per_page' ),  // -1 for unlimited
        'offset'            => null,
        'page'              => 1,
        'include'           => array(),
        'exclude'           => array(),
        'orderby'           => 'date',
        'order'             => 'DESC',
        'return'            => 'objects',
        'paginate'          => false,
        'shipping_class'    => array(),
    );
    //$products = wc_get_products( array( 'status' => array( 'draft', 'pending', 'private', 'publish' ), 'limit' => -1 ) );
    $products = wc_get_products( $args )

    echo "<h2>Products</h2>";
    echo json_encode($products);
    echo "<br>";

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
        $temp_prod['short_description']=$product->get_short_description();
        $temp_prod['sku']=$product->get_sku();





        $tab_prod[] = $temp_prod;

    }

    echo json_encode($tab_prod);

}
?>