<?php
/**
 * Class: DF_Header_View
 * Description: class for load header view
 */

if( !class_exists( 'DF_Header_View' ) ) {

	Class DF_Header_View {

		static $header_layout_use = '';

		function __construct() {}

		/**
		 * df_load_header
		 * function for load header based on option from metabox & theme
		 */
		static function df_load_header( $params_setting ){
			//extract( $params_setting );

			$explode_header = explode( "-", DF_Header::$header_parameter_setting['meta_layout'] );
			
			$header_select = $explode_header[0]."-".$explode_header[1];

			$header_color_style = ( isset( $explode_header[2] ) ) ? $explode_header[2] : "";
			DF_Header::$header_parameter_setting['header_select'] = $header_select;
			DF_Header::$header_parameter_setting['header_color_style'] = $header_color_style;
			$path = 'inc/df-core/views/df-header/'. $header_select ;
			// self::df_set_header_layout( $meta_layout );
			get_template_part( $path );
			/**depreceated change to get template part
			** for remove info in theme check
			**/
			//do_action('df_get_file_part', '/inc/df-core/views/df-header/'. $header_select .'.php');
		}
	}
}

/* file location: [theme directory]/inc/df-core/views/df-header-view.php */