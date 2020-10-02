<?php
if ( ! is_admin() ) :


/**
 * woohoo_product_gallery_zoom
 *
 * Enable or disable the product gallery zoom
 *
 * @since 	1.0.0
 */

function woohoo_product_gallery_zoom(){

	$woohoo_product_gallery_zoom = get_option( 'woohoo_product_gallery_zoom' );

	if ( $woohoo_product_gallery_zoom === 'yes' ) :

		add_theme_support( 'wc-product-gallery-zoom' );
	
	else:

		remove_theme_support( 'wc-product-gallery-zoom' );
	
	endif;
}
add_action( 'after_setup_theme', 'woohoo_product_gallery_zoom', 200 );


endif;