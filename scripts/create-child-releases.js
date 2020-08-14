/* eslint-disable no-console */

const { basename, resolve } = require( 'path' );
const { stat, readFile } = require( 'fs-extra' );
const { Octokit } = require( '@octokit/rest' );

const THEMES = [
	'newspack-theme',
	'newspack-joseph',
	'newspack-katharine',
	'newspack-nelson',
	'newspack-sacha',
	'newspack-scott',
];

/**
 * Because all the themes are in a monorepo, some internal processes
 * have a hard time automatically deploying the changes. For this reason
 * the themes have individual repos just for the releases.
 * These releases are automatically published using this script.
 */
const createExternalReleasesOfThemes = async () => {
	const { version } = require( '../package.json' );

	const TOKEN = process.env.GITHUB_TOKEN || process.env.GH_TOKEN;

	if ( ! TOKEN ) {
		console.error( 'Missing github token.' );
		process.exit( 1 );
	}

	const octokit = new Octokit( {
		auth: TOKEN,
	} );

	const RELEASES = THEMES.map( name => ( {
		filePath: resolve( __dirname, `../release/${ name }.zip` ),
		repoName: `${ name }-theme`,
	} ) );

	const owner = 'Automattic';

	RELEASES.forEach( async ( { filePath, repoName } ) => {
		console.log( `Crating a release for ${ owner }/${ repoName }…` );

		const {
			data: { upload_url: uploadUrl, id: releaseId },
		} = await octokit.repos.createRelease( {
			owner,
			repo: repoName,
			tag_name: `v${ version }`,
			name: `v${ version }`,
			body: `Release v${ version }`,
			// We'll create a draft release, append the assets to it, and then publish it.
			// This is so that the assets are available when we get a Github release event.
			draft: true,
		} );

		const file = await stat( resolve( filePath ) );
		const upload = {
			url: uploadUrl,
			data: await readFile( filePath ),
			name: basename( filePath ),
			headers: {
				'content-type': 'application/zip',
				'content-length': file.size,
			},
		};

		const {
			data: { browser_download_url: downloadUrl },
		} = await octokit.repos.uploadReleaseAsset( upload );

		console.log( `Published file ${ downloadUrl }` );
		const {
			data: { html_url: url },
		} = await octokit.repos.updateRelease( {
			owner,
			repo: repoName,
			release_id: releaseId,
			draft: false,
		} );

		console.log( `Published GitHub release: ${ url }` );
	} );
};

if ( process.argv.some( arg => arg.startsWith( '--run' ) ) ) {
	createExternalReleasesOfThemes();
}

// Export for use of semantic-release config.
module.exports = {
	THEMES,
};
