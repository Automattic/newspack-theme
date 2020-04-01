/**
 * File amp-fallback.js.
 *
 * AMP fallback JavaScript.
 */

( function() {
	// Search toggle.
	const headerContain = document.getElementById( 'masthead' ),
		headerSearch = document.getElementById( 'header-search' ),
		headerSearchInput = headerSearch.getElementsByTagName( 'input' )[ 0 ],
		searchToggle = document.getElementById( 'search-toggle' ),
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

	// Mobile menu fallback.
	const menuToggle = document.getElementsByClassName( 'mobile-menu-toggle' ),
		body = document.getElementsByTagName( 'body' )[ 0 ],
		mobileSidebar = document.getElementById( 'mobile-sidebar-fallback' ),
		menuOpenButton = headerContain.getElementsByClassName( 'mobile-menu-toggle' )[ 0 ],
		menuCloseButton = mobileSidebar.getElementsByClassName( 'mobile-menu-toggle' )[ 0 ];

	for ( let i = 0; i < menuToggle.length; i++ ) {
		menuToggle[ i ].addEventListener(
			'click',
			function() {
				if ( body.classList.contains( 'menu-opened' ) ) {
					body.classList.remove( 'menu-opened' );
					menuOpenButton.focus();
				} else {
					body.classList.add( 'menu-opened' );
					menuCloseButton.focus();
				}
			},
			false
		);
	}

	// Desktop menu fallback.
	const desktopToggle = document.getElementsByClassName( 'desktop-menu-toggle' ),
		desktopSidebar = document.getElementById( 'desktop-sidebar-fallback' ),
		desktopOpenButton = headerContain.getElementsByClassName( 'desktop-menu-toggle' )[ 0 ],
		desktopCloseButton = desktopSidebar.getElementsByClassName( 'desktop-menu-toggle' )[ 0 ];

	for ( let i = 0; i < desktopToggle.length; i++ ) {
		desktopToggle[ i ].addEventListener(
			'click',
			function() {
				if ( body.classList.contains( 'desktop-menu-opened' ) ) {
					body.classList.remove( 'desktop-menu-opened' );
					desktopOpenButton.focus();
				} else {
					body.classList.add( 'desktop-menu-opened' );
					desktopCloseButton.focus();
				}
			},
			false
		);
	}

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
} )();
