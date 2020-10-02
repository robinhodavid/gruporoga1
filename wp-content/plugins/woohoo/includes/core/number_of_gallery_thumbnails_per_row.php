<?php
/**
 * Define number of gallery thumbnails per row on single product
 *
 * @since 	1.0.0
 */

$woohoo_number_of_gallery_thumbnails_per_row = get_option( 'woohoo_number_of_gallery_thumbnails_per_row' );

if ( ! is_admin() && ! empty( $woohoo_number_of_gallery_thumbnails_per_row ) ) :
	
	/**
     * woohoo_number_of_gallery_thumbnails_per_row
     *
     * Return the number of gallery thumbnails per row
     *
     * @since    1.0.0
     * @return   string
     */
	
	function woohoo_number_of_gallery_thumbnails_per_row() {
		
		return get_option( 'woohoo_number_of_gallery_thumbnails_per_row' );

	}
	add_filter( 'woocommerce_product_thumbnails_columns', 'woohoo_number_of_gallery_thumbnails_per_row', 10000 );
	# Priority 10000 to hopefully override any other filters set in plugins/themes

endif;