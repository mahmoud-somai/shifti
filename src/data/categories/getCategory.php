<?php

function get_ctg_one(){
    global $wp_query;
    $shop_id = get_option('shifti_shop_id');
    $tenant_id = get_option('shifti_tenant_id');

    $taxonomy     = 'product_cat';
    $orderby      = 'name';  
    $show_count   = 0;      // 1 for yes, 0 for no
    $pad_counts   = 0;      // 1 for yes, 0 for no
    $hierarchical = 1;      // 1 for yes, 0 for no  
    $title        = '';  
    $empty        = 0;
  
    $args = array(
           'taxonomy'     => $taxonomy,
           'orderby'      => $orderby,
           'show_count'   => $show_count,
           'pad_counts'   => $pad_counts,
           'hierarchical' => $hierarchical,
           'title_li'     => $title,
           'hide_empty'   => $empty
    );
   $all_categories = get_categories( $args );

   $category=[];
   foreach ($all_categories as $cat) {


        $categories=[];
        $categories['tenant_id'] = $tenant_id; // Adding tenant_id attribute with value 'tenant_1234'
        $categories['parent']=$cat->parent;

        
        
        $categories['foreign_id']=$cat->term_id;
        $categories['name']=$cat->name;
        $categories['description']=$cat->description;



        $categories['lang_id'] = 1;
        $categories['shop_id'] = (int)$shop_id;

        $category[]=$categories;  
     
   
  }


//   echo "<br>";
//   echo json_encode($category);
//   echo "<br>";

  return json_encode($category);
  

}
?>
