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

<!-- Behöver vi titeln? -->
<div class="col">
    <h3 class="testclass"><?php // echo get_the_title() ?></h3>
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
<div class="row my-3">
    <div class="col-8">
        <h3 class="testclass"><?php echo get_post_meta($id, 'adress', true) ?></h3>
    </div>
    <div class="col-4 text-right">
        <p class="text-muted"><?php echo get_post_meta($id, 'utgangsbud', true)." kr"?></p>
    </div>
</div>
<div class="row">
    <table class="table">
        <tbody>
            <tr>
                <td>Visnigsdatum</td>
                <td><?php echo get_post_meta($id, 'visningsdatum', true) ?></td>
            </tr>
            <tr>
                <td>Antal rum</td>
                <td><?php echo get_post_meta($id, 'antal_rum', true) . " rum"?></td>
            </tr>
            <tr>
                <td>Boarea</td>
                <td><?php echo get_post_meta($id, 'boarea', true) . " m²"?></td>
            </tr>
            <tr>
                <td>Title - Just for reference</td>
                <td><?php echo get_the_title() ?></td>
            </tr>
        </tbody>

    </table>

    <p class="text-muted"><?php // var_dump(the_meta()); ?></p>
</div>