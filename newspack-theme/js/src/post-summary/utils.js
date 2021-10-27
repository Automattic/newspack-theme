/**
 * WordPress dependencies
 */
import { withSelect } from '@wordpress/data';

export const META_FIELD_SUMMARY = 'newspack_article_summary';
export const META_FIELD_TITLE = 'newspack_article_summary_title';

export const connectWithSelect = withSelect( select => ( {
	summary: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ META_FIELD_SUMMARY ],
	summaryTitle: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ META_FIELD_TITLE ],
	mode: select( 'core/edit-post' ).getEditorMode(),
} ) );
