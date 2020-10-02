<?php
if ( ! is_admin() ) :


/**
 * woohoo_product_gallery_lightbox
 * 
 * Enable or disable the product gallery lightbox
 *
 * @since 	1.0.0
 */

function woohoo_product_gallery_lightbox(){

	$woohoo_product_gallery_lightbox = get_option( 'woohoo_product_gallery_lightbox' );

	if ( $woohoo_product_gallery_lightbox === 'yes' ) :	
	
		add_theme_support( 'wc-product-gallery-lightbox' );
	
	else:

		remove_theme_support( 'wc-product-gallery-lightbox' );

	endif;
}
add_action( 'after_setup_theme', 'woohoo_product_gallery_lightbox', 200 );


endif;