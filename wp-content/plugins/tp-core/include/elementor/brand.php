<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Brand extends Widget_Base {

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
		return 'tp-brand';
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
		return __( 'Brand', 'tpcore' );
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

		$this->start_controls_section(
            'tp_brand_section',
            [
                'label' => __( 'Brand Item', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_brand_title',
            [
                'label'       => esc_html__( 'Brand Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'TP Title Here', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title Text', 'tpcore' ),
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


        $repeater->add_control(
            'tp_brand_image',
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
        $this->add_control(
            'tp_brand_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Brand Item', 'tpcore' ),
                'default' => [
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_brand_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
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

        $this->end_controls_section();
	}


    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('section_section', 'Section - Subtitle', '.tp-el-section');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 
    $this->add_render_attribute('title_args', 'class', 'tp-title tp-el-title');
?>

<section class="brand-area tpbrand black-bg-2 pt-65 pb-60 tp-el-section">
    <div class="container">
        <?php if(!empty($settings['tp_brand_title'])) : ?>
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="tpsection text-center mb-45">
                    <h4 class="tpsection__title left-line right-line tp-el-title"><?php echo tp_kses($settings['tp_brand_title']); ?></h4>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="swiper-container brand-active">
            <div class="swiper-wrapper brand-items">

                <?php foreach ($settings['tp_brand_slides'] as $item) :
                    if ( !empty($item['tp_brand_image']['url']) ) {
                        $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                        $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
                <div class="swiper-slide">
                    <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_attr($tp_brand_image_alt); ?>">
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>

<?php else : 
    $this->add_render_attribute('title_args', 'class', 'award__title-4 tp-el-title');
?>

<section class="brand-area theme-bg pt-110 pb-90 tp-el-section">
    <div class="container">
        <?php if(!empty($settings['tp_brand_title'])) : ?>
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="tpsection solid-line text-center mb-45">
                    <h4 class="tpsection__title tp-el-title"><?php echo tp_kses($settings['tp_brand_title']); ?></h4>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="swiper-container brand-active">
            <div class="swiper-wrapper brand-items black-bg-brand">

                <?php foreach ($settings['tp_brand_slides'] as $item) :
                    if ( !empty($item['tp_brand_image']['url']) ) {
                        $tp_brand_image_url = !empty($item['tp_brand_image']['id']) ? wp_get_attachment_image_url( $item['tp_brand_image']['id'], $settings['thumbnail_size']) : $item['tp_brand_image']['url'];
                        $tp_brand_image_alt = get_post_meta($item["tp_brand_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
                <div class="swiper-slide">
                    <img src="<?php echo esc_url($tp_brand_image_url); ?>" alt="<?php echo esc_attr($tp_brand_image_alt); ?>">
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>

    <?php endif; 
	}


}

$widgets_manager->register( new TP_Brand() );
