<?php

	$selected_article_display = '';
	$selected_layout_type = '';
	$content_layout_type = '';
	$default_featured_img = '';
	$title404 = '';
	$subtitle404 = '';

	$general = self::df_get_general_options(); // get general options
	$global = $general['global']; // get general -> global options

	$content_layout_type = $global['layout'];
	$default_featured_img = $global['default_feature_image'];

	$template_setting = self::df_get_template_setting_options();
	$notfound_template = $template_setting['404_template'];
	$notfound_title = $notfound_template['title'];
	$notfound_subtitle = $notfound_template['subtitle'];
	$notfound_article_display = $notfound_template['article_display_preview'];
	$notfound_layout = $notfound_template['layout_404'];

	if( empty( $notfound_article_display ) ){
		$selected_article_display = 'layout-1';
	}else{
		$selected_article_display = $notfound_article_display;
	}

	if( empty( $notfound_layout ) ){
		
		$selected_layout_type = $content_layout_type;

	}else{

		$selected_layout_type = $notfound_layout;
	}

	if( empty( $notfound_title ) ){
		$title404 = '404 SURF&rsquo;S UP!';
	}else{
		$title404 = $notfound_title;
	}

	if( empty( $notfound_subtitle ) ){
		$subtitle404 = 'But the page you were looking for appears to be down. Sorry about that.';
	}else{
		$subtitle404 = $notfound_subtitle;
	}