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
    	<div class="row">
        
            <div class="col-md-8">
                <br>
                <main class="site-main" id="main">

                    <?php 
                    
                    //Get all objects
                    $args = array(
                        'post_type'      => 'object',
                        'posts_per_page' => '10000',
                        'post_status' => 'publish'
                    );

                    $loop = new WP_Query( $args );

                    //Main loop
                    while( $loop->have_posts() ) :
                        $loop->the_post();
                        get_template_part('object-templates/object-card');

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
