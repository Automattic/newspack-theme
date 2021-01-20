'use strict';

import { FormToggle } from '@wordpress/components';
import { withDispatch, withSelect, select } from '@wordpress/data';

import { registerPlugin } from '@wordpress/plugins';
import { PluginPostStatusInfo } from '@wordpress/edit-post';
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';

/**
 * Hide updated date
 */
const updatedDateToggle = ( { meta, updateMetaValue } ) => {
	const { newspack_hide_updated_date } = meta;
	const post_type = select( 'core/editor' ).getCurrentPostType();

	// eslint-disable-next-line no-undef
	if ( post_type === newspack_post_meta_post_types.hide_date ) {
		return (
			<PluginPostStatusInfo>
				<label htmlFor="hide_updated_date">{ __( 'Hide updated date', 'newspack' ) }</label>
				<FormToggle
					checked={ newspack_hide_updated_date }
					onChange={ () =>
						updateMetaValue( 'newspack_hide_updated_date', ! newspack_hide_updated_date )
					}
					id="hide_updated_date"
				/>
			</PluginPostStatusInfo>
		);
	}
	return null;
};

/**
 * Hide page title
 */
const hidePageTitleToggle = ( { meta, updateMetaValue } ) => {
	const { newspack_hide_page_title } = meta;
	const post_type = select( 'core/editor' ).getCurrentPostType();

	// eslint-disable-next-line no-undef
	if ( post_type === newspack_post_meta_post_types.hide_title ) {
		return (
			<PluginPostStatusInfo>
				<label htmlFor="hide_page_title">{ __( 'Hide page title', 'newspack' ) }</label>
				<FormToggle
					checked={ newspack_hide_page_title }
					onChange={ () =>
						updateMetaValue( 'newspack_hide_page_title', ! newspack_hide_page_title )
					}
					id="hide_page_title"
				/>
			</PluginPostStatusInfo>
		);
	}
	return null;
};

/**
 * Map state to props
 */
const mapStateToProps = _select => {
	const { getEditedPostAttribute } = _select( 'core/editor' );
	return {
		meta: getEditedPostAttribute( 'meta' ),
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
const hideUpdatedDate = compose( [
	withSelect( mapStateToProps ),
	withDispatch( mapDispatchToProps ),
] )( updatedDateToggle );

registerPlugin( 'hide-updated-date', { render: hideUpdatedDate } );

const hidePageTitle = compose( [
	withSelect( mapStateToProps ),
	withDispatch( mapDispatchToProps ),
] )( hidePageTitleToggle );

registerPlugin( 'hide-page-title', { render: hidePageTitle } );
