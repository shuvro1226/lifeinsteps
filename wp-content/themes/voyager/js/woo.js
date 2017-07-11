jQuery(document).ready(function($) {
	"use strict";
	
	//	Fixed Right Mini Cart
	if (jQuery('#cs-mini-cart').size() > 0) {
		jQuery('.cstheme_cart_icon').on('click', function () {
			var mini_cart = jQuery('#cs-mini-cart');
			if ($(window).width() > 767){
				jQuery('#cs-mini-cart').animate({right: '0px'});
				jQuery('body').addClass('mini_cart_active');
			} else {
				jQuery('#cs-mini-cart').animate({right: '0px'});
				jQuery('body').addClass('mini_cart_active');
			}
		});
		
		jQuery('.mini_cart_back, .mini_cart_btn_close').on('click', function () {
			var mini_cart = jQuery('#cs-mini-cart');
			if (mini_cart.css('right') === '0px') {
				jQuery('#cs-mini-cart').animate({right: '-400px'}).removeClass('mini_cart_open');
				jQuery('body').removeClass('mini_cart_active');
			}
		});
	}
	
	var product_meta = jQuery('.summary .product_meta').detach();
	jQuery(product_meta).insertAfter('.woocommerce div.product .product_title, .woocommerce-page div.product .product_title');
	
	var product_reting = jQuery('.woocommerce div.product .woocommerce-product-rating').detach();
	jQuery(product_reting).insertAfter('.woocommerce div.product .product_title, .woocommerce-page div.product .product_title');
	
	//	Widget Categories
	jQuery('.woocommerce div.product .woocommerce-tabs ul.tabs li.reviews_tab a').each(function(){
		var str = jQuery(this).html();
		str = str.replace('(', '<span class="val theme_color">');
		str = str.replace(')', '</span>');

		jQuery(this).html(str);
	});
	
	//	WooCommerce Quantity btn
	if (jQuery('.woocommerce .quantity input.qty, .woocommerce-page .quantity input.qty').size() > 0) {
		jQuery(this).find('.input-text.qty').attr('type', 'text');
		var $testProp = $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).find( 'qty' );
		if ( $testProp && $testProp.prop( 'type' ) != 'date' ) {
			// Quantity buttons
			$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="" class="plus" />' ).prepend( '<input type="button" value="" class="minus" />' );

			// Target quantity inputs on product pages
			$( 'input.qty:not(.product-quantity input.qty)' ).each(	function() {

					var min = parseFloat( $( this ).attr( 'min' ) );

					if ( min && min > 0 && parseFloat( $( this ).val() ) < min ) {
						$( this ).val( min );
					}
				}
			);

			$( document ).on('click', '.plus, .minus', function() {

				// Get values
				var $qty = $( this ).closest( '.quantity' ).find( '.qty' ),
					currentVal = parseFloat( $qty.val() ),
					max = parseFloat( $qty.attr( 'max' ) ),
					min = parseFloat( $qty.attr( 'min' ) ),
					step = $qty.attr( 'step' );

				// Format values
				if ( !currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
				if ( max === '' || max === 'NaN' ) max = '';
				if ( min === '' || min === 'NaN' ) min = 0;
				if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

				// Change the value
				if ( $( this ).is( '.plus' ) ) {

					if ( max && ( max == currentVal || currentVal > max ) ) {
						$qty.val( max );
					} else {
						$qty.val( currentVal + parseFloat( step ) );
					}

				} else {

					if ( min && ( min == currentVal || currentVal < min ) ) {
						$qty.val( min );
					} else if ( currentVal > 0 ) {
						$qty.val( currentVal - parseFloat( step ) );
					}

				}

				// Trigger change event
				$qty.trigger( 'change' );
			});
		}
	}
	
});