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
class TP_Product_Cat extends Widget_Base {
    
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
		return 'tp-product-cat';
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
		return __( 'Product Category', 'tpcore' );
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

        $this->tp_section_title_render_controls('product_cat', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

        // Features group
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
            'tp_category_icon_type',
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
            $repeater->add_control(
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
            $repeater->add_control(
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

        $repeater->add_control(
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

        $repeater->add_control(
            'tp_category_item', [
                'label' => esc_html__('Category Item', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('20', 'tpcore'),
                'label_block' => true,
            ]
        ); 

        $repeater->add_control(
            'tp_category_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );        

        $repeater->add_control(
            'tp_category_url', [
                'label' => esc_html__('URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );
     
        $this->add_control(
            'tp_category_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_category_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_category_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_category_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_category_title }}}',
            ]
        );
        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('product_cat_section', 'Section - Style', '.ele-section');
        $this->tp_basic_style_controls('product_cat_sub_title', 'Product Category Sub Title - Style', '.ele-sub-title');
        $this->tp_basic_style_controls('product_cat_title', 'Product Category Title - Style', '.ele-title');
        $this->tp_basic_style_controls('product_cat_content', 'Product Category Content - Style', '.ele-content');

        $this->tp_icon_style('product_cat_box_icon', 'Product Category - Icon/Image/SVG', '.ele-box-icon');
        $this->tp_basic_style_controls('product_cat_box_number', 'Product Category Box Number - Style', '.ele-box-number');
        $this->tp_basic_style_controls('product_cat_box_title', 'Product Category Box Title - Style', '.ele-box-title');
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

    <section class="category-area pt-70 ele-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tpsection text-center mb-40">
                        <?php if(!empty($settings['tp_product_cat_sub_title'])): ?>
                        <h5 class="tpsectionarea__subtitle ele-sub-title"><?php echo tp_kses($settings['tp_product_cat_sub_title']); ?></h5>
                        <?php endif; ?> 
                        <?php
                        if ( !empty($settings['tp_product_cat_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_product_cat_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $settings['tp_product_cat_title' ] )
                            );
                        endif;
                        ?>
                        <?php if(!empty($settings['tp_product_cat_description'])): ?>
                        <p class="ele-content"><?php echo tp_kses($settings['tp_product_cat_description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="custom-row category-border pb-45 justify-content-xl-between">

                <?php foreach ($settings['tp_category_list'] as $item) : ?>
                <div class="tpcategory tp-cat-style-2 mb-40">
                    <div class="tpcategory__icon p-relative ele-box-icon">
                        <?php if($item['tp_category_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_category_icon']) || !empty($item['tp_category_selected_icon']['value'])) : ?>
                        <?php tp_render_icon($item, 'tp_category_icon', 'tp_category_selected_icon'); ?>
                        <?php endif; ?>
                        <?php elseif( $item['tp_category_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['tp_category_image']['url'])): ?>
                            <img class="light" src="<?php echo $item['tp_category_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_category_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        <?php endif; ?>
                        <?php else : ?>
                            <?php if (!empty($item['tp_category_icon_svg'])): ?>
                                <?php echo $item['tp_category_icon_svg']; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if(!empty($item['tp_category_title'])) : ?>
                    <div class="tpcategory__content">
                        <h5 class="tpcategory__title ele-box-title">
                            <?php if(!empty($item['tp_category_url'])) : ?>
                            <a href="<?php echo esc_url($item['tp_category_url']); ?>"><?php echo tp_kses($item['tp_category_title']); ?></a>
                            <?php else : ?>
                                <?php echo tp_kses($item['tp_category_title']); ?>
                            <?php endif;  ?>
                        </h5>
                        <?php if(!empty($item['tp_category_item'])) : ?>
                        <span class="ele-box-number"><?php echo tp_kses($item['tp_category_item']); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


<?php else: 
    $this->add_render_attribute('title_args', 'class', 'tpsection__title ele-title');
?>



<section class="category-area pt-70 ele-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tpsection text-center mb-40">
                    <?php if(!empty($settings['tp_product_cat_sub_title'])): ?>
                    <h5 class="tpsectionarea__subtitle ele-sub-title"><?php echo tp_kses($settings['tp_product_cat_sub_title']); ?></h5>
                    <?php endif; ?> 
                    <?php
                    if ( !empty($settings['tp_product_cat_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_product_cat_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_product_cat_title' ] )
                        );
                    endif;
                    ?>
                    <?php if(!empty($settings['tp_product_cat_description'])): ?>
                    <p class="ele-content"><?php echo tp_kses($settings['tp_product_cat_description']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="custom-row category-border pb-45 justify-content-xl-between">

            <?php foreach ($settings['tp_category_list'] as $item) : ?>
            <div class="tpcategory mb-40">
                <div class="tpcategory__icon p-relative ele-box-icon">
                    <?php if($item['tp_category_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['tp_category_icon']) || !empty($item['tp_category_selected_icon']['value'])) : ?>
                    <?php tp_render_icon($item, 'tp_category_icon', 'tp_category_selected_icon'); ?>
                    <?php endif; ?>
                    <?php elseif( $item['tp_category_icon_type'] == 'image' ) : ?>
                    <?php if (!empty($item['tp_category_image']['url'])): ?>
                        <img class="light" src="<?php echo $item['tp_category_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_category_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    <?php endif; ?>
                    <?php else : ?>
                        <?php if (!empty($item['tp_category_icon_svg'])): ?>
                            <?php echo $item['tp_category_icon_svg']; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($item['tp_category_item'])) : ?>
                    <span class="ele-box-number"><?php echo tp_kses($item['tp_category_item']); ?></span>
                    <?php endif; ?>
                </div>
                <?php if(!empty($item['tp_category_title'])) : ?>
                <div class="tpcategory__content">
                    <h5 class="tpcategory__title ele-box-title">
                        <?php if(!empty($item['tp_category_url'])) : ?>
                        <a href="<?php echo esc_url($item['tp_category_url']); ?>"><?php echo tp_kses($item['tp_category_title']); ?></a>
                        <?php else : ?>
                            <?php echo tp_kses($item['tp_category_title']); ?>
                        <?php endif;  ?>
                    </h5>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php endif;
	}
}

$widgets_manager->register( new TP_Product_Cat() );