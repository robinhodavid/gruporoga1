<?php
/**
 * Define number of products per row on the shop or archive pages
 *
 * @since 	1.0.0
 */

$woohoo_number_of_products_per_row = get_option( 'woohoo_number_of_products_per_row' );

if ( ! is_admin() && ! empty( $woohoo_number_of_products_per_row ) && ! function_exists( 'loop_columns' ) ) :
			
	/**
     * loop_columns
     *
     * Return the number of products per row
     *
     * @since    1.0.0
     * @return   string
     */

	function loop_columns() {

		return get_option( 'woohoo_number_of_products_per_row' );

	}
     add_filter( 'loop_shop_columns', 'loop_columns', 10000 );
     # Priority 10000 to hopefully override any other filters set in plugins/themes

endif;