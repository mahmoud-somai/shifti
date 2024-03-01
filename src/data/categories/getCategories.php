<?php

function get_ctg(){
    global $wp_query;






    $prod_categories = get_terms( 'product_cat', array(
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => true
    ));

    foreach( $prod_categories as $prod_cat ) {
        echo "product category name: <br> ";
        echo $prod_cat;
        echo "<br>";

        $cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
        $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'shop_catalog' );
        $term_link = get_term_link( $prod_cat, 'product_cat' );

        echo "<br>";
        echo $cat_thumb_id;
        echo "<br>";
        echo $shop_catalog_img;
        echo "<br>";
        echo $term_link;
         echo "<br>";

    }

}
?>
