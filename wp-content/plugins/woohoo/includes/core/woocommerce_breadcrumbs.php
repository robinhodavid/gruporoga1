<?php
/**
 * Enable or disable the WooCommerce breadcrumbs
 *
 * @since 	1.0.0
 */

$woohoo_woocommerce_breadcrumbs = get_option( 'woohoo_woocommerce_breadcrumbs');

if ( ! is_admin() && $woohoo_woocommerce_breadcrumbs === 'no' ) :

	/**
	 * woohoo_woocommerce_breadcrumbs
	 *
	 * Remove WooCommerce breadcrumbs, hooked in to the init action
	 *
	 * @since    1.0.0
	 */

	function woohoo_woocommerce_breadcrumbs() {

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		remove_action( 'storefront_content_top', 'woocommerce_breadcrumb', 10 );

	}
	add_action( 'init', 'woohoo_woocommerce_breadcrumbs' );

endif;