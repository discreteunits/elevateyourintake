<?php
/**
 * Class: DF_Register_Footer_Area
 * Description: Class for register footer area
 */

if( !class_exists( 'DF_Register_Footer_Area' ) ) {

	//require get_template_directory() . '/inc/df-core/df-front-end/df-options.php';

	Class DF_Register_Footer_Area extends DF_Options{

		// temporary, real implementation get from theme option
		static $footer_type = array(
			'footer-layout-1' => array(
					'footer_name' => 'footer-1',
					'footer_option' => 'enable',
					'footer_area' => 'enable',
					'footer_widget' => '2'
				),
			'footer-layout-2' => array(
					'footer_name' => 'footer-2',
					'footer_option' => 'disable',
					'footer_area' => 'enable',
					'footer_widget' => '0'
				),
			'footer-layout-3' => array(
					'footer_name' => 'footer-3',
					'footer_option' => 'enable',
					'footer_area' => 'enable',
					'footer_widget' => '3'
				),
			'footer-layout-4' => array(
					'footer_name' => 'footer-4',
					'footer_option' => 'enable',
					'footer_area' => 'enable',
					'footer_widget' => '2'
				),
			'footer-layout-5' => array(
					'footer_name' => 'footer-5',
					'footer_option' => 'enable',
					'footer_area' => 'enable',
					'footer_widget' => '2'
				),
			'footer-layout-6' => array(
					'footer_name' => 'footer-6',
					'footer_option' => 'enable',
					'footer_area' => 'enable',
					'footer_widget' => '1'
				),
			'footer-layout-7' => array(
					'footer_name' => 'footer-7',
					'footer_option' => 'disable',
					'footer_area' => 'enable',
					'footer_widget' => '3'
				),
			'footer-layout-8' => array(
					'footer_name' => 'footer-8',
					'footer_option' => 'disable',
					'footer_area' => 'enable',
					'footer_widget' => '2'
				),
			'footer-layout-9' => array(
					'footer_name' => 'footer-9',
					'footer_option' => 'disable',
					'footer_area' => 'enable',
					'footer_widget' => '2'
				),
			'footer-layout-10' => array(
					'footer_name' => 'footer-10',
					'footer_option' => 'disable',
					'footer_area' => 'enable',
					'footer_widget' => '1'
				),
			'footer-layout-11' => array(
					'footer_name' => 'footer-11',
					'footer_option' => 'enable',
					'footer_area' => 'enable',
					'footer_widget' => '3'
				),
			'footer-layout-12' => array(
					'footer_name' => 'footer-12',
					'footer_option' => 'enable',
					'footer_area' => 'enable',
					'footer_widget' => '4'
				),
			'footer-layout-13' => array(
					'footer_name' => 'footer-13',
					'footer_option' => 'disable',
					'footer_area' => 'enable',
					'footer_widget' => '4'
				)
		);

		function __construct() {
			 add_action('widgets_init', array( $this, 'df_register_area' ), 10, 1);
  	         add_action( 'df_generate_footernavmenu', array( $this, 'df_generate_footernavmenu' ));
			 add_action( 'init', array( $this, 'register_my_menu' ));
		}

		/**
		 * df_register_widget
		 */
		static function df_register_area(  ){
		
			$footer = self::df_get_footer_options();
			$footer_status = $footer['is_display_footer'];
			$footer_layout = $footer['footer_layout'];
			
			$footer_selected = self::$footer_type[$footer_layout];
			if ( isset( $footer_selected ) && $footer_selected !== null ) {
				extract( $footer_selected );

				for( $i = 1; $i <= $footer_widget; $i++ ){

					register_sidebar(
						array(
							'name' 			=> 'Footer Area '. $i,
							'id' 			=> 'df-footer-area-'. $i,
							'before_widget' => '<div id="%1$s" class="widget %2$s df-footer-top-inner"> ',
							'after_widget' 	=> '</div>',
							'before_title' 	=> '<h5 class="df-widget-title"> ',
							'after_title' 	=> '</h5>',
							'description'	=> 'Footer Area '.$i.'. Add your widget here.'
						)
					);
				}
			}
		}
        
   	    function df_generate_footernavmenu(  ){
            $params_menu = array(	
            			'container'				=> 'li',
            			'menu_class'			=> 'list-inline',
                	'theme_location' 	=> 'footer', 
					'fallback_cb'		=> true
			);
			echo wp_nav_menu( $params_menu );
	    }
        
		static function df_call_footernavmenu(  ){
	     	do_action( 'df_generate_footernavmenu' );
		}
		
	  	function register_my_menu(){
          	register_nav_menu( 'footer'  ,__( 'Footer' , 'onfleek' ));
        }

	}
	new DF_Register_Footer_Area();

}

/* file location: /inc/df-core/df-utils/df-register-footer-area.php */
