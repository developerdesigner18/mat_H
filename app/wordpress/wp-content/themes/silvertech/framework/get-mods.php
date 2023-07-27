<?php
/**
 * Gets all theme mods and stores them in an easily accessable global var to limit DB requests
 *
 * @package silvertech
 * @version 3.6.8
 */

global $silvertech_theme_mods;
$silvertech_theme_mods = get_theme_mods();

// Returns theme mod from global var
function silvertech_get_mod( $id, $default = '' ) {

	// Return get_theme_mod on customize_preview
	if ( is_customize_preview() ) {
		return get_theme_mod( $id, $default );
	}
   
	// Get global object
	global $silvertech_theme_mods;

	// Return data from global object
	if ( ! empty( $silvertech_theme_mods ) ) {

		// Return value
		if ( isset( $silvertech_theme_mods[$id] ) ) {
			return $silvertech_theme_mods[$id];
		} 
		else {
			return $default;
		}
	}

	// Global object not found return using get_theme_mod
	else {
		return get_theme_mod( $id, $default );
	}
}

// Returns global mods
function silvertech_get_mods() {
	global $silvertech_theme_mods;
	return $silvertech_theme_mods;
}