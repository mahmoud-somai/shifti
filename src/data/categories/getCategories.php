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

        $cat_thumb_ids = get_term_meta( $prod_cat->term_id, 'thumbnail_id' ); // Get all thumbnail IDs

        // Loop through each thumbnail ID
        foreach ($cat_thumb_ids as $cat_thumb_id) {
            $image = wp_get_attachment_url( $cat_thumb_id ); // Get image URL
            echo "<br>";
            echo "Thumbnail ID: " . $cat_thumb_id . "<br>";
            echo "Image URL: " . $image . "<br>";
        }
    }
}
?>
