<?php
/**
 * Plugin Name: JBF Capabilities (Add)
 * Description: Enable Author for deleting/publishing objects. Enable Editor for deleting objects.
 * Version: 1.0
 * Author: Johan - Bryan - Fabian
 */

add_action( 'init', 'add_author_capabilities' );

function add_author_capabilities() {

    $author = get_role( 'author' );

    $caps = array(
        'delete_posts',
        'delete_published_posts',
        'publish_posts'
    );

    foreach ( $caps as $cap ) {

        $author->add_cap( $cap );
    }
}