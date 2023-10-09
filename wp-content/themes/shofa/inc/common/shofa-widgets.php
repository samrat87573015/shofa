<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shofa_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_style_2_switch', false );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'shofa' ),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__( 'Set Your Blog Widget', 'shofa' ),
        'before_widget' => '<div id="%1$s" class="sidebar__widget mb-40 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="sidebar__widget-title mb-25">',
        'after_title'   => '</h3>',
    ] );

    /**
     * shop sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Shop Sidebar', 'shofa' ),
        'id'            => 'shop-sidebar',
        'description'   => esc_html__( 'Set Your Shop Widget', 'shofa' ),
        'before_widget' => '<div id="%1$s" class="shop_sidebar__widget mb-40 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="shop_sidebar__widget-title mb-25">',
        'after_title'   => '</h3>',
    ] );




    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'shofa' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer column %1$s', 'shofa' ), $num ),
            'before_widget' => '<div id="%1$s" class="footer__widget footer__widget-'.$num.' footer-widget footer-col-'.$num.' mb-40 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-widget__title mb-30" >',
            'after_title'   => '</h4>',
        ] );
    }

    // footer 2
    if ( $footer_style_2_switch ) {
        for ( $num = 1; $num <= $footer_widgets+1; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'shofa' ), $num ),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'shofa' ), $num ),
                'before_widget' => '<div id="%1$s" class="footer__widget footer-widget footer-col-'.$num.' mb-40 footer__widget-4 footer-col-2-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="footer-widget__title mb-30">',
                'after_title'   => '</h4>',
            ] );
        }
    }    


}
add_action( 'widgets_init', 'shofa_widgets_init' );