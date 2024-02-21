<?php



function get_orders() {
    global $wpdb;

    $query = "
      SELECT *
      FROM wp_posts p
      WHERE p.post_type = 'order'
    ";
    
    $results = $wpdb->get_results($query);
    
    $params = array(
        'posts_per_page' => 1,
        'post_type' => 'order'
    );

    $wc_query = new WP_Query($params); 

    $orders = [];

    if ($wc_query->have_posts()) {
        while ($wc_query->have_posts()) {
            $wc_query->the_post();
            $order_id = get_the_ID();
           
            echo $order;
            echo '<br />';


            $new_order_object['id'] = $order_id;
            array_push($orders, $new_product_object);
        }

        wp_reset_postdata(); // Reset the post data
    }
    echo '<br />';
    echo json_encode($orders);

    
    // Assuming this script is required for some reason
    echo '<script src="' . plugins_url('shifti-import/src/scripts/index.js') . '"></script>';
}


?>













 