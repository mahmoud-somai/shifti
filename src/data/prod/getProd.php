<?php

function get_prod(){

    global $wpdb;

    $args = array(
        'limit' => -1,
        'status'=> array( 'draft', 'pending', 'private', 'publish' ),
    );

    $products = wc_get_products($args);
    
   // echo "<h2>Products</h2>";


    $tab_prod=[];

    foreach ($products as $product) {

        $download_tab=array();
        $dimensions_tab=array();
        $categories_tab=array();
        $tags_tab=array();
        $images_tab=array();
        $attributes_tab=array();
        $default_attributes_tab=array();

        $temp_prod=array();

        $categories = $product->get_category_ids();

        foreach ($categories as $category_id) {
            $category = get_term($category_id, 'product_cat');
            if (!is_wp_error($category)) {
                $category_data = array(
                    'id_category' => $category->term_id,
                    'name_category' => $category->name,
                    'slug_category' => $category->slug
                );
                $categories_tab[] = $category_data;
            }
        }
       

        $dimensions = $product->get_dimensions();
            if ( ! empty( $dimensions ) ) {
                $dimensions_tab['height']= $product->get_height();
                $dimensions_tab['width'] =$product->get_width();
                $dimensions_tab['length'] =$product->get_width();      
            }

        $tags = $product->get_tag_ids();
       
        foreach ($tags as $tag_id) {
            $tag = get_term($tag_id, 'product_tag');
            if (!is_wp_error($tag)) {
                $tag_data = array(
                    'id' => $tag->term_id,
                    'name' => $tag->name,
                    'slug' => $tag->slug
                );
            $tags_tab[] = $tag_data;
            }
        }

        $attributes = $product->get_attributes();
        foreach ($attributes as $attribute) {
            $attribute_data = array(
                'id' => $attribute->get_id(),
                'name' => $attribute->get_name(),
                'position' => $attribute->get_position(),
                //'visible' => $attribute->is_visible(),
               // 'variation' => $attribute->is_variation(),
               // 'options' => $attribute->get_options()
            );
            $attributes_tab[] = $attribute_data;
        }

        $default_attributes = $product->get_default_attributes();

        foreach ($default_attributes as $name => $option) {
            $attribute_term = get_term_by('slug', $option, $name);
            if ($attribute_term) {
                $default_attribute_data = array(
                    'id' => $attribute_term->term_id,
                    'name' => $attribute_term->name,
                    'option' => $option
                );
                $default_attributes_tab[] = $default_attribute_data;
            }
        }

        $image_ids = $product->get_gallery_image_ids();

        foreach ($image_ids as $image_id) {
            $image = wp_get_attachment_image_src($image_id, 'full');
            $image_data = array(
                'id' => $image_id,
                'name' => get_post_field('post_title', $image_id),
                'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true),
                'src' => $image[0],
                'date_created' => get_the_date('Y-m-d H:i:s', $image_id),
                'date_modified' => get_the_modified_date('Y-m-d H:i:s', $image_id)
            );
            $images_tab[] = $image_data;
        }
        

        $downloads = $product->get_downloads();

        foreach ($downloads as $download) {
            $download_data = array(
                'id' => $download->get_id(),
                'name' => $download->get_name(),
                'file' => $download['file'],
            );
            $download_tab[] = $download_data;
        }

                    
        $temp_prod['id']=$product->get_id();
        $temp_prod['name']=$product->get_name();
        $temp_prod['slug']=$product->get_slug();
        $temp_prod['permalink']=$product->get_permalink();
        $temp_prod['date_created']=$product->get_date_created()->date('Y-m-d H:i:s');
        $temp_prod['date_modified']=$product->get_date_modified()->date('Y-m-d H:i:s');
        $temp_prod['type']=$product->get_type(); 
        $temp_prod['status']=$product->get_status();
        $temp_prod['catalog visibility']=$product->get_catalog_visibility();
        $temp_prod['description']=$product->get_description();
        $temp_prod['short_description']=$product->get_short_description();
        $temp_prod['sku']=$product->get_sku();
        $temp_prod['price']=$product->get_price();
        $temp_prod['regular_price']=$product->get_regular_price();
        $temp_prod['sale_price']=$product->get_sale_price();
        $temp_prod['date_on_sale_from']=$product->get_date_on_sale_from();
        $temp_prod['date_on_sale_to']=$product->get_date_on_sale_to();
        $temp_prod['on_sale']=$product->is_on_sale();
        $temp_prod['purchasable']=$product->is_purchasable();
        $temp_prod['total_sales']=$product->get_total_sales();
        $temp_prod['virtual']=$product->is_virtual();
        $temp_prod['downloadable']=$product->is_downloadable();


       $temp_prod['downloads']=$download_tab;



        $temp_prod['download_limit']=$product->get_download_limit();
        $temp_prod['download_expiry']=$product->get_download_expiry();
        //$temp_prod['external_url']=$product->get_external_url();
        //$temp_prod['button_text']=$product->get_button_text();
        $temp_prod['tax_status']=$product->get_tax_status();
        $temp_prod['tax_class']=$product->get_tax_class();
        $temp_prod['manage_stock']=$product->managing_stock();
        $temp_prod['stock_quantity']=$product->get_stock_quantity();
        $temp_prod['stock_status']=$product->get_stock_status();
        $temp_prod['backorders']=$product->get_backorders();
        $temp_prod['backorders_allowed']=$product->backorders_allowed();
        $temp_prod['sold_individually']=$product->is_sold_individually();
        $temp_prod['weight']=$product->get_weight();

        $temp_prod['dimensions']=$dimensions_tab;


        $temp_prod['shipping_required']=$product->needs_shipping();
        $temp_prod['shipping_taxable']=$product->is_shipping_taxable();
        $temp_prod['shipping_class']=$product->get_shipping_class();
        $temp_prod['shipping_class_id']=$product->get_shipping_class_id();
        $temp_prod['reviews_allowed']=$product->get_reviews_allowed();
        $temp_prod['average_rating']=$product->get_average_rating();
        $temp_prod['rating_count']=$product->get_rating_count();
        $temp_prod['related_ids']=$product->get_related();
        $temp_prod['upsell_ids']=$product->get_upsell_ids();
        $temp_prod['cross_sell_ids']=$product->get_cross_sell_ids();
        $temp_prod['parent_id']=$product->get_parent_id();
        $temp_prod['purchase_note']=$product->get_purchase_note();


        $temp_prod['categories'] = $categories_tab;



        $temp_prod['tags'] = $tags_tab;

 

        $temp_prod['images']=$images_tab;


        $temp_prod['attributes']=$attributes_tab;


        $temp_prod['default_attributes']=$default_attributes_tab;


        $temp_prod['variations']=$product->get_children();
        $temp_prod['grouped_products']=$product->get_children();
        $temp_prod['menu_order']=$product->get_menu_order();





        



        $tab_prod[] = $temp_prod;
    }

    //echo json_encode($tab_prod);
    return json_encode($tab_prod);
}
?>
