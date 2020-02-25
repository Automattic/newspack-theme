/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function() {
	wp.customize.bind( 'ready', function() {
		// Only show the color hue control when there's a custom primary color.
		wp.customize( 'theme_colors', function( setting ) {
			wp.customize.control( 'primary_color_hex', function( control ) {
				const visibility = function() {
					if ( 'custom' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			} );
			wp.customize.control( 'secondary_color_hex', function( control ) {
				const visibility = function() {
					if ( 'custom' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			} );
			wp.customize.control( 'header_color', function( control ) {
				const visibility = function() {
					if ( 'custom' === setting.get() ) {
						// Make sure the site is set to use a solid header background.
						if ( true === wp.customize.value( 'header_solid_background' )() ) {
							control.container.slideDown( 180 );
						}
					} else {
						control.container.slideUp( 180 );
					}
				};
				visibility();
				setting.bind( visibility );
			} );
			wp.customize.control( 'header_color_hex', function( control ) {
				const visibility = function() {
					if ( 'custom' === setting.get() ) {
						// Make sure the site is set to use a solid header background.
						if (
							true === wp.customize.value( 'header_solid_background' )() &&
							'custom' === wp.customize.value( 'header_color' )()
						) {
							control.container.slideDown( 180 );
						}
					} else {
						control.container.slideUp( 180 );
					}
				};
				visibility();
				setting.bind( visibility );
			} );
		} );

		// Controls to show/hide when the Solid Background is toggled.
		wp.customize( 'header_solid_background', function( setting ) {
			wp.customize.control( 'header_color', function( control ) {
				const visibility = function() {
					if ( true === setting.get() ) {
						if ( 'custom' === wp.customize.value( 'theme_colors' )() ) {
							control.container.slideDown( 180 );
						}
					} else {
						control.container.slideUp( 180 );
					}
				};
				visibility();
				setting.bind( visibility );
			} );

			wp.customize.control( 'header_color_hex', function( control ) {
				const visibility = function() {
					if ( true === setting.get() ) {
						if (
							'custom' === wp.customize.value( 'header_color' )() &&
							'custom' === wp.customize.value( 'theme_colors' )()
						) {
							control.container.slideDown( 180 );
						}
					} else {
						control.container.slideUp( 180 );
					}
				};
				visibility();
				setting.bind( visibility );
			} );
		} );

		// Controls to show/hide when the Solid Background is toggled.
		wp.customize( 'header_color', function( setting ) {
			wp.customize.control( 'header_color_hex', function( control ) {
				const visibility = function() {
					if ( 'custom' === setting.get() ) {
						if (
							true === wp.customize.value( 'header_solid_background' )() &&
							'custom' === wp.customize.value( 'theme_colors' )()
						) {
							control.container.slideDown( 180 );
						}
					} else {
						control.container.slideUp( 180 );
					}
				};
				visibility();
				setting.bind( visibility );
			} );
		} );

		// Only show the rest of the author controls when the bio is visible.
		wp.customize( 'show_author_bio', function( setting ) {
			wp.customize.control( 'show_author_email', function( control ) {
				const visibility = function() {
					if ( true === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};
				visibility();
				setting.bind( visibility );
			} );
		} );
	} );
} )( jQuery );
