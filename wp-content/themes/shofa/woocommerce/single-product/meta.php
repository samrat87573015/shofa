<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
    <div class="tpproduct-details__information tpproduct-details__code">
        <p><?php esc_html_e( 'SKU:', 'shofa' ); ?></p>
        <span><?php echo esc_html(( $sku = $product->get_sku() ), 'shofa') ? $sku : esc_html__( 'N/A', 'shofa' ); ?></span>
    </div>    
	<?php endif; ?>

    <div class="tpproduct-details__information tpproduct-details__categories">
       <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<p>' . _n( 'Category: ', 'Categories: ', count( $product->get_category_ids() ), 'shofa' )  . '</p> '); ?> 
    </div>

    <div class="tpproduct-details__information tpproduct-details__tags">
	<?php echo wc_get_product_tag_list( $product->get_id(), ' ', '<p>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'shofa' ) . '</p> '); ?>
    </div>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
    <?php if(function_exists('shofa_product_social_share')) : ?>
    <?php echo shofa_product_social_share(); ?>
    <?php endif; ?>
