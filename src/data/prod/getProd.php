<?php

function get_prod(){
    global $wpdb;
    $args = [
        'status' => 'publish',
      ];
      
      $products = wc_get_products($args);
      
    

    echo "<h2>Products</h2>";
    echo json_encode($products);
    echo "<br>";

    foreach ($products as $product) {
        echo "<h2>Prod</h2>";
        echo json_encode($product);
        echo "<br>";
    }

}
?>