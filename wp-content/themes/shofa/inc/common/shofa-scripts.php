<?php

/**
 * shofa_scripts description
 * @return [type] [description]
 */
function shofa_scripts() {

    /**
     * all css files
    */

    wp_enqueue_style( 'shofa-fonts', shofa_fonts_url(), array(), time() );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', SHOFA_THEME_CSS_DIR.'bootstrap-rtl.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', SHOFA_THEME_CSS_DIR.'bootstrap.min.css', array() );
    }

    wp_enqueue_style( 'animate', SHOFA_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'swiper-bundle', SHOFA_THEME_CSS_DIR . 'swiper-bundle.css', [] );
    wp_enqueue_style( 'slick', SHOFA_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'nice-select', SHOFA_THEME_CSS_DIR . 'nice-select.css', [] );
    wp_enqueue_style( 'font-awesome-pro', SHOFA_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'magnific-popup', SHOFA_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'meanmenu', SHOFA_THEME_CSS_DIR . 'meanmenu.css', [] );
    wp_enqueue_style( 'spacing', SHOFA_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'shofa-core', SHOFA_THEME_CSS_DIR . 'shofa-core.css', [], time() );
    wp_enqueue_style( 'shofa-unit', SHOFA_THEME_CSS_DIR . 'shofa-unit.css', [], time() );
    wp_enqueue_style( 'shofa-custom', SHOFA_THEME_CSS_DIR . 'shofa-custom.css', [] );
    wp_enqueue_style( 'shofa-style', get_stylesheet_uri() );

    // all js
    wp_enqueue_script( 'waypoints', SHOFA_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'bootstrap-bundle', SHOFA_THEME_JS_DIR . 'bootstrap.bundle.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'swiper-bundle', SHOFA_THEME_JS_DIR . 'swiper-bundle.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'slick', SHOFA_THEME_JS_DIR . 'slick.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'magnific-popup', SHOFA_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'nice-select', SHOFA_THEME_JS_DIR . 'nice-select.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'counterup', SHOFA_THEME_JS_DIR . 'counterup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'wow', SHOFA_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope-pkgd', SHOFA_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'countdown', SHOFA_THEME_JS_DIR . 'countdown.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'meanmenu', SHOFA_THEME_JS_DIR . 'meanmenu.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'knob', SHOFA_THEME_JS_DIR . 'jquery.knob.js', [ 'jquery' ], false, true );

    wp_enqueue_script( 'shofa-main', SHOFA_THEME_JS_DIR . 'main.js', [ 'jquery' ], time(), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'shofa_scripts' );

/*
Register Fonts
 */
function shofa_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'shofa' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?'. urlencode('family=Jost:wght@300;400;500;600;700&display=swap');
    }
    return $font_url;
}
