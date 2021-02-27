/**
 * File amp-fallback.js.
 *
 * AMP fallback JavaScript.
 */

( function() {
	// Search toggle.
	const headerContain = document.getElementById( 'masthead' ),
		searchToggle = document.getElementById( 'search-toggle' );

	if ( null !== searchToggle ) {
		const headerSearch = document.getElementById( 'header-search' ),
			headerSearchInput = headerSearch.getElementsByTagName( 'input' )[ 0 ],
			searchToggleTextContain = searchToggle.getElementsByTagName( 'span' )[ 0 ],
			searchToggleTextDefault = searchToggleTextContain.innerText;

		searchToggle.addEventListener(
			'click',
			function() {
				// Toggle the search visibility.
				headerContain.classList.toggle( 'hide-header-search' );

				// Toggle screen reader text label and aria settings.
				if ( searchToggleTextDefault === searchToggleTextContain.innerText ) {
					searchToggleTextContain.innerText = newspackScreenReaderText.close_search;
					headerSearch.setAttribute( 'aria-expanded', 'true' );
					searchToggle.setAttribute( 'aria-expanded', 'true' );
					headerSearchInput.focus();
				} else {
					searchToggleTextContain.innerText = searchToggleTextDefault;
					headerSearch.setAttribute( 'aria-expanded', 'false' );
					searchToggle.setAttribute( 'aria-expanded', 'false' );
					searchToggle.focus();
				}
			},
			false
		);
	}

	// Menu toggle variables.
	const mobileToggle = document.getElementsByClassName( 'mobile-menu-toggle' ),
		body = document.getElementsByTagName( 'body' )[ 0 ],
		mobileSidebar = document.getElementById( 'mobile-sidebar-fallback' ),
		mobileOpenButton = headerContain.getElementsByClassName( 'mobile-menu-toggle' )[ 0 ],
		mobileCloseButton = mobileSidebar.getElementsByClassName( 'mobile-menu-toggle' )[ 0 ],
		desktopToggle = document.getElementsByClassName( 'desktop-menu-toggle' ),
		desktopSidebar = document.getElementById( 'desktop-sidebar-fallback' ),
		desktopOpenButton = headerContain.getElementsByClassName( 'desktop-menu-toggle' )[ 0 ],
		desktopCloseButton = desktopSidebar.getElementsByClassName( 'desktop-menu-toggle' )[ 0 ],
		subpageToggle = document.getElementsByClassName( 'subpage-toggle' );

	/**
	 * @description Creates semi-transparent overlay behind menus.
	 * @param {string} maskId The ID to add to the div.
	 */
	function createOverlay( maskId ) {
		const mask = document.createElement( 'div' );
		mask.setAttribute( 'class', 'overlay-mask' );
		mask.setAttribute( 'id', maskId );
		document.body.appendChild( mask );
	}

	/**
	 * @description Removes semi-transparent overlay behind menus.
	 * @param {string} maskId The ID to use for the overlay.
	 */
	function removeOverlay( maskId ) {
		const mask = document.getElementById( maskId );
		mask.parentNode.removeChild( mask );
	}

	/**
	 * @description Opens specifed slide-out menu.
	 * @param {string} menuClass  The class to add to the body to toggle menu visibility.
	 * @param {string} openButton The button used to open the menu.
	 * @param {string} maskId     The ID to use for the overlay.
	 */
	function openMenu( menuClass, openButton, maskId ) {
		body.classList.add( menuClass );
		openButton.focus();
		createOverlay( maskId );
	}

	/**
	 * @description Closes specifed slide-out menu.
	 * @param {string} menuClass  The class to remove from the body to toggle menu visibility.
	 * @param {string} openButton The button used to open the menu.
	 * @param {string} maskId The ID to use for the overlay.
	 */
	function closeMenu( menuClass, openButton, maskId ) {
		body.classList.remove( menuClass );
		openButton.focus();
		removeOverlay( maskId );
	}

	// Mobile menu fallback.
	for ( let i = 0; i < mobileToggle.length; i++ ) {
		mobileToggle[ i ].addEventListener(
			'click',
			function() {
				if ( body.classList.contains( 'mobile-menu-opened' ) ) {
					closeMenu( 'mobile-menu-opened', mobileOpenButton, 'mask-mobile' );
				} else {
					openMenu( 'mobile-menu-opened', mobileCloseButton, 'mask-mobile' );
				}
			},
			false
		);
	}

	// Desktop menu (AKA slide-out sidebar) fallback.
	for ( let i = 0; i < desktopToggle.length; i++ ) {
		desktopToggle[ i ].addEventListener(
			'click',
			function() {
				if ( body.classList.contains( 'desktop-menu-opened' ) ) {
					closeMenu( 'desktop-menu-opened', desktopOpenButton, 'mask-desktop' );
				} else {
					openMenu( 'desktop-menu-opened', desktopCloseButton, 'mask-desktop' );
				}
			},
			false
		);
	}

	// 'Subpage' menu fallback.
	if ( 0 < subpageToggle.length ) {
		const subpageSidebar = document.getElementById( 'subpage-sidebar-fallback' ),
			subpageOpenButton = headerContain.getElementsByClassName( 'subpage-toggle' )[ 0 ],
			subpageCloseButton = subpageSidebar.getElementsByClassName( 'subpage-toggle' )[ 0 ];

		for ( let i = 0; i < subpageToggle.length; i++ ) {
			subpageToggle[ i ].addEventListener(
				'click',
				function() {
					if ( body.classList.contains( 'subpage-menu-opened' ) ) {
						closeMenu( 'subpage-menu-opened', subpageOpenButton, 'mask-subpage' );
					} else {
						openMenu( 'subpage-menu-opened', subpageCloseButton, 'mask-subpage' );
					}
				},
				false
			);
		}
	}

	// Add listener to the menu overlays, so they can be closed on click.
	document.addEventListener( 'click', function( e ) {
		if ( e.target && e.target.className === 'overlay-mask' ) {
			const maskId = e.target.id;
			const menu = maskId.split( '-' );

			body.classList.remove( menu[ 1 ] + '-menu-opened' );
			removeOverlay( maskId );
		}
	} );

	// Comments toggle fallback.
	const commentsToggle = document.getElementById( 'comments-toggle' );

	// Make sure comments exist before going any further.
	if ( null !== commentsToggle ) {
		const commentsWrapper = document.getElementById( 'comments-wrapper' ),
			commentsToggleTextContain = commentsToggle.getElementsByTagName( 'span' )[ 0 ];

		commentsToggle.addEventListener(
			'click',
			function() {
				if ( commentsWrapper.classList.contains( 'comments-hide' ) ) {
					commentsWrapper.classList.remove( 'comments-hide' );
					commentsToggleTextContain.innerText = newspackScreenReaderText.collapse_comments;
				} else {
					commentsWrapper.classList.add( 'comments-hide' );
					commentsToggleTextContain.innerText = newspackScreenReaderText.expand_comments;
				}
			},
			false
		);
	}

	// Checkout toggle fallback.
	const orderDetailToggle = document.getElementById( 'toggle-order-details' );

	// Make sure checkout details exist before going any further.
	if ( null !== orderDetailToggle ) {
		const orderDetailWrapper = document.getElementById( 'order-details-wrapper' ),
			orderDetailToggleTextContain = orderDetailToggle.getElementsByTagName( 'span' )[ 0 ],
			hideOrderDetails = newspackScreenReaderText.hide_order_details,
			showOrderDetails = newspackScreenReaderText.show_order_details;

		orderDetailToggle.addEventListener(
			'click',
			function() {
				if ( orderDetailWrapper.classList.contains( 'order-details-hidden' ) ) {
					orderDetailWrapper.classList.remove( 'order-details-hidden' );
					orderDetailToggle.classList.remove( 'order-details-hidden' );
					orderDetailToggleTextContain.innerText = hideOrderDetails;
				} else {
					orderDetailWrapper.classList.add( 'order-details-hidden' );
					orderDetailToggle.classList.add( 'order-details-hidden' );
					orderDetailToggleTextContain.innerText = showOrderDetails;
				}
			},
			false
		);
	}

	// AMP sticky ad polyfills.
	const stickyAdClose = document.querySelector( '.newspack_sticky_ad__close' );
	const stickyAd = document.querySelector( '.newspack_global_ad.sticky' );

	if ( stickyAdClose && stickyAd && window.googletag ) {
		const initialBodyPadding = body.style.paddingBottom;

		// Add padding to body to accommodate the sticky ad.
		window.googletag.pubads().addEventListener( 'slotRenderEnded', event => {
			const renderedSlotId = event.slot.getSlotElementId();
			const stickyAdSlot = stickyAd.querySelector( '#' + renderedSlotId );

			if ( stickyAdSlot ) {
				stickyAd.classList.add( 'active' );
				body.style.paddingBottom = stickyAd.clientHeight + 'px';
			}
		} );

		stickyAdClose.addEventListener( 'click', () => {
			stickyAd.parentElement.removeChild( stickyAd );

			// Reset body padding.
			body.style.paddingBottom = initialBodyPadding;
		} );
	}
} )();
