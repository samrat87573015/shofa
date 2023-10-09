<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Search_Box extends Widget_Base {

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
		return 'search-box';
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
		return __( 'Search Box', 'tpcore' );
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
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Search Content', 'tpcore' ),
			]
		);
		
		$this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Search Button', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		$this->add_control(
			'btn_title',
			[
				'label' => __( 'Search Button Title', 'tpcore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Search Here', 'tpcore'),
			]
		);

		$this->end_controls_section();
	}

	// style_tab_content
    protected function style_tab_content(){
        $this->tp_link_controls_style('section_btn', 'Section - Button', '.tp-el-btn');
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
	<div class="tpshop__search text-center ">
		<form method="get" action="<?php print esc_url( home_url( '/' ) );?>" >
			<input type="search" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Search here', 'tpcore' );?>" >
			<?php if(!empty($settings['btn_title'])) : ?>
			<button class="tp-el-btn" type="submit"><?php echo tp_kses($settings['btn_title']); ?></button>
			<?php endif; ?>
		</form>
	</div>

    <?php
    }
}


$widgets_manager->register( new TP_Search_Box() );