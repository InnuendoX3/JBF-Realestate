<?php
/**
 * Plugin Name: JBF Capabilities (Remove)
 * Description: Disable Author for deleting/publishing objects. Disable Editor for deleting objects.
 * Version: 1.0
 * Author: Johan - Bryan - Fabian
 */


/** 
 *  En author ska kunna lägga till och redigera egna objekt 
 *  men inte publicera dem.
 */
function remove_author_capabilities() {

    $author = get_role( 'author' );

    $caps = array(
        'delete_posts',
        'delete_published_posts',
        'publish_posts'
    );

    foreach ( $caps as $cap ) {
        $author->remove_cap( $cap );
    }
}


/**
 * En editor ska kunna lägga till, redigera och publicera/avpublicera 
 * egna och andras objekt.
 */
function remove_editor_capabilities() {

    $editor = get_role( 'editor' );

    $caps = array(
        'delete_posts',
        'delete_published_posts'
    );

    foreach ( $caps as $cap ) {
        $editor->remove_cap( $cap );
    }
}

add_action( 'init', 'remove_author_capabilities' );
add_action( 'init', 'remove_editor_capabilities' );
