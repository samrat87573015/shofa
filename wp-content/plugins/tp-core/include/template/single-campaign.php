<?php 

  get_header();
	$cuases_color = function_exists('get_field') ? get_field('cuases_color') : '';
    $campaign_id = get_the_id();
    $campaign_info = charitable_get_campaign( $campaign_id );
    $campaign_title      	  = $campaign_info->post_title; // title
    $campaign_content      	  = $campaign_info->post_content; // content
    $campaign_description     = $campaign_info->description; // description
    $campaign_post_page_link  = get_post_permalink( $campaign_info->ID ); // url
    $campaign_image_url       = get_the_post_thumbnail_url( $campaign_info->ID, 'loveicon-chariti-single-2' ); // thumbnail
    $campaign_currency_helper = charitable_get_currency_helper();
    $campaign_donated_amount  = $campaign_currency_helper->get_monetary_amount( $campaign_info->get_donated_amount() );
    $campaign_goal	          = $campaign_currency_helper->get_monetary_amount( $campaign_info->get_goal() );
    $campaign_due = $campaign_currency_helper->get_monetary_amount($campaign_info->get_goal() - $campaign_info->get_donated_amount());
    $campaign_percent_unround         = $campaign_info->get_percent_donated_raw();
    $campaign_percent         = round($campaign_percent_unround);
    $campaign_categories      = $campaign_info->get( 'categories', true );
    $campaign_suggested_donations = $campaign_info->get_suggested_donations();

    $categories = get_the_terms( get_the_id(), 'campaign_category' );


    function ed_remove_phone_field_from_donation_form12( $fields ) {
        // unset( $fields['phone'] );
        unset( $fields['address'] );
        unset( $fields['address_2'] );
        unset( $fields['city'] );
        unset( $fields['state'] );
        unset( $fields['country'] );
        unset( $fields['postcode'] );
        return $fields;
    }
    add_filter( 'charitable_donation_form_user_fields', 'ed_remove_phone_field_from_donation_form12' );

    $post_column = is_active_sidebar( 'campaigns-sidebar' ) ? 8 : 10;
    $post_column_center = is_active_sidebar( 'campaigns-sidebar' ) ? '' : 'justify-content-center';
    
?>

<section class="donation pt-130 pb-100">
  <div class="container">
    <div class="row <?php echo esc_attr($post_column_center); ?>">
      <div class="col-lg-8 mb-30">
        <div class="innerWrapper">
          <div class="donationDetails">
            <div class="donationDetails__header mb-45">
              <figure class="thumb mb-45">
                <?php the_post_thumbnail(); ?>
              </figure>
              <h3 class="donationDetails__title text-uppercase"><?php the_title(); ?></h3>
            </div>
            <div class="featureBlock__donation featureBlock__donation--style2 mb-50">
              <div class="featureBlock__donation__progress">
                <div class="featureBlock__donation__bar">
                  <span class="featureBlock__donation__text skill-bar" data-width="<?php echo esc_attr( $campaign_percent );?>%" style="width: <?php echo esc_attr( $campaign_percent );?>%;"><?php echo esc_attr( $campaign_percent );?>%</span>
                  <div class="featureBlock__donation__line">
                    <span class="skill-bars">
                    <span class="skill-bars__line skill-bar" data-width="<?php echo esc_attr( $campaign_percent );?>%" style="width: <?php echo esc_attr( $campaign_percent );?>%;"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="featureBlock__eqn">
                <div class="featureBlock__eqn__block">
                  <span class="featureBlock__eqn__title"><?php echo esc_html__('our goal','tpcore'); ?></span>
                  <span class="featureBlock__eqn__price"><?php echo $campaign_goal;?></span>
                </div>
                <div class="featureBlock__eqn__block text-sm-center">
                  <span class="featureBlock__eqn__title"><?php echo esc_html__('Raised','tpcore'); ?></span>
                  <span class="featureBlock__eqn__price"><?php echo $campaign_donated_amount;?></span>
                </div>
                <div class="featureBlock__eqn__block text-sm-end">
                  <span class="featureBlock__eqn__title"><?php echo esc_html__('to go','tpcore'); ?></span>
                  <span class="featureBlock__eqn__price"><?php echo $campaign_due; ?></span>
                </div>
              </div>
            </div>
            
            <?php the_content(); ?>

            <div class="donation-mainform mt-50">
                <?php charitable_get_current_donation_form()->render(); ?>
            </div>
          </div>
        </div>
      </div>
      <?php if ( is_active_sidebar('campaigns-sidebar') ): ?>  
      <div class="col-lg-4 mb-30">
        <?php dynamic_sidebar( 'campaigns-sidebar' ); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer();