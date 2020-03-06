<?php
/**
 * Plugin Name: JBF Object Tags
 * Description: Registers tags for JBF Object
 * Version: 1.0
 * Author: Johan - Bryan - Fabian
 */

add_action( 'init', 'gp_register_taxonomy_for_object_type' );
function gp_register_taxonomy_for_object_type() {
    register_taxonomy_for_object_type( 'post_tag', 'object' );
};