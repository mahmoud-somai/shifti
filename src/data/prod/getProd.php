<?php

function get_prod(){
    $products = wc_get_products( array( 'status' => 'publish', 'limit' => -1 ) );
    

    echo "<h2>Products</h2>";
    echo json_encode($products);
    echo "<br>";

    $tab_prod=[];

    foreach ($products as $product) {

        $tab_prod['id']=$product->get_id();
        $tab_prod['name']=$product->get_name();
        $tab_prod['slug']=$product->get_slug();
        $tab_prod['permalink']=$product->get_permalink();



        // echo  $product->get_status();  // Product status
        // echo  $product->get_type();  // Product type
        // echo  $product->get_id();    // Product ID
        // echo  $product->get_title(); // Product title
        // echo  $product->get_slug(); // Product slug
        // echo  $product->get_price(); // Product price
        // echo  $product->get_catalog_visibility(); // Product visibility
        // echo  $product->get_stock_status(); // Product stock status
        // // product date information
        // echo $product->get_date_created()->date('Y-m-d H:i:s');
        // echo $product->get_date_modified()->date('Y-m-d H:i:s');
    }

    echo json_encode($tab_prod);

}
?>