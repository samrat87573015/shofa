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
      <div class="project-details-area pt-140 pb-130">
         <div class="container">
         <?php
             if( have_posts() ):
             while( have_posts() ): the_post();
                 $project_details_image = function_exists('get_field') ? get_field('project_details_image') : '';
                 $project_info_repeater = function_exists('get_field') ? get_field('project_info_repeater') : '';
                 $project_social = function_exists('get_field') ? get_field('project_social') : '';
                 $project_button = function_exists('get_field') ? get_field('project_button') : '';
                 $project_button_link = function_exists('get_field') ? get_field('project_button_link') : '';
            ?>

            <div class="row align-items-center">
               <div class="col-xl-5 col-lg-6">
                  <div class="aboutme-image mb-40">
                     <?php the_post_thumbnail(); ?>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-6">
                  <div class="aboutme-wrapper mb-40">
                     <div class="aboutme-content">
                        <h3 class="tpabout-xd-title mb-50"><?php the_title(); ?></h3>
                     </div>
                     <div class="aboutme-feature-list mt-25">
                     <ul>
                         <?php
                         if( have_rows('project_info_repeater') ):
                             while( have_rows('project_info_repeater') ) : the_row();
                             $project_info_label = get_sub_field('project_info_label');
                             $project_info_name = get_sub_field('project_info_name');
                         ?>

                             <li><p><a href="#"><?php echo esc_html($project_info_label); ?></a> <?php echo esc_html($project_info_name); ?></p></li>

                             <?php endwhile; ?>

                         <?php else : ?>
                             <p>Please add your project info list from project post.</p>
                         <?php endif; ?>
                       </ul>
                       <div class="aboutme-social portfolio-details-social d-flex align-item-center mt-20">
                           <p>Social: </p>
                           <?php echo $project_social; ?>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-12">
                  <div class="project-details-content">
                     <?php the_content(); ?>
                  </div>
                  <div class="project-details-nav mt-55 d-none">
                     <div class="details-nav-item">
                        <a href="https://themepure.net/wp/nerox/portfolio-details/"><i class="fas fa-long-arrow-left"></i> Back</a>
                     </div>
                     <div class="details-nav-item">
                        <a href="https://themepure.net/wp/nerox/portfolio-details/">Next <i class="fas fa-long-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>

            <?php
            endwhile; wp_reset_query();
            endif;
            ?>
         </div>
      </div>
      <!-- project-details-area end -->

<?php get_footer();  ?>
