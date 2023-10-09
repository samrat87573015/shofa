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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Coming_Soon extends Widget_Base {

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
		return 'tp-coming-soon';
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
		return __( 'Coming Soon', 'tpcore' );
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
	// controls file 
	protected function register_controls_section(){
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
            'tp_image',
            [
                'label' => esc_html__( 'Choose Logo Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_image_link',
            [
                'label' => esc_html__('Logo Redirect Link', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'placeholder' => esc_html__('Type Logo Link', 'tpcore'),
                'label_block' => true,
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

        $this->add_control(
            'tp_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Sub Title', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
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
			'tp_date',
			[
				'label' => esc_html__( 'Countdown Time', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
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

        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ]
        );

        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->end_controls_section();

        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Background Image   ', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Background Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size_2',
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
        $this->tp_section_style_controls('comming_soon_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('comming_soon_subtitle', 'Comming Soon - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('comming_soon_title', 'Comming Soon - Title', '.tp-el-title');
        $this->tp_link_controls_style('comming_soon_btn', 'Comming Soon - Button', '.tp-el-btn');
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
    $this->add_render_attribute('title_args', 'class', 'tpcta-title mb-40');
?>


<?php else:
	$this->add_render_attribute('title_args', 'class', 'tpcoming__title mb-50 tp-el-title');
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_2_size']) : $settings['tp_image']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $date_time = $settings['tp_date'];
    $new_date = date("Y-m-d",strtotime($date_time));
?>


<?php if(!empty($tp_image_2)) : ?>
<section class="coming-soon-area tpcoming__bg tp-el-section" data-background="<?php echo esc_url($tp_image_2); ?>">
<?php else : ?>
<section class="coming-soon-area tpcoming__bg tp-el-section" >
<?php endif; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="tpcoming__area text-center">
                    <?php if(!empty($tp_image)) : ?>
                    <div class="tpcoming__logo">
                        <?php if(!empty($settings['tp_image_link'])) : ?>
                        <a href="<?php echo esc_url($settings['tp_image_link']); ?>"><img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>"></a>
                        <?php else : ?>
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="tpcoming__content">
                        <?php if(!empty($settings['tp_sub_title'])) : ?>
                        <span class="tp-el-subtitle"><?php echo tp_kses($settings['tp_sub_title']); ?></span>
                        <?php endif; ?>
                        <?php
                        if ( !empty($settings['tp_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $settings['tp_title' ] )
                            );
                        endif;
                        ?>
                    </div>
                    <div class="tpcoming__count">
                        <div class="tpcoming__countdown" data-countdown="<?php echo esc_attr($new_date); ?>"></div>
                    </div>
                    <div class="tpcoming__submit">
                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                            <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                        <?php else : ?>
                            <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php
	}
}

$widgets_manager->register( new TP_Coming_Soon() );