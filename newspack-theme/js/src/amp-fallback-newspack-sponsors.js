/**
 * File amp-fallback.js.
 *
 * AMP fallback JavaScript.
 */

( function() {
	// Support info toggle.
	const supportToggle = document.getElementById( 'sponsor-info-toggle' );

	if ( null !== supportToggle ) {
		const supportLabel = supportToggle.parentNode,
			supportInfo = document.getElementById( 'sponsor-info' ),
			supportToggleTextContain = supportToggle.getElementsByTagName( 'span' )[ 0 ],
			supportToggleTextDefault = supportToggleTextContain.innerText;

		supportToggle.addEventListener(
			'click',
			function() {
				supportLabel.classList.toggle( 'show-info' );
				// Toggle screen reader text label and aria settings.
				if ( supportToggleTextDefault === supportToggleTextContain.innerText ) {
					supportToggleTextContain.innerText = newspackScreenReaderText.close_info;

					supportInfo.setAttribute( 'aria-expanded', 'true' );
					supportToggle.setAttribute( 'aria-expanded', 'true' );
				} else {
					supportToggleTextContain.innerText = supportToggleTextDefault;
					supportInfo.setAttribute( 'aria-expanded', 'false' );
					supportToggle.setAttribute( 'aria-expanded', 'false' );
				}
			},
			false
		);
	}
} )();
