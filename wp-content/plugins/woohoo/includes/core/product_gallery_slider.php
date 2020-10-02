<?php
if ( ! is_admin() ) :


/**
 * woohoo_product_gallery_slider
 *
 * Enable or disable the product gallery slider
 *
 * @since 	1.0.0
 */

function woohoo_product_gallery_slider(){

	$woohoo_product_gallery_slider = get_option( 'woohoo_product_gallery_slider' );

	if ( $woohoo_product_gallery_slider === 'yes' ) :
		
		add_theme_support( 'wc-product-gallery-slider' );
	
	else:

		remove_theme_support( 'wc-product-gallery-slider' );

	endif;
}
add_action( 'after_setup_theme', 'woohoo_product_gallery_slider', 200 );


endif;