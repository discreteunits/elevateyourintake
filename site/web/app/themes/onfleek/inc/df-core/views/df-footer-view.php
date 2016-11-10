<?php
/**
 * Class: DF_Footer_View
 * Description: Class for load footer view
 */
if( !class_exists( 'DF_Footer_View' ) ){

	class DF_Footer_View {

		function __construct(){

		}

		static function df_load_footer( $params_setting ) {
			extract( $params_setting );
			get_template_part( 'inc/df-core/views/df-footer/df', $footer_name );
		}

	}

}