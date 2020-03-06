<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
		<div class="row w-100">
        
            <div class="col-md-8 w-100">
                <main class="site-main w-100" id="main">
                    <?php 
                    $category = get_queried_object()->slug;
                    $args = [
                        'post_type' => 'object',
                        'posts_per_page' => 1,
                        'post_status' => 'publish',
                        'category_name' => $category,
                        'meta_key' => 'utvalt_objekt',
                        'meta_value' => true
                    ];

                    $query_loop = new WP_Query( $args );

                    $chosen_ID = $query_loop->posts[0]->ID;
                    ?>

                    <?php while($query_loop->have_posts()) : ?>
                        <?php $query_loop->the_post(); ?>
                            <?php get_template_part('object-templates/object-chosen'); ?>
                    <?php endwhile; 

                    wp_reset_postdata();

                    while (have_posts()) :
                        the_post();

                        if(get_the_ID() !== $chosen_ID) {
                            get_template_part('object-templates/object-card');
                        }

                    endwhile;

                    ?>

                </main><!-- #main -->

                <!-- The pagination component -->
                <?php understrap_pagination(); ?>

            </div><!-- .col -->

            <!-- Do the left sidebar check and opens the primary div -->
            <?php get_template_part( 'global-templates/jbf-sidebar-check' ); ?>
            
		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer(); ?>