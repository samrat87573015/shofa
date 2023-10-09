<?php 

   /**
    * Template part for displaying header side information
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package shofa
   */


  $shofa_offcanvas_hide = get_theme_mod( 'shofa_offcanvas_hide', false );
  $shofa_offcanvas_desc_title = get_theme_mod( 'shofa_offcanvas_desc_title', __( 'We help to create visual strategies.', 'shofa' ) );
  // side btn 1
  $shofa_side_btn_title = get_theme_mod( 'shofa_side_btn_title', __( 'Login / Register', 'shofa' ) );
  $shofa_side_btn_url = get_theme_mod( 'shofa_side_btn_url', __( '#', 'shofa' ) );
  // side btn 2
  $shofa_side_btn_title_2 = get_theme_mod( 'shofa_side_btn_title_2', __( 'Wishlist', 'shofa' ) );
  $shofa_side_btn_url_2 = get_theme_mod( 'shofa_side_btn_url_2', __( '#', 'shofa' ) );
  $shofa_header_search = get_theme_mod( 'shofa_header_search', false );

  $shofa_header_wishlist_link = get_theme_mod( 'shofa_header_wishlist_link', '#' );

  $mobile_menu_bar = get_theme_mod( 'mobile_menu_bar', false );
  

?>

<div class="tpsideinfo">
    <button class="tpsideinfo__close"><?php echo esc_html__('Close', 'shofa'); ?><i class="fal fa-times ml-10"></i></button>
    <div class="tpsideinfo__search text-center pt-35">

        <?php if(!empty($shofa_offcanvas_hide)) : ?>
        <span class="tpsideinfo__search-title mb-20"><?php echo shofa_kses($shofa_offcanvas_desc_title); ?></span>
        <?php endif; ?>

        <?php if(!empty($shofa_header_search)) : ?>
            <?php shofa_offcanvas_search(); ?>
        <?php endif; ?>
    </div>
    <div class="tpsideinfo__nabtab">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            
            <?php if(has_nav_menu('main-menu')) : ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo esc_html__('Menu', 'shofa'); ?></button>
            </li>
            <?php endif; ?>
            <?php if(has_nav_menu('offcanvas-menu')) : ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo esc_html__('Categories', 'shofa'); ?></button>
            </li>
            <?php endif; ?>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="mobile-menu"></div>
            </div>
        </div>
    </div>

    <?php if(!empty($shofa_offcanvas_hide)) : ?>
    <?php if(!empty($shofa_side_btn_title)) : ?>
    <div class="tpsideinfo__account-link">
        <a href="<?php echo esc_url($shofa_side_btn_url); ?>"><i class="fal fa-user"></i> <?php echo esc_html($shofa_side_btn_title); ?></a>
    </div>
    <?php endif; ?>
    <?php if(!empty($shofa_side_btn_title_2)) : ?>
    <div class="tpsideinfo__wishlist-link">
        <a href="<?php echo esc_url($shofa_side_btn_url_2); ?>" target="_parent"><i class="fal fa-heart"></i> <?php echo esc_html($shofa_side_btn_title_2); ?></a>
    </div>
    <?php endif; ?>
    <?php endif; ?>

</div>
<div class="body-overlay"></div>




<?php if( class_exists( 'WooCommerce' ) && !empty($mobile_menu_bar)) : ?>
<div class="bottom_mobile_menu_icon_bar d-md-none">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="mobile_icon_bar_item text-center">
                    <a href="<?php print esc_url( home_url( '/shop' ) );?>">
                        <i class="fal fa-th"></i>
                        <span><?php echo esc_html__('Shop', 'shofa') ?></span>
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div class="mobile_icon_bar_item text-center">
                    <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>">
                        <i class="fal fa-user"></i>
                        <span><?php echo esc_html__('Account', 'shofa') ?></span>
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div class="mobile_icon_bar_item text-center">
                    <button class="search_icon"><i class="fal fa-search"></i>
                    <span><?php echo esc_html__('Search', 'shofa') ?></span>
                    </button>
                </div>
            </div>
            <div class="col-3">
                <div class="mobile_icon_bar_item text-center">
                    <a href="<?php echo esc_url($shofa_header_wishlist_link); ?>">
                        <i class="fal fa-heart"></i>
                        <span><?php echo esc_html__('Wishlist', 'shofa') ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

