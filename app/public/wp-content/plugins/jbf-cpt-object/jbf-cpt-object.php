<?php
/**
 * Plugin Name: JBF Object - Custom Post Type
 * Description: Custom Post Type for the JBF Object
 * Version: 1.2
 * Author: Johan - Bryan - Fabian
 */

function cptui_register_my_cpts() {

    /**
     * Post Type: Objects.
     */

    $labels = [
        "name" => __( "Objects", "understrap-child" ),
        "singular_name" => __( "Object", "understrap-child" ),
        "menu_name" => __( "Objects", "understrap-child" ),
        "all_items" => __( "All Objects", "understrap-child" ),
        "add_new" => __( "Add new", "understrap-child" ),
        "add_new_item" => __( "Add new Object", "understrap-child" ),
        "edit_item" => __( "Edit Object", "understrap-child" ),
        "new_item" => __( "New Object", "understrap-child" ),
        "view_item" => __( "View Object", "understrap-child" ),
        "view_items" => __( "View Objects", "understrap-child" ),
        "search_items" => __( "Search Objects", "understrap-child" ),
        "not_found" => __( "No Objects found", "understrap-child" ),
        "not_found_in_trash" => __( "No Objects found in trash", "understrap-child" ),
        "parent" => __( "Parent Object:", "understrap-child" ),
        "featured_image" => __( "Featured image for this Object", "understrap-child" ),
        "set_featured_image" => __( "Set featured image for this Object", "understrap-child" ),
        "remove_featured_image" => __( "Remove featured image for this Object", "understrap-child" ),
        "use_featured_image" => __( "Use as featured image for this Object", "understrap-child" ),
        "archives" => __( "Object archives", "understrap-child" ),
        "insert_into_item" => __( "Insert into Object", "understrap-child" ),
        "uploaded_to_this_item" => __( "Upload to this Object", "understrap-child" ),
        "filter_items_list" => __( "Filter Objects list", "understrap-child" ),
        "items_list_navigation" => __( "Objects list navigation", "understrap-child" ),
        "items_list" => __( "Objects list", "understrap-child" ),
        "attributes" => __( "Objects attributes", "understrap-child" ),
        "name_admin_bar" => __( "Object", "understrap-child" ),
        "item_published" => __( "Object published", "understrap-child" ),
        "item_published_privately" => __( "Object published privately.", "understrap-child" ),
        "item_reverted_to_draft" => __( "Object reverted to draft.", "understrap-child" ),
        "item_scheduled" => __( "Object scheduled", "understrap-child" ),
        "item_updated" => __( "Object updated.", "understrap-child" ),
        "parent_item_colon" => __( "Parent Object:", "understrap-child" ),
    ];

    $args = [
        "label" => __( "Objects", "understrap-child" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "object", "with_front" => true ],
        "query_var" => true,
        "supports" => [ "title", "editor", "thumbnail", "custom-fields", "author" ],
        "taxonomies" => [ "category", "post_tag" ],
    ];

    register_post_type( "object", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

