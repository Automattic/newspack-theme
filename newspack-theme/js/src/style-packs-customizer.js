/**
 * File style-packs-customizer.js.
 *
 * Based on functionality in Radcliffe 2:
 * https://github.com/Automattic/themes/blob/master/radcliffe-2/assets/js/style-packs-customizer.js
 *
 * Contains the customizer bindings for style packs.
 */

( function( $ ) {
	// Style packs data.
	const config = stylePacksData;
	const body = document.body;

	loadPreviewStylesheets();

	// Active style pack.
	wp.customize( 'active_style_pack', function( value ) {
		let currentStyle = value();

		value.bind( function( to ) {
			applyStyle( to, currentStyle );

			fireEvent( 'change', {
				from: currentStyle,
				to,
			} );
			body.classList.remove( getBodyClass( currentStyle ) );
			body.classList.add( getBodyClass( to ) );
			currentStyle = to;
		} );
	} );

	/**
	 * Fire style_packs event
	 */
	function fireEvent( evt, payload ) {
		$( document ).trigger( [ 'style_packs', evt ].join( '.' ), payload );
	}

	/**
	 * Create DOM link element
	 */
	function createLink( id, uri ) {
		const link = document.createElement( 'link' );
		link.setAttribute( 'rel', 'stylesheet' );
		link.setAttribute( 'id', id );
		link.setAttribute( 'href', uri );
		return link;
	}

	/**
	 * Get body class
	 */
	function getBodyClass( style ) {
		return stylePacksData.body_class_format.replace( '%s', style );
	}

	/**
	 * Apply styles to document head
	 */
	function applyStyle( style, prevStyle ) {
		if ( prevStyle ) {
			removeStyle( prevStyle );
		}

		const styleData = config.styles[ style ];

		if ( styleData ) {
			const link = createLink( styleData.id, styleData.uri );
			if ( '' !== stylePacksData.default_css_id ) {
				document
					.getElementById( stylePacksData.default_css_id )
					.insertAdjacentElement( 'afterend', link );
			} else {
				document.head.appendChild( link );
			}
		}

		_.each( config.fonts[ style ], function( uri, id ) {
			const link = createLink( id, uri );
			if ( '' !== stylePacksData.default_css_id ) {
				document
					.getElementById( stylePacksData.default_css_id )
					.insertAdjacentElement( 'afterend', link );
			} else {
				document.head.appendChild( link );
			}
		} );
	}

	/**
	 * Remove styles from document head
	 */
	function removeStyle( style ) {
		if ( config.styles[ style ] ) {
			$( 'head #' + config.styles[ style ].id ).remove();
		}
		_.each( config.fonts[ style ], function( uri, id ) {
			$( 'head #' + id ).remove();
		} );
	}

	/**
	 * Load preview stylesheets to document head
	 */
	function loadPreviewStylesheets() {
		const style = config.preview_style,
			data = config.styles[ style ];
		_.each( config.fonts[ style ], function( uri, id ) {
			if ( '' !== stylePacksData.default_css_id ) {
				document
					.getElementById( stylePacksData.default_css_id )
					.insertAdjacentElement( 'afterend', createLink( id, uri ) );
			} else {
				document.head.appendChild( createLink( id, uri ) );
			}
		} );
		if ( data ) {
			if ( '' !== stylePacksData.default_css_id ) {
				document
					.getElementById( stylePacksData.default_css_id )
					.insertAdjacentElement( 'afterend', createLink( data.id, data.uri ) );
			} else {
				document.head.appendChild( createLink( data.id, data.uri ) );
			}
		}
	}
} )( jQuery );
