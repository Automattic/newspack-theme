/**
 * File homepage-editor-class.js
 *
 * A hacky work around for: https://github.com/WordPress/gutenberg/issues/10640
 *
 * Adds a class to the editor when it's on the static front page, so it can be made wider.
 */

(function($) {
	wp.domReady(function() {
		$(".editor-writing-flow").addClass("newspack-static-front-page");
	});
})(jQuery);
