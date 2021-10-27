/**
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { withDispatch } from '@wordpress/data';
import { useState, useEffect } from '@wordpress/element';
import { TextareaControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import { connectWithSelect, META_FIELD_SUMMARY } from './utils';

const decorateSummary = compose(
	connectWithSelect,
	withDispatch( dispatch => ( {
		saveSummary: summary => {
			dispatch( 'core/editor' ).editPost( {
				meta: {
					[ META_FIELD_SUMMARY ]: summary,
				},
			} );
		},
	} ) )
);

const SummaryEditor = ( { summary, saveSummary } ) => {
	const [ value, setValue ] = useState( summary );

	useEffect( () => {
		saveSummary( value );
	}, [ value ] );

	return (
		<TextareaControl
			label={ __( 'Body:', 'newspack' ) }
			value={ value }
			onChange={ setValue }
			style={ { width: '100%' } }
		/>
	);
};

export default decorateSummary( SummaryEditor );
