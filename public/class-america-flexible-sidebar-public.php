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
		* The sidebars
		*
		* @since 3.0.0
		* @access private
		* @var $sidebars Array - An array of sidebar ids
		*/

	private $sidebars;


	/**
		* The sidebars registered with the site
		*
		* @since 3.0.0
		* @access private
		* @var $registered_sidebars Array - An array of sidebars registered with the site
		*/

	private $registered_sidebars;


	/**
		* The widgets registered with the site
		*
		* @since 3.0.0
		* @access private
		* @var $registered_widgets Array - An array of widgets registered with the site
		*/

	private $registered_widget;


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
		$this->set_sidebars();
	}


	/**
		* Set `registered_sidebars`
		*
		* @since 3.0.0
		*/

	public function set_registered_sidebars() {
		$this->registered_sidebars = $GLOBALS['wp_registered_sidebars'];
	}


	/**
		* Set `registered_widgets`
		*
		* @since 3.0.0
		*/

	public function set_registered_widgets() {
		$this->registered_widgets = $GLOBALS['wp_registered_widgets'];
	}


	/**
		* Registered sidebar ids to be manipulated later
		*
		* @since 3.0.0
		*/

	private function set_sidebars() {
		$identifiers = array(
	    'sidebar-primary',
	    'sidebar-secondary',
		);

	  if ( has_filter( 'america_sidebar_identifiers' ) ) {
	    $identifiers = apply_filters( 'america_sidebar_identifiers', $identifiers );
	  }

		$this->sidebars = $identifiers;
	}


	/**
		* Register the America_Promoted_Links_Widget widget
		*
		* @since 3.0.0
		*/

	public function register_widget() {
		register_widget( 'America_Promoted_Links_Widget' );
	}


	/**
		* Pluck an array of keys from a given input, e.g. pluck sidebars from an
		* an array of registered sidebars
		*
		* @param $keys Array - An array of keys to be found in the $input (needle)
		* @param $input Array - An array of items (haystack)
		*
		* @return $array Array - Array of located items
		* @since 3.0.0
		*/

	private function pluck( $keys, $input ) {
		if ( ! is_array( $input ) ) {
			return;
		}

		$array = array();

		foreach( $keys as $k ) {
			if ( array_key_exists( $k, $input ) ) {
				$array[$k] = $input[$k];
			}
		}

		return $array;
	}


	/**
		* Deregister the current sidebars
		*
		* @since 2.0.0
		*/

	public function america_sidebar_deactivate_sidebars() {
		$sidebars = $this->pluck( $this->sidebars, $this->registered_sidebars );

	  foreach ( $sidebars as $key => $value ) {
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
		if ( ! have_rows( 'america_sidebar' ) ) {
			return;
		}

		// Deactivate the default sidebars
		$this->america_sidebar_deactivate_sidebars();

		$this->template_loader->get_template_part( 'sidebar' );
	}
}
