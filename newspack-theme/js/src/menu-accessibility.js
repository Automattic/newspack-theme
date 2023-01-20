/* globals newspackScreenReaderText */

/**
 * File amp-fallback.js.
 *
 * AMP fallback JavaScript.
 */

( function () {
	// Watch when primary menu is loaded by AMP.
	const primaryMenu = document.getElementById( 'site-navigation' ),
		config = { childList: true };

	// Callback function to execute when mutations are observed.
	const callback = mutationList => {
		for ( const mutation of mutationList ) {
			if ( mutation.type === 'childList' ) {
				updateMenu();
			}
		}
	};

	// Create an observer instance linked to the callback function
	const observer = new MutationObserver( callback );

	// Start observing the target node for configured mutations
	observer.observe( primaryMenu, config );

	function updateMenu() {
		// Get menu toggles.
		const headerContain = document.getElementById( 'masthead' ),
			dropdownToggle = headerContain.getElementsByClassName( 'submenu-expand' );

		if ( 0 < dropdownToggle.length ) {
			for ( let i = 0; i < dropdownToggle.length; i++ ) {
				const dropdownToggleLabel = dropdownToggle[ i ].querySelector( 'span.screen-reader-text' ),
					subMenuID = dropdownToggle[ i ].getAttribute( 'aria-controls' ),
					subMenu = dropdownToggle[ i ].nextElementSibling;

				subMenu.setAttribute( 'id', subMenuID );

				dropdownToggle[ i ].addEventListener(
					'click',
					function () {
						if ( dropdownToggle[ i ].classList.contains( 'open-dropdown' ) ) {
							dropdownToggleLabel.innerText = newspackScreenReaderText.close_dropdown_menu;
						} else {
							dropdownToggleLabel.innerText = newspackScreenReaderText.open_dropdown_menu;
						}
					},
					false
				);
			}
		}
		// Later, you can stop observing
		observer.disconnect();
	}
} )();
