'use strict';

import { ToggleControl } from '@wordpress/components';
import { withDispatch, withSelect } from '@wordpress/data';

import { registerPlugin } from '@wordpress/plugins';
import { PluginPostStatusInfo } from '@wordpress/edit-post';
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';

const updatedDateToggle = ( { meta, updateMetaValue } ) => {
	const { newspack_show_updated_date } = meta;

	return (
		<PluginPostStatusInfo>
			<ToggleControl
				label={ __( 'Show updated date', 'newspack' ) }
				checked={ newspack_show_updated_date }
				onChange={ value => updateMetaValue( 'newspack_show_updated_date', value ) }
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

const showUpdatedDate = compose( [
	withSelect( mapStateToProps ),
	withDispatch( mapDispatchToProps ),
] )( updatedDateToggle );

registerPlugin( 'show-updated-date', { render: showUpdatedDate } );
