'use strict';

import { FormToggle } from '@wordpress/components';
import { withDispatch, withSelect } from '@wordpress/data';

import { registerPlugin } from '@wordpress/plugins';
import { PluginPostStatusInfo } from '@wordpress/edit-post';
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';

const hidePageTitleToggle = ( { meta, updateMetaValue } ) => {
	const { newspack_hide_page_title } = meta;

	return (
		<PluginPostStatusInfo>
			<label htmlFor="hide_page_title">{ __( 'Hide page title', 'newspack' ) }</label>
			<FormToggle
				checked={ newspack_hide_page_title }
				onChange={ () => updateMetaValue( 'newspack_hide_page_title', ! newspack_hide_page_title ) }
				id="hide_page_title"
			/>
		</PluginPostStatusInfo>
	);
};

const mapStateToProps = select => {
	const { getEditedPostAttribute } = select( 'core/editor' );

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

const hidePageTitle = compose( [
	withSelect( mapStateToProps ),
	withDispatch( mapDispatchToProps ),
] )( hidePageTitleToggle );

registerPlugin( 'hide-page-title', { render: hidePageTitle } );
