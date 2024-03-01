<?php

function get_ctg(){
    global $wp_query;

    $prod_categories = get_terms( 'product_cat', array(
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => true
    ));

    $categories=[];

    foreach( $prod_categories as $prod_cat ) {
        $category=[];
        echo "product category name: <br> ";
        echo json_encode($prod_cat);
        echo "<br>";

        $category['id'] = $prod_cat->term_id;
        $category['name'] = $prod_cat->name;
        $category['slug'] = $prod_cat->slug;
        $category['parent'] = $prod_cat->parent;
        $category['description'] = $prod_cat->description;
        $category['display'] = $prod_cat->display;

        $category['menu_order']= $prod_cat->menu_order;
        $category['count'] = $prod_cat->count;
        $cat_thumb_id = get_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $cat_thumb_id ); 
        $category['image'] = $image;

    

        $categories[] = $category;


    }

}
?>
