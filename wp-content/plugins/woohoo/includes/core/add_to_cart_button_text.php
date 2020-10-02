<?php
/**
 * woohoo_add_to_cart_text
 *
 * Define custom text for the button
 *
 * @since    1.0.0
 * @return 	 string 	The new text for the button
 */

function woohoo_add_to_cart_text() {

	global $product;

    $product_type = $product->get_type();


    # Single product page
    if ( is_product () ) :

	    switch ( $product_type ) {

	        case 'simple':
	        
	            return get_option( 'woohoo_add_to_cart_button_text_simple_product' );
	        
	        break;
	        
	        case 'grouped':
	        
	            return get_option( 'woohoo_add_to_cart_button_text_grouped_product' );

	        break;
	        
	        case 'external':
	        
	            return get_option( 'woohoo_add_to_cart_button_text_external_product' );
	        
	        break;
	        
	        case 'variable':
	        
	            return get_option( 'woohoo_add_to_cart_button_text_variable_product' );
	        
	        break;
	        
	        default:
	        
	            return __( 'Read more', 'woocommerce' );

	    }

    else :

	    switch ( $product_type ) {
	        
	    	case 'simple':
	        
	            return get_option( 'woohoo_add_to_cart_button_text_simple_product_archive' );
	        
	        break;
	        
	        case 'grouped':
	        
	            return get_option( 'woohoo_add_to_cart_button_text_grouped_product_archive' );

	        break;
	        
	        case 'external':
	        
	            return get_option( 'woohoo_add_to_cart_button_text_external_product_archive' );
	        
	        break;
	        
	        case 'variable':
	        
	            return get_option( 'woohoo_add_to_cart_button_text_variable_product_archive' );
	        
	        break;
	        
	        default:
	        
	            return __( 'Read more', 'woocommerce' );

		}

	endif;

}
add_filter( 'woocommerce_product_add_to_cart_text', 'woohoo_add_to_cart_text' ); 
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woohoo_add_to_cart_text' );