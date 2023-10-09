<?php
/**
 * 
 * Demo Imports
 */

function tp_ocdi_import_files() {
    
    return array(
      array(
        'import_file_name'           => 'Home 1',
        // 'categories'                 => array( 'Category 1', 'Category 2' ),
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-1.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://weblearnbd.net/wp/ninico',
      ),
      array(
        'import_file_name'           => 'Home 2',
        // 'categories'                 => array( 'New category 1', 'Old category 2' ),
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-2.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://weblearnbd.net/wp/ninico/home-2/',
      ),
      array(
        'import_file_name'           => 'Home 3',
        // 'categories'                 => array( 'New category', 'Old category' ),
        'local_import_file'             => trailingslashit( get_template_directory() ) .'sample-data/contents-demo.xml',
        'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'sample-data/widget-settings.json',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'sample-data/customizer-data.dat',
        'import_preview_image_url' => plugins_url( 'assets/img/demo/home-3.jpg', dirname(__FILE__) ),
        'preview_url'                => 'https://weblearnbd.net/wp/ninico/home-3/',
      ),
    );
}
add_filter( 'ocdi/import_files', 'tp_ocdi_import_files' );


// after demo imports
function tp_ocdi_after_import_setup( $demo ) {
    $front_page_id = "";
    $blog_page_id = "";
    if( "Home 1" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Home' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    }else if( "Home 2" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Home 2' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    }else if( "Home 3" == $demo['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Home 3' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    }

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );


    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
 
    set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
        ]
    );

    // woocommerce default settings reset
    if ( class_exists( 'woocommerce' ) ) {
        update_option( 'woocommerce_shop_page_id', '13' );
        update_option( 'woocommerce_cart_page_id', '14' );
        // update_option( 'woocommerce_checkout_page_id', '15' );
        update_option( 'woocommerce_myaccount_page_id', '16' );
    }
 
}
add_action( 'ocdi/after_import', 'tp_ocdi_after_import_setup' );



function tp_ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'one-click-demo-import' );
    $default_settings['menu_title']  = esc_html__( 'Import Theme Demos' , 'one-click-demo-import' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'one-click-demo-import';
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'tp_ocdi_plugin_page_setup' );