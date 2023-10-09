<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Team extends Widget_Base {

    use \TPCore\Widgets\TPCoreElementFunctions;

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tp-team';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Team', 'tpcore' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'tp-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'tpcore' ];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'tpcore' ];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }
    protected function register_controls_section() {
        

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        // tp_section_title
        $this->tp_section_title_render_controls('team', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __( 'Members', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'tpcore' ),
                'default' => __( 'TP Member Title', 'tpcore' ),
                'placeholder' => __( 'Type title here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'tpcore' ),
                'default' => __( 'TP Officer', 'tpcore' ),
                'placeholder' => __( 'Type designation here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );   

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'tpcore' ),
                'label_off' => __( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'tpcore' ),
                'placeholder' => __( 'Add your profile link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'tpcore' ),
                'placeholder' => __( 'Add your email link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'tpcore' ),
                'placeholder' => __( 'Add your phone link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your facebook link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your twitter link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your instagram link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'tpcore' ),
                'placeholder' => __( 'Add your linkedin link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'tpcore' ),
                'placeholder' => __( 'Add your youtube link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'tpcore' ),
                'placeholder' => __( 'Add your Google Plus link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'tpcore' ),
                'placeholder' => __( 'Add your flickr link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'tpcore' ),
                'placeholder' => __( 'Add your vimeo link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'tpcore' ),
                'placeholder' => __( 'Add your hehance link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'tpcore' ),
                'placeholder' => __( 'Add your dribbble link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'tpcore' ),
                'placeholder' => __( 'Add your pinterest link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'tpcore' ),
                'placeholder' => __( 'Add your github link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'tpcore' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'tpcore' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'tpcore' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'tpcore' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'tpcore' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'tpcore' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'team_shape_sec',
             [
               'label' => esc_html__( 'Shape Control', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                'tp_design_style' => 'layout-4'
               ]
             ]
        );
        
        $this->add_control(
         'team_shape_switch',
         [
           'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
           'type'         => \Elementor\Controls_Manager::SWITCHER,
           'label_on'     => esc_html__( 'Show', 'tpcore' ),
           'label_off'    => esc_html__( 'Hide', 'tpcore' ),
           'return_value' => 'yes',
           'default'      => 'yes',
         ]
        );
        
        $this->end_controls_section();

        $this->tp_button_render('team_view_all', 'Team More', [ 'layout-2', 'layout-3'] );
 
    }

    
    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('team_subtitle', 'Team - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('team_title', 'Team - Title', '.tp-el-title');
        $this->tp_basic_style_controls('team_description', 'Team - Description', '.tp-el-content');

        $this->tp_basic_style_controls('team_box_subtitle', 'Designation - Box -  Designation', '.tp-el-box-designation');
        $this->tp_basic_style_controls('team_box_title', 'Name - Box - Title', '.tp-el-box-name');
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>

<!-- style 2 -->
<?php if ( $settings['tp_design_style'] === 'layout-2' ): 
    $this->add_render_attribute( 'title_args', 'class', 'section__title-4 tp-el-title' );
    $this->add_render_attribute( 'title_team', 'class', 'team__title-4 tp-el-box-title' );

    // Link
    if ('2' == $settings['tp_team_view_all_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_team_view_all_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-brown tp-el-box-btn');
    } else {
        if ( ! empty( $settings['tp_team_view_all_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_team_view_all_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-border-brown tp-el-box-btn');
        }
    }

?>


<!-- style default -->
<?php else : 
    $this->add_render_attribute('title_args', 'class', 'tpabout__inner-title tp-el-title');
    $this->add_render_attribute( 'title_team', 'class', 'tpteam__title tp-el-box-name' );

    // Link
    if ('2' == $settings['tp_team_view_all_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_team_view_all_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-link-btn-2 tp-el-box-more-btn');
    } else {
        if ( ! empty( $settings['tp_team_view_all_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_team_view_all_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-link-btn-2 tp-el-box-more-btn');
        }
    }

?>

<section class="team-area grey-bg-3 pb-30 tp-el-section">
    <div class="container">
        <?php if ( !empty($settings['tp_team_section_title_show']) ) : ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="tpabout__inner-title-area mt-65 mb-45 text-center">
                    <?php if(!empty($settings['tp_team_sub_title' ])) : ?>
                    <h4 class="tpabout__inner-sub-title tp-el-subtitle"><?php echo tp_kses($settings['tp_team_sub_title' ]); ?></h4>
                    <?php endif; ?>
                    <?php
                    if ( !empty($settings['tp_team_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_team_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_team_title' ] )
                        );
                    endif;
                    ?>
                    <?php if(!empty($settings['tp_team_description' ])) : ?>
                    <p class="tp-el-content"><?php echo tp_kses($settings['tp_team_description' ]); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="swiper-container tp-team-active">
            <div class="swiper-wrapper">

                <?php foreach ( $settings['teams'] as $item ) :
                    $title = tp_kses( $item['title' ] );
                    $item_url = esc_url($item['item_url']);

                    if ( !empty($item['image']['url']) ) {
                        $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                        $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                    }            
                ?>
                <div class="swiper-slide">
                    <div class="tpteam__item p-relative mb-40">
                        <?php if( !empty($tp_team_image_url) ) : ?>
                        <div class="tpteam__thumb">
                            <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="tpteam__content">
                            <?php if( !empty($item['designation']) ) : ?>
                            <h4 class="tpteam__position tp-el-box-designation"><?php echo tp_kses( $item['designation'] ); ?></h4>
                            <?php endif; ?>
                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title_team' ),
                                $title,
                                $item_url
                            ); ?>

                        <?php if( !empty($item['show_social'] ) ) : ?>                
                        <div class="tpteam__social_area">
                            <?php if( !empty($item['web_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['web_title'] ); ?>"><i
                                    class="fa fa-globe"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['email_title'] ) ) : ?>
                            <a href="mailto:<?php echo esc_url( $item['email_title'] ); ?>"><i
                                    class="fa fa-envelope"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['phone_title'] ) ) : ?>
                            <a href="tell:<?php echo esc_url( $item['phone_title'] ); ?>"><i
                                    class="fa fa-phone"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i
                                    class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['twitter_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i
                                    class="fab fa-twitter"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i
                                    class="fab fa-instagram"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['linkedin_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['youtube_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i
                                    class="fab fa-youtube"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['googleplus_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i
                                    class="fab fa-google-plus-g"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['flickr_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i
                                    class="fab fa-flickr"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['vimeo_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i
                                    class="fab fa-vimeo-v"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['behance_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i
                                    class="fab fa-behance"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['dribble_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i
                                    class="fab fa-dribbble"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i
                                    class="fab fa-pinterest-p"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($item['gitub_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i
                                    class="fab fa-github"></i></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>



<section class="team__area pt-115 tp-el-section d-none">
    <div class="container">
        <?php if ( !empty($settings['tp_team_section_title_show']) ) : ?>
        <div class="row align-items-end">
            <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-6 col-sm-7">
                <div class="section__title-wrapper mb-60">
                    <?php
                        if ( !empty($settings['tp_team_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_team_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_team_title' ] )
                                );
                        endif;
                    ?>
                </div>
            </div>
            <div class="col-xxl-7 col-xl-7 col-lg-6 col-md-6 col-sm-5">
                <?php if (!empty($settings['tp_team_view_all_btn_text'])) : ?>
                <div class="team__join mb-70 text-sm-end">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                        <?php echo $settings['tp_team_view_all_btn_text']; ?>
                        <span>
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 7H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xxl-12">
                <div class="team__slider wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1.2s">
                    <div class="team__slider-active swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach ( $settings['teams'] as $item ) :
                                    $title = tp_kses( $item['title' ] );
                                    $item_url = esc_url($item['item_url']);

                                    if ( !empty($item['image']['url']) ) {
                                        $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                        $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                                    }            
                                ?>
                            <div class="team__item swiper-slide">
                                <?php if( !empty($tp_team_image_url) ) : ?>
                                <div class="team__thumb w-img fix transition-3">
                                    <div class="tp-thumb-overlay wow"></div>
                                    <a href="<?php echo esc_attr($item_url); ?>">
                                        <img src="<?php echo esc_url($tp_team_image_url); ?>"
                                            alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                                    </a>
                                    <?php if( !empty($item['show_social'] ) ) : ?>
                                    <div class="team__action">
                                        <ul>
                                            <?php if( !empty($item['email_title'] ) ) : ?>
                                            <li>
                                                <a class="tp-el-box-social-mail"
                                                    href="mailto:<?php echo esc_attr($item['email_title']); ?>"><i
                                                        class="far fa-envelope"></i></a>
                                            </li>
                                            <?php endif; ?>

                                            <li>
                                                <a href="#"><i class="far fa-share-alt"></i></a>
                                                <div class="team__social tp-el-box-social">
                                                    <ul>
                                                        <?php if( !empty($item['web_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['web_title'] ); ?>"><i
                                                                    class="fa-regular fa-globe"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['phone_title'] ) ) : ?>
                                                        <li>
                                                            <a
                                                                href="tel:<?php echo esc_url( $item['phone_title'] ); ?>"><i
                                                                    class="fa-regular fa-phone"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['facebook_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i
                                                                    class="fa-brands fa-facebook-f"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['twitter_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i
                                                                    class="fa-brands fa-twitter"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['instagram_title'] ) ) : ?>
                                                        <li>
                                                            <a
                                                                href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i
                                                                    class="fa-brands fa-instagram"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i
                                                                    class="fa-brands fa-linkedin-in"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['youtube_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i
                                                                    class="fa-brands fa-youtube"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                                        <li>
                                                            <a
                                                                href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i
                                                                    class="fa-brands fa-google-plus-g"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['flickr_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i
                                                                    class="fa-brands fa-flickr"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i
                                                                    class="fa-brands fa-vimeo-v"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['behance_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i
                                                                    class="fa-brands fa-behance"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['dribble_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i
                                                                    class="fa-brands fa-dribbble"></i></a>
                                                        </li>
                                                        <?php endif; ?>
                                                        <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                                        <li>
                                                            <a
                                                                href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i
                                                                    class="fa-brands fa-pinterest-p"></i></a>
                                                        </li>
                                                        <?php endif; ?>

                                                        <?php if( !empty($item['gitub_title'] ) ) : ?>
                                                        <li>
                                                            <a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i
                                                                    class="fa-brands fa-github"></i></a>
                                                        </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <div class="team__content">
                                    <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape( $settings['title_tag'] ),
                                        $this->get_render_attribute_string( 'title_team' ),
                                        $title,
                                        $item_url
                                    ); ?>
                                    <?php if( !empty($item['designation']) ) : ?>
                                    <span
                                        class="team__designation tp-el-box-subtitle"><?php echo tp_kses( $item['designation'] ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="team-slider-dot tp-swiper-dot text-center mt-50"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php
    }
}

$widgets_manager->register( new TP_Team() );