<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <div class="row">

            <div class="col-md-8">

                <main class="site-main" id="main">

                    <?php while ( have_posts() ) : ?>
                        
                        <?php the_post(); ?>

                        <?php get_template_part('object-templates/object-single'); ?>
                        <?php // get_template_part('object-templates/object-card'); ?>
                        <?php // get_template_part( 'loop-templates/content', 'single' ); ?>
                        <?php understrap_post_nav(); ?>

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>

                    <?php endwhile; // end of the loop. ?>

                </main><!-- #main -->

            </div>

            <!-- Do the left sidebar check and opens the primary div -->
            <?php get_template_part( 'global-templates/jbf-sidebar-check' ); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
