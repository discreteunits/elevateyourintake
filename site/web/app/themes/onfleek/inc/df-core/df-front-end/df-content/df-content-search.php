<?php
	
	$selected_article_display = '';
	$selected_archive_layout = '';
	$content_layout_type = '';
	$default_featured_img = '';
	
	$general = self::df_get_general_options(); // get general options
	$global = $general['global']; // get general -> global options

	$content_layout_type = $global['layout'];
	$default_featured_img = $global['default_feature_image'];

	$template_setting = self::df_get_template_setting_options();
	$pagination=isset($template_setting['search_template']['pagination']) ? $template_setting['search_template']['pagination'] : 'normal-pagination';
	$archive_template = $template_setting['search_template'];
	$archive_article_display = $archive_template['article_display_preview'];
	$archive_layout = $archive_template['layout'];
	$search_sidebar = $archive_template['sidebar_widget'];

	if( empty( $archive_article_display ) ){
		$selected_article_display = 'layout-1';
	}else{
		$selected_article_display = $archive_article_display;
	}

	if( empty( $archive_layout ) ){
		
		$selected_layout = 'fullwidth';

	}else{

		$selected_layout = $archive_layout;
	}
