<?php
/*
Plugin Name: JFB Gallery Import
Text Domain: jbf
*/
function jbf_gallery_import($id) {

    //Get HTML data for gallery
    $html = get_post_field('post_content', $id);

    $array = explode(
        "<img src=",
        $html
    );

    $images = [];

    //Extracts URLs from image data
    foreach($array as $tag) {
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $tag, $url);

        $url = $url[0][0];

        if(!empty($url)) $images[] = $url; 
    }

    return $images;
}


