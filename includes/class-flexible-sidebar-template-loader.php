<?php

/**
  * Template loader for the America Flexible Sidebar
  *
  * @package America_Flexible_Sidebar
  */


if ( ! class_exists( 'Gamajo_Template_Loader' ) ) {
  require plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gamajo-template-loader.php';
}


class America_Flexible_Sidebar_Template_Loader extends Gamajo_Template_Loader {
  /**
    * Prefix for filter names.
    *
    * @since 2.0.0
    *
    * @var string
    */

  protected $filter_prefix = 'america_flexible_sidebar';


  /**
    * Directory name where custom templates for this plugin should be found in the theme.
    *
    * @since 2.0.0
    *
    * @var string
    */

  protected $theme_template_directory = 'america-flexible-sidebar-templates';


  /**
   * Directory name where templates are found in this plugin.
   *
   * e.g. 'templates' or 'includes/templates', etc.
   *
   * @since 1.1.0
   *
   * @var string
   */

  protected $plugin_template_directory = 'public/templates';


  /**
   * Reference to the root directory path of this plugin.
   *
   * Can either be a defined constant, or a relative reference from where the subclass lives.
   *
   * e.g. YOUR_PLUGIN_TEMPLATE or plugin_dir_path( dirname( __FILE__ ) ); etc.
   *
   * @since 1.0.0
   *
   * @var string
   */

  protected $plugin_directory = AMERICA_FLEXIBLE_SIDEBAR_DIR;
}
