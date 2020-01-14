/**
 * File customize-preview.js.
 *
 * Brings logo resizing technology to the Customizer.
 *
 * Contains handlers to make Customizer preview changes asynchronously.
 */
( function( $ ) {
	const api = wp.customize;
	const Logo = new NewspackLogo();
	let resizeTimer;

	api( 'custom_logo', function( value ) {
		handleLogoDetection( value() );
		value.bind( handleLogoDetection );
	} );

	api( 'logo_size', function( value ) {
		Logo.resize( value() );
		value.bind( Logo.resize );
	} );

	/**
	 *
	 */
	function handleLogoDetection( to, initial ) {
		if ( '' === to ) {
			Logo.remove();
		} else if ( undefined === initial ) {
			Logo.add();
		} else {
			Logo.change();
		}
		initial = to;
	}

	/**
	 *
	 */
	function NewspackLogo() {
		let hasLogo = null;
		const min = 48;

		const self = {
			resize( to ) {
				if ( hasLogo ) {
					const img = new Image();
					const logo = $( '.custom-logo' );

					let size = {
						width: parseInt( logo.attr( 'width' ), 10 ),
						height: parseInt( logo.attr( 'height' ), 10 ),
					};

					const cssMax = {
						width: parseInt( logo.css( 'max-width' ), 10 ),
						height: parseInt( logo.css( 'max-height' ), 10 ),
					};

					const max = new Object();
					max.width = $.isNumeric( cssMax.width ) ? cssMax.width : 600;
					max.height = $.isNumeric( cssMax.height ) ? cssMax.height : size.height;

					img.onload = function() {
						let output = new Object();

						if ( size.width >= size.height ) {
							// landscape or square, calculate height as short side
							output = logo_min_max( size.height, size.width, max.height, max.width, to, min );
							size = {
								height: output.a,
								width: output.b,
							};
						} else if ( size.width < size.height ) {
							// portrait, calculate height as long side
							output = logo_min_max( size.width, size.height, max.width, max.height, to, min );
							size = {
								height: output.b,
								width: output.a,
							};
						}

						logo.css( {
							width: size.width,
							height: size.height,
						} );
					};

					img.src = logo.attr( 'src' );

					clearTimeout( resizeTimer );
					resizeTimer = setTimeout( function() {
						$( document.body ).resize();
					}, 500 );
				}
			},

			add() {
				const intId = setInterval( function() {
					const logo = $( '.custom-logo[src]' );
					if ( logo.length ) {
						clearInterval( intId );
						hasLogo = true;
					}
				}, 500 );
			},

			change() {
				const oldlogo = $( '.custom-logo' ).attr( 'src' );
				const intId = setInterval( function() {
					const logo = $( '.custom-logo' ).attr( 'src' );
					if ( logo !== oldlogo ) {
						clearInterval( intId );
						hasLogo = true;
						self.resize( 50 );
					}
				}, 100 );
			},

			remove() {
				hasLogo = null;
			},
		};

		return self;
	}

	/**
	 * Get logo size
	 *
	 * @param {number} a short side,
	 * @param {number} b long side
	 * @param {number} amax short css max
	 * @param {number} bmax long css max
	 * @param {number} p percent
	 * @param {number} m minimum short side
	 */
	function logo_min_max( a, b, amax, bmax, p, m ) {
		const max = new Object();
		const size = new Object();

		const ratio = b / a;
		max.b = bmax >= b ? b : bmax;
		max.a = amax >= max.b / ratio ? Math.floor( max.b / ratio ) : amax;

		const pixelsPerPercentagePoint = ( max.a - m ) / 100;

		// at 0%, the minimum is set, scale up from there
		size.a = Math.floor( m + p * pixelsPerPercentagePoint );
		// long side is calculated from the image ratio
		size.b = Math.floor( size.a * ratio );

		return size;
	}
} )( jQuery );
