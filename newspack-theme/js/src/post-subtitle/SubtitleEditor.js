/**
 * WordPress dependencies
 */
import apiFetch from '@wordpress/api-fetch';
const { getCurrentPostId } = wp.data.select( 'core/editor' );
import { compose } from '@wordpress/compose';
import { withDispatch } from '@wordpress/data';
import { useState, useEffect } from '@wordpress/element';
import { TextareaControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { addQueryArgs } from '@wordpress/url';

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
	const [ isLoading, setIsLoading ] = useState( false );

	useEffect( () => {
		saveSubtitle( value );
	}, [ value ] );

	const requestSubtitleSuggestion = () => {
		setIsLoading( true );
		apiFetch( {
			path: addQueryArgs( '/newspack-theme-gpt/v1/get-subtitle', { post_id: getCurrentPostId() } ),
		} )
			.then( suggestion => {
				setValue( suggestion );
				setIsLoading( false );
			} )
			.finally( () => {
				setIsLoading( false );
			} );
	};

	return (
		<>
			<TextareaControl
				value={ value }
				onChange={ setValue }
				style={ { marginTop: '10px', width: '100%' } }
				disabled={ isLoading }
			/>
			<Button variant="secondary" onClick={ requestSubtitleSuggestion } disabled={ isLoading }>
				{ __( 'Get subtitle suggestion', 'newspack-theme' ) }
			</Button>
		</>
	);
};

export default decorate( SubtitleEditor );
