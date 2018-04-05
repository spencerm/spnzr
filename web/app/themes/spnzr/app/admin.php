<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

/************* Custom BG Tx *********************/
/*
 * add bg classes to post
 * echo bg classes on article 
 * apply bg in CSS
 */

add_action( 'init', function() {
    $labels = array( 
        'name' => _x( 'spnzr_bgs', 'spnzr_bgs' ),
        'singular_name' => _x( 'spnzr_bg', 'spnzr_bgs' ),
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
);
