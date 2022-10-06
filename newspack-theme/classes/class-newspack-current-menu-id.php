<?php
/**
 * Menu ID class
 *
 * @package Newspack
 */

/**
 * Get and store current menu's ID so it can be shared across functions.
 *
 * @param string $value Current menu item ID.
 * @return string Current menu item ID.
 */
class Newspack_Current_Menu_ID {
	/**
	 * Create variable to store the current menu ID.
	 *
	 * @var string $current_menu_id Store current menu item.
	 */
	private static $current_menu_id = '';

	/**
	 * Sets the current Menu ID value in newspack_add_dropdown_icons().
	 *
	 * @param int $value Current menu item ID.
	 */
	public static function set_current_id( $value ) {
		self::$current_menu_id = $value;
	}

	/**
	 * Gets the current Menu ID for Newspack_Custom_Submenu_Walker().
	 */
	public static function get_current_id() {
		return self::$current_menu_id;
	}
}
