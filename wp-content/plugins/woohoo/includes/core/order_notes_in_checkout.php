<?php
/**
 * Disable order notes in the checkout
 *
 * @since 	1.0.0
 */

$woohoo_order_notes_in_checkout = get_option( 'woohoo_order_notes_in_checkout' );

if ( ! is_admin() && $woohoo_order_notes_in_checkout != 'yes' ) :
	
	add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

endif;