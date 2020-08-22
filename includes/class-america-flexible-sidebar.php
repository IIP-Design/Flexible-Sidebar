<?php

/**
	* The file that defines the core plugin class
	*
	* A class definition that includes attributes and functions used across both the
	* public-facing side of the site.
	*
	* @link       https://github.com/USStateDept/Flexibile-Sidebar
	* @since      2.0.0
	*
	* @package    America_Flexible_Sidebar
	* @subpackage America_Flexible_Sidebar/includes
	*/




/**
	* The core plugin class.
	*
	* This is used to define internationalization and public-facing site hooks.
	*
	* Also maintains the unique identifier of this plugin as well as the current
	* version of the plugin.
	*
	* @since      2.0.0
	* @package    America_Flexible_Sidebar
	* @subpackage America_Flexible_Sidebar/includes
	* @author     Office of Design, U.S. Department of State
	*/

class America_Flexible_Sidebar {

	/**
		* The loader that's responsible for maintaining and registering all hooks that power
		* the plugin.
		*
		* @since      2.0.0
		* @access   protected
		* @var      America_Flexible_Sidebar_Loader    $loader    Maintains and registers all hooks for the plugin.
		*/

	protected $loader;


	/**
		* The unique identifier of this plugin.
		*
		* @since      2.0.0
		* @access   protected
		* @var      string    $plugin_name    The string used to uniquely identify this plugin.
		*/

	protected $plugin_name;


	/**
		* The current version of the plugin.
		*
		* @since      2.0.0
		* @access   protected
		* @var      string    $version    The current version of the plugin.
		*/

	protected $version;


	/**
		* Define the core functionality of the plugin.
		*
		* Set the plugin name and the plugin version that can be used throughout the plugin.
		* Load the dependencies, define the locale, and set the hooks for the public-facing
		* side of the site.
		*
		* @since      2.0.0
		*/

	public function __construct() {
		$this->plugin_name = 'america-flexible-sidebar';
		$this->version = '3.2.2';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_public_hooks();
	}


	/**
		* Load the required dependencies for this plugin.
		*
		* Create an instance of the loader which will be used to register the hooks
		* with WordPress.
		*
		* @since      2.0.0
		* @access   private
		*/

	private function load_dependencies() {
		require_once AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/class-america-flexible-sidebar-loader.php';
		require_once AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/class-america-flexible-sidebar-i18n.php';
		require_once AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/class-gamajo-template-loader.php';
		require_once AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/class-flexible-sidebar-template-loader.php';
		require_once AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/advanced-custom-fields/acf.php';
		require_once AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/class-america-flexible-sidebar-widgets.php';
		require_once AMERICA_FLEXIBLE_SIDEBAR_DIR . 'public/class-america-flexible-sidebar-public.php';

		/**
			* Custom settings for Advanced Custom Fields
			*/

		add_filter( 'acf/settings/path', function() {
			return AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/advanced-custom-fields/';
		});

		add_filter( 'acf/settings/dir', function() {
			return AMERICA_FLEXIBLE_SIDEBAR_URL . 'includes/advanced-custom-fields/';
		});

		add_filter( 'acf/settings/save_json', function( $path ) {
			$path = AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/acf-json';
			return $path;
		});

		add_filter( 'acf/settings/load_json', function( $paths ) {
			unset($paths[0]);
		  $paths[] = AMERICA_FLEXIBLE_SIDEBAR_DIR . 'includes/acf-json';
		  return $paths;
		});

		// Hide Advanced Custom Fields from Wordpress Admin Menu
		add_filter('acf/settings/show_admin', '__return_false');

		$this->loader = new America_Flexible_Sidebar_Loader();
	}


	/**
		* Define the locale for this plugin for internationalization.
		*
		* Uses the America_Flexible_Sidebar_i18n class in order to set the domain and to register the hook
		* with WordPress.
		*
		* @since      2.0.0
		* @access   private
		*/

	private function set_locale() {
		$plugin_i18n = new America_Flexible_Sidebar_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}


	/**
		* Register all of the hooks related to the public-facing functionality
		* of the plugin.
		*
		* @since      2.0.0
		* @access   private
		*/

	private function define_public_hooks() {
		$plugin_public = new America_Flexible_Sidebar_Public( $this->get_america_flexible_sidebar(), $this->get_version() );
		$this->loader->add_action( 'widgets_init', $plugin_public, 'register_widget' );
		$this->loader->add_action( 'wp_loaded', $plugin_public, 'set_registered_sidebars' );
		$this->loader->add_action( 'wp_loaded', $plugin_public, 'set_registered_widgets' );
		$this->loader->add_action( 'tha_sidebars_before', $plugin_public, 'america_flexible_sidebar_activate' );
	}


	/**
		* Run the loader to execute all of the hooks with WordPress.
		*
		* @since      2.0.0
		*/

	public function run() {
		$this->loader->run();
	}


	/**
		* The name of the plugin used to uniquely identify it within the context of
		* WordPress and to define internationalization functionality.
		*
		* @since     1.0.0
		* @return    string    The name of the plugin.
		*/

	public function get_plugin_name() {
		return $this->plugin_name;
	}


	/**
		* The name of the plugin used to uniquely identify it within the context of
		* WordPress and to define internationalization functionality.
		*
		* @since      2.0.0
		* @return    string    The name of the plugin.
		*/

	public function get_america_flexible_sidebar() {
		return $this->plugin_name;
	}


	/**
		* The reference to the class that orchestrates the hooks with the plugin.
		*
		* @since      2.0.0
		* @return    America_Flexible_Sidebar_Loader    Orchestrates the hooks of the plugin.
		*/

	public function get_loader() {
		return $this->loader;
	}


	/**
		* Retrieve the version number of the plugin.
		*
		* @since      2.0.0
		* @return    string    The version number of the plugin.
		*/

	public function get_version() {
		return $this->version;
	}
}
