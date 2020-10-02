<?php
/**
 * Add a prefix to order numbers
 *
 * @since 	1.0.0
 */

$woohoo_add_a_prefix_to_order_numbers = get_option( 'woohoo_add_a_prefix_to_order_numbers' );

if ( ! empty( $woohoo_add_a_prefix_to_order_numbers ) ) :

	/**
	 * woohoo_add_a_prefix_to_order_numbers
	 *
	 * Function called by filter, to add a prefix to all order numbers
	 *
	 * @since    1.0.0
	 * @param 	 string 	$oldnumber 	Order number
	 * @param 	 object 	$order 		A WC_Order class
	 */
	
	function woohoo_add_a_prefix_to_order_numbers( $oldnumber, $order ) {

		$woohoo_add_a_prefix_to_order_numbers = get_option( 'woohoo_add_a_prefix_to_order_numbers' );

		return $woohoo_add_a_prefix_to_order_numbers . $order->get_id();

	}
	add_filter( 'woocommerce_order_number', 'woohoo_add_a_prefix_to_order_numbers', 1, 2 );

endif;