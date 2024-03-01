<?php


function get_product_name($product){

    return $product->get_name();
}

function get_product_type($product){
    
    return $product->get_type();
}

function get_product_created_at($product){
    
    $product_object = json_decode($product, true);
    $created_at = $product_object['date_created']['date'];
    return $created_at;
}

function get_product_modified_at($product){
    
    $product_object = json_decode($product, true);
    $modified_at = $product_object['date_modified']['date'];
    return $modified_at;
}

function get_product_short_description($product){
    
    return $product->get_short_description();
}


function get_product_description($product){
      
    return $product->get_description();
}

function get_product_sku($product){
    
    return $product->get_sku();
}


function get_product_price($product){
    return $product->get_price();
}

////////////////

function get_product_slug($product){
    return $product->get_slug();
}


function get_product_status($product){
    return $product->get_status();
}

function get_product_featured($product){
    return $product->get_featured();
}

function get_product_catalog_visibility($product){
    return $product->get_catalog_visibility();
}

function get_product_menu_order($product){
    return $product->get_menu_order();
}


function get_product_virtual($product){
    return $product->get_virtual();
}


function get_product_permalink($product_id){
    return $product->get_permalink($product_id);
}


function get_product_regular_price($product){
    return $product->get_regular_price();
}

function get_product_sale_price($product){
    return $product->get_sale_price();
}




function get_product_date_on_sale_from($product){

    $product_object = json_decode($product, true);
    $date_on_sale_from = $product_object['date_on_sale_from']['date'];
    return $date_on_sale_from;
}

function get_product_date_on_sale_to($product){

    $product_object = json_decode($product, true);
    $date_on_sale_to = $product_object['date_on_sale_to']['date'];
    return $date_on_sale_to;
}


function get_product_total_sales($product){

    return $product->get_total_sales();
}


function get_product_tax_status($product){
    
    return $product->get_tax_status();
}


function get_product_tax_class($product){
    
    return $product->get_tax_class();
}

function get_product_manage_stock($product){
    
    return $product->get_manage_stock();
}


// function get_product_manage_stock($product){
    
//     return $product->get_manage_stock();
// }


function get_product_stock_status($product){
    
    return $product->get_stock_status();
}

function get_product_backorders($product){
    
    return $product->get_backorders();
}


function get_product_sold_individually($product){
    
    return $product->get_sold_individually();
}


function get_product_individually($product){
    
    return $product->get_sold_individually();
}




// price
// regular_price
// sale_price
// date_on_sale_from
// date_on_sale_to
// total_sales
// tax_status
// tax_class
// manage_stock
// stock_quantity
// stock_status
// backorders
// low_stock_amount
// sold_individually
// weight
// length
// width
// height
// upsell_ids
// cross_sell_ids
// parent_id
// reviews_allowed
// purchase_note
// attributes
// default_attributes
// menu_order
// post_password
// virtual
// downloadable
// category_ids
// tag_ids
// shipping_class_id
// downloads
// image_id
// gallery_image_ids
// download_limit
// download_expiry
// rating_counts
// average_rating
// review_count

function get_products() {
    global $wpdb;

    $query = "
      SELECT p.ID, p.post_type, p.post_title, p.post_content, p.post_excerpt, p.post_status
      FROM wp_posts p
      WHERE p.post_type = 'product'
    ";
    
    $results = $wpdb->get_results($query);
    
    $params = array(
        'posts_per_page' => 1,
        'post_type' => 'product'
    );

    $wc_query = new WP_Query($params); 

    $products = [];

    if ($wc_query->have_posts()) {
        while ($wc_query->have_posts()) {
            $wc_query->the_post();
            $product_id = get_the_ID();
            $product = new WC_product($product_id);
            $product_meta = get_post_meta($product_id);

            // Extracting date_created from product
            $product_object = json_decode($product, true);
            // $date_created = $product_object['date_created']['date'];

           // echo $product;
            echo '<br />';


           
        

            $new_product_object['id'] = $product_id;
            $new_product_object['name'] = get_product_name($product);
            $new_product_object['type'] = get_product_type($product);
            $new_product_object['description'] = get_product_description($product);
            $new_product_object['short_description'] = get_product_short_description($product);
            $new_product_object['created_at'] = get_product_created_at($product);
            $new_product_object['modified_at'] = get_product_modified_at($product);
            $new_product_object['sku'] = get_product_sku($product);
            $new_product_object['price'] = get_product_price($product);


            



            $new_product_object['img_thumbnail_url'] = get_the_post_thumbnail_url($product_id);

            $new_product_object['images_gallery_urls'] = array();
            $gallery_images_ids = $product->get_gallery_image_ids();

            foreach ($gallery_images_ids as $gallery_image_id) {
                $gallery_image_url = wp_get_attachment_url($gallery_image_id);
                $new_product_object['images_gallery_urls'][] = $gallery_image_url;
            }

            // Output all meta values
            // foreach ($product_meta as $key => $value) {
            //     $cleaned_key = ltrim($key, '_');
            //     $new_product_object[$cleaned_key . '_' . $product_id] = $value[0];
            // }

            array_push($products, $new_product_object);
        }

        wp_reset_postdata(); // Reset the post data
    }
    echo '<br />';
   echo json_encode($products);
   echo '<br>';

    
    // Assuming this script is required for some reason
    echo '<script src="' . plugins_url('shifti-import/src/scripts/index.js') . '"></script>';
}











//////////////////////////////////////////// solution 2  by mahmoud ///////////////////////////////////////////////////////////// 
     
        // $response["images_urls"] = $gallery_images_ids;
        // foreach( $gallery_images_ids as $gallery_images_id ) 
        // {

        //     $gallery_images_id_url = wp_get_attachment_url( $gallery_images_id );
        //    $response["images_urls"] = $gallery_images_id_url;

        //     array_push($response["images_urls"] , $gallery_images_id_url);





        // //   Display the image URL
        //   echo 'praaaaaaaaaaaa3'.$gallery_images_id_url = wp_get_attachment_url( $gallery_images_id );
        //     $gallery_images_id_url = wp_get_attachment_url( $gallery_images_id );
        //     $response["images"] =  $gallery_images_id_url;
          
        // //   Display Image instead of URL
        //   echo wp_get_attachment_image($attachment_id, 'full');
        

        // }

?>













 