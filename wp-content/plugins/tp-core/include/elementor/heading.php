<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
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
class TP_Heading extends Widget_Base {

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
		return 'tp-heading';
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
		return __( 'Heading', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                    'layout-5' => esc_html__('Layout 5', 'tpcore'),
                    'layout-6' => esc_html__('Layout 6', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');

		$this->tp_button_render('testimonial', 'Testimonial Button', ['layout-4'] );

	}

    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('portfolio_subtitle', 'Section - Subtitle', '.tp-el-subtitle');
        $this->tp_basic_style_controls('portfolio_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('portfolio_desc', 'Section - Description', '.tp-el-content');
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
	$this->add_render_attribute('title_args', 'class', 'section__title-2 tp-el-title');
?>


<?php else:
	$this->add_render_attribute('title_args', 'class', 'tpabout__inner-title tp-el-title');
?>

<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
	<div class="tpabout__inner-title-area tp-el-section <?php echo esc_attr( $settings['tp_section_align'] ); ?>">
		<?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
		<h4 class="tpabout__inner-sub-title tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h4>
		<?php endif; ?>
		<?php
			if ( !empty($settings['tp_section_title' ]) ) :
				printf( '<%1$s %2$s>%3$s</%1$s>',
					tag_escape( $settings['tp_section_title_tag'] ),
					$this->get_render_attribute_string( 'title_args' ),
					tp_kses( $settings['tp_section_title' ] )
					);
			endif;
		?>
		<?php if ( !empty($settings['tp_section_description']) ) : ?>
		<p class="tp-el-content"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
		<?php endif; ?>
	</div>
<?php endif; ?>



<?php endif;
	}
}

$widgets_manager->register( new TP_Heading() );