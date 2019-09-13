"use strict"

const el = wp.element.createElement;
const withState = wp.compose.withState;
const withSelect = wp.data.withSelect;
const withDispatch = wp.data.withDispatch;
const RadioControl = wp.compose.RadioControl;

wp.hooks.addFilter(
	'editor.PostFeaturedImage',
	'enchance-featured-image/featured-image-position-control',
	wrapPostFeaturedImage
);

function wrapPostFeaturedImage( OriginalComponent ) {
    return function( props ) {
        return (
            el(
                wp.element.Fragment,
                {},
                el(
                    OriginalComponent,
                    props
                ),
                el(
                    composedRadio
                )
            )
        );
    }
}

class RadioCustom extends React.Component {
    render() {
        const {
            meta,
            updateFeaturedImagePosition,
            value,
        } = this.props;

        return (
            el(
                wp.components.RadioControl,
                {
                    label: "Featured Image Position",
                    selected: meta.newspack_featured_image_position,
                    options: [
			            {
			            	label: 'Default',
			            	value: ''
			           	},
			            {
			            	label: 'Behind article title',
			            	value: 'behind'
			            },
			        ],
                    onChange: ( value ) => {
                        this.setState( { value } );
                        updateFeaturedImagePosition( value, meta );
                    }
                }
            )
        )
    }
}

const composedRadio = wp.compose.compose( [
    withState( { value: '' } ),
    withSelect( ( select ) => {
        const currentMeta = select( 'core/editor' ).getCurrentPostAttribute( 'meta' );
        const editedMeta = select( 'core/editor' ).getEditedPostAttribute( 'meta' );
        return {
            meta: { ...currentMeta, ...editedMeta },
        };
    } ),
    withDispatch( ( dispatch ) => ( {
        updateFeaturedImagePosition( value, meta ) {
            meta = {
                ...meta,
                newspack_featured_image_position: value,
            };
            dispatch( 'core/editor' ).editPost( { meta } );
        },
    } ) ),
] )( RadioCustom );
