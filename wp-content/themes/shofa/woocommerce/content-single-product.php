<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attachment_ids = $product->get_gallery_image_ids();

$gallery_class = $attachment_ids ? 'has_gallery_thumb' : NULL; 

$shofa_side_gallery_items = get_theme_mod('shofa_side_gallery_items');
$shofa_g_image = get_theme_mod('shofa_g_image');
$shofa_g_txt = get_theme_mod('shofa_g_txt');


/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}


?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'row pb-50', $product ); ?>>
    <div class="col-lg-6 col-md-12">
        <div class="tpproduct-details__list-img <?php echo esc_attr($gallery_class); ?> mb-20">
            <?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="tpproduct-details__content tpproduct-details__sticky">
            <?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action( 'woocommerce_single_product_summary' );
			?>
        </div>
    </div>
    <?php 
	$shofa_g_switch = get_theme_mod('shofa_g_switch', false); 
	if(!empty($shofa_side_gallery_items) && !empty($shofa_g_switch)) : ?>
    <div class="col-lg-6 col-md-12">
        <div class="tpproduct-details__condation ">
            <ul>

                <?php 
				foreach( $shofa_side_gallery_items as $image ) : ?>
                <li>
                    <div class="tpproduct-details__condation-item d-flex align-items-center">
                        <div class="tpproduct-details__condation-thumb">
							<?php if(!empty($image['shofa_g_image'])) : ?>
                            <img src="<?php echo esc_url($image['shofa_g_image']); ?>" alt="features-icon" class="tpproduct-details__img-hover">
							<?php else : ?>
							<i class="<?php echo esc_attr($image['shofa_g_icon']); ?> tpproduct-details__img-hover icon"></i>
							<?php endif; ?>
                        </div>
                        <div class="tpproduct-details__condation-text">
                            <p><?php echo shofa_kses($image['shofa_g_txt']); ?></p>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
    <?php endif; ?>
    
</div>

<div class="row"></div>
    <?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>