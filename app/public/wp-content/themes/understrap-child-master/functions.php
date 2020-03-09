<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

function load_objects( $query ) {
    if (is_admin() || !$query->is_main_query()) {
        return $query;
    }

    if(is_search()) {
        $query->set( 's', false);
        $query->set( 'post_type', array( 'object' ) );
        $query->set( 'posts_per_page', 5 );
        $query->set( 'post_status', 'publish' ); 

        $tax_query = $query->tax_query;

        //var_dump($_GET);

        $tags = [];

        foreach($_GET as $key => $value) {
            if(strpos($key, 'tax') !== false) {
                $tags[] = (int)str_replace('tax', '', $key);
            }
        }
        
        /*$tax_query->queries[] = array(
            array(
                'taxonomy'         => 'post_tag',
                'terms'            => $tags,
                'field'            => 'term_id',
                'operator'         => 'AND',
                'include_children' => false
            ),
        );*/

        $query->set('tag__in', $tags);
        
        var_dump($query->tax_query->queries);
        //$tax_query[0]['taxonomy'] .= ",";
        
        //var_dump($tax_query);
    } else if ( $query->is_front_page() && $query->is_main_query() && !is_search()) {
        $query->set( 'post_type', array( 'object' ) );
        $query->set( 'posts_per_page', 5 );
        $query->set( 'post_status', 'publish' );
        $query->set( 'meta_key', 'utvalt_objekt' );
        $query->set( 'meta_value', true );
    }

    $qobj = get_queried_object();
    if (isset($qobj->taxonomy) && 'category' == $qobj->taxonomy ) {
        $query->set('category_name', $qobj->slug);
        $query->set( 'post_type', array( 'object' ) );
        $query->set( 'posts_per_page', 5 );
        $query->set( 'post_status', 'publish' );
    }
}
add_action( 'pre_get_posts', 'load_objects' );

function jbf_load_fontawesome()
{
    wp_enqueue_script('fcc82c8a72.js', 'https://kit.fontawesome.com/fcc82c8a72.js');
}
add_action('wp_enqueue_scripts','jbf_load_fontawesome');