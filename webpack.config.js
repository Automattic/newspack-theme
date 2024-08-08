/**
 **** WARNING: No ES6 modules here. Not transpiled! ****
 */
/* eslint-disable import/no-nodejs-modules, @typescript-eslint/no-var-requires */

/**
 * External dependencies
 */
const fs = require( 'fs' );
const getBaseWebpackConfig = require( 'newspack-scripts/config/getWebpackConfig' );
const path = require( 'path' );

// Add all js/src/*.js scripts
const entry = fs
	.readdirSync( path.join( __dirname, 'newspack-theme/js', 'src' ) )
	.filter( script => 'js' === script.split( '.' ).pop() )
	.reduce( ( obj, item ) => {
		const split = item.split( '.' );
		split.pop();
		return {
			...obj,
			[ split.join( '.' ) ]: path.join( __dirname, 'newspack-theme/js', 'src', item ),
		};
	}, {} );

// Add all js/src/*/index.js scripts
fs.readdirSync( path.join( __dirname, 'newspack-theme/js', 'src' ) )
	.filter( script =>
		fs.existsSync( path.join( __dirname, 'newspack-theme/js', 'src', script, 'index.js' ) )
	)
	.forEach( function ( script ) {
		entry[ script ] = path.join( __dirname, 'newspack-theme/js', 'src', script, 'index.js' );
	} );

const webpackConfig = getBaseWebpackConfig( {
	entry,
} );

module.exports = webpackConfig;
