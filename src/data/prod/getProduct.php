<?php

function get_prods(){

    global $wpdb;

    $args = array(
        'limit' => -1,
        'status'=> array( 'draft', 'pending', 'private', 'publish' ),
    );

    $products = wc_get_products($args);
    
   // echo "<h2>Products</h2>";


    $tab_prod=[];

    foreach ($products as $product) {



        $temp_prod=array();


            if ( ! empty( $dimensions ) ) {
                $dimensions_tab['height']= $product->get_height();
                $dimensions_tab['width'] =$product->get_width();
                $dimensions_tab['length'] =$product->get_width();      
            }




                    
        $temp_prod['product_id']=$product->get_id();
        $temp_prod['tenant_id']="tenant_test123";

        $temp_prod['default_image_id'] = null;
        $temp_prod['manufacturer_id'] = null;
        $temp_prod['tax_rule_group_id'] = null;
        $temp_prod['name'] = null;
     
        $temp_prod['reference']=$product->get_sku();
        $temp_prod['slug'] = null;
        $temp_prod['type']=$product->get_type(); 
        $temp_prod['status']=$product->get_status();

        $temp_prod['description'] = null;
        $temp_prod['short_description'] = null;

        $temp_prod['price']=$product->get_price();

        $temp_prod['regular_price'] = null;
        $temp_prod['date_on_sale_from'] = null;
        $temp_prod['date_on_sale_to'] = null;
        $temp_prod['on_sale'] = null;

        $temp_prod['purchasable']=1;  //manually added   
        $temp_prod['weight']=$product->get_weight();
        $temp_prod['height'] = null;
        $temp_prod['width'] = null;
        
        $temp_prod['length'] = null;
        $temp_prod['ean13'] = null;
        $temp_prod['isbn'] = null;
        $temp_prod['upc'] = null;
        $temp_prod['mpn'] = null;

        $temp_prod['name']=$product->get_name();
        $temp_prod['desc']=$product->get_description();
        $temp_prod['short_desc']=$product->get_short_description();
        $temp_prod['meta_title'] = null;
        $temp_prod['meta_description'] = null;
        $temp_prod['meta_keywords'] = null;



        $tab_prod[] = $temp_prod;
    }

    //echo json_encode($tab_prod);
    return json_encode($tab_prod);
}
?>
