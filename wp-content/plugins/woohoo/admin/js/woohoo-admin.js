jQuery(function($){

	// Check the URL parameters, so we know we're on the WooHoo tab
	var url_params = new URLSearchParams(window.location.search);

	if ( url_params.get('page') === 'wc-settings' && url_params.get('tab') === 'woohoo' ) {

		// Hide all sections apart from the first one
		$( '.form-table:not(:first-of-type), h2, h2 + p:not(.submit)' ).hide();
		$('.screen-reader-text + h2').show();

		// Couple of arrays to store text and links for menu
		sub_menu_items_text = new Array;
		sub_menu_items_href = new Array;

		i = 0;

		// Use h2 titles as the starting point
		$( 'form h2' ).each(function(){

			var id = $( this ).html();

			// Ignore the h2 titles in the Add to cart section
			if ( id != 'Single product page' && id != 'Shop and archive page') {

				// Link text
				sub_menu_items_text[i] = id;

				// Remove spaces and use for Link href
				id = id.split(' ').join('_');

				$( this ).next( '.form-table' ).attr( 'id', id );

				sub_menu_items_href[i] = id;

				i++;

			}

			// Add class to siblings if Add to cart button title
			if ( id === 'Add_to_cart_button') {

				$(this).nextAll().addClass(id);

			}

		});

		// Create markup for menu
		var sub_menu = '<ul class="subsubsub woohoo">';

		for (var i = 0; i <= sub_menu_items_text.length - 1; i++) {
		
			sub_menu += '<li><a href="#' + sub_menu_items_href[i] +'">' + sub_menu_items_text[i] + '</a>|</li>';
		
		}

		// The Pro version link
		sub_menu += '<li class="woohoopro_link"><span><em>' + woohoo.woohoopro_menu_item + '.</span><a target="_blank" rel="noopener noreferrer" href="https://www.corgdesign.com/woohoo-pro/?utm_source=plugin&utm_campaign=woohoo">' + woohoo.woohoopro_find_out_more + ' &gt;</a></em></li>';

		sub_menu += '</ul><br class="clear">';

		// Add to the pag below the tab wrapper
		$('.nav-tab-wrapper').after(sub_menu);

		// Add active class to first tab link
		$( '.subsubsub li:first-of-type a' ).addClass('active_tab');

		// Show content
		$( '.subsubsub li:not(.woohoopro_link) a' ).on( 'click', function(e){

			$( '.subsubsub a' ).removeClass('active_tab');
			$(this).addClass('active_tab');
			
			e.preventDefault();
			
			$( '.form-table, h2, p:not(.submit)' ).hide();
			
			var section = $(this).attr('href');

			$(section).show();
			$(section + ' p').show();
			$(section).prev('h2').show();

			if (section === '#Add_to_cart_button') {

				$('.Add_to_cart_button').show();
				$('#Products ~ *').show();

			}

			// Hide messages if present
			$('#message').hide();

			// Set local storage to display the last active tab after saving settings
			localStorage.setItem('woohoo_active_tab', $(this).attr('href'));

		});

		// Some CSS tidy up on h2 titles in Add to cart button section
		$('h2 ~ h2.Add_to_cart_button').css('font-size', '1.2em');


		// Modify markup to show icons
		$('.woohoo_choose_cart_icon ').each(function(){

			var label_html = $(this).parent('label').html();

			label_html = label_html.split('&lt;').join('<');
			label_html = label_html.split('&gt;').join('>');

			$(this).parent('label').html(label_html)
		});

		// Add to cart icon, toggle choices depending on checkbox

		// Hide the content first
		$('.woohoo_choose_cart_icon, .woohoo_icon_colour, .woohoo_badge_background_colour, .woohoo_badge_text_colour').parents('tr').hide();

		// Show depending on checkbox
		if ( $('.woohoo_add_cart_icon').is(':checked') ){
			$('.woohoo_choose_cart_icon, .woohoo_icon_colour, .woohoo_badge_background_colour, .woohoo_badge_text_colour').parents('tr').show();
		}

		$('.woohoo_add_cart_icon').on('change', function(){
			$('.woohoo_choose_cart_icon, .woohoo_icon_colour, .woohoo_badge_background_colour, .woohoo_badge_text_colour').parents('tr').toggle();
		});

		// Description, Additional information, and Reviews tab headings

		// Function to show/hide text field depending on check box:
		function show_fields(element){

			$(element + '_text').parents('tr').hide();

			if ( $(element).is(':checked') ){
				$(element + '_text').parents('tr').show();
			}

			$(element).on('change', function(){
				$(element + '_text').parents('tr').fadeToggle();
			});

		}

		// Description tab
		show_fields('.woohoo_description_tab_heading');

		// Additional information tab
		show_fields('.woohoo_additional_information_tab_heading');
		
		// Reviews tab
		show_fields('.woohoo_reviews_tab_heading');


		// Add tinyMCE to textarea
		tinymce.init({
		    selector: '#woohoo_order_complete_page',
		    plugins: 'lists link image charmap fullscreen media paste',
		    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		    menubar: false,
		    height: 300,
		    branding: false,
		    convert_urls: false
		});


		// Open the last active tab
		var active_tab = localStorage.getItem('woohoo_active_tab');

		if ( typeof active_tab != 'undefined' ) {

			$('a[href="' + active_tab + '"]').click().addClass('active_tab');

			$('#message, #message p').show();

		}

		// Footer
		$('#wpfooter:has(.woohoo_footer)').css('position', 'static');

	}

});