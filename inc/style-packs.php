<?php
/**
 * Style Packs configuration.
 *
 * @package Newspack
 */
new Newspack_Style_Packs_Core(
	array(
		// Format to use for active style pack body class
		'body_class_format'  => 'style-pack-%s',
		// Style packs directory
		'styles_directory'   => 'styles',
		// JavaScript directory
		'js_directory'       => 'js',
		// Style declarations
		'styles'             => array(
			'default' => esc_html__( 'Default Style', 'newspack' ),
			'style-1' => esc_html__( 'Style 1', 'newspack' ),
			'style-2' => esc_html__( 'Style 2', 'newspack' ),
		),
		// Style descriptions
		'style_descriptions' => array(
			'default' => esc_html__( 'This is the default style.', 'newspack' ),
			'style-1' => esc_html__( 'The description for style 1.', 'newspack' ),
			'style-2' => esc_html__( 'The description for style 2.', 'newspack' ),
		),
		// Style fonts
		'fonts'              => array(
			'style-1' => array(
				'IBM Plex Serif' => 'https://fonts.googleapis.com/css?family=IBM+Plex+Serif:400,400i,700,700i',
			),
			'style-2' => array(
				'Montserrat' => 'https://fonts.googleapis.com/css?family=Montserrat:400,700,900',
			),
		),
	)
);
