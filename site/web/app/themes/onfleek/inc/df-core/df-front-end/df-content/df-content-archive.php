<?php
	$selected_article_display = '';
	$selected_archive_layout = '';
	$content_layout_type = '';
	
	$general = self::df_get_general_options(); // get general options
	$global = $general['global']; // get general -> global options

	$content_layout_type = $global['layout'];
	$template_setting = self::df_get_template_setting_options();
	$pagination = isset($template_setting['archive_template']['pagination']) ? $template_setting['archive_template']['pagination'] : 'normal-pagination';
	if( is_tag() ){// tag archive
		$tag_setting = self::df_get_template_setting_options();
		$tag_template = $tag_setting['tag_template'];

		$pagination = isset($tag_template['pagination']) ? $tag_template['pagination'] : 'normal-pagination';
		$tag_article_display = $tag_template['article_display_preview'];
		$tag_layout = $tag_template['layout'];
        $tag_sidebar = $tag_template['sidebar_widget'];

        $selected_article_display = ( empty( $tag_article_display ) ) ? 'layout-1' : $tag_article_display;
        $selected_layout = ( empty( $tag_layout ) ) ? 'fullwidth' : $tag_layout;
        $selected_sidebar = ( empty( $tag_sidebar ) ) ? 'sidebar-1' : $tag_sidebar;

	}else if( is_author() ){ // author archive
		$author_setting = self::df_get_template_setting_options();
		$author_template = $author_setting['author_template'];
		$pagination = isset($author_template['pagination']) ? $author_template['pagination'] : 'normal-pagination';
		$author_article_display = $author_template['article_display_preview'];
		$author_layout = $author_template['layout'];
        $author_sidebar = $author_template['sidebar_widget'];

        $selected_article_display = ( empty( $author_article_display ) ) ? 'layout-1' : $author_article_display;
		$selected_layout = ( empty( $author_layout ) ) ? 'fullwidth' : $author_layout;
        $selected_sidebar = ( empty( $author_sidebar ) ) ? 'sidebar-1' : $author_sidebar;

	}else if( is_date() ){ // date archive
		// $title_archive = 'Date Archive';
		$template_setting = self::df_get_template_setting_options();
		$archive_template = $template_setting['archive_template'];
		$archive_article_display = $archive_template['article_display_preview'];
		$archive_layout = $archive_template['layout'];
        $archive_sidebar = $archive_template['sidebar_widget'];

        $selected_article_display = ( empty( $archive_article_display ) ) ? 'layout-1' : $archive_article_display;
		$selected_layout = ( empty( $archive_layout ) ) ? 'fullwidth' : $archive_layout;
		$selected_sidebar = ( empty( $archive_sidebar ) ) ? 'sidebar-1' : $archive_sidebar;

	}else if( is_category() ){ // category archive
        $params_setting['is_breadcrumbs'] = $breadcrumb_status;
		// $params_setting['default_featured_img'] = $default_featured_img;
        // get global option from general 
		$general = self::df_get_general_options();
        $global = $general['global'];
        
        // get categories global options
		$categories = self::df_get_categories_options();
        
        //get setting per category
        $category = get_query_var('cat');
        $current_category = get_category ($category);
        
        if( !isset( $categories['per_category'][$current_category->term_id] )){
            $params_setting['option_layout_type'] = $global['layout'];
            $content_layout_type = $global['layout'];
            $params_setting['category_title_template'] = $categories['category_title_template'];
            $params_setting['category_top_post_style']= $categories['category_top_post_style'];
            $params_setting['archive_option_article_display']= $categories['article_display_preview'];
            $params_setting['pagination']= $categories['pagination'];
            $params_setting['archive_layout']= $categories['category_layout'];
            $params_setting['sidebar_widget']= $categories['sidebar_widget'];
            return;
        }else{
            $per_category = $categories['per_category'][$current_category->term_id];
            $params_setting['category_color'] = ( empty( $per_category['category_color'] ) ) ? '' : $per_category['category_color'];
           
            if( !isset( $per_category['category_title_template'] ) || ( $per_category['category_title_template'] == '' || $per_category['category_title_template'] == 'default')  ){
                $params_setting['category_title_template'] = $categories['category_title_template'];
            }else{
                $params_setting['category_title_template']= $per_category['category_title_template'];
            }
            
            if ( !isset( $per_category['category_top_post_style'] ) || ( $per_category['category_top_post_style'] == '' || $per_category['category_top_post_style'] == 'default' ) ){
                $params_setting['category_top_post_style']= $categories['category_top_post_style'];
            }else{
                $params_setting['category_top_post_style']= $per_category['category_top_post_style'];
            }
            
            if ( !isset( $per_category['article_display_preview'] ) || ( $per_category['article_display_preview'] == '' || $per_category['article_display_preview'] == 'default' ) ){
                $params_setting['archive_option_article_display']= $categories['article_display_preview'];
            }else{
                $params_setting['archive_option_article_display']= $per_category['article_display_preview'];
            }
            if ( isset( $per_category['pagination'] ) ) {
               if ( 'default' === $per_category['pagination'] || !isset( $per_category['pagination'] ) ){
                    $params_setting['pagination']= $categories['pagination'];
                }else{
                    $params_setting['pagination']= $per_category['pagination'];
                } 
            }else{
                $params_setting['pagination'] = 'normal-pagination';
            }
            // category layout : full, sidebar-left, sidebar-right
            if(!isset( $per_category['category_layout'] ) || ( $per_category['category_layout'] == '' || 'default' === $per_category['category_layout'] ) ){
                $params_setting['archive_layout']= $categories['category_layout'];
            }else{
                $params_setting['archive_layout']= $per_category['category_layout'];
            }  
            // content area layout : full, boxed, frame
            if( !isset( $per_category['content_area_layout'] ) || ( $per_category['content_area_layout'] == '' || 'default' === $per_category['content_area_layout'] ) ){
                $params_setting['option_layout_type'] = $global['layout'];
                $content_layout_type = $global['layout'];
            }else{
                $params_setting['option_layout_type'] = $per_category['content_area_layout'];
                $content_layout_type = $per_category['content_area_layout'];
            }
            
            if ( empty( $per_category['sidebar_widget'] )){
                $params_setting['sidebar_widget']= $categories['sidebar_widget'];
            }else{
                $params_setting['sidebar_widget']= $per_category['sidebar_widget'];
            }  
        }

        $params_setting['bg_color'] = ( empty( $per_category['bg_color'] ) ) ? $global['bg_color']: $per_category['bg_color'];
        $params_setting['bg_position'] = ( empty( $per_category['bg_position'] ) ) ?  $global['bg_position'] : $per_category['bg_position'];
        $params_setting['bg_repeat'] = (empty(  $per_category['bg_repeat'] ) ) ?  $global['bg_repeat'] : $per_category['bg_repeat'];
        $params_setting['bg_attachment'] = (empty( $per_category['bg_attachment'] )) ? $global['bg_attachment'] : $per_category['bg_attachment'];        
        $params_setting['bg_size'] = (empty(  $per_category['bg_size'] )) ? $global['bg_size'] : $per_category['bg_size'];
        $params_setting['bg'] = (empty(  $per_category['bg'] )) ? $global['bg_img'] : $per_category['bg'];
    }else{

    }

