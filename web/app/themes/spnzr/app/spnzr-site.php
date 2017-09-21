<?php 


/************* Use Categories to output article classes *********************/
function spnzr_the_post_classes($more = null, $id = null){
  if( empty($id) ){
    global $post;
    $id = $post->ID;
  }
  $cats = get_the_terms($id,'category');
  $bgs = get_the_terms($id,'spnzr_bgs');
  if( !empty($cats) || !empty($bgs) || !empty($more) ){
    $output = "class='";
    }
    if(!empty($cats)){
    foreach ($cats as $cat)
      $output .= $cat->slug . " ";
    }
    if(!empty($bgs)){
    foreach ($bgs as $bg)
      $output .= $bg->slug . " ";
    }
  if ($more)
    $output .= $more . " ";
    if (isset($output)){
     $output .= "'";
       echo $output;
    }
}

function spnzr_the_bgs($id = null){
    if( empty($id) ){
        global $post;
        $id = $post->ID;
    }
    $output = "class='";
    $bgs = get_the_terms($id,'spnzr_bgs');
    if(!empty($bgs)){
        foreach ($bgs as $bg)
            $output .= $bg->slug . " ";
    }
    $output .= "'";
    echo $output;
}



/************* Custom BG Taxonomy *********************/
/*
 * add bg classes to post
 * echo bg classes on article 
 * apply bg in CSS
 */

add_action( 'init', 'register_taxonomy_spnzr_bgs' );

function register_taxonomy_spnzr_bgs() {

    $labels = array( 
        'name' => _x( 'spnzr_bgs', 'spnzr_bgs' ),
        'singular_name' => _x( 'Backgrounds', 'spnzr_bgs' ),
        'search_items' => _x( 'Search spnzr_bgs', 'spnzr_bgs' ),
        'popular_items' => _x( 'Popular spnzr_bgs', 'spnzr_bgs' ),
        'all_items' => _x( 'All spnzr_bgs', 'spnzr_bgs' ),
        'parent_item' => _x( 'Parent spnzr_bg', 'spnzr_bgs' ),
        'parent_item_colon' => _x( 'Parent spnzr_bg:', 'spnzr_bgs' ),
        'edit_item' => _x( 'Edit spnzr_bg', 'spnzr_bgs' ),
        'update_item' => _x( 'Update spnzr_bg', 'spnzr_bgs' ),
        'add_new_item' => _x( 'Add New spnzr_bg', 'spnzr_bgs' ),
        'new_item_name' => _x( 'New spnzr_bg', 'spnzr_bgs' ),
        'separate_items_with_commas' => _x( 'Separate spnzr_bgs with commas', 'spnzr_bgs' ),
        'add_or_remove_items' => _x( 'Add or remove spnzr_bgs', 'spnzr_bgs' ),
        'choose_from_most_used' => _x( 'Choose from most used spnzr_bgs', 'spnzr_bgs' ),
        'menu_name' => _x( 'spnzr_bgs', 'spnzr_bgs' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => false,
        'hierarchical' => false,

        'rewrite' => true,
        'query_var' => false
    );

    register_taxonomy( 'spnzr_bgs', array('post'), $args );
}



/************* Remove 'Protected' *********************/
/*
 * remove Protected from titles of Protected posts
 *
 */

add_filter('protected_title_format', 'blank');
function blank($title) {
       return '%s';
}

