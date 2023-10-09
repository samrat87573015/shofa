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
class TP_Product_Tab extends Widget_Base {

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
		return 'tp-product-tab';
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
		return __( 'Product Tab', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
		 'tp_section_sec',
			 [
			   'label' => esc_html__( 'Title', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);
		
		$this->add_control(
		'tp_section_title',
		 [
			'label'       => esc_html__( 'Title', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( 'Your Title', 'tpcore' ),
			'placeholder' => esc_html__( 'Your Text', 'tpcore' ),
			'label_block' => true
		 ]
		);
		
		
		$this->end_controls_section();

        $this->tp_button_render('button', 'Button', 'layout-2');

        // Product Query
        $this->tp_query_controls('product', 'Product', '6', '10', 'product', 'product_cat');
 

        // column controls
        $this->tp_product_columns('col');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('product_tab_section', 'Section - Style', '.ele-section');
        $this->tp_basic_style_controls('product_tab_title', 'Product Tab Title - Style', '.ele-title');
        $this->tp_link_controls_style('product_tab_button', 'Product Tab Button - Style', '.ele-button');

        $this->tp_basic_style_controls('product_tab_box_title', 'Product Tab Box Title - Style', '.ele-box-title');
        $this->tp_basic_style_controls('product_tab_box_price', 'Product Tab Box Price - Style', '.ele-box-price');
        $this->tp_link_controls_style('product_tab_box_addcart', 'Product Tab Cart Button - Style', '.ele-box-button');
        $this->tp_link_controls_style('product_tab_buttons', 'Product Tab Buttons - Style', '.ele-tab-buttons');
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

        /**
         * Setup the post arguments.
        */
        $query_args = TP_Helper::get_query_args('product', 'product_cat', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);

        $filter_list = $settings['category'];

        ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
    $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
    // Link
    if ('2' == $settings['tp_button_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_button_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'more-button ele-button');
    } else {
        if ( ! empty( $settings['tp_button_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_button_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'more-button ele-button');
        }
    }
?>

<section class="product-area ele-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <?php if(!empty($settings['tp_section_title'])) : ?>
                <div class="tpsection mb-40">
                    <h4 class="tpsection__title ele-title"><?php echo tp_kses($settings['tp_section_title']); ?></h4>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 col-md-6">
                <?php if( !empty($filter_list) && count($filter_list) > 0 ) : ?>
                <div class="tpproductnav tpnavbar">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <?php 
                            $count = 0;
                            foreach ( $filter_list as $key => $list ): 
                                $active = ($count == 0) ? 'active' : '';
                            ?>
                            <button class="nav-link ele-tab-buttons <?php echo esc_attr($active); ?>"
                                id="nav-all-tab-<?php echo esc_attr( $key ); ?>" data-bs-toggle="tab"
                                data-bs-target="#nav-all-<?php echo esc_attr( $key ); ?>" type="button" role="tab"
                                aria-controls="nav-all-<?php echo esc_attr( $key ); ?>"
                                aria-selected="true"><?php echo esc_html( $list ); ?></button>
                            <?php $count++; endforeach; ?>
                        </div>
                    </nav>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 col-md-2">
                <?php if ( !empty($settings['tp_button_btn_text']) ) : ?>
                <div class="tpproductall">
                    <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_button_btn_text']); ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if( !empty($filter_list) && count($filter_list) > 0 ) : ?>
        <div class="tab-content" id="nav-tabContent">

            <?php
				$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
				foreach ($filter_list as $key => $list):
				$active_tab = ($key == 0) ? 'active show' : '';
			?>
            <div class="tab-pane product-style-2 fade <?php echo esc_attr($active_tab); ?>"
                id="nav-all-<?php echo esc_attr( $key ); ?>" role="tabpanel"
                aria-labelledby="nav-all-tab-<?php echo esc_attr( $key ); ?>">
                <div class="row row-cols-xxl-<?php echo esc_attr($settings['tp_col_for_wide']); ?> row-cols-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> row-cols-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> row-cols-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> row-cols-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">

                    <?php
						$post_args = [
							'post_status' => 'publish',
							'post_type' => 'product',
							'posts_per_page' => $posts_per_page,
							'tax_query' => array(
								array(
									'taxonomy' => 'product_cat',
									'field' => 'slug',
									'terms' => $list,
								),
							),
						];
						$pro_query = new \WP_Query($post_args);
						while ($pro_query->have_posts()) : 
						$pro_query->the_post();
						global $product;
						global $post;
						global $woocommerce;
						$rating = wc_get_rating_html($product->get_average_rating());
						$ratingcount = $product->get_review_count();
                        $attachment_ids = $product->get_gallery_image_ids();

                        foreach( $attachment_ids as $key => $attachment_id ) {
                            $image_link =  wp_get_attachment_url( $attachment_id );
                            $arr[] = $image_link;
                        }
					?>
                    <div class="col">
                        <div class="tpproduct tpproductitem mb-15 p-relative">
                            <div class="tpproduct__thumb">

                                <?php if( has_post_thumbnail() ) : ?>
                                <div class="tpproduct__thumbitem p-relative">
                                    <?php if( $product->is_on_sale()) : ?>
                                    <span
                                        class="tpproduct__thumb-topsall"><?php woocommerce_show_product_loop_sale_flash($post->ID); ?></span>
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                        <?php if(!empty($attachment_ids)) : ?>
                                        <img class="thumbitem-secondary" src="<?php echo esc_url($arr[0]); ?>"
                                            alt="product-thumb">
                                        <?php endif; ?>
                                    </a>

                                    <div class="tpproduct__thumb-bg">
                                        <div class="tpproductactionbg product__action">
                                            <?php woocommerce_template_loop_add_to_cart();?>
                                            <?php if( function_exists( 'woosc_init' )) : ?>
                                            <div class="product-action-btn ml-10 mr-10">
                                                <?php echo do_shortcode('[woosc]');?>
                                            </div>
                                            <?php endif; ?>
                                            <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                                            <?php echo do_shortcode('[woosq]'); ?>
                                            <?php endif; ?>
                                            <?php if( function_exists( 'woosw_init' )) : ?>
                                            <div class="product-action-btn product-add-wishlist-btn mr-10 ml-10">
                                                <?php echo do_shortcode('[woosw]'); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                            </div>
                            <div class="tpproduct__content-area">
                                <h3 class="tpproduct__title mb-5 ele-box-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="tpproduct__priceinfo p-relative">
                                    <div class="tpproduct__ammount ele-box-price">
                                        <?php echo woocommerce_template_loop_price();?>
                                    </div>
                                </div>
                            </div>
                            <div class="tpproduct__ratingarea">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="tpproduct__rating">
                                        <ul>
                                            <li>
                                                <?php if(!empty($rating)) : ?>
                                                <?php echo $rating; ?>
                                                <?php else : ?>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <span>(<?php echo $ratingcount; ?>)</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_query(); ?>

                </div>
            </div>
            <?php endforeach; ?>

        </div>
        <?php else : ?>
        <div
            class="row product-style-2 row-cols-xxl-<?php echo esc_attr($settings['tp_col_for_wide']); ?> row-cols-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> row-cols-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> row-cols-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> row-cols-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
            <?php
                    while ($query->have_posts()) : 
                    $query->the_post();
                    global $product;
                    global $post;
                    global $woocommerce;
                    $rating = wc_get_rating_html($product->get_average_rating());
                    $ratingcount = $product->get_review_count();
                    $attachment_ids = $product->get_gallery_image_ids();

                    foreach( $attachment_ids as $key => $attachment_id ) {
                        $image_link =  wp_get_attachment_url( $attachment_id );
                        $arr[] = $image_link;
                    }
                ?>
            <div class="col">
                <div class="tpproduct tpproductitem mb-15 p-relative">
                    <div class="tpproduct__thumb">

                        <?php if( has_post_thumbnail() ) : ?>
                        <div class="tpproduct__thumbitem p-relative">
                            <?php if( $product->is_on_sale()) : ?>
                            <span
                                class="tpproduct__thumb-topsall"><?php woocommerce_show_product_loop_sale_flash($post->ID); ?></span>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                                <?php if(!empty($attachment_ids)) : ?>
                                <img class="thumbitem-secondary" src="<?php echo esc_url($arr[0]); ?>"
                                    alt="product-thumb">
                                <?php endif; ?>
                            </a>

                            <div class="tpproduct__thumb-bg">
                                <div class="tpproductactionbg product__action">
                                    <?php woocommerce_template_loop_add_to_cart();?>
                                    <?php if( function_exists( 'woosc_init' )) : ?>
                                    <div class="product-action-btn ml-10 mr-10">
                                        <?php echo do_shortcode('[woosc]');?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                                    <?php echo do_shortcode('[woosq]'); ?>
                                    <?php endif; ?>
                                    <?php if( function_exists( 'woosw_init' )) : ?>
                                    <div class="product-action-btn product-add-wishlist-btn mr-10 ml-10">
                                        <?php echo do_shortcode('[woosw]'); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                    <div class="tpproduct__content-area">
                        <h3 class="tpproduct__title mb-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="tpproduct__priceinfo p-relative">
                            <div class="tpproduct__ammount">
                                <?php echo woocommerce_template_loop_price();?>
                            </div>
                        </div>
                    </div>
                    <div class="tpproduct__ratingarea">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="tpproductdot">
                                <a class="tpproductdot__variationitem" href="<?php the_permalink(); ?>">
                                    <div class="tpproductdot__termshape">
                                        <span class="tpproductdot__termshape-bg"></span>
                                        <span class="tpproductdot__termshape-border"></span>
                                    </div>
                                </a>
                                <a class="tpproductdot__variationitem" href="<?php the_permalink(); ?>">
                                    <div class="tpproductdot__termshape">
                                        <span class="tpproductdot__termshape-bg red-product-bg"></span>
                                        <span class="tpproductdot__termshape-border red-product-border"></span>
                                    </div>
                                </a>
                                <a class="tpproductdot__variationitem" href="<?php the_permalink(); ?>">
                                    <div class="tpproductdot__termshape">
                                        <span class="tpproductdot__termshape-bg orange-product-bg"></span>
                                        <span class="tpproductdot__termshape-border orange-product-border"></span>
                                    </div>
                                </a>
                                <a class="tpproductdot__variationitem" href="<?php the_permalink(); ?>">
                                    <div class="tpproductdot__termshape">
                                        <span class="tpproductdot__termshape-bg purple-product-bg"></span>
                                        <span class="tpproductdot__termshape-border purple-product-border"></span>
                                    </div>
                                </a>
                            </div>
                            <div class="tpproduct__rating">
                                <ul>
                                    <li>
                                        <?php if(!empty($rating)) : ?>
                                        <?php echo $rating; ?>
                                        <?php else : ?>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <span>(<?php echo $ratingcount; ?>)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_query(); ?>

        </div>
        <?php endif; ?>
    </div>
</section>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
    $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
    // Link
    if ('2' == $settings['tp_button_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_button_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'more-button');
    } else {
        if ( ! empty( $settings['tp_button_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_button_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'more-button');
        }
    }
?>

<section class="white-product-area fix p-relative ele-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-12">
                <?php if(!empty($settings['tp_section_title'])) : ?>
                <div class="tpsection mb-40">
                    <h4 class="tpsection__title ele-title"><?php echo tp_kses($settings['tp_section_title']); ?></h4>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="tpproductarrow d-flex align-items-center">
                    <div class="tpproductarrow__prv ele-button"><i class="far fa-long-arrow-left"></i><?php echo esc_html__('Prev', 'tpcore'); ?></div>
                    <div class="tpproductarrow__nxt ele-button"><?php echo esc_html__('Next', 'tpcore'); ?><i class="far fa-long-arrow-right"></i></div>
                </div>
            </div>
        </div>
        <div class="swiper-container product-active">
            <div class="swiper-wrapper">
                <?php
                    $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
                    foreach ($filter_list as $key => $list):
                        
                    $post_args = [
                        'post_status' => 'publish',
                        'post_type' => 'product',
                        'posts_per_page' => $posts_per_page,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => $list,
                            ),
                        ),
                    ];
                    $pro_query = new \WP_Query($post_args);
                    while ($pro_query->have_posts()) : 
                    $pro_query->the_post();
                    global $product;
                    global $post;
                    global $woocommerce;
                    $rating = wc_get_rating_html($product->get_average_rating());
                    $ratingcount = $product->get_review_count();
                    $attachment_ids = $product->get_gallery_image_ids();

                    foreach( $attachment_ids as $key => $attachment_id ) {
                    $image_link =  wp_get_attachment_url( $attachment_id );
                    $arr[] = $image_link;
                    }
                ?>
                <div class="swiper-slide">

                    <div class="col">
                        <div class="tpproduct tpproductitem mb-15 p-relative">
                            <div class="tpproduct__thumb">

                                <?php if( has_post_thumbnail() ) : ?>
                                <div class="tpproduct__thumbitem p-relative">
                                    <?php if( $product->is_on_sale()) : ?>
                                    <span class="tpproduct__thumb-topsall"><?php woocommerce_show_product_loop_sale_flash($post->ID); ?></span>
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                        <?php if(!empty($attachment_ids)) :
                                        $image_url = wp_get_attachment_url($attachment_ids[0]);
                                        ?>
                                        <img class="thumbitem-secondary" src="<?php echo esc_url($image_url); ?>" alt="product-thumb">
                                        <?php endif; ?>
                                    </a>

                                    <div class="tpproduct__thumb-bg">
                                        <div class="tpproductactionbg product__action">
                                            <div class="product-action-btn ml-10 mr-10">

                                                <?php if( function_exists( 'woosc_init' )) : ?>
                                                <div class="tpproduct_grid_icon_item compare_icon">
                                                    <span class="icon_base">compare</span>
                                                    <?php echo do_shortcode('[woosc]');?>
                                                </div>
                                                <?php endif; ?>

                                                <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                                                <div class="tpproduct_grid_icon_item compare_icon">
                                                    <span class="icon_base"> Quick View</span>
                                                    <?php echo do_shortcode('[woosq]'); ?>
                                                </div>
                                                <?php endif; ?>

                                                <?php if( function_exists( 'woosw_init' )) : ?>
                                                <div class="tpproduct_grid_icon_item compare_icon">
                                                    <span class="icon_base"> Add To Wishlist</span>
                                                    <div class="product-action-btn product-add-wishlist-btn mr-10 ml-10">
                                                        <?php echo do_shortcode('[woosw]'); ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tpproduct_add_to_cart_btn">
                                        <?php woocommerce_template_loop_add_to_cart();?>
                                    </div>
                                </div>
                                <?php endif; ?>

                            </div>
                            <div class="tpproduct__content-area">
                                <h3 class="tpproduct__title mb-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="tpproduct__priceinfo p-relative">
                                    <div class="tpproduct__ammount">
                                        <?php echo woocommerce_template_loop_price();?>
                                    </div>
                                </div>
                            </div>
                            <div class="tpproduct__ratingarea">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="tpproduct__rating">
                                        <ul>
                                            <li>
                                                <?php if(!empty($rating)) : ?>
                                                <?php echo wp_kses_post($rating); ?>
                                                <?php else : ?>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <span>(<?php echo esc_html($ratingcount); ?>)</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php endwhile; wp_reset_query(); endforeach; ?>
            </div>
        </div>
    </div>
</section>


<?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
    $this->add_render_attribute('title_args', 'class', 'section__title-4 tp-el-title');
    // Link
    if ('2' == $settings['tp_button_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_button_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'more-button');
    } else {
        if ( ! empty( $settings['tp_button_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_button_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'more-button');
        }
    }
?>


                <div class="tp_product_list_style">
                    <?php if(!empty($settings['tp_section_title'])) : ?>
                    <div class="tpsection mb-40">
                        <h4 class="tpsection__title ele-title"><?php echo tp_kses($settings['tp_section_title']); ?></h4>
                    </div>
                    <?php endif; ?>

                    <?php
                        while ($query->have_posts()) : 
                        $query->the_post();
                        global $product;
                        global $post;
                        global $woocommerce;
                        $rating = wc_get_rating_html($product->get_average_rating());
                        $ratingcount = $product->get_review_count();

                        $attachment_ids = $product->get_gallery_image_ids();

                        $product_cats = get_the_terms( $post->ID, 'product_cat' );
                    ?>

                    <div class="tp_product_list_item mr-20">
                        <?php if( has_post_thumbnail() ) : ?>
                        <div class="product_thub_area">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="product_list_content">
                            <?php if(!empty($product_cats)) : ?>
                            <div class="product_cat">
                                <a href="<?php echo esc_url(get_term_link($product_cats[0], 'product_cat')); ?>"><?php echo esc_html($product_cats[0]->name) ?></a>
                                
                            </div>
                            <?php endif; ?>
                            <h3 class="tpproduct__title mb-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="product_reating_area">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="tpproduct__rating">
                                        <ul>
                                            <li>
                                                <?php if(!empty($rating)) : ?>
                                                <?php echo wp_kses_post($rating); ?>
                                                <?php else : ?>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <span>(<?php echo esc_html($ratingcount); ?>)</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tpproduct__priceinfo p-relative">
                                <div class="tpproduct__ammount">
                                    <?php echo woocommerce_template_loop_price();?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endwhile; wp_reset_query(); ?>



                </div>




<?php else: ?>

<section class="product-area ele-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">
                <?php if(!empty($settings['tp_section_title'])) : ?>
                <div class="tpsection mb-40">
                    <h4 class="tpsection__title ele-title"><?php echo tp_kses($settings['tp_section_title']); ?></h4>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-12">
                <?php if( !empty($filter_list) && count($filter_list) > 0 ) : ?>
                <div class="tpnavbar">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <?php 
                                $count = 0;
                                foreach ( $filter_list as $key => $list ): 
                                $active = ($count == 0) ? 'active' : '';
                            ?>
                            <button class="nav-link ele-tab-buttons <?php echo esc_attr($active); ?>"
                                id="nav-all-tab-<?php echo esc_attr( $key ); ?>" data-bs-toggle="tab"
                                data-bs-target="#nav-all-<?php echo esc_attr( $key ); ?>" type="button" role="tab"
                                aria-controls="nav-all-<?php echo esc_attr( $key ); ?>"
                                aria-selected="true"><?php echo esc_html( $list ); ?></button>
                            <?php $count++; endforeach; ?>
                        </div>
                    </nav>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if( !empty($filter_list) && count($filter_list) > 0 ) : ?>
        <div class="tab-content" id="nav-tabContent">
            <?php
				$posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
				foreach ($filter_list as $key => $list):
				$active_tab = ($key == 0) ? 'active show' : '';
			?>
            <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="nav-all-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="nav-all-tab-<?php echo esc_attr( $key ); ?>">
                <div class="row row-cols-xxl-<?php echo esc_attr($settings['tp_col_for_wide']); ?> row-cols-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> row-cols-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> row-cols-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> row-cols-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                    <?php
						$post_args = [
							'post_status' => 'publish',
							'post_type' => 'product',
							'posts_per_page' => $posts_per_page,
							'tax_query' => array(
								array(
									'taxonomy' => 'product_cat',
									'field' => 'slug',
									'terms' => $list,
								),
							),
						];
						$pro_query = new \WP_Query($post_args);
						while ($pro_query->have_posts()) : 
						$pro_query->the_post();
						global $product;
						global $post;
						global $woocommerce;
						$rating = wc_get_rating_html($product->get_average_rating());
						$ratingcount = $product->get_review_count();
                        $attachment_ids = $product->get_gallery_image_ids();

					?>


                    <div class="col">
                        <div class="tpproduct tpproductitem mb-15 p-relative">
                            <div class="tpproduct__thumb">

                                <?php if( has_post_thumbnail() ) : ?>
                                <div class="tpproduct__thumbitem p-relative">
                                    <?php if( $product->is_on_sale()) : ?>
                                    <span class="tpproduct__thumb-topsall"><?php woocommerce_show_product_loop_sale_flash($post->ID); ?></span>
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                        <?php if(!empty($attachment_ids)) :
                                        $image_url = wp_get_attachment_url($attachment_ids[0]);
                                        ?>
                                        <img class="thumbitem-secondary" src="<?php echo esc_url($image_url); ?>" alt="product-thumb">
                                        <?php endif; ?>
                                    </a>

                                    <div class="tpproduct__thumb-bg">
                                        <div class="tpproductactionbg product__action">
                                            <div class="product-action-btn ml-10 mr-10">

                                                <?php if( function_exists( 'woosc_init' )) : ?>
                                                <div class="tpproduct_grid_icon_item compare_icon">
                                                    <span class="icon_base">compare</span>
                                                    <?php echo do_shortcode('[woosc]');?>
                                                </div>
                                                <?php endif; ?>

                                                <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                                                <div class="tpproduct_grid_icon_item compare_icon">
                                                    <span class="icon_base"> Quick View</span>
                                                    <?php echo do_shortcode('[woosq]'); ?>
                                                </div>
                                                <?php endif; ?>

                                                <?php if( function_exists( 'woosw_init' )) : ?>
                                                <div class="tpproduct_grid_icon_item compare_icon">
                                                    <span class="icon_base"> Add To Wishlist</span>
                                                    <div class="product-action-btn product-add-wishlist-btn mr-10 ml-10">
                                                        <?php echo do_shortcode('[woosw]'); ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tpproduct_add_to_cart_btn">
                                        <?php woocommerce_template_loop_add_to_cart();?>
                                    </div>
                                </div>
                                <?php endif; ?>

                            </div>
                            <div class="tpproduct__content-area">
                                <h3 class="tpproduct__title mb-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="tpproduct__priceinfo p-relative">
                                    <div class="tpproduct__ammount">
                                        <?php echo woocommerce_template_loop_price();?>
                                    </div>
                                </div>
                            </div>
                            <div class="tpproduct__ratingarea">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="tpproduct__rating">
                                        <ul>
                                            <li>
                                                <?php if(!empty($rating)) : ?>
                                                <?php echo wp_kses_post($rating); ?>
                                                <?php else : ?>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <a href="#"><i class="far fa-star"></i></a>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <span>(<?php echo esc_html($ratingcount); ?>)</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endwhile; wp_reset_query(); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <div class="row row-cols-xxl-<?php echo esc_attr($settings['tp_col_for_wide']); ?> row-cols-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> row-cols-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> row-cols-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> row-cols-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
            <?php
                while ($query->have_posts()) : 
                $query->the_post();
                global $product;
                global $post;
                global $woocommerce;
                $rating = wc_get_rating_html($product->get_average_rating());
                $ratingcount = $product->get_review_count();

                $attachment_ids = $product->get_gallery_image_ids();
            ?>

            <div class="col">
                <div class="tpproduct tpproductitem mb-15 p-relative">
                    <div class="tpproduct__thumb">

                        <?php if( has_post_thumbnail() ) : ?>
                        <div class="tpproduct__thumbitem p-relative">
                            <?php if( $product->is_on_sale()) : ?>
                            <span class="tpproduct__thumb-topsall"><?php woocommerce_show_product_loop_sale_flash($post->ID); ?></span>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                                <?php if(!empty($attachment_ids)) : 
                                $image_url = wp_get_attachment_url($attachment_ids[0]);
                                ?>
                                <img class="thumbitem-secondary" src="<?php echo esc_url($image_url); ?>" alt="product-thumb">
                                <?php endif; ?>
                            </a>

                            <div class="tpproduct__thumb-bg">
                                <div class="tpproductactionbg product__action">
                                    <div class="product-action-btn ml-10 mr-10">

                                        <?php if( function_exists( 'woosc_init' )) : ?>
                                        <div class="tpproduct_grid_icon_item compare_icon">
                                            <span class="icon_base">compare</span>
                                            <?php echo do_shortcode('[woosc]');?>
                                        </div>
                                        <?php endif; ?>

                                        <?php if( class_exists( 'WPCleverWoosq' )) : ?>
                                        <div class="tpproduct_grid_icon_item compare_icon">
                                            <span class="icon_base"> Quick View</span>
                                            <?php echo do_shortcode('[woosq]'); ?>
                                        </div>
                                        <?php endif; ?>

                                        <?php if( function_exists( 'woosw_init' )) : ?>
                                        <div class="tpproduct_grid_icon_item compare_icon">
                                            <span class="icon_base"> Add To Wishlist</span>
                                            <div class="product-action-btn product-add-wishlist-btn mr-10 ml-10">
                                                <?php echo do_shortcode('[woosw]'); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <div class="tpproduct_add_to_cart_btn">
                                <?php woocommerce_template_loop_add_to_cart();?>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                    <div class="tpproduct__content-area">
                        <h3 class="tpproduct__title mb-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="tpproduct__priceinfo p-relative">
                            <div class="tpproduct__ammount">
                                <?php echo woocommerce_template_loop_price();?>
                            </div>
                        </div>
                    </div>
                    <div class="tpproduct__ratingarea">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="tpproduct__rating">
                                <ul>
                                    <li>
                                        <?php if(!empty($rating)) : ?>
                                        <?php echo wp_kses_post($rating); ?>
                                        <?php else : ?>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <a href="#"><i class="far fa-star"></i></a>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <span>(<?php echo esc_html($ratingcount); ?>)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php endwhile; wp_reset_query(); ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php endif;
	}

}

$widgets_manager->register( new TP_Product_Tab() );