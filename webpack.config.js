/**
 **** WARNING: No ES6 modules here. Not transpiled! ****
 */
/* eslint-disable import/no-nodejs-modules */

/**
 * External dependencies
 */
const fs = require("fs");
const getBaseWebpackConfig = require("@automattic/calypso-build/webpack.config.js");
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const entry = fs
	.readdirSync(path.join(__dirname, "js", "src"))
	.filter(script => "js" === script.split(".").pop())
	.reduce((obj, item) => {
		const split = item.split(".");
		split.pop();
		return {
			...obj,
			[split.join(".")]: path.join(__dirname, "js", "src", item)
		};
	}, {});

const webpackConfig = getBaseWebpackConfig(
	{ WP: true },
	{
		entry,
		"output-path": path.join(__dirname, "js", "dist"),
	}
);

module.exports = webpackConfig;
