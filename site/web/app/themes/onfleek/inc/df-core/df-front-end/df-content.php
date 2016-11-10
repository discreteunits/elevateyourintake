<?php
/**
 * Class: DF_Content
 * Description: Class for call content layout
 */

if( !class_exists( 'DF_Content' ) ){

	Class DF_Content extends DF_Options{
		
		static $df_magz = 'df_magz';
		static $metabox_value = array();
		static $advertisment_before_you_may_also_like_title = "";

		public static $home_params = array();
		public static $single_params = array();
		public static $single_related_params = array();
		public static $page_params = array();
		public static $archive_params = array();
		public static $search_params = array();
		public static $not_found_params = array();

		/**
		 * __construct
		 */
		function __construct() {
			// construct here
		}

		/**
		 * df_get_content_layout
		 * get condition of layout content [boxed, frame, full]
		 * @return self::$layout_use
		 */
		static function df_get_content_layout(){
			$post_id = '';
			$layout_use = '';
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			$content_layout = $global_options['layout'];

			if ( is_single() ){
				$layout_use = DF_CSS_Options::$metabox->content_layout;
			} elseif ( is_page() ) {
				$layout_use = DF_CSS_Options::$metabox->content_layout;
			} elseif ( is_archive() ) {
				if ( is_category() ){
					$categories = self::$categories_options;
					$category = get_query_var('cat');
					$current_category = get_category ($category);
					if( !isset( $categories['per_category'][$current_category->term_id] )){
						$layout_use = $content_layout;
					} else {
						$per_category = $categories['per_category'][$current_category->term_id];
						if ( !isset(  $per_category['content_area_layout'] ) || 'default' === $per_category['content_area_layout'] ){
							$layout_use = $content_layout;
						}else{
							$layout_use = $per_category['content_area_layout'];
						}
					}
				} else {
					$layout_use = $content_layout;
				}
			} elseif ( is_404() ) {
				$template_setting = self::df_get_template_setting_options();
				$notfound_template = $template_setting['404_template'];
				$notfound_layout = $notfound_template['layout_404'];
				$layout_use = $notfound_layout;
			} else {
				$layout_use = $content_layout;
			}

			return $layout_use;
		}


		static function df_get_bg(){
			$content_bg_fixed = 'content_bg_fixed';
			$content_bg_scroll = 'content_bg_scroll';
			return $content_bg_scroll;
		}

		/**
		 * df_get_content
		 * function for get content based on option (theme option) & metabox
		 * @param - 
		 * @return -
		 */
		static function df_get_content(){
			$method = self::get_page_type();
			self::$method();
		}
		
		/**
		 * smart_list
		 * get content for smart_list
		 */
		static function df_get_smart_list(){
 			$listicle = self::$metabox_value->listicle_layout;
			$meta_post_show_number = self::$metabox_value->show_number;
			$meta_post_listicle = self::$metabox_value->list_listicle; 
			$ordering = self::$metabox_value->ordering;
			if ( $listicle !== 'no-smart-list') {
				 require get_template_directory(). '/inc/df-core/views/df-content/df-'. $listicle .'.php';
			}
		}
		
		/**
		 * Review
		 * get content for Review
		 */
		static function df_get_review( $review_position ){
			/* ** List of meta key */
			$review_type = self::$metabox_value->review;
			if ( 'disable' !== $review_type && self::$metabox_value->review_placement == $review_position ) { 
				$review_summary = self::$metabox_value->summary; 
				$list_reviews = self::$metabox_value->feature_name; 
				$review_positive_title = self::$metabox_value->review_conclusion; 
				require get_template_directory(). '/inc/df-core/views/df-content/df-review/review-'. $review_type .'.php';
			}
		}
		
		/**
		 * df_get_social_share
		 */
		static function df_get_social_share( $button_position, $general_layout='general' ){
			$post_setting 			= self::df_get_post_setting_options();
			$general 				= self::df_get_general_options();
			$social_sharing			= $general['social_sharing'];
			$social_button_style 	= $social_sharing['button_style'] ? : 'share-1';
			$is_top_article			= $post_setting['is_top_article_sharing'];
			$is_bottom_article		= $post_setting['is_bottom_article_sharing'];
			$social_list 			= $social_sharing['sharing_button'];
			$enable_social_share 	= $social_sharing['is_share_single_post'];
			if ( $enable_social_share == 'yes' ) {
				if ( $button_position == 'top' && $is_top_article == 'yes') {
					$top_class = '';
					require get_template_directory(). '/inc/df-core/views/df-content/df-social-share/social-'. $social_button_style .'.php' ;
				}
				
				if ( $button_position == 'bottom' && $is_bottom_article == 'yes') {
					$top_class = 'push-top-2';
					require get_template_directory(). '/inc/df-core/views/df-content/df-social-share/social-'. $social_button_style .'.php' ;
				}
			}
		}

		/**
		 * df_get_image_id
		 * @param $image_url
		 */
		static function df_get_image_id( $image_url ) {
			global $wpdb;
			 $attachment = $wpdb->get_col($wpdb->prepare("SELECT IFNULL(ID,0)  FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
			 if (null == $attachment){
				return $attachment; 
			 } else {
			return $attachment[0]; 
			}
		}

		/**
		 * DF_Content::df_get_ads_before_content()
		 * 
		 * @return
		 */
		static function df_get_ads_before_content(){
			$ads = self::df_get_advertisment();
			$advertisment_img = $ads['before_content_advertisment_img'];
			$advertisment_alt = $ads['before_content_advertisment_alt'];
			$advertisment_url = $ads['before_content_advertisment_url'];
			$advertisment_googlecode = $ads['before_content_advertisment_googlecode'];
			$adscontent = "";
			if ( '' != $advertisment_googlecode ) {
				$adscontent =  stripslashes_deep ( $advertisment_googlecode ); 
			}else{
				
				if (!empty($advertisment_img) && $advertisment_img !== '' ){
					$image_id = DF_Content::df_get_image_id($advertisment_img);
					$thumbs = wp_get_attachment_image( $image_id, '' , false, array( 'class' => 'img-responsive center-block' , 'alt' => $advertisment_alt ) ); 
				
				?>
				<a href="<?php echo esc_url( $advertisment_url ); ?>">
					<?php echo  $thumbs;?>
				</a>
				<?php
				}
			}
			return $adscontent; 
		}

		/**
		 * DF_Content::df_get_ads_before_author()
		 * 
		 * @return
		 */
		static function df_get_ads_before_author(){
			$ads = self::df_get_advertisment();
			$advertisment_before_author_img = $ads['before_author_advertisment_img'];
			$advertisment_before_author_alt = $ads['before_author_advertisment_alt'];
			$advertisment_before_author_url = $ads['before_author_advertisment_url'];
			$advertisment_before_author_googlecode = $ads['before_author_advertisment_googlecode'];
			self::$advertisment_before_you_may_also_like_title = $ads['before_you_may_also_like_advertisment_title'];
			$adscontent = "";
			if ( '' != $advertisment_before_author_googlecode ) {
				$adscontent =  stripslashes_deep ( $advertisment_before_author_googlecode ); 
			}else{
				
				if (!empty($advertisment_before_author_img) && $advertisment_before_author_img !== '' ){
					$image_id = DF_Content::df_get_image_id($advertisment_before_author_img);
					$thumbs = wp_get_attachment_image( $image_id, '' , false, array( 'class' => 'img-responsive center-block' , 'alt' => $advertisment_before_author_alt ) ); 
				?>
				<a href="<?php echo esc_url( $advertisment_before_author_url ); ?>">
					<?php echo $thumbs;?>
				</a>
				<?php
				}
			}
			return $adscontent; 
		}

		/**
		 * DF_Content::df_get_ads_before_you_may_also_like()
		 * 
		 * @return
		 */
		static function df_get_ads_before_you_may_also_like(){
		    $ads = self::df_get_advertisment();
			$advertisment_before_you_may_also_like_img = $ads['before_you_may_also_like_advertisment_img'];
			$advertisment_before_you_may_also_like_alt = $ads['before_you_may_also_like_advertisment_alt'];
			$advertisment_before_you_may_also_like_url = $ads['before_you_may_also_like_advertisment_url'];
			$advertisment_before_you_may_also_like_googlecode = $ads['before_you_may_also_like_advertisment_googlecode'];
			$adscontent = "";
			if ( '' != $advertisment_before_you_may_also_like_googlecode ) {
				$adscontent =  stripslashes_deep ( $advertisment_before_you_may_also_like_googlecode ); 
			} else {
				
				if (!empty($advertisment_before_you_may_also_like_img) && $advertisment_before_you_may_also_like_img !== '' ){
					$image_id = DF_Content::df_get_image_id( $advertisment_before_you_may_also_like_img );
					$adscontent = wp_get_attachment_image( $image_id, '' , false, array( 'class' => 'img-responsive center-block' , 'alt' => $advertisment_before_you_may_also_like_alt ) ); 
					$adscontent  = sprintf('<a href="%1$s">%2$s</a>',esc_url( $advertisment_before_you_may_also_like_url ), $adscontent);
				}else{
					$adscontent = "";
				}
				//$adscontent = sprintf('<a href="%1$s"><img src="%2$s</a>',esc_url( $advertisment_before_you_may_also_like_url ), $advertisment_before_you_may_also_like_img );
			}
			if ( empty($adscontent ) || $adscontent == '' ) return $adscontent;
			$dv_ads  = '<div class="col-md-12">';
			$dv_ads .= '<div class="df-single-post-ads-wrap">';
			$dv_ads .= '<h4>' . DF_Content::$advertisment_before_you_may_also_like_title . '</h4>';
			$dv_ads .= '<div class="df-single-post-ads-bottom-big">';
			$dv_ads .= $adscontent;
			$dv_ads .= '</div></div></div>';
			return $dv_ads; 
		}
		
		/**
		 * DF_Content::df_get_ads_header_3()
		 * 
		 * @return
		 */
		static function df_get_ads_header_3(){
			$ads = self::df_get_advertisment();
			$header_3_advertisment_img = $ads['header_3_advertisment_img'];
			$header_3_advertisment_alt = $ads['header_3_advertisment_alt'];
			$header_3_advertisment_url = $ads['header_3_advertisment_url'];
			$header_3_advertisment_googlecode = $ads['header_3_advertisment_googlecode'];
			$adscontent = "";
			$thumbs = "";
			if ( '' != $header_3_advertisment_googlecode ) {
				$adscontent =  stripslashes_deep ( $header_3_advertisment_googlecode ); 
			} else {
			
				if (!empty($header_3_advertisment_img) && $header_3_advertisment_img !== ''){
						$image_id = DF_Framework::df_get_image_id($header_3_advertisment_img);
						$thumbs = wp_get_attachment_image( $image_id, '' , false, array( 'class' => 'img-responsive center-block' , 'alt' => $header_3_advertisment_alt ) ); 
					
					?>
					<a href="<?php echo esc_url( $header_3_advertisment_url ); ?>">
						<?php echo $thumbs; ?>
					</a>
					<?php
				}
			}
			return $adscontent; 
		}
		
		/**
		 * home
		 * get content for home
		 * is_home()
		 */
		static function df_home(){
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			$breadcrumb = $general['breadcrumb'];
			$breadcrumb_status = $breadcrumb['is_breadcrumbs'];

			$template_setting = self::df_get_template_setting_options();
			$blogpost = $template_setting['blogpost_template'];
			$params_setting = array(
				'bg_type' 				=> '',
				'option_bg_type' 		=> 'df-bg',
				'default_featured_img'	=> $global_options['default_feature_image'], // from global theme option
				'option_layout_type' 	=> $global_options['layout'], // boxed, framed, full from global theme option
				'layout_type' 			=> self::df_set_layout_type( $global_options['layout'] ),
				'home_article_display' => $blogpost['article_display_preview'], // article preview display
				'home_layout' 		=> $blogpost['layout'], // sidebar from blogpost template setting
				'sidebar_widget' => $blogpost['sidebar_widget'],
				'pagination'			=> !isset($blogpost['pagination']) ? 'normal-pagination' : $blogpost['pagination'],
				'image_id' 	=> self::df_get_image_id($global_options['default_feature_image'])
				// 'is_breadcrumbs' 		=> $breadcrumb_status,
				// 'header_type'			=> $header_type,
			);
			self::$home_params = $params_setting;
			DF_Content_View::df_load_content( $params_setting );
		}

		/**
		 * archive
		 * for get archive content based on theme options
		 */
		static function df_archive(){
			$params_setting = array();
			$post_id = '';
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			extract( $global_options );
			$content_layout = $layout;

			$breadcrumb = $general['breadcrumb'];
			extract( $breadcrumb );
			$breadcrumb_status = $is_breadcrumbs;
			
			// option background from theme option
			$content_bg_fixed = 'content_bg_fixed';
			$content_bg_scroll = 'content_bg_scroll';
			
			$selected_article_display = '';
			$selected_archive_layout = '';
			$content_layout_type = '';
			
			$general = self::df_get_general_options(); // get general options
			$global = $general['global']; // get general -> global options

			$content_layout_type = $global['layout'];
			$template_setting = self::df_get_template_setting_options();
			$pagination = isset($template_setting['archive_template']['pagination']) ? $template_setting['archive_template']['pagination'] : 'normal-pagination';
			$params_setting['bg_type'] = '';
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
		    }

			$params_setting['layout_type'] = self::df_set_layout_type( $content_layout_type );

			if( !is_category() ){	
				$params_setting['archive_option_article_display']= $selected_article_display;
				$params_setting['archive_layout']	= $selected_layout;
				$params_setting['option_layout_type']	= $content_layout_type;
				$params_setting['option_bg_type']		= $content_bg_scroll;
				$params_setting['is_breadcrumbs']		= $breadcrumb_status;
				$params_setting['pagination']			= $pagination;
				$params_setting['sidebar_widget']		= $selected_sidebar;
				// 'content_list'					= self::get_content_archive()
			}
			
			self::$archive_params = $params_setting;
			DF_Content_View::df_load_content( $params_setting );
		}
		
		/**
		 * single
		 * for get single content based on theme options & metabox
		 */
		static function df_set_value_metabox($postid , $type){
			if ( 'post' == $type ) {
				$metabox = new DF_get_metabox();
				$metabox->df_get_post_meta_value($postid);
				// 
			}else{
				$metabox = new DF_get_metabox();
				$metabox->df_get_page_meta_value($postid);
				// 
			}
				self::$metabox_value = $metabox; 
		 }
		 
		static function df_set_layout_type( $option_layout_type ){
			if ( 'default' == $option_layout_type){
                if( $general_option_layout_type == 'boxed' ){
    				$layout_type = 'df-content-boxed';
    			}else if( $general_option_layout_type == 'frame' || $general_option_layout_type == 'framed') {
    				$layout_type = 'df-content-frame';
    			}else{
    				$layout_type = 'df-content-full';
    			} 
            }else{
                if( $option_layout_type == 'boxed' ){
				    $layout_type = 'df-content-boxed';
			     }else if( $option_layout_type == 'frame' || $option_layout_type == 'framed') {
				    $layout_type = 'df-content-frame';
			     }else{
				    $layout_type = 'df-content-full';
			     }
            }
            return $layout_type;
		}

		/**
		 * df_single
		 * load page single (is_single())
		 */
		static function df_single(){
			// $post_id = '';
			// global $post;
			// $post_id = $post->ID;
			$post_id = get_the_ID();
			self::df_set_value_metabox($post_id , 'post');

			$ads = self::df_get_advertisment();
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			$content_layout = $global_options['layout'];
			$post_setting = self::df_get_post_setting_options();
			$meta_post_format = get_post_format( $post_id ) ? : 'standard' ;

			if( $meta_post_format == 'gallery' ){
				$meta_gallery = DF_CSS_Options::$metabox->galery;
				$meta_content_post_format = isset( $meta_gallery ) ? $meta_gallery : '' ;
			}elseif( $meta_post_format == 'video' || $meta_post_format == 'audio' ){
				$meta_content_post_format = isset (DF_CSS_Options::$metabox->embed)? DF_CSS_Options::$metabox->embed : '';
			} else {
				$meta_content_post_format = '';
			}
			$params_setting = array(
				'option_bg_type' 		         => 'df-bg',
				'bg_type' 						 => '',
				'default_featured_img'	         => $global_options['default_feature_image'],
				'option_layout_type' 	         => DF_CSS_Options::$metabox->content_layout,
				'layout_type' 					 => self::df_set_layout_type( DF_CSS_Options::$metabox->content_layout ),
				'general_post_layout' 	         => DF_CSS_Options::$metabox->post_layout,
				'meta_post_layout' 		         => DF_CSS_Options::$metabox->layout_global,
				'meta_post_subtitle' 	         => DF_CSS_Options::$metabox->subtitle,
				'is_breadcrumbs' 		         => $general['breadcrumb']['is_breadcrumbs'],
				'post_format'			         => $meta_post_format,
				'meta_content_post_format'       => $meta_content_post_format,
				'header_type'			         =>  DF_CSS_Options::$metabox->header_style,
				'cat_related' 			         => self::df_get_content_cats( $post_id, !isset( $post_setting['number_of_related_post'] ) ? '0' : $post_setting['number_of_related_post'] ),
				'custom_sidebar'                 => DF_CSS_Options::$metabox->custom_sidebar,
				'is_show_categories_tag'		 => !isset( $post_setting['is_show_categories_tag'] ) ? 'no' : $post_setting['is_show_categories_tag'],
				'is_show_author_name'            => !isset( $post_setting['is_show_author_name'] ) ? 'no' : $post_setting['is_show_author_name'],
				'is_show_date'                   => !isset( $post_setting['is_show_date'] ) ? 'no' : $post_setting['is_show_date'],
				'is_show_post_views'             => !isset( $post_setting['is_show_post_views'] ) ? 'no' : $post_setting['is_show_post_views'],
				'is_show_comment_counts'         => !isset ( $post_setting['is_show_comment_counts'] ) ? 'no' : $post_setting['is_show_comment_counts'],
				'is_show_tag'                    => !isset( $post_setting['is_show_tag'] ) ? 'no' : $post_setting['is_show_tag'],
				'is_show_author_box'             => !isset( $post_setting['is_show_author_box'] ) ? 'no' : $post_setting['is_show_author_box'],
				'is_related_article'			 => !isset( $post_setting['is_related_article'] ) ? 'no' : $post_setting['is_related_article'],
				'number_of_related_post'		 => !isset( $post_setting['number_of_related_post'] ) ? '0' : $post_setting['number_of_related_post'],
				'is_show_next_prev_post'		 => !isset( $post_setting['is_show_next_prev_post'] ) ? 'no' : $post_setting['is_show_next_prev_post'],
				'is_featured_img'                => DF_CSS_Options::$metabox->featured_image
			);
			self::$single_params = $params_setting;
			self::$single_related_params = array( 
					'cat_related' => self::df_get_content_cats( $post_id, !isset( $post_setting['number_of_related_post'] ) ? '0' : $post_setting['number_of_related_post'] ),
					'is_related_article' => !isset( $post_setting['is_related_article'] ) ? 'no' : $post_setting['is_related_article'],
				);
			DF_Content_View::df_load_content( $params_setting );
		}

		/**
		 * transporteInfinite
		 */
		static function df_transporter_single( $post_id ){
			global $post;
			$post = get_post( $post_id );
			self::df_set_value_metabox($post_id , 'post');

			$ads = self::df_get_advertisment();
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			$content_layout = $global_options['layout'];

			$post_setting = self::df_get_post_setting_options();
			$meta_post_format = get_post_format( $post_id ) ? : 'standard' ;
			
			if( $meta_post_format == 'gallery' ){
				$meta_gallery = self::$metabox_value->galery;
				$meta_content_post_format = $meta_gallery;
			}elseif( $meta_post_format == 'video' || $meta_post_format == 'audio' ){
				$meta_content_post_format = self::$metabox_value->embed;
			} else {
				$meta_content_post_format = '';
			}
			$params_setting = array(
				'option_bg_type' 		         => 'df-bg',
				'bg_type' 						 => '',
				'default_featured_img'	         => $global_options['default_feature_image'],
				'option_layout_type' 	         => self::$metabox_value->content_layout,
				'layout_type' 					 => self::df_set_layout_type( DF_CSS_Options::$metabox->content_layout ),
				'general_post_layout' 	         => self::$metabox_value->post_layout,
				'meta_post_layout' 		         => self::$metabox_value->layout_global,
				'meta_post_subtitle' 	         => self::$metabox_value->subtitle,
				'is_breadcrumbs' 		         => $general['breadcrumb']['is_breadcrumbs'],
				'post_format'			         => $meta_post_format,
				'meta_content_post_format'       => $meta_content_post_format,
				'header_type'			         => self::$metabox_value->header_style,
				'cat_related' 			         => self::df_get_content_cats( $post_id, !isset( $post_setting['number_of_related_post'] ) ? '0' : $post_setting['number_of_related_post'] ),
				'custom_sidebar'                 => self::$metabox_value->custom_sidebar,
				'is_show_categories_tag'		 => !isset( $post_setting['is_show_categories_tag'] ) ? 'no' : $post_setting['is_show_categories_tag'],
				'is_show_author_name'            => !isset( $post_setting['is_show_author_name'] ) ? 'no' : $post_setting['is_show_author_name'],
				'is_show_date'                   => !isset( $post_setting['is_show_date'] ) ? 'no' : $post_setting['is_show_date'],
				'is_show_post_views'             => !isset( $post_setting['is_show_post_views'] ) ? 'no' : $post_setting['is_show_post_views'],
				'is_show_comment_counts'         => !isset( $post_setting['is_show_comment_counts'] ) ? 'no' : $post_setting['is_show_comment_counts'],
				'is_show_tag'                    => !isset( $post_setting['is_show_tag'] ) ? 'no' : $post_setting['is_show_tag'],
				'is_show_author_box'             => !isset( $post_setting['is_show_author_box'] ) ? 'no' : $post_setting['is_show_author_box'],
				'is_related_article'			 => !isset( $post_setting['is_related_article'] ) ? 'no' : $post_setting['is_related_article'],
				'number_of_related_post'		 => !isset( $post_setting['number_of_related_post'] ) ? '0' : $post_setting['number_of_related_post'],
				'is_show_next_prev_post'		 => !isset( $post_setting['is_show_next_prev_post'] ) ? 'no' : $post_setting['is_show_next_prev_post'],
				'is_featured_img'                => self::$metabox_value->featured_image
			);
			self::$single_params = $params_setting;
			DF_Content_View::df_load_content( $params_setting );
		}

		/**
		 * df_page
		 * for get page content based on theme options & metabox
		 * is_page()
		 */
       	static function df_page(){
            $general = self::df_get_general_options();
			$global_options = $general['global'];
			$content_layout = $global_options['layout'];
			$default_featured_img = self::$default_featured_img;
			$breadcrumb = self::$general_breadcumb_options;
			$breadcrumb_status = self::$general_isbreadcumb_options;	
            $page_type = DF_CSS_Options::$metabox->page_template;
            
	        if( is_page_template( 'page-pagebuilder-witharchive.php') ){
	        	$page_type = 'pagebuilder-witharchive';
	        	$filter_use = '';
	        	$post_setting_param = '';
	        	
	        	if( !empty( DF_CSS_Options::$metabox->page_post_id_filter )){
	        		$filter_use = 'post_id';
	        		$post_setting_param = DF_CSS_Options::$metabox->page_post_id_filter;
	        	}else if (!empty( DF_CSS_Options::$metabox->page_category_filter ) ) {
	        		if( DF_CSS_Options::$metabox->page_category_filter != 'all' ){
	        			$filter_use = 'category';
	        			$post_setting_param = DF_CSS_Options::$metabox->page_category_filter;
	        		}else{
	        			$filter_use = 'all';
	        			$post_setting_param = '';
	        		}
	        	}else if( !empty( DF_CSS_Options::$metabox->page_multi_category_filter) ){
	        		$filter_use = 'multi_category';
	        		$post_setting_param = DF_CSS_Options::$metabox->page_multi_category_filter;
	        	}else if( !empty( DF_CSS_Options::$metabox->page_filter_by_tag ) ){
	        		$filter_use = 'tag';
	        		$post_setting_param = DF_CSS_Options::$metabox->page_filter_by_tag;
	        	}else if( !empty( DF_CSS_Options::$metabox->page_filter_by_author ) ){
	        		$filter_use = 'author';
	        		$post_setting_param = DF_CSS_Options::$metabox->page_filter_by_author;
	        	}
	        
	        	$post_setting = array(
	        		'page_post_layout'	=> DF_CSS_Options::$metabox->page_post_layout,
	        		'show_listitle'	=> DF_CSS_Options::$metabox->page_show_list_title,
	        		'list_title'	=> DF_CSS_Options::$metabox->page_list_title,
	        		'filter_use' => $filter_use,
	        		'sort_order' => DF_CSS_Options::$metabox->page_sort_order,
	        		'limit_post_order' => DF_CSS_Options::$metabox->page_max_number_of_post,
	        		'offset_post' => DF_CSS_Options::$metabox->page_offset_post,
	        		'page_type'	=> $page_type,
	        		'post_setting_param' => $post_setting_param,
	        	);
	        	
	        	$params_setting = array(
					'bg_type' 						 => '',
	        		'page_type'				=> $page_type,
	        		'pagination_type'		=> DF_CSS_Options::$metabox->page_pagination,
	        		'general_page_layout' 	=> DF_CSS_Options::$metabox->post_layout,
	                'general_option_layout_type' => DF_CSS_Options::$metabox->global_content_layout,
	        		'option_layout_type'   	=> DF_CSS_Options::$metabox->content_layout,
	        		'layout_type' 			=> self::df_set_layout_type( DF_CSS_Options::$metabox->content_layout ),
	        		'option_bg_type' 		=> 'df-bg',
	        		'post_setting'			=> $post_setting,
	        		'breadcrumb'			=> $breadcrumb['is_breadcrumbs'],	
	        		'default_featured_img'	=> $default_featured_img,
	        		'custom_sidebar' 		=> DF_CSS_Options::$metabox->custom_sidebar,
	        	);

	        }else if( is_page_template( 'page-pagebuilder.php') ) {
	        	$page_type = 'pagebuilder';
	        	$post_setting = array('page_type'	=> $page_type,);
	        	$params_setting = array(
					'bg_type' 				=> '',
	        		'page_type'				=> $page_type,
	        		'general_page_layout' 	=> DF_CSS_Options::$metabox->post_layout,
	                'general_option_layout_type' =>DF_CSS_Options::$metabox->global_content_layout,
	        		'option_layout_type'   	=> DF_CSS_Options::$metabox->content_layout,
	        		'layout_type' 			=> self::df_set_layout_type( DF_CSS_Options::$metabox->content_layout ),
	        		'option_bg_type' 		=> 'df-bg',
	        		'post_setting'			=> $post_setting,
	        		'breadcrumb'			=> $breadcrumb['is_breadcrumbs'],	
	        		'default_featured_img'	=> $default_featured_img,
	        		'custom_sidebar' 		=> DF_CSS_Options::$metabox->custom_sidebar
	        	);
	        }else{
	        	$page_type = 'default';
	        	$post_setting = array('page_type' => $page_type,);
	        	$params_setting = array(
					'bg_type' 				=> '',
	        		'page_type'				=> $page_type,
	        		'general_page_layout' 	=> DF_CSS_Options::$metabox->post_layout,
	                'general_option_layout_type' => DF_CSS_Options::$metabox->global_content_layout,
	        		'option_layout_type'   	=> DF_CSS_Options::$metabox->content_layout,
	        		'layout_type' 			=> self::df_set_layout_type( DF_CSS_Options::$metabox->content_layout ),
	        		'option_bg_type' 		=> 'df-bg',
	        		'post_setting'			=> $post_setting,
	        		'breadcrumb'			=> $breadcrumb['is_breadcrumbs'],	
	        		'default_featured_img'	=> $default_featured_img,
	        		'custom_sidebar' 		=> DF_CSS_Options::$metabox->custom_sidebar
	        	);
	        }
	        self::$page_params = $params_setting;
			DF_Content_View::df_load_content( $params_setting );
		}

		/**
		 * not_found
		 * get content 404 page
		 * is_404()
		 */
		static function df_not_found(){
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			$content_layout = $global_options['layout'];
			$breadcrumb = $general['breadcrumb'];
			$breadcrumb_status = $breadcrumb['is_breadcrumbs'];	
			
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
			$params_setting = array(
				'bg_type'							=> '',
				'notfound_option_article_display' => $selected_article_display,
				'notfound_title' 				=> $notfound_title,
				'notfound_subtitle'				=> $notfound_subtitle,
				'option_layout_type'			=> $selected_layout_type,
				'layout_type' 					=> self::df_set_layout_type( $selected_layout_type	 ),
				'default_featured_img'			=> $default_featured_img
			);
			self::$not_found_params = $params_setting;
			DF_Content_View::df_load_content( $params_setting );
		}

		/**
		 * search
		 * get content for search 
		 * is_search()
		 */
		static function df_search(){
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			$content_layout = $global_options['layout'];
			$breadcrumb = $general['breadcrumb'];
			$breadcrumb_status = $breadcrumb['is_breadcrumbs'];	

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

			$params_setting = array(
				'bg_type'							=> '',
				'search_option_article_display' => $selected_article_display,
				'search_layout'				    => $selected_layout,
				'option_layout_type' 			=> $content_layout_type,
				'layout_type'					=> self::df_set_layout_type( $content_layout_type ),
				'option_bg_type' 				=> 'df-bg',
				'is_breadcrumbs' 				=> $breadcrumb_status,
				'default_featured_img'			=> $default_featured_img,
				'pagination'					=> $pagination,
				'sidebar_widget' 				=> $search_sidebar
			);
			self::$search_params = $params_setting;
			DF_Content_View::df_load_content( $params_setting );
		}

		/**
		 * df_set_page_view
		 * set page view using post meta
		 */
		static function df_set_page_view( $single_post_id ){
			$dfpageview_key = 'df_page_view';
			// $id = $single_post_id;
			// $view = get_post_meta($id, $dfpageview_key, true);
			$view = self::$metabox_value->page_view;
			if( $view == '' ){
				$view = 0;
				delete_post_meta( $single_post_id, $dfpageview_key );
				add_post_meta( $single_post_id, $dfpageview_key, '0');
			}else{
				$view++;
				update_post_meta($single_post_id, $dfpageview_key, $view);
			}
		}

		/**
		 * df_get_page_view
		 * get page view from post meta
		 */
		static function df_get_page_view( $single_post_id ){
			if ( !class_exists('WordpressPopularPosts') ) {
				return "0";
			}
			global $wpdb;
			$table = $wpdb->prefix . "popularposts";
			$wpdb->show_errors();
			$query = "SELECT pageviews FROM {$table}data WHERE postid = '{$single_post_id}'";
			$result = $wpdb->get_var($query);

			if ( !$result ) {
				return "0";
			}

			return ($result) ? number_format_i18n( intval($result + 1 ) ) : $result;
		}

		/**
		 * get content categories ( call by single() )
		 */
		static private function df_get_content_cats( $post_id, $number_of_related_post){
			$args = array();
			$categories = get_the_category( $post_id );
			if( $categories ){
				$category_ids = array();
				foreach ( $categories as $individual_cat ) {
					$category_ids[] = $individual_cat->term_id;
				}
				$args = array(
					'category__in' => $category_ids,
					'post__not_in' => array( $post_id ),
					'posts_per_page' => $number_of_related_post,
					'ignore_sticky_posts' => 1,
					'orderby' => 'rand'
				);
			}
			return $args;
		}
		
		/**
		 * df_get_content_parameters
		 */
		static function df_get_content_parameters($post_id){
			self::df_set_value_metabox($post_id , 'page');
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			$content_layout = $global_options['layout'];
			$default_featured_img = $global_options['default_feature_image'];
			$breadcrumb = $general['breadcrumb'];
			$breadcrumb_status = $breadcrumb['is_breadcrumbs'];
			$selected_general_page_layout = self::$metabox_value->post_layout;
			$selected_global_page_content_layout = self::$metabox_value->global_content_layout;
			$selected_page_content_layout = self::$metabox_value->content_layout;
			$selected_custom_sidebar = self::$metabox_value->custom_sidebar;
			$page_type = self::$metabox_value->page_template;
			$page_type = 'pagebuilder-witharchive';
			$selected_post_setting_layout = self::$metabox_value->page_post_layout;
			$meta_ps_show_listtitle = self::$metabox_value->page_show_list_title;
			$meta_ps_list_title = self::$metabox_value->page_list_title;
			$meta_pagination = self::$metabox_value->page_pagination;
			$meta_ps_filter_post_id = self::$metabox_value->page_post_id_filter;
			$meta_ps_filter_category = self::$metabox_value->page_category_filter;
			$meta_ps_filter_multi_category = self::$metabox_value->page_multi_category_filter;
			$meta_ps_filter_by_tag = self::$metabox_value->page_filter_by_tag;
			$meta_ps_filter_multi_author = self::$metabox_value->page_filter_by_author;
			$meta_ps_sort_order = self::$metabox_value->page_sort_order;
			$meta_ps_limit_post_order = self::$metabox_value->page_max_number_of_post;
			$meta_ps_offset_post = self::$metabox_value->page_offset_post;
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
			return $params_setting;
		}
		
		/**
		 * df_get_sidebar
		 */
		static function df_get_sidebar(){
			global $post;
			
			$template_setting = self::df_get_template_setting_options();
		
			if ( is_page() ){
					$cmb_post_sidebar = DF_CSS_Options::$metabox->custom_sidebar;
				if ( is_dynamic_sidebar($cmb_post_sidebar) ){
					dynamic_sidebar($cmb_post_sidebar);
				}else{
					get_sidebar();
				}
			} else if ( is_single() ){
				$cmb_post_sidebar = DF_CSS_Options::$metabox->custom_sidebar;
				if ( is_dynamic_sidebar($cmb_post_sidebar) ){
					dynamic_sidebar($cmb_post_sidebar);
				}else{
					get_sidebar();
				}
			} else if (is_archive()){
				$archive_sidebar = $template_setting['archive_template']['sidebar_widget'];
				if ( isset($archive_sidebar) ){
					dynamic_sidebar($archive_sidebar);
				} else {
					get_sidebar();
				}
			}
		}

		/**
		 * df_load_sidebar
		 * method for load sidebar based on sidebar name
		 */
		static function df_load_sidebar( $sidebar_name ) {
			if( isset( $sidebar_name ) || $sidebar_name !== '' ){
				if( $sidebar_name == 'default' ){
					get_sidebar();
				}else{
					dynamic_sidebar( $sidebar_name );
				}
				
			}else{
				get_sidebar();
			}
		}

		/**
		 * DF_Content::df_load_feature_image()
		 * 
		 * @return void
		 */
		static function df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary ){
			$thumbs 			= '';
			$id_secondary_img	= get_post_meta ( get_the_ID(), 'post_secondary-image_thumbnail_id', true );
			$secondary_img = '';
			// image type thumbnail
			if ( 'yes' == $is_thumbnail ) {
				if ( has_post_thumbnail( get_the_ID() ) ) {
					$thumbs 		= get_the_post_thumbnail( get_the_ID(), $size = $use_size, array( 'class' => 'img-responsive df-img-thumbnail' ) );
				} else {
					$image_id		= DF_Framework::$default_featured_img_id;
					$thumbs 		= wp_get_attachment_image( $image_id, $size = $use_size, false, array( 'class' => 'img-responsive df-img-thumbnail' ) );
				}
				// no secondary featured image ( thumbnail / normal )
				if ( !empty( $id_secondary_img ) || '' !== $id_secondary_img ) {
					$secondary_img	= wp_get_attachment_image( $id_secondary_img, $size = $use_size, false, array( 'class' => 'img-responsive df-img-thumbnail' ) );
				}
			}
			// image type normal
			else {
				if ( has_post_thumbnail( get_the_ID() ) ) {
					$thumbs 		= get_the_post_thumbnail( get_the_ID(), $size = $use_size, array( 'class' => 'img-responsive center-block article-featured-image' ) );
				} else {
					$image_id		= DF_Framework::$default_featured_img_id;
					$thumbs 		= wp_get_attachment_image( $image_id, $size = $use_size, false, array( 'class' => 'img-responsive center-block article-featured-image' ) );
				}
				// no secondary featured image ( thumbnail / normal )
				if ( !empty( $id_secondary_img ) || '' !== $id_secondary_img ) {
					$secondary_img	= wp_get_attachment_image( $id_secondary_img, $size = $use_size, false, array( 'class' => 'img-responsive center-block article-featured-image' ) );
				}
			}
			// render with / without secondary featured image
			if ( 'no' == $is_secondary ) {
				$dv_image = sprintf('<a href="%1$s" class="df-img-wrapper">%2$s</a>', esc_url( get_permalink() ), $thumbs );
			} else {
				$dv_image = sprintf( '<a href="%1$s" class="df-img-wrapper">%2$s%3$s</a>',  esc_url( get_permalink() ) , $thumbs ,  $secondary_img );
			}
			echo $dv_image;
		}
        
        /**
         * df_load_listicle_image
         */
		static function df_load_listicle_image( $listicles, $use_size ){
			if ( isset( $listicles['df_magz_post_listicle_image'] ) && !empty( $listicles['df_magz_post_listicle_image'] ) ) {
				$image_id	= $listicles['df_magz_post_listicle_image_id'];
				$thumbs 	= wp_get_attachment_image( $image_id, $size = $use_size, false, array( 'class' => 'img-responsive center-block' ) );
			}else {
				$image_id	= DF_Framework::$default_featured_img_id;
				$thumbs 	= wp_get_attachment_image( $image_id, $size = $use_size, false, array( 'class' => 'img-responsive center-block' ) );
			}
			echo $thumbs;
		}

		/**
		 * df_load_author_and_date
		 */
		static function df_load_author_and_date(){
			?>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-name"><?php echo get_the_author();?></a>
			<?php
				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
				$time_string = sprintf(
					$time_string,
					esc_attr( get_the_date( 'c' ) ),
					get_the_date()
				);
				$posted_on = sprintf(
					esc_html_x( '%s', 'post date', 'onfleek' ),
					'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
				);
				echo $posted_on;
		}

		/**
		 * df_load_avatar_author
		 */
		static function df_load_avatar_author(){
		   echo get_avatar( get_the_author_meta( 'ID' ), 32, $default = '', $alt = 'author_avatar', array( 'class' => 'img-responsive center-block img-circle' ) );
		}
		
		static function df_load_comment_and_share( $is_meta_full ){
			// render full post meta
			if ( "no" == strtolower( $is_meta_full ) ){
			?>
				<a href="<?php echo esc_url( get_permalink() );?>"><i class="ion-share"></i>
				<?php
					if (class_exists('DF_Social_Media') ) {
						echo DF_Social_Media::df_get_all_social_media_counter( get_permalink() );
					} 
				?></a>
			<?php
			}
			// render short post meta
			else {
				if ( comments_open() ) {
			?>
					<a href="<?php echo esc_url( get_permalink() );?>" class="comment-counter"><i class="ion-chatbubble"></i> <?php echo get_comments_number() . " " . __('comments','onfleek') ?></a>
			<?php 
				}
			?>
				<a href="<?php echo esc_url( get_permalink() );?>"><i class="ion-share"></i>
				<?php
					if (class_exists('DF_Social_Media') ) {
						echo DF_Social_Media::df_get_all_social_media_counter( get_permalink() ) . " " . __( 'Shares', 'onfleek' );
					} 
				?></a>
			<?php
			}
		}
		
		/**
		 * df_load_title_and_content
		 */
		static function df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt ){
			$dv_excerpt = get_the_excerpt();
				if ( '' != $dv_excerpt ) {
					$dv_archive_content = strip_shortcodes( $dv_excerpt );
				}else {
					$dv_archive_content = strip_shortcodes( get_the_content() );
				}

			if ( 'yes' == $is_excerpt ) {
				if ( 'yes' == $is_thumbnail ) {
					echo '<'. $title_size .' class="article-title"><a href="' . esc_url( get_permalink() ) . '">' . wp_trim_words( get_the_title(), 6, ' ...') . '</a></'. $title_size .'>';
				} else {
					echo '<'. $title_size .' class="article-title"><a href="' . esc_url( get_permalink() ) . '">'. get_the_title() .'</a></'. $title_size .'>';
				}
				if ( 'layout-5' == $use_layout ) {
					if ( DF_Framework::df_is_mobile() ){
						$dv_content = sprintf( '<p class="article-content">%s</p>' , wp_trim_words( $dv_archive_content, 14, ' ...') );
					} else {
						$dv_content = sprintf( '<p class="article-content">%s</p>' , wp_trim_words( $dv_archive_content, 40, ' ...') );
					}
				} else {
					$dv_content = sprintf( '<p class="article-content">%s</p>' , wp_trim_words( $dv_archive_content, 14, ' ...') );
				}
				echo $dv_content;
			} else {
				if ( 'yes' == $is_thumbnail || 'widget-blocks-9' == $use_layout || 'main-blocks' == $use_layout ) {
					echo  '<'. $title_size .' class="article-title"><a href="' . esc_url( get_permalink() ) . '">' . wp_trim_words( get_the_title(), 6, ' ...') . '</a></'. $title_size .'>';
				} else {
					echo '<'. $title_size .' class="article-title"><a href="' . esc_url( get_permalink() ) . '">'. get_the_title() .'</a></'. $title_size .'>';
				}
			}
		}
		
		/**
		 * df_get_authorbox_social
		**/
		static function df_load_authorbox_social(){
			$user_data			= get_user_meta(get_the_author_meta('ID'));
			$facebook          	= isset( $user_data['facebook'][0] ) ? $user_data['facebook'][0] : '';
			$twitter           	= isset( $user_data['twitter'][0] ) ? $user_data['twitter'][0] : '';
			$pinterest         	= isset( $user_data['pinterest'][0] ) ? $user_data['pinterest'][0] : '';
			$gplus             	= isset( $user_data['gplus'][0] ) ? $user_data['gplus'][0] : '';
			$linkedin          	= isset( $user_data['linkedin'][0] ) ? $user_data['linkedin'][0] : '';
			$email             	= isset( $user_data['email'][0] ) ? $user_data['email'][0] : '';
			$facebookaccount   	= "https://www.facebook.com/".$facebook;
			$twitteraccount    	= "https://twitter.com/".$twitter;
			$pinterestaccount  	= "https://pinterest.com/".$pinterest;
			$gplusaccount      	= "https://plus.google.com/".$gplus;
			$linkedinaccount   	= "https://linkedin.com/".$linkedin;
			?>
			<ul class="list-inline">
				<?php 
				if($facebook != '' || !isset($facebook)) {
					?>
					<li>
						<a href="<?php echo esc_url( $facebookaccount );?>" target="_blank">
							<i class="fa fa-facebook"></i>
						</a>
						<ul class="sharing-hover">
							<li>Facebook</li>
						</ul>
					</li>
				<?php } 
				?>
				<?php
				if($twitter !== '' || !isset($twitter)) {
					?>
					<li>
						<a href="<?php echo esc_url( $twitteraccount ); ?>" target="_blank">
							<i class="fa fa-twitter"></i>
						</a>
						<ul class="sharing-hover">
							<li>Twitter</li>
						</ul>
					</li>
				<?php }
				?>
				<?php
				if($pinterest !== '' || !isset($pinterest)) {
					?>
					<li>
						<a href="<?php echo esc_url( $pinterestaccount );?>">
							<i class="fa fa-pinterest"></i>
						</a>
						<ul class="sharing-hover">
							<li>Pinterest</li>
						</ul>
					</li>
				<?php }
				?>
				<?php
				if($gplus !== '' || !isset($gplus)) {
					?>
					<li>
						<a href="<?php echo esc_url( $gplusaccount );?>">
							<i class="fa fa-google-plus"></i>
						</a>
						<ul class="sharing-hover">
							<li>Google +</li>
						</ul>
					</li>
				<?php }
				?>
				<?php
				if($linkedin !== '' || !isset($linkedin)) {
					?>
					<li>
						<a href="<?php echo esc_url( $linkedinaccount ); ?>">
							<i class="fa fa-linkedin"></i>
						</a>
						<ul class="sharing-hover">
							<li>Linkedin</li>
						</ul>
					</li>
				<?php }
				?>
				<?php
				if( "" !== $email || !isset($email)) {
					?>
					<li>
						<a href="mailto:<?php echo ( $email ) ?>">
							<i class="fa fa-envelope-o"></i>
						</a>
						<ul class="sharing-hover">
							<li>Email</li>
						</ul>
					</li>
				<?php }
				?>
			</ul>
			<?php 
		}
		
		/**
		 * df_load_post_meta
		 */
		static function df_load_post_meta(){
			?>
			<div class="post-meta">
				<ul class="list-inline">
				<?php	if ( $is_show_author_name == 'yes' ) {?>
					<li>
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, $default = '' , $alt ='' , array( 'class' => 'img-circle')  );?>
					</li>
				<li>
				<div class="authors-meta">
					<div class="vcard">
						<span>by</span>
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"> <?php echo get_the_author();?></a>
						<?php	}
						if ( $is_show_date == 'yes' ) {?>
						<span><time><?php echo the_date('F j, Y');?></time></span>
					</div>
				</div>
				</li>
				<?php	}?>
				<li class="pull-right">
					<ul class="list-inline">
						<?php   if ( $is_show_post_views == 'yes' ) {?>
							<li>
								<i class="ion-eye"></i>
								<span><?php echo DF_Content::df_get_page_view( get_the_ID() ) . " " . __( 'views' , 'onfleek');?></span>
							</li>
						<?php	}
						if ( $is_show_comment_counts == 'yes' ) {
							if ( comments_open() ) {?>
								<li>
									<i class="ion-chatbubble"></i>
									<span><?php echo get_comments_number();?></span>
								</li>
						<?php	}
						}?>
					</ul>
				</li>
				</ul>
			</div>
			<?php
		}
		
		/**
		 * df_load_post_meta_single
		 */
		static function df_load_post_meta_single( $author, $date, $post_views, $comment_counts, $layout ) {
	  		if( "layout1" == $layout || "layout5" == $layout || "layout6" == $layout || "layout9" == $layout ) {
				if( DF_Framework::df_is_mobile() ){?>
			  		<div class="post-meta single-mobile">
						<div class="post-meta-avatar clearfix">
					  		<a href="#">
					  			<?php self::df_load_avatar_author(); ?>
					  		</a>
						</div>
						<div class="post-meta-desc with-avatar">
					  		<div class="post-meta-desc-top">
						  		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="author-name">
									<?php echo get_the_author();?>
							  	</a>
					  
						  	<?php
								$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
								$time_string = sprintf( $time_string,
								esc_attr( get_the_date( 'c' ) ),
								get_the_date()
								);
								$posted_on = sprintf(
								esc_html_x( '%s', 'post date', 'onfleek' ),
								'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
								);

								echo $posted_on
						  	?>
					  		</div>
					  		<div class="post-meta-desc-btm">
						  		<?php if( comments_open() ){?>
						  			<a href="#"><i class="ion-chatbubble"></i> <?php echo get_comments_number();?> comments</a>
						  		<?php } 
				  				if ( class_exists( "DF_Social_Media" ) ) {
								?>
								<a href="#"><i class="ion-share"></i> <?php echo DF_Social_Media::df_get_all_social_media_counter( get_permalink() ) . " " . __( 'Shares', 'onfleek' ) ?></a>
								<?php } ?>
						  	</div>
						</div>
			  		</div>
					<?php } else {?>
			  		<div class="post-meta">
				  		<ul class="list-inline no-margin">
				  			<?php if ( $author == 'yes' ) {?>
							<li>
					  			<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, $default = '' , $alt ='' , array( 'class' => ' img-circle')  ); ?>
							</li>
							<li>
					  			<div class="authors-meta">
									<div class="vcard">
						  				<span>by</span>
						  				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author();?></a>
								  	<?php 
										  if ( $date == 'yes') { 
									?>
						  				<span><?php echo the_date('F j, Y');?></span>
						  				<?php } ?>
									</div>
					  			</div>
							</li>
				  		<?php }	?>
							<li class="pull-right">
			 					<ul class="list-inline no-margin">
					  				<?php if ( $post_views == 'yes' ) { ?>
										<li>
						  					<i class="ion-eye"></i><span><?php echo DF_Content::df_get_page_view( get_the_ID() ) . " " . __( 'views' , 'onfleek');?></span>
										</li>
				 					 	<?php }
											  if ( $comment_counts == 'yes' ) { 
												if ( comments_open() ) {
									  	?>
										<li>
						  					<i class="ion-chatbubble"></i><span><?php echo get_comments_number();?></span>
										</li>
								  		<?php
									  		}
										}
									  	?>
					  			</ul>
							</li>
				  		</ul>
					</div>
				<?php }
		  			} else if( "layout2" == $layout || "layout3" == $layout || "layout4" == $layout ){
						if( DF_Framework::df_is_mobile() ) {?>
			  				<div class="post-meta single-mobile background">
								<div class="post-meta-avatar clearfix">
				  					<a href="#">
				  						<?php echo get_avatar( get_the_author_meta( 'ID' ), 32, $default = '' , $alt ='' , array( 'class' => 'img-responsive img-circle')  ); ?>
				  					</a>
								</div>
								<div class="post-meta-desc with-avatar">
					  				<div class="post-meta-desc-top">
					  					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="author-name">
											<?php echo get_the_author();?>
				 				 		</a>
					  
							  			<?php
											$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
											$time_string = sprintf( $time_string,
											esc_attr( get_the_date( 'c' ) ),
											get_the_date()
											);
											$posted_on = sprintf(
											esc_html_x( '%s', 'post date', 'onfleek' ),
												'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
											);

											echo $posted_on;
									  	?>
					  				</div>
					  				<div class="post-meta-desc-btm">
						  				<?php if( comments_open() ){?>
						  					<a href="#"><i class="ion-chatbubble"></i> <?php echo get_comments_number();?> comments</a>
						  				<?php } 
						  				if ( class_exists( "DF_Social_Media" ) ) {
										?>
										<a href="#"><i class="ion-share"></i> <?php echo DF_Social_Media::df_get_all_social_media_counter( get_permalink() ) . " " . __( 'Shares', 'onfleek' ) ?></a>
										<?php } ?>
						  			</div>
								</div>
			  				</div>
			  			<?php
			  				} else { ?>
			  			<div class="post-meta background">
							<ul class="list-inline">
							<?php
						  		if ( $author == 'yes' ) {
							?>
			 					<li>
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, $default = '' , $alt ='' , array( 'class' => 'img-circle')  );?>
				  				</li>
				  				<li>
									<div class="authors-meta">
					  					<div class="vcard">
											<span>by</span>
											<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author();?></a>
							<?php 
				  				}
								if ( $date == 'yes' ) { ?>
											<span><?php echo the_date('F j, Y');?></span>
								<?php   } ?>
					  					</div>
									</div>
				  				</li>
							
				 				 <li>
									<ul class="list-inline no-margin">
									<?php   if ( $post_views == 'yes' ) { ?>
					  					<li>
											<i class="ion-eye"></i><span><?php echo self::df_get_page_view( get_the_ID() ) . " " . __( 'views' , 'onfleek');?></span>
					  					</li>
									<?php   }
										if ( $comment_counts == 'yes' ) {
						  					if ( comments_open() ) {
									?>
					  					<li>
											<i class="ion-chatbubble"></i><span><?php echo get_comments_number();?></span>
					  					</li>
								  	<?php }
									}?>
									</ul>
				  				</li>
							</ul>
			  			</div>
			  	<?php } 
				}
		}
		
		/**
		 * df_load_back_top
		 */
		static function df_load_back_top(){
			?>
			<a href="#0" class="cd-top df-btn df-btn-normal">
				<i class="ion-ios-arrow-up"></i>
			</a>
			<?php
		}

		static function df_auto_play_carousel () {
			$auto_play = array (
							'auto_play' => 'false',
							'auto_play_speed' => 5000
				);
			if ( ( !isset( DF_Global_Options::$options['categories']['is_auto_play_carousel'] ) && empty( DF_Global_Options::$options['categories']['is_auto_play_carousel']) ) ) {
				return $auto_play;	
			}else if( DF_Global_Options::$options['categories']['is_auto_play_carousel'] == 'yes' ){
				$auto_play['auto_play'] = 'true';
				if ( isset( DF_Global_Options::$options['categories']['auto_play_speed'] ) && !empty( DF_Global_Options::$options['categories']['auto_play_speed']) ) {
					$auto_play['auto_play_speed'] = DF_Global_Options::$options['categories']['auto_play_speed'];
				}
				
			}
			return $auto_play;
		}
	}
}