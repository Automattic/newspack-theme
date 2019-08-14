/**
 * File block-columns-style.js
 *
 * Adds block styles to the Columns block, to allow you to reorder columns.
 */

// Switches the first column to the second spot.

wp.blocks.registerBlockStyle( 'core/columns', {
	name: 'first-col-to-second',
	label: 'Move first column to second'
} );

// Switches the first column to the third spot.

wp.blocks.registerBlockStyle( 'core/columns', {
	name: 'first-col-to-third',
	label: 'Move first column to third'
} );
