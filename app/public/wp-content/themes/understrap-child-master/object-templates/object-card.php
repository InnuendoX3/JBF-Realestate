<?php
    //Gets array of images from gallery associated with post
    $images = jbf_gallery_import(get_the_ID());
?>

<?php if(count($images) > 0) :?>
    <!-- MAIN OBJECT TEMPLATE -->
    <div class="row m-2 rounded">

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

        <?php 
        
        //Checks for a "." in the description meta and splits the description at the first "."
        $description = get_post_meta($id, 'description', true);
        ?>
        <!-- OBJECT INFO TEMPLATE -->
        <div class="col-4">
                <h3 class="testclass"><?php echo get_the_title() ?></h3>
                <span><?php echo get_post_meta($id, 'adress', true)?></span>
                <p class="text-muted"><?php echo get_post_meta($id, 'utgangsbud', true)." kr "?> 
                <span><?php echo get_post_meta($id, 'boarea', true) . " m² "?></span> 
                <span><?php echo get_post_meta($id, 'antal_rum', true) . " rum "?></span>
                </p>
                <p>
                    <?php
                        echo jbf_formatted_description($description) ."...";
                    ?>
                </p>
                <p></p>
        </div>
    </div>
<?php endif; ?>