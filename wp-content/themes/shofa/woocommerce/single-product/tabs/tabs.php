<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>


<section class="tpproduct-details__navtab mb-60">
	<div class="tpproduct-details__nav mb-30">
		<nav class="nav nav-tabs pro-details-nav-btn">
			<?php foreach ( $product_tabs as $key => $product_tab ) : 

				$active = ($key == array_key_first($product_tabs)) ? 'active' : '';
			?>
			<button class="nav-link <?php echo esc_attr( $key ); ?>_tab <?php echo esc_attr($active); ?>" id="nav-desc-tab-<?php echo esc_attr( $key ); ?>" data-bs-toggle="tab" data-bs-target="#nav-desc-<?php echo esc_attr( $key ); ?>" type="button" role="tab" aria-controls="nav-desc-<?php echo esc_attr( $key ); ?>" aria-selected="true"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?></button>
			<?php endforeach; ?>
			<span id="marker" class="tp-tab-line d-none d-sm-inline-block"></span>
		</nav> 
	</div>
	<div class="product__details-tab-content">
		<div class="tab-content" id="nav-tabContent-info">
			<?php foreach ( $product_tabs as $key => $product_tab ) : 
				$active = ($key == array_key_first($product_tabs)) ? 'show active' : '';

			?>
			<div class="tab-pane fade  <?php echo esc_attr($active); ?>" id="nav-desc-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="nav-desc-tab-<?php echo esc_attr( $key ); ?>">
				<div class="product__details-description tp-content-tab" >
				<?php
					if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab );
					}
				?>
				</div>
			</div>
			<?php endforeach; ?>	
		</div>
	</div>
</section>



<?php endif; ?>
