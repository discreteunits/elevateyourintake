<?php
/**
 * Class: DF_Options
 * Description: Class for get options
 */

if( !class_exists('class_name') ) {

	Class DF_Options {
		
		static $page_type="";

		static $general_options;
		static $general_global_options;
		static $general_breadcumb_options;
		static $general_isbreadcumb_options;
		static $content_layout;

		static $logo_options;
		static $header_options;
		static $menu_options;

		static $tempate_setting_options;
		static $tempate_setting_404;
		static $layout_404;

		static $post_setting_options;
		static $categories_options;
		static $footer_options;
		static $sidebars_options;
		static $color_style_options;
		static $typography_options;
		static $social_account_options;
		static $side_area;
		static $selected_options;
		static $advertisment;
		static $selected_header_options;
		static $default_featured_img;
		static $default_featured_img_id;
		static $social_account;

		function __construct() {
			//add_action('wp', array('DF_Options', 'get_page_type'), 9);
			//$this->df_extract_all_options();
		}

		public function df_extract_all_options(){
			extract( DF_Global_Options::$options );
			self::$general_options = $general;
			self::$general_global_options = $general['global'];
			self::$general_breadcumb_options = $general['breadcrumb'];
			self::$general_isbreadcumb_options = $general['breadcrumb']['is_breadcrumbs'];
			self::$content_layout = $general['global']['layout'];

			self::$default_featured_img = $general['global']['default_feature_image'];
			self::$logo_options = $logo;
			self::$header_options = $header;
			self::$menu_options = $menu_options;

			self::$tempate_setting_options = $template_setting;
			// print_r(self::$tempate_setting_options);
			self::$tempate_setting_404 = $template_setting['404_template'];
			self::$layout_404 = $template_setting['404_template']['layout_404'];

			self::$post_setting_options = $post_setting;
			self::$categories_options = $categories;
			self::$footer_options = $footer;
			self::$sidebars_options = $sidebars;
			self::$color_style_options = $color_style;
			self::$typography_options = $typography;
			self::$social_account_options = $social_account;
			self::$side_area = $side_area;
			self::$advertisment = $advertisment;
			self::$social_account = $social_account;

			self::$default_featured_img = $general['global']['default_feature_image'];
			self::$default_featured_img_id = $this->df_get_image_id2($general['global']['default_feature_image']);
		}

		public function df_get_image_id2( $image_url ) {
			global $wpdb;
			$attachment = $wpdb->get_col( $wpdb->prepare("SELECT IFNULL(ID,0)  FROM $wpdb->posts WHERE guid='%s';", esc_url( $image_url ) ) );
     		if (null == $attachment){
        		return $attachment;
     		}else{
    	    	return $attachment[0];
      		}
		}

		protected static function df_get_all_options(){
			extract( DF_Global_Options::$options );
			$general_options = $general;
			return DF_Global_Options::$options;
		}

		static function get_page_type(){

			if( is_single() ){
				self::$page_type = "df_single";
			}else if( is_page() ){
				self::$page_type = "df_page";
			}else if( is_archive() ){
				self::$page_type = "df_archive";
			}else if( is_404() ){
				self::$page_type = "df_not_found";
			}else if( is_search() ){
				self::$page_type = "df_search";
			}else if (is_home() ){
				self::$page_type = "df_home";
			}else if (is_category() ){
				self::$page_type = "df_category";
			}
			return self::$page_type;
		}

		static function df_get_general_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['general'];
		}

		static function df_get_logo_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['logo'];
		}

		protected static function df_get_header_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['header'];
		}

		static function df_get_header_selected( $selected ){
			$header_style_list = self::df_get_header_options();
			$select = $header_style_list[$selected];
			return $select;
		}

		protected static function df_get_menu_options_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['menu_options'];
		}

		static function df_get_template_setting_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['template_setting'];
		}

		static function df_get_post_setting_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['post_setting'];
		}

		protected static function df_get_categories_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['categories'];
		}

		protected static function df_get_footer_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['footer'];
		}

		protected static function df_get_sidebars_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['sidebars'];
		}

		static function df_get_color_style_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['color_style'];
		}

		protected static function df_get_typography_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['typography'];
		}

		protected static function df_get_social_account_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['social_account'];
		}

		protected static function df_get_side_area_options(){
			//extract( self::df_get_all_options() );
			return DF_Global_Options::$options['side_area'];
		}

		protected static function df_get_header2_options($selected){
			$options = DF_Global_Options::$options;
			$select = $options[$selected];
			return $select;
		}
		
		protected static function df_get_advertisment(){
            //extract( self::df_get_all_options() );
			return DF_Global_Options::$options['advertisment'];
		}

		static function df_get_social_account(){
            //extract( self::df_get_all_options() );
			return DF_Global_Options::$options['social_account'];
		}
	}
}

/* file location: /inc/df-core/df-front-end/df-options.php */