<?php
/**
 * External product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/external.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" action="<?php echo esc_url( $product_url ); ?>" method="get">

	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
    <div class="tpproduct-details__cart mr-5 d-inline-block mt-10 mb-10">
        <button type="submit" class="single_add_to_cart_button product-add-cart-btn product-add-cart-btn-3 button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $button_text ); ?></button>
    </div>


    <div class="wishlist_and_compare_button_wrapper">
        <?php if( function_exists( 'woosw_init' )) : ?>
        <div class="product-action-btn product-add-wishlist-btn mt-10 mb-10">
            <?php echo do_shortcode('[woosw]'); ?>
        </div>
        <?php endif; ?>

        <?php if( function_exists( 'woosc_init' )) : ?>
        <div class="product-action-btn mt-10 mb-10">
            <?php echo do_shortcode('[woosc]');?>                                       
        </div>
        <?php endif; ?>
    </div>

	<?php wc_query_string_form_fields( $product_url ); ?>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

