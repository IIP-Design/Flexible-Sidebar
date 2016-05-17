<?php

/**
	* The public-facing functionality of the plugin.
	*
	* @link       https://github.com/USStateDept/Flexibile-Sidebar
	* @since      2.0.0
	*
	* @package    America_Flexible_Sidebar
	* @subpackage America_Flexible_Sidebar/public
	*/




/**
	* The public-facing functionality of the plugin.
	*
	* Defines the plugin name, version, and two examples hooks for how to
	* enqueue the public stylesheet and JavaScript.
	*
	* @package    America_Flexible_Sidebar
	* @subpackage America_Flexible_Sidebar/public
	* @author     Office of Design, U.S. Department of State
	*/

class America_Flexible_Sidebar_Public {

	/**
		* The ID of this plugin.
		*
		* @since      2.0.0
		* @access   private
		* @var      string    $plugin_name    The ID of this plugin.
		*/

	private $plugin_name;


	/**
		* The version of this plugin.
		*
		* @since      2.0.0
		* @access   private
		* @var      string    $version    The current version of this plugin.
		*/

	private $version;


	/**
		* The template loader instance.
		*
		* @since 2.0.0
		* @access protected
		*/

	protected $template_loader;


	/**
		* Initialize the class and set its properties.
		*
		* @since      2.0.0
		* @param      string    $plugin_name       The name of the plugin.
		* @param      string    $version    The version of this plugin.
		*/

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->template_loader = new America_Flexible_Sidebar_Template_Loader;
	}


	/**
		*	Gets a list of the registered sidebars, looks for specified sidebars to remove,
		* and removes them.
		*
		* @since 2.0.0
		*/

	public function america_sidebar_deactivate_sidebars() {
	  $registered_sidebars = $GLOBALS['wp_registered_sidebars'];
	  $deregister = array();
	  $identifier = array(
	    'sidebar-primary',
	    'sidebar-secondary',
		);

	  if ( has_filter( 'america_sidebar_deregister' ) ) {
	    $identifier = apply_filters( 'america_sidebar_deregister', $identifier );
	  }

	  foreach ( $identifier as $id ) {
	    if ( array_key_exists( $id, $registered_sidebars ) ) {
	      $sidebar = $registered_sidebars[$id];
	      $deregister[$id] = $sidebar;
	    }
	  }

	  foreach ( $deregister as $key => $value ) {
	    unregister_sidebar( $key );
	  }
	}


	/**
		*	Deactivates the theme's registered sidebars and replaces it with the
		* Flexible Sidebar content
		*
		* @since 2.0.0
		*/

	public function america_flexible_sidebar_activate() {
	  if ( have_rows('america_sidebar') ) {
	    $this->america_sidebar_deactivate_sidebars();
			$this->template_loader->get_template_part( 'sidebar' );
		}
	}
}
