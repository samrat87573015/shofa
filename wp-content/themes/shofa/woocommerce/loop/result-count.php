<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="product-item-count">
	<span>
		<?php
		// phpcs:disable WordPress.Security
		if ( 1 === intval( $total ) ) {
			_e( 'Showing the single result', 'shofa' );
		} elseif ( $total <= $per_page || -1 === $per_page ) {
			/* translators: %d: total results */
			printf( _n( 'Showing all <b>%d</b> result', 'Showing all <b>%d</b> results', $total, 'shofa' ), $total );
		} else {
			$first = ( $per_page * $current ) - $per_page + 1;
			$last  = min( $total, $per_page * $current );
			/* translators: 1: first result 2: last result 3: total results */
			printf( _nx( 'Showing <b> %1$d&ndash;%2$d </b> of <b> %3$d </b> result', 'Showing <b> %1$d&ndash;%2$d </b> of <b> %3$d </b> results', $total, 'with first and last result', 'shofa' ), $first, $last, $total );
		}
		// phpcs:enable WordPress.Security
		?>
	</span>
</div>
