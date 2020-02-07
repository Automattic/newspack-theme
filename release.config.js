const THEMES = [
	'newspack-joseph',
	'newspack-katharine',
	'newspack-nelson',
	'newspack-sacha',
	'newspack-scott',
	'newspack-theme',
];

module.exports = {
	branches: [ 'release' ],
	prepare: [
		'@semantic-release/changelog',
		'@semantic-release/npm',
		[
			'semantic-release-version-bump',
			{
				files: [ 'newspack-*/sass/style.scss', 'newspack-*/style.css' ],
			},
		],
		{
			path: '@semantic-release/git',
			assets: [
				...THEMES.map( name => `${ name }/sass/style.scss` ),
				'package.json',
				'package-lock.json',
				'CHANGELOG.md',
			],
			message: 'chore(release): ${nextRelease.version} [skip ci]\n\n${nextRelease.notes}',
		},
	],
	plugins: [
		'@semantic-release/commit-analyzer',
		'@semantic-release/release-notes-generator',
		[
			'@semantic-release/npm',
			{
				npmPublish: false,
			},
		],
		'semantic-release-version-bump',
		[
			'@semantic-release/github',
			{
				assets: THEMES.map( name => ( {
					path: `./assets/release/${ name }.zip`,
					label: `${ name }.js`,
				} ) ),
			},
		],
	],
};
