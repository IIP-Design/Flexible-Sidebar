<?php

/**********************************************************************************************************
Plugin Name:    Flexible Sidebar
Description:    Adds a customizable field to post and page edit screens that overwrites the global sidebar(s)
Version:        dev-0.0.1
Author:         Office of Design, U.S. Department of State
License:        MIT
Text Domain:    america
Domain Path:    /languages/
************************************************************************************************************/
if ( ! defined( 'ABSPATH' ) ) exit;

// 1. customize ACF path
function america_acf_settings_path( $path ) {
    $path = plugin_dir_path( __FILE__ ) . 'includes/advanced-custom-fields/';
    return $path;
}
add_filter('acf/settings/path', 'america_acf_settings_path');


// 2. customize ACF dir
function america_acf_settings_dir( $dir ) {
    $dir = plugin_dir_url( __FILE__ ) . 'includes/advanced-custom-fields/';
    return $dir;
}
add_filter('acf/settings/dir', 'america_acf_settings_dir');


// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');

// 4. The Flexible Sidebar flexibile content field on post and page edit screens
function america_add_local_field_group() {
  acf_add_local_field_group(array (
  	'key' => 'group_5716975476040',
  	'title' => 'Flexible Sidebar',
  	'fields' => array (
  		array (
  			'key' => 'field_5716975e65c1d',
  			'label' => 'Sidebar',
  			'name' => 'america_sidebar',
  			'type' => 'flexible_content',
  			'instructions' => 'Replace the default sidebar with a custom sidebar on this page or post.',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'button_label' => 'Add Sidebar',
  			'min' => '',
  			'max' => '',
  			'layouts' => array (
  				array (
  					'key' => '57176b5e3cd34',
  					'name' => 'html',
  					'label' => 'HTML',
  					'display' => 'row',
  					'sub_fields' => array (
  						array (
  							'key' => 'field_57176b83aff6d',
  							'label' => 'HTML Markup',
  							'name' => 'america_markup',
  							'type' => 'wysiwyg',
  							'instructions' => 'Add your sidebar markup or WordPress shortcode here',
  							'required' => 0,
  							'conditional_logic' => 0,
  							'wrapper' => array (
  								'width' => '',
  								'class' => '',
  								'id' => '',
  							),
  							'default_value' => '',
  							'tabs' => 'all',
  							'toolbar' => 'basic',
  							'media_upload' => 0,
  						),
  					),
  					'min' => '',
  					'max' => '',
  				),
  			),
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'post',
  			),
  		),
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'page',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => array (
  		0 => 'custom_fields',
  		1 => 'discussion',
  		2 => 'comments',
  		3 => 'slug',
  		4 => 'send-trackbacks',
  	),
  	'active' => 1,
  	'description' => '',
  ));
}
add_action('acf/init', 'america_add_local_field_group');

// 5. Include the main Advanced Custom Fields plugin file
include_once( 'includes/advanced-custom-fields/acf.php' );
