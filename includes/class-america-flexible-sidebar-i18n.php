<?php

/**
	* Define the internationalization functionality.
	*
	* Loads and defines the internationalization files for this plugin
	* so that it is ready for translation.
	*
	* @since      2.0.0
	* @package    America_Flexible_Sidebar
	* @subpackage America_Flexible_Sidebar/includes
	* @author     Office of Design, U.S. Department of State
	*/

class America_Flexible_Sidebar_i18n {

	/**
		* Load the plugin text domain for translation.
		*
		* @since      2.0.0
		*/

	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'america-flexible-sidebar', false, AMERICA_FLEXIBLE_SIDEBAR_DIR . '/languages/');
	}
}
