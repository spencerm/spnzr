<?php

namespace App;

/**
 * Add acf pro data to templates
 */
add_filter('sage/template/page/data', function (array $data) {
    $data['subheading'] = get_field('sub-heading');
    return $data;
});



add_filter( 'post_class', function( $classes ) {
    $out = array ();

    foreach ( $classes as &$class )
    {
        if ( 0 === strpos( $class, 'spnzr_bgs-' ) )
        {
            $class = substr( $class, 10 );
        }
    }

    return array_unique( $classes );
});
/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add spnzr bg classes if exist */
    if (is_single() || is_page()){
        $bgs = get_the_terms(get_the_ID(),'spnzr_bgs');
        if(!empty($bgs)){
            foreach ($bgs as $bg){
                $classes[] = $bg->slug;
            }
        }
    } 
    if (is_single()){
        foreach(get_the_category() as $category) {
            $classes[] = $category->category_nicename;
        }
    }

    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );
    return template_path(locate_template(["views/{$comments_template}", $comments_template]) ?: $comments_template);
});

/*
 * remove Protected from titles of Protected posts
 */
add_filter('protected_title_format', function($title) {
       return '%s';
});

/**
 * Lazy Load
 * filter for plugin
 **/
add_filter('the_content', function ($content) {
    // Smallest, most stable, 1 by 1 pixel transparent image
    $placeholder = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';   
    /*images*/ 
    if( class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( 'photon', Jetpack::get_active_modules() ) ) {
        // cheap funtion. is not comprehensive. is fast?
        $img_src = substr( $img_src , 7 );
        $img_src = "http://i1.wp.com/" . $img_src;
    }
    $content = preg_replace('#<img([^>]+?)src=\'http:\/\/[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', sprintf('<img${1}src="%s" data-original="http://i1.wp.com/${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $placeholder), $content);
    /*iframes*/
  /*  $matches = array();
    preg_match_all( '/<iframe\s+.*?>/', $content, $matches );
    $search = array();
    $replace = array();
    foreach ( $matches[0] as $iframeHTML ) {
        // Don't mess with the Gravity Forms ajax iframe
        if ( strpos( $iframeHTML, 'gform_ajax_frame' ) ) {
            continue;
        }
        $replaceHTML = '<div class="lazy-iframe"><iframe src='' data-src="' . base64_encode($iframeHTML) . '"><i class="fa fa-play fa-4x"></i><p><b>click here to play video</b></p></div>';
        $replaceHTML = '<p>cats</p>';
        array_push( $search, $iframeHTML );
        array_push( $replace, $replaceHTML );
    }*/
    // $content = str_replace( $search, $replace, $content );
    /*fin*/
    return $content;
});

/**
 * Lyte CSS
 * 
 **/

add_filter('lyte_css', function($lyte_css) {
    global $lynited;
    $lynited=true;
    return $lyte_css = null;
}, 10,10);

