/**
 * Sticky header & sticky ad handling.
 *
 * If the site uses sticky header and a sticky ad, the ad should
 * be offset by the header height in order to stack the sticky
 * elements on top of each other.
 */
const stickyAd = document.querySelector( '.h-stk .stick-to-top:last-child' );
const siteHeader = document.querySelector( '.h-stk .site-header' );
if ( stickyAd && siteHeader ) {
	stickyAd.style.top = `calc(${ siteHeader.offsetHeight }px + 1rem)`;
}
