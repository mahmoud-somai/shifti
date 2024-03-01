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
        echo json_encode($prod_cat);
        echo "<br>";

        $cat_thumb_id = get_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $cat_thumb_id ); 

        echo "<br>";
        echo $cat_thumb_id;
        echo "<br>";
        echo $image;
        echo "<br>";


    }

}
?>
