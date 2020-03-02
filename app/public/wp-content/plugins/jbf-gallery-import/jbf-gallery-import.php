<?php
/*
Plugin Name: JFB Gallery Import
Text Domain: jbf
*/
function jbf_gallery_import($id) {

    $post_content = get_post($id);
    $content = $post_content->post_content;

    //Get HTML data for galleries associated with post
    $html = apply_filters('the_content', $content);


    $tags = "";
    //If gallery tag present
    if(strpos("<!-- wp:gallery", $html)) {
        //Breaks out individual galleries if present
        $galleries = explode("<!-- wp:gallery", $html);

        //Breaks out the latest gallery
        $tags = $galleries[count($galleries -1)];
    } else {
        $tags = $html;
    }

    //Breaks out image tags
    $tags = explode(
        "<img src=",
        $tags
    );

    $images = [];

    //Extracts URLs from image data
    foreach($tags as $tag) {
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $tag, $url);

        $url = $url[0][0];

        if(!empty($url)) $images[] = $url; 
    }

    var_dump($images);
    
    return $images;
}


