/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function( $ ) {
	// Primary color.
	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				primary = style.data( 'primary' ),
				css = style.html(),
				color;

			if ( 'custom' === to ) {
				// If a custom primary color is selected, use the currently set primary_color_hex
				color = wp.customize.get().primary_color_hex;
			} else {
				// If the "default" option is selected, get the default primary_color_hex
				color = _NewspackThemePreviewData.default_hex;
			}

			// Replace previous hex value with new hex value.
			css = css.replaceAll( primary, color );
			style.html( css ).data( 'primary', color );
		});
	});

	// Primary color hex.
	wp.customize( 'primary_color_hex', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				primary = style.data( 'primary' ),
				css = style.html();

			// Replace previous primary hex value with new primary hex value.
			css = css.replaceAll( primary, to );
			style.html( css ).data( 'primary', to );
		});
	});

	// Hide Front Page Title
	wp.customize( 'hide_front_page_title', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( 'body' ).addClass( 'hide-homepage-title' );
			} else {
				$( 'body' ).removeClass( 'hide-homepage-title' );
			}
		});
	});
})( jQuery );
