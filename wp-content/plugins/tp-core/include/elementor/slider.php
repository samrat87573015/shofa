<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Main_Slider extends Widget_Base {

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
		return 'tp-slider';
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
		return __( 'Slider', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

		
		$this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Main Slider', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                    'style_3' => __( 'Style 3', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );



        $repeater->add_control(
            'tp_slider_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'tp_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2']
                ]
            ]
        );
        $repeater->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Grow business.', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_slider_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $repeater->add_control(
            'tp_slider_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

		$repeater->add_control(
            'tp_btn_link_switcher',
            [
                'label' => esc_html__( 'Add Button link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_btn_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__( 'Button Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__( 'Button Link link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__( 'Select Button Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_slider_shape_image',
            [
                'label' => esc_html__('Upload Shape Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_3']
                ]
            ]
        );        
        
        $repeater->add_control(
            'tp_slider_bottom_text',
            [
                'label' => esc_html__('Bottom Text', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Start From $99.99', 'tpcore'),
                'title' => esc_html__('Enter buttom text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_3']
                ],
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Grow business.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Development.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Marketing.', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        $this->end_controls_section();
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('slider_section', 'Section - Style', '.ele-section');
        $this->tp_basic_style_controls('slider_sub_title', 'Slider Sub Title - Style', '.ele-sub-title');
        $this->tp_basic_style_controls('slider_title', 'Slider Title - Style', '.ele-title');
        $this->tp_basic_style_controls('slider_content', 'Slider Content - Style', '.ele-content');
        $this->tp_link_controls_style('slider_button', 'Slider Button - Style', '.ele-slider-button');

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

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

    
<section class="slider-area slider-bg slider-bg-height ele-section">
    <div class="slider-pagination-2 p-relative">
        <div class="swiper-containers slidertwo-active">
            <div class="swiper-wrapper">
                <?php foreach ($settings['slider_list'] as $item) :
                    $this->add_render_attribute('title_args', 'class', 'tpslidertwo__title mb-10 ele-title');
                    if ( !empty($item['tp_slider_shape_image']['url']) ) {
                        $tp_slider_shape_image = !empty($item['tp_slider_shape_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_shape_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_shape_image']['url'];
                        $tp_slider_shape_image_alt = get_post_meta($item["tp_slider_shape_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    if ( !empty($item['tp_slider_image']['url']) ) {
                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    // btn Link
                    if ('2' == $item['tp_btn_link_type']) {
                        $link = get_permalink($item['tp_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                        $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                <div class="swiper-slide slider-bg">
                    <div class="container">
                        <div class="slider-top-padding pt-55">
                            <div class="row p-relative align-items-end">
                                <div class="col-xl-5 col-lg-6 col-md-6 d-flex align-self-center">
                                    <div class="tpslidertwo__item">
                                        <div class="tpslidertwo__content">
                                            <?php if (!empty($item['tp_slider_sub_title'])) : ?>
                                            <h4 class="tpslidertwo__sub-title ele-sub-title"><?php echo tp_kses( $item['tp_slider_sub_title'] ); ?></h4>
                                            <?php endif; ?>
                                            <?php
                                                if ($item['tp_slider_title_tag']) :
                                                    printf('<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape($item['tp_slider_title_tag']),
                                                    $this->get_render_attribute_string('title_args'),
                                                    tp_kses($item['tp_slider_title'])
                                                    );
                                                endif;
                                            ?>
                                            <?php if (!empty($item['tp_slider_description'])) : ?>
                                            <p class="ele-content"><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                            <?php endif; ?> 

                                            <?php if(!empty($item['tp_btn_btn_text'])) : ?>
                                            <div class="tpslidertwo__slide-btn">
                                                <a class="tp-btn banner-animation ele-slider-button" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>"><?php echo tp_kses($item['tp_btn_btn_text']); ?></a>
                                            </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-lg-6 col-md-6 d-none d-md-block">
                                    <div class="tpslidertwo__img p-relative text-end">
                                        <?php if(!empty($tp_slider_image_url)) : ?>
                                        <img src="<?php echo esc_url($tp_slider_image_url); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                        <?php endif; ?>
                                        <?php if(!empty($tp_slider_shape_image)) : ?>
                                        <div class="tpslidertwo__img-shape">
                                            <img src="<?php echo esc_url($tp_slider_shape_image); ?>" alt="<?php echo esc_attr($tp_slider_shape_image_alt); ?>">
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?> 
            </div>
        </div>
        <div class="slider-two-pagination">
            <div class="container">
                <div class="slider-two-pagination-item p-relative">
                    <div class="slidertwo_pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): ?>

<section class="slider-area ele-section">
    <div class="secondary-slider p-relative">
        <div class="swiper-container greenslider-active">
            <div class="swiper-wrapper">
                <?php foreach ($settings['slider_list'] as $item) :
                    $this->add_render_attribute('title_args', 'class', 'tpslidertwo__title mb-10 ele-title');
                    if ( !empty($item['tp_slider_shape_image']['url']) ) {
                        $tp_slider_shape_image = !empty($item['tp_slider_shape_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_shape_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_shape_image']['url'];
                        $tp_slider_shape_image_alt = get_post_meta($item["tp_slider_shape_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    if ( !empty($item['tp_slider_image']['url']) ) {
                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    // btn Link
                    if ('2' == $item['tp_btn_link_type']) {
                        $link = get_permalink($item['tp_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                        $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                <div class="swiper-slide slider-bg-2 slider-3">
                    <div class="container">
                        <div class="row p-relative justify-content-xl-end align-items-center">
                            <div class="col-xl-5 col-lg-6 col-md-6">
                                <div class="tpslidertwo__content slider-content-3">
                                    <?php
                                    if ($item['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($item['tp_slider_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        tp_kses($item['tp_slider_title'])
                                        );
                                    endif;
                                    ?>
                                    <?php if (!empty($item['tp_slider_description'])) : ?>
                                    <p class="ele-content"><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                    <?php endif; ?> 
                                    <div class="tpslidertwo__slide-btn d-flex align-items-center ">
                                        <?php if(!empty($item['tp_btn_btn_text'])) : ?>
                                        <a class="tp-btn banner-animation mr-25 ele-slider-button" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" ><?php echo tp_kses($item['tp_btn_btn_text']); ?></a>
                                        <?php endif; ?>

                                        <?php if(!empty($item['tp_slider_bottom_text'])) : ?>
                                        <span><?php echo tp_kses($item['tp_slider_bottom_text']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-6 col-md-6 d-none d-md-block">
                                <div class="tpsliderthree__img p-relative text-end pt-55">
                                    <?php if(!empty($tp_slider_image_url)) : ?>
                                    <img src="<?php echo esc_url($tp_slider_image_url); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                    <?php endif; ?>
                                    <?php if(!empty($tp_slider_shape_image)) : ?>
                                    <div class="tpslidertwo__img-shape">
                                        <img src="<?php echo esc_url($tp_slider_shape_image); ?>" alt="<?php echo esc_attr($tp_slider_shape_image_alt); ?>">
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?> 
            </div>
        </div>
        <div class="greenslider-pagination"></div>
    </div>
</section>

<?php else: 
    if ( ! empty( $settings['tp_slider_mouse_link']['url'] ) ) {
        $this->add_link_attributes( 'tp-button-arg', $settings['tp_slider_mouse_link'] );
        $this->add_render_attribute('tp-button-arg', 'class', 'mouse-scroll-btn');
    }
?>

    <!-- slider-area-start -->
    <div class="slider-area slider-bg p-relative fix">
        <div class="slider-pagination-2 p-relative">
            <div class="swiper-containers slidertwo-active">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['slider_list'] as $item) :
                        $this->add_render_attribute('title_args', 'class', 'tpslidertwo__title mb-10');
                        if ( !empty($item['tp_slider_image']['url']) ) {
                            $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                            $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                        // btn Link
                        if ('2' == $item['tp_btn_link_type']) {
                            $link = get_permalink($item['tp_btn_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                            $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>

                    <div class="swiper-slide slider-bg">
                        <div class="slider-bg-shap">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/slider-bg-shap.png" alt="">
                        </div>
                        <div class="container">
                            <div class="slider-top-padding">
                                <div class="row p-relative align-items-center">
                                    <div class="col-xl-5 col-lg-6 col-md-6 d-flex align-self-center">
                                        <div class="tpslidertwo__item">
                                            <div class="tpslidertwo__content">
                                                <?php if (!empty($item['tp_slider_sub_title'])) : ?>
                                                <h4 class="tp-slide-item__sub-title ele-sub-title"><?php echo tp_kses( $item['tp_slider_sub_title'] ); ?></h4>
                                                <?php endif; ?>
                                                <?php
                                                if ($item['tp_slider_title_tag']) :
                                                    printf('<%1$s %2$s>%3$s</%1$s>',
                                                    tag_escape($item['tp_slider_title_tag']),
                                                    $this->get_render_attribute_string('title_args'),
                                                    tp_kses($item['tp_slider_title'])
                                                    );
                                                endif;
                                                ?>
                                                <?php if (!empty($item['tp_slider_description'])) : ?>
                                                <p><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                                                <?php endif; ?> 
                                                <div class="tpslidertwo__slide-btn">
                                                    <?php if(!empty($item['tp_btn_btn_text'])) : ?>
                                                    <a href="<?php echo esc_url($link); ?>" class="tp-btn banner-animation" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>"><?php echo tp_kses($item['tp_btn_btn_text']); ?><i class="fal fa-long-arrow-right"></i></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-lg-6 col-md-6">
                                        <?php if(!empty($tp_slider_image_url)) : ?>
                                        <div class="tpslidertwo__img p-relative text-end">
                                            <img src="<?php echo esc_url($tp_slider_image_url); ?>" alt="<?php echo esc_attr($tp_slider_image_alt); ?>">
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="slider-two-pagination">
                <div class="container">
                    <div class="slider-two-pagination-item p-relative">
                        <div class="slidertwo_pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->


<?php endif;  
	}
}

$widgets_manager->register( new TP_Main_Slider() );