<?php
	$selected_article_display = '';
	$selected_post_layout = '';

	/**
	 * get header theme option: template setting / blog & post 
	 * if not available get from global header
	 *
	 * get theme option > general > global header
	 * get theme option > general > content area layout 
	 * default feature image
	 *
	 * get article display preview from blog & post template setting
	 * get layout from blog & post template setting ( full, left & right sidebar )
	 */

	$template_setting = self::df_get_template_setting_options();
	$blogpost = $template_setting['blogpost_template'];
	$pagination=!isset($blogpost['pagination']) ? 'normal-pagination' : $blogpost['pagination'];
	$selected_article_display = $blogpost['article_display_preview']; // article display preview ( theme option->template setting->blogpost )
	$selected_post_layout = $blogpost['layout']; // full, sidebar-left, sidebar-right ( theme option->template setting->blogpost )
	$sidebar_widget = $blogpost['sidebar_widget'];
?>