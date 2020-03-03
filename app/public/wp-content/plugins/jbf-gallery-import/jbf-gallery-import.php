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
    foreach ($tags as $tag) {
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $tag, $url);

        $url = $url[0][0];

        if (!empty($url)) $images[] = $url;
    }

    //var_dump($images);
    
    return $images;
}
//Splits the descrition on the object card after 100 characters on the first dot it can find.
function jbf_formatted_description($description)
{
    $desc = "";
    $desc_start = substr($description, 0, 100);

    $desc_for_filter = substr(
        $description,
        -(strlen($description) - strlen($desc_start))
    );

    if (strlen($desc_for_filter) > 0) {
        $find_me = '.';
        $position = stripos($desc_for_filter, $find_me);
        $split_description = -(strlen($desc_for_filter) - $position);
        $desc = $desc_start.substr($desc_for_filter, 0, $split_description);
    }

    //var_dump($desc);
    return $desc;
}
