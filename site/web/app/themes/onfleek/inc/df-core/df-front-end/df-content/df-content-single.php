<?php
    $post_setting = self::df_get_post_setting_options();
	$is_related_article = !isset( $post_setting['is_related_article'] ) ? 'no' : $post_setting['is_related_article'];
	$number_of_related_post = !isset( $post_setting['number_of_related_post'] ) ? '0' : $post_setting['number_of_related_post'];
	$is_show_next_prev_post = !isset( $post_setting['is_show_next_prev_post'] ) ? 'no' : $post_setting['is_show_next_prev_post'];
	$is_show_categories_tag = !isset( $post_setting['is_show_categories_tag'] ) ? 'no' : $post_setting['is_show_categories_tag'];
	$is_show_author_name = !isset( $post_setting['is_show_author_name'] ) ? 'no' : $post_setting['is_show_author_name'];
	$is_show_date = !isset( $post_setting['is_show_date'] ) ? 'no' : $post_setting['is_show_date'];
	$is_show_post_views = !isset( $post_setting['is_show_post_views'] ) ? 'no' : $post_setting['is_show_post_views'];
	$is_show_comment_counts = !isset ( $post_setting['is_show_comment_counts'] ) ? 'no' : $post_setting['is_show_comment_counts'];
	$is_show_tag = !isset( $post_setting['is_show_tag'] ) ? 'no' : $post_setting['is_show_tag'];
	$is_show_author_box = !isset( $post_setting['is_show_author_box'] ) ? 'no' : $post_setting['is_show_author_box'];
	$selected_general_post_layout = '';
	$selected_post_layout = '';
	$selected_content_layout = '';
	$selected_post_custom_sidebar = '';
	$selected_featured_image = '';
	$meta_post_format = get_post_format( $post_id ) ? : 'standard' ;
    $selected_general_post_layout  = DF_CSS_Options::$metabox->post_layout;
    $selected_post_layout = DF_CSS_Options::$metabox->layout_global;
	$meta_post_subtitle = DF_CSS_Options::$metabox->subtitle;
    $selected_content_layout = DF_CSS_Options::$metabox->content_layout;
    $selected_featured_image = DF_CSS_Options::$metabox->featured_image;
	$selected_post_custom_sidebar = DF_CSS_Options::$metabox->custom_sidebar;
    $header_type = DF_CSS_Options::$metabox->header_style;

	if( $meta_post_format == 'gallery' ){
		$meta_gallery = DF_CSS_Options::$metabox->galery;
		$meta_content_post_format = $meta_gallery;
	}elseif( $meta_post_format == 'video' || $meta_post_format == 'audio' ){
		$meta_content_post_format = DF_CSS_Options::$metabox->embed;
	} else {
		$meta_content_post_format = '';
	}
?>