<?php
/*
Plugin Name: JBF Search
Text Domain: jbf
*/

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

        foreach($categories as $category) {
            $categories_array[] = (array)$category;
        }
        $categories = $categories_array;
        
        $category_hierarchy = [];

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
            <form id="jbf-search">
                <select class="form-control mb-2" name="category" id="jbf-category-parents">
                    <option value="">Välj en typ av bostad</option>

                    <?php foreach($category_hierarchy as $category) : ?>
                    <option value="<?php echo $category['slug'] ?>">
                        <?php echo $category['name'] ?>
                    </option>
                    <?php endforeach; ?>

                </select>
                <div id="jbf-search-category-children">
                    <?php foreach($category_hierarchy as $category) : ?>
                        <select class="form-control mb-2 hidden" name="<?php echo $category['slug'].'-children' ?>" id="<?php echo $category['slug'].'-children' ?>">
                            <option value="">...</option>
                            <?php foreach($category['children'] as $child) : ?>
                                <option value="<?php echo $child['slug'] ?>">
                                    <?php echo $child['name'] ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
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
