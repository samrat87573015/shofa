<?php get_header();
    global $post;
	 $event_image = function_exists( 'get_field' ) ? get_field( 'event_image' ) : '';

    $post_tags = get_the_terms( get_the_id(), 'post_tag' );

    $terms = get_the_terms($post->ID, 'tribe_events_cat'); 

    $date_text = function_exists('get_field') ? get_field('date_text') : ''; 
    $address_text = function_exists('get_field') ? get_field('address_text') : ''; 
    $speaker_image = function_exists('get_field') ? get_field('speaker_image') : ''; 
    $speaker_name = function_exists('get_field') ? get_field('speaker_name') : ''; 
    $event_button_text = function_exists('get_field') ? get_field('event_button_text') : ''; 
    $event_button_url = function_exists('get_field') ? get_field('event_button_url') : ''; 
    $sponsors_image = function_exists('get_field') ? get_field('sponsors_image') : ''; 
    $address_text = function_exists('get_field') ? get_field('address_text') : ''; 
    $mail_name = function_exists('get_field') ? get_field('mail_name') : ''; 
    $event_mail_id = function_exists('get_field') ? get_field('event_mail_id') : ''; 
    $event_button_text = function_exists('get_field') ? get_field('event_button_text') : ''; 
    $event_button_url = function_exists('get_field') ? get_field('event_button_url') : ''; 

    $item_classes = '';
    $item_cat_names = '';
    $item_cats = get_the_terms( $post->ID, 'tribe_events_cat' );
    if( !empty($item_cats) ):
        $count = count($item_cats) - 1;
        foreach($item_cats as $key => $item_cat) {
            $item_classes .= $item_cat->slug . ' ';
            $item_cat_names .= ( $count > $key ) ? $item_cat->name  . ', ' : $item_cat->name;
        }
    endif; 


    $time_format = get_option('time_format', \Tribe__Date_Utils::TIMEFORMAT);
    $time_range_separator = tribe_get_option('timeRangeSeparator', ' - ');
    $start_time           = tribe_get_start_date(null, false, $time_format);
    $end_time             = tribe_get_end_date(null, false, $time_format);
    $time_formatted = null;

    if ($start_time == $end_time) {
        $time_formatted = esc_html($start_time);
    } else {
        $time_formatted = esc_html($start_time . $time_range_separator . $end_time);
    }

    $symbol = tribe_get_event_meta( $post->ID, '_EventCurrencySymbol', true );


?>


   <!-- event area start -->
   <section class="event__area pt-115 p-relative">
      <div class="page__title-shape">
         <img class="page-title-shape-5 d-none d-sm-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/page-title-shape-1.png" alt="img">
         <img class="page-title-shape-6" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/page-title-shape-2.png" alt="img">
         <img class="page-title-shape-7" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/page-title-shape-4.png" alt="img">
         <img class="page-title-shape-8" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/page-title-shape-5.png" alt="img">
      </div>
      <div class="container">
         <div class="row">
            <div class="col-xxl-8">
               <div class="event__wrapper">
                  <div class="page__title-content mb-25">                          
                     <span class="breadcrumb__title-pre"><?php echo esc_html($item_cat_names); ?></span>
                     <h5 class="breadcrumb__title-2"><?php echo get_the_title(); ?></h5>
                  </div>
                  <div class="course__meta-2 d-sm-flex align-items-center mb-30">
                     <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                        <div class="course__teacher-thumb-3 mr-15">
                           <img src="<?php echo esc_html($speaker_image['url']); ?>" alt="img">
                        </div>
                        <div class="course__teacher-info-3">
                           <h5><?php echo esc_html__('Speaker','tpcore'); ?></h5>
                           <p><a href="#"><?php echo esc_html($speaker_name); ?></a></p>
                        </div>
                     </div>
                     <div class="course__update mr-80 mb-30">
                        <h5><?php echo esc_html__('Date','tpcore'); ?></h5>
                        <p>
                            <?php  echo tribe_get_start_date( $post->ID, false, 'j' ); ?> 
                            <?php echo tribe_get_start_date( $post->ID, false, 'F' ); ?>
                            <?php  echo tribe_get_start_date( $post->ID, false, 'Y' ); ?>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- event area end -->

   <!-- event details area start -->
   <section class="event__area pb-110">
      <div class="container">
         <div class="row">
            <div class="col-xxl-8 col-xl-8 col-lg-8">
               <div class="event_wrapper">
                  <div class="event__thumb mb-35 w-img">
                     <?php the_post_thumbnail(); ?>
                  </div>
                  <div class="event__details mb-35">
                     <?php the_content(); ?>
                  </div>

                 <?php if(!empty($post_tags)) : ?>
                 <div class="event__tag">
                    <span><i class="fal fa-tag"></i></span>
                    <?php foreach ( $post_tags as $tag ) : ?>
                       <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
                            <?php echo $tag->name; ?><span>,</span>
                        </a> 
                    <?php endforeach; ?>    
                 </div>
                <?php endif; ?>
               </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4">
               <div class="event__sidebar pl-70">
                  <div class="event__sidebar-widget white-bg mb-20">
                     <div class="event__sidebar-shape">
                        <img class="event-sidebar-img-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/events/event-shape-2.png" alt="img">
                        <img class="event-sidebar-img-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/events/event-shape-3.png" alt="img">
                     </div>
                     <div class="event__info">
                        <div class="event__info-meta mb-25 d-flex align-items-center justify-content-between">
                           <div class="event__info-price">
                              <h5><?php echo $symbol; ?><?php echo tribe_get_cost() ?></h5>
                           </div>
                        </div>
                        <div class="event__info-content mb-35">
                           <ul>
                              <li class="d-flex align-items-center">
                                 <div class="event__info-icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                       <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z"/>
                                       <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 "/>
                                    </svg>
                                 </div>
                                 <div class="event__info-item">
                                    <h5><span><?php echo esc_html__('End Time:','tpcore'); ?> </span> <?php echo esc_html($end_time); ?></h5>
                                 </div>
                              </li>
                              <li class="d-flex align-items-center">
                                 <div class="event__info-icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                       <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z"/>
                                       <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 "/>
                                    </svg>
                                 </div>
                                 <div class="event__info-item">
                                    <h5><span><?php echo esc_html__('Start Time:','tpcore'); ?> </span>  <?php echo esc_html($start_time); ?></h5>
                                 </div>
                              </li>
                              <li class="d-flex align-items-center">
                                 <div class="event__info-icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                       <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z"/>
                                       <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 "/>
                                    </svg>
                                 </div>
                                 <div class="event__info-item">
                                    <h5><span><?php echo esc_html__('Venue:','tpcore'); ?>  </span> <?php echo tribe_get_address(); ?>, <?php echo tribe_get_city(); ?></</h5>
                                 </div>
                              </li>
                           </ul>
                        </div>
                           <?php if(!empty($event_button_text)) : ?>
                           <div class="event__join-btn">
                              <a href="<?php echo esc_html($event_button_url); ?>" class="tp-btn text-center w-100"><?php echo esc_html($event_button_text); ?> <i class="far fa-arrow-right"></i></a>
                           </div>
                           <?php endif; ?>
                     </div>
                  </div>
                   <div class="event__sidebar-widget white-bg">
                      <div class="event__sponsor">
                         <?php if(!empty($sponsors_image['url'])) : ?>
                         <h3 class="event__sponsor-title"><?php echo esc_html__('Sponsors:','bdevs-toolkit'); ?></h3>
                         <div class="event__sponsor-thumb mb-35">
                            <img src="<?php echo esc_html($sponsors_image['url']); ?>" alt="img">
                         </div>
                         <?php endif; ?>

                         <div class="event__sponsor-info">
                            <h3><?php echo esc_html($mail_name); ?></h3>
                            <h4><?php echo esc_html__('Email:','bdevs-toolkit'); ?> <span><?php echo esc_html($event_mail_id); ?></span></h4>
                            <div class="event__social d-xl-flex align-items-center">
                               <h4><?php echo esc_html__('Share:','bdevs-toolkit'); ?></h4>
                               <ul>
                                  <li>
                                      <a class="fb" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>"><span class="fab fa-facebook-f"></span></a>
                                  </li>
                                  <li>
                                      <a class="tw" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://twitter.com/home?status=<?php echo urlencode( get_the_title() ); ?>-<?php echo esc_url( get_permalink() ); ?>"><span class="fab fa-twitter"></span></a>
                                  </li>
                                  <li>
                                      <a class="pin" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( get_permalink() ); ?>" target="_blank">
                                          <span class="fab fa-linkedin"></span>
                                      </a>
                                  </li>
                               </ul>
                            </div>
                         </div>
                      </div>
                   </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- event details area end -->



<?php get_footer();