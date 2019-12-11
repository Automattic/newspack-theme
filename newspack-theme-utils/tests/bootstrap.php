<?php

define( 'WP_DEFAULT_THEME', '' );

function is_amp_endpoint() { return true; }

function sharing_display( $p1, $p2 ) {}

function jetpack_is_mobile( $p1, $p2 ) {}

/**
 * @param string $page Page slug.
 * @return int
 */
function wc_get_page_id($page) {}
class WC_Checkout {
	/** @return WC_Checkout */
	public static function instance() {}
	/**
	 * @param  string $fieldset
	 * @return array
	 */
	public function get_checkout_fields($fieldset = '') {}
}
