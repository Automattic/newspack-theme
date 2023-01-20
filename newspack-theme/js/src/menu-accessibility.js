/* globals newspackScreenReaderText */

/**
 * File amp-fallback.js.
 *
 * AMP fallback JavaScript.
 */

( function () {
	function updateMenu() {
		// Get menu toggles.
		const headerContain = document.getElementById( 'masthead' ),
			dropdownToggle = headerContain.getElementsByClassName( 'submenu-expand' );

		if ( 0 < dropdownToggle.length ) {
			for ( let i = 0; i < dropdownToggle.length; i++ ) {
				const parentMenuID = dropdownToggle[ i ].getAttribute( 'aria-controls' ),
					subMenu = dropdownToggle[ i ].nextElementSibling;

				subMenu.setAttribute( 'id', parentMenuID );
			}
		}
	}

	// If AMP is on, we need to hold off running this JavaScript until we're sure the menus are in their right spots:
	if ( newspackScreenReaderText.is_amp ) {
		const primaryMenu = document.getElementById( 'site-navigation' ),
			secondaryMenu = document.getElementById( 'secondary-nav-contain' ),
			config = { childList: true };

		// Callback function to execute when mutations are observed.
		const callback = mutationList => {
			for ( const mutation of mutationList ) {
				if ( mutation.type === 'childList' ) {
					updateMenu();

					// Stop observing
					observer.disconnect();
				}
			}
		};

		// Create an observer instance linked to the callback function
		const observer = new MutationObserver( callback );

		// Start observing the target node for configured mutations
		observer.observe( primaryMenu, config );
		observer.observe( secondaryMenu, config );
	} else {
		updateMenu();
	}
} )();
