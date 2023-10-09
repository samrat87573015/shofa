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
class TP_Features extends Widget_Base {

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
		return 'features';
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
		return __( 'Features', 'tpcore' );
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

        // Feature group
        $this->start_controls_section(
            'tp_features',
            [
                'label' => esc_html__('Features List', 'tpcore'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
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
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1', 'style_2'],
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                    'repeater_condition' => ['style_1', 'style_2'],
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1', 'style_2'],
                    ]
                ]
            );
        } else {
            $repeater->add_control(
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
                        'repeater_condition' => ['style_1', 'style_2'],
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_features_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Feature Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_link_switcher',
            [
                'label' => esc_html__( 'Add Features link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_2'],
                ]
                         
            ]
        );
        $repeater->add_control(
            'tp_features_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_features_link_switcher' => 'yes',
                    'repeater_condition' => ['style_2'],
                ],
            ]
        );
        $repeater->add_control(
            'tp_features_link_type',
            [
                'label' => esc_html__( 'Features Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_features_link_switcher' => 'yes',
                    'repeater_condition' => ['style_2'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_features_link',
            [
                'label' => esc_html__( 'Features Link link', 'tpcore' ),
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
                    'tp_features_link_type' => '1',
                    'tp_features_link_switcher' => 'yes',
                    'repeater_condition' => ['style_2'],
                ]
            ]
        );
        $repeater->add_control(
            'tp_features_page_link',
            [
                'label' => esc_html__( 'Select Feature Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_features_link_type' => '2',
                    'tp_features_link_switcher' => 'yes',
                    'repeater_condition' => ['style_2'],
                ]
            ]
        );

        $this->add_control(
            'tp_features_list',
            [
                'label' => esc_html__('Features - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_features_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_features_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-post-thumb',
            ]
        );
        $this->end_controls_section();

        // colum controls
        $this->tp_columns('col');
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('features_section', 'Section - Style', '.ele-section');
        $this->tp_icon_style('features_box_icon', 'Features - Icon/Image/SVG', '.ele-box-icon');
        $this->tp_basic_style_controls('features_box_number', 'Features Box Title - Style', '.ele-box-title');
        $this->tp_basic_style_controls('features_box_des', 'Features Box Description - Style', '.ele-box-des');
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
    $this->add_render_attribute('title_args', 'class', 'section__title-6 tp-el-title');    
?>

<?php else: 
    $bloginfo = get_bloginfo( 'name' );
    $this->add_render_attribute('title_args', 'class', 'section__title-7 tp-el-title');    
?>

<section class="services-area pt-70 ele-section">
    <div class="container">
        <div class="row services-gx-item">

            <?php foreach ($settings['tp_features_list'] as $key => $item) :
                // Link
                if ('2' == $item['tp_features_link_type']) {
                    $link = get_permalink($item['tp_features_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_features_link']['url']) ? $item['tp_features_link']['url'] : '';
                    $target = !empty($item['tp_features_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_features_link']['nofollow']) ? 'nofollow' : '';
                }

            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                <div class="tpservicesitem d-flex align-items-center mb-30">
                    <div class="tpservicesitem__icon mr-20 ele-box-icon">
                        <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                            <?php endif; ?>
                        <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                <img src="<?php echo $item['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                <?php echo $item['tp_box_icon_svg']; ?>
                            <?php endif; ?>
                        <?php endif; ?>                         
                    </div>
                    <div class="tpservicesitem__content">
                        <?php if (!empty($item['tp_features_title' ])): ?>
                        <h4 class="tpservicesitem__title ele-box-title"><?php echo tp_kses($item['tp_features_title' ]); ?></h4>
                        <?php endif; ?>
                        <?php if (!empty($item['tp_features_description' ])): ?>
                        <p class="ele-box-des"><?php echo tp_kses($item['tp_features_description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div> 
</section>

<?php endif; ?>

<?php
	}
}

$widgets_manager->register( new TP_Features() );