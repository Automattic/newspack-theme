module.exports = {
	extends: [
		'plugin:@wordpress/eslint-plugin/recommended',
		'plugin:prettier/recommended',
		'plugin:react/recommended',
		'plugin:jsdoc/recommended',
		'plugin:import/errors',
		'plugin:import/warnings',
	],
	env: {
		browser: true,
	},
	globals: {
		newspackScreenReaderText: 'readonly',
		stylePacksData: 'readonly',
		jQuery: 'readonly',
		_: 'readonly',
	},
	ignorePatterns: [ 'newspack-*/js/dist', 'scripts' ],
	rules: {
		camelcase: 'off',
		// Disallow importing or requiring packages that are not listed in package.json
		// This prevents us from depending on transitive dependencies, which could break in unexpected ways.
		'import/no-extraneous-dependencies': [ 'error' ],
		// There's a conflict with prettier here:
		'react/jsx-curly-spacing': 'off',
		// Skip prop types validation for now
		'react/prop-types': 'off',
		'react/react-in-jsx-scope': 'off',
		// JSDoc rules overrides
		'jsdoc/require-returns': 'off',
		'jsdoc/require-param': 'off',
	},
};
