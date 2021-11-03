/**
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { withDispatch } from '@wordpress/data';
import { useState, useEffect } from '@wordpress/element';
import { TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import { connectWithSelect, META_FIELD_TITLE } from './utils';

const decorateTitle = compose(
	connectWithSelect,
	withDispatch( dispatch => ( {
		saveSummaryTitle: summaryTitle => {
			dispatch( 'core/editor' ).editPost( {
				meta: {
					[ META_FIELD_TITLE ]: summaryTitle,
				},
			} );
		},
	} ) )
);

const SummaryTitleEditor = ( { summaryTitle, saveSummaryTitle } ) => {
	const [ value, setValue ] = useState( summaryTitle );

	useEffect( () => {
		saveSummaryTitle( value );
	}, [ value ] );

	return (
		<TextControl
			label={ __( 'Title:', 'newspack' ) }
			value={ value }
			onChange={ setValue }
			style={ { width: '100%' } }
		/>
	);
};

export default decorateTitle( SummaryTitleEditor );
