'use strict';

import { unregisterBlockType } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

const removeBlocks = [
	'core/loginout',
	// Comments
	'core/post-comments-form',
	'core/comments-query-loop',
	// Post Query
	'core/query', // query loop and posts list
	'core/post-title',
	'core/post-featured-image',
	'core/post-excerpt',
	'core/post-content',
	'core/post-terms', // post categories and tags
	'core/post-date',
	'core/post-author',
	'core/post-navigation-link', // previous and next links
	'core/read-more',
	'core/avatar',
	'core/post-author-biography',
	// Archives
	'core/query-title', // archive title
	'core/term-description',
];

domReady( function () {
	removeBlocks.forEach( function ( blockName ) {
		unregisterBlockType( blockName );
	} );
} );
