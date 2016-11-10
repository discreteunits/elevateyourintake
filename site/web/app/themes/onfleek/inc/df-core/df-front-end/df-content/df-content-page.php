<?php
$selected_general_page_layout = DF_CSS_Options::$metabox->post_layout;
$selected_global_page_content_layout = DF_CSS_Options::$metabox->global_content_layout;
$selected_page_content_layout = DF_CSS_Options::$metabox->content_layout;
$selected_custom_sidebar = DF_CSS_Options::$metabox->custom_sidebar;
$page_type = DF_CSS_Options::$metabox->page_template;

if( is_page_template( 'page-pagebuilder-witharchive.php') ){
	$page_type = 'pagebuilder-witharchive';
	$selected_post_setting_layout = DF_CSS_Options::$metabox->page_post_layout;
	$meta_ps_show_listtitle = DF_CSS_Options::$metabox->page_show_list_title;
	$meta_ps_list_title = DF_CSS_Options::$metabox->page_list_title;
	$meta_pagination = DF_CSS_Options::$metabox->page_pagination;
	$meta_ps_filter_post_id = DF_CSS_Options::$metabox->page_post_id_filter;
	$meta_ps_filter_category = DF_CSS_Options::$metabox->page_category_filter;
	$meta_ps_filter_multi_category = DF_CSS_Options::$metabox->page_multi_category_filter;
	$meta_ps_filter_by_tag = DF_CSS_Options::$metabox->page_filter_by_tag;
	$meta_ps_filter_multi_author = DF_CSS_Options::$metabox->page_filter_by_author;
	$meta_ps_sort_order = DF_CSS_Options::$metabox->page_sort_order;
	$meta_ps_limit_post_order = DF_CSS_Options::$metabox->page_max_number_of_post;
	$meta_ps_offset_post = DF_CSS_Options::$metabox->page_offset_post;
	$filter_use = '';
	$post_setting_param = '';
	
	if( !empty( $meta_ps_filter_post_id )){
		$filter_use = 'post_id';
		$post_setting_param = $meta_ps_filter_post_id;
	}else if (!empty( $meta_ps_filter_category ) ) {
		if( $meta_ps_filter_category != 'all' ){
			$filter_use = 'category';
			$post_setting_param = $meta_ps_filter_category;
		}else{
			$filter_use = 'all';
			$post_setting_param = '';
		}
	}else if( !empty( $meta_ps_filter_multi_category ) ){
		$filter_use = 'multi_category';
		$post_setting_param = $meta_ps_filter_multi_category;
	}else if( !empty( $meta_ps_filter_by_tag ) ){
		$filter_use = 'tag';
		$post_setting_param = $meta_ps_filter_by_tag;
	}else if( !empty( $meta_ps_filter_multi_author ) ){
		$filter_use = 'author';
		$post_setting_param = $meta_ps_filter_multi_author;
	}


	$post_setting = array(
		'page_post_layout'	=> $selected_post_setting_layout,
		'show_listitle'	=> $meta_ps_show_listtitle,
		'list_title'	=> $meta_ps_list_title,
		'filter_use' => $filter_use,
		'sort_order' => $meta_ps_sort_order,
		'limit_post_order' => $meta_ps_limit_post_order,
		'offset_post' => $meta_ps_offset_post,
		'page_type'	=> $page_type,
		'post_setting_param' => $post_setting_param,
	);
	
	$params_setting = array(
		'page_type'				=> $page_type,
		'pagination_type'		=> $meta_pagination,
		'general_page_layout' 	=> $selected_general_page_layout,
        'general_option_layout_type' => $selected_global_page_content_layout,
		'option_layout_type'   	=> $selected_page_content_layout,
		'option_bg_type' 		=> 'df-bg',
		'post_setting'			=> $post_setting,
		'breadcrumb'			=> $breadcrumb_status,	
		'default_featured_img'	=> $default_featured_img,
		'custom_sidebar' 		=> $selected_custom_sidebar,
	);
}else if( is_page_template( 'page-pagebuilder.php') ) {
	$page_type = 'pagebuilder';
	$post_setting = array('page_type'	=> $page_type,);
	$params_setting = array(
		'page_type'				=> $page_type,
		'general_page_layout' 	=> $selected_general_page_layout,
        'general_option_layout_type' => $selected_global_page_content_layout,
		'option_layout_type'   	=> $selected_page_content_layout,
		'option_bg_type' 		=> 'df-bg',
		'post_setting'			=> $post_setting,
		'breadcrumb'			=> $breadcrumb_status,	
		'default_featured_img'	=> $default_featured_img,
		'custom_sidebar' 		=> $selected_custom_sidebar
	);
}else{
	$page_type = 'default';
	$post_setting = array('page_type' => $page_type,);
	$params_setting = array(
		'page_type'				=> $page_type,
		'general_page_layout' 	=> $selected_general_page_layout,
        'general_option_layout_type' => $selected_global_page_content_layout,
		'option_layout_type'   	=> $selected_page_content_layout,
		'option_bg_type' 		=> 'df-bg',
		'post_setting'			=> $post_setting,
		'breadcrumb'			=> $breadcrumb_status,	
		'default_featured_img'	=> $default_featured_img,
		'custom_sidebar' 		=> $selected_custom_sidebar
	);
}