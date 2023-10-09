<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shofa
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;
$blog_column2 = is_active_sidebar( 'blog-sidebar' ) ? 7 : 12;

?>



<section class="tp-blog-area postbox-area pt-80 pb-30">
    <div class="container">
        <div class="row">
			<div class="col-xxl-<?php print esc_attr( $blog_column );?> col-xl-<?php print esc_attr( $blog_column );?> col-lg-<?php print esc_attr( $blog_column2 );?> col-md-12">
				<div class="postbox pr-20 pb-50">
					<?php
						if ( have_posts() ):
    					if ( is_home() && !is_front_page() ):
    				?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title();?></h1>
					</header>
					<?php
						endif;?>
					<?php
						/* Start the Loop */
						while ( have_posts() ): the_post(); ?>
						<?php
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							if(has_post_format('quote')){
							get_template_part(  'template-parts/content-quote' );
							}
							else{
							get_template_part(  'template-parts/content' );
							}
							?>
						<?php
							endwhile;
						?>
		               		<div class="basic-pagination">
			               		<?php shofa_pagination( '<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>', '', ['class' => ''] );?>
			                </div>
						<?php
						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
					?>

				</div>
			</div>

			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
		        <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-12">
		        	<div class="sidebar__wrapper pl-25 pb-50">
						<?php get_sidebar();?>
	            	</div>
	            </div>
			<?php endif;?>
        </div>
    </div>
</section>

<?php
get_footer();
