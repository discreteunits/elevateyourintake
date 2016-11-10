<?php
define("DF_THEME_NAME","Onfleek");

define("DF_THEME_OPTIONS_NAME","df_magz_theme_options");

Class DF_Config_Options {
	
	static function df_init_options(){
		
		DF_Global_Options::$menu_list=array(
			'option_list'=>array(
				'title' => '',
  			'panel_logo' => get_template_directory_uri() .'/inc/df-core/asset/images/logo-to.png',
				'sub_title' => __('Dahz Theme Panel' , 'onfleek' ),
				'options' => array(
					'df_general' => array(
						'text' => __( 'General' , 'onfleek' ),
						'icon' => 'fa fa-cog',
						'view' => '',
						'is_parent' => true,
						'end_child' => false,
						'href' => ''
					),
					'df_global' => array(
						'text' =>  __( 'Global' , 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/general/global.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'global',
						'section_hierarchy' => array('general','global')
					),
					'df_page_transition' => array(
						'text' => __( 'Page Transition', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/general/page-transition.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'page-transition',
						'section_hierarchy' => array('general', 'page_transition')
					),
					
					'df_social_sharing' => array(
						'text' => __( 'Social Sharing', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/general/social-sharing.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'social-sharing',
						'section_hierarchy' => array('general', 'social_sharing')
					),
					'df_breadcrumbs' => array(
						'text' => __( 'Breadcrumbs', 'onfleek'),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/general/breadcrumbs.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'breadcrumbs',
						'section_hierarchy' => array('general', 'breadcrumb')
					),
					'df_custom_code' => array(
						'text' => __( 'Custom Code', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/general/custom-code.php',
						'is_parent' => false,
						'end_child' => true,
						'href' => 'custom-code',
						'section_hierarchy' => array('general', 'custom_code')
					),
					'df_logo' => array(
						'text' => __( 'Logo', 'onfleek' ),
						'icon' => 'fa fa-bookmark',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/logo/logo.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'logo',
						'section_hierarchy' => 'logo'
					),
					'df_header' => array(
						'text' => __( 'Header', 'onfleek' ),
						'icon' => 'fa fa-header',
						'view' => '',
						'is_parent' => true,
						'end_child' => false,
						'href' => ''
						
					),
					'df_header_style_1' => array(
						'text' => __( 'Header Style 1', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/header/header-style-1.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'header-style-1',
						'section_hierarchy' => array('header', 'header_style_1')
					),
					'df_header_style_2' => array(
						'text' => __('Header Style 2' , 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/header/header-style-2.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'header-style-2',
						'section_hierarchy' => array('header', 'header_style_2')
					),
					'df_header_style_3' => array(
						'text' => __( 'Header Style 3', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/header/header-style-3.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'header-style-3',
						'section_hierarchy' => array('header', 'header_style_3')
					),
					'df_header_style_4' => array(
						'text' => __( 'Header Style 4', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/header/header-style-4.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'header-style-4',
						'section_hierarchy' => array('header', 'header_style_4')
					),
					'df_header_style_5' => array(
						'text' => __('Header Style 5' , 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/header/header-style-5.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'header-style-5',
						'section_hierarchy' => array('header', 'header_style_5')
					),
					'df_header_style_6' => array(
						'text' => __( 'Header Style 6', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/header/header-style-6.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'header-style-6',
						'section_hierarchy' => array('header', 'header_style_6')
					),
					'df_sticky_header' => array(
						'text' => __( 'Sticky Header', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/header/sticky-header.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'sticky-header',
						'section_hierarchy' => array('header', 'sticky_header')
					),
					'df_mobile_header' => array(
						'text' => __('Mobile Header' , 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory(). '/inc/df-core/views/admin/df-theme-options/tab-pane/header/mobile-header.php',
						'is_parent' => false,
						'end_child' => true,
						'href' => 'mobile-header',
						'section_hierarchy' => array('header', 'mobile_header')
					),
					'df_menu_options' => array(
						'text' => __('Menu Options' , 'onfleek' ),
						'icon' => 'fa fa-list',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/menu-options/menu-options.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'menu-options',
						'section_hierarchy' => 'menu_options'
					),

					/* generate template setting start here */
					'df_template_setting' => array(
						'text' => __('Template Setting' , 'onfleek' ) ,
						'icon' => 'fa fa-sticky-note',
						'view' => '',
						'is_parent' => true,
						'end_child' => false,
						'href' => ''
					),
					'df_page_template' => array(
						'text' => __( 'Page', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/template-setting/page-template.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'page-template',
						'section_hierarchy' => array('template_setting', 'page_template')
					),
					'df_archive_template' => array(
						'text' => __( 'Archive', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/template-setting/archive-template.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'archive-template',
						'section_hierarchy' => array('template_setting', 'archive_template')
					),
					'df_author_template' => array(
						'text' => __( 'Author', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/template-setting/author-template.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'author-template',
						'section_hierarchy' => array('template_setting', 'author_template')
					),
					'df_tag_template' => array(
						'text' => __( 'Tag', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/template-setting/tag-template.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'tag-template',
						'section_hierarchy' => array('template_setting', 'tag_template')
					),
					'df_search_template' => array(
						'text' => __( 'Search', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/template-setting/search-template.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'search-template',
						'section_hierarchy' => array('template_setting', 'search_template')
					),
					'df_attachment_template' => array(
						'text' => __('Attachment' , 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/template-setting/attachment-template.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'attachment-template',
						'section_hierarchy' => array('template_setting', 'attachment_template')
					),
					'df_blogpost_template' => array(
						'text' => __( 'Blog & Post', 'onfleek' ) ,
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/template-setting/blogpost-template.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'blogpost-template',
						'section_hierarchy' => array('template_setting', 'blogpost_template')
					),
					'df_404_template' => array(
						'text' => __( '404', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/template-setting/404-template.php',
						'is_parent' => false,
						'end_child' => true,
						'href' => '404-template',
						'section_hierarchy' => array('template_setting', '404_template')
					),
					/* generate template setting end here */

					/* generate Post Setting start here */
					'df_post_setting' => array(
						'text' => __( 'Post Setting', 'onfleek' ),
						'icon' => 'fa fa-paint-brush',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/post-setting/post-setting.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'post-setting',
						'section_hierarchy' => 'post_setting'
					),

					/* generate Post Setting end here */
					/* generate categories start here */
					'df_categories' => array(
						'text' => __( 'Categories', 'onfleek' ),
						'icon' => 'fa fa-copy',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/categories/categories.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'categories',
						'section_hierarchy' => 'categories'
					),
					/* generate categories end here */
					/* generate footer start here */
					'df_footer' => array(
						'text' => __( 'Footer', 'onfleek' ),
						'icon' => 'fa fa-paint-brush',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/footer/footer.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'footer',
						'section_hierarchy' => 'footer'
					),
					/* generate footer end here */
					/* generate sidebars start here */
					'df_sidebars' => array(
						'text' => __( 'Sidebars', 'onfleek' ),
						'icon' => 'fa fa-paint-brush',
						'view' => '',
						'is_parent' => true,
						'end_child' => false,
						'href' => 'sidebars'
					),
					'df_sidebars_option' => array(
						'text' => __( 'Sidebar Option', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/sidebars/sidebar-option.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'sidebars-option',
						'section_hierarchy' => 'sidebars'
					),
					'df_additional_sidebars' => array(
						'text' => __( 'Additional Sidebar', 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/sidebars/additional-sidebar.php',
						'is_parent' => false,
						'end_child' => true,
						'href' => 'additional-sidebar',
						'section_hierarchy' => array('sidebars', 'additional')
					),
					/* generate sidebars end here */
					/* generate color / style start here */
					'df_color_style' => array(
						'text' => __( 'Color / Styling', 'onfleek' ),
						'icon' => 'fa fa-tint',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/color-style/color-style.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'color-style',
						'section_hierarchy' => 'color_style'
					),
					/* generate color / style end here */
					/* generate typography start here */
					'df_typography' => array(
						'text' => __('Typography', 'onfleek' ),
						'icon' => 'fa fa-font',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/typography/typography.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'typography',
						'section_hierarchy' => 'typography'
					),
					/* generate typography end here */
					/* generate social account start here */
					'df_social_account' => array(
						'text' => __('Social Account' , 'onfleek' ),
						'icon' => 'fa fa-comments-o',
						'view' => '',
						'is_parent' => true,
						'end_child' => false,
						'href' => 'social-account',
						'section_hierarchy' => 'social_account'
					),
					'df_account_network' => array(
						'text' => __('Account Network' , 'onfleek' ),
						'icon' => '',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/social-account/account-network.php',
						'is_parent' => false,
						'end_child' => true,
						'href' => 'account-network',
						'section_hierarchy' => array('social_account','account')
					),
					/* generate social account end here */
					/* generate ads start here */
					'df_advertisment' => array(
						'text' => __( 'Advertisement', 'onfleek' ),
						'icon' => 'fa fa-thumb-tack',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/advertisment/advertisement.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'advertisment',
						'section_hierarchy' => 'advertisments'
					),
					/* generate ads end here */
					/* generate side area options start here */
					'df_sidearea_options' => array(
						'text' => __('Side Area Options' , 'onfleek' ),
						'icon' => 'fa fa-wrench',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/sidearea/sidearea.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'sidearea-options',
						'section_hierarchy' => 'side_area'
					),
					/* generate side area options end here */
					/* generate Demo Import start here */
					'df_demo_import' => array(
						'text' => __( 'Backup/Restore', 'onfleek' ),
						'icon' => 'fa fa-download',
						'view' => get_template_directory() .'/inc/df-core/views/admin/df-theme-options/tab-pane/demo-import/demo-import.php',
						'is_parent' => false,
						'end_child' => false,
						'href' => 'demo-import',
						'section_hierarchy' => 'import'
					),
					/* generate Demo Import end here */
				)
			)
		);
		
	}
	
}
?>
