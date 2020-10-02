<?php
/**
 * Rename the coupon field placeholder and button
 *
 * @since 	1.0.0
 */

$woohoo_coupon_field_button_text = get_option( 'woohoo_coupon_field_button_text' );
$woohoo_coupon_field_placeholder_text = get_option( 'woohoo_coupon_field_placeholder_text' );

if ( ! is_admin() && ( ! empty( $woohoo_coupon_field_button_text ) || ! empty( $woohoo_coupon_field_placeholder_text ) ) ) :

	/**
	 * woohoo_rename_coupon_field_on_cart
	 *
	 * Update text used for coupon button and field placeholder
	 *
	 * @since    1.0.0
	 * @param 	 string 	$translated_text
	 * @param 	 string 	$text
	 * @param 	 string 	$text_domain
	 * @return 	 string 	$translated_text
	 */

	function woohoo_rename_coupon_field_on_cart( $translated_text, $text, $text_domain ) {
		
		# bail if not modifying frontend woocommerce text
		if ( is_admin() || 'woocommerce' !== $text_domain ) {
			return $translated_text;
		}
		
		# Button text
		if ( 'Apply coupon' === $text ) {
			$new_button_text = get_option( 'woohoo_coupon_field_button_text' );
			$translated_text = ! empty($new_button_text) ? $new_button_text : 'Apply coupon';
		}

		# Placeholder
		if ( 'Coupon code' === $text ) {
			$new_button_placeholder = get_option( 'woohoo_coupon_field_placeholder_text' );
			$translated_text = ! empty( $new_button_placeholder) ? $new_button_placeholder : 'Coupon code';
		}
		
		return $translated_text;

	}
	add_filter( 'gettext', 'woohoo_rename_coupon_field_on_cart', 10, 3 );

endif;