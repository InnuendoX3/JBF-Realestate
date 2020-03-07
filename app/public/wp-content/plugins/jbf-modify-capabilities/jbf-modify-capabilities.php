<?php
/**
 * Plugin Name: JBF Modify Capabilities
 * Description: Disable Author for deleting/publishing objects. Disable Editor for deleting objects.
 * Version: 1.0
 * Author: Johan - Bryan - Fabian
 */


/**
 *  En author ska kunna lägga till egna object: Done
 *  redigera egna objekt:                       Done
 *  men inte publicera dem:                     Done
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
 * En editor ska kunna lägga till:  Done
 * redigera egna:                   Done
 * publicera egna:                  Done
 * avpublicera egna:                Done
 * redigera andras:                 (Admins) Done
 * publicera andras:                (Authors) Done
 * avpublicera andras:              Done
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

function modify_all_capabilities() {
    remove_author_capabilities();
    remove_editor_capabilities();
}

register_activation_hook( __FILE__, 'modify_all_capabilities' );


/**
 * Restore capabilities when desactivating plugin
 */

function restore_capabilities() {
    $author = get_role( 'author' );
    $editor = get_role( 'editor' );

    // Author's capabilites
    $author_caps = array(
        'delete_posts',
        'delete_published_posts',
        'publish_posts'
    );

    foreach ( $author_caps as $cap ) {
        $author->add_cap( $cap );
    }

    // Editor's capabilities
    $editor_caps = array(
        'delete_posts',
        'delete_published_posts'
    );

    foreach ( $editor_caps as $cap ) {
        $editor->add_cap( $cap );
    }
}

register_deactivation_hook(__FILE__, 'restore_capabilities');
