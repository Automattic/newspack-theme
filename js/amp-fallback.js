/**
 * File amp-fallback.js.
 *
 * AMP fallback JavaScript.
 */

(function() {
	// Toggle the search in the header.
	var menuToggle = document.getElementById( 'search-toggle' ),
		headerSearch = document.getElementById( 'header-search' );

	menuToggle.onclick = function() {
		headerSearch.classList.toggle('hide');
	};

} )( );
