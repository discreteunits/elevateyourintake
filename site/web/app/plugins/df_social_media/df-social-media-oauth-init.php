<?php
/**
 * @package DF Social Media Oauth
 */
/*
Plugin Name: DF Social Media Oauth
Plugin URI: http://daffyhazan.com/
Description: Social Oauth Extender
Version: 0.3.1
Author: Dahz
Author URI: http://daffyhazan.com/
License: GPLv2 or later
Text Domain: df_sosmed
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'DF_SOCIAL_OAUTH_VERSION', '0.1' );
define( 'DF_SOCIAL_OAUTH__MINIMUM_WP_VERSION', '3.2' );
define( 'DF_SOCIAL_OAUTH__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DF_SOCIAL_OAUTH_DELETE_LIMIT', 100000 );

//register_activation_hook( __FILE__, array( 'df_social_media', 'plugin_activation' ) );
//register_deactivation_hook( __FILE__, array( 'df_social_media', 'plugin_deactivation' ) );
	require_once( DF_SOCIAL_OAUTH__PLUGIN_DIR . 'df-social-media-oauth.php' );
	require_once( DF_SOCIAL_OAUTH__PLUGIN_DIR . '/widget/df-widget-social-counter.php' );

function custom_theme_setup() {
	if( class_exists( "DF_Global_Options" ) ){


	

		$menu = DF_Global_Options::$menu_list;
		$social_menu = $menu['option_list']['options'];
		$oauth_menu = array('df_oauth' => 	 array(
							'text' => 'OAUTH',
							'icon' => 'fa fa-download',
							'view' => DF_SOCIAL_OAUTH__PLUGIN_DIR .'/views/df-oauth-view-admin.php',
							'is_parent' => false,
							'end_child' => true,
							'href' => 'oauth',
							'section_hierarchy' => 'oauth'
						));
		//$social_menu['df_oauth']= $oauth_menu;
		$i = array_search('df_account_network', array_keys($social_menu));
		$social_menu['df_account_network']['end_child'] = false;
		array_splice($social_menu, $i + 1, 0, $oauth_menu);
		DF_Global_Options::$menu_list['option_list']['options'] = $social_menu;
	}

}
add_action( 'after_setup_theme', 'custom_theme_setup' );