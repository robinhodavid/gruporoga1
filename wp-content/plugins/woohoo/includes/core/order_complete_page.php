<?php
/**
 * Add content to the top of the 'Order Complete' page
 *
 * @since 	1.0.0
 */

$woohoo_order_complete_page = get_option( 'woohoo_order_complete_page' );

if ( ! is_admin() && ! empty( $woohoo_order_complete_page ) ) :

	/**
     * woohoo_order_complete_page
     *
     * Change the location of the 'Order complete' page template
     *
     * @since    1.0.0
     * @param    string     $located   		Location of original template
     * @param    string     $template_name   Name of original template
     * @param    array      $args   		Not used, but required by the filter
     * @param    string     $template_path   Not used, but required by the filter
     * @param    string     $default_path  	Not used, but required by the filter
     * @return   string     $located 	     Location of new template
     */

	function woohoo_order_complete_page( $located, $template_name, $args, $template_path, $default_path ) {    
		    
	    if ( 'checkout/thankyou.php' == $template_name ) {
	        $located = woohoo_root( '/includes/templates/checkout/woohoo-thankyou.php' );
	    }
	    
	    return $located;
	}	
	add_filter( 'wc_get_template', 'woohoo_order_complete_page', 10, 5 );

endif;