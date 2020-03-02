<?php
    $images = jbf_gallery_import(get_the_ID());
?>

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
        function decoded_description($id, $description)
        {
            function multineedle_stripos($haystack, $needles, $offset = 0)
            {
                foreach ($needles as $needle) {
                    $found[$needle] = stripos($haystack, $needle, $offset);
                }
                return $found;
            }
            
            $str1 = "";
            if ($description) {
                $find_me = array('.', '?', '!');
                $position = multineedle_stripos($description, $find_me);
                $split_description = -(strlen($description) - $position['.']);
                $str1 = substr($description, 0, $split_description);
            }
            return $str1;
        }

        ?>
        <!-- OBJECT INFO TEMPLATE -->
        <div class="col-4">
                <h3 class="testclass"><?php echo get_the_title() ?></h3>
                <span><?php echo get_post_meta($id, 'adress', true)?></span>
                <p class="text-muted"><?php echo get_post_meta($id, 'utgangsbud', true)." kr "?> 
                <span><?php echo get_post_meta($id, 'boarea', true) . " m² "?></span> 
                <span><?php echo get_post_meta($id, 'antal_rum', true) . " rum "?></span>
                </p>
                <p><?php
                    //echo decoded_description($id, $description) ."...";?></p>
                <p></p>
        </div>
    </div>
<?php endif; ?>