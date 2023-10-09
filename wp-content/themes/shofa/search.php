<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package shofa
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

$result = $wp_query->found_posts;


?>


<div class="tp-blog-area postbox-area pt-80 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-<?php print esc_attr( $blog_column );?> blog-post-items">
            	<div class="postbox pr-20 pb-50">
	                <?php
						if ( have_posts() ):
					?>
					<div class="result-bar page-header d-none">
						<h1 class="page-title"><?php esc_html_e( 'Search Results For:', 'shofa' );?> <?php print get_search_query();?></h1>
					</div>
					<?php
						while ( have_posts() ): the_post();
							get_template_part( 'template-parts/content', 'search' );
						endwhile;
					?>
					<div class="basic-pagination basic-pagination-2 mb-40">
						<?php shofa_pagination( '<i class="fas fa-angle-double-left"></i>', '<i class="fas fa-angle-double-right"></i>', '', [ 'class' => '' ] );?>
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
</div>

<?php
get_footer();