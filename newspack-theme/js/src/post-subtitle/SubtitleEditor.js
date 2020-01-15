/**
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { withDispatch } from '@wordpress/data';
import { useState, useEffect } from '@wordpress/element';
import { TextareaControl } from '@wordpress/components';

/**
 * Internal dependencies
 */
import { connectWithSelect, META_FIELD_NAME } from './utils';

const decorate = compose(
	connectWithSelect,
	withDispatch( dispatch => ( {
		saveSubtitle: subtitle => {
			dispatch( 'core/editor' ).editPost( {
				meta: {
					[ META_FIELD_NAME ]: subtitle,
				},
			} );
		},
	} ) )
);

const SubtitleEditor = ( { subtitle, saveSubtitle } ) => {
	const [ value, setValue ] = useState( subtitle );

	useEffect( () => {
		saveSubtitle( value );
	}, [ value ] );

	return (
		<TextareaControl
			value={ value }
			onChange={ setValue }
			style={ { marginTop: '10px', width: '100%' } }
		/>
	);
};

export default decorate( SubtitleEditor );
