<?php
/*
Plugin Name: JFB Gallery Import
Text Domain: jbf
*/
function jbf_gallery_import($id) {

    $post_content = get_post($id);
    $content = $post_content->post_content;

    //Get HTML data for gallery
    $html = apply_filters('the_content',$content);

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

    var_dump($images);
    
    return $images;
}


