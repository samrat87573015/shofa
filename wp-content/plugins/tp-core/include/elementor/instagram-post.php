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
class TP_Instagram_Post extends Widget_Base {

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
		return 'instagrampost';
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
		return __( 'Instagram Post', 'tpcore' );
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

        $this->tp_section_title_render_controls('instagram', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

		$this->start_controls_section(
            'tp_instagram_section',
            [
                'label' => __( 'Instagram Item', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_repeater_style',
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

        $repeater->add_control(
            'tp_instagram_image',
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
            'tp_instagram_slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => esc_html__( 'Instagram Item', 'tpcore' ),
                'default' => [
                    [
                        'tp_instagram_image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'tp_instagram_image' => [
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
        $this->tp_section_style_controls('instagram_post_section', 'Section - Style', '.ele-section');
        $this->tp_basic_style_controls('instagram_post_sub_title', 'Instagram Post Sub Title - Style', '.ele-sub-title');
        $this->tp_basic_style_controls('instagram_post_title', 'Instagram Post Title - Style', '.ele-title');
        $this->tp_basic_style_controls('instagram_post_content', 'Instagram Post Content - Style', '.ele-content');
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
    $this->add_render_attribute('title_args', 'class', 'tpsectionarea__title');
?>

<?php else : 
    $this->add_render_attribute('title_args', 'class', 'tpsectionarea__title ele-title');
?>

<section class="shop-area pb-100 ele-section">
    <div class="container">
        <?php if ( !empty($settings['tp_instagram_section_title_show']) ) : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="tpsectionarea text-center mb-35">
                    <?php if(!empty($settings['tp_instagram_sub_title'])): ?>
                    <h5 class="tpsectionarea__subtitle ele-sub-title"><?php echo tp_kses($settings['tp_instagram_sub_title']); ?></h5>
                    <?php endif; ?>  
                    <?php
                    if ( !empty($settings['tp_instagram_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_instagram_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_instagram_title' ] )
                        );
                    endif;
                    ?>
                    <?php if(!empty($settings['tp_instagram_description'])): ?>
                    <p class="ele-content"><?php echo tp_kses($settings['tp_instagram_description']); ?></p>
                    <?php endif; ?>  
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="shopareaitem">
            <div class="shopslider-active swiper-container">
                <div class="swiper-wrapper">

                    <?php foreach ($settings['tp_instagram_slides'] as $item) :
                        if ( !empty($item['tp_instagram_image']['url']) ) {
                            $tp_instagram_image_url = !empty($item['tp_instagram_image']['id']) ? wp_get_attachment_image_url( $item['tp_instagram_image']['id'], $settings['thumbnail_size']) : $item['tp_instagram_image']['url'];
                            $tp_instagram_image_alt = get_post_meta($item["tp_instagram_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                    <?php if(!empty($tp_instagram_image_url)) : ?>
                    <div class="tpshopitem swiper-slide">
                        <a class="popup-image" href="<?php echo esc_url($tp_instagram_image_url); ?>">
                            <img src="<?php echo esc_url($tp_instagram_image_url); ?>" alt="<?php echo esc_attr?>">
                        </a>
                    </div>
                    <?php endif; endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php
	}


}

$widgets_manager->register( new TP_Instagram_Post() );