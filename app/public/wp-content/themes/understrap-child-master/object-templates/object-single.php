<?php
$id = get_the_ID();

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
?>

        <!-- OBJECT INFO TEMPLATE -->
        <div class="col-4">
                <p class="text-muted"><?php echo get_post_meta($id, 'utgangsbud', true)." kr"?></p>
                <h3 class="testclass"><?php echo get_the_title() ?></h3>
                <p>Hola Como estas??</p>
        </div>

<?php if(count($images) > 0) :?>
    <!-- MAIN OBJECT TEMPLATE -->
    <div class="row rounded">

        <!-- IMAGE CAROUSEL TEMPLATE -->
        <div class="col">
            <div id="<?php echo "object".$id?>" class="carousel slide" data-ride="carousel" style="width: 100%"> 
                <div class="carousel-inner">

                    <?php foreach($images as $i => $img) : ?>
                        <div 
                            class = "
                                carousel-item 
                                <?php echo $i == 0 ? "active" : ""?>" 
                            style = "
                                height: 500px; 
                                background: url(<?php echo $img ?>); 
                                background-size: cover; 
                                background-position: center"
                            >
                        </div>
                    <?php endforeach; ?>

                </div>

                <a class="carousel-control-prev" href="<?php echo "#object".$id ?>"  role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="<?php echo "#object".$id ?>"  role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </div>
<?php endif; ?>