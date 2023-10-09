<?php
/**
 * shofa customizer
 *
 * @package shofa
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function shofa_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'shofa_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'shofa Customizer', 'shofa' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'header_top_setting', [
        'title'       => esc_html__( 'Header Top Setting', 'shofa' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'header_social', [
        'title'       => esc_html__( 'Header Social', 'shofa' ),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'section_header_logo', [
        'title'       => esc_html__( 'Header Setting', 'shofa' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'section_preloader', [
        'title'       => esc_html__( 'Preloader Setting', 'shofa' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'shofa' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'header_side_setting', [
        'title'       => esc_html__( 'Offcanvas Settings', 'shofa' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'shofa' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'shofa' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'shofa' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'color_setting', [
        'title'       => esc_html__( 'Color Setting', 'shofa' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'shofa' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'shop_sections', [
        'title'       => esc_html__( 'Shop Settings ', 'shofa' ),
        'description' => '',
        'priority'    => 19,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'typo_setting', [
        'title'       => esc_html__( 'Typography Setting', 'shofa' ),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );

    $wp_customize->add_section( 'slug_setting', [
        'title'       => esc_html__( 'Slug Settings', 'shofa' ),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
        'panel'       => 'shofa_customizer',
    ] );
}

add_action( 'customize_register', 'shofa_customizer_panels_sections' );

function _header_top_fields( $fields ) {

    // header top
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_topbar_switch',
        'label'    => esc_html__( 'Topbar Swicher', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    // topbar text
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'shofa_header_top_text',
        'label'    => esc_html__( 'Header Top Text', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Enjoy free shipping on orders $100 & up.', 'shofa' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'shofa_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    // topbar right text
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'shofa_header_top_right_text',
        'label'    => esc_html__( 'Header Top Right Text', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Header Right Text Here.', 'shofa' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'shofa_topbar_switch',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    // preloader switch
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_preloader_switch',
        'label'    => esc_html__( 'Preloader On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];  

    // back to top
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_backtotop',
        'label'    => esc_html__( 'Back To Top On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    // right enable disable
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_header_right',
        'label'    => esc_html__( 'Header Right On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];    

    // search on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_header_search',
        'label'    => esc_html__( 'Header Search On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    // Language on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_header_lang',
        'label'    => esc_html__( 'Language On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];
    
    // multicurrency on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_header_multicurrency',
        'label'    => esc_html__( 'Multicurrency On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];
    
    
    // multicurrency shortcode
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_header_multicurrency_shortcode',
        'label'    => esc_html__( 'Insert Language Short', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '[short here]', 'shofa' ),
        'description' => esc_html__('this theme suggest to use "FOX - Currency Switcher Professional for WooCommerce" plugin"s shortcode.', 'shofa'),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'shofa_header_multicurrency',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    // login on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_header_login',
        'label'    => esc_html__( 'Login On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    // cart on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_header_cart',
        'label'    => esc_html__( 'Cart On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    // wishlist on off
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_header_wishlist',
        'label'    => esc_html__( 'Wishlist On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    // wishlist link
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_header_wishlist_link',
        'label'    => esc_html__( 'Wishlist Link', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '#', 'shofa' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'shofa_header_wishlist',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    // avatar
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_header_avatar',
        'label'    => esc_html__( 'Header Avatar On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ]; 

    // product category menu
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_header_pcat_menu',
        'label'    => esc_html__( 'Header Category Menu On/Off', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];    

    // cat title
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_header_pcat_title',
        'label'    => esc_html__( 'Category Title', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'Categories', 'shofa' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'shofa_header_pcat_menu',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    // cat bottom text
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'shofa_header_pcat_text',
        'label'    => esc_html__( 'Category Bottom Text', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'New Arrival', 'shofa' ),
        'priority' => 10,
        'active_callback' => [
            [
                'setting'  => 'shofa_header_pcat_menu',
                'operator' => '==',
                'value'    => true,
            ]
        ],
    ];

    // phone
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_phone_num',
        'label'    => esc_html__( 'Phone', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( '+964 742 44 763', 'shofa' ),
        'priority' => 10,
    ];

    // address
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_header_address',
        'label'    => esc_html__( 'Address', 'shofa' ),
        'section'  => 'header_top_setting',
        'default'  => esc_html__( 'New York.', 'shofa' ),
        'priority' => 10,
    ];        


    return $fields;

}
add_filter( 'kirki/fields', '_header_top_fields' );

/*
Header Social
 */
function _header_social_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_social_switch',
        'label'    => esc_html__( 'Social On/Off', 'shofa' ),
        'section'  => 'header_social',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    // header section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_topbar_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'shofa' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'shofa' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_topbar_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'shofa' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'shofa' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_topbar_behance_url',
        'label'    => esc_html__( 'Behance Url', 'shofa' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'shofa' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_topbar_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'shofa' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'shofa' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_topbar_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'shofa' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'shofa' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_topbar_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'shofa' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'shofa' ),
        'priority' => 10,
    ];


    return $fields;
}
add_filter( 'kirki/fields', '_header_social_fields' );

/*
Header Settings
 */
function _header_header_fields( $fields ) {
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'shofa' ),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__( 'Select an option...', 'shofa' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
            'header-style-3'  => get_template_directory_uri() . '/inc/img/header/header-3.png',
            'header-style-4'  => get_template_directory_uri() . '/inc/img/header/header-4.png',
            'header-style-5'  => get_template_directory_uri() . '/inc/img/header/header-5.png',
        ],
        'default'     => 'header-style-1',
    ]; 

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'shofa' ),
        'description' => esc_html__( 'Upload Your Logo.', 'shofa' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__( 'Header Secondary Logo', 'shofa' ),
        'description' => esc_html__( 'Header Logo Black', 'shofa' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-white.png',
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_header_fields' );

/*
Header Side Info
 */
function _header_side_fields( $fields ) {

    // side info settings
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_offcanvas_hide',
        'label'    => esc_html__( 'Offcanvas Info On/Off', 'shofa' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];  

    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_offcanvas_desc_title',
        'label'    => esc_html__( 'Description Title', 'shofa' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'We help to create visual strategies.', 'shofa' ),
        'priority' => 10,
    ];

    // side btn 1
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_side_btn_title',
        'label'    => esc_html__( 'Button Title 1', 'shofa' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Login / Register', 'shofa' ),
        'priority' => 10,
    ];

    // side btn 1 url
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_side_btn_url',
        'label'    => esc_html__( 'Button URL 1', 'shofa' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'shofa' ),
        'priority' => 10,
    ];

    // side btn 2
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_side_btn_title_2',
        'label'    => esc_html__( 'Button Title 2', 'shofa' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Wishlist', 'shofa' ),
        'priority' => 10,
    ];

    // side btn 2 url
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_side_btn_url_2',
        'label'    => esc_html__( 'Button URL 2', 'shofa' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '#', 'shofa' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_side_fields' );

/*
_header_page_title_fields
 */
function _header_page_title_fields( $fields ) {

    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'shofa' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'shofa' ),
        'section'     => 'breadcrumb_setting',
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'shofa_breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'shofa' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'shofa' ),
        'section'     => 'breadcrumb_setting',
        'default'     => '#F0F1F3',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_blog_btn_switch',
        'label'    => esc_html__( 'Blog BTN On/Off', 'shofa' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_blog_single_social',
        'label'    => esc_html__( 'Blog Share On/Off', 'shofa' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta On/Off', 'shofa' ),
        'section'  => 'blog_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_blog_author',
        'label'    => esc_html__( 'Blog Author Meta On/Off', 'shofa' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_blog_date',
        'label'    => esc_html__( 'Blog Date Meta On/Off', 'shofa' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta On/Off', 'shofa' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'shofa' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'shofa' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'shofa' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'shofa' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'shofa' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'shofa' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'shofa' ),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'shofa' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
            'footer-style-2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
        ],
        'default'     => 'footer-style-1',
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__( 'Widget Number', 'shofa' ),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__( 'Select an option...', 'shofa' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__( 'Widget Number 4', 'shofa' ),
            '3' => esc_html__( 'Widget Number 3', 'shofa' ),
            '2' => esc_html__( 'Widget Number 2', 'shofa' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'shofa_footer_bg',
        'label'       => esc_html__( 'Footer Background Image.', 'shofa' ),
        'description' => esc_html__( 'Footer Background Image.', 'shofa' ),
        'section'     => 'footer_setting',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'shofa_footer_bg_color',
        'label'       => __( 'Footer BG Color', 'shofa' ),
        'description' => esc_html__( 'This is a Footer bg color control.', 'shofa' ),
        'section'     => 'footer_setting',
        'default'     => '#f8f8f8',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'shofa_footer_bottom_color',
        'label'       => __( 'Footer Bottom Color', 'shofa' ),
        'description' => esc_html__( 'This is a Footer bottom color control.', 'shofa' ),
        'section'     => 'footer_setting',
        'default'     => '#ededed',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'        => 'textarea',
        'settings'    => 'shofa_footer_left_link',
        'label'       => __( 'Footer Bottom Left Links', 'shofa' ),
        'description' => esc_html__( 'Example: <a href="your-link">Link Text</a>.', 'shofa' ),
        'section'     => 'footer_setting',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'        => 'textarea',
        'settings'    => 'shofa_footer_right_link',
        'label'       => __( 'Footer Bottom Right Links', 'shofa' ),
        'description' => esc_html__( 'Example: <a href="your-link">Link Text</a>.', 'shofa' ),
        'section'     => 'footer_setting',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'shofa_footer_payment',
        'label'       => esc_html__( 'Footer Payment Image.', 'shofa' ),
        'description' => esc_html__( 'Footer Payment Image.', 'shofa' ),
        'section'     => 'footer_setting',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_2_switch',
        'label'    => esc_html__( 'Footer Style 2 On/Off', 'shofa' ),
        'section'  => 'footer_setting',
        'default'  => '2',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_copyright',
        'label'    => esc_html__( 'Copyright', 'shofa' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copyright &copy; 2023 Theme_Pure. All Rights Reserved', 'shofa' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );

// color
function shofa_color_fields( $fields ) {
    // Color Settings 1
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'SHOFA_THEME_color_1',
        'label'       => __( 'Theme Color', 'shofa' ),
        'description' => esc_html__( 'This is a Theme color control.', 'shofa' ),
        'section'     => 'color_setting',
        'default'     => '#ed5d43',
        'priority'    => 10,
    ];

    // Color Settings 2
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'SHOFA_THEME_color_2',
        'label'       => __( 'Theme Heading Color', 'shofa' ),
        'description' => esc_html__( 'This is a Theme color control.', 'shofa' ),
        'section'     => 'color_setting',
        'default'     => '#040404',
        'priority'    => 10,
    ];
    
    // Color Settings body
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'shofa_body_color',
        'label'       => __( 'Theme Body Color', 'shofa' ),
        'description' => esc_html__( 'This is a Theme color control.', 'shofa' ),
        'section'     => 'color_setting',
        'default'     => '#777777',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', 'shofa_color_fields' );

// 404
function shofa_404_fields( $fields ) {
    // 404 settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'shofa_404_bg',
        'label'       => esc_html__( '404 Image.', 'shofa' ),
        'description' => esc_html__( '404 Image.', 'shofa' ),
        'section'     => '404_page',
        'default'     => get_template_directory_uri() . '/assets/img/icon/error.png'
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_error_title',
        'label'    => esc_html__( 'Not Found Title', 'shofa' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! Page not found', 'shofa' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'shofa_error_desc',
        'label'    => esc_html__( '404 Description Text', 'shofa' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Whoops, this is embarassing. Looks like the page you were looking for was not found.', 'shofa' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'shofa' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'shofa' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'shofa_404_fields' );

// course_settings
function shofa_learndash_fields( $fields ) {

    $fields[] = [
        'type'     => 'number',
        'settings' => 'shofa_learndash_post_number',
        'label'    => esc_html__( 'Learndash Post Per page', 'shofa' ),
        'section'  => 'learndash_course_settings',
        'default'  => 6,
        'priority' => 10,
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'shofa_learndash_order',
        'label'       => esc_html__( 'Post Order', 'shofa' ),
        'section'     => 'learndash_course_settings',
        'default'     => 'DESC',
        'placeholder' => esc_html__( 'Select an option...', 'shofa' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'ASC' => esc_html__( 'ASC', 'shofa' ),
            'DESC' => esc_html__( 'DESC', 'shofa' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_learndash_related',
        'label'    => esc_html__( 'Show Related?', 'shofa' ),
        'section'  => 'learndash_course_settings',
        'default'  => 1,
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    return $fields;

}

if ( class_exists( 'SFWD_LMS' ) ) {
add_filter( 'kirki/fields', 'shofa_learndash_fields' );
}


// shopsettings
function shofa_shop_fields( $fields ) {
    $fields[] = [
        'type' => 'toggle',
        'settings' => 'bacola_free_shipping',
        'label' => esc_attr__( 'Free shipping bar', 'shofa' ),
        'section' => 'shop_sections',
        'default' => '0',
    ];     

    $fields[] = [
        'type' => 'text',
        'settings' => 'shipping_progress_bar_amount',
        'label' => esc_attr__( 'Goal Amount', 'shofa' ),
        'description' => esc_attr__( 'Amount to reach 100% defined in your currency absolute value. For example: 300', 'shofa' ),
        'section' => 'shop_sections',
        'default' => '100',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];     

    $fields[] = [
        'type' => 'toggle',
        'settings' => 'shipping_progress_bar_location_mini_cart',
        'label' => esc_attr__( 'Mini cart', 'shofa' ),
        'section' => 'shop_sections',
        'default' => '0',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];  

    $fields[] = [
        'type' => 'toggle',
        'settings' => 'shipping_progress_bar_location_card_page',
        'label' => esc_attr__( 'Cart page', 'shofa' ),
        'section' => 'shop_sections',
        'default' => '0',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];      

    $fields[] = [
        'type' => 'toggle',
        'settings' => 'shipping_progress_bar_location_checkout',
        'label' => esc_attr__( 'Checkout page', 'shofa' ),
        'section' => 'shop_sections',
        'default' => '0',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];   

    $fields[] = [
        'type' => 'textarea',
        'settings' => 'shipping_progress_bar_message_initial',
        'label' => esc_attr__( 'Initial Message', 'shofa' ),
        'description' => esc_attr__( 'Message to show before reaching the goal. Use shortcode [remainder] to display the amount left to reach the minimum.', 'shofa' ),
        'section' => 'shop_sections',
        'default' => 'Add [remainder] to cart and get free shipping!',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];    

    $fields[] = [
        'type' => 'textarea',
        'settings' => 'shipping_progress_bar_message_success',
        'label' => esc_attr__( 'Success message', 'shofa' ),
        'description' => esc_attr__( 'Message to show after reaching 100%.', 'shofa' ),
        'section' => 'shop_sections',
        'default' => 'Your order qualifies for free shipping!',
        'required' => array(
            array(
              'setting'  => 'bacola_free_shipping',
              'operator' => '==',
              'value'    => '1',
            ),
        ),
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_g_switch',
        'label'    => esc_html__( 'Active Product Details Feature', 'shofa' ),
        'section'  => 'shop_sections',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'shofa_buy_new_button_switch',
        'label'    => esc_html__( 'Buy New Button ON/OFF', 'shofa' ),
        'section'  => 'shop_sections',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    $fields[] = [
        'type' => 'text',
        'settings' => 'buy_new_button_text',
        'label' => esc_attr__( 'Buy New Button Text', 'shofa' ),
        'description' => esc_attr__( 'Amount to reach 100% defined in your currency absolute value. For example: 300', 'shofa' ),
        'section' => 'shop_sections',
        'default' => 'Buy New', 'shofa',
    ];
    
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'mobile_menu_bar',
        'label'    => esc_html__( 'Mobile Menu Bar ON/OFF', 'shofa' ),
        'section'  => 'shop_sections',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
    ];

    // repeater start
    $fields[] = [
        'type'     => 'repeater',
        'label'    => esc_html__( 'Product Special Features', 'shofa' ),
        'section'  => 'shop_sections',
        'row_label'=> [
        'type'     => 'text',
        'value'    => esc_html__( 'Features Number', 'shofa' ),
    ],
        
    'button_label' => esc_html__('Add new Gallery Item', 'shofa' ),

    'settings'     => 'shofa_side_gallery_items',
        'fields' => [
            'shofa_g_image' => [
                'type'         => 'image',
                'label'        => esc_html__( 'Icon Image', 'shofa' ),
                'description'  => esc_attr__( 'Upload Icon Image', 'shofa' ),
            ],
            'shofa_g_icon' => [
                'type'         => 'text',
                'label'        => esc_html__( 'Icon Class', 'shofa' ),
                'description'  => esc_attr__( 'Insert Icon Class', 'shofa' ),
            ],
            'shofa_g_txt' => [
                'type'         => 'textarea',
                'label'        => esc_html__( 'Features Title', 'shofa' ),
                'description'  => esc_attr__( 'write feature content..', 'shofa' ),
            ]
        ]
    ];
    // repeater end

    return $fields;
}

if (  class_exists( 'WooCommerce' ) ) {
    add_filter( 'kirki/fields', 'shofa_shop_fields' );
}


/**
 * Added Fields
 */
function shofa_typo_fields( $fields ) {
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__( 'Body Font', 'shofa' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__( 'Heading h1 Fonts', 'shofa' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__( 'Heading h2 Fonts', 'shofa' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__( 'Heading h3 Fonts', 'shofa' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__( 'Heading h4 Fonts', 'shofa' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__( 'Heading h5 Fonts', 'shofa' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__( 'Heading h6 Fonts', 'shofa' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter( 'kirki/fields', 'shofa_typo_fields' );


// course_settings
function shofa_course_fields( $fields ) {

    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'course_style',
        'label'       => esc_html__( 'Select Course Style', 'shofa' ),
        'section'     => 'tutor_course_settings',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'shofa' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'standard'   => get_template_directory_uri() . '/inc/img/course/course-1.jpg',
            'course_with_sidebar' => get_template_directory_uri() . '/inc/img/course/course-2.jpg',
            'course_solid'  => get_template_directory_uri() . '/inc/img/course/course-3.jpg',
        ],
        'default'     => 'standard',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_search_switch',
        'label'    => esc_html__( 'Show search?', 'shofa' ),
        'section'  => 'tutor_course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_latest_post_switch',
        'label'    => esc_html__( 'Show latest post?', 'shofa' ),
        'section'  => 'tutor_course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_category_switch',
        'label'    => esc_html__( 'Show category filter?', 'shofa' ),
        'section'  => 'tutor_course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_skill_switch',
        'label'    => esc_html__( 'Show skill filter?', 'shofa' ),
        'section'  => 'tutor_course_settings',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'shofa' ),
            'off' => esc_html__( 'Disable', 'shofa' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;

}

add_filter( 'kirki/fields', 'shofa_course_fields' );




/**
 * Added Fields
 */
function shofa_slug_setting( $fields ) {
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_ev_slug',
        'label'    => esc_html__( 'Event Slug', 'shofa' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourevent', 'shofa' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'shofa_port_slug',
        'label'    => esc_html__( 'Portfolio Slug', 'shofa' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourportfolio', 'shofa' ),
        'priority' => 10,
    ];

    return $fields;
}

add_filter( 'kirki/fields', 'shofa_slug_setting' );


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function SHOFA_THEME_option( $name ) {
    $value = '';
    if ( class_exists( 'shofa' ) ) {
        $value = Kirki::get_option( shofa_get_theme(), $name );
    }

    return apply_filters( 'SHOFA_THEME_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function shofa_get_theme() {
    return 'shofa';
}