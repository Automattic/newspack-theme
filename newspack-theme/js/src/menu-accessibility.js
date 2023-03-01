/* globals newspackScreenReaderText */

/**
 * File amp-fallback.js.
 *
 * AMP fallback JavaScript.
 */

( function () {
	function updateMenu() {
		// Get dropdown menu toggles in the header.
		const headerContain = document.getElementById( 'masthead' );
		if ( headerContain ) {
			const dropdownToggle = headerContain.getElementsByClassName( 'submenu-expand' );

			// Loop through each dropdown menu toggle.
			if ( 0 < dropdownToggle.length ) {
				for ( let i = 0; i < dropdownToggle.length; i++ ) {
					const parentMenuID = dropdownToggle[ i ].getAttribute( 'data-toggle-parent-id' ),
						subMenu = dropdownToggle[ i ].nextElementSibling,
						subMenuId = parentMenuID.replace( 'toggle-', 'submenu-' );

					// Give each submenu an ID based on their parent item ID.
					subMenu.setAttribute( 'id', subMenuId );
					// Give each dropdown toggle an aria-controls attribute that matches the submenu ID.
					dropdownToggle[ i ].setAttribute( 'aria-controls', subMenuId );
				}
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
		if ( primaryMenu ) {
			observer.observe( primaryMenu, config );
		}
		if ( secondaryMenu ) {
			observer.observe( secondaryMenu, config );
		}
	} else {
		updateMenu();
	}
} )();
