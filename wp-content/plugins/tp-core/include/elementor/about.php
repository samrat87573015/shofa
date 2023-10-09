<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About', 'tp-core' );
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
		return [ 'tp-core' ];
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
		return [ 'tp-core' ];
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
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core'),
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('about', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');


        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tp-core'),
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tp-core'),
                'title' => esc_html__('Enter button text', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'tp-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tp-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tp-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
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
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('about_subtitle', 'About - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('about_title', 'About - Title', '.tp-el-title');
        $this->tp_basic_style_controls('about_description', 'About - Description', '.tp-el-content');
        $this->tp_link_controls_style('about_btn', 'About - Button', '.tp-el-btn');
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
    $this->add_render_attribute('title_args', 'class', 'tpabout__inner-title mb-25 tp-el-title');
    $bloginfo = get_bloginfo( 'name' );

    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tpteam__btn tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tpteam__btn tp-el-btn');
        }
    }
?>

<div class="container tp-el-section">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
            <div class="tpabout__inner-title-area about-inner-content mr-100 mb-70">
                <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                <h4 class="tpabout__inner-sub-title mb-5 tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></h4>
                <?php endif; ?>
                <?php
                if ( !empty($settings['tp_about_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['tp_about_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    tp_kses( $settings['tp_about_title' ] )
                    );
                endif;
                ?>
                <?php if ( !empty($settings['tp_about_description']) ) : ?>
                <p class="tp-el-content"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                <?php endif; ?>
                <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> ><?php echo $settings['tp_btn_text']; ?></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <?php if(!empty($tp_image)) : ?>
            <div class="tpfeature__inner-thumb mb-70">
                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php else:

    $bloginfo = get_bloginfo( 'name' );
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'tpabout__inner-title mb-25 tp-el-title');

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tpteam__btn tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tpteam__btn tp-el-btn');
        }
    }
?>


<div class="container tp-el-section">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <?php if(!empty($tp_image)) : ?>
            <div class="tpfeature__inner-thumb mb-70">
                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
            </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
            <div class="tpabout__inner-title-area about-inner-content ml-50 mr-50 mb-70">
                <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                <h4 class="tpabout__inner-sub-title mb-5 tp-el-subtitle"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></h4>
                <?php endif; ?>
                <?php
                if ( !empty($settings['tp_about_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_about_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_about_title' ] )
                        );
                endif;
                ?>
                <?php if ( !empty($settings['tp_about_description']) ) : ?>
                <p class="tp-el-content"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                <?php endif; ?>
                <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?> ><?php echo $settings['tp_btn_text']; ?></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endif; 
	}
}

$widgets_manager->register( new TP_About() );