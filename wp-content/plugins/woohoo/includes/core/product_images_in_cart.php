<?php
/**
 * Enable or disable the product images in cart
 *
 * @since 	1.0.0
 */

$woohoo_product_images_in_cart = get_option( 'woohoo_product_images_in_cart' );

if ( ! is_admin() && $woohoo_product_images_in_cart != 'yes' ) :

	add_filter( 'woocommerce_cart_item_thumbnail', '__return_false' );

endif;