<?php
/**
 * Rename the coupon field placeholder and button
 *
 * @since 	1.0.0
 */

$woohoo_place_order_button_text = get_option( 'woohoo_place_order_button_text' );

if ( ! is_admin() && $woohoo_place_order_button_text ) :

	/**
	 * woohoo_place_order_button_text
	 *
	 * Update text used for 'Place order' button on checkout page
	 *
	 * @since    1.0.0
	 * @param 	 string 	$translated_text
	 * @param 	 string 	$text
	 * @param 	 string 	$text_domain
	 * @return 	 string 	$translated_text
	 */

	function woohoo_place_order_button_text( $translated_text, $text, $text_domain ) {
		
		# bail if not modifying frontend woocommerce text
		if ( is_admin() || 'woocommerce' !== $text_domain ) {
			return $translated_text;
		}
		
		# Button text
		if ( 'Place order' === $text ) {
			$translated_text = get_option( 'woohoo_place_order_button_text' );
		}
		
		return $translated_text;

	}
	add_filter( 'gettext', 'woohoo_place_order_button_text', 10, 3 );

endif;