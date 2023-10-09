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
class TP_Order_Track extends Widget_Base {

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
        return 'order-track';
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
        return __( 'Order Tracker', 'tpcore' );
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

    public function get_tp_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $tp_forms       = get_posts( $tp_cf_args );
        $tp_cfa         = ['0' => esc_html__( 'Select Form', 'tpcore' ) ];
        if( $tp_forms ){
            foreach ( $tp_forms as $tp_form ){
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        }else{
            $tp_cfa[ esc_html__( 'No contact form found', 'tpcore' ) ] = 0;
        }
        return $tp_cfa;
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
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
            ]
        );
        $this->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                ]
            ]
        );

        $this->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                    ]
                ]
            );
        }

        $this->add_control(
            'tp_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'tp_title_tag',
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

        $this->add_control(
            'tp_des',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TP Description Content Here.', 'tpcore'),
                'placeholder' => esc_html__('Type Description Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();

        
        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();
    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('order_track_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('order_track_title', 'Order Track - Title', '.tp-el-title');
        $this->tp_basic_style_controls('order_track_description', 'Order Track - Description', '.tp-el-content');
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ):
    $this->add_render_attribute('title_args', 'class', 'tp-title');
?>

<?php else:
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'tptrack__item-title tp-el-title');
?>

<section class="track-area pt-80 pb-80 tp-el-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="tptrack__product">
                    <?php if(!empty($tp_image)) : ?>
                    <div class="tptrack__thumb">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="tptrack__content grey-bg-3">
                        <div class="tptrack__item d-flex mb-20">
                            <div class="tptrack__item-icon">
                            <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                    <?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                <?php endif; ?>
                            <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>
                            <?php else : ?>
                                <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                    <?php echo $settings['tp_box_icon_svg']; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            </div>
                            <div class="tptrack__item-content">
                                <?php
                                    if ( !empty($settings['tp_title' ]) ) :
                                        printf( '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape( $settings['tp_title_tag'] ),
                                            $this->get_render_attribute_string( 'title_args' ),
                                            tp_kses( $settings['tp_title' ] )
                                            );
                                    endif;
                                ?>
                                <?php if(!empty($settings['tp_des'])) : ?>
                                <p class="tp-el-content"><?php echo tp_kses($settings['tp_des']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if(class_exists('CBWCT_ORDER_TRACKER')) : ?>
                        <div class="tptrack__id mb-10">
                            <?php echo do_shortcode('[cbwct-order-tracker]'); ?>
                        </div>
                        <?php else : ?>
                            <?php echo '<div class="alert alert-info"><p class="m-0">' . __("Please install following plugin 'Order Tracker for WooCommerce'.", 'tpcore' ). '</p></div>'; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php endif;
    }
}

$widgets_manager->register( new TP_Order_Track() );