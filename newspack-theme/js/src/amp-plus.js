/**
 * Sticky header & sticky ad handling.
 *
 * If the site uses sticky header and a sticky ad, the ad should
 * be offset by the header height in order to stack the sticky
 * elements on top of each other.
 */
( function () {
	const stickyAd = document.querySelector( '.h-stk .stick-to-top:last-child' );
	const siteHeader = document.querySelector( '.h-stk .site-header' );
	if ( stickyAd && siteHeader ) {
		stickyAd.style.top = `calc(${ siteHeader.offsetHeight }px + 1rem)`;
	}
} )();

// AMP sticky ad polyfills.
( function () {
	const body = document.body;
	const stickyAdClose = document.querySelector( '.newspack_sticky_ad__close' );
	const stickyAd = document.querySelector( '.newspack_global_ad.sticky' );

	if ( stickyAdClose && stickyAd ) {
		window.googletag = window.googletag || { cmd: [] };
		window.googletag.cmd.push( function () {
			const initialBodyPadding = body.style.paddingBottom;

			// Add padding to body to accommodate the sticky ad.
			window.googletag.pubads().addEventListener( 'slotRenderEnded', event => {
				const renderedSlotId = event.slot.getSlotElementId();
				const stickyAdSlot = stickyAd.querySelector( '#' + renderedSlotId );

				if ( stickyAdSlot && body.clientWidth <= 600 ) {
					stickyAd.style.display = 'flex';
					body.style.paddingBottom = stickyAd.clientHeight + 'px';
				}
			} );

			stickyAdClose.addEventListener( 'click', () => {
				stickyAd.parentElement.removeChild( stickyAd );

				// Reset body padding.
				body.style.paddingBottom = initialBodyPadding;
			} );
		} );
	}
} )();
