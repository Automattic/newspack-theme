<?php

class Newspack_Theme_GPT {


	public static function init() {
		add_action( 'rest_api_init', array( __CLASS__, 'register_endpoints' ) );
	}

	public static function register_endpoints() {
		register_rest_route(
			'newspack-theme-gpt/v1',
			'/get-subtitle/',
			[
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => [ __CLASS__, 'api_get_subtitle' ],
				'permission_callback' => [ __CLASS__, 'api_permissions_check' ],
				'args'                => array(
					'post_id' => array(
						'required' => true,
						'type'     => 'integer',
					),
				),
			]
		);
	}

	public static function api_permissions_check( $request ) {
		return current_user_can( 'edit_posts' );
	}

	public static function api_get_subtitle( $request ) {
		$post_id = $request->get_param( 'post_id' );
		if ( ! $post_id ) {
			return new WP_Error( 'invalid_post_id', __( 'Invalid post ID', 'newspack-theme' ), array( 'status' => 400 ) );
		}

		$post = get_post( $post_id );
		if ( ! $post ) {
			return new WP_Error( 'invalid_post_id', __( 'Invalid post ID', 'newspack-theme' ), array( 'status' => 400 ) );
		}

		if ( ! class_exists( 'Newspack_Manager\GPT' ) ) {
			return new WP_Error( 'invalid_post_id', __( 'GPT not installed', 'newspack-theme' ), array( 'status' => 400 ) );
		}

		$chat = [
			[
				'role'    => 'user',
				'content' => 'I am running a News site and I want to add a subtitle to my posts. If I provide you with the article contents could you suggest a subtitle for me?',
			],
			[
				'role'    => 'assistant',
				'content' => 'Sure, I can do that. Please provide me with the article title.',
			],
			[
				'role'    => 'user',
				'content' => $post->post_title,
			],
			[
				'role'    => 'assistant',
				'content' => 'Thanks, and what is the article content?',
			],
			[
				'role'    => 'user',
				'content' => strip_tags( $post->post_content ),
			],
		];

		$function = new \Newspack_Manager\GPT_Function( 'update_subtitle' );
		$function->add_description( 'This function will update the subtitle of a post.' );
		$function->add_property( 'subtitle', 'string', 'The new subtitle.', true );

		$response = \Newspack_Manager\GPT::make_request(
			$chat,
			null,
			null,
			[],
			[ $function->get() ]
		);

		$response_body = json_decode( wp_remote_retrieve_body( $response ) );

		if (
			! empty( $response_body->function_call ) &&
			! empty( $response_body->function_call->name ) &&
			'update_subtitle' === $response_body->function_call->name
		) {

			$subtitle = json_decode( $response_body->function_call->arguments );

			return $subtitle->subtitle;

		}

		return '';
	}
}

Newspack_Theme_GPT::init();
