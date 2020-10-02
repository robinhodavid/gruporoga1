<?php
/**
 * Disable categories and tags on single product
 *
 * @since 	1.0.0
 */

$woohoo_product_categories_and_tags = get_option( 'woohoo_product_categories_and_tags' );

if ( ! is_admin() && $woohoo_product_categories_and_tags != 'yes' ) :
	
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

endif;