<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Blog_Post extends Widget_Base {

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
		return 'blogpost';
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
		return __( 'Blog Post', 'tpcore' );
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

        $this->tp_section_title_render_controls('blog', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.');
 
        // tp_btn_button_group
        $this->tp_button_render('blog_view_all', 'Blog More Button');
        
        // Blog Query
		$this->tp_query_controls('blog', 'Blog');

        // tp_post__columns_section
        $this->tp_columns('blog', 'Blog Column');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('blog_post_section', 'Section - Style', '.ele-section');
        $this->tp_basic_style_controls('blog_post_sub_title', 'Blog Post Sub Title - Style', '.ele-sub-title');
        $this->tp_basic_style_controls('blog_post_title', 'Blog Post Title - Style', '.ele-title');
        $this->tp_basic_style_controls('blog_post_content', 'Blog Post Content - Style', '.ele-content');
        $this->tp_link_controls_style('blog_post_button', 'Blog Post Button - Style', '.ele-button');

        $this->tp_basic_style_controls('blog_post_box_meta', 'Blog Post Box Meta - Style', '.ele-box-meta');
        $this->tp_basic_style_controls('blog_post_box_cat', 'Blog Post Box Category - Style', '.ele-box-cat');
        $this->tp_basic_style_controls('blog_post_box_title', 'Blog Post Box Title - Style', '.ele-box-title');
        $this->tp_basic_style_controls('blog_post_box_des', 'Blog Post Box Description - Style', '.ele-box-des');
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

		if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if(!empty($settings['exclude_category'])){
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (! empty( $settings['ignore_sticky_posts'] ) && 'yes' == $settings['ignore_sticky_posts']) ? true : false ;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if ( !empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'	=> 'category',
                    'field'	 	=> 'slug',
                    'terms'		=> $exclude_category_list_value,
                    'operator'	=> 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'	=> 'category',
                    'field'		=> 'slug',
                    'terms'		=> $category_list_value,
                    'operator'	=> 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($args);


    ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
    $this->add_render_attribute('title_args', 'class', 'tpsection__title ele-title');
?>

<section class="blog-area pb-35 pt-65 fix ele-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="tpsection mb-40">
                    <?php if(!empty($settings['tp_blog_sub_title'])): ?>
                    <h5 class="tpsectionarea__subtitle ele-sub-title"><?php echo tp_kses($settings['tp_blog_sub_title']); ?></h5>
                    <?php endif; ?>
                    <?php
                    if ( !empty($settings['tp_blog_title' ]) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['tp_blog_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_blog_title' ] )
                        );
                    endif;
                    ?>
                    <?php if(!empty($settings['tp_blog_description'])): ?>
                    <p class="ele-content"><?php echo tp_kses($settings['tp_blog_description']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row gx-6 blog2-row">

            <?php if ($query->have_posts()) : 
            while ($query->have_posts()) : 
                $query->the_post();
                global $post;

                $categories = get_the_category($post->ID);
            ?>
            <div
                class="col-xl-<?php echo esc_attr($settings['tp_blog_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_blog_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_blog_for_tablet']); ?> col-sm-<?php echo esc_attr($settings['tp_blog_for_mobile']); ?> tpblogborder mb-30">
                <div class="blogitem">

                    <?php if ( has_post_thumbnail() ): ?>
                    <div class="blogitem__thumb fix mb-20">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail();?>
                        </a>
                    </div>
                    <?php endif; ?>

                    <div class="blogitem__content">
                        <div class="blogitem__contetn-date mb-10">
                            <ul>
                                <li>
                                    <a class="date-color ele-box-meta" href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time( 'M j, Y' ); ?></a>
                                </li>
                                <li>
                                    <a class="ele-box-cat" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                </li>
                            </ul>
                        </div>
                        <h4 class="blogitem__title mb-15 ele-box-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                        </h4>
                        <?php if (!empty($settings['tp_post_content'])):
                            $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                                ?>
                        <p class="content ele-repeater-des ele-box-des">
                            <?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?>
                        </p>
                        <?php endif; ?>
                        <div class="blogitem__btn">
                            <a class="ele-button" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More', 'tpcore'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_query(); endif; ?>

        </div>
    </div>
</section>

<?php else: 
    $this->add_render_attribute('title_args', 'class', 'tpsection__title ele-title');
    // btn Link
    if ('2' == $settings['tp_blog_view_all_btn_link_type']) {
        $link = get_permalink($settings['tp_blog_view_all_btn_page_link']);
        $target = '_self';
        $rel = 'nofollow';
    } else {
        $link = !empty($settings['tp_blog_view_all_btn_link']['url']) ? $settings['tp_blog_view_all_btn_link']['url'] : '';
        $target = !empty($settings['tp_blog_view_all_btn_link']['is_external']) ? '_blank' : '';
        $rel = !empty($settings['tp_blog_view_all_btn_link']['nofollow']) ? 'nofollow' : '';
    }
?>

<div class="row fix ele-section">
    <div class="col-md-12 col-12">
        <div class="blogheader mb-20 d-flex align-items-center justify-content-between">
            <div class="tpsection mb-20">
                <?php if(!empty($settings['tp_blog_sub_title'])): ?>
                <h5 class="tpsectionarea__subtitle ele-sub-title"><?php echo tp_kses($settings['tp_blog_sub_title']); ?></h5>
                <?php endif; ?>
                <?php
                if ( !empty($settings['tp_blog_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['tp_blog_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    tp_kses( $settings['tp_blog_title' ] )
                    );
                endif;
                ?>
                <?php if(!empty($settings['tp_blog_description'])): ?>
                <p class="ele-content"><?php echo tp_kses($settings['tp_blog_description']); ?></p>
                <?php endif; ?>
            </div>
            <div class="tpallblog mb-20">
                <?php if(!empty($settings['tp_blog_view_all_btn_text'])) : ?>
                <h4 class="blog-btn ele-button"><a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($settings['tp_blog_view_all_btn_text']); ?></a>
                </h4>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<div class="row">

    <?php if ($query->have_posts()) : 
        while ($query->have_posts()) : 
        $query->the_post();
        global $post;

        $categories = get_the_category($post->ID);
    ?>
    <div class="col-xl-<?php echo esc_attr($settings['tp_blog_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_blog_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_blog_for_tablet']); ?> col-sm-<?php echo esc_attr($settings['tp_blog_for_mobile']); ?>">
        <div class="blogitem_grid mb-40">
            <?php if ( has_post_thumbnail() ): ?>
            <div class="blogitem__thumb fix mb-20">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail();?>
                </a>
            </div>
            <?php endif; ?>
            <div class="blogitem__content">
                <div class="blogitem__contetn-date mb-10">
                    <ul>
                        <li>
                            <a class="date-color ele-box-meta" href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time( 'M j, Y' ); ?></a>
                        </li>
                        <li>
                            <a class="ele-box-cat" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                        </li>
                    </ul>
                </div>
                <h4 class="blogitem__title ele-box-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                </h4>
                <?php if (!empty($settings['tp_post_content'])):
                    $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                        ?>
                <p class="content ele-repeater-des ele-box-des">
                    <?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?>
                </p>
                <?php if (!empty($settings['tp_post_button'])): ?>
                <div class="blog_btn_area mt-20">
                    <a class="tp-btn tp-color-btn banner-animation sm_size" href="<?php the_permalink(); ?>"><?php echo tp_kses( $settings['tp_post_button'] ); ?> </a>
                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endwhile; wp_reset_query(); endif; ?>

</div>


<?php endif;
	}

}

$widgets_manager->register( new TP_Blog_Post() );