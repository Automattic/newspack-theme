/**
 * File customize-controls.js.
 *
 * Brings logo resizing technology to the Customizer.
 *
 * Contains handlers to change Customizer controls.
 */
( function( $ ) {
	'use strict';

	const api = wp.customize;

	api.bind( 'ready', function() {
		$( window ).load( function() {
			if ( false === api.control( 'custom_logo' ).setting() ) {
				$( '#customize-control-logo_size' ).hide();

				if ( false === api.control( 'newspack_footer_logo' ).setting() ) {
					$( '#customize-control-footer_logo_size' ).hide();
				}
			}
		} );
	} );

	// Check logo changes
	api( 'custom_logo', function( value ) {
		value.bind( function( to ) {
			if ( '' === to ) {
				api.control( 'logo_size' ).deactivate();
			} else {
				$( '#customize-control-logo_size' ).show();
				api.control( 'logo_size' ).activate();
				api.control( 'logo_size' ).setting( 50 );
				api.control( 'logo_size' ).setting.preview();
			}
		} );
	} );

	// Check logo changes
	api( 'newspack_footer_logo', function( value ) {
		value.bind( function( to ) {
			if ( '' === to ) {
				api.control( 'footer_logo_size' ).deactivate();
			} else {
				$( '#customize-control-footer_logo_size' ).show();
				api.control( 'footer_logo_size' ).activate();
				api.control( 'footer_logo_size' ).setting( 50 );
				api.control( 'footer_logo_size' ).setting.preview();
			}
		} );
	} );
} )( jQuery );
