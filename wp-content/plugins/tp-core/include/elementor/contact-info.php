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
class TP_Contact_Info extends Widget_Base {

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
		return 'contact-info';
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
		return __( 'Contact Info', 'tpcore' );
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
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

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
                'default' => esc_html__('TP Description Content Here', 'tpcore'),
                'placeholder' => esc_html__('Type Description Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_social_icon_title',
            [
                'label' => esc_html__('Social Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Follow Us On', 'tpcore'),
                'placeholder' => esc_html__('Type Description Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_social_icon',
            [
                'label' => esc_html__('Social icon', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Social Icon and Link', 'tpcore'),
                'placeholder' => esc_html__('Type Description Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            '_TP_contact_info',
            [
                'label' => esc_html__('Contact  List', 'tpcore'),
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
                    'tp_box_icon_type' => 'svg'
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
                        'tp_box_icon_type' => 'icon'
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
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_contact_info_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Email',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_contact_info',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '201 Stokes New York',
                'label_block' => true,
            ]
        );     
        $repeater->add_control(
            'tp_contact_info_url',
            [
                'label' => esc_html__('Contact Info Url', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#',
                'label_block' => true,
            ]
        );     

        $this->add_control(
            'tp_list',
            [
                'label' => esc_html__('Contact Info - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_contact_info_title' => esc_html__('united states', 'tpcore'),
                    ],
                    [
                        'tp_contact_info_title' => esc_html__('south Africa', 'tpcore')
                    ],
                    [
                        'tp_contact_info_title' => esc_html__('United Kingdom', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_contact_info_title }}}',
            ]
        );
        $this->end_controls_section();


	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('contact_info_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('contact_info_title', 'Contact Info - Title', '.tp-el-title');
        $this->tp_basic_style_controls('contact_info_description', 'Contact Info - Description', '.tp-el-content');
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
    $this->add_render_attribute('title_args', 'class', 'section__title-4');
?>

    <div class="contact_info_wrapper">
        <?php foreach ($settings['tp_list'] as $item) : ?>
        <div class="contact_info_item">
            <?php if(!empty($item['tp_contact_info_title'])) : ?>
            <h4><?php echo tp_kses($item['tp_contact_info_title']); ?></h4>
            <?php endif; ?>
            <?php if(!empty($item['tp_contact_info_url'])) : ?>
            <a href="<?php echo esc_url($item['tp_contact_info_url']); ?> "><span><?php echo tp_kses($item['tp_contact_info']); ?> </span></a>
            <?php else : ?>
                <span><?php echo tp_kses($item['tp_contact_info']); ?> </span>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <div class="contact_info_item social_icon">
            <h4><?php echo tp_kses($settings['tp_social_icon_title']); ?></h4>
            <?php echo tp_kses($settings['tp_social_icon']); ?>
        </div>
    </div>


<?php else:
    $this->add_render_attribute('title_args', 'class', 'tpshop__title mb-25 tp-el-title');
?>


<div class="tpcontact__right m-0 tp-el-section">
    <div class="tpcontact__shop">
        <?php
        if ( !empty($settings['tp_title' ]) ) :
            printf( '<%1$s %2$s>%3$s</%1$s>',
                tag_escape( $settings['tp_title_tag'] ),
                $this->get_render_attribute_string( 'title_args' ),
                tp_kses( $settings['tp_title' ] )
                );
        endif;
        ?>
        <div class="tpshop__info">
            <ul>
                <?php foreach ($settings['tp_list'] as $item) : ?>
                <li class="tp-el-content">
                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                            <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                        <?php endif; ?>
                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                            <img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (!empty($item['tp_box_icon_svg'])): ?>
                            <?php echo $item['tp_box_icon_svg']; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(!empty($item['tp_contact_info'])) : ?>
                        <?php echo tp_kses($item['tp_contact_info']); ?>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php endif;
	}
}

$widgets_manager->register( new TP_Contact_Info() );