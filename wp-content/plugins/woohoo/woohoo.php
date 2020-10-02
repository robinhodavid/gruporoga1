<?php
/**
 * @since       1.0.2
 * @package     WooHoo!
 *
 * @wordpress-plugin
 * Plugin Name: WooHoo! - WooCommerce customiser
 * Description: Easily and quickly customise your WooCommerce shop.
 * Version:     1.0.2
 * Author:      Martin Stewart
 * Author URI:	https://corgmo.github.io/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: woohoo
 * 
 * WC requires at least: 3.0.0
 * WC tested up to: 3.8.0
 * 
 */

if (!defined('ABSPATH')) exit; # Exit if accessed directly

/**
 * Check if the free version of WooHoo is active and deactivate it
 *
 * @since    1.0.0
 */

function woohoo_is_pro_active()
{

    if (is_plugin_active('woohoo-pro/woohoo-pro.php') || is_plugin_active_for_network('woohoo-pro/woohoo-pro.php')) : ?>

        <div class="notice notice-error">
            <p><?php _e('<strong>WooHoo! Pro activated. WooHoo! has been deactivated.</strong>', 'woohoo'); ?></p>
        </div><?php

        endif;
    }
    add_action('admin_init', 'woohoo_is_pro_active');


    /**
     * Check the pro version isn't active
     *
     * @since    1.0.1
     */

    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

    if (!is_plugin_active('woohoo-pro/woohoo-pro.php') && !is_plugin_active_for_network('woohoo-pro/woohoo-pro.php')) :

        /**
         * Check if WooCommerce is active
         *
         * @since    1.0.0
         */

        function woohoo_woocommerce_active()
        {

            if (!is_plugin_active('woocommerce/woocommerce.php') && !is_plugin_active_for_network('woocommerce/woocommerce.php')) :

                /**
                 * Output error message
                 *
                 * @since    1.0.0
                 */

                function woohoo_error_message()
                { ?>

                <div class="notice notice-error">
                    <p><?php _e('<strong>WooHoo! is not active.</strong> Please activate WooCommerce!', 'woohoo'); ?></p>
                </div><?php

                }
                add_action('admin_notices', 'woohoo_error_message');

            endif;
        }
        add_action('admin_init', 'woohoo_woocommerce_active');


        /**
         * woohoo_load_plugin_textdomain
         *
         * Load translations
         *
         * @since    1.0.0
         */

        function woohoo_load_plugin_textdomain()
        {

            load_plugin_textdomain('woohoo', FALSE, basename(dirname(__FILE__)) . '/languages/');
        }
        add_action('plugins_loaded', 'woohoo_load_plugin_textdomain');


        /**
         * woohoo_root
         *
         * Define the plugin root path or url, used for enqueuing assets and including files.
         *
         * @since    1.0.0
         */

        function woohoo_root($path, $return_url = null)
        {

            $woohoo_url = $return_url ? plugins_url('', __FILE__) . $path : plugin_dir_path(__FILE__) . $path;

            return $woohoo_url;
        }


        /**
         * woohoo_enqueue_admin_scripts
         *
         * Enqueue CSS and javascript for admin.
         *
         * @since    1.0.0
         */

        function woohoo_enqueue_admin_scripts()
        {

            # CSS
            wp_enqueue_style('woohoo_admin_css', woohoo_root('/admin/css/woohoo-admin.min.css', true));
            wp_enqueue_style('woohoo_admin_font_awesome', woohoo_root('/public/font-awesome/css/fontawesome-all.min.css', true));

            # js

            wp_register_script('woohoo_admin_js', woohoo_root('/admin/js/woohoo-admin.js', true), array('jquery'), '1.0.0', true);

            # Localize the script with new data
            $translation_array = array(
                'woohoopro_menu_item' => __('Get more customisation options with WooHoo! Pro', 'woohoo'),
                'woohoopro_find_out_more' => __('Find out more', 'woohoo')
            );
            wp_localize_script('woohoo_admin_js', 'woohoo', $translation_array);
            wp_enqueue_script('woohoo_admin_js');
        }
        add_action('admin_enqueue_scripts', 'woohoo_enqueue_admin_scripts');


        /**
         * woohoo_declare_woocommerce_support
         *
         * Declare WooCommerce support
         *
         * @since 	1.0.0
         */

        function woohoo_declare_woocommerce_support()
        {

            add_theme_support('woocommerce');
        }
        add_action('after_setup_theme', 'woohoo_declare_woocommerce_support');


        /**
         * woohoo_import_core_files
         *
         * Uses array of filenames to include core files
         *
         * @since    1.0.0
         * @param    array 		$woohoo_settings 	Array of filenames
         */

        function woohoo_import_core_files($woohoo_settings)
        {

            foreach ($woohoo_settings as $file_name) {

                include_once(woohoo_root('/includes/core/') . $file_name . '.php');
            }
        }


        /**
         * Check which settings have been activated by user, then add them to the
         * settings array within the WooHoo class, and call woohoo_import_core_files()
         *
         * Not activated if in WooHoo! settings page
         *
         * @since    1.0.0
         */

        $page = isset($_GET['page']) ? $_GET['page'] : '';

        if (!function_exists('woohoo') && 'acf-options-woohoo-settings' != $page) :

            # initialise
            include_once(woohoo_root('/includes/classes/class_woohoo.php'));

            global $woohoo;

            if (!isset($woohoo)) $woohoo = new WooHoo();

            $woohoo->init();

            # Shop settings
            $woohoo_shop_settings_args = array(

                'add_a_prefix_to_order_numbers',
                'add_cart_icon',
                'add_to_cart_button_text',
                'additional_information_tab',
                'autocomplete_all_orders',
                'description_tab',
                'number_of_gallery_thumbnails_per_row',
                'number_of_products_per_row',
                'order_notes_in_checkout',
                'order_complete_page',
                'place_order_button_text',
                'product_categories_and_tags',
                'product_excerpt_on_shop_page',
                'product_gallery_lightbox',
                'product_gallery_slider',
                'product_gallery_zoom',
                'product_images_in_cart',
                'related_products',
                'rename_coupon_field_in_cart',
                'reviews_tab',
                'woocommerce_breadcrumbs',

            );

            $woohoo->add_setting($woohoo_shop_settings_args);


            # Import the files based on settings
            function woohoo_load_core_files()
            {

                global $woohoo;

                woohoo_import_core_files($woohoo->get_settings());
            }
            add_action('woohoo_settings_files', 'woohoo_load_core_files');


            # Action to import settings files
            do_action('woohoo_settings_files');


        endif;


        /**
         * Function to check if we are in the WooHoo settings page
         *
         * @since    1.0.0
         */

        function woohoo_settings_screen()
        {

            $page = isset($_GET['page']) ? $_GET['page'] : '';
            $tab = isset($_GET['tab']) ? $_GET['tab'] : '';

            if ($page === 'wc-settings' && $tab === 'woohoo') :

                /**
                 * Output a message in the footer on the settings page
                 * 
                 * @since    1.0.0
                 * @param    string 	$text 	Original footer markup
                 */

                function woohoo_footer($text)
                {

                    ob_start(); ?>

                <p class="woohoo_footer"> <?php

                                            $me_url = 'https://www.corgdesign.com?utm_source=plugin&utm_campaign=woohoo';
                                            $plugin_url = 'https://www.corgdesign.com/wordpress-plugins/?utm_source=plugin&utm_campaign=woohoo';
                                            $beer_url = 'https://www.paypal.me/corgdesign/5';

                                            $allowed = array(
                                                'a' => array(
                                                    'href' => array(),
                                                    'target' => array(),
                                                    'rel' => array()
                                                ),
                                                'span' => array(
                                                    'class' => array()
                                                )
                                            );

                                            $text = sprintf(wp_kses(__('Made with <span class="dashicons dashicons-heart"><span>love</span></span> by <a href="%s" target="_blank" rel="noopener noreferrer">Martin Stewart</a>, for the WordPress community. View my other <a href="%s" target="_blank" rel="noopener noreferrer">WordPress plugins</a>. If you\'re feeling generous you can <a href="%s" target="_blank" rel="noopener noreferrer">buy me a beer</a>. Hic!', 'woohoo'), $allowed), esc_url($me_url), esc_url($plugin_url), esc_url($beer_url));

                                            echo $text;    ?>

                </p>

                <p class="woohoo_footer"> <?php

                                            $pro_url = 'https://www.corgdesign.com/woohoo-pro/?utm_source=plugin&utm_campaign=woohoo';

                                            $text = sprintf(wp_kses(__('WooHoo! is also available in a <a href="%s">Pro version</a> with options to customise customer emails, quantity-based shipping, and admin notifications. Ooh, how lovely! <a href="%s">Find out more</a>.', 'woohoo'), $allowed), esc_url($pro_url), esc_url($pro_url));

                                            echo $text; ?>

                </p> <?php

                        $text = ob_get_clean();

                        return $text;
                    }

                    add_filter('admin_footer_text', 'woohoo_footer');

                endif;
            }
            add_action('current_screen', 'woohoo_settings_screen');

        endif;
