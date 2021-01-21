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
		saveHat: hat => {
			dispatch( 'core/editor' ).editPost( {
				meta: {
					[ META_FIELD_NAME ]: hat,
				},
			} );
		},
	} ) )
);

const HatEditor = ( { hat, saveHat } ) => {
	const [ value, setValue ] = useState( hat );

	useEffect( () => {
		saveHat( value );
	}, [ value ] );

	return (
		<TextareaControl
			value={ value }
			onChange={ setValue }
			style={ { marginTop: '10px', width: '100%' } }
		/>
	);
};

export default decorate( HatEditor );
