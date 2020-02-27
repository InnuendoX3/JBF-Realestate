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
        <h1>EEP EEP</h1>

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
			<?php get_template_part( 'global-templates/jbf-sidebar-check' ); ?>

			<main class="site-main" id="main">

                <?php 
                
                $args = array(
                    'post_type'      => 'object',
                    'posts_per_page' => '12'
                );
                $loop = new WP_Query( $args );

                while( $loop->have_posts() ) :
                    $loop->the_post();

                    echo get_the_title()."<br>";
                    echo get_the_ID();

                    $children = get_children([
                        'post_parent' => $id,
                        'post_status' => 'inherit'
                    ]);

                    $images = [];

                    foreach ($children as $img) $images[] = $img;

                ?>
                <br>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="width: 800px"> 
                    <div class="carousel-inner">

                    <?php foreach($images as $i=>$img) : ?>
                        <div class="carousel-item <?php echo $i == 0 ? "active" : ""?>" style="height: 400px">
                            <img class="d-block" style="width: 800px" src="<?php echo $img->guid ?>">
                        </div>
                    <?php endforeach; ?>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <br>
                <?php endwhile; ?>


			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer(); ?>
