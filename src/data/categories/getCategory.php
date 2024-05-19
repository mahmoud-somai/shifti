<?php

function get_ctg_one(){
    global $wp_query;

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
        $categories['tenant_id'] = 'tenant_1234'; // Adding tenant_id attribute with value 'tenant_1234'
        $categories['parent']=$cat->parent;

        
        $categories['foreign_id']=$cat->term_id;
        $categories['name']=$cat->name;
        $categories['description']=$cat->description;


        $categories['level_depth'] = null;
        $categories['active'] = null;
        $categories['is_root_category'] = null;
        $categories['position'] = null;
        $categories['meta_title'] = null;
        $categories['meta_description'] = null;
        $categories['meta_keywords'] = null;
        $categories['link_rewrite'] = null;
        $categories['lang_id'] = 1;
        $categories['shop_id'] = 1;

        $category[]=$categories;  
     
   
  }


//   echo "<br>";
//   echo json_encode($category);
//   echo "<br>";
  return json_encode($category);

}
?>