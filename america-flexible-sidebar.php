<?php

/**********************************************************************************************************
Plugin Name:    America Flexible Sidebar
Description:    Adds a customizable field to post and page edit screens that overwrites the global sidebar(s)
Version:        2.0.0
Author:         Office of Design, U.S. Department of State
License:        MIT
Text Domain:    america
Domain Path:    /languages/
************************************************************************************************************/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// Constants
define('AMERICA_FLEXIBLE_SIDEBAR_DIR', plugin_dir_path( dirname( __FILE__ ) ) . 'america-flexible-sidebar/' );


// Activate
function activate_america_flexible_sidebar() {
	require_once AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/class-america-flexible-sidebar-activator.php';
	America_Flexible_Sidebar_Activator::activate();
}


// Deactivate
function deactivate_america_flexible_sidebar() {
	require_once AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/class-america-flexible-sidebar-deactivator.php';
	America_Flexible_Sidebar_Deactivator::deactivate();
}


register_activation_hook( __FILE__, 'activate_america_flexible_sidebar' );
register_deactivation_hook( __FILE__, 'deactivate_america_flexible_sidebar' );


require AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/class-america-flexible-sidebar.php';

/**
	* Begins execution of the plugin.
	*
	* Since everything within the plugin is registered via hooks,
	* then kicking off the plugin from this point in the file does
	* not affect the page life cycle.
	*
	* @since      2.0.0
	*/

function run_america_flexible_sidebar() {
	$plugin = new America_Flexible_Sidebar();
	$plugin->run();
}

run_america_flexible_sidebar();
