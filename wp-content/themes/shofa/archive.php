<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shofa
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

?>

	<!-- search result item area start -->
	<section class="tp-blog-area postbox__area grey-bg-4 pt-120 pb-100">
    	<div class="container">
			<div class="row">
				<div class="col-lg-<?php print esc_attr( $blog_column );?>">
					<div class="postbox__wrapper postbox">
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
								get_template_part( 'template-parts/content' );?>
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
					<div class="col-lg-4">
						<div class="sidebar__wrapper pl-40">
							<?php get_sidebar();?>
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
	</section>
		<!-- search result item area end -->
<?php
get_footer();
