'use strict';

import { FormToggle } from '@wordpress/components';
import { withDispatch, withSelect } from '@wordpress/data';

import { registerPlugin } from '@wordpress/plugins';
import { PluginPostStatusInfo } from '@wordpress/edit-post';
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';

const updatedDateToggle = ( { meta, updateMetaValue } ) => {
	const { newspack_hide_updated_date } = meta;

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

const hideUpdatedDate = compose( [
	withSelect( mapStateToProps ),
	withDispatch( mapDispatchToProps ),
] )( updatedDateToggle );

registerPlugin( 'hide-updated-date', { render: hideUpdatedDate } );
