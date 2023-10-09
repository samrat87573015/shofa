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
class Feature_Product_Info extends Widget_Base {

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
		return 'feature-product-info';
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
		return __( 'Feature Product Info', 'tpcore' );
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

    protected function register_controls_section(){
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

        $this->start_controls_section(
         'tp_info_sec',
             [
               'label' => esc_html__( 'Title & Content', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
        
        $this->add_control(
        'tp_info_subtitle',
         [
            'label'       => esc_html__( 'Sub Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'About Me', 'tpcore' ),
            'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
        'tp_info_title',
         [
            'label'       => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Hi, I amm brian wilson! ', 'tpcore' ),
            'placeholder' => esc_html__( 'Placeholder Text', 'tpcore' ),
            'label_block' => true
         ]
        );
        
        $this->add_control(
         'tp_info_desc',
         [
           'label'       => esc_html__( 'Description', 'tpcore' ),
           'type'        => \Elementor\Controls_Manager::TEXTAREA,
           'rows'        => 10,
           'default'     => esc_html__( 'Im a UX designer, prototyper, and a part-time 3D artist', 'tpcore' ),
           'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
         ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Add Link', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Select Link Type', 'tp-core'),
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
                'label' => esc_html__('Insert link', 'tp-core'),
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
                'label' => esc_html__('Select Link Page', 'tp-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'badge_title',
             [
                'label'       => esc_html__( 'Badget Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'From $49', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Badge Text', 'tpcore' ),
                'label_block' => true
             ]
            );

        $this->add_control(
			'tp_date',
			[
				'label' => esc_html__( 'Offer Closing Time', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
			]
		);

        $this->add_control(
            'tp_offer_note',
             [
                'label'       => esc_html__( 'Offer Note', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'About Me', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
                'label_block' => true
             ]
            );

        $this->end_controls_section();

        

    }

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('feature_product_section', 'Section - Style', '.ele-section');
        $this->tp_basic_style_controls('feature_product_sub_title', 'Feature Product Sub Title - Style', '.ele-sub-title');
        $this->tp_basic_style_controls('feature_product_title', 'Feature Product Title - Style', '.ele-title');
        $this->tp_basic_style_controls('feature_product_content', 'Feature Product Content - Style', '.ele-content');
        $this->tp_link_controls_style('feature_product_countDown', 'Feature Product Count-Down - Style', '.ele-count-down span.cdown');
        $this->tp_link_controls_style('feature_product_sale', 'Feature Product Sale - Style', '.ele-sale');
        $this->tp_basic_style_controls('feature_product_bottomText', 'Feature Product Bottom Text - Style', '.ele-bottom-text');
        
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

    

<?php else: 
            
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-brown tp-el-box-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-brown tp-el-box-btn');
        }
    }
    $date_time = $settings['tp_date'];
    $new_date = date("Y-m-d",strtotime($date_time));
?>	


<section class="dealproduct-area pb-95">
    <div class="container">
        <div class="theme-bg pt-40 pb-40 ele-content-bg ele-section">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                <div class="tpdealproduct">
                    <div class="tpdealproduct__thumb p-relative text-center">
                        <?php if(!empty($tp_image)) : ?>
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>
                        <?php if(!empty($settings['badge_title'])) : ?>
                        <div class="tpdealproductd__offer">
                            <h5 class="tpdealproduct__offer-price ele-sale"><?php echo tp_kses($settings['badge_title']); ?></h5>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                </div>
                <div class="col-lg-6 col-md-12">
                <div class="tpdealcontact pt-30">
                    <?php if(!empty($settings['tp_info_subtitle'])) : ?>
                    <div class="tpdealcontact__price mb-5">
                        <span class="ele-sub-title"><?php echo tp_kses($settings['tp_info_subtitle']) ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="tpdealcontact__text mb-30">
                        <?php if(!empty($settings['tp_info_title'])) : ?>   
                        <h4 class="tpdealcontact__title mb-10 ele-title">
                            <?php if(!empty($settings['tp_btn_button_show'])) : ?>
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_info_title']) ?></a>
                            <?php else : ?>
                            <?php echo tp_kses($settings['tp_info_title']) ?>
                            <?php endif; ?>
                        </h4>
                        <?php endif; ?>
                        <?php if(!empty($settings['tp_info_desc'])) : ?>
                        <p class="ele-content"><?php echo tp_kses($settings['tp_info_desc'])?></p>
                        <?php endif; ?>
                    </div>
                    <div class="tpdealcontact__progress mb-30">
                        <div class="progress">
                            <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="tpdealcontact__count">
                        <?php if(!empty($settings['tp_date'])) : ?>
                        <div class="tpdealcontact__countdown ele-count-down" data-countdown="<?php echo esc_attr($new_date); ?>"></div>
                        <?php endif; ?>
                        <?php if(!empty($settings['tp_offer_note'])) : ?>
                        <i class="ele-bottom-text"><?php echo tp_kses($settings['tp_offer_note']); ?></i>
                        <?php endif; ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; 
	}
}

$widgets_manager->register( new Feature_Product_Info() );