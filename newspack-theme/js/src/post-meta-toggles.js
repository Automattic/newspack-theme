'use strict';

import { FormToggle } from '@wordpress/components';
import { withDispatch, withSelect } from '@wordpress/data';

import { registerPlugin } from '@wordpress/plugins';
import { PluginPostStatusInfo } from '@wordpress/edit-post';
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';

/**
 * Hide updated date
 */
const PostStatusExtensions = ( { meta, postType, updateMetaValue } ) => {
	if ( ! meta ) {
		return null;
	}
	const { newspack_hide_page_title, newspack_hide_updated_date } = meta;
	const { hide_date = [], hide_title = [] } = window.newspack_post_meta_post_types;
	const hideDate = 0 <= hide_date.indexOf( postType );
	const hideTitle = 0 <= hide_title.indexOf( postType );

	if ( ! hideDate && ! hideTitle ) {
		return null;
	}
	return (
		<PluginPostStatusInfo>
			{ hideDate && 'post' === postType && (
				<>
					<label htmlFor="hide_updated_date">{ __( 'Hide updated date', 'newspack' ) }</label>
					<FormToggle
						checked={ newspack_hide_updated_date }
						onChange={ () =>
							updateMetaValue( 'newspack_hide_updated_date', ! newspack_hide_updated_date )
						}
						id="hide_updated_date"
					/>
				</>
			) }
			{ hideTitle && 'page' === postType && (
				<>
					<label htmlFor="hide_page_title">{ __( 'Hide page title', 'newspack' ) }</label>
					<FormToggle
						checked={ newspack_hide_page_title }
						onChange={ () =>
							updateMetaValue( 'newspack_hide_page_title', ! newspack_hide_page_title )
						}
						id="hide_page_title"
					/>
				</>
			) }
		</PluginPostStatusInfo>
	);
};

/**
 * Map state to props
 */
const mapStateToProps = select => {
	const { getCurrentPostType, getEditedPostAttribute } = select( 'core/editor' );
	return {
		meta: getEditedPostAttribute( 'meta' ),
		postType: getCurrentPostType(),
	};
};

const mapDispatchToProps = dispatch => {
	const { editPost } = dispatch( 'core/editor' );
	return {
		updateMetaValue: ( key, value ) => editPost( { meta: { [ key ]: value } } ),
	};
};

/**
 * Register plugins
 */
const postStatusSidebar = compose( [
	withSelect( mapStateToProps ),
	withDispatch( mapDispatchToProps ),
] )( PostStatusExtensions );

registerPlugin( 'post-status-sidebar', { render: postStatusSidebar } );
