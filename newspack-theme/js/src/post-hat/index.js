'use strict';

/**
 * WordPress dependencies
 */
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import HatEditor from './HatEditor';
import { appendHatToTitleDOMElement, connectWithSelect } from './utils';

/**
 * Component to be used as a panel in the Document tab of the Editor.
 *
 * https://developer.wordpress.org/block-editor/developers/slotfills/plugin-document-setting-panel/
 */
const NewspackHatPanel = ( { hat, mode } ) => {
	// Update the DOM when hat value changes or editor mode is switched
	useEffect( () => {
		appendHatToTitleDOMElement( hat, mode === 'text' );
	}, [ hat, mode ] );

	return (
		<PluginDocumentSettingPanel
			name="newspack-hat"
			title={ __( 'Article Hat', 'newspack' ) }
			className="newspack-hat"
		>
			{ __( 'Set a Hat for the Article', 'newspack' ) }
			<HatEditor />
		</PluginDocumentSettingPanel>
	);
};

registerPlugin( 'plugin-document-setting-panel-newspack-hat', {
	render: connectWithSelect( NewspackHatPanel ),
	icon: null,
} );
