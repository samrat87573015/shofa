<?php 

	/**
	 * Template part for displaying header layout three
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package shofa
	*/

	// header styles
   $shofa_topbar_switch = get_theme_mod( 'shofa_topbar_switch', false );
   $shofa_header_top_text = get_theme_mod( 'shofa_header_top_text', __('Enjoy free shipping on orders $100 & up.', 'shofa') );
   // header right
   $shofa_header_right = get_theme_mod( 'shofa_header_right', false );
   $shofa_header_cart = get_theme_mod( 'shofa_header_cart', false );
   $shofa_menu_col = $shofa_header_right ? 'col-xl-6 col-lg-6' : 'col-xl-10 col-lg-9 text-end';
   $shofa_header_search = get_theme_mod( 'shofa_header_search', false );
   $shofa_header_wishlist = get_theme_mod( 'shofa_header_wishlist', false );
   $shofa_header_avatar = get_theme_mod( 'shofa_header_avatar', false );
   $shofa_header_pcat_menu = get_theme_mod( 'shofa_header_pcat_menu', false );
   $shofa_header_wishlist_link = get_theme_mod( 'shofa_header_wishlist_link', '#' );
   $shofa_phone_num = get_theme_mod( 'shofa_phone_num', __('+964 742 44 763', 'shofa') );
   $shofa_header_pcat_title = get_theme_mod( 'shofa_header_pcat_title', __('Categories', 'shofa') );
   $shofa_header_address = get_theme_mod( 'shofa_header_address', __('New York.', 'shofa') );
   $shofa_header_pcat_text = get_theme_mod( 'shofa_header_pcat_text', __('New Arrival', 'shofa') );
   $shofa_header_top_right_text = get_theme_mod( 'shofa_header_top_right_text', __('Header Right Text Here.', 'shofa') );
   $shofa_header_lang = get_theme_mod( 'shofa_header_lang', false );

?>

<!-- header-area-start -->
<header class="platinam-light">
    <?php if(!empty($shofa_topbar_switch)) : ?>
    <div class="header-top platinam-bg platinam-header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <?php if(!empty($shofa_header_top_text)) : ?>
                    <div class="header-welcome-text">
                        <span><?php echo shofa_kses($shofa_header_top_text); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 d-none d-sm-block">
                    <div class="headertoplag d-flex align-items-center justify-content-end">
                        <?php shofa_header_social_profiles_2(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="mainmenuarea platinam-menuarea mt-30 d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">

                    <?php if(!empty($shofa_header_search)) : ?>
                    <?php shofa_search_form_4(); ?>
                    <?php endif; ?>

                </div>
                <div class="col-lg-2">
                    <div class="mainmenu__main text-center">
                        <div class="main-logo">
                            <?php shofa_header_logo();?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">

                    <?php if(!empty($shofa_header_right)) : ?>
                    <div class="header-meta d-flex align-items-center justify-content-end ml-25">
                        <div class="header-meta__social d-flex align-items-center">
                            <?php if ( class_exists( 'WooCommerce' ) && !empty($shofa_header_cart) ) : ?>
                            <span class="tp-mini-card header-cart p-relative tp-cart-toggle cartmini-open-btn">
                                <i class="fal fa-shopping-cart"></i>
                                <span class="tp-item-count tp-header-icon cart__count tp-product-count tp-cart-item"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>   
                                <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                            </span>
                            <?php endif; ?>
                            <?php if(!empty($shofa_header_avatar)) : ?>
                            <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><i class="fal fa-user"></i></a>
                            <?php endif; ?>

                            <?php if(!empty($shofa_header_wishlist)) : ?>
                            <a href="<?php echo esc_url($shofa_header_wishlist_link); ?>"><i
                                    class="fal fa-heart"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <div class="main-menu-area mt-15 d-none d-xl-block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="menu-area-4">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <?php shofa_header_menu();?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area-end -->

<!-- header-xl-sticky-area -->
<div id="header-sticky" class="logo-area tp-sticky-one mainmenu-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-2 col-lg-3">
                <div class="logo">
                    <?php shofa_header_logo();?>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="main-menu">
                    <nav>
                        <?php shofa_header_menu();?>
                    </nav>
                </div>
            </div>
            <div class="col-xl-4 col-lg-9">

               <?php if(!empty($shofa_header_right)) : ?>
               <div class="header-meta-info d-flex align-items-center justify-content-end">
                  <div class="header-meta__social  d-flex align-items-center">
                    <?php if ( class_exists( 'WooCommerce' ) && !empty($shofa_header_cart) ) : ?>
                    <span class="tp-mini-card header-cart p-relative tp-cart-toggle cartmini-open-btn">
                        <i class="fal fa-shopping-cart"></i>
                        <span class="tp-item-count tp-header-icon cart__count tp-product-count tp-cart-item"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>   
                        <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                    </span>
                    <?php endif; ?>
                     <?php if(!empty($shofa_header_avatar)) : ?>
                     <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><i class="fal fa-user"></i></a>
                     <?php endif; ?>

                     <?php if(!empty($shofa_header_wishlist)) : ?>
                     <a href="<?php echo esc_url($shofa_header_wishlist_link); ?>"><i
                           class="fal fa-heart"></i></a>
                     <?php endif; ?>
                  </div>

                  <?php if(!empty($shofa_header_search)) : ?>
                     <?php shofa_search_form(); ?>
                  <?php endif; ?>

               </div>
               <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<!-- header-xl-sticky-end -->

<!-- header-md-lg-area -->
<div id="header-tab-sticky" class="tp-md-lg-header d-none d-md-block d-xl-none pt-30 pb-30 platinam-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 d-flex align-items-center">
                <div class="header-canvas flex-auto">
                    <button class="tp-menu-toggle"><i class="far fa-bars"></i></button>
                </div>
                <div class="logo">
                  <?php shofa_header_logo();?>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="header-meta-info d-flex align-items-center justify-content-between">

                     <?php if(!empty($shofa_header_search)) : ?>
                        <?php shofa_search_form_2(); ?>
                     <?php endif; ?>

                     <?php if(!empty($shofa_header_right)) : ?>
                    <div class="header-meta__social d-flex align-items-center ml-25">
                        <?php if ( class_exists( 'WooCommerce' ) && !empty($shofa_header_cart) ) : ?>
                        <span class="tp-mini-card header-cart p-relative tp-cart-toggle cartmini-open-btn">
                            <i class="fal fa-shopping-cart"></i>
                            <span class="tp-item-count tp-header-icon cart__count tp-product-count tp-cart-item"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>   
                            <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                        </span>
                        <?php endif; ?>
                        <?php if(!empty($shofa_header_avatar)) : ?>
                        <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><i class="fal fa-user"></i></a>
                        <?php endif; ?>

                        <?php if(!empty($shofa_header_wishlist)) : ?>
                        <a href="<?php echo esc_url($shofa_header_wishlist_link); ?>"><i
                              class="fal fa-heart"></i></a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div id="header-mob-sticky" class="tp-md-lg-header d-md-none pt-20 pb-20 platinam-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-3 d-flex align-items-center">
                <div class="header-canvas flex-auto">
                    <button class="tp-menu-toggle"><i class="far fa-bars"></i></button>
                </div>
            </div>
            <div class="col-6">
                <div class="logo text-center">
                  <?php shofa_header_logo();?>
                </div>
            </div>
            <div class="col-3">
               <?php if(!empty($shofa_header_right)) : ?>
               <div class="header-meta-info d-flex align-items-center justify-content-end ml-25">
                  <div class="header-meta m-0 d-flex align-items-center">
                        <div class="header-meta__social d-flex align-items-center">
                            <?php if ( class_exists( 'WooCommerce' ) && !empty($shofa_header_cart) ) : ?>
                            <span class="tp-mini-card header-cart p-relative tp-cart-toggle cartmini-open-btn">
                                <i class="fal fa-shopping-cart"></i>
                                <span class="tp-item-count tp-header-icon cart__count tp-product-count tp-cart-item"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>   
                                <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                            </span>
                            <?php endif; ?>
                           <?php if(!empty($shofa_header_avatar)) : ?>
                           <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><i class="fal fa-user"></i></a>
                           <?php endif; ?>
                        </div>
                  </div>
               </div>
               <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- header-md-lg-area -->


<?php get_template_part( 'template-parts/header/header-offcanvas' ); ?>