<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

$post_column = is_active_sidebar( 'portfolio-sidebar' ) ? 'col-xxl-9 col-xl-9 col-lg-8' : 'col-xxl-10 col-xl-10 col-lg-10';
$post_column_center = is_active_sidebar( 'portfolio-sidebar' ) ? '' : 'justify-content-center';

?>

      <!-- project-details-area start -->
      <div class="footer-details-areas pt-140 pb-130">
         <div class="containers">
         <?php
             if( have_posts() ):
             while( have_posts() ): the_post();
            ?>

            <div class="custom-footer"><?php the_content(); ?></div>

            <?php
            endwhile; wp_reset_query();
            endif;
            ?>
         </div>
      </div>
      <!-- project-details-area end -->

<?php get_footer();  ?>
