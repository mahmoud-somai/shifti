<?php

function get_ctg(){
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
        $imgs=[];

        $categories['id']=$cat->term_id;
        $categories['name']=$cat->name;
        $categories['slug']=$cat->slug;
        $categories['parent']=$cat->parent;
        $categories['description']=$cat->description;
        $categories['display']=$cat->display;
        $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        $imgs['id']=$thumbnail_id;
        $imgs['src']=$image;
        $categories['menu_order']=$cat->menu_order;
        $categories['count']=$cat->count;
        
        $categories['image']=$imgs;
        $category[]=$categories;  
  }


//   echo "<br>";
//   echo json_encode($category);
//   echo "<br>";
  return json_encode($category);

}
?>
