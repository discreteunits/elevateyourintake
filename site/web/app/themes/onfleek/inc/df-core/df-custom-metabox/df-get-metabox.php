<?php
if(!class_exists("DF_get_metabox")){
	
	Class DF_get_metabox{
		
		public $post_layout 	 				= 'layout-1';
		public $layout_global 					= 'fullwidth'; 
		public $featured_image 	 				= 'yes';
		public $primary_category 				= 'auto';
		public $layout 		 	 				= 'default';
		public $custom_sidebar	 				= 'sidebar-1';
		public $subtitle 		 				= '';
		public $listicle_layout					= 'no-smart-list';
		public $list_listicle                   = '';
		public $show_number 					= 'enable';
		public $ordering 						= 'asc';
		public $embed 							= '';
		public $galery 							= '';
		public $review 							= 'disable';
		public $feature_name 					= '';
		public $review_placement 				= '';
		public $review_conclusion				= '';
		public $summary							= '';
		public $header_style					= 'header-1';
		public $top_bar 						= 'yes';
		public $global_content_layout 			= 'full';
		public $content_layout 					= 'default';
		public $background_image 				= '';
		public $background_repeat 				= '';
		public $background_posisition 			= '';
		public $background_size 				= '';
		public $background_attachment 			= '';
		public $background_colour 				= '';
		public $footer 							= 'yes';
		public $sub_footer 						= 'yes';
		public $page_post_layout                = '';
		public $page_show_list_title            = '';
		public $page_list_title                 = '';
		public $page_post_id_filter             = '';
		public $page_category_filter            = '';
		public $page_multi_category_filter      = null;
		public $page_filter_by_tag              = '';
		public $page_filter_by_author           = '';
		public $page_post_type                  = '';
		public $page_sort_order                 = '';
		public $page_max_number_of_post         = '';
		public $page_pagination                 = '';
		public $page_offset_post                = '';
		//public $page_unique_article            = 'default';
		public $page_view 						= '';
		public $secondary_image                 = '';
		public $page_template                   = '';
		function __construct(){
			
		}

		public function df_get_metabox_value( $post_id ) {
			$df_post_meta = get_post_meta ( $post_id , '', true);
			return $df_post_meta;
		}

		public function df_get_post_meta_value( $post_id ) {
			$df_global_options 	         = DF_Global_Options::$options;
			$df_post_meta 		         = get_post_meta( $post_id , '', false);
			/** General Layout */
			if ( !isset( $df_post_meta['df_magz_post_post_layout'][0] ) || '' == $df_post_meta['df_magz_post_post_layout'][0] || 'default' == $df_post_meta['df_magz_post_post_layout'][0]  ){
				$this->post_layout = isset( $df_global_options['post_setting']['layout'] ) ? $df_global_options['post_setting']['layout'] : $this->post_layout ;
			}else {
				$this->post_layout = $df_post_meta['df_magz_post_post_layout'][0];
			}

			if ( !isset( $df_post_meta['df_magz_post_featured_image'][0] ) || 'default' == $df_post_meta['df_magz_post_featured_image'][0] ){
				$this->featured_image = $df_global_options['post_setting']['is_feature_image'];
			}else {
				$this->featured_image = ( $df_post_meta['df_magz_post_featured_image'][0] == 'enable' ) ? 'yes' : 'no';
			}

			$this->primary_category = ( isset( $df_post_meta['df_magz_post_primary_category'][0] ) ) ? $df_post_meta['df_magz_post_primary_category'][0] : $this->primary_category;

			if ( !isset( $df_post_meta['df_magz_post_layout'][0] ) || '' == $df_post_meta['df_magz_post_layout'][0] || 'default' == $df_post_meta['df_magz_post_layout'][0]  ){
				$this->layout_global = isset( $df_global_options['template_setting']['blogpost_template']['layout'] ) ? $df_global_options['template_setting']['blogpost_template']['layout'] : $this->layout_global ;
			}else {
				$this->layout_global = $df_post_meta['df_magz_post_layout'][0];
			}
			
			if ( !isset( $df_post_meta['df_magz_post_custom_sidebar'][0] ) || 'default' == $df_post_meta['df_magz_post_custom_sidebar'][0] || '' == $df_post_meta['df_magz_post_custom_sidebar'][0] ){
			   $this->custom_sidebar 	= isset( $df_global_options['template_setting']['blogpost_template']['sidebar_widget'] ) ? $df_global_options['template_setting']['blogpost_template']['sidebar_widget'] : $this->custom_sidebar;
			}else{
				 $this->custom_sidebar 	= $df_post_meta['df_magz_post_custom_sidebar'][0]; 
			}
			
			$this->subtitle 		= ( isset ( $df_post_meta['df_magz_post_subtitle'][0] ) ) ? $df_post_meta['df_magz_post_subtitle'][0] : $this->subtitle;
			/** Listicle */
			$this->listicle_layout	= ( isset ($df_post_meta['df_magz_post_smart_list'][0] ) ) ? $df_post_meta['df_magz_post_smart_list'][0] : $this->listicle_layout;
			$this->list_listicle    = maybe_unserialize(( isset($df_post_meta['df_magz_post_listicle'][0] ) ) ? $df_post_meta['df_magz_post_listicle'][0] : $this->list_listicle  );
			$this->show_number		= ( isset( $df_post_meta['df_magz_post_show_number'][0] ) ) ? $df_post_meta['df_magz_post_show_number'][0] : $this->show_number;
			$this->ordering 		= ( isset( $df_post_meta['df_magz_post_ordering'][0] ) ) ? $df_post_meta['df_magz_post_ordering'][0] : $this->ordering;
			/** Media Embed */
			$this->embed 		= ( isset( $df_post_meta['df_magz_post_media_embed'][0] ) ) ? $df_post_meta['df_magz_post_media_embed'][0] : $this->embed;
			$this->galery 			= maybe_unserialize(isset($df_post_meta['df_magz_post_gallery'][0]) ? $df_post_meta['df_magz_post_gallery'][0] : $this->galery);
			/** Review */
			if ( !isset( $df_post_meta['df_magz_post_review_post'][0] ) || 'disabled' == $df_post_meta['df_magz_post_review_post'][0] ||  '' == $df_post_meta['df_magz_post_review_post'][0] ){
				 $this->review 				= isset( $df_post_meta['df_magz_post_review_post'][0] ) ? $df_post_meta['df_magz_post_review_post'][0] : $this->review ;	//disable review
			}else{
				$this->review 				= isset( $df_post_meta['df_magz_post_review_post'][0] ) ? $df_post_meta['df_magz_post_review_post'][0] : $this->review ;		//enable review	
				$this->feature_name         = maybe_unserialize($df_post_meta['df_magz_post_feature_reviews'][0]); 
				$this->review_placement 	= isset( $df_post_meta['df_magz_post_review_location'][0] ) ?  $df_post_meta['df_magz_post_review_location'][0] : $this->review_placement   ;
				$this->review_conclusion 	= isset( $df_post_meta['df_magz_post_positive_title'][0] ) ? $df_post_meta['df_magz_post_positive_title'][0] : $this->review_conclusion ;
				$this->summary 				= isset( $df_post_meta['df_magz_post_summary'][0])?$df_post_meta['df_magz_post_summary'][0]:$this->summary;
			}
			/** Header */
			if ( !isset( $df_post_meta['df_magz_post_header_type'][0] ) || 'inherit' == $df_post_meta['df_magz_post_header_type'][0] ||  '' == $df_post_meta['df_magz_post_header_type'][0] ){ //checking custom metabox
				if ( 'inherit' == $df_global_options['template_setting']['blogpost_template']['header_layout']|| !isset( $df_global_options['template_setting']['blogpost_template']['header_layout'] ) || '' == $df_global_options['template_setting']['blogpost_template']['header_layout'] ) { //checking template setting
					$this->header_style 	= isset( $df_global_options['general']['global']['header_layout'] ) ? $df_global_options['general']['global']['header_layout'] : $this->header_style; 
				}else{
					$this->header_style 	= $df_global_options['template_setting']['blogpost_template']['header_layout'];
				}
			}else{
				$this->header_style 	= $df_post_meta['df_magz_post_header_type'][0]; 
			}
			
			if ( !isset( $df_post_meta['df_magz_post_top_bar'][0] ) || 'inherit' == $df_post_meta['df_magz_post_top_bar'][0] ||  '' == $df_post_meta['df_magz_post_top_bar'][0] ){
				$this->top_bar	= isset( $df_global_options['general']['global']['is_topbar'] ) ? $df_global_options['general']['global']['is_topbar'] : $this->top_bar ; 
			}else{
				$this->top_bar 	= ( 'enable' == $df_post_meta['df_magz_post_top_bar'][0] ) ? 'yes' : 'no'; 
			}
			
			/** Background */
			if ( !isset( $df_post_meta['df_magz_post_content_layout'][0] ) || 'default' == $df_post_meta['df_magz_post_content_layout'][0] ||  '' == $df_post_meta['df_magz_post_content_layout'][0] ){
				$this->content_layout	= isset( $df_global_options['general']['global']['layout'] ) ? $df_global_options['general']['global']['layout'] : $this->content_layout ; 
			}else{
				$this->content_layout 	= $df_post_meta['df_magz_post_content_layout'][0]; 
			}
			$this->background_image			= ( isset ( $df_post_meta['df_magz_post_background_image'][0] ) ) ? $df_post_meta['df_magz_post_background_image'][0] : $this->background_image;
			$this->background_repeat		= ( isset ( $df_post_meta['df_magz_post_background_repeat'][0] ) ) ? $df_post_meta['df_magz_post_background_repeat'][0] : $this->background_repeat;
			$this->background_posisition	= ( isset ( $df_post_meta['df_magz_post_background_position'][0] ) ) ? $df_post_meta['df_magz_post_background_position'][0] : $this->background_posisition;
			$this->background_size			= ( isset ( $df_post_meta['df_magz_post_background_size'][0] ) ) ? $df_post_meta['df_magz_post_background_size'][0] : $this->background_size;
			$this->background_attachment	= ( isset ( $df_post_meta['df_magz_post_background_attachment'][0] ) ) ? $df_post_meta['df_magz_post_background_attachment'][0] : $this->background_attachment;
			$this->background_colour		= ( isset ( $df_post_meta['df_magz_post_background_colour'][0] ) ) ? $df_post_meta['df_magz_post_background_colour'][0] : $this->background_colour;
			
			/** Footer */
			if ( !isset( $df_post_meta['df_magz_post_display_footer'][0] ) || 'inherit' == $df_post_meta['df_magz_post_display_footer'][0] ||  '' == $df_post_meta['df_magz_post_display_footer'][0] ){
				$this->footer	= isset($df_global_options['footer']['is_display_footer']) ? $df_global_options['footer']['is_display_footer'] : $this->footer  ; 
			}else{
				$this->footer 	= ('enable' == $df_post_meta['df_magz_post_display_footer'][0] ) ? 'yes' : 'no'; 
			}
			if ( !isset( $df_post_meta['df_magz_post_copyright_info'][0] ) ||  'inherit' == $df_post_meta['df_magz_post_copyright_info'][0] || '' == $df_post_meta['df_magz_post_copyright_info'][0] ){
				$this->sub_footer	= isset( $df_global_options['footer']['is_show_subfooter'] ) ? $df_global_options['footer']['is_show_subfooter'] : $this->sub_footer ; 
			}else{
				$this->sub_footer 	= ( 'enable' == $df_post_meta['df_magz_post_copyright_info'][0] ) ? 'yes' : 'no'; 
			}
			
			$this->page_view = isset($df_post_meta['df_page_view'][0]) ? $df_post_meta['df_page_view'][0] : $this->page_view  ;
			$this->secondary_image = isset( $df_post_meta['post_secondary-image_thumbnail_id'][0] ) ? $df_post_meta['post_secondary-image_thumbnail_id'][0] : $this->secondary_image ;
			
		}

		public function df_get_page_meta_value ( $post_id ) {
			$df_global_options 	= DF_Global_Options::$options;
			$df_post_meta 		= get_post_meta( $post_id , '', true);
			/** General Layout */
			if ( !isset( $df_post_meta['df_magz_page_layout'][0] ) || '' == $df_post_meta['df_magz_page_layout'][0] || 'default' == $df_post_meta['df_magz_page_layout'][0] || 'inherit' == $df_post_meta['df_magz_page_layout'][0] ){
				$this->post_layout = isset( $df_global_options['template_setting']['page_template']['layout'] ) ? $df_global_options['template_setting']['page_template']['layout'] : $this->post_layout  ;
			}else {
				$this->post_layout = $df_post_meta['df_magz_page_layout'][0];
			}
			
			
			if (  !isset( $df_post_meta['df_magz_page_custom_sidebar'][0] ) || 'default' == $df_post_meta['df_magz_page_custom_sidebar'][0] || '' == $df_post_meta['df_magz_page_custom_sidebar'][0] ){
				$this->custom_sidebar 	= isset($df_global_options['template_setting']['page_template']['sidebar_widget']) ? $df_global_options['template_setting']['page_template']['sidebar_widget'] : $this->custom_sidebar ;
			}else{
				$this->custom_sidebar 	= $df_post_meta['df_magz_page_custom_sidebar'][0]; 
			}
			
			/** Header */
			if ( !isset( $df_post_meta['df_magz_page_header_type'][0] ) || 'inherit' == $df_post_meta['df_magz_page_header_type'][0] ){
				if ( 'inherit' == $df_global_options['template_setting']['page_template']['header_layout'] || 'default' == $df_global_options['template_setting']['page_template']['header_layout'] || !isset( $df_global_options['template_setting']['page_template']['header_layout'] )){
					$this->header_style = isset( $df_global_options['general']['global']['header_layout'] ) ? $df_global_options['general']['global']['header_layout'] : $this->header_style;
				}else{
					$this->header_style = $df_global_options['template_setting']['page_template']['header_layout'];
				}
			}else {
				$this->header_style = $df_post_meta['df_magz_page_header_type'][0];
			}
			
			if ( !isset( $df_post_meta['df_magz_page_top_bar'][0] ) || 'inherit' == $df_post_meta['df_magz_page_top_bar'][0] ||  '' == $df_post_meta['df_magz_page_top_bar'][0] ){
				$this->top_bar	= isset( $df_global_options['general']['global']['is_topbar'] ) ? $df_global_options['general']['global']['is_topbar'] : $this->top_bar ; 
			}else{
				$this->top_bar 	= ( $df_post_meta['df_magz_page_top_bar'][0] == 'enable' ) ? 'yes' : 'no' ; 
			}

			/** Background */
			$this->global_content_layout 	= isset( $df_global_options['general']['global']['layout'] ) ? $df_global_options['general']['global']['layout'] : $this->global_content_layout;
			//$this->content_layout 		    = isset($df_post_meta['df_magz_page_content_layout'][0]) ? $df_post_meta['df_magz_page_content_layout'][0] : $this->content_layout  ;
			if ( !isset( $df_post_meta['df_magz_page_content_layout'][0] ) || 'default' == $df_post_meta['df_magz_page_content_layout'][0] ||  '' == $df_post_meta['df_magz_page_content_layout'][0] ){
				$this->content_layout	= isset( $df_global_options['general']['global']['layout'] ) ? $df_global_options['general']['global']['layout'] : $this->content_layout ; 
			}else{
				$this->content_layout 	= $df_post_meta['df_magz_page_content_layout'][0]; 
			}
			$this->background_image			= ( isset( $df_post_meta['df_magz_page_background_image'][0] ) ) ? $df_post_meta['df_magz_page_background_image'][0] : $this->background_image;
			$this->background_repeat		= ( isset( $df_post_meta['df_magz_page_background_repeat'][0] ) ) ? $df_post_meta['df_magz_page_background_repeat'][0] : $this->background_repeat;
			$this->background_posisition	= ( isset( $df_post_meta['df_magz_page_background_position'][0] ) ) ? $df_post_meta['df_magz_page_background_position'][0] : $this->background_posisition;
			$this->background_size			= ( isset( $df_post_meta['df_magz_page_background_size'][0] ) ) ? $df_post_meta['df_magz_page_background_size'][0] : $this->background_size;
			$this->background_attachment	= ( isset( $df_post_meta['df_magz_page_background_attachment'][0] ) ) ? $df_post_meta['df_magz_page_background_attachment'][0] : $this->background_attachment;
			$this->background_colour		= ( isset( $df_post_meta['df_magz_page_background_colour'][0] ) ) ? $df_post_meta['df_magz_page_background_colour'][0] : $this->background_colour;

			/** Footer */
			if ( !isset( $df_post_meta['df_magz_page_display_footer'][0] ) ||  'inherit' == $df_post_meta['df_magz_page_display_footer'][0] || '' == $df_post_meta['df_magz_page_display_footer'][0] ){
				$this->footer	= isset( $df_global_options['footer']['is_display_footer'] ) ? $df_global_options['footer']['is_display_footer'] : $this->footer; 
			}else{
				$this->footer 	= ( 'enable' == $df_post_meta['df_magz_page_display_footer'][0] ) ? 'yes':'no'; 
			}
			if ( !isset( $df_post_meta['df_magz_page_copyright_info'][0] ) || 'inherit' == $df_post_meta['df_magz_page_copyright_info'][0] ||  '' == $df_post_meta['df_magz_page_copyright_info'][0] ){
				$this->sub_footer	= isset( $df_global_options['footer']['is_show_subfooter'] ) ? $df_global_options['footer']['is_show_subfooter'] : $this->sub_footer  ; 
			}else{
				$this->sub_footer 	= ( 'enable' == $df_post_meta['df_magz_page_copyright_info'][0] ) ? 'yes' : 'no'; 
			}
			
			if ( !isset( $df_post_meta['df_magz_page_post_layout'][0] ) || '' == $df_post_meta['df_magz_page_post_layout'][0] || 'default' == $df_post_meta['df_magz_page_post_layout'][0]  ){
				$this->page_post_layout = isset( $df_global_options['template_setting']['blogpost_template']['article_display_preview'] ) ? $df_global_options['template_setting']['blogpost_template']['article_display_preview'] : $this->page_post_layout ;
			}else {
				$this->page_post_layout = $df_post_meta['df_magz_page_post_layout'][0];
			}
			
			//$this->page_post_layout             = ( '' !== $df_post_meta['df_magz_page_post_layout'][0] ) ? $df_post_meta['df_magz_page_post_layout'][0] : $this->page_post_layout; 
			$this->page_show_list_title         = ( isset( $df_post_meta['df_magz_page_show_list_title'][0] ) ) ? $df_post_meta['df_magz_page_show_list_title'][0] : $this->page_show_list_title; 
			$this->page_list_title              = ( isset( $df_post_meta['df_magz_page_list_title'][0] ) ) ? $df_post_meta['df_magz_page_list_title'][0] : $this->page_list_title; 
			$this->page_post_id_filter          = ( isset( $df_post_meta['df_magz_page_post_id_filter'][0] ) ) ? $df_post_meta['df_magz_page_post_id_filter'][0] : $this->page_post_id_filter; 
			$this->page_category_filter         = ( isset( $df_post_meta['df_magz_page_category_filter'][0] ) ) ? $df_post_meta['df_magz_page_category_filter'][0] : $this->page_category_filter; 
			$this->page_multi_category_filter   = ( isset( $df_post_meta['df_magz_page_multiple_category_filter'][0]) ) ? $df_post_meta['df_magz_page_multiple_category_filter'][0] : $this->page_multi_category_filter; 
			$this->page_filter_by_tag           = ( isset( $df_post_meta['df_magz_page_filter_by_tag_slug'][0] ) ) ? $df_post_meta['df_magz_page_filter_by_tag_slug'][0] : $this->page_filter_by_tag; 
			$this->page_filter_by_author        = ( isset( $df_post_meta['df_magz_page_multiple_author_filter'][0] ) ) ? $df_post_meta['df_magz_page_multiple_author_filter'][0] : $this->page_filter_by_author; 
			$this->page_post_type               = ( isset( $df_post_meta['df_magz_page_post_type'][0] ) ) ? $df_post_meta['df_magz_page_post_type'][0] : $this->page_post_type; 
			$this->page_sort_order              = ( isset( $df_post_meta['df_magz_page_sort_order'][0] ) ) ? $df_post_meta['df_magz_page_sort_order'][0] : $this->page_sort_order; 
			$this->page_max_number_of_post      = ( isset( $df_post_meta['df_magz_page_limit_post_order'][0] ) ) ? $df_post_meta['df_magz_page_limit_post_order'][0] : $this->page_max_number_of_post; 
			$this->page_pagination              = ( isset( $df_post_meta['df_magz_page_pagination'][0] ) ) ? $df_post_meta['df_magz_page_pagination'][0] : $this->page_pagination; 
			$this->page_offset_post             = ( isset( $df_post_meta['df_magz_page_offset_post'][0] ) ) ? $df_post_meta['df_magz_page_offset_post'][0] : $this->page_offset_post; 
			//$this->page_unique_article          = ( isset( $df_post_meta['df_magz_page_unique_article'][0] ) ) ? $df_post_meta['df_magz_page_unique_article'][0] : $this->page_unique_article; 
			$this->page_template                = ( isset( $df_post_meta['_wp_page_template'][0] ) ) ? $df_post_meta['_wp_page_template'][0] : $this->page_template; 
		}

	}

}
