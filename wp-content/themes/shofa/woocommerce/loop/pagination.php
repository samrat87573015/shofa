<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>
<div class="row">
   <div class="col-xxl-12">
		<div class="basic-pagination text-center mt-50">
			<nav>
				<?php
				echo paginate_links(
					apply_filters(
						'woocommerce_pagination_args',
						array( // WPCS: XSS ok.
							'base'      => $base,
							'format'    => $format,
							'add_args'  => false,
							'current'   => max( 1, $current ),
							'total'     => $total,
							'prev_text' => is_rtl() ? '&rarr;' : '<i class="fal fa-long-arrow-left"></i>',
							'next_text' => is_rtl() ? '&larr;' : '<i class="fal fa-long-arrow-right"></i>',
							'type'      => 'list',
							'end_size'  => 3,
							'mid_size'  => 3,
						)
					)
				);
				?>
			</nav>
		</div>
	</div>
</div>

<!-- 
<div class="row">
   <div class="col-xxl-12">
      <div class="basic-pagination text-center">
			<nav>
				<ul>
				<li>
					<a href="shop.html">
						<i class="fal fa-long-arrow-left"></i>
					</a>
				</li>
				<li>
					<a href="shop.html">01</a>
				</li>
				<li>
					<span class="current">02</span>
				</li>
				<li>
					<a href="shop.html">- - -</a>
				</li>
				<li>
					<a href="shop.html">07</a>
				</li>
				<li>
					<a href="shop.html">08</a>
				</li>
				<li>
					<a href="shop.html">
						<i class="fal fa-long-arrow-right"></i>
					</a>
				</li>
				</ul>
			</nav>
      </div>
   </div>
</div> -->