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
import SubtitleEditor from './SubtitleEditor';
import { appendSubtitleToTitleDOMElement, connectWithSelect } from './utils';

/**
 * Component to be used as a panel in the Document tab of the Editor.
 *
 * https://developer.wordpress.org/block-editor/developers/slotfills/plugin-document-setting-panel/
 */
const NewspackSubtitlePanel = ( { subtitle } ) => {
	// Update the DOM when subtitle value changes.
	useEffect( () => {
		appendSubtitleToTitleDOMElement( subtitle );
	}, [ subtitle ] );

	return (
		<PluginDocumentSettingPanel
			name="newspack-subtitle"
			title={ __( 'Article Subtitle', 'newspack' ) }
			className="newspack-subtitle"
		>
			{ __( 'Set a Subtitle for the Article', 'newspack' ) }
			<SubtitleEditor />
		</PluginDocumentSettingPanel>
	);
};

registerPlugin( 'plugin-document-setting-panel-newspack-subtitle', {
	render: connectWithSelect( NewspackSubtitlePanel ),
	icon: null,
} );
