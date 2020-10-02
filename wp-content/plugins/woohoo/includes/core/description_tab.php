<?php
/**
 * Change the text used for the description tab
 *
 * @since 	1.0.0
 */

$woohoo_description_tab_text = get_option( 'woohoo_description_tab_text' );

if ( ! is_admin() && ! empty( $woohoo_description_tab_text ) ) :
	
	/**
	 * woohoo_description_tab_text
	 *
	 * Update text used for description tab, hooked in to the filter
	 *
	 * @since    1.0.0
	 * @param 	 array 		$tabs 	Original tabs text
	 * @return 	 array  	$tabs 	Modified tabs text
	 */

	function woohoo_description_tab_text( $tabs ) {

		if ( isset( $tabs['description']['title'] ) ) :

			$tabs['description']['title'] = get_option( 'woohoo_description_tab_text' );

		endif;

		return $tabs;

	}
	add_filter( 'woocommerce_product_tabs', 'woohoo_description_tab_text', 98 );

endif;


/**
 * Remove the <h2> title from the description tab on single product
 *
 * @since 	1.0.0
 */

$woohoo_description_tab_heading = get_option( 'woohoo_description_tab_heading' );

if ( ! is_admin() && $woohoo_description_tab_heading === 'no' ) :

	add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );

endif;


/**
 * Change the <h2> title text in the description tab
 *
 * @since 	1.0.0
 */

$woohoo_description_tab_heading_text = get_option( 'woohoo_description_tab_heading_text' );

if ( ! is_admin() && $woohoo_description_tab_heading === 'yes' && ! empty( $woohoo_description_tab_heading_text ) ) :

	/**
	 * woohoo_description_tab_heading_text
	 *
	 * Update text used for description title, hooked in to the filter
	 *
	 * @since    1.0.0
	 * @return 	 string  	Modified title text
	 */

	function woohoo_description_tab_heading_text(){

		return get_option( 'woohoo_description_tab_heading_text' );

	}

	add_filter( 'woocommerce_product_description_heading', 'woohoo_description_tab_heading_text' );

endif;