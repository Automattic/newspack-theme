/**
 * File amp-fallback.js.
 *
 * AMP fallback JavaScript.
 */

(function() {

	var headerContain           = document.getElementById( 'masthead' ),
		headerSearch            = document.getElementById( 'header-search' ),
		searchToggle            = document.getElementById( 'search-toggle' ),
		searchToggleTextContain = searchToggle.getElementsByTagName( 'span' )[0],
		searchToggleTextDefault = searchToggleTextContain.innerText;

	searchToggle.addEventListener('click', function() {

		// Toggle the search visibility.
		headerContain.classList.toggle( 'hide-header-search' );

		// Toggle screen reader text label and aria settings.
		if ( searchToggleTextDefault === searchToggleTextContain.innerText ) {
			searchToggleTextContain.innerText = newspackScreenReaderText.close_search;
			headerSearch.setAttribute( 'aria-expanded', 'true' );
			searchToggle.setAttribute( 'aria-expanded', 'true' );
		} else {
			searchToggleTextContain.innerText = searchToggleTextDefault;
			headerSearch.setAttribute( 'aria-expanded', 'false' );
			searchToggle.setAttribute( 'aria-expanded', 'false' );
		}

	}, false );


} )();
