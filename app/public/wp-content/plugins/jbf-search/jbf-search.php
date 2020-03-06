<?php
/*
Plugin Name: JBF Search
Text Domain: jbf
*/

// Wipe out rules for search permalink structure on every page load, in case the
// rules are flushed by WP core, another plugin, a user visiting Settings -> Permalinks.
add_action( 'init', function() {
    add_filter( 'search_rewrite_rules', '__return_empty_array' );
} );

register_activation_hook( __FILE__ , function() {
    // Wipe out the rules for search permalink structure, on plugin activation.
    add_filter( 'search_rewrite_rules', '__return_empty_array' );
    flush_rewrite_rules();
} );

register_deactivation_hook( __FILE__ , function() {
    // Undo the change in rules to search rules, and flush the rules, on plugin deactivation.
    remove_filter( 'search_rewrite_rules', '__return_empty_array' );
    flush_rewrite_rules();
} );

// Register and load the widget
function jbf_load_search()
{
    register_widget('jbf_search');
}

add_action('widgets_init', 'jbf_load_search');

function jbf_load_script() {
    wp_enqueue_script( 'jbf.js', plugins_url( '/js/jbf.js', __FILE__ ));
}

add_action('wp_enqueue_scripts','jbf_load_script');

// Creating the widget 
class jbf_search extends WP_Widget
{

    function __construct()
    {
        parent::__construct(

            // Base ID of your widget
            'jbf_search',

            // Widget name will appear in UI
            __('JBF Search', 'jbf'),

            // Widget description
            array('description' => __('JBF realestate object search', 'jbf'),)
        );
    }

    // Creating widget front-end

    public function widget($args, $instance)
    {

        $categories = get_categories();
        $categories_array = [];
        $category_hierarchy = [];

        foreach($categories as $category) {
            $categories_array[] = (array)$category;
        }
        $categories = $categories_array;

        foreach($categories as $category) {
            if($category['category_parent'] === 0 && $category['slug'] !== 'uncategorized') {
                $category['children'] = [];
                $category_hierarchy[] = $category;
            }
        }

        foreach($category_hierarchy as $key => $parent) {
            foreach($categories as $category) {
                if($category['category_parent'] === $parent['term_id']) {
                    $category_hierarchy[$key]['children'][] = $category;
                }
            }
        }

        ?>
            <h5>Sök</h5>
            <form method="GET" action="<?php echo get_site_url() ?>" id="jbf-search">
                <input type="hidden" name="s" value="">
                <input type="hidden" name="post_type" value="object">

                <!-- PARENT CATEGORY RENDERING -->
                <select class="form-control mb-2" name="cat" id="jbf-category-parents">
                    <option value="">Välj en typ av bostad</option>

                    <?php foreach($category_hierarchy as $category) : ?>
                    <option value="<?php echo $category['term_id'] ?>">
                        <?php echo $category['name'] ?>
                    </option>
                    <?php endforeach; ?>

                </select>

                <!-- CHILD CATEGORY RENDERING -->
                <div id="jbf-search-category-children">
                    <?php foreach($category_hierarchy as $category) : ?>
                        <select class="form-control mb-2 hidden" name="cat" id="<?php echo $category['term_id'].'-child' ?>">
                            <option value="">...</option>
                            <?php foreach($category['children'] as $child) : ?>
                                <option value="<?php echo $child['term_id'] ?>">
                                    <?php echo $child['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endforeach; ?>
                </div>


        <?php

        $tags = get_terms( 'post_tag', array(
            'hide_empty' => false,
        ));

        ?>
            <div id="jbf-search-tags" class="">
            <?php foreach($tags as $key => $tag) : ?>
                
                <span class="jbf-checkbox">
                    <input 
                        type="input" 
                        class="hidden"
                        name="<?php echo "tax".($key) ?>"
                        value="<?php echo $tag->slug ?>"
                        disabled
                        id="<?php echo $tag->slug.'-tag'?>">
                    <label 
                        class="btn" 
                        for="<?php echo $tag->slug.'-tag'?>">
                        <?php echo $tag->name ?>
                    </label>
                </span>
            <?php endforeach; ?>
            </div>

            <input type="submit" class="btn btn-primary w-100" value="Sök">
            </form>
        <?php
    }

    // Widget Backend 
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'jbf');
        }

        // Widget admin form
        ?>
                <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
} // Class wpb_widget ends here
