/**
 * File amp-fallback.js.
 *
 * AMP fallback JavaScript.
 */

(function() {

	// Search toggle.
	var headerContain           = document.getElementById( 'masthead' ),
		headerSearch            = document.getElementById( 'header-search' ),
		headerSearchInput       = headerSearch.getElementsByTagName( 'input' )[0],
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
			headerSearchInput.focus();

		} else {
			searchToggleTextContain.innerText = searchToggleTextDefault;
			headerSearch.setAttribute( 'aria-expanded', 'false' );
			searchToggle.setAttribute( 'aria-expanded', 'false' );
			searchToggle.focus();
		}

	}, false );


	// Mobile menu fallback.

	var menuToggle = document.getElementsByClassName( 'mobile-menu-toggle' ),
		body = document.getElementsByTagName( 'body' )[0];

	for ( var i = 0; i < menuToggle.length; i++ ) {
		menuToggle[i].addEventListener( 'click', function() {
			body.classList.toggle( 'menu-opened' );
		}, false );
	}
} )();

// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
( function( $ ) {

	var primaryNavigation = $( '.main-navigation > ul' );

	if ( ! primaryNavigation.length || ! primaryNavigation.children().length ) {
		return;
	}

	// Toggle `focus` class to allow submenu access on tablets.
	function toggleFocusClassTouchScreen() {
		if ( 'none' === $( '.site-header .mobile-menu-toggle' ).css( 'display' ) ) {

			$( document.body ).on( 'touchstart.newspack', function( e ) {
				if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
					$( '.main-navigation li' ).removeClass( 'is-focused' );
				}
			});

			primaryNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
				.on( 'touchstart.newspack', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'is-focused' ) ) {
						e.preventDefault();
						el.toggleClass( 'is-focused' );
						el.siblings( '.is-focused' ).removeClass( 'is-focused' );
					}
				});

		} else {
			primaryNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.newspack' );
		}
	}

	if ( 'ontouchstart' in window ) {
		$( window ).on( 'resize.newspack', toggleFocusClassTouchScreen );
		toggleFocusClassTouchScreen();
	}

	primaryNavigation.find( 'a' ).on( 'focus.newspack blur.newspack', function() {
		$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
	} );
} )( jQuery );



