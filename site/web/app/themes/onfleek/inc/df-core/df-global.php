<?php

Class DF_Global_Options {
	
	static $menu_list=array();
	
	static $options=array();

	static $js_files_admin=array(
		'wp-df-select2' => array(
			'url' => '/inc/df-core/asset/js/admin/select2.js',
			'only_slug' => array( 'df_theme_options' )
		),
		'wp-df-bootstrap-switch-script' => array(
			'url' => '/inc/df-core/asset/js/admin/bootstrap-switch.js',
			'only_slug' => array( 'df_theme_options' )
		),
		'wp-df-responsive-script' => array(
			'url' => '/inc/df-core/asset/js/admin/responsive.js',
			'only_slug' => array( 'df_theme_options' )
		),
		'wp-df-metismenu-script' => array(
			'url' => '/inc/df-core/asset/js/admin/metismenu.min.js',
			'only_slug' => array( 'df_theme_options' )
		),
		'wp-df-main-script' => array(
			'url' => '/inc/df-core/asset/js/admin/main.js',
			'only_slug' => array( 'df_theme_options' )
		),
		'wp-df-theme-options-script' => array(
			'url' => '/inc/df-core/asset/js/admin/df-theme-options.js',
			'only_slug' => array( 'df_theme_options' )
		),
		'wp-df-bootstrap-script' => array(
			'url' => '/inc/df-core/asset/js/admin/bootstrap.min.js',
			'only_slug' => array( 'df_theme_options' )
		),

		'df-meta-box-js' => array(
			'url' => '/inc/df-core/asset/js/admin/metabox.js',
			'only_slug' => array('')
		),
		'df-meta-box-js-lib' => array(
			'url' => '/inc/df-core/asset/js/admin/df-metabox.js',
			'only_slug' => array('')
		),
		'df-retina-js' => array(
			'url' => '/inc/df-core/asset/js/admin/retina.js',
			'only_slug' => array('')
		),
		'no-ui-slider' => array(
			'url' => '/inc/df-core/asset/js/admin/nouislider.js',
			'only_slug' => array('df_theme_options')
		),
		'df-install-demo' => array(
			'url' => '/inc/df-core/asset/js/admin/install-demo.js',
			'only_slug' => array('df_theme_demo_install')
		),
	);
	
	static $css_files_admin = array(
		'df-meta-box-style' => array(
			'url' => '/inc/df-core/asset/css/admin/metabox.css',
			'only_slug' => ''
		),
		'df-font-awesome-admin' => array(
			'url' => '/inc/df-core/asset/css/admin/font-awesome.min.css',
			'only_slug' => ''
		),
		'no-uo-slider' => array(
			'url' => '/inc/df-core/asset/css/admin/nouislider.css',
			'only_slug' => ''
		),
		'df-ionicons-style' => array(
			'url' => '/inc/df-core/asset/css/ionicons.min.css',
			'only_slug' => ''
		),
		'df-install-demo' => array(
			'url' => '/inc/df-core/asset/css/admin/admin-install-demo.min.css',
			'only_slug' => array('df_theme_demo_install')
		),
	);
	
	static $js_files = array(
		'df-frontend-general-js' => array(
			'url' => '/inc/df-core/asset/js/df-frontend-general.js',
			'only_slug' => ''
		),
	);

	static $css_files = array(
		'df-ionicons-style' => array(
			'url' => '/inc/df-core/asset/css/ionicons.min.css',
			'only_slug' => ''
		),
		'df-styles-css' => array(
			'url' => '/inc/df-core/asset/css/styles.min.css',
			'only_slug' => ''
		),
	);

	static $post_format_style = array (
		'standard_and_gallery'	=> array (
			'layout-1',
			'layout-2',
			'layout-3',
			'layout-4',
			'layout-5',
			'layout-9',
			), 
		'audio_and_video'	=> array (
			'layout-6',
			'layout-7',
			'layout-8',
			'layout-4',
			'layout-5',
			), 
		);

}

?>
