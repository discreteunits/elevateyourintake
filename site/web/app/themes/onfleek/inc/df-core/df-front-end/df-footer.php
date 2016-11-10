<?php
/**
 * Class: DF_Footer
 * Description: Class for call footer layout
 */
if( !class_exists( 'DF_Footer' ) ){

	class DF_Footer extends DF_Options {

		static $footer_display_footer = 'df_magz_post_display_footer';
		static $footer_copyright_info = 'df_magz_post_copyright_info';

		static $footer_display_footer_page = 'df_magz_page_display_footer';
		static $footer_copyright_info_page = 'df_magz_page_copyright_footer';

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
		
		public static $footer_params = array();

		/**
		 * __construct
		 */
		function __construct(){
			// construct here
		}

		/**
		 * df_get_social_share_footer
		 **/
		static function df_get_footer_social_share(){
			$sos = self::df_get_social_account_options();
			$acc = $sos['account'];
			extract($acc);
			?>
			<ul class="df-footer-social-logo list-inline style1">
				<?php if ( $rss !== '' ) {?><li><a href="<?php echo esc_url( $rss ); ?>" class="df-top-bar-social"><i class="fa fa-rss"></i></a></li><?php } ?>
				<?php if ( $facebook !== '' ) {?><li><a href="<?php echo esc_url( $facebook ); ?>" class="df-top-bar-social"><i class="fa fa-facebook"></i></a></li><?php } ?>
				<?php if ( $twitter !== '' ) {?><li><a href="<?php echo esc_url( $twitter ); ?>" class="df-top-bar-social"><i class="fa fa-twitter"></i></a></li><?php } ?>
				<?php if ( $google_plus !== '' ) {?><li><a href="<?php echo esc_url( $google_plus ); ?>" class="df-top-bar-social"><i class="fa fa-google-plus"></i></a></li><?php } ?>
				<?php if ( $linkedin !== '' ) {?><li><a href="<?php echo esc_url( $linkedin ); ?>" class="df-top-bar-social"><i class="fa fa-linkedin"></i></a></li><?php } ?>
				<?php if ( $youtube !== '' ) {?><li><a href="<?php echo esc_url( $youtube ); ?>" class="df-top-bar-social"><i class="fa fa-youtube-play"></i></a></li><?php } ?>
				<?php if ( $vimeo !== '' ) {?><li><a href="<?php echo esc_url( $vimeo ); ?>" class="df-top-bar-social"><i class="fa fa-vimeo"></i></a></li><?php } ?>
				<?php if ( $vk !== '' ) {?><li><a href="<?php echo esc_url( $vk ); ?>" class="df-top-bar-social"><i class="fa fa-vk"></i></a></li><?php } ?>
				<?php if ( $instagram !== '' ) {?><li><a href="<?php echo esc_url( $instagram ); ?>" class="df-top-bar-social"><i class="fa fa-instagram"></i></a></li><?php } ?>
				<?php if ( $pinterest !== '' ) {?><li><a href="<?php echo esc_url( $pinterest ); ?>" class="df-top-bar-social"><i class="fa fa-pinterest"></i></a></li><?php } ?>
				<?php if ( $flickr !== '' ) {?><li><a href="<?php echo esc_url( $flickr ); ?>" class="df-top-bar-social"><i class="fa fa-flickr"></i></a></li><?php } ?>
				<?php if ( $bloglovin !== '' ) {?><li><a href="<?php echo esc_url( $bloglovin ); ?>" class="df-top-bar-social"><i class="fa fa-heart"></i></a></li><?php } ?>
				<?php if ( $spotify !== '' ) {?><li><a href="<?php echo esc_url(  $spotify ); ?>" class="df-top-bar-social"><i class="fa fa-spotify"></i></a></li><?php } ?>
			</ul>
		<?php
		} 

		/**
		 * df_get_footer
		 * @param -
		 * @return -
		 */
		static function df_get_footer(){
			$post_id = '';
			$footer_display = '';
			$sub_footer_display = '';
			$footer = self::df_get_footer_options();
            $sos = self::df_get_social_account_options();
			$footer_status = $footer['is_display_footer'];
			$footer_area_layout = isset( $footer['footer_area_layout'] ) ? $footer['footer_area_layout']: 'full';
			$footer_layout = $footer['footer_layout'];
			$footer_logo_normal = $footer['footer_logo_normal'];
			$footer_text = $footer['footer_text'];
			$footer_social_icon = $footer['is_social_icon'];
			$subfooter_status = $footer['is_show_subfooter'];
			$subfooter_text = $footer['sub_footer_copyright_text'];
			$footer_selected = self::$footer_type[$footer_layout];
			extract( $footer_selected );
            $acc = $sos['account'];
            if( is_archive() || is_search() || is_404() || is_home() ){
            	$footer_display = $footer_status;
            	$sub_footer_display = $subfooter_status;
            }else{
            	$footer_display = DF_CSS_Options::$metabox->footer;
            	$sub_footer_display = DF_CSS_Options::$metabox->sub_footer;
            }

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
				'footer_name' 			=> $footer_name,
				'footer_option' 		=> $footer_option,
				'footer_area' 			=> $footer_area,
				'footer_widget' 		=> $footer_widget,
				'display_footer' 		=> $footer_display,
				'footer_logo_normal' 	=> $footer_logo_normal,
				'footer_area_layout'	=> $footer_area_layout,		
				'footer_text' 			=> $footer_text,
				'footer_social_icon' 	=> $footer_social_icon,
				'display_subfooter' 	=> $sub_footer_display,
				'subfooter_text' 		=> $subfooter_text
			);
			self::$footer_params = $params_setting;
			DF_Footer_View::df_load_footer( $params_setting );
		}

		/**
		 * df_get_footer_area_layout
		 * @param -
		 * @return $footer_area_layout
		 */
		static function df_get_footer_area_layout(){
			$footer = self::df_get_footer_options();
			$footer_area_layout = isset( $footer['footer_area_layout'] ) ? $footer['footer_area_layout']: 'full';
			return $footer_area_layout;
		}
	}
}

/* file location: [theme directory]/inc/df-core/df-front-end/df-footer.php */
