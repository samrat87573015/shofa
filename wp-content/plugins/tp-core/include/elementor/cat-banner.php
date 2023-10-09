<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Cat_Banner extends Widget_Base {
    
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
		return 'tp-cat-banner';
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
		return __( 'Category Banner', 'tpcore' );
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

        // Features group
        $this->start_controls_section(
            'tp_features',
            [
                'label' => esc_html__('Features List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        
        $this->add_control(
            'tp_category_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
            ]
        );

        $this->add_control(
            'tp_category_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_category_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_category_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_category_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_category_selected_icon',
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
                        'tp_category_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $this->add_control(
            'tp_category_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tp-core'),
                'condition' => [
                    'tp_category_icon_type' => 'svg',
                ]
            ]
        );

        $this->add_control(
            'tp_category_item', [
                'label' => esc_html__('Category Item Number', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('20', 'tpcore'),
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'tp_category_title', [
                'label' => esc_html__('Category Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Category Title', 'tpcore'),
                'label_block' => true,
            ]
        );  

        $this->add_control(
            'tp_category_desc', [
                'label' => esc_html__('Category Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Category description here', 'tpcore'),
                'label_block' => true,
            ]
        );  

        $this->add_control(
            'tp_category_url', [
                'label' => esc_html__('URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('cat_banner_section', 'Section - Style', '.ele-section');
        $this->tp_icon_style('cat_banner_icon', 'Category Banner - Icon/Image/SVG', '.ele-icon');
        $this->tp_basic_style_controls('cat_banner_sub_title', 'Category Banner Sub Title - Style', '.ele-sub-title');
        $this->tp_basic_style_controls('cat_banner_title', 'Category Banner Title - Style', '.ele-title');
        $this->tp_link_controls_style('cat_banner_button', 'Category Banner Button - Style', '.ele-button');
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
    $this->add_render_attribute('title_args', 'class', 'title');
?>

        <div class="cta_banner_item p-relative">
            <div class="cta_banner_img w-img">
                <?php if($settings['tp_category_icon_type'] == 'icon') : ?>
                <?php if (!empty($settings['tp_category_icon']) || !empty($settings['tp_category_selected_icon']['value'])) : ?>
                    <?php tp_render_icon($settings, 'tp_category_icon', 'tp_category_selected_icon'); ?>
                <?php endif; ?>
                <?php elseif( $settings['tp_category_icon_type'] == 'image' ) : ?>
                <?php if (!empty($settings['tp_category_image']['url'])): ?>
                    <img src="<?php echo $settings['tp_category_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_category_image']['url']), '_wp_attachment_image_alt', true); ?>">
                <?php endif; ?>
                <?php else : ?>
                <?php if (!empty($settings['tp_category_icon_svg'])): ?>
                    <?php echo $settings['tp_category_icon_svg']; ?>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="cta_banner_content">
                <?php if(!empty($settings['tp_category_title'])) : ?>
                <h4 class="cta_banner_title ele-title">
                    <?php if(!empty($settings['tp_category_url'])) : ?>
                        <a href="<?php echo esc_url($settings['tp_category_url']); ?>"><?php echo tp_kses($settings['tp_category_title']); ?></a>
                    <?php else : ?>
                        <?php echo tp_kses($settings['tp_category_title']); ?>
                    <?php endif ; ?>
                </h4>
                <?php endif; ?>
                <?php if(!empty($settings['tp_category_desc'])) : ?>
                <p><?php echo tp_kses($settings['tp_category_desc']); ?></p>
                <?php endif ; ?>
                <div class="cta_button_area">
                    <a class="cta_btn" href="<?php echo esc_url($settings['tp_category_url']); ?>">Shop Now</a>
                </div>
            </div>
        </div>


<?php else: 
    $this->add_render_attribute('title_args', 'class', 'tpsection__title');
?>

<div class="banneritem__thumb banner-animation text-center p-relative ele-section ele-icon">

    <?php if($settings['tp_category_icon_type'] == 'icon') : ?>
        <?php if (!empty($settings['tp_category_icon']) || !empty($settings['tp_category_selected_icon']['value'])) : ?>
            <?php tp_render_icon($settings, 'tp_category_icon', 'tp_category_selected_icon'); ?>
        <?php endif; ?>
    <?php elseif( $settings['tp_category_icon_type'] == 'image' ) : ?>
        <?php if (!empty($settings['tp_category_image']['url'])): ?>
            <img src="<?php echo $settings['tp_category_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_category_image']['url']), '_wp_attachment_image_alt', true); ?>">
        <?php endif; ?>
    <?php else : ?>
        <?php if (!empty($settings['tp_category_icon_svg'])): ?>
            <?php echo $settings['tp_category_icon_svg']; ?>
        <?php endif; ?>
    <?php endif; ?>

    <div class="banneritem__content">

        <?php if(!empty($settings['tp_category_url'])) : ?>
        <a href="<?php echo esc_url($settings['tp_category_url']); ?>"><i class="far fa-long-arrow-right ele-button"></i></a>
        <?php endif; ?>

        <?php if(!empty($settings['tp_category_item'])) : ?>
        <p class="ele-sub-title"><?php echo tp_kses($settings['tp_category_item']); ?></p>
        <?php endif; ?>

        <?php if(!empty($settings['tp_category_title'])) : ?>
        <h4 class="banneritem__content-tiele ele-title">
            <?php if(!empty($settings['tp_category_url'])) : ?>
                <a href="<?php echo esc_url($settings['tp_category_url']); ?>"><?php echo tp_kses($settings['tp_category_title']); ?></a>
            <?php else : ?>
                <?php echo tp_kses($settings['tp_category_title']); ?>
            <?php endif ; ?>
        </h4>
        <?php endif; ?>
    </div>
</div>

<?php endif;
	}
}

$widgets_manager->register( new TP_Cat_Banner() );