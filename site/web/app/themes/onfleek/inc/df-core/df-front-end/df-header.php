<?php
/**
 * Class: DF_Header
 * Description: Class for call header layout
 */

if( !class_exists('DF_Header') ){

	require get_template_directory() . '/inc/df-core/views/df-header-view.php';

	Class DF_Header extends DF_Options {

		// $prefix = 'df_magz_post';
		static $header_layout_post = 'df_magz_post_header_type';
		static $header_topbar_post = 'df_magz_post_top_bar';
		static $content_layout_post = 'df_magz_post_content_layout';

		static $header_layout_page = 'df_magz_page_header_type';
		static $header_topbar_page = 'df_magz_page_top_bar';
		static $content_layout_page = 'df_magz_page_content_layout';

		static $header_layout_use = '';
		static $header_parameter_setting;
		/**
		 * __construct
		 */
		function __construct() {}

		/**
		 * df_get_header_layout
		 * @return $selected_layout_type [type layout of header: boxed, fullboxed, fullwidth]
		 */
		static function df_get_header_layout() {
			$post_id = '';
			$general = self::df_get_general_options();
			$global = $general['global']; 
			$selected_layout_type = '';
			$page_type =  self::get_page_type();
			switch($page_type){
				case 'df_single':
					if( is_attachment() ){
						$selected_header_layout = '';
						$selected_topbar_status = '';						
						$template_setting = self::df_get_template_setting_options();
						$attachment_template = $template_setting['attachment_template'];
						$header = $attachment_template['header_layout'];

						if( $header == 'inherit' ){
							$general = self::df_get_general_options();
							$global = $general['global'];
							$selected_layout_type = self::df_parse_header_option($global['header_layout']);
						}else{
							$selected_layout_type = self::df_parse_header_option($header);
						}
					}else{
						$meta_layout = DF_CSS_Options::$metabox->header_style;
						$h = explode( "-", $meta_layout );
						$selected = $h[0]."_style_".$h[1];
						extract( self::df_get_header_selected( $selected ) );
						if( $selected == 'header_style_6'){
							$selected_layout_type = '';
						}else{
							$selected_layout_type = $header_layout;	
						}
					}
				break;
				case 'df_page':
					$meta_layout = DF_CSS_Options::$metabox->header_style;
					$selected_layout_type = self::df_parse_header_option($meta_layout);
				break;
				case 'df_archive':
					if( is_tag() ){
						$selected_header_layout = '';
						$selected_topbar_status = '';
						$template_setting = self::df_get_template_setting_options();
						$tag_template = $template_setting['tag_template'];
						$header = $tag_template['header_layout'];
						if( $header == 'inherit' ){
							$selected_layout_type = self::df_parse_header_option($global['header_layout']);
						}else{
							$selected_layout_type = self::df_parse_header_option($header);
						}
					}else if( is_author() ){
						$selected_header_layout = '';
						$selected_topbar_status = '';
						$template_setting = self::df_get_template_setting_options();
						$author_template = $template_setting['author_template'];
						$header = $author_template['header_layout'];
						if( $header == 'inherit' ){
							$selected_layout_type = self::df_parse_header_option($global['header_layout']);
						}else{
							$selected_layout_type = self::df_parse_header_option($header);
						}
					}else if( is_date() ){
						$selected_header_layout = '';
						$selected_topbar_status = '';
						$template_setting = self::df_get_template_setting_options();
						$archive_template = $template_setting['archive_template'];
						$header = $archive_template['header_layout'];
						if( $header == 'inherit' ){
							$selected_layout_type = self::df_parse_header_option($global['header_layout']);
						}else{
							$selected_layout_type = self::df_parse_header_option($header);
						}
					}else if( is_category() ){
						$categories = self::df_get_categories_options();
						$categories_header = !isset( $categories['header_layout'] ) ? 'inherit' : $categories['header_layout'];
						//get setting per category
						$category = get_query_var('cat');
						$current_category = get_category ($category);
						if(isset($categories['per_category'][$current_category->term_id])){
							$per_category=$categories['per_category'][$current_category->term_id];
						}

						if( !isset( $per_category['header_layout'] ) || $per_category['header_layout'] == 'inherit' || $per_category['header_layout'] == 'default' || $per_category['header_layout'] == '' ){
							if(  $categories_header == 'inherit' ){
								$global_header = $global['header_layout'];
								$content_layout_type = $global['layout'];	

								$h = explode( "-", $global_header );
								$selected = $h[0]."_style_".$h[1];
								extract( DF_Options::df_get_header_selected( $selected ) );

								$selected_header_layout = $global_header;
								if( $selected == 'header_style_6'){
									$selected_layout_type = '';
								}else{
									$selected_layout_type = $header_layout;	
								}
							}else{
								$h = explode( "-", $categories_header );
								$selected = $h[0]."_style_".$h[1];
								extract( self::df_get_header_selected( $selected ) );
								$selected_header_layout = $categories_header;

								if( $selected == 'header_style_6'){
									$selected_layout_type = '';
								}else{
									$selected_layout_type = $header_layout;	
								}
							}
						} else {
							$global_header = $global['header_layout'];
							$content_layout_type = $global['layout'];	
							$h = explode( "-", $per_category['header_layout'] );
							$selected = $h[0]."_style_".$h[1];
							extract( DF_Options::df_get_header_selected( $selected ) );

							$selected_header_layout = $per_category['header_layout'];
							if( $selected == 'header_style_6'){
								$selected_layout_type = '';
							}else{
								$selected_layout_type = $header_layout;	
							}
						}
					}else{
						$selected_header_layout = '';
						$selected_topbar_status = '';
						$template_setting = self::df_get_template_setting_options();
						$archive_template = $template_setting['archive_template'];
						$header = $archive_template['header_layout'];
						if( $header == 'inherit' ){
							$selected_layout_type = self::df_parse_header_option($global['header_layout']);
						}else{
							$selected_layout_type = self::df_parse_header_option($header);
						}
					}
				break;
				case 'df_home':
					$selected_header_layout = '';
					$selected_topbar_status = '';
					$template_setting = self::df_get_template_setting_options();
					$blogpost = $template_setting['blogpost_template'];
					$header = $blogpost['header_layout'];

					if( $header == 'inherit' ){
						$selected_layout_type = self::df_parse_header_option($global['header_layout']);
					}else{
						$selected_layout_type = self::df_parse_header_option($header);
					}
				break;
				case 'df_search':
					$selected_header_layout = '';
					$selected_topbar_status = '';
					$template_setting = self::df_get_template_setting_options();
					$search_template = $template_setting['search_template'];
					$header = $search_template['header_layout'];
					// template_setting[search_template][header_layout]
					if( $header == 'inherit' ){
						$selected_layout_type = self::df_parse_header_option($global['header_layout']);
					}else{
						$selected_layout_type = self::df_parse_header_option($header);
					}
				break;
				case 'df_not_found':
					$selected_header_layout = '';
					$selected_topbar_status = '';
					$template_setting = self::df_get_template_setting_options();
					$notfound_template = $template_setting['404_template'];
					$header = $notfound_template['header_layout'];
					// template_setting[404_template][header_layout]
					if( $header == 'inherit' ){
						$selected_layout_type = self::df_parse_header_option($global['header_layout']);
					}else{
						$selected_layout_type = self::df_parse_header_option($header);
					}
				break;
			}
			return $selected_layout_type;
		}

		/**
		 * df_get_header
		 * @param -
		 * @return -
		 */
		static function df_get_header() {
			$method =  self::get_page_type();
			self::$method();
		}
        
        /**
         * df_get_stickheader
         */
        static function df_get_stickheader(){
             $df_theme_options = self::df_get_all_options();
             $sticky_header = isset ( $df_theme_options['logo']['sticky_header'] ) ? $df_theme_options['logo']['sticky_header'] : NULL;
             $sticky_output = "";
             if ( NULL != $sticky_header ){
                $sticky_output = esc_url($sticky_header);
             } else {
                $sticky_output = "";
             }
             return $sticky_output;
        }
		
		/**
		 * method archive
		 * call by df_get_header()
		 */
		static function df_archive(){
			$selected_header_layout = '';
			$selected_topbar_status = '';
			$selected_layout_type = '';
			$selected_search = '';
			$is_social_icon_topbar = '';
			$selected_content_layout_type='';
			$general = self::df_get_general_options(); // get general options
			$global = $general['global']; // get general -> global options

			if( is_tag() ){ // TAG
				
				$template_setting = self::df_get_template_setting_options();
				$tag_template = $template_setting['tag_template'];
				$tag_header = !isset($tag_template['header_layout']) ? 'inherit' : $tag_template['header_layout'];
				
				if( $tag_header == 'inherit' ){
					$global_header = $global['header_layout'];	
					$global_topbar = $global['is_topbar'];
					$content_layout_type = $global['layout'];	

					$h = explode( "-", $global_header );
					$selected = $h[0]."_style_".$h[1];
					extract( DF_Options::df_get_header_selected( $selected ) );

					$selected_header_layout = $global_header;
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}

					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
				}else{
					$h = explode( "-", $tag_header );
					$selected = $h[0]."_style_".$h[1];
					extract( self::df_get_header_selected( $selected ) );

					$global_topbar = $global['is_topbar'];
					$content_layout_type = $global['layout'];	
					
					$selected_header_layout = $tag_header;
					
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}

					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
				}

			}else if( is_author() ){ // AUTHOR
				$template_setting = self::df_get_template_setting_options();
				$author_template = $template_setting['author_template'];
				$author_header = !isset($author_template['header_layout']) ? 'inherit' : $author_template['header_layout'];
				
				if( $author_header == 'inherit' ){

					$global_header = $global['header_layout'];	
					$global_topbar = $global['is_topbar'];
					$content_layout_type = $global['layout'];	

					$h = explode( "-", $global_header );
					$selected = $h[0]."_style_".$h[1];
					extract( DF_Options::df_get_header_selected( $selected ) );

					$selected_header_layout = $global_header;
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}

					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
				}else{
					$h = explode( "-", $author_header );
					$selected = $h[0]."_style_".$h[1];
					extract( self::df_get_header_selected( $selected ) );

					$global_topbar = $global['is_topbar'];
					$content_layout_type = $global['layout'];

					$selected_header_layout = $author_header;

					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}
					
					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
				}
			
			}else if( is_date() ){ // DATE
				$template_setting = self::df_get_template_setting_options();
				$date_template = $template_setting['archive_template'];
				$date_header = !isset($date_template['header_layout']) ? 'inherit' : $date_template['header_layout'];
				
				if(  $date_header == 'inherit' ){
					$global_header = $global['header_layout'];	
					$global_topbar = $global['is_topbar'];
					$content_layout_type = $global['layout'];	

					$h = explode( "-", $global_header );
					$selected = $h[0]."_style_".$h[1];
					extract( DF_Options::df_get_header_selected( $selected ) );

					$selected_header_layout = $global_header;
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}

					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
				}else{
					$h = explode( "-", $date_header );
					$selected = $h[0]."_style_".$h[1];
					extract( self::df_get_header_selected( $selected ) );

					$content_layout_type = $global['layout'];
					$global_topbar = $global['is_topbar'];

					$selected_header_layout = $date_header;

					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}
					
					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
				}
			
			}else if( is_category() ){ // CATEGORY ARCHIVE
				 // get categories global options
				$categories = self::df_get_categories_options();
		        
				$categories_header = !isset( $categories['header_layout'] ) ? 'inherit' : $categories['header_layout'];

				//get setting per category
				$category = get_query_var('cat');
				$current_category = get_category ($category);
				if(isset($categories['per_category'][$current_category->term_id])){
					$per_category=$categories['per_category'][$current_category->term_id];
				}
			
				if( !isset( $per_category['header_layout'] ) || $per_category['header_layout'] == 'inherit' || $per_category['header_layout'] == 'default' || $per_category['header_layout'] == ''){
					
					if(  $categories_header == 'inherit' ){
						$global_header = $global['header_layout'];	
						$global_topbar = $global['is_topbar'];
						$content_layout_type = $global['layout'];	

						$h = explode( "-", $global_header );
						$selected = $h[0]."_style_".$h[1];
						extract( DF_Options::df_get_header_selected( $selected ) );

						$selected_header_layout = $global_header;
						if( $selected == 'header_style_6'){
							$selected_layout_type = '';
						}else{
							$selected_layout_type = $header_layout;	
						}

						$selected_content_layout_type = $content_layout_type;
						$selected_search = $search;
						$selected_topbar_status = $global_topbar;
						$is_social_icon_topbar = $social_icon_topbar;
					}else{
						$h = explode( "-", $categories_header );
						$selected = $h[0]."_style_".$h[1];
						extract( self::df_get_header_selected( $selected ) );

						$content_layout_type = $global['layout'];
						$global_topbar = $global['is_topbar'];

						$selected_header_layout = $categories_header;

						if( $selected == 'header_style_6'){
							$selected_layout_type = '';
						}else{
							$selected_layout_type = $header_layout;	
						}
						
						$selected_content_layout_type = $content_layout_type;
						$selected_search = $search;
						$selected_topbar_status = $global_topbar;
						$is_social_icon_topbar = $social_icon_topbar;
						
					}
					
				} else {
					
						$h = explode( "-", $per_category['header_layout'] );
						$selected = $h[0]."_style_".$h[1];
						extract( self::df_get_header_selected( $selected ) );

						$content_layout_type = $global['layout'];
						$global_topbar = $global['is_topbar'];

						$selected_header_layout = $per_category['header_layout'];

						if( $selected == 'header_style_6'){
							$selected_layout_type = '';
						}else{
							$selected_layout_type = $header_layout;	
						}
						
						$selected_content_layout_type = $content_layout_type;
						$selected_search = $search;
						$selected_topbar_status = $global_topbar;
						$is_social_icon_topbar = $social_icon_topbar;
					
				}
			}else{
				$template_setting = self::df_get_template_setting_options();
				$archive_template = $template_setting['archive_template'];
				$archive_header = $archive_template['header_layout'];
				
				if( empty($archive_header) ){
					$global_header = $global['header_layout'];	
					$global_topbar = $global['is_topbar'];
					$content_layout_type = $global['layout'];	

					$h = explode( "-", $global_header );
					$selected = $h[0]."_style_".$h[1];
					extract( DF_Options::df_get_header_selected( $selected ) );

					$selected_header_layout = $global_header;
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}

					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
				}else{	
					if($archive_header=='inherit'){
						$global_header = $global['header_layout'];	
					$global_topbar = $global['is_topbar'];
					$content_layout_type = $global['layout'];	

					$h = explode( "-", $global_header );
					$selected = $h[0]."_style_".$h[1];
					extract( DF_Options::df_get_header_selected( $selected ) );

					$selected_header_layout = $global_header;
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}

					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
					} else {
						$h = explode( "-", $archive_header );
						$selected = $h[0]."_style_".$h[1];
						extract( self::df_get_header_selected( $selected ) );

						$content_layout_type = $global['layout'];
						$global_topbar = $global['is_topbar'];	
						
						$selected_header_layout = $archive_header;
						if( $selected == 'header_style_6'){
							$selected_layout_type = '';
						}else{
							$selected_layout_type = $header_layout;	
						}
						
						$selected_content_layout_type = $content_layout_type;
						$selected_search = $search;
						$selected_topbar_status = $global_topbar;
						$is_social_icon_topbar = $social_icon_topbar;
					}
				}
			}

			$sos = self::df_get_social_account_options();
			$acc = $sos['account'];
			$params_setting = array(
				'rss'					=> $acc['rss'],
				'facebook'				=> $acc['facebook'],
				'twitter'				=> $acc['twitter'],
				'google_plus'			=> $acc['google_plus'],
				'linkedin'				=> $acc['linkedin'],
				'youtube'				=> $acc['youtube'],
				'vimeo'					=> $acc['vimeo'],
				'vk'					=> $acc['vk'],
				'instagram'				=> $acc['instagram'],
				'pinterest'				=> $acc['pinterest'],
				'flickr'				=> $acc['flickr'],
				'bloglovin'				=> $acc['bloglovin'],
				'spotify'				=> $acc['spotify'],
				'meta_layout' 			=> $selected_header_layout,
				'meta_topbar' 			=> $selected_topbar_status,
				'social_icon_topbar'	=> $is_social_icon_topbar,
				'layout_type' 			=> $selected_layout_type,
				'content_layout_type' 	=> $selected_content_layout_type,
				'search'				=> $selected_search,
				'side_area' 			=> self::df_show_side_area()
			);

			// self::df_set_header_layout( $selected_header_layout );
			self::$header_parameter_setting = $params_setting;
			DF_Header_View::df_load_header( $params_setting );
		}
		
		/**
		 * method single
		 * call by df_get_header()
		 */
		static function df_single(){
			if( is_attachment() ){
				$selected_header_layout = '';
				$selected_topbar_status = '';
				$selected_layout_type = '';
				$selected_search = '';
				$is_social_icon_topbar = '';
				
				$general = self::df_get_general_options(); // get general options
				$global = $general['global']; // get general -> global options
				
				$template_setting = self::df_get_template_setting_options();
				$attachment_template = $template_setting['attachment_template'];
				$attachment_header = !isset($attachment_template['header_layout']) ? 'inherit' : $attachment_template['header_layout'];
				
				if( $attachment_header == 'inherit' ){
					
					$global_header = $global['header_layout'];	
					$global_topbar = $global['is_topbar'];
					$content_layout_type = $global['layout'];	

					$h = explode( "-", $global_header );
					$selected = $h[0]."_style_".$h[1];
					extract( self::df_get_header_selected( $selected ) );

					$selected_header_layout = $global_header;
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}

					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
				}else{
					
					$h = explode( "-", $attachment_header );
					$selected = $h[0]."_style_".$h[1];
					extract( self::df_get_header_selected( $selected ) );

					$global_topbar = $global['is_topbar'];
					$content_layout_type = $global['layout'];	
					
					$selected_header_layout = $attachment_header;
					
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}

					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$selected_topbar_status = $global_topbar;
					$is_social_icon_topbar = $social_icon_topbar;
				}
				$sos = self::df_get_social_account_options();
				$acc = $sos['account'];
				$params_setting = array(
					'rss'					=> $acc['rss'],
					'facebook'				=> $acc['facebook'],
					'twitter'				=> $acc['twitter'],
					'google_plus'			=> $acc['google_plus'],
					'linkedin'				=> $acc['linkedin'],
					'youtube'				=> $acc['youtube'],
					'vimeo'					=> $acc['vimeo'],
					'vk'					=> $acc['vk'],
					'instagram'				=> $acc['instagram'],
					'pinterest'				=> $acc['pinterest'],
					'flickr'				=> $acc['flickr'],
					'bloglovin'				=> $acc['bloglovin'],
					'spotify'				=> $acc['spotify'],
					'meta_layout' 			=> $selected_header_layout,
					'meta_topbar' 			=> $selected_topbar_status,
					'social_icon_topbar'	=> $is_social_icon_topbar,
					'layout_type' 			=> $selected_layout_type,
					'content_layout_type' 	=> $selected_content_layout_type,
					'search'				=> $selected_search,
					'side_area' 			=> self::df_show_side_area()
				);
				// self::df_set_header_layout( $selected_header_layout );
				self::$header_parameter_setting = $params_setting;
				DF_Header_View::df_load_header( $params_setting );
			}else{
				$post_id = get_the_ID();
				$meta_layout = get_post_meta( $post_id, self::$header_layout_post, true );
				$meta_topbar = get_post_meta( $post_id, self::$header_topbar_post, true );
				$meta_content_layout = get_post_meta( $post_id, self::$content_layout_post, true );
				
				$selected_header_layout = '';
				$selected_topbar_status = '';
				$selected_layout_type = '';
				$selected_search = '';
				$is_social_icon_topbar = '';

				$general = self::df_get_general_options();
				$global = $general['global'];

				if( empty( $meta_layout ) || $meta_layout == 'inherit'){
					$global_header = $global['header_layout'];	
					$h = explode( "-", $global_header );
					$selected = $h[0]."_style_".$h[1];
					
					extract( self::df_get_header_selected( $selected ) );

					if( empty($meta_content_layout) || $meta_content_layout == 'default' ){
						$content_layout_type = $global['layout'];	
					}else{
						$content_layout_type = $meta_content_layout;
					}

					$selected_header_layout = $global_header;
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}
					
					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$is_social_icon_topbar = $social_icon_topbar;
				}else{
					/**
					 * conditional here if metabox != '' or metabox != inherit
					 */
					$header_selected = $meta_layout;
					$h = explode( "-", $header_selected );
					$selected = $h[0]."_style_".$h[1];
					extract( self::df_get_header_selected( $selected ) );

					if( empty($meta_content_layout) || $meta_content_layout == 'default' ){
						$general = self::df_get_general_options();
						$global = $general['global'];
						$content_layout_type = $global['layout'];
					}else{
						$content_layout_type = $meta_content_layout;
					}

					$selected_header_layout = $header_selected;
					if( $selected == 'header_style_6'){
						$selected_layout_type = '';
					}else{
						$selected_layout_type = $header_layout;	
					}

					$selected_content_layout_type = $content_layout_type;
					$selected_search = $search;
					$is_social_icon_topbar = $social_icon_topbar;
				}

				// topbar
				
				if( empty( $meta_topbar ) || $meta_topbar == 'inherit' ){
					$global_topbar = $global['is_topbar'];
					$selected_topbar_status = $global_topbar;
				}else{
					if( $meta_topbar == 'enable' ){
						$selected_topbar_status = 'yes';
					}else if( $meta_topbar == 'disable' ){
						$selected_topbar_status = 'no';
					}
				}
				$sos = self::df_get_social_account_options();
				$acc = $sos['account'];
				$params_setting = array(
					'rss'					=> $acc['rss'],
					'facebook'				=> $acc['facebook'],
					'twitter'				=> $acc['twitter'],
					'google_plus'			=> $acc['google_plus'],
					'linkedin'				=> $acc['linkedin'],
					'youtube'				=> $acc['youtube'],
					'vimeo'					=> $acc['vimeo'],
					'vk'					=> $acc['vk'],
					'instagram'				=> $acc['instagram'],
					'pinterest'				=> $acc['pinterest'],
					'flickr'				=> $acc['flickr'],
					'bloglovin'				=> $acc['bloglovin'],
					'spotify'				=> $acc['spotify'],
					'meta_layout' 			=> $selected_header_layout,
					'meta_topbar' 			=> $selected_topbar_status,
					'social_icon_topbar'	=> $is_social_icon_topbar,
					'layout_type' 			=> $selected_layout_type,
					'content_layout_type' 	=> $selected_content_layout_type,
					'search'				=> $selected_search,
					'side_area' 			=> self::df_show_side_area()
				);
				// self::df_set_header_layout( $selected_header_layout );
				self::$header_parameter_setting = $params_setting;
				DF_Header_View::df_load_header( $params_setting );
			}
		}

		/**
		 * method page
		 * call by df_get_header()
		 */
		static function df_page(){
			$meta_layout_header = DF_CSS_Options::$metabox->header_style;
			$meta_topbar = DF_CSS_Options::$metabox->top_bar;
			$meta_content_layout = DF_CSS_Options::$metabox->content_layout;
			$selected_layout_type = '';
			$selected_search = '';
			$is_social_icon_topbar = '';

			/**
			 * conditional here if metabox != '' or metabox != inherit
			 */
			$h = explode( "-", $meta_layout_header );
			$selected = $h[0]."_style_".$h[1];
			extract( self::df_get_header_selected( $selected ) );
			if( $selected == 'header_style_6'){
				$selected_layout_type = '';
			}else{
				$selected_layout_type = $header_layout;	
			}
			$selected_search = $search;
			$is_social_icon_topbar = $social_icon_topbar;

			$sos = self::df_get_social_account_options();
			$acc = $sos['account'];
			$params_setting = array(
				'rss'					=> $acc['rss'],
				'facebook'				=> $acc['facebook'],
				'twitter'				=> $acc['twitter'],
				'google_plus'			=> $acc['google_plus'],
				'linkedin'				=> $acc['linkedin'],
				'youtube'				=> $acc['youtube'],
				'vimeo'					=> $acc['vimeo'],
				'vk'					=> $acc['vk'],
				'instagram'				=> $acc['instagram'],
				'pinterest'				=> $acc['pinterest'],
				'flickr'				=> $acc['flickr'],
				'bloglovin'				=> $acc['bloglovin'],
				'spotify'				=> $acc['spotify'],
				'meta_layout' 			=> $meta_layout_header,
				'meta_topbar' 			=> $meta_topbar,
				'social_icon_topbar'	=> $is_social_icon_topbar,
				'layout_type' 			=> $selected_layout_type,
				'content_layout_type' 	=> $meta_content_layout,
				'search'				=> $selected_search,
				'side_area' 			=> self::df_show_side_area()
			);
			self::$header_parameter_setting = $params_setting;	                
			DF_Header_View::df_load_header( $params_setting );
		}

		/**
		 * method not_found
		 * call by df_get_header()
		 */
		static function df_not_found(){
			$template_setting = self::df_get_template_setting_options();
			$notfound_template = $template_setting['404_template'];
			$notfound_header = !isset($notfound_template['header_layout']) ? 'inherit' : $notfound_template['header_layout'];

			$selected_header_layout = '';
			$selected_topbar_status = '';
			$selected_layout_type = '';
			$selected_search = '';
			$is_social_icon_topbar = '';

			$general = self::df_get_general_options();
			$global = $general['global'];

			if( $notfound_header == 'inherit' ){
				
				$global_header = $global['header_layout'];
				$global_topbar = $global['is_topbar'];
				$content_layout_type = $global['layout'];

				$h = explode( "-", $global_header );
				$selected = $h[0]."_style_".$h[1];
				
				extract( self::df_get_header_selected( $selected ) );
				
				$selected_header_layout = $global_header;
				if( $selected == 'header_style_6'){
					$selected_layout_type = '';
				}else{
					$selected_layout_type = $header_layout;	
				}
				
				$selected_content_layout_type = $content_layout_type;
				$selected_search = $search;
				$selected_topbar_status = $global_topbar;
				$is_social_icon_topbar = $social_icon_topbar;
			}else{

				$h = explode( "-", $notfound_header );
				$selected = $h[0]."_style_".$h[1];
				extract( self::df_get_header_selected( $selected ) );
				$content_layout_type = $global['layout'];
				$global_topbar = $global['is_topbar'];
				
				$selected_header_layout = $notfound_header;
				if( $selected == 'header_style_6'){
					$selected_layout_type = '';
				}else{
					$selected_layout_type = $header_layout;	
				}
				
				$selected_content_layout_type = $content_layout_type;
				$selected_search = $search;
				$selected_topbar_status = $global_topbar;
				$is_social_icon_topbar = $social_icon_topbar;
			}
			$sos = self::df_get_social_account_options();
			$acc = $sos['account'];
			$params_setting = array(
				'rss'					=> $acc['rss'],
				'facebook'				=> $acc['facebook'],
				'twitter'				=> $acc['twitter'],
				'google_plus'			=> $acc['google_plus'],
				'linkedin'				=> $acc['linkedin'],
				'youtube'				=> $acc['youtube'],
				'vimeo'					=> $acc['vimeo'],
				'vk'					=> $acc['vk'],
				'instagram'				=> $acc['instagram'],
				'pinterest'				=> $acc['pinterest'],
				'flickr'				=> $acc['flickr'],
				'bloglovin'				=> $acc['bloglovin'],
				'spotify'				=> $acc['spotify'],
				'meta_layout' 			=> $selected_header_layout,
				'meta_topbar' 			=> $selected_topbar_status,
				'social_icon_topbar'	=> $is_social_icon_topbar,
				'layout_type' 			=> $selected_layout_type,
				'content_layout_type' 	=> $selected_content_layout_type,
				'search'				=> $selected_search,
				'side_area' 			=> self::df_show_side_area()
			);
			self::$header_parameter_setting = $params_setting;
			// self::df_set_header_layout( $selected_header_layout );
			DF_Header_View::df_load_header( $params_setting );
		}

		/**
		 * method home
		 * call by df_get_header()
		 */
		static function df_home(){
			$selected_header_layout = '';
			$selected_topbar_status = '';
			$selected_layout_type = '';
			$selected_search = '';

			$general = self::df_get_general_options();
			$global = $general['global'];
			$global_header = $global['header_layout'];	
			$h = explode( "-", $global_header );
			$selected = $h[0]."_style_".$h[1];
			
			extract( self::df_get_header_selected( $selected ) );

			$content_layout_type = $global['layout'];	

			$selected_header_layout = $global_header;

			if( $selected == 'header_style_6'){
				$selected_layout_type = '';
			}else{
				$selected_layout_type = $header_layout;	
			}
			
			$selected_content_layout_type = $content_layout_type;
			$selected_search = $search;

			// topbar

				$general = self::df_get_general_options();
				$global = $general['global'];
				$global_topbar = $global['is_topbar'];
				$selected_topbar_status = $global_topbar;

				$selected_social = $social_icon_topbar;
				
				$sos = self::df_get_social_account_options();
				$acc = $sos['account'];
				$params_setting = array(
					'rss'					=> $acc['rss'],
					'facebook'				=> $acc['facebook'],
					'twitter'				=> $acc['twitter'],
					'google_plus'			=> $acc['google_plus'],
					'linkedin'				=> $acc['linkedin'],
					'youtube'				=> $acc['youtube'],
					'vimeo'					=> $acc['vimeo'],
					'vk'					=> $acc['vk'],
					'instagram'				=> $acc['instagram'],
					'pinterest'				=> $acc['pinterest'],
					'flickr'				=> $acc['flickr'],
					'bloglovin'				=> $acc['bloglovin'],
					'spotify'				=> $acc['spotify'],
					'meta_layout' 			=> $selected_header_layout,
					'meta_topbar' 			=> $selected_topbar_status,
					'layout_type' 			=> $selected_layout_type,
					'content_layout_type' 	=> $selected_content_layout_type,
					'search'				=> $selected_search,
					'side_area' 			=> self::df_show_side_area(),
					'social_icon_topbar'	=> $selected_social
				);
				self::$header_parameter_setting = $params_setting;
				// self::df_set_header_layout( $selected_header_layout );
				DF_Header_View::df_load_header( $params_setting );
			}

		/**
		 * method search
		 * call by df_get_header()
		 */
		static function df_search(){
			$template_setting = self::df_get_template_setting_options();
			$search_template = $template_setting['search_template'];
			$search_header = !isset($search_template['header_layout']) ? 'inherit' : $search_template['header_layout'];

			$selected_header_layout = '';
			$selected_topbar_status = '';
			$selected_layout_type = '';
			$selected_search = '';
			$is_social_icon_topbar = '';

			$general = self::df_get_general_options();
			$global = $general['global'];
			if( $search_header == 'inherit' ){
				
				$global_header = $global['header_layout'];	
				$global_topbar = $global['is_topbar'];
				$content_layout_type = $global['layout'];	

				$h = explode( "-", $global_header );
				$selected = $h[0]."_style_".$h[1];
				
				extract( self::df_get_header_selected( $selected ) );
				
				$selected_header_layout = $global_header;
				if( $selected == 'header_style_6'){
					$selected_layout_type = '';
				}else{
					$selected_layout_type = $header_layout;	
				}
				
				$selected_content_layout_type = $content_layout_type;
				$selected_search = $search;
				$selected_topbar_status = $global_topbar;
				$is_social_icon_topbar = $social_icon_topbar;
			}else{
				$h = explode( "-", $search_header );
				$selected = $h[0]."_style_".$h[1];
				extract( self::df_get_header_selected( $selected ) );

				$content_layout_type = $global['layout'];
				$global_topbar = $global['is_topbar'];
				
				$selected_header_layout = $search_header;
				if( $selected == 'header_style_6'){
					$selected_layout_type = '';
				}else{
					$selected_layout_type = $header_layout;	
				}
				
				$selected_content_layout_type = $content_layout_type;
				$selected_search = $search;
				$selected_topbar_status = $global_topbar;
				$is_social_icon_topbar = $social_icon_topbar;
			}
			$sos = self::df_get_social_account_options();
			$acc = $sos['account'];
			$params_setting = array(
				'rss'					=> $acc['rss'],
				'facebook'				=> $acc['facebook'],
				'twitter'				=> $acc['twitter'],
				'google_plus'			=> $acc['google_plus'],
				'linkedin'				=> $acc['linkedin'],
				'youtube'				=> $acc['youtube'],
				'vimeo'					=> $acc['vimeo'],
				'vk'					=> $acc['vk'],
				'instagram'				=> $acc['instagram'],
				'pinterest'				=> $acc['pinterest'],
				'flickr'				=> $acc['flickr'],
				'bloglovin'				=> $acc['bloglovin'],
				'spotify'				=> $acc['spotify'],
				'meta_layout' 			=> $selected_header_layout,
				'meta_topbar' 			=> $selected_topbar_status,
				'social_icon_topbar'	=> $is_social_icon_topbar,
				'layout_type' 			=> $selected_layout_type,
				'content_layout_type' 	=> $selected_content_layout_type,
				'search'				=> $selected_search,
				'side_area' 			=> self::df_show_side_area()
				);
			// self::df_set_header_layout( $selected_header_layout );
			self::$header_parameter_setting = $params_setting;
			DF_Header_View::df_load_header( $params_setting );
		}

		/**
		 * ads_header_3
		 * for display ads on header style 3
		 */
		static function df_ads_header_3 () {
            $ads = self::df_get_advertisment();
			/**
			 *  $advertisment_header3_img = $ads['header_3_advertisment_img'];
			 *             $advertisment_header3_alt = $ads['header_3_advertisment_alt'];
			 *             $advertisment_header3_url = $ads['header_3_advertisment_url'];
			 *             $advertisment_header3_googlecode = $ads['header_3_advertisment_googlecode'];
			 */
			 return $ads;
        }

		/**
		 * df_get_header_logo
		 */
		static function df_get_header_logo( $current_header ) {
            $logo = "";
            $header_logo = "";
            $header_output = "";
			$retina_logo="";
			$additional_class="";
            $df_theme_options = self::df_get_all_options();
            $header_logo = isset( $df_theme_options['logo']['logo_header_'.$current_header ] ) ? $df_theme_options['logo']['logo_header_'.$current_header] : NULL;
			$retina_logo = isset( $df_theme_options['logo']['retina_logo_header_'.$current_header ] ) ? $df_theme_options['logo']['retina_logo_header_'.$current_header] : NULL;
            if( 'mobile' == $current_header ){
				$header_logo = isset( $df_theme_options['logo']['mobile_logo'] ) ? $df_theme_options['logo']['mobile_logo'] : NULL;
				$retina_logo = isset( $df_theme_options['logo']['retina_mobile_logo' ] ) ? $df_theme_options['logo']['retina_mobile_logo'] : NULL;
			}

			if ( "1" == $current_header || "2" == $current_header || "mobile" == $current_header ) {
				$additional_class="center-block";
			}
            if ( NULL != $header_logo && NULL != $retina_logo ) {
				
                $header_output = '<img src="' . esc_url( $header_logo )  . '" class="df-header-logo '.esc_attr($additional_class).'" data-at2x="'.esc_url( $retina_logo ).'" alt="'.get_bloginfo('name').'">';
				
            } elseif( NULL != $header_logo && NULL == $retina_logo ){
				
				$header_output = '<img src="' . esc_url( $header_logo )  . '" class="df-header-logo '.esc_attr($additional_class).'" data-at2x="'.esc_url( $header_logo ).'" alt="'.get_bloginfo('name').'" >';
				
			} elseif( NULL == $header_logo && NULL != $retina_logo ){

               $header_output = '<img src="' . esc_url( $retina_logo )  . '" class="df-header-logo '.esc_attr($additional_class).'" data-at2x="'.esc_url( $retina_logo ).'" alt="'.get_bloginfo('name').'">';
			   
            } else {
				
				$header_output = '<h1>' . get_bloginfo('name') . '</h1>';
			}
            return $header_output;
        }
        
		/**
		 * df_customize::df_get_site_icon_url()
		 * 
		 * @return void
		 */
       	static function df_get_site_icon_url($size, $url, $blogid) {
    		if (is_multisite() && (int)$blog_id !== get_current_blog_id())
    		{
		          switch_to_blog($blogid);
    		}
    		// $site_icon_id = self::$logo_options['fav_icon'];
    		$logo_options = self::df_get_logo_options('logo');
    		$site_icon_id = $logo_options['fav_icon'];
    		if (null != $site_icon_id)
    		{
    			if ($size >= 512){
    				$size_data = 'full';
    			}else{
    				$size_data = array($size, $size);
    			}
    			$url = wp_get_attachment_image_url($site_icon_id, $size_data);
    		}
    		if (is_multisite() && ms_is_switched())
    		{
    			restore_current_blog();
    		}
    		return apply_filters('df_get_site_icon_url', $url, $size, $blogid);
    	}  
         
        /**
         * df_get_fav_icon
         */
        static function df_get_fav_icon(){
    		$meta_tags = array();
    		$meta_tags['icon64'] = sprintf('<link rel="icon" href="%s" sizes="64x64" />',esc_url(self::df_get_site_icon_url(64, '', 0)));
    		$meta_tags['icon32'] = sprintf('<link rel="icon" href="%s" sizes="32x32" />',esc_url(self::df_get_site_icon_url(32, '', 0)));
    		$meta_tags['icon180'] = sprintf('<link rel="apple-touch-icon-precomposed" href="%s" />',esc_url(self::df_get_site_icon_url(180, '', 0)));
    		$meta_tags['icon270'] = sprintf('<meta name="msapplication-TileImage" content="%s" />',esc_url(self::df_get_site_icon_url(270, '', 0)));
    		extract($meta_tags);
    		echo $icon32 . $icon64 . $icon180 . $icon270;
        }

        /**
         * df_show_side_area
         */
        static function df_show_side_area(){
            $is_side_area = "";
            $side_area = "";
            $sidearea = self::df_get_side_area_options();
     		$is_side_area = $sidearea['enable_side_area'];
            if ( 'no' != $is_side_area) :
                $side_area = '<li class="df-navigator"><a href="#"><i class="ion-navicon"></i></a></li>';
            endif;
            
            return $side_area;
        }

        /**
         * df_side_area_status
         */
        static function df_side_area_status(){
        	$is_side_area = "";
        	$side_area = self::df_get_side_area_options();
        	$is_side_area = $side_area['enable_side_area'];
        	return $is_side_area;
        }

        /**
         * df_sticky_header
         */
        static function df_sticky_header(){
        	$sticky_header = self::df_get_header_selected('sticky_header');
        	$is_sticky = $sticky_header['is_sticky_header'];
        	return $is_sticky;
        }
		
		/**
		 * df_parse_header_option
		 */
		static function df_parse_header_option($global_header){
			$h = explode( "-", $global_header );
			$selected = $h[0]."_style_".$h[1];
			return DF_Global_Options::$options['header'][$selected]['header_layout'];
		}

		/**
		 * df_get_google_analytic
		 * get google analytic 
		 */
		static function df_get_google_analytic(){
			$general = self::df_get_general_options();
			$google_analytic = stripslashes_deep( $general['custom_code']['google_analytics_code'] );
			return $google_analytic;
		}
	}
}

/* file location: [theme directory]/inc/df-core/df-front-end/df-header.php */
