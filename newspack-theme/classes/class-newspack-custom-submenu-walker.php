<?php
/**
 * Custom submenu walker for this theme.
 *
 * @package Newspack
 */

/**
 * This class gets the ID of the parent menu.
 */
class Newspack_Custom_Submenu_Walker extends Walker_Nav_Menu {
	/**
	 * Add an ID with parent menu item's ID to each submenu.
	 *
	 * @param string $output Nav menu item start element.
	 * @param int    $depth  Depth.
	 * @param object $args   Nav menu args.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		// Get the current stored menu ID.
		$menu_parent_id = Newspack_Current_Menu_ID::get_current_id();
		$submenu_id     = 'submenu-' . esc_attr( $menu_parent_id );
		$indent         = str_repeat( "\t", $depth );
		$output        .= "\n$indent<ul class=\"sub-menu\" id=\"$submenu_id\">\n";
	}
}
