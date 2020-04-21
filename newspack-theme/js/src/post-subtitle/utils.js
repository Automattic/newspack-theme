/**
 * WordPress dependencies
 */
import { withSelect } from '@wordpress/data';

const SUBTITLE_ID = 'newspack-post-subtitle-element';
export const META_FIELD_NAME = 'newspack_post_subtitle';

/**
 * Appends subtitle to DOM, below the Title in the Editor.
 *
 * @param  {string} subtitle Subtitle text
 */
export const appendSubtitleToTitleDOMElement = ( subtitle, isInCodeEditor ) => {
	const titleEl = document.querySelector( '.editor-post-title__block' );
	if ( titleEl && typeof subtitle === 'string' ) {
		let subtitleEl = document.getElementById( SUBTITLE_ID );
		if ( ! subtitleEl ) {
			subtitleEl = document.createElement( 'div' );
			subtitleEl.id = SUBTITLE_ID;
			// special style for the code (raw text) editor
			if ( isInCodeEditor ) {
				subtitleEl.style.paddingLeft = '14px';
				subtitleEl.style.marginBottom = '4px';
			}
			titleEl.appendChild( subtitleEl );
		}
		subtitleEl.innerText = subtitle;
	}
};

export const connectWithSelect = withSelect( select => ( {
	subtitle: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ META_FIELD_NAME ],
	mode: select( 'core/edit-post' ).getEditorMode(),
} ) );
