'use strict';

import { addFilter } from '@wordpress/hooks';
import { RadioControl } from '@wordpress/components';
import { withDispatch, withSelect, select } from '@wordpress/data';
import { Component, createElement, Fragment } from '@wordpress/element';
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';

class RadioCustom extends Component {
	render() {
		const { meta, updateFeaturedImagePosition, value } = this.props;

		return (
			<RadioControl
				label={ __( 'Featured Image Position' ) }
				selected={ meta.newspack_featured_image_position }
				options={ [
					{ label: __( 'Default' ), value: '' },
					{ label: __( 'Behind article title' ), value: 'behind' },
				] }
				onChange={ value => {
					this.setState( { value } );
					updateFeaturedImagePosition( value, meta );
				} }
			/>
		);
	}
}

const ComposedRadio = compose( [
	withSelect( select => {
		const { getCurrentPostAttribute, getEditedPostAttribute } = select( 'core/editor' );
		return {
			meta: { ...getCurrentPostAttribute( 'meta' ), ...getEditedPostAttribute( 'meta' ) },
		};
	} ),
	withDispatch( dispatch => ( {
		updateFeaturedImagePosition( value, meta ) {
			meta = {
				...meta,
				newspack_featured_image_position: value,
			};
			dispatch( 'core/editor' ).editPost( { meta } );
		},
	} ) ),
] )( RadioCustom );

const wrapPostFeaturedImage = OriginalComponent => {
	return props => {
		const post_type = select( 'core/editor' ).getCurrentPostType();

        if (post_type !== "post") {
            return <OriginalComponent {...props} />;
        }

        return (
			<Fragment>
				<OriginalComponent { ...props } />
				<ComposedRadio />
			</Fragment>
		);
	};
};

addFilter(
	'editor.PostFeaturedImage',
	'enhance-featured-image/featured-image-position-control',
	wrapPostFeaturedImage
);
