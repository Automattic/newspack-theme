/**
 * WordPress dependencies
 */
import { withSelect } from '@wordpress/data';

const HAT_ID = 'newspack-post-hat-element';
export const META_FIELD_NAME = 'newspack_post_hat';

/**
 * Appends hat to DOM, above the Title in the Editor.
 *
 * @param  {string} hat Hat text
 */
export const appendHatToTitleDOMElement = ( hat, isInCodeEditor ) => {
	const titleEl = document.querySelector( '.editor-post-title__block' );
	if ( titleEl && typeof hat === 'string' ) {
		let hatEl = document.getElementById( HAT_ID );
		if ( ! hatEl ) {
			hatEl = document.createElement( 'div' );
			hatEl.id = HAT_ID;
			// special style for the code (raw text) editor
			if ( isInCodeEditor ) {
				hatEl.style.paddingLeft = '14px';
				hatEl.style.marginBottom = '4px';
			}
			titleEl.prepend( hatEl );
		}
		hatEl.innerText = hat;
	}
};

export const connectWithSelect = withSelect( select => ( {
	hat: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ META_FIELD_NAME ],
	mode: select( 'core/edit-post' ).getEditorMode(),
} ) );
