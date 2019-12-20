const fs = require( 'fs' );
const chokidar = require( 'chokidar' );
const postcss = require( 'postcss' );
const sass = require( 'node-sass' );
const rtlcss = require( 'rtlcss' );
const postcssFocusWithin = require( 'postcss-focus-within' );

if ( ! fs.existsSync( './styles' ) ) {
	fs.mkdirSync( './styles' );
}

/**
 * Save a file do disk.
 */
const saveFile = ( fileName, content ) => {
	fs.writeFile( fileName, content, function( err ) {
		if ( err ) {
			console.log( 'ERROR while saving file', fileName, '->', err );
		}
	} );
};

/**
 * Compile a Sass file to CSS.
 * @param  {string} inFile  Sass file path
 * @param  {string} outFile out file path
 * @param  {bool} withRTL Whether to save RTL version additionally
 */
const compileSassFile = ( { inFile, outFile, withRTL } ) =>
	new Promise( ( resolve, reject ) => {
		sass.render(
			{
				file: inFile,
				outputStyle: 'expanded',
				outFile,
			},
			function( error, result ) {
				if ( error ) {
					console.log( 'ERROR in sass compilation', error );
					reject( error );
				} else {
					// process the file with PostCSS
					postcss( [ postcssFocusWithin ] )
						.process( result.css, { from: inFile, to: outFile } )
						.then( result => {
							// save the file
							saveFile( outFile, result.css );
							// save the RTL version file
							if ( withRTL ) {
								saveFile( outFile.replace( '.css', '-rtl.css' ), rtlcss.process( result.css ) );
							}

							resolve( outFile );
						} );
				}
			}
		);
	} );

const compileAllStylesheets = () => {
	Promise.all( SASS_STYLESHEETS.map( compileSassFile ) ).then( files => {
		console.log( `processed ${ files.length } SCSS files ✨
` );
	} );
};

const SASS_STYLESHEETS = [
	{ inFile: 'sass/style.scss', outFile: 'style.css', withRTL: true },
	{ inFile: 'sass/styles/style-1/style-1.scss', outFile: 'styles/style-1.css', withRTL: true },
	{ inFile: 'sass/styles/style-2/style-2.scss', outFile: 'styles/style-2.css', withRTL: true },
	{ inFile: 'sass/styles/style-3/style-3.scss', outFile: 'styles/style-3.css', withRTL: true },
	{ inFile: 'sass/styles/style-4/style-4.scss', outFile: 'styles/style-4.css', withRTL: true },
	{ inFile: 'sass/styles/style-5/style-5.scss', outFile: 'styles/style-5.css', withRTL: true },
	{ inFile: 'sass/style-editor.scss', outFile: 'styles/style-editor.css' },
	{ inFile: 'sass/style-editor-overrides.scss', outFile: 'styles/style-editor-overrides.css' },
	{ inFile: 'sass/style-editor-customizer.scss', outFile: 'styles/style-editor-customizer.css' },
	{ inFile: 'sass/styles/style-1/style-1-editor.scss', outFile: 'styles/style-1-editor.css' },
	{ inFile: 'sass/styles/style-2/style-2-editor.scss', outFile: 'styles/style-2-editor.css' },
	{ inFile: 'sass/styles/style-3/style-3-editor.scss', outFile: 'styles/style-3-editor.css' },
	{ inFile: 'sass/styles/style-4/style-4-editor.scss', outFile: 'styles/style-4-editor.css' },
	{ inFile: 'sass/styles/style-5/style-5-editor.scss', outFile: 'styles/style-5-editor.css' },
	{ inFile: 'sass/plugins/woocommerce.scss', outFile: 'styles/woocommerce.css', withRTL: true },
	{ inFile: 'sass/print.scss', outFile: 'styles/print.css' },
];

// initial run
compileAllStylesheets();

// run watcher if `--watch` argument present
if ( process.argv.some( arg => arg.startsWith( '--watch' ) ) ) {
	console.log( `watching the scss files…
` );

	chokidar.watch( 'sass/**/*.scss' ).on( 'change', path => {
		console.log( `updated: ${ path }
` );

		compileAllStylesheets();
	} );
}
