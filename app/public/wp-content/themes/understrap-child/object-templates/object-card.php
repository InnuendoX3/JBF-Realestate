<?php
//Gets gallery URLs
$children = get_children([
    'post_parent' => get_the_ID(),
    'post_status' => 'inherit',
    'post_type' => 'attachment',
]);

$id = get_the_ID();

$images = [];

foreach ($children as $img) $images[] = (array)$img; ?>

<?php if(count($images) > 0) :?>
    <!-- MAIN OBJECT TEMPLATE -->
    <div class="row rounded">

        <!-- IMAGE CAROUSEL TEMPLATE -->
        <div class="col-8">
            <div id="<?php echo "object".$id?>" class="carousel slide" data-ride="carousel" style="width: 100%"> 
                <div class="carousel-inner">

                <?php foreach($images as $i => $img) : ?>
                    <div 
                        class = "
                            carousel-item 
                            <?php echo $i == 0 ? "active" : ""?>" 
                        style = "
                            height: 500px; 
                            background: url(<?php echo $img['guid'] ?>); 
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

        <!-- OBJECT INFO TEMPLATE -->
        <div class="col-4">
                <h3><?php echo get_the_title() ?></h3>
                <p class="text-muted"><?php echo get_post_meta($id, 'utgangsbud', true)." kr"?></p>
                <p></p>
        </div>
    </div>
<?php endif; ?>