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
class Info_Banner extends Widget_Base {

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
		return 'tp-info-banner';
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
		return __( 'Info Banner', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                    'layout-5' => esc_html__('Layout 5', 'tp-core'),
                    'layout-6' => esc_html__('Layout 6', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'tp_info_sec',
             [
               'label' => esc_html__( 'Title & Description', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-4']
                ]
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
                    'tp_btn_button_show' => 'yes',
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-4']
                ],
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
                    'tp_btn_button_show' => 'yes',
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-4']
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
                    'tp_btn_button_show' => 'yes',
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-4']
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
                    'tp_btn_button_show' => 'yes',
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-4']
                ]
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
        $this->tp_section_style_controls('info_banner_section', 'Section - Style', '.ele-section');
        $this->tp_basic_style_controls('info_banner_sub_title', 'Info Banner Sub Title - Style', '.ele-sub-title');
        $this->tp_basic_style_controls('info_banner_title', 'Info Banner Title - Style', '.ele-title');
        $this->tp_basic_style_controls('info_banner_content', 'Info Banner Content - Style', '.ele-content');
        $this->tp_link_controls_style('info_banner_button', 'Info Banner Button - Style', '.ele-banner-button');

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
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn banner-animation ele-banner-button');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn banner-animation ele-banner-button');
        }
    }
?>

<div class="exclusiveitem banner-animation p-relative mb-30 ele-section">
    <?php if(!empty($tp_image)) : ?>
    <div class="exclusiveitem__thumb">
        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="tpexclusive__content">
        <?php if(!empty($settings['tp_info_subtitle'])) : ?>
        <h4 class="tpexclusive__subtitle ele-sub-title"><?php echo tp_kses($settings['tp_info_subtitle']) ?></h4>
        <?php endif; ?>
        <?php if(!empty($settings['tp_info_title'])) : ?>
        <h3 class="tpexclusive__title mb-30 ele-title"><?php echo tp_kses($settings['tp_info_title']) ?></h3>
        <?php endif; ?>
        <?php if(!empty($settings['tp_info_desc'])) : ?>
        <p class="ele-content"><?php echo tp_kses($settings['tp_info_desc'])?></p>
        <?php endif; ?>
        <?php if(!empty($settings['tp_btn_text'])) : ?>
        <div class="tpexclusive__btn">
            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_btn_text']); ?></a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn banner-animation');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn banner-animation');
        }
    }
?>

<div class="exclusivearea banner-animation p-relative mb-30 ele-section">
    <?php if(!empty($tp_image)) : ?>
    <div class="exclusivearea__thumb">
        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="tpexclusive__contentarea text-center">
        <?php if(!empty($settings['tp_info_subtitle'])) : ?>
        <h4 class="tpexclusive__subtitle subcolor ele-sub-title"><?php echo tp_kses($settings['tp_info_subtitle']); ?></h4>
        <?php endif; ?>
        <?php if(!empty($settings['tp_info_title'])) : ?>
        <h3 class="tpexclusive__title mb-10 ele-title"><?php echo tp_kses($settings['tp_info_title']); ?></h3>
        <?php endif; ?>
        <?php if(!empty($settings['tp_info_desc'])) : ?>
        <p class="ele-content"><?php echo tp_kses($settings['tp_info_desc'])?></p>
        <?php endif; ?>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn green-btn banner-animation ele-banner-button');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn green-btn banner-animation ele-banner-button');
        }
    }
?>

<div class="tpbanneritems p-relative ele-section">
    <div class="tpbanneritem__thumb mb-20">
        <?php if(!empty($tp_image)) : ?>
        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
        <?php endif; ?>
        <div class="tpbanneritem__content">
            <?php if(!empty($settings['tp_info_subtitle'])) : ?>
            <p class="ele-sub-title"><?php echo tp_kses($settings['tp_info_subtitle']) ?></p>
            <?php endif; ?>
            <?php if(!empty($settings['tp_info_title'])) : ?>
            <h5 class="tpbanneritem__title mb-60 ele-title"><?php echo tp_kses($settings['tp_info_title']) ?></h5>
            <?php endif; ?>
            <?php if(!empty($settings['tp_info_desc'])) : ?>
            <p class="ele-content"><?php echo tp_kses($settings['tp_info_desc'])?></p>
            <?php endif; ?>
            <?php if(!empty($settings['tp_btn_text'])) : ?>
            <div class="tpbanneritem__btn">
                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text'];?></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn green-btn banner-animation');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn green-btn banner-animation');
        }
    }
?>

<div class="tpbanneritem__thumb banner-animation p-relative ele-section">
    <?php if(!empty($tp_image)) : ?>
    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
    <?php endif; ?>
    <div class="tpbanneritem__text">
        <?php if(!empty($settings['tp_info_title'])) : ?>
        <h5 class="tpbanneritem__text-title ele-title"><?php echo tp_kses($settings['tp_info_title']) ?></h5>
        <?php endif; ?>
        <?php if(!empty($settings['tp_info_desc'])) : ?>
        <p class="ele-content"><?php echo tp_kses($settings['tp_info_desc'])?></p>
        <?php endif; ?>
    </div>
    <?php if(!empty($settings['tp_info_subtitle'])) : ?>
    <span class="tp-banner-item-small ele-sub-title"><?php echo tp_kses($settings['tp_info_subtitle']) ?></span>
    <?php endif; ?>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-6' ):
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn green-btn banner-animation');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn green-btn banner-animation');
        }
    }
?>

<div class="tpbanneritem__thumb banner-animation p-relative ele-section">
    <?php if(!empty($tp_image)) : ?>
    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
    <?php endif; ?>
    <div class="tpbanneritem__text">
        <?php if(!empty($settings['tp_info_title'])) : ?>
        <h5 class="tpbanneritem__text-title ele-title"><?php echo tp_kses($settings['tp_info_title']) ?></h5>
        <?php endif; ?>
        <?php if(!empty($settings['tp_info_subtitle'])) : ?>
        <h3 class="tpbanneritem__text-price ele-sub-title"><?php echo tp_kses($settings['tp_info_subtitle']) ?></h3>
        <?php endif; ?>
        <?php if(!empty($settings['tp_info_desc'])) : ?>
        <p class="ele-content"><?php echo tp_kses($settings['tp_info_desc'])?></p>
        <?php endif; ?>
    </div>
</div>

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
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
        }
    }
?>	

<div class="tpslider-banner ele-section">
    <?php if(!empty($settings['tp_btn_button_show'])) : ?>
    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
    <?php endif; ?>
        <div class="tpslider-banner__img">
            <?php if(!empty($tp_image)) : ?>
            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
            <?php endif; ?>
            <div class="tpslider-banner__content">
                <?php if(!empty($settings['tp_info_subtitle'])) : ?>
                <span class="tpslider-banner__sub-title ele-sub-title"><?php echo tp_kses($settings['tp_info_subtitle']) ?></span>
                <?php endif; ?>
                <?php if(!empty($settings['tp_info_title'])) : ?>
                <h4 class="tpslider-banner__title ele-title"><?php echo tp_kses($settings['tp_info_title']) ?></h4>
                <?php endif; ?>
                <?php if(!empty($settings['tp_info_desc'])) : ?>
                <p class="ele-content"><?php echo tp_kses($settings['tp_info_desc'])?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php if(!empty($settings['tp_btn_button_show'])) : ?>
    </a>
    <?php endif; ?>
</div>

<?php endif; 
	}
}

$widgets_manager->register( new Info_Banner() );