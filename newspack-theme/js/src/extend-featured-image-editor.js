'use strict';

import { addFilter } from '@wordpress/hooks';
import { RadioControl } from '@wordpress/components';
import { withDispatch, withSelect, select } from '@wordpress/data';
import { Component, Fragment } from '@wordpress/element';
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';

class RadioCustom extends Component {
	render() {
		const { meta, updateFeaturedImagePosition } = this.props;

		return (
			<RadioControl
				label={ __( 'Featured Image Position' ) }
				selected={ meta.newspack_featured_image_position }
				options={ [
					{ label: __( 'Default (set in Customizer)', 'newspack' ), value: '' },
					{ label: __( 'Large', 'newspack' ), value: 'large' },
					{ label: __( 'Small', 'newspack' ), value: 'small' },
					{ label: __( 'Behind article title', 'newspack' ), value: 'behind' },
					{ label: __( 'Beside article title', 'newspack' ), value: 'beside' },
					{ label: __( 'Hidden', 'newspack' ), value: 'hidden' },
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
	withSelect( _select => {
		const { getCurrentPostAttribute, getEditedPostAttribute } = _select( 'core/editor' );
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
	// eslint-disable-next-line react/display-name
	return props => {
		const post_type = select( 'core/editor' ).getCurrentPostType();

		if ( 'post' !== post_type ) {
			return <OriginalComponent { ...props } />;
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
