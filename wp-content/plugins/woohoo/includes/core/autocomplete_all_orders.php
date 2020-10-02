<?php
/**
 * Autocomplete all orders
 *
 * @since   1.0.0
 */

$woohoo_autocomplete_all_orders = get_option( 'woohoo_autocomplete_all_orders' );

if ( $woohoo_autocomplete_all_orders === 'yes' ) :
    
    /**
     * woohoo_autocomplete_all_orders
     *
     * Autocomplete all orders by changing status to 'Completed'.
     *
     * @since    1.0.0
     * @param    string     $order_id   The order ID
     */

    function woohoo_autocomplete_all_orders( $order_id ) {

        if ( ! $order_id ) :
            
            return;
        
        endif;

        # Check if there is a prefix on order numbers
        $woohoo_add_a_prefix_to_order_numbers = get_option( 'woohoo_add_a_prefix_to_order_numbers' );

        if ( ! empty( $woohoo_add_a_prefix_to_order_numbers ) && preg_match( '/^'. $woohoo_add_a_prefix_to_order_numbers . '/', $order_id ) ) :

    		$string = $order_id;
    	
    		$start = strlen( $woohoo_add_a_prefix_to_order_numbers );
    	
    		$order_id = substr( $string, $start );

    	endif;

        $order = wc_get_order( $order_id );

        $order->update_status( 'completed' );

    }
    add_action( 'woocommerce_order_status_processing', 'woohoo_autocomplete_all_orders' );

endif;