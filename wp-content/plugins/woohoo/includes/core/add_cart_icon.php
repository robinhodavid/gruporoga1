<?php
/**
 * Add a cart icon
 *
 * @since 	1.0.0
 */

$woohoo_add_cart_icon = get_option( 'woohoo_add_cart_icon');

if ( ! is_admin() && $woohoo_add_cart_icon === 'yes' ) :

	/**
	 * woohoo_add_cart_icon
	 *
	 * Generate markup and CSS for cart icon.  Initialise Tooltipster.
	 *
	 * @since    1.0.0
	 */

	function woohoo_add_cart_icon() {

		global $woocommerce;
		
		$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf( _n( '%d item', '%d items', $cart_contents_count ), $cart_contents_count );
		$cart_total = $woocommerce->cart->get_cart_total();
		$cart_html = '';
		$cart_icon_colour = get_option( 'woohoo_icon_colour' );
		$cart_badge_bg_colour = get_option( 'woohoo_badge_background_colour' );
		$cart_badge_text_colour = get_option( 'woohoo_badge_text_colour' );
		
		if ( $cart_contents_count > 0 ) {
		
			if ($cart_contents_count == 0) {
		
				$cart_html = '<a class="woohoo_cart_icon" href="'. $shop_page_url .'">';
		
			} else {
		
				$cart_html = '<a class="woohoo_cart_icon" data-tooltip-content="#woohoo_cart_contents" href="'. $cart_url .'">';
			}

			$woohoo_choose_cart_icon = get_option( 'woohoo_choose_cart_icon' );

			$cart_html .= '<i class="fas '. $woohoo_choose_cart_icon .' fa-lg"></i><span class="woohoo_counter">' . $cart_contents_count . '</span> ';

			$cart_html .= '<span class="woohoo_cart_contents_wrapper"><span id="woohoo_cart_contents">' . $cart_contents.' - '. $cart_total . '</span></span></a>';
		
		}
		
		echo $cart_html; ?>

		<style type="text/css">
			
			a.woohoo_cart_icon {
				color: <?php echo $cart_icon_colour; ?>;
			}

			.woohoo_counter {
				background-color: <?php echo $cart_badge_bg_colour; ?>;
				color: <?php echo $cart_badge_text_colour; ?>;
			}

		</style>

		<script>
			
			jQuery(function($){

				$('.woohoo_cart_icon').tooltipster();

			});

		</script>

		<?php 

	}
	add_action( 'woohoo-cart-icon','woohoo_add_cart_icon', 10, 2 );


	/**
	 * woohoo_add_cart_icon
	 *
	 * Enqueue CSS and javascript for Font Awesome, Tooltipster, and cart styles
	 *
	 * @since    1.0.0
	 */

	function woohoo_cart_icon_scripts() {
		
		# Font Awesome
		wp_enqueue_style( 'woohoo_font_awesome', woohoo_root( '/public/font-awesome/css/fontawesome-all.min.css', true ) );

		# Tooltipster
		wp_enqueue_script( 'woohoo_tooltipster', woohoo_root( '/public/tooltipster/js/tooltipster.bundle.min.js', true ), array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'woohoo_tooltipster_css', woohoo_root( '/public/tooltipster/css/tooltipster.bundle.min.css', true ) );
		
		# Cart css
		wp_enqueue_style( 'woohoo_cart_icon_css', woohoo_root( '/public/css/woohoo_cart_icon.css', true ) );

	}
	add_action( 'wp_enqueue_scripts', 'woohoo_cart_icon_scripts' );

endif;