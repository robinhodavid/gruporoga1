<?php 
/**
 * The core plugin class.
 *
 * This is used to store the settings chosen by the user
 *
 * @since      1.0.0
 * @package    WooHoo
 * @author     Martin Stewart
 */


if ( ! class_exists('WooHoo') ) :


class WooHoo {
	
	/**
	 * Define the settings array
	 *
	 * @since    1.0.0
	 */

	function __construct() {

		$this->settings = array();
	
	}


	/**
	 * Add to the settings array
	 *
	 * @since 	1.0.0
	 * @param 	array 	$additional_setting 	Array to be added
	 */
	
    public function add_setting( $additional_setting ) {

		$this->settings = array_merge( $this->settings, $additional_setting );

	}


	/**
	 * Return the settings array
	 *
	 * @since 	1.0.0
	 * @return 	array 	The array of settings
	 */

	public function get_settings() {

		return $this->settings;

	}


	/**
     * https://www.speakinginbytes.com/2014/07/woocommerce-settings-tab/ 
     * Bootstraps the class and hooks required actions & filters.
     *
     * @since 	1.0.0
     */

    public static function init() {
        
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::woohoo_add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_woohoo', __CLASS__ . '::woohoo_settings_tab' );
        add_action( 'woocommerce_update_options_woohoo', __CLASS__ . '::woohoo_update_settings' );

    }
    
    
    /**
     * Add a new settings tab to the WooCommerce settings tabs array.
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
     * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
     */

    public static function woohoo_add_settings_tab( $settings_tabs ) {
        
        $settings_tabs['woohoo'] = __( 'WooHoo! Customiser', 'woohoo' );
        return $settings_tabs;

    }


    /**
     * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    
    public static function woohoo_settings_tab() {
        
        woocommerce_admin_fields( self::woohoo_get_settings() );

        wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );

    }


    /**
     * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    
    public static function woohoo_update_settings() {
    
        woocommerce_update_options( self::woohoo_get_settings() );
    
    }
    

    /**
     * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
     *
     * @return array Array of settings for @see woocommerce_admin_fields() function.
     */
    
    public static function woohoo_get_settings() {
        
        $settings = array(

            # Start of General section
        	'woohoo_general_section' => array(
                'name'     => __( 'General', 'woohoo' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'woohoo_general_section'
            ),

                # Add a prefix to order numbers
                'woohoo_add_a_prefix_to_order_numbers' => array(
                    'name'      => __( 'Prefix order numbers', 'woohoo' ),
                    'type'      => 'text',
                    'desc_tip'  => __( 'e.g you could add WOOHOO_ to the start of the order number', 'woohoo' ),
                    'id'        => 'woohoo_add_a_prefix_to_order_numbers',
                    'class'     => 'woohoo_add_a_prefix_to_order_numbers'
                ),

                # WooCommerce breadcrumbs
                'woohoo_woocommerce_breadcrumbs' => array(
                    'name'      => __( 'Breadcrumbs', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __('Enable WooCommerce breadcrumbs', 'woohoo'),
                    'id'        => 'woohoo_woocommerce_breadcrumbs',
                    'class'     => 'woohoo_woocommerce_breadcrumbs',
                    'default'   => 'yes'
                ),

                # Add cart icon
                'woohoo_add_cart_icon' => array(
                    'name'      => __( 'Cart icon', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __('Add a cart icon', 'woohoo'),
                    'desc_tip'  => __('Use <code>do_action( \'woohoo-cart-icon\' );</code> in your template\'s theme to display the cart icon', 'woohoo'),
                    'id'        => 'woohoo_add_cart_icon',
                    'class'     => 'woohoo_add_cart_icon'
                ),

                # Choose cart icon
                'woohoo_choose_cart_icon' => array(
                    'name'      => __( 'Choose cart icon', 'woohoo' ),
                    'type'      => 'radio',
                    'options'   => array(
    					'fa-shopping-cart'     => '<i class="fa fa-shopping-cart"></i>',
    					'fa-shopping-bag'      => '<i class="fa fa-shopping-bag"></i>',
    					'fa-shopping-basket'   => '<i class="fa fa-shopping-basket"></i>',
    				),
                    'id'        => 'woohoo_choose_cart_icon',
                    'class'     => 'woohoo_choose_cart_icon'
                ),

                # Icon colour
                'woohoo_icon_colour' => array(
                    'name'      => __( 'Icon colour', 'woohoo' ),
                    'type'      => 'color',
                    'id'        => 'woohoo_icon_colour',
                    'class'     => 'woohoo_icon_colour ',
                    'default'   => '#666666',
                    'css'       => 'width:6em;'
                ),

                # Badge background colour
                'woohoo_badge_background_colour' => array(
                    'name'      => __( 'Badge background colour', 'woohoo' ),
                    'type'      => 'color',
                    'id'        => 'woohoo_badge_background_colour',
                    'class'     => 'woohoo_badge_background_colour ',
                    'default'   => '#d42626',
                    'css'       => 'width:6em;'
                ),

                # Badge text colour
                'woohoo_badge_text_colour' => array(
                    'name'      => __( 'Badge text colour', 'woohoo' ),
                    'type'      => 'color',
                    'id'        => 'woohoo_badge_text_colour',
                    'class'     => 'woohoo_badge_text_colour ',
                    'default'   => '#FFFFFF',
                    'css'       => 'width:6em;'
                ),

                # Autocomplete all orders
                'woohoo_autocomplete_all_orders' => array(
                    'name'      => __( 'Autocomplete orders', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __('Autocomplete all orders', 'woohoo'),
                    'desc_tip'  => __('Good if your shops sells only virtual or downloadable products', 'woohoo'),
                    'id'        => 'woohoo_autocomplete_all_orders',
                    'class'     => 'woohoo_autocomplete_all_orders'
                ),

                # Number of products per row
                'woohoo_number_of_products_per_row' => array(
                    'name'      => __( 'Number of products per row', 'woohoo' ),
                    'type'      => 'number',
                    'desc_tip'  => __( 'Products displayed in shop and archive pages, you may also need to change your theme\'s stylesheet', 'woohoo' ),
                    'id'        => 'woohoo_number_of_products_per_row',
                    'class'     => 'woohoo_number_of_products_per_row',
                    'css'       => 'width:50px'
                ),

                # Product excerpt in shop and archive pages
                'woohoo_product_excerpt_on_shop_page' => array(
                    'name'      => __( 'Product short description', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __('Show on shop and archive pages', 'woohoo'),
                    'id'        => 'woohoo_product_excerpt_on_shop_page',
                    'class'     => 'woohoo_product_excerpt_on_shop_page'
                ),

            # End of General section
            'general_section_end' => array(
                 'type' => 'sectionend',
                 'id'   => 'general_section_end'
            ),



            # Start of Checkout section
            'woohoo_checkout_section' => array(
                'name'     => __( 'Checkout', 'woohoo' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'woohoo_checkout_section'
            ),

                # Product images in cart
                'woohoo_product_images_in_cart' => array(
                    'name'      => __( 'Cart images', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __( 'Show product images in cart', 'woohoo' ),
                    'id'        => 'woohoo_product_images_in_cart',
                    'class'     => 'woohoo_product_images_in_cart',
                    'default'   => 'yes'
                ),

                # Order notes in checkout
                'woohoo_order_notes_in_checkout' => array(
                    'name'      => __( 'Order notes', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __( 'Show order notes in checkout', 'woohoo' ),
                    'id'        => 'woohoo_order_notes_in_checkout',
                    'class'     => 'woohoo_order_notes_in_checkout',
                    'default'   => 'yes'
                ),

                # Coupon field button text
                'woohoo_coupon_field_button_text' => array(
                    'name'      => __( 'Coupon field button text', 'woohoo' ),
                    'type'      => 'text',
                    'id'        => 'woohoo_coupon_field_button_text',
                    'class'     => 'woohoo_coupon_field_button_text'
                ),

                # Coupon field placeholder text
                'woohoo_coupon_field_placeholder_text' => array(
                    'name'      => __( 'Coupon field placeholder', 'woohoo' ),
                    'type'      => 'text',
                    'id'        => 'woohoo_coupon_field_placeholder_text',
                    'class'     => 'woohoo_coupon_field_placeholder_text'
                ),

                # Place order button text
                'woohoo_place_order_button_text' => array(
                    'name'      => __( 'Place order button text', 'woohoo' ),
                    'type'      => 'text',
                    'id'        => 'woohoo_place_order_button_text',
                    'class'     => 'woohoo_place_order_button_text'
                ),

                # Order complete page
                'woohoo_order_complete_page' => array(
                    'name'      => __( 'Order complete page', 'woohoo' ),
                    'type'      => 'textarea',
                    'desc_tip'  => __( 'Add extra content to display at the top of the \'Order Complete\' page', 'woohoo' ),
                    'id'        => 'woohoo_order_complete_page',
                    'class'     => 'woohoo_order_complete_page'
                ),

            # End of Checkout section
            'checkout_section_end' => array(
                 'type' => 'sectionend',
                 'id'   => 'checkout_section_end'
            ),



            # Start of Products section
            'woohoo_products_section' => array(
                'name'     => __( 'Products', 'woohoo' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'woohoo_products_section'
            ),

                # Product gallery lightbox
                'woohoo_product_gallery_lightbox' => array(
                    'name'      => __( 'Product gallery', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __( 'Enable product gallery lightbox', 'woohoo' ),
                    'id'        => 'woohoo_product_gallery_lightbox',
                    'class'     => 'woohoo_product_gallery_lightbox',
                    'default'   => 'yes'
                ),

                # Product gallery slider
                'woohoo_product_gallery_slider' => array(
                    'type'      => 'checkbox',
                    'desc'      => __( 'Enable product gallery slider', 'woohoo' ),
                    'id'        => 'woohoo_product_gallery_slider',
                    'class'     => 'woohoo_product_gallery_slider',
                    'default'   => 'yes'
                ),

                # Product gallery zoom
                'woohoo_product_gallery_zoom' => array(
                    'type'      => 'checkbox',
                    'desc'      => __( 'Enable product gallery zoom', 'woohoo' ),
                    'id'        => 'woohoo_product_gallery_zoom',
                    'class'     => 'woohoo_product_gallery_zoom',
                    'default'   => 'yes'
                ),

                # Number of gallery thumbnails per row
                'woohoo_number_of_gallery_thumbnails_per_row' => array(
                    'name'      => __( 'Gallery thumbnails per row', 'woohoo' ),
                    'type'      => 'number',
                    'desc_tip'  => __( 'You may also need to change your theme\'s stylesheet', 'woohoo' ),
                    'id'        => 'woohoo_number_of_gallery_thumbnails_per_row',
                    'class'     => 'woohoo_number_of_gallery_thumbnails_per_row',
                    'css'       => 'width:50px'
                ),

                # Product categories and tags
                'woohoo_product_categories_and_tags' => array(
                    'name'      => __( 'Categories and tags', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __( 'Show categories and tags on product page', 'woohoo' ),
                    'id'        => 'woohoo_product_categories_and_tags',
                    'class'     => 'woohoo_product_categories_and_tags',
                    'default'   => 'yes'
                ),

                # Related products
                'woohoo_related_products' => array(
                    'name'      => __( 'Related products', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __( 'Show related products on product page', 'woohoo' ),
                    'id'        => 'woohoo_related_products',
                    'class'     => 'woohoo_related_products',
                    'default'   => 'yes'
                ),

                # Description tab text
                'woohoo_description_tab_text' => array(
                    'name'      => __( 'Description tab', 'woohoo' ),
                    'type'      => 'text',
                    'default'   => __('Description', 'woohoo'),
                    'desc_tip'  => __('Rename the Description tab', 'woohoo'),
                    'id'        => 'woohoo_description_tab_text',
                    'class'     => 'woohoo_description_tab_text'
                ),

                # Description tab heading
                'woohoo_description_tab_heading' => array(
                    'name'      => __( 'Description tab heading', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __( 'Show Description tab heading', 'woohoo' ),
                    'id'        => 'woohoo_description_tab_heading',
                    'class'     => 'woohoo_description_tab_heading',
                    'default'   => 'yes'
                ),

                # Description tab heading text
                'woohoo_description_tab_heading_text' => array(
                    'name'      => __( 'Description tab heading text', 'woohoo' ),
                    'type'      => 'text',
                    'default'   => __('Description', 'woohoo'),
                    'desc_tip'  => __('Change the text used in the Description tab\'s heading', 'woohoo'),
                    'id'        => 'woohoo_description_tab_heading_text',
                    'class'     => 'woohoo_description_tab_heading_text'
                ),

                # Additional information tab text
                'woohoo_additional_information_tab_text' => array(
                    'name'      => __( 'Additional information tab', 'woohoo' ),
                    'type'      => 'text',
                    'default'   => __('Additional information', 'woohoo'),
                    'desc_tip'  => __('Rename the Additional information tab', 'woohoo'),
                    'id'        => 'woohoo_additional_information_tab_text',
                    'class'     => 'woohoo_additional_information_tab_text'
                ),

                # Additional information tab heading
                'woohoo_additional_information_tab_heading' => array(
                    'name'      => __( 'Additional information tab heading', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __( 'Show Additional information tab heading', 'woohoo' ),
                    'id'        => 'woohoo_additional_information_tab_heading',
                    'class'     => 'woohoo_additional_information_tab_heading',
                    'default'   => 'yes'
                ),

                # Additional information tab heading text
                'woohoo_additional_information_tab_heading_text' => array(
                    'name'      => __( 'Additional information heading text', 'woohoo' ),
                    'type'      => 'text',
                    'desc_tip'  => __('Change the text used for the Additional information tab\'s heading', 'woohoo'),
                    'default'   => __('Additional information', 'woohoo'),
                    'id'        => 'woohoo_additional_information_tab_heading_text',
                    'class'     => 'woohoo_additional_information_tab_heading_text'
                ),

                # Reviews tab
                'woohoo_reviews_tab_text' => array(
                    'name'      => __( 'Reviews tab', 'woohoo' ),
                    'type'      => 'text',
                    'default'   => __('Reviews', 'woohoo'),
                    'desc_tip'  => __('Rename the Reviews tab', 'woohoo'),
                    'id'        => 'woohoo_reviews_tab_text',
                    'class'     => 'woohoo_reviews_tab_text'
                ),

                # Reviews tab heading
                'woohoo_reviews_tab_heading' => array(
                    'name'      => __( 'Reviews tab heading', 'woohoo' ),
                    'type'      => 'checkbox',
                    'desc'      => __( 'Show Reviews tab heading', 'woohoo' ),
                    'id'        => 'woohoo_reviews_tab_heading',
                    'class'     => 'woohoo_reviews_tab_heading',
                    'default'   => 'yes'
                ),

                # Reviews tab title
                'woohoo_reviews_tab_heading_text' => array(
                    'name'      => __( 'Reviews tab heading text', 'woohoo' ),
                    'type'      => 'text',
                    'default'   => __('Reviews', 'woohoo'),
                    'desc_tip'  => __('Change the text used for the Reviews tab\'s heading', 'woohoo'),
                    'id'        => 'woohoo_reviews_tab_heading_text',
                    'class'     => 'woohoo_reviews_tab_heading_text'
                ),

            # End of Products section
            'product_section_end' => array(
                 'type' => 'sectionend',
                 'id'   => 'product_section_end'
            ),



            # Start of Add to cart section
            'woohoo_add_to_cart_title' => array(
                'name'     => __( 'Add to cart button', 'woohoo' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'woohoo_add_to_cart_title',
                'class'    => 'woohoo_add_to_cart_title'
            ),

                # Single product section
                'woohoo_add_to_cart_single_title' => array(
                    'name'     => __( 'Single product page', 'woohoo' ),
                    'type'     => 'title',
                    'desc'     => __( '<strong>Choose the \'Add to cart\' button text on single product pages</strong>', 'woohoo' ),
                    'id'       => 'woohoo_add_to_cart_single_title'
                ),

                    # Simple product
                    'woohoo_add_to_cart_button_text_simple_product' => array(
                        'name'      => __( 'Simple product', 'woohoo' ),
                        'type'      => 'text',
                        'desc_tip'  => '',
                        'default'   => __('Add to cart', 'woohoo'),
                        'id'        => 'woohoo_add_to_cart_button_text_simple_product',
                        'class'     => 'woohoo_add_to_cart_button_text_simple_product'
                    ),

                    # Grouped product
                    'woohoo_add_to_cart_button_text_grouped_product' => array(
                        'name'      => __( 'Grouped product', 'woohoo' ),
                        'type'      => 'text',
                        'desc_tip'  => '',
                        'default'   => __('Add to cart', 'woohoo'),
                        'id'        => 'woohoo_add_to_cart_button_text_grouped_product',
                        'class'     => 'woohoo_add_to_cart_button_text_grouped_product'
                    ),

                    # External product
                    'woohoo_add_to_cart_button_text_external_product' => array(
                        'name'      => __( 'External product', 'woohoo' ),
                        'type'      => 'text',
                        'desc_tip'  => '',
                        'default'   => __('Add to cart', 'woohoo'),
                        'id'        => 'woohoo_add_to_cart_button_text_external_product',
                        'class'     => 'woohoo_add_to_cart_button_text_external_product'
                    ),

                    # Variable product
                    'woohoo_add_to_cart_button_text_variable_product' => array(
                        'name'      => __( 'Variable product', 'woohoo' ),
                        'type'      => 'text',
                        'desc_tip'  => '',
                        'default'   => __('Add to cart', 'woohoo'),
                        'id'        => 'woohoo_add_to_cart_button_text_variable_product',
                        'class'     => 'woohoo_add_to_cart_button_text_variable_product'
                    ),

                # End of single product section
                'add_to_cart_single_section_end' => array(
                     'type' => 'sectionend',
                     'id'   => 'add_to_cart_single_section_end'
                ),



                # Shop and archive page section
                'woohoo_add_to_cart_shop_archive_section' => array(
                    'name'     => __( 'Shop and archive page', 'woohoo' ),
                    'type'     => 'title',
                    'desc'     => __( '<strong>Choose the \'Add to cart\' button text on shop and archive pages</strong>', 'woohoo' ),
                    'id'       => 'woohoo_add_to_cart_shop_archive_section'
                ),

                    # Simple product
                    'woohoo_add_to_cart_button_text_simple_product_archive' => array(
                        'name'      => __( 'Simple product', 'woohoo' ),
                        'type'      => 'text',
                        'desc_tip'  => '',
                        'default'   => __('Add to cart', 'woohoo'),
                        'id'        => 'woohoo_add_to_cart_button_text_simple_product_archive',
                        'class'     => 'woohoo_add_to_cart_button_text_simple_product_archive'
                    ),

                    # Grouped product
                    'woohoo_add_to_cart_button_text_grouped_product_archive' => array(
                        'name'      => __( 'Grouped product', 'woohoo' ),
                        'type'      => 'text',
                        'desc_tip'  => '',
                        'default'   => __('Add to cart', 'woohoo'),
                        'id'        => 'woohoo_add_to_cart_button_text_grouped_product_archive',
                        'class'     => 'woohoo_add_to_cart_button_text_grouped_product_archive'
                    ),

                    # External product
                    'woohoo_add_to_cart_button_text_external_product_archive' => array(
                        'name'      => __( 'External product', 'woohoo' ),
                        'type'      => 'text',
                        'desc_tip'  => '',
                        'default'   => __('Add to cart', 'woohoo'),
                        'id'        => 'woohoo_add_to_cart_button_text_external_product_archive',
                        'class'     => 'woohoo_add_to_cart_button_text_external_product_archive'
                    ),

                    # Variable product
                    'woohoo_add_to_cart_button_text_variable_product_archive' => array(
                        'name'      => __( 'Variable product', 'woohoo' ),
                        'type'      => 'text',
                        'desc_tip'  => '',
                        'default'   => __('Add to cart', 'woohoo'),
                        'id'        => 'woohoo_add_to_cart_button_text_variable_product_archive',
                        'class'     => 'woohoo_add_to_cart_button_text_variable_product_archive'
                    ),

                # End of single product section
                'add_to_cart_single_section_end' => array(
                     'type' => 'sectionend',
                     'id'   => 'add_to_cart_single_section_end'
                ),

            # End of Add to cart section
            'add_to_cart_section_end' => array(
                 'type' => 'sectionend',
                 'id'   => 'add_to_cart_section_end'
            ),
        );
        return apply_filters( 'wc_settings_woohoo_settings_tab', $settings );
    }

}


endif;