<?php
/**
 * Add the product excerpt on shop and archive pages
 *
 * @since 	1.0.0
 */

$woohoo_product_excerpt_on_shop_page = get_option( 'woohoo_product_excerpt_on_shop_page' );

if ( ! is_admin() && $woohoo_product_excerpt_on_shop_page === 'yes' ) :
	
	/**
	 * woohoo_product_excerpt_on_shop_page
	 *
	 * Create markup for product excerpt
	 *
	 * @since    1.0.0
	 */

	function woohoo_product_excerpt_on_shop_page() {
	     
	    $woohoo_product_excerpt = '<div class="woohoo_product_excerpt">' . get_the_excerpt() . '</div>';

	    echo $woohoo_product_excerpt;
	     
	}
	add_action( 'woocommerce_after_shop_loop_item_title', 'woohoo_product_excerpt_on_shop_page', 40 );

endif;