/**
 * WordPress dependencies
 */
import { withSelect } from '@wordpress/data';

export const META_FIELD_NAME = 'newspack_article_summary';

export const connectWithSelect = withSelect( select => ( {
	summary: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ META_FIELD_NAME ],
	mode: select( 'core/edit-post' ).getEditorMode(),
} ) );
