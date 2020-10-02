<?php
/**
 * Change the text used for the reviews tab
 *
 * @since 	1.0.0
 */

$woohoo_reviews_tab_text = get_option( 'woohoo_reviews_tab_text' );

if ( ! is_admin() && ! empty( $woohoo_reviews_tab_text ) ) :
	
	function woohoo_reviews_tab_text( $tabs ) {

		if ( isset( $tabs['reviews']['title'] ) ) :

			$reviews_title = $tabs['reviews']['title'];

			$reviews_title = str_replace( 'Reviews', get_option( 'woohoo_reviews_tab_text' ), $reviews_title );

			$tabs['reviews']['title'] = $reviews_title;

		endif;

		return $tabs;

	}
	add_filter( 'woocommerce_product_tabs', 'woohoo_reviews_tab_text', 98 );

endif;


if ( ! is_admin() ) :

	/**
     * woohoo_reviews_template
     *
     * Change the location of the single product reviews template
     *
     * @since    1.0.0
     * @param    string     $template  		Original template
     * @return   string     				Location of new template
     */
	
	function woohoo_reviews_template( $template ) {    
		    
	    global $woocommerce;

	    if( get_post_type() == "product" ) :

			return woohoo_root( '/includes/templates/single-product/single-product-reviews.php' );

		endif;

		return $template;

	}	
	add_filter( 'comments_template', 'woohoo_reviews_template', 100, 1 );


endif;