const fs = require( 'fs' );
const chokidar = require( 'chokidar' );
const postcss = require( 'postcss' );
const sass = require( 'sass' );
const rtlcss = require( 'rtlcss' );
const postcssFocusWithin = require( 'postcss-focus-within' );

if ( ! fs.existsSync( './newspack-theme/styles' ) ) {
	fs.mkdirSync( './newspack-theme/styles' );
}

if ( ! fs.existsSync( './newspack-sacha/styles' ) ) {
	fs.mkdirSync( './newspack-sacha/styles' );
}

if ( ! fs.existsSync( './newspack-scott/styles' ) ) {
	fs.mkdirSync( './newspack-scott/styles' );
}

if ( ! fs.existsSync( './newspack-nelson/styles' ) ) {
	fs.mkdirSync( './newspack-nelson/styles' );
}

if ( ! fs.existsSync( './newspack-katharine/styles' ) ) {
	fs.mkdirSync( './newspack-katharine/styles' );
}

if ( ! fs.existsSync( './newspack-joseph/styles' ) ) {
	fs.mkdirSync( './newspack-joseph/styles' );
}

/**
 * Save a file do disk.
 */
const saveFile = ( fileName, content ) => {
	fs.writeFile( fileName, content, function ( err ) {
		if ( err ) {
			console.log( 'ERROR while saving file', fileName, '->', err );
		}
	} );
};

/**
 * Compile a Sass file to CSS.
 *
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
			function ( error, result ) {
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
	{ inFile: 'newspack-theme/sass/style.scss', outFile: 'newspack-theme/style.css', withRTL: true },
	{
		inFile: 'newspack-theme/sass/style-editor.scss',
		outFile: 'newspack-theme/style-editor.css',
	},
	{
		inFile: 'newspack-theme/sass/style-editor-overrides.scss',
		outFile: 'newspack-theme/styles/style-editor-overrides.css',
	},
	{
		inFile: 'newspack-theme/sass/style-editor-customizer.scss',
		outFile: 'newspack-theme/styles/style-editor-customizer.css',
	},
	{
		inFile: 'newspack-theme/sass/plugins/woocommerce.scss',
		outFile: 'newspack-theme/styles/woocommerce.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-theme/sass/plugins/trust-indicators.scss',
		outFile: 'newspack-theme/styles/trust-indicators.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-theme/sass/plugins/newspack-newsletters-editor.scss',
		outFile: 'newspack-theme/styles/newspack-newsletters-editor.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-theme/sass/plugins/newspack-sponsors.scss',
		outFile: 'newspack-theme/styles/newspack-sponsors.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-theme/sass/plugins/newspack-sponsors-editor.scss',
		outFile: 'newspack-theme/styles/newspack-sponsors-editor.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-theme/tribe-events/tribe-events.scss',
		outFile: 'newspack-theme/tribe-events/tribe-events.css',
	},
	{ inFile: 'newspack-theme/sass/print.scss', outFile: 'newspack-theme/styles/print.css' },
	// Newspack Sacha Child theme
	{
		inFile: 'newspack-sacha/sass/style.scss',
		outFile: 'newspack-sacha/style.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-sacha/sass/style-editor.scss',
		outFile: 'newspack-sacha/style-editor.css',
	},
	{
		inFile: 'newspack-sacha/sass/child-style-editor-overrides.scss',
		outFile: 'newspack-sacha/styles/child-style-editor-overrides.css',
	},
	{
		inFile: 'newspack-sacha/tribe-events/tribe-events.scss',
		outFile: 'newspack-sacha/tribe-events/tribe-events.css',
	},
	// Newspack Scott Child theme
	{
		inFile: 'newspack-scott/sass/style.scss',
		outFile: 'newspack-scott/style.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-scott/sass/style-editor.scss',
		outFile: 'newspack-scott/style-editor.css',
	},
	{
		inFile: 'newspack-scott/tribe-events/tribe-events.scss',
		outFile: 'newspack-scott/tribe-events/tribe-events.css',
	},
	// Newspack Nelson Child theme
	{
		inFile: 'newspack-nelson/sass/style.scss',
		outFile: 'newspack-nelson/style.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-nelson/sass/style-editor.scss',
		outFile: 'newspack-nelson/style-editor.css',
	},
	{
		inFile: 'newspack-nelson/tribe-events/tribe-events.scss',
		outFile: 'newspack-nelson/tribe-events/tribe-events.css',
	},
	// Newspack Katharine Child theme
	{
		inFile: 'newspack-katharine/sass/style.scss',
		outFile: 'newspack-katharine/style.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-katharine/sass/style-editor.scss',
		outFile: 'newspack-katharine/style-editor.css',
	},
	{
		inFile: 'newspack-katharine/tribe-events/tribe-events.scss',
		outFile: 'newspack-katharine/tribe-events/tribe-events.css',
	},
	// Newspack Joseph Child theme
	{
		inFile: 'newspack-joseph/sass/style.scss',
		outFile: 'newspack-joseph/style.css',
		withRTL: true,
	},
	{
		inFile: 'newspack-joseph/sass/style-editor.scss',
		outFile: 'newspack-joseph/style-editor.css',
	},
	{
		inFile: 'newspack-joseph/tribe-events/tribe-events.scss',
		outFile: 'newspack-joseph/tribe-events/tribe-events.css',
	},
];

// initial run
compileAllStylesheets();

// run watcher if `--watch` argument present
if ( process.argv.some( arg => arg.startsWith( '--watch' ) ) ) {
	console.log( `watching the scss files…
` );

	chokidar.watch( 'newspack-theme/sass/**/*.scss' ).on( 'change', path => {
		console.log( `updated: ${ path }
` );

		compileAllStylesheets();
	} );
}
