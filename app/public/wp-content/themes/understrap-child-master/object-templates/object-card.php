<?php
    //Gets array of images from gallery associated with post
    $images = jbf_gallery_import(get_the_ID());
?>

<?php if(count($images) > 0) :?>
    <!-- MAIN OBJECT TEMPLATE -->
    <script src="https://kit.fontawesome.com/fcc82c8a72.js" crossorigin="anonymous"></script>
    <div class="row rounded object-container">

        <!-- IMAGE CAROUSEL TEMPLATE -->
        <div class="col-8">
            <div id="<?php echo "object".$id?>" class="carousel slide" data-ride="carousel" style="width: 100%">
                <div class="carousel-inner"> 
                    <a href="<?php the_permalink(); ?>">

                    <?php foreach($images as $i => $img) : ?>
                        <div 
                            class = "
                                carousel-item 
                                jbf-carousel-img
                                <?php echo $i == 0 ? "active" : ""?>" 
                            style = "
                                height: 249px;
                                background: url(<?php echo $img ?>);
                                background-size: cover;
                                background-position: center"
                            >
                        </div>
                    <?php endforeach; ?>
                    </a>
                </div>

                <a class="carousel-control-prev next-object" href="<?php echo "#object".$id ?>"  role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                
                <a class="carousel-control-next next-object" href="<?php echo "#object".$id ?>"  role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><br>
        </div> 

        <?php 
        
        //Checks for a "." in the description meta and splits the description at the first "."
        $description = get_post_meta($id, 'description', true);
        ?>
        <!-- OBJECT INFO TEMPLATE -->
        <div class="col-4 object-info-container overflow-auto">
                <h3 class="testclass"><a class="object-title" href="<?php the_permalink(); ?>"><?php echo get_the_title();?></h3></a>
                <span class="adress"><i class="fas fa-home"></i> <?php echo get_post_meta($id, 'adress', true)?> </span>
            <div>
                <span class="utgangsbud"><?php echo get_post_meta($id, 'utgangsbud', true)." kr "?> </span>
                <span class="boarea"><?php echo get_post_meta($id, 'boarea', true) . " m² "?> </span>
                <span class="antal-rum"><?php echo get_post_meta($id, 'antal_rum', true) . " rum "?></span>
            </div> <br>
                <p class="description">
                    <?php
                        echo jbf_formatted_description($description) . ".";
                    ?>
                </p>
                <p></p>
        </div>
    </div>
<?php endif; ?>