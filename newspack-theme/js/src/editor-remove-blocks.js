'use strict';

import { unregisterBlockType } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

// eslint-disable-next-line no-undef
const removeBlocks = updateAllowedBlocks.removeblocks.split( ',' );

domReady( function () {
	removeBlocks.forEach( function ( blockName ) {
		unregisterBlockType( blockName );
	} );
} );
