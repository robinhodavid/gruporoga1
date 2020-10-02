<?php
/**
 * Enable or disable the related products section on single product
 *
 * @since 	1.0.0
 */

$woohoo_related_products = get_option( 'woohoo_related_products' );

if ( ! is_admin() && $woohoo_related_products != 'yes' ) :

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

endif;