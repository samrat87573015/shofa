<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package shofa
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;
$blog_column2 = is_active_sidebar( 'blog-sidebar' ) ? 7 : 12;

$categories = get_the_terms( $post->ID, 'category' );
$shofa_audio_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;
$gallery_images = function_exists('get_field') ? get_field('gallery_images') : '';
$shofa_video_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;

$shofa_blog_single_social = get_theme_mod( 'shofa_blog_single_social', false );
$blog_tag_col = $shofa_blog_single_social ? 'col-xl-7' : 'col-xl-12';

?>


<section class="tp-blog-area postbox__area postbox-area pt-80 pb-60">
    <div class="container">
        <div class="row">
			<div class="col-xxl-<?php print esc_attr( $blog_column );?> col-xl-<?php print esc_attr( $blog_column );?> col-lg-<?php print esc_attr( $blog_column2 );?> col-md-12">
				<div class="postbox__wrapper postbox postbox__details pr-20">
					<?php
					while ( have_posts() ):
					the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					?>

					<?php if( has_tag() || function_exists('shofa_blog_social_share')) : ?>
                    <div class="postbox__tag-border mb-50">
                        <div class="row align-items-center">

                            <?php echo shofa_get_tag();?>

                            <?php if(function_exists('shofa_blog_social_share')): ?>
                                <?php echo shofa_blog_social_share(); ?> 
                            <?php endif; ?>
                            
                        </div>
                    </div>
					<?php endif; ?>
			
					<?php

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ):
							comments_template();
						endif;

						endwhile; // End of the loop.
					?>
				</div>
			</div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
		        <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-12">
		        	<div class="blog__sidebar sidebar__wrapper pl-25 pb-50">
						<?php get_sidebar();?>
	            	</div>
	            </div>
			<?php endif;?>
		</div>
	</div>
</section>

<?php
get_footer();