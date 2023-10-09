<?php
/**
 * Breadcrumbs for Eduker theme.
 *
 * @package     Eduker
 * @author      Theme_Pure
 * @copyright   Copyright (c) 2022, Theme_Pure
 * @link        https://www.themepure.net
 * @since       Eduker 1.0.0
 */


function my(){
    
}

function shofa_breadcrumb_func() {
    global $post, $title;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;


    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','shofa'));
        $breadcrumb_class = 'home_front_page';
    }
    elseif ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','shofa'));
        $breadcrumb_show = 0;
    }
    elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $title = get_the_title( get_option( 'page_for_posts') );
        }
    }

    elseif ( is_single() && 'post' == get_post_type() ) {
      $title = get_the_title();
    } 
    elseif ( is_single() && 'product' == get_post_type() ) {
        $title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'shofa' ) );
    } 
    elseif ( is_single() && 'courses' == get_post_type() ) {
      $title = esc_html__( 'Course Details', 'shofa' );
    } 
    elseif ( 'courses' == get_post_type() ) {
      $title = esc_html__( 'Courses', 'shofa' );
    } 
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'shofa' ) . get_search_query();
    } 
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'shofa' );
    } 
    elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
        $title = get_theme_mod( 'breadcrumb_shop', __( 'Shop', 'shofa' ) );
    } 
    elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } 
    else {
        $title = get_the_title();
    }
 
    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) { 
        $_id = $post->ID;
    } 
    elseif ( function_exists("is_shop") AND is_shop()  ) { 
        $_id = wc_get_page_id('shop');
    } 
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
    }

    $is_breadcrumb = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_breadcrumb', $_id ) : '';
    if( !empty($_GET['s']) ) {
      $is_breadcrumb = null;
    }


    // breadcrumb code
    $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image',$_id) : '';
    $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image',$_id) : '';

    // get_theme_mod
    $bg_img = get_theme_mod( 'breadcrumb_bg_img');
    $bg_img_color = get_theme_mod( 'shofa_breadcrumb_bg_color', '#F0F1F3');
    $shofa_breadcrumb_shape_switch = get_theme_mod( 'shofa_breadcrumb_shape_switch', true );
    $breadcrumb_info_switch = get_theme_mod( 'breadcrumb_info_switch', true );

    if ( $hide_bg_img && empty($_GET['s']) ) {
        $bg_img = '';
    } else {
        $bg_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
    }

    if ( empty( $is_breadcrumb ) && $breadcrumb_show == 1 ) {

?>

      <!-- breadcrumb-area -->
      <section class="breadcrumb__area pt-60 pb-60 tp-breadcrumb__bg <?php print esc_attr( $breadcrumb_class );?>" data-bg-color="<?php echo esc_attr($bg_img_color); ?>" data-background="<?php print esc_attr($bg_img);?>">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-7 col-lg-12 col-md-12 col-12">
                    <?php if (!empty($breadcrumb_info_switch)) : ?>
                    <div class="tp-breadcrumb">
                        <?php if(function_exists('bcn_display')) {
                            echo '<div class="tp-breadcrumb__link mb-10">';
                            bcn_display();
                            echo '</div>';
                        } ?>
                        <h2 class="tp-breadcrumb__title"><?php echo wp_kses_post( $title ); ?></h2>
                    </div>
                    <?php endif; ?>
               </div>
            </div>
         </div>
      </section>
      <!-- breadcrumb-area-end -->

    <?php
    }
} // function close


add_action( 'shofa_header_style', 'shofa_breadcrumb_func', 10 );

// shofa_search_form
function shofa_search_form() {
    ?>
    <div class="header-meta__search-5 ml-25">
        <div class="header-search-bar-5">
            <form method="get" action="<?php print esc_url( home_url( '/shop' ) );?>" >
                <div class="search-info-5 p-relative">
                    <button type="submit" class="header-search-icon-5"><i class="fal fa-search"></i></button>
                    <input type="text" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Search products...', 'shofa' );?>">
                </div>
            </form>
        </div>
    </div>
   <?php
}

// shofa_search_form_2
function shofa_search_form_2() {
    ?>
    <div class="header-search-bar">
        <form method="get" action="<?php print esc_url( home_url( '/shop' ) );?>" >
            <div class="search-info p-relative">
                <button type="submit" class="header-search-icon"><i class="fal fa-search"></i></button>
                <input type="text" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Search products...', 'shofa' );?>">
            </div>
        </form>
    </div>
   <?php
}

// shofa_search_form_3
function shofa_search_form_3() {
    ?>
    <div class="mainmenu__search">
        <form method="get" action="<?php print esc_url( home_url( '/shop' ) );?>" >
            <div class="mainmenu__search-bar p-relative">
                <button type="submit" class="mainmenu__search-icon"><i class="fal fa-search"></i></button>
                <input type="text" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Search products...', 'shofa' );?>">
            </div>
        </form>
    </div>

   <?php
}

// shofa_search_form_4
function shofa_search_form_4() {
    ?>
    <div class="mainmenu d-flex align-items-center">
        <div class="mainmenu__search">
            <form method="get" action="<?php print esc_url( home_url( '/shop' ) );?>" >
                <div class="mainmenu__search-bar p-relative">
                    <button type="submit" class="mainmenu__search-icon"><i class="fal fa-search"></i></button>
                    <input type="text" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Search products...', 'shofa' );?>">
                </div>
            </form>
        </div>
    </div>

   <?php
}

// shofa_offcanvas_search
function shofa_offcanvas_search() {
    ?>
    <form method="get" action="<?php print esc_url( home_url( '/shop' ) );?>">
        <input type="text" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Search products...', 'shofa' );?>">
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>
   <?php
}




