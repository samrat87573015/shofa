<?php 

	/**
	 * Template part for displaying header layout one
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
   $shofa_menu_col = $shofa_header_right ? 'col-xl-8 col-lg-8' : 'col-xl-10 col-lg-10 text-end';
   $shofa_header_search = get_theme_mod( 'shofa_header_search', false );
   $shofa_header_wishlist = get_theme_mod( 'shofa_header_wishlist', false );
   $shofa_header_avatar = get_theme_mod( 'shofa_header_avatar', false );
   $shofa_header_wishlist_link = get_theme_mod( 'shofa_header_wishlist_link', '#' );

   $shofa_mobile_menu_col = $shofa_header_right ? 'col-md-5 col-4' : 'col-md-6 col-6 text-end';
   $shofa_mobile_menu_col_2 = $shofa_header_right ? 'col-md-2 col-4' : 'col-md-6 col-6';
   $shofa_mobile_menu_row = $shofa_header_right ? 'row align-items-center' : 'row align-items-center flex-row-reverse';


?>



<header id="header-sticky">
    <div class="main_header_area d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2">
                    <div class="logo">
                        <?php shofa_header_logo();?>
                    </div>
                </div>
                <div class="<?php echo esc_attr($shofa_menu_col); ?>">
                    <div class="main-menu">
                        <nav id="mobile-menu">
                            <?php shofa_header_menu();?>
                        </nav>
                    </div>
                </div>
                <?php if(!empty($shofa_header_right)) : ?>
                <div class="col-xl-2 col-lg-2">
                    <div class="header_right_icons">
                        <div class="header_right_icon">
                            <button class="search_icon"><i class="fal fa-search"></i></button>
                        </div>
                        <div class="header_right_icon">
                            <?php if( class_exists( 'WooCommerce' ) && !empty($shofa_header_avatar)) : ?>
                            <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><i class="fal fa-user"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="header_right_icon">
                            <?php if( class_exists( 'WooCommerce' ) && !empty($shofa_header_wishlist)) : ?>
                            <a href="<?php echo esc_url($shofa_header_wishlist_link); ?>"><i class="fal fa-heart"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="header_right_icon">
                            <?php if ( class_exists( 'WooCommerce' ) && !empty($shofa_header_cart) ) : ?>
                                <div class="tp-mini-card header-cart p-relative tp-cart-toggle cartmini-open-btn">
                                    <i class="fal fa-shopping-cart"></i>
                                    <span class="tp-item-count tp-header-icon cart__count tp-product-count tp-cart-item"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>   
                                    <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="mobile_header_area d-xl-none">
        <div class="container">
            <div class="<?php echo esc_attr($shofa_mobile_menu_row); ?>">
                <div class="<?php echo esc_attr($shofa_mobile_menu_col); ?>">
                    <div class="header-canvas m-0 flex-auto">
                        <button class="tp-menu-toggle"><i class="far fa-bars"></i></button>
                    </div>
                </div>
                <div class="<?php echo esc_attr($shofa_mobile_menu_col_2); ?>">
                    <div class="logo">
                        <?php shofa_header_logo();?>
                    </div>
                </div>
                <?php if(!empty($shofa_header_right)) : ?>
                <div class="col-md-5 col-4">
                    <div class="header_right_icons">
                        <div class="header_right_icon d-none d-md-block">
                            <button class="search_icon"><i class="fal fa-search"></i></button>
                        </div>
                        <div class="header_right_icon d-none d-md-block">
                            <?php if( class_exists( 'WooCommerce' ) && !empty($shofa_header_avatar)) : ?>
                            <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><i class="fal fa-user"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="header_right_icon d-none d-md-block">
                            <?php if( class_exists( 'WooCommerce' ) && !empty($shofa_header_wishlist)) : ?>
                            <a href="<?php echo esc_url($shofa_header_wishlist_link); ?>"><i class="fal fa-heart"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="header_right_icon">
                            <?php if ( class_exists( 'WooCommerce' ) && !empty($shofa_header_cart) ) : ?>
                                <div class="tp-mini-card header-cart p-relative tp-cart-toggle cartmini-open-btn">
                                    <i class="fal fa-shopping-cart"></i>
                                    <span class="tp-item-count tp-header-icon cart__count tp-product-count tp-cart-item"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>   
                                    <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</header>



<div class="search_modal">
    <div class="container search_canva_wrapper pt-100 pb-100">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasTopLabel">What are you looking for?</h5>
            <button id="search_model_close" class="btn-close"></button>
        </div>
        <div class="offcanvas-body">
            <?php if(!empty($shofa_header_search)) : ?>
                <?php shofa_search_form_2(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>



<?php get_template_part( 'template-parts/header/header-offcanvas' ); ?>