<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

$post_column = is_active_sidebar( 'services-sidebar' ) ? 'col-xxl-9 col-xl-8 col-lg-8' : 'col-xxl-10 col-xl-10 col-lg-10';
$post_column_center = is_active_sidebar( 'services-sidebar' ) ? '' : 'justify-content-center';

?>

 <section class="services__details-area pt-120 pb-70">
    <div class="container">
        <?php if( have_posts() ) : while( have_posts() ) : the_post();
            $project_details_image = function_exists('get_field') ? get_field('project_details_image') : '';
            $project_info_repeater = function_exists('get_field') ? get_field('project_info_repeater') : '';
        ?>
       <div class="row <?php echo esc_attr($post_column_center); ?>">
          <div class="<?php echo esc_attr($post_column); ?>">
             <div class="services__details-wrapper pr-20">
                <div class="services__details-thumb w-img">
                   <?php the_post_thumbnail(); ?>
                </div>
                <div class="services__details-content">
                   <div class="product__details-text mb-45">
                      <h4 class="services__details-title"><?php the_title(); ?></h4>
                      <?php the_content(); ?>
                   </div>
                </div>
             </div>
          </div>
          <?php if ( is_active_sidebar('services-sidebar') ): ?>
          <div class="col-xxl-3 col-xl-4 col-lg-4">
             <div class="services__sidebar">
                <?php dynamic_sidebar( 'services-sidebar' ); ?>
             </div>
          </div>
          <?php endif; ?>
       </div>
        <?php
            endwhile; wp_reset_query();
            endif;
        ?>
    </div>
 </section>


<?php get_footer();  ?>
