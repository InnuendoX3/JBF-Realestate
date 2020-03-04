<?php
/**
 * Plugin Name: JBF Capabilities (Remove)
 * Description: Disable Author for publishing objects. Disable Editor for deleting objects.
 * Version: 1.0
 * Author: Johan - Bryan - Fabian
 */

add_action( 'init', 'remove_author_capabilities' );

function remove_author_capabilities() {

    $author = get_role( 'author' );

    $caps = array(
        'delete_posts',
        'delete_published_posts',
    );

    foreach ( $caps as $cap ) {
        $author->remove_cap( $cap );
    }
}