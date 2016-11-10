<?php
/**
 * Class: DF_CSS_Options
 * Description: [description]
 */

if( !class_exists( 'DF_CSS_Options' ) ) {

	Class DF_CSS_Options extends DF_Options{
		static $metabox;
		static $array_typo = array();
		static $array_subset = array();
		function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'df_font_register' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'df_global_style') );
			add_action( 'wp_enqueue_scripts', array( $this, 'df_header_style' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'df_menu_style') );
			add_action( 'wp_enqueue_scripts', array( $this, 'df_footer_style') );
			add_action( 'wp_enqueue_scripts', array( $this, 'df_notfound_style' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'df_side_area_style') );
			add_action( 'wp_enqueue_scripts', array( $this, 'df_sidebar_style') );
			add_action( 'wp_enqueue_scripts', array( $this, 'df_get_typo_options') );
			add_action('wp_enqueue_scripts', array($this, 'df_per_page_style'));
			add_action('wp_enqueue_scripts', array($this, 'df_per_post_style'));
			add_action('wp_enqueue_scripts', array($this, 'df_color_styling_general'));
			add_action('wp_enqueue_scripts', array($this, 'df_button_style'));
			add_action('wp_enqueue_scripts', array($this, 'df_get_per_category'));
			add_action('wp_enqueue_scripts', array($this, 'df_get_custom_css'));
			add_action('wp_enqueue_scripts', array($this, 'df_color_category'));
			add_action('wp_enqueue_scripts', array($this, 'df_mobile_header'));
			add_action( 'wp_enqueue_scripts', array( $this, 'df_per_category_style' ) );	

		}

		/**
		 * df_get_font_name
		 * convert name font family from option to google font
		 */
		private function df_get_font_name( $font_family ){
			$ff = explode( " ", $font_family );
			$fontfamily = '';
			switch ( sizeof($ff) ) {
				case '1':
					$fontfamily = $ff[0];
					break;
				case '2':
					$fontfamily = $ff[0]."+".$ff[1];
					break;
				case '3':
					$fontfamily = $ff[0]."+".$ff[1]."+".$ff[2];
					break;
				case '4':
					$fontfamily = $ff[0]."+".$ff[1]."+".$ff[2]."+".$ff[3];
					break;
				case '5':
					$fontfamily = $ff[0]."+".$ff[1]."+".$ff[2]."+".$ff[3]."+".$ff[4];
				default:
					$fontfamily = $ff[0];
					break;
			}
			return $fontfamily;
		}

		function df_side_area_style(){
			wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );
			$sidearea_style = '';

			$sidearea_option = self::df_get_side_area_options();
			$widget_title_color = $sidearea_option['widget_title'];
			$heading_color = $sidearea_option['heading_element_color'];
			$paragraph_color = $sidearea_option['heading_paragraph_color'];
			$link_color = $sidearea_option['link_color'];
			$border_color = $sidearea_option['border_color'];
			$bg_color = $sidearea_option['background']['color'];
			$bg_position = $sidearea_option['background']['position'];
			$bg_repeat = $sidearea_option['background']['repeat'];
			$bg_attachment = $sidearea_option['background']['attachment'];
			$bg_size = $sidearea_option['background']['size'];
			$bg_img = isset($sidearea_option['background']['image']) ? $sidearea_option['background']['image'] : null;
			if($bg_img == null || $bg_img == ''){
				$sidearea_style .= "#page #df-side-menu{
									background-color: ".$bg_color.";
				}";
			} else {
				$sidearea_style .= "
				#page #df-side-menu{
					background-image: url(".$bg_img.");
					background-color: ".$bg_color.";
					background-position: ".$bg_position.";
					background-size: ".$bg_size.";
					background-attachment: ".$bg_attachment.";
					background-repeat: ".$bg_repeat.";
				}";
			}
			$sidearea_style .= "
				#df-side-menu .df-widget-title{
					color: ".$widget_title_color.";
				}

				li.widget .widget-blocks.style-7 .df-shortcode-blocks-main-inner {
					background-color: " .$bg_color. ";
				}
				
				#page #df-side-menu .post-meta-desc a,
				#df-side-menu .nano-content .widget .cat-item a,
				#df-side-menu .nano-content .widget_archive a ,
				#df-side-menu .nano-content .widget_nav_menu a{
					color: ".$link_color.";
				}
				
				#page #df-side-menu h1,
				#page #df-side-menu h5.df-widget-title,
				#page #df-side-menu h4 a,
				#page #df-side-menu h5 a {
					color: ".$heading_color.";
				}

				#page #df-side-menu .widget_text .textwidget , 
				.df-shortcode-blocks-main .article-content p {
					color: ".$paragraph_color.";
				}
				#df-side-menu .widget_archive select,
				#df-side-menu .widget_archive a,
				#df-side-menu .widget_categories select,
				#df-side-menu .widget_categories a,
				#df-side-menu .widget_nav_menu a,
				#df-side-menu .widget_meta a,
				#df-side-menu .widget_pages a,
				#df-side-menu #recentcomments li,
				#df-side-menu .widget_recent_entries li,
				#df-side-menu .df-form-search,
				#df-side-menu button.df-button-search,
				#df-side-menu .tagcloud a,
				#df-side-menu .df-separator,
				#df-side-menu #df-widget-popular-tab ul.df-nav-tab li,
				#df-side-menu #df-widget-popular-tab .tab-pane.df-tab-pane,
				#df-side-menu #df-widget-popular-tab .df-most-popular-list {
					border-color: ".$border_color.";
				}
			";
			$sidearea_style = self::minify_css( $sidearea_style  );
			wp_add_inline_style('custom-style', $sidearea_style);
		}

		function df_font_submit( $element ) {
			$font_family = isset($element['font_family']) ? $element['font_family'] : null;
			if ( $font_family != null && !in_array($font_family,self::$array_typo) ) {
				$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$element['font_weight']);
				$font_weight = $arr[0];
				if ( $font_weight == 'regular' ) $font_weight = '400';
				$font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
				$font_family = $font_family . ":" .$font_weight . $font_style;
				$font_family != null && !in_array($font_family,self::$array_typo) ? array_push(self::$array_typo,$font_family) : null;
			}
			

			$font_subsets = isset($element['font_subsets']) ? $element['font_subsets'] : null;
			$font_subsets != null && !in_array($font_subsets,self::$array_subset) ? array_push(self::$array_subset,$font_subsets) : null;

		}
		/**
		 * df_menu_font_register
		 */
		function df_font_register(){
			//menu options register font
			$menu_options = self::df_get_menu_options_options();
			foreach( $menu_options as $typo=>$value){
				self::df_font_submit( $value );
			}
						
			$typography_option = self::df_get_typography_options();

			foreach( $typography_option as $typo=>$value){
				self::df_font_submit( $value );
			}
			

			//mobile header font register
			$mobile_options = self::df_get_header_options();
			$mobile_header = $mobile_options['mobile_header'];
			self::df_font_submit( $mobile_header );	

			//
			$bind_typo = '';
			$bind_subset = '';
			// print_r( self::$array_typo);
			// die();
			foreach(self::$array_typo as $typo=>$value){
				$bind_typo.=$value.'|';
			}
			for($i=0;$i<count(self::$array_subset);$i++){
				if($i<count(self::$array_subset)-1){
					$bind_subset.=self::$array_subset[$i].',';
				} else {
					$bind_subset.=self::$array_subset[$i];
				}
				
			}

			wp_enqueue_style( 
					'df_typo_font', 
					"//fonts.googleapis.com/css?family=".$bind_typo."&subset=".$bind_subset,
					false 
			);
		}

		function df_global_style(){
			wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );
			$global_style = '';

			$general = self::df_get_general_options();
			$global_options = $general['global'];

			$body_color = $global_options['body_bg_color'];

			$bg_color = $global_options['body_bg_color'];
			$bg_post = explode( "-", $global_options['bg_position'] );
			$bg_repeat = $global_options['bg_repeat'];
			$bg_attachment = $global_options['bg_attachment'];
			$bg_size = $global_options['bg_size'];
			$bg_img = isset($global_options['bg_img']) ? $global_options['bg_img'] : null;
			$outer_bg_color = $global_options['bg_color'];
			
			$content_layout = $global_options['layout'];
			if(null == $bg_img || '' == $bg_img){
				$global_style .= ".df-bg{
									background-color: ".$outer_bg_color.";
									}";
			} else {
				$global_style .= "
				.df-bg{
					background:url(".$bg_img.");
					background-repeat: ".$bg_repeat.";
					background-position: ".$bg_post[0]." ".$bg_post[1].";
					-webkit-background-size: ".$bg_size.";
					-moz-background-size: ".$bg_size.";
					-o-background-size: ".$bg_size.";
					background-size: ".$bg_size."; 
					background-attachment: ".$bg_attachment.";
					background-color: ".$outer_bg_color.";
				}";
			}
			$global_style .= "
				.main-blocks.style-7 .df-shortcode-blocks-main-inner {
					background: ".$bg_color.";
				}
				#df-archive-wrapper .boxed,
				.df-content-boxed .boxed,
				.df-content-frame .boxed,
				.infinite-loader,
				.pre-loader {
					background-color: ".$bg_color.";
				}
				.tagcloud a:hover {
					background-color: ".$body_color.";
				}
				
				.container.df-bg-content{
					 background-color: ".$bg_color.";
				}
				.df-wrapper-inner{
					background-color: ".$bg_color.";
				}
				#search {
					background-color : ". self::hex2rgba( $bg_color , 0.95 ) . "; 
				}
				";
			if( $content_layout == 'full'){
				$global_style .= "
					#df-content-wrapper.df-content-full{
						background: ".$bg_color.";
					}
				";
			}
			$global_style = self::minify_css( $global_style  );
			wp_add_inline_style( 'custom-style', $global_style );
		}

		/**
		 * df_header_style
		 */
		function df_header_style(){
			wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );
			$counter = 1;
			$total = 6;
			$header_style = '';
			for( $counter = 1 ; $counter <= $total; $counter++ ){
				$header = self::df_get_header_selected( 'header_style_'.$counter );	

				if( $counter <= 4 ){ // header 1-4
					$header_logo_top_padding = $header['header_logo_top_padding'];
					$header_logo_bottom_padding = $header['header_logo_bottom_padding'];
					
					$header_logo_bg = $header['header_logo_bg'];
					$bg_post = $header_logo_bg['bg_position'];
					$post = explode( "-", $bg_post );
					$bg_repeat = $header_logo_bg['bg_repeat'];
					$bg = isset($header_logo_bg['bg']) ? $header_logo_bg['bg'] : null;
					$bg_attachment = $header_logo_bg['bg_attachment'];
					$bg_size = $header_logo_bg['bg_size'];
					$bg_color = $header_logo_bg['bg_color'];

					if( $counter != 4 ){
						$nav_bg_color = $header['nav_bg_color'];	
					}
					

					$nav_top = $header['top_border'];
					$nav_top_border = $nav_top['border'];
					$nav_top_border_style = $nav_top['style'];
					$nav_top_border_color = $nav_top['color'];

					$nav_bottom = $header['bottom_border'];
					$nav_bottom_border = $nav_bottom['border'];
					$nav_bottom_border_style = $nav_bottom['style'];
					$nav_bottom_border_color = $nav_bottom['color'];

					$nav_text_color = $header['nav_text_color'];
					$nav_regular = $nav_text_color['regular_color'];
					$nav_hover = $nav_text_color['hover_color'];

					$topbar_bg_color = $header['topbar_bg_color'];
					$topbar_bottom = $header['topbar_bottom_border'];
					$topbar_bottom_border = $topbar_bottom['border'];
					$topbar_bottom_style = $topbar_bottom['style'];
					$topbar_bottom_color = $topbar_bottom['color'];

					$topbar_text = $header['topbar_text_color'];
					$topbar_text_regular = $topbar_text['regular_color'];
					$topbar_text_hover = $topbar_text['hover_color'];

					if( $counter == 3 ){
						$header_style .= ".df-header-".$counter." .df-navbar-left{position: relative;}";
						$header_style .= ".df-header-".$counter." .df-header-logo{padding: ".$header_logo_top_padding."px 0px ".$header_logo_bottom_padding."px 0px; }";
						if( null == $bg || '' == $bg ){
							$header_style .= ".df-header-".$counter." .df-logo-section-header-3{
							background-color: ". $bg_color.";
							}";
						} else {
							$header_style .= "
							.df-header-".$counter." .df-logo-section-header-3{
								background-image: url(". $bg .");
								background-position: ". $post[0] ." ". $post[1] .";
								background-repeat: ". $bg_repeat .";
								background-attachment: ". $bg_attachment .";
								background-color: ". $bg_color .";
								background-size: ". $bg_size .";
							}";
						}
						$header_style .= "
							.df-ads {
								margin: ".$header_logo_top_padding."px 0px ".$header_logo_bottom_padding."px 0px !important;
							}
							";
						$header_style .= "
							.df-header-".$counter." #megadropdown  li a,
							.df-header-".$counter." #megadropdown #df-primary-menu-megadropdown > li > a{
								color: ".$nav_regular.";
							}
							.df-header-".$counter." #megadropdown li a:hover,
							.df-header-".$counter." #megadropdown #df-primary-menu-megadropdown > li > a:hover{
								color: ".$nav_hover.";
							}";

					}else if ( $counter == 4 ){
						if( null == $bg || '' == $bg ){
							$header_style .= ".df-header-".$counter." .df-navbar-background{ 
												background-color: ". $bg_color.";
												}";
						} else {
							$header_style .= "
							.df-header-".$counter." .df-navbar-background{
								background-image: url(". $bg .");
								background-position: ". $post[0] ." ". $post[1] .";
								background-repeat: ". $bg_repeat .";
								background-attachment: ". $bg_attachment .";
								background-color: ". $bg_color .";
								background-size: ". $bg_size .";
							}";
						}
						$header_style .= "
							.df-header-".$counter." .boxed .df-navbar-left{
								position:relative;
							}
							.df-header-".$counter." #megadropdown.boxed .df-navbar-right,
							.df-header-".$counter." #megadropdown.header-4-full .df-navbar-right{
								top: ".$header_logo_top_padding."px;
							}
							.df-header-".$counter." #megadropdown{
								background-color: ". $bg_color ." !important;
								padding-top: ".$header_logo_top_padding."px;
								padding-bottom: ".$header_logo_bottom_padding."px;		
							}
							

							";
						$header_style .= "
							.df-header-".$counter." #megadropdown  li a,
							.df-header-".$counter." #megadropdown #df-primary-menu-megadropdown > li > a{
								color: ".$nav_regular.";
							}
							.df-header-".$counter." #megadropdown li a:hover,
							.df-header-".$counter." #megadropdown #df-primary-menu-megadropdown > li > a:hover{
								color: ".$nav_hover.";
							}";

							// $header_style .= "
							// 	.df-header-".$counter." #megadropdown{
							// 		background-color: ".$nav_bg_color.";
							// 		border-top: ".$nav_top_border."px ".$nav_top_border_style." ".$nav_top_border_color.";
							// 		border-bottom: ".$nav_bottom_border."px ".$nav_bottom_border_style." ".$nav_bottom_border_color.";
							// }";
							
						$layout_type='';
						$general = self::df_get_general_options();
						$global = $general['global'];
						// if( $global['layout']);

						if( is_single() ){
							$post_id = get_the_ID();
							$meta_content_layout = get_post_meta( $post_id, 'df_magz_post_content_layout', true );
							if( empty( $meta_content_layout ) ){
								$layout_type = $global['layout'];
							}else{
								$layout_type = $meta_content_layout;
							}
						}else if( is_page() ){
							global $post;
							$post_id = $post->ID;
							$meta_content_layout = get_post_meta( $post_id, 'df_magz_page_content_layout', true );
							if( empty( $meta_content_layout ) ){
								$layout_type = $global['layout'];
							}else{
								$layout_type = $meta_content_layout;
							}
						}else{
							$layout_type = $global['layout'];
						}

						if( $layout_type == 'full' && $header['header_layout'] == 'fullwidth' ){
							$margintop_menu = "
								.df-header-".$counter." #megadropdown.header-4-full ul.dropdown-menu.ul-0
									margin-top: 0px;
								}
							";
						}else{
							$margintop_menu = "
								.df-header-".$counter." #megadropdown.header-4-full ul.dropdown-menu.ul-0,
								.df-header-".$counter." #megadropdown.header-4-fullboxed ul.dropdown-menu.ul-0{
									margin-top: 0px;
								}
							";
						}

						$header_style .= $margintop_menu;

					}else{
						$header_style .= ".df-header-".$counter." .boxed .df-navbar-left{position: relative;}";
						$header_style .= ".df-header-".$counter." .df-logo-inner{padding: ".$header_logo_top_padding."px 0px ".$header_logo_bottom_padding."px 0px; }";
						if( null == $bg || '' == $bg ){
							$header_style .= ".df-header-".$counter." .df-logo-wrap{
												background-color: ". $bg_color.";
												}";
						} else {
							$header_style .= "
							.df-header-".$counter." .df-logo-wrap{
								background-image: url(". $bg .");
								background-position: ". $post[0] ." ". $post[1] .";
								background-repeat: ". $bg_repeat .";
								background-attachment: ". $bg_attachment .";
								background-color: ". $bg_color .";
								background-size: ". $bg_size .";
							}";
						}

					}

					$header_style .= "
							.df-header-".$counter." #megadropdown{
								background-color: ".$nav_bg_color.";
								border-top: ".$nav_top_border."px ".$nav_top_border_style." ".$nav_top_border_color.";
								border-bottom: ".$nav_bottom_border."px ".$nav_bottom_border_style." ".$nav_bottom_border_color.";
							}";
						$header_style .= "
							.df-header-".$counter." #megadropdown  li a,
							.df-header-".$counter." #megadropdown #df-primary-menu-megadropdown > li > a{
								color: ".$nav_regular.";
							}
							.df-header-".$counter." #megadropdown li a:hover,
							.df-header-".$counter." #megadropdown #df-primary-menu-megadropdown > li > a:hover{
								color: ".$nav_hover.";
							}";
					$header_style .= "
							.df-header-".$counter." .df-top-bar{
								background-color: ". $topbar_bg_color .";
								border-bottom: ". $topbar_bottom_border ."px ". $topbar_bottom_style ." ". $topbar_bottom_color .";
							}
							.df-header-".$counter." .df-top-bar a{
								color: ". $topbar_text_regular .";
							}
							.df-header-". $counter ." .df-top-bar a:hover{
								color: ". $topbar_text_hover .";
							} 
							";
					
				}else if( $counter == 5 ){ // header 5

					// print_r( $header );
					$header_logo_top_padding = $header['header_logo_top_padding'];
					$header_logo_bottom_padding = $header['header_logo_bottom_padding'];
					
					$nav_text_light = $header['nav_text_color_light'];
					$nav_text_reg_light = $nav_text_light['regular_color'];
					$nav_text_hov_light = $nav_text_light['hover_color'];

					$nav_text_dark = $header['nav_text_color_dark'];
					$nav_text_reg_dark = $nav_text_dark['regular_color'];
					$nav_text_hov_dark = $nav_text_dark['hover_color'];

					$topbar_text_light = $header['topbar_text_color_light'];
					$topbar_text_reg_light = $topbar_text_light['regular_color'];
					$topbar_text_hov_light = $topbar_text_light['hover_color'];

					$topbar_bottom_border_light = $header['topbar_bottom_border_light'];
					$topbar_bb_light_border = $topbar_bottom_border_light['border'];
					$topbar_bb_light_style = $topbar_bottom_border_light['style'];
					$topbar_bb_light_opacity = $topbar_bottom_border_light['opacity'] / (float) 100;
					$topbar_bb_light_color = $topbar_bottom_border_light['color'];
					list($r, $g, $b) = sscanf( $topbar_bb_light_color, "#%02x%02x%02x");
					$rgb_light = $r.",".$g.",".$b;

					$topbar_text_dark = $header['topbar_text_color_dark'];
					$topbar_text_reg_dark = $topbar_text_dark['regular_color'];
					$topbar_text_hov_dark = $topbar_text_dark['hover_color'];

					$topbar_bottom_border_dark = $header['topbar_bottom_border_dark'];
					$topbar_bb_dark_border = $topbar_bottom_border_dark['border'];
					$topbar_bb_dark_style = $topbar_bottom_border_dark['style'];
					$topbar_bb_dark_opacity = $topbar_bottom_border_dark['opacity'] / (float) 100;
					$topbar_bb_dark_color = $topbar_bottom_border_dark['color'];
					list($r, $g, $b) = sscanf( $topbar_bb_dark_color, "#%02x%02x%02x");
					$rgb_dark = $r.",".$g.",".$b;

					$header_style .= "
						#df-header-wrapper.df-header-".$counter." .df-header-trans #container-menu ul > li.menu-item.df-md-menuitem > a {
							height: calc(70px + ".$header_logo_top_padding."px + ".$header_logo_bottom_padding."px);
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #container-menu ul > li > a{
							color: ". $nav_text_reg_light .";
						} 
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #container-menu ul > li > a:hover{
							color: ". $nav_text_hov_light .";
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #top-navbar ul.df-top-bar-left > li > a{
							color: ". $topbar_text_reg_light .";
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #top-navbar ul.df-top-bar-left > li > a:hover{
							color: ". $topbar_text_hov_light .";
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #top-navbar .topbar-inner-wrapper{
							border-bottom: ".$topbar_bb_light_border."px ".$topbar_bb_light_style." rgba(".$rgb_light.", ".$topbar_bb_light_opacity.");
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #container-menu ul > li > a{
							color: ". $nav_text_reg_dark .";
						} 
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #container-menu ul > li > a:hover{
							color: ". $nav_text_hov_dark .";
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #top-navbar ul.df-top-bar-left > li > a{
							color: ". $topbar_text_reg_dark .";
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #top-navbar ul.df-top-bar-left > li > a:hover{
							color: ". $topbar_text_hov_dark .";
						}
						#df-header-wrapper.df-header-". $counter ." .df-header-trans .boxed .df-navbar-left{
							position:relative;
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #top-navbar .topbar-inner-wrapper{
							border-bottom: ".$topbar_bb_dark_border."px ".$topbar_bb_dark_style." rgba(".$rgb_dark.", ".$topbar_bb_dark_opacity.");
						}
						#df-header-wrapper.df-header-". $counter ." .df-header-trans .header-5-full .df-navbar-left,
						#df-header-wrapper.df-header-". $counter ." .df-header-trans .header-5-full .df-navbar-right{
							margin-top: ".$header_logo_top_padding."px;
							margin-bottom: ".$header_logo_bottom_padding."px;
						}
					";
				}else{ // header 6

					// print_r( $header );
					$header_logo_top_padding = $header['header_logo_top_padding'];
					$header_logo_bottom_padding = $header['header_logo_bottom_padding'];

					$nav_text_light = $header['nav_text_color_light'];
					$nav_text_reg_light = $nav_text_light['regular_color'];
					$nav_text_hov_light = $nav_text_light['hover_color'];

					// $nav_border_light = $header['nav_border_light'];
					// $nav_b_light_border = $nav_border_light['border'];
					// $nav_b_light_style = $nav_border_light['style'];
					// $nav_b_light_opacity = $nav_border_light['opacity'] / (float) 100;
					// $nav_b_light_color = $nav_border_light['color'];
					// list($r, $g, $b) = sscanf( $nav_b_light_color, "#%02x%02x%02x");
					// $nav_rgb_light = $r.",".$g.",".$b;

					$nav_text_dark = $header['nav_text_color_dark'];
					$nav_text_reg_dark = $nav_text_dark['regular_color'];
					$nav_text_hov_dark = $nav_text_dark['hover_color'];

					// $nav_border_dark = $header['nav_border_dark'];
					// $nav_b_dark_border = $nav_border_dark['border'];
					// $nav_b_dark_style = $nav_border_dark['style'];
					// $nav_b_dark_opacity = $nav_border_dark['opacity'] / (float) 100;
					// $nav_b_dark_color = $nav_border_dark['color'];
					// list($r, $g, $b) = sscanf( $nav_b_dark_color, "#%02x%02x%02x");
					// $nav_rgb_dark = $r.",".$g.",".$b;

					$topbar_text_light = $header['topbar_text_color_light'];
					$topbar_text_reg_light = $topbar_text_light['regular_color'];
					$topbar_text_hov_light = $topbar_text_light['hover_color'];

					$topbar_bottom_border_light = $header['topbar_bottom_border_light'];
					$topbar_bb_light_border = $topbar_bottom_border_light['border'];
					$topbar_bb_light_style = $topbar_bottom_border_light['style'];
					$topbar_bb_light_opacity = $topbar_bottom_border_light['opacity'] / (float) 100;
					$topbar_bb_light_color = $topbar_bottom_border_light['color'];
					list($r, $g, $b) = sscanf( $topbar_bb_light_color, "#%02x%02x%02x");
					$rgb_light = $r.",".$g.",".$b;

					$topbar_text_dark = $header['topbar_text_color_dark'];
					$topbar_text_reg_dark = $topbar_text_dark['regular_color'];
					$topbar_text_hov_dark = $topbar_text_dark['hover_color'];

					$topbar_bottom_border_dark = $header['topbar_bottom_border_dark'];
					$topbar_bb_dark_border = $topbar_bottom_border_dark['border'];
					$topbar_bb_dark_style = $topbar_bottom_border_dark['style'];
					$topbar_bb_dark_opacity = $topbar_bottom_border_dark['opacity'] / (float) 100;
					$topbar_bb_dark_color = $topbar_bottom_border_dark['color'];
					list($r, $g, $b) = sscanf( $topbar_bb_dark_color, "#%02x%02x%02x");
					$rgb_dark = $r.",".$g.",".$b;

					$header_style .= "
						#df-header-wrapper.df-header-".$counter." .df-header-trans #container-menu ul > li.menu-item.df-md-menuitem > a {
							height: calc(70px + ".$header_logo_top_padding."px + ".$header_logo_bottom_padding."px);
						}
						.df-header-".$counter." .df-header-trans #megadropdown .df-navbar-left,
						.df-header-".$counter." .df-header-trans #megadropdown .df-navbar-right{
							padding-top: ".$header_logo_top_padding."px;
							padding-bottom: ".$header_logo_bottom_padding."px;
						}
						#df-header-wrapper.df-header-". $counter ." .df-header-trans .df-navbar-left{
							position:relative;
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #container-menu ul > li > a{
							color: ". $nav_text_reg_light .";
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #container-menu ul > li > a:hover{
							color: ". $nav_text_hov_light .";
						}	
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #container-menu ul > li > a{
							color: ". $nav_text_reg_dark .";
						} 
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #container-menu ul > li > a:hover{
							color: ". $nav_text_hov_dark .";
						}
						
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #top-navbar ul.df-top-bar-left > li > a{
							color: ". $topbar_text_reg_light .";
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #top-navbar ul.df-top-bar-left > li > a:hover{
							color: ". $topbar_text_hov_light .";
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #top-navbar ul.df-top-bar-left > li > a{
							color: ". $topbar_text_reg_dark .";
						}
						
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #top-navbar ul.df-top-bar-left > li > a:hover{
							color: ". $topbar_text_hov_dark .";
						}
						
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #top-navbar .topbar-inner-wrapper,
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #megadropdown .df-menu-border {
							border-top: ".$topbar_bb_light_border."px ".$topbar_bb_light_style." rgba(".$rgb_light.", ".$topbar_bb_light_opacity.");
							border-left: ".$topbar_bb_light_border."px ".$topbar_bb_light_style." rgba(".$rgb_light.", ".$topbar_bb_light_opacity.");
							border-right: ".$topbar_bb_light_border."px ".$topbar_bb_light_style." rgba(".$rgb_light.", ".$topbar_bb_light_opacity.");
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-light .df-header-trans #megadropdown .df-menu-border {
							border-bottom: ".$topbar_bb_light_border."px ".$topbar_bb_light_style." rgba(".$rgb_light.", ".$topbar_bb_light_opacity.");
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #top-navbar .topbar-inner-wrapper,
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #megadropdown .df-menu-border {
							border-top: ".$topbar_bb_dark_border."px ".$topbar_bb_dark_style." rgba(".$rgb_dark.", ".$topbar_bb_dark_opacity.");
							border-left: ".$topbar_bb_dark_border."px ".$topbar_bb_dark_style." rgba(".$rgb_dark.", ".$topbar_bb_dark_opacity.");
							border-right: ".$topbar_bb_dark_border."px ".$topbar_bb_dark_style." rgba(".$rgb_dark.", ".$topbar_bb_dark_opacity.");
						}
						#df-header-wrapper.df-header-". $counter .".df-navbar-transparent-dark .df-header-trans #megadropdown .df-menu-border {
							border-bottom: ".$topbar_bb_dark_border."px ".$topbar_bb_dark_style." rgba(".$rgb_dark.", ".$topbar_bb_dark_opacity.");
						}
						
					";
				}				

			}
			// if sticky header enable
			$sticky_header = self::df_get_header_selected('sticky_header');
			$is_sticky = $sticky_header['is_sticky_header'];
			if( $is_sticky == 'yes' ){
				$sticky_bg_color = $sticky_header['sticky_header_bg']['bg_color'];
				$sticky_bg_post = $sticky_header['sticky_header_bg']['bg_position'];
				$stick_post = explode("-", $sticky_bg_post);
				$sticky_bg_repeat = $sticky_header['sticky_header_bg']['bg_repeat'];
				$sticky_bg_attachment = $sticky_header['sticky_header_bg']['bg_attachment'];
				$sticky_bg_size = $sticky_header['sticky_header_bg']['bg_size'];
				$sticky_bg = isset($sticky_header['sticky_header_bg']['bg']) ? $sticky_header['sticky_header_bg']['bg'] : null;
				$sticky_bottom_border = $sticky_header['bottom_border'];
				$sticky_border = $sticky_bottom_border['border'];
				$sticky_border_style = $sticky_bottom_border['style'];
				$sticky_border_color = $sticky_bottom_border['color'];

				$sticky_nav_text_color = $sticky_header['nav_text_color']['regular_color'];
				$sticky_nav_text_color_hov = $sticky_header['nav_text_color']['hover_color'];
				if(null == $sticky_bg || '' == $sticky_bg){
					$header_style .= "
					#df-sticky-nav.sticky-animation{
						background-color: ".$sticky_bg_color.";
					}";
				} else {
					$header_style .= "
					#df-sticky-nav.sticky-animation{
						background-image: url(".$sticky_bg.");
						background-color: ".$sticky_bg_color.";
						background-size: ".$sticky_bg_size.";
						background-attachment: ".$sticky_bg_attachment.";
						background-repeat: ".$sticky_bg_repeat.";
						background-position: ".$stick_post[0]." ".$stick_post[1].";
						border-bottom: ".$sticky_border."px ".$sticky_border_style." ".$sticky_border_color.";
					}";
				}
				$header_style .= "
					#df-sticky-nav .more-social-sticky {
						background-color: ".$sticky_bg_color.";
					}
					#df-sticky-nav.sticky-animation a{
								color: ".$sticky_nav_text_color.";
					}
					#df-sticky-nav.sticky-animation a:hover{
								color: ".$sticky_nav_text_color_hov.";
					}
				";
				if( is_admin_bar_showing() ){
					$header_style .= "
						#df-sticky-nav.sticky-animation{
							top: 32px;
						}
					";
				}
			}
			$header_style = self::minify_css( $header_style  );
			wp_add_inline_style( 'custom-style', $header_style );
		}

		/**
		 * df_header_style
		 */
		function df_mobile_header(){
			wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );
			$mobile_header_style = '';
			
			$mobile_options = self::df_get_header_options();
			$mobile_header = $mobile_options['mobile_header'];

			$mobile_bg_color = $mobile_header['bg_color'];
			$mobile_bg_position = explode('-', $mobile_header['bg_position'] );
			$mobile_bg_repeat = $mobile_header['bg_repeat'];
			$mobile_bg_attch = $mobile_header['bg_attachment'];
			$mobile_bg_size = $mobile_header['bg_size'];
			$mobile_bg_img = isset($mobile_header['bg']) ? $mobile_header['bg'] : null;

			$mobile_element_color = $mobile_header['element_color'];
			$mobile_border_color = $mobile_header['border_color'];
			$mobile_border_size = $mobile_header['border_px'];
			$mobile_border_style = $mobile_header['border_style'];

			$mobile_font_family_options = self::df_get_font_name( $mobile_header['font_family'] );
			$mobile_font_family = isset($mobile_header['font_family']) ? $mobile_header['font_family'] : null;

			$mobile_font_weight = $mobile_header['font_weight'];
			$mobile_font_subsets = isset($mobile_header['font_subsets']) ? $mobile_header['font_subsets'] : null;

			$mobile_font_transform = $mobile_header['text_transform'];
			$mobile_font_size = $mobile_header['font_size'];
			$mobile_line_height = $mobile_header['line_height'];
			$mobile_letter_spacing = $mobile_header['letter_spacing'];
			$mobile_font_color = $mobile_header['regular_color'];
			$mobile_hover_color = $mobile_header['hover_color'];
			$mobile_dd_bg_color = $mobile_header['menu_bg_color'];

			// wp_enqueue_style( 
					// 'df_mobile_menu_font', 
					// "http://fonts.googleapis.com/css?family=".$mobile_font_family_options."&subset=".$mobile_font_subsets,
					// false 
			// );
			if( null == $mobile_bg_img || '' == $mobile_bg_img ){
				$mobile_header_style .="
				.mobile-menu {
					background-color: " .$mobile_bg_color. ";
				}";
			} else {
				$mobile_header_style .="
				.mobile-menu {
					background-color: " .$mobile_bg_color. ";
					background-image: url( " .$mobile_bg_img. " );
					background-position: " .$mobile_bg_position[0].' '.$mobile_bg_position[1]. ";
					background-repeat: " .$mobile_bg_repeat. ";
					background-attachment: " .$mobile_bg_attch. ";
					background-size: " .$mobile_bg_size. ";
					border-bottom: ".$mobile_border_size."px ".$mobile_border_style." ".$mobile_border_color.";
				}";
			}
			$mobile_header_style .="
				.ham-menu a i,
				.float-menu .nav-toggle span {
					color: " .$mobile_element_color. ";
				}

				.df-mobile-menu-inner li a,
				.mobile-menu-header li a,
				.mobile-social li a,
				.menu-wrap .mobile-dropdown-toggle {
					font-family: " .$mobile_font_family. ";
					font-weight: " .$mobile_font_weight. ";
					text-transform: " .$mobile_font_transform. ";
					color: " .$mobile_font_color. ";
					font-size: " .$mobile_font_size. "px;
					line-height: " .$mobile_line_height. "px;
					letter-spacing: " .$mobile_letter_spacing. "px;
				}
				.menu-wrap .df-separator {
					border-bottom-color: ".$mobile_font_color.";
					opacity: .6;
				}
				.menu-wrap input.df-form-search,
				.menu-wrap .input-group-btn .ion-search {
					color: ".$mobile_font_color.";
				}
				.df-mobile-menu-inner li a:hover {
					color: " .$mobile_hover_color. ";
				}

				.mobile-menu .menu-wrap {
					background-color: " .$mobile_dd_bg_color. ";
				}

			";
			$mobile_header_style = self::minify_css( $mobile_header_style  );
			wp_add_inline_style( 'custom-style', $mobile_header_style );
		}

		/**
		 * df_menu_style
		 */
		function df_menu_style() {
			wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );

			$menu_style = '';
			$menu_options = self::df_get_menu_options_options();

			/* topbar menu */
			$topbar_menu = $menu_options['topbar_menu'];
			$topbar_fontfamily = $topbar_menu['font_family'];
			//$topbar_fontweight = $topbar_menu['font_weight'];
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$topbar_menu['font_weight']);
			$topbar_fontweight = $arr[0];
			$topbar_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$topbar_fontsubsets = $topbar_menu['font_subsets'];
			$topbar_texttransform = $topbar_menu['text_transform'];
			$topbar_fontsize = $topbar_menu['font_size'];
			$topbar_lineheight = $topbar_menu['line_height'];
			$topbar_letterspacing = $topbar_menu['letter_spacing'];

			/* topbar menu dropdown */
			$topbar_menu_dropdown = $menu_options['topbar_menu_dropdown'];
			$tmd_fontfamily = $topbar_menu_dropdown['font_family'];
			// $tmd_fontweight = $topbar_menu_dropdown['font_weight'];
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$topbar_menu_dropdown['font_weight']);
			$tmd_fontweight = $arr[0];
			$tmd_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$tmd_fontsubsets = $topbar_menu_dropdown['font_subsets'];
			$tmd_texttransform = $topbar_menu_dropdown['text_transform'];
			$tmd_fontsize = $topbar_menu_dropdown['font_size'];
			$tmd_lineheight = $topbar_menu_dropdown['line_height'];
			$tmd_letterspacing = $topbar_menu_dropdown['letter_spacing'];
			$tmd_regularcolor = $topbar_menu_dropdown['regular_color'];
			$tmd_hovercolor = $topbar_menu_dropdown['hover_color'];
			$tmd_bgcolor = $topbar_menu_dropdown['background_color'];
			$tmd_borderpx = $topbar_menu_dropdown['border_px'];
			$tmd_borderstyle = $topbar_menu_dropdown['border_style'];
			$tmd_bordercolor = $topbar_menu_dropdown['border_color'];

			/* main navigation */
			$main_navigation = $menu_options['main_navigation'];
			$mn_fontfamily = $main_navigation['font_family'];
			// $mn_fontweight = $main_navigation['font_weight'];
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$main_navigation['font_weight']);
			$mn_fontweight = $arr[0];
			$mn_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$mn_fontsubsets = $main_navigation['font_subsets'];
			$mn_texttransfrom = $main_navigation['text_transform'];
			$mn_fontsize = $main_navigation['font_size'];
			$mn_lineheight = $main_navigation['line_height'];
			$mn_letterspacing = $main_navigation['letter_spacing'];

			/* main navigation dropdown */
			$mn_dropdown = $menu_options['main_navigation_dropdown'];
			$mnd_fontfamily = $mn_dropdown['font_family'];
			// $mnd_fontweight = $mn_dropdown['font_weight'];
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$mn_dropdown['font_weight']);
			$mnd_fontweight = $arr[0];
			$mnd_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$mnd_fontsubsets = $mn_dropdown['font_subsets'];
			$mnd_texttransform = $mn_dropdown['text_transform'];
			$mnd_fontsize = $mn_dropdown['font_size'];
			$mnd_lineheight = $mn_dropdown['line_height'];
			$mnd_letterspacing = $mn_dropdown['letter_spacing'];
			$mnd_regularcolor = $mn_dropdown['regular_color'];
			$mnd_hovercolor = $mn_dropdown['hover_color'];
			$mnd_bgcolor = $mn_dropdown['background_color'];
			$mnd_borderpx = $mn_dropdown['border_px'];
			$mnd_borderstyle = $mn_dropdown['border_style'];
			$mnd_bordercolor = $mn_dropdown['border_color'];

			$menu_style .= "
				.df-header .df-top-bar li a{
					font-family: ".$topbar_fontfamily.", serif;
					font-weight: ".$topbar_fontweight.";
					font-style: ".$topbar_font_style.";
					text-transform: ".$topbar_texttransform.";
					font-size: ".$topbar_fontsize."px;
					line-height: ".$topbar_lineheight."px;
					letter-spacing: ".$topbar_letterspacing."px;
				}
				.df-header .df-top-bar .dropdown-menu.df-dropdown-top-bar,
				.df-header .df-top-bar .dropdown-menu.df-dropdown-top-bar-right{
					background-color: ".$tmd_bgcolor.";
					border: ".$tmd_borderpx."px ".$tmd_borderstyle." ".$tmd_bordercolor.";
				}
				.df-header .df-top-bar .dropdown-menu li a{
					font-family:".$tmd_fontfamily.", serif;
					font-weight: ".$tmd_fontweight.";
					font-style: ".$tmd_font_style.";
					text-transform:".$tmd_texttransform." ;
					font-size: ".$tmd_fontsize."px;
					line-height: ".$tmd_lineheight."px;
					letter-spacing: ".$tmd_letterspacing."px;
					color: ".$tmd_regularcolor.";
				}
				.df-header .df-top-bar .dropdown-menu li a:hover{
					color: ".$tmd_hovercolor.";
				}
				#megadropdown .nav li a,
				#megadropdown-sticky .nav li a{
					font-family: ". $mn_fontfamily .", serif;
					font-weight: ". $mn_fontweight .";
					font-style:  ".$mn_font_style.";
					text-transform: ". $mn_texttransfrom .";
					font-size: ". $mn_fontsize ."px;
					line-height: ". $mn_lineheight ."px;
					letter-spacing: ". $mn_letterspacing ."px;
				}
				#megadropdown .nav .dropdown-menu li a,
				#megadropdown-sticky .nav .dropdown-menu li a{
					font-family:".$mnd_fontfamily.", serif;
					font-weight: ".$mnd_fontweight.";
					font-style:".$mnd_font_style.";
					text-transform:".$mnd_texttransform." ;
					font-size: ".$mnd_fontsize."px;
					line-height: ".$mnd_lineheight."px;
					letter-spacing: ".$mnd_letterspacing."px;
					color: ".$mnd_regularcolor.";
				}
				#df-header-wrapper.df-header-5.df-navbar-transparent-light .df-header-trans #megadropdown .nav .dropdown-menu li a,
				#df-header-wrapper.df-header-5.df-navbar-transparent-dark .df-header-trans #megadropdown .nav .dropdown-menu li a,
				#df-header-wrapper.df-header-6.df-navbar-transparent-light .df-header-trans #megadropdown .nav .dropdown-menu li a,
				#df-header-wrapper.df-header-6.df-navbar-transparent-dark .df-header-trans #megadropdown .nav .dropdown-menu li a{
					color: ".$mnd_regularcolor.";
				}
				#df-header-wrapper.df-header #megadropdown .df-subcat-stack .nav.nav-stacked.df-megamenu-nav-sub li.active a,
				#df-header-wrapper.df-header #megadropdown .df-subcat-pills .nav.nav-pills.df-megamenu-nav-sub li.active a,
				#df-header-wrapper.df-header-5.df-navbar-transparent-light .df-header-trans #megadropdown .nav.df-megamenu-nav-sub li.active a,
				#df-header-wrapper.df-header-5.df-navbar-transparent-dark .df-header-trans #megadropdown .nav.df-megamenu-nav-sub li.active a,
				#df-header-wrapper.df-header-6.df-navbar-transparent-light .df-header-trans #megadropdown .nav.df-megamenu-nav-sub li.active a,
				#df-header-wrapper.df-header-6.df-navbar-transparent-dark .df-header-trans #megadropdown .nav.df-megamenu-nav-sub li.active a,
				#df-header-wrapper.df-header-5.df-navbar-transparent-light .df-header-trans #megadropdown .nav.df-megamenu-nav-sub li a:hover,
				#df-header-wrapper.df-header-5.df-navbar-transparent-dark .df-header-trans #megadropdown .nav.df-megamenu-nav-sub li a:hover,
				#df-header-wrapper.df-header-6.df-navbar-transparent-light .df-header-trans #megadropdown .nav.df-megamenu-nav-sub li a:hover,
				#df-header-wrapper.df-header-6.df-navbar-transparent-dark .df-header-trans #megadropdown .nav.df-megamenu-nav-sub li a:hover
				#df-header-wrapper.df-header-5.df-navbar-transparent-light .df-header-trans #megadropdown .nav .dropdown-menu li a:hover,
				#df-header-wrapper.df-header-5.df-navbar-transparent-dark .df-header-trans #megadropdown .nav .dropdown-menu li a:hover,
				#df-header-wrapper.df-header-6.df-navbar-transparent-light .df-header-trans #megadropdown .nav .dropdown-menu li a:hover,
				#df-header-wrapper.df-header-6.df-navbar-transparent-dark .df-header-trans #megadropdown .nav .dropdown-menu li a:hover,
				#megadropdown .nav .dropdown-menu li a:hover,
				#megadropdown .nav li a:hover .megamenu-item-title,
				#megadropdown-sticky .nav .dropdown-menu li a:hover,
				#megadropdown-sticky .nav li a:hover .megamenu-item-title {
					color: ". $mnd_hovercolor .";
				}
				#megadropdown .df-subcat-stack .df-megamenu-nav-sub.section-sub-stack li a:hover:after,
				#megadropdown-sticky .df-subcat-stack .df-megamenu-nav-sub.section-sub-stack li a:hover:after {
					border-color: ".$mnd_hovercolor.";
				}
				#megadropdown .nav .dropdown-menu,
				#megadropdown .nav > .df-is-megamenu .dropdown-menu .list_megamenu,
				#megadropdown-sticky .nav .dropdown-menu,
				#megadropdown-sticky .nav > .df-is-megamenu .dropdown-menu .list_megamenu{
					background-color: ". $mnd_bgcolor .";
					border: ". $mnd_borderpx ."px ". $mnd_borderstyle ." ".$mnd_bordercolor.";
				}
				#megadropdown .nav li a .megamenu-item-title,
				#megadropdown-sticky .nav li a .megamenu-item-title{
					font-size: ". $mnd_fontsize ."px;
				}
				
				";
			// print_r( $menu_options );
				$menu_style = self::minify_css( $menu_style  );
			wp_add_inline_style( 'custom-style', $menu_style );
		}

		/**
		 * df_footer_style
		 */
		function df_footer_style() {
			wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );

			$footer_style = '';
			$footer_options_style = self::df_get_footer_options();

			$footer_bg = $footer_options_style['background'];
			$footer_bg_position = $footer_bg['position'];
			$footer_bg_repeat = $footer_bg['repeat'];
			$footer_bg_attachment = $footer_bg['attachment'];
			$footer_bg_size = $footer_bg['size'];
			$footer_bg_image = isset($footer_bg['image']) ? $footer_bg['image'] : null;
			$footer_bg_color = $footer_bg['color'];

			$footer_widget_title_color = $footer_options_style['footer_widget_title_color'];
			$footer_heading_color = $footer_options_style['footer_heading_color'];
			$footer_p_color = $footer_options_style['footer_p_color'];
			$footer_link_color = $footer_options_style['footer_link_color'];
			$footer_border_color = $footer_options_style['footer_border_color'];

			$subfooter_bg = $footer_options_style['subfooter']['background'];
			$subfooter_bg_position = $subfooter_bg['position'];
			$subfooter_bg_repeat = $subfooter_bg['repeat'];
			$subfooter_bg_attachment = $subfooter_bg['attachment'];
			$subfooter_bg_size = $subfooter_bg['size'];
			$subfooter_bg_image = isset($subfooter_bg['image']) ? $subfooter_bg['image'] : null;
			$subfooter_bg_color = $subfooter_bg['color'];
			$subfooter_text_color = $footer_options_style['subfooter_text_color'];

			$footer_top_border = $footer_options_style['top_border'];
			$footer_bottom_border = $footer_options_style['bottom_border'];

			$footer_tb_color = $footer_top_border['color'];
			$footer_tb_border = $footer_top_border['border'];
			$footer_tb_style = $footer_top_border['style'];

			$footer_bb_color = $footer_bottom_border['color'];
			$footer_bb_border = $footer_bottom_border['border'];
			$footer_bb_style = $footer_bottom_border['style'];
			if( null == $footer_bg_image || '' == $footer_bg_image ){
				$footer_style .= "
					.df-container-footer,
					.df-container-footer:nth-of-type(1) {
						background-color: ".$footer_bg_color.";
					}";
			} else {
				$footer_style .= "
					.df-container-footer,
					.df-container-footer:nth-of-type(1) {
						background-image: url(".$footer_bg_image.");
						background-color: ".$footer_bg_color.";
						background-repeat: ".$footer_bg_repeat.";
						background-size: ".$footer_bg_size.";
						background-attachment: ".$footer_bg_attachment.";
						background-position: ".$footer_bg_position.";
					}";
			}
			if( null == $subfooter_bg_image || '' == $subfooter_bg_image ){
				$footer_style .= "
					.df-container-subfooter{
						background-color: ".$subfooter_bg_color.";
					}";
			} else {
				$footer_style .= "
				.df-container-subfooter{
						background-image: url(".$subfooter_bg_image.");
						background-color: ".$subfooter_bg_color.";
						background-repeat: ".$subfooter_bg_repeat.";
						background-size: ".$subfooter_bg_size.";
						background-attachment: ".$footer_bg_attachment.";
						background-position: ".$subfooter_bg_position.";
					}";
			}
			$footer_style .= "
					div.widget .widget-blocks.style-7 .df-shortcode-blocks-main-inner {
						background-color: " .$footer_bg_color. ";
					}
					.df-container-footer:nth-of-type(1) {
						border-top: ".$footer_tb_border."px ".$footer_tb_style." ".$footer_tb_color.";
						border-bottom: ".$footer_bb_border."px ".$footer_bb_style." ".$footer_bb_color.";
					}
					#df-footer-wrapper .df-container-footer h1,
					#df-footer-wrapper .df-container-footer h2,
					#df-footer-wrapper .df-container-footer h3,
					#df-footer-wrapper .df-container-footer h4,
					#df-footer-wrapper .df-container-footer h5,
					#df-footer-wrapper .df-container-footer h6{
						color: ".$footer_heading_color.";
					}
					#df-footer-wrapper .df-container-footer,
					#df-footer-wrapper .df-container-footer div p,
					#df-footer-wrapper .df-container-footer span,
					#df-footer-wrapper .df-container-footer p{
						color: ". $footer_p_color .";
					}
					#df-footer-wrapper .df-container-footer a,
					#df-footer-wrapper .df-container-footer a:hover{
						color: ".$footer_link_color.";
						text-decoration:none;
					}
					.df-footer-copyright .df-copyright, 
					.df-footer-copyright ul li a{
						color: ".$subfooter_text_color.";
					}
					#df-footer-wrapper .df-navbar-footer li a:hover{
						background-color: ". $subfooter_bg_color.";
					}
					#page #df-footer-wrapper h5.df-widget-title,
					#page .df-footer-bottom .df-heading{
						color: ".$footer_widget_title_color.";
					}
					#page #df-footer-wrapper h1 a, 
					#page #df-footer-wrapper h2 a,
					#page #df-footer-wrapper h3 a,
					#page #df-footer-wrapper h4 a,
					#page #df-footer-wrapper h5 a,
					#page #df-footer-wrapper h6 a{
						color: ".$footer_heading_color.";
					}
					#df-footer-wrapper .widget_archive select,
					#df-footer-wrapper .widget_archive li,
					#df-footer-wrapper .widget_categories select,
					#df-footer-wrapper .widget_categories a,
					#df-footer-wrapper .widget_nav_menu a,
					#df-footer-wrapper .widget_meta a,
					#df-footer-wrapper .widget_pages a,
					#df-footer-wrapper #recentcomments li,
					#df-footer-wrapper .widget_recent_entries li,
					#df-footer-wrapper .df-form-search,
					#df-footer-wrapper button.df-button-search,
					#df-footer-wrapper .tagcloud a,
					#df-footer-wrapper .df-separator,
					#df-footer-wrapper #df-widget-popular-tab ul.df-nav-tab li,
					#df-footer-wrapper #df-widget-popular-tab .tab-pane.df-tab-pane,
					#df-footer-wrapper #df-widget-popular-tab .df-most-popular-list {
						border-color: ".$footer_border_color.";
					}
			";

			// print_r($color_style);/
			$footer_style = self::minify_css( $footer_style  );
			wp_add_inline_style( 'custom-style', $footer_style );
			
		}

		/**
		 * df_notfound_style
		 */

		function df_notfound_style(){
			wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );

			$notfound_style = '';
			$template_setting = self::df_get_template_setting_options();
			$notfound = $template_setting['404_template'];
			$notfound_bg_color = $notfound['bg_color'];
			$notfound_bg_post = explode("-",$notfound['bg_position']);

			$notfound_bg_repeat = $notfound['bg_repeat'];
			$notfound_bg_attachment = $notfound['bg_attachment'];
			$notfound_bg_size = $notfound['bg_size'];
			$notfound_bg = isset($notfound['bg']) ? $notfound['bg'] : null;

			$notfound_title_color = $notfound['title_color'];
			$notfound_subtitle_color = $notfound['subtitle_color'];
			if( null == $notfound_bg || '' == $notfound_bg ){
				$notfound_style .= "
				#df-off-canvas-wrap.df-notfound-page{
					background-color: ".$notfound_bg_color.";
				}";
			} else {
				$notfound_style .= "
				#df-off-canvas-wrap.df-notfound-page{
					background-color: ".$notfound_bg_color.";
					background-image:  url(". $notfound_bg .");
					background-position: ".$notfound_bg_post[0]." ".$notfound_bg_post[1].";
					background-size: ".$notfound_bg_size.";
					background-attachment: ".$notfound_bg_attachment.";
					background-repeat: ".$notfound_bg_repeat.";

				}";
			}
			$notfound_style .= "
				#page .header-not-found-plain .title-not-found h1{
					color: ".$notfound_title_color.";
				}
				#page .header-not-found-plain .description-not-found p{
					color: ".$notfound_subtitle_color.";
				}
			";
			$notfound_style = self::minify_css( $notfound_style  );
			wp_add_inline_style( 'custom-style', $notfound_style );
			
		}

		/**
		 * df_per_category_style
		 */

		function df_per_category_style(){
			if( !is_category() ){
				return; 
			}
			$categories=self::df_get_categories_options();
			
			$category = get_query_var('cat');
			$current_category = get_category ($category);
			$per_category=$categories['per_category'][$current_category->term_id];
			wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );
			$per_category_style="";
			$category_bg_color = isset($per_category['body_bg_color']) ? $per_category['body_bg_color'] : null; //$per_category['body_bg_color'];
			$category_bg = isset($per_category['bg']) ? $per_category['bg'] : null;
			$per_category_style .= "
					#df-content-wrapper{
						background:".$category_bg_color.";
					}
			";
			if( $category_bg != null || '' != $category_bg) {
				$bg_post = !isset($per_category['bg_position']) ? 'left-top' : $per_category['bg_position'];
				$post = explode( "-", $bg_post );
				$bg_repeat = !isset($per_category['bg_repeat']) ? 'no-repeat' : $per_category['bg_repeat'];
				$bg_attachment = $per_category['bg_attachment'];
				$bg_size = !isset($per_category['bg_size']) ? 'fixed' : $per_category['bg_size'];
				$bg_color = !isset($per_category['bg_color']) ? '#000' : $per_category['bg_color'];
				$per_category_style .= "
							#df-content-wrapper{
								background-image: url(". $category_bg .");
								background-position: ". $post[0] ." ". $post[1] .";
								background-repeat: ". $bg_repeat .";
								background-attachment: ". $bg_attachment .";
								background-color: ". $bg_color .";
								background-size: ". $bg_size .";
							}";
			} else {
				$bg_color = !isset($per_category['bg_color']) ? '#000' : $per_category['bg_color'];
				$per_category_style .= "
							#df-content-wrapper{
								background-color: ". $bg_color .";
							}";
			}
			$per_category_style = self::minify_css( $per_category_style  );
			wp_add_inline_style( 'custom-style', $per_category_style );
		}

		/**
		 * df_per_category_style
		 */

		function df_sidebar_style(){
			wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );
			$sidebar_style = '';

			$sidebar_option = self::df_get_sidebars_options();
			$sidebar_widget_title_color = $sidebar_option['widget_title_color'];
			$sidebar_widget_background_color = $sidebar_option['background_color'];
			$sidebar_widget_top_padding = $sidebar_option['widget_top_padding'];
			$sidebar_widget_right_padding = $sidebar_option['widget_right_padding'];
			$sidebar_widget_bottom_padding = $sidebar_option['widget_bottom_padding'];
			$sidebar_widget_left_padding = $sidebar_option['widget_left_padding'];
			$sidebar_widget_heading_color = $sidebar_option['heading_element_color'];
			$sidebar_widget_link_color = $sidebar_option['link_color'];
			$sidebar_widget_border_color = $sidebar_option['border_color'];
			$sidebar_widget_paragraph_color = $sidebar_option['p_element_color'];
			$sidebar_widget_extra_color = $sidebar_option['extra_color'];

			$sidebar_style .= "
				
				.df-wraper #page .sidebar .df-widget-title {
						color: ".$sidebar_widget_title_color.";
				}

				section.widget {
					padding: ".$sidebar_widget_top_padding."px ".$sidebar_widget_right_padding."px ".$sidebar_widget_bottom_padding."px ".$sidebar_widget_left_padding."px;
					background-color: ".$sidebar_widget_background_color.";
				}
				
				section.widget .widget-blocks.style-7 .df-shortcode-blocks-main-inner {
					background-color: " .$sidebar_widget_background_color. ";
				}

				.widget .widget-article-title a,
				.sidebar .widget .df-thumbnail-title h5,
				#page .widget .df-thumbnail-title h4,
				.df-wraper #df-content-wrapper .sidebar h5.article-title a,
				.df-wraper #df-content-wrapper .sidebar h4.article-title a {
					color: ".$sidebar_widget_heading_color.";
				}

				.df-wraper .content-single-wrap .sidebar .widget a,
				.df-wraper #df-content-wrapper .sidebar .widget a {
					color: ".$sidebar_widget_link_color.";
				}
				.percent-rating,
				.star-rating,
				.point-rating {
					background-color: " .$sidebar_widget_link_color. ";
				}
				#wp-calendar tbody th,
				#wp-calendar tbody td,
				.widget_text .textwidget,
				.widget_tag_cloud .tagcloud a,
				.df-wraper .content-single-wrap .sidebar .widget p,
				.df-wraper #df-content-wrapper .sidebar .widget p,
				.df-wraper .sidebar .recentcomments span.comment-author-link {
					color: ".$sidebar_widget_paragraph_color."
				}

				section.widget.widget_df_widget_author .df-widget-author-list ul li,
				section.widget.widget_archive select,
				section.widget.widget_archive li,
				section.widget.widget_categories select,
				section.widget.widget_categories a,
				section.widget.widget_nav_menu a,
				section.widget.widget_meta a,
				section.widget.widget_pages a,
				section.widget #recentcomments li,
				section.widget.widget_recent_entries li,
				section.widget .df-form-search,
				section.widget button.df-button-search,
				section.widget .tagcloud a,
				section.widget .df-shortcode-blocks .df-shortcode-blocks-main.with-border-bottom,
				section.widget .df-widget-popular ul.df-nav-tab li,
				section.widget .df-widget-popular .tab-pane.df-tab-pane .df-most-popular-list,
				section.widget .df-widget-popular .df-most-popular-list,
				section.widget .df-widget-popular .df-most-popular-list,
				.sidebar .df-widget-title {
					border-color: ".$sidebar_widget_border_color.";
				}

				#df-content-wrapper .sidebar .post-meta li span, 
				#df-content-wrapper .sidebar .post-meta li a, 
				#df-content-wrapper .sidebar .social-sharing-count span,
				#df-content-wrapper .sidebar .post-meta a,
				.sidebar .entry-crumb li a {
					color : ".$sidebar_widget_extra_color."
				}
				
			";
			$sidebar_style = self::minify_css( $sidebar_style  );
			wp_add_inline_style('custom-style', $sidebar_style);
		}
		
		/**
		 * df_color_styling_general
		 */

		function df_color_styling_general(){
			wp_enqueue_style('custom-style', get_template_directory_uri() .
				'/inc/df-core/asset/css/custom-style.css');

			$color_styling_general = '';
			$color_style = self::df_get_color_style_options();
			$general_body_p_color = $color_style['general']['body_p_color'];
			$general_main_accent = $color_style['general']['main_accent_color'];
			$general_heading_color = $color_style['general']['heading_color'];
			$general_blockquote_color = $color_style['general']['blockquote_color'];
			$general_extra_color = $color_style['general']['extra_color'];
			$color_styling_general = "
				
				#df-content-wrapper .authors-meta a,
				#df-content-wrapper dd a,
				#df-content-wrapper p a,
				#df-content-wrapper table  a,
				#df-content-wrapper .entry-content li a,
				#df-content-wrapper figcaption a,
				#df-content-wrapper a,
			 	.entry-content p a,
				.df-trending .df-next-prev-wrap #buttons a {
					color : " . $general_main_accent . "
			  	}
				.df-social-sharing-buttons a:hover,
				.df-social-sharing-buttons span:hover {
					color : " . $general_main_accent ." !important;
				}
				.df-category-slider-btn li.custom-prev-arrow,
				.df-category-slider-btn li.custom-next-arrow {
					color : " . $general_main_accent . " !important;
				}
				.df-post-sharing.style1 li:hover {
				border-color : " . $general_main_accent . ";
				}

				.barWrapper .progress-bar,
				.df-video-playlist-wrapp .df-current-play {
					background : " . $general_main_accent . "
				}
			  
				#df-content-wrapper header.td-post-tittle,
				#df-content-wrapper header h1,
				#df-content-wrapper .entry-title,	
				.df-wraper #page h1,
				.df-wraper #page h2,
				.df-wraper #page h3,
				.df-wraper #page h4,
				.df-wraper #page h5,
				.df-wraper #page h6,
				.df-wraper #page h1 > a,
				.df-wraper #page h2 > a,
				.df-wraper #page h3 > a,
				.df-wraper #page h4 > a,
				.df-wraper #page h5 > a,
				.df-wraper #page h6 > a,
				#df-search-result h1 > a,
				#df-search-result h2 > a,
				#df-search-result h3 > a,
				#df-search-result h4 > a,
				#df-search-result h5 > a,
				#df-search-result h6 > a,
				.collapse-button i,
				#df-content-wrapper .df-wrapper-inner .container df-bg-content .content-single-wrap .df-post-content h1,
				#df-content-wrapper .vcard  a,
				ul.tags li a,
				#df-content-wrapper .authors-post .df-post-sharing li a,
				#search input[type=search] {
					color : " . $general_heading_color . "
				}
			  	
				.df-wraper #page #df-content-wrapper blockquote#df-dropcap p{
				  color : " . $general_blockquote_color . ";
				}

				.df-wraper #page #df-content-wrapper p:not(.megamenu-item-title):not(.megamenu-item-date),
				.df-lightbox-article-title a,
				.df-lightbox-sharing a,
				#df-content-wrapper table,
				#df-content-wrapper li:not(.df-btn),
				#df-content-wrapper address,
				#df-content-wrapper dl,
				.page-numbers li.active span,
				#df-content-top-post .df-category-top-post.layout-5 p.article-content,
				.df-post-content .wp-caption-text,
				.modal-search-caption,
				p.article-content,
				#df-content-wrapper .df-dropdown-category li a {
				  color : " . $general_body_p_color . "
				}
			  
				#df-content-wrapper .post-meta li span,
				#df-content-wrapper .post-meta li a,
				#df-content-wrapper .post-meta a,
				#df-content-wrapper .social-sharing-count span,
				#df-content-wrapper .post-meta .post-meta-desc .post-meta-desc-top a,
				#df-content-wrapper .post-meta .post-meta-desc .post-meta-desc-btm a,
				.post-meta a,
				.entry-crumb li a,
				.post-meta li i,
				.post-meta li span,
				.post-meta .post-meta-desc a,
				.post-meta .meta-top a,
				.post-meta .meta-bottom a,
				.post-date {
					color : " . $general_extra_color . "
			  	}

				.df-pagination-list li a:hover {
						background-color: " . $general_extra_color . "
				}
				
				
				";
			$color_styling_general = self::minify_css( $color_styling_general  );
			wp_add_inline_style('custom-style', $color_styling_general);
		}
		
		/**
		 * df_per_page_style
		 */

		function df_per_page_style(){
			if (is_page() ) {
				wp_enqueue_style('custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css');
				global $post;
 			    $general = self::df_get_general_options();
                $global_options = $general['global'];
                $global_color = $global_options['body_bg_color'];
				$per_page_style = '';
				$content_layout = "df_magz_page_content_layout";
				self::$metabox = new DF_get_metabox();
				self::$metabox->df_get_page_meta_value($post->ID);
			    $meta_background_image = isset(self::$metabox->background_image) ? self::$metabox->background_image : null;
				$meta_content_page_layout = self::$metabox->content_layout;
				$meta_background_repeat = self::$metabox->background_repeat;
				$meta_background_position = self::$metabox->background_posisition;
				$meta_background_size = self::$metabox->background_size;
				$meta_background_attachment = self::$metabox->background_attachment;
				$meta_background_background_colour = self::$metabox->background_colour;
                
                if ( 'default' == $meta_content_page_layout || !isset($meta_content_page_layout) ){
                    self::df_global_style();
                }else{
				    if ( 'full' !== $meta_content_page_layout ) {
				         if (null != $meta_background_image || '' !=$meta_background_image) {
					       $per_page_style .= 
				    	   ".df-bg {
                    					background: url(" . $meta_background_image . ");
                    					background-repeat: " . $meta_background_repeat . ";
                    					background-position: " . $meta_background_position . ";
                    					background-size: " . $meta_background_size . ";
                    					background-attachment: " . $meta_background_attachment . ";
                    					background-color: " . $meta_background_background_colour .";
					               }";
				        } else {
					       $per_page_style .= ".df-bg{	background-color: " . $meta_background_background_colour . ";}";
				        }
				    }
                }
                $per_page_style = self::minify_css( $per_page_style  );
				wp_add_inline_style('custom-style', $per_page_style);
			}
	}

 function df_per_post_style(){
		if (is_single()) {
			$post_setting = self::df_get_post_setting_options();
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			$global_color = $global_options['body_bg_color'];
			$per_post_style = '';
			wp_enqueue_style('custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css');
			global $post;
			self::$metabox = new DF_get_metabox();
			self::$metabox->df_get_post_meta_value($post->ID);
//echo "<pre>";
//print_r(self::$metabox);
//echo "</pre>";
			$post_meta_background_image = isset(self::$metabox->background_image) ? self::$metabox->background_image : null;
			$post_meta_background_repeat = self::$metabox->background_repeat;
			$post_meta_background_size = self::$metabox->background_size;
			$post_meta_background_position = self::$metabox->background_posisition;
			$post_meta_background_attachment = self::$metabox->background_attachment;
			$post_meta_background_color = self::$metabox->background_colour;
			$post_meta_featured_image = self::$metabox->featured_image;
			$post_meta_background_content_layout = self::$metabox->content_layout;
			
			
			
			if (null == $post_meta_background_content_layout || empty ($post_meta_background_content_layout) || "default" == $post_meta_background_content_layout  ) { //check if null or empy value metabox per post
				self::df_global_style();
			} else  {
				if( null == $post_meta_background_image || '' == $post_meta_background_image ){
					 $per_post_style .= "
						.df-bg{
							background-color: ".$post_meta_background_color.";
						}";
				} else {
					 $per_post_style .= "
						.df-bg{
							background:url(".$post_meta_background_image.");
							background-repeat: ".$post_meta_background_repeat.";
							background-position: ".$post_meta_background_position.";
							-webkit-background-size: ".$post_meta_background_size.";
							-moz-background-size: ".$post_meta_background_size.";
							-o-background-size: ".$post_meta_background_size.";
							background-size: ".$post_meta_background_size."; 
							background-attachment: ".$post_meta_background_attachment.";
							background-color: ".$post_meta_background_color.";
						}";
				}
				 $per_post_style .= "
				.container.df-bg-content , .df-lightbox-article-detail-wrapper{
					 background-color: ".$global_color.";
				}
				
				.df-wrapper-inner{
					background-color: ".$global_color." !important;
				}
			";
			}
			
			if ( "default" == $post_meta_featured_image ){
				if ( NULL != $is_feature_image || empty ($post_meta_featured_image) ){
					if ( "disable" == $post_meta_featured_image ) {
							$per_post_style .= "
							.single-post-feat-img {
							display : none;
							}";
						}
						
					}
			} else if (null != $post_meta_featured_image || empty($post_meta_featured_image) ) {
				if ( "disable" == $post_meta_featured_image ) {
					$per_post_style .= "
					.single-post-feat-img {
						display : none;
					}";
				}
		   
			}
			$per_post_style = self::minify_css( $per_post_style  ); 
			wp_add_inline_style('custom-style', $per_post_style);
		}
	}

		/**
		 * df_per_page_style
		 */
		function df_get_typo_options(){
			$typography_style = '';
			wp_enqueue_style( 'custom-style', get_template_directory_uri() .'/inc/df-core/asset/css/custom-style.css' );
			$typography_option = self::df_get_typography_options();
			
			
			$tg_heading1 = $typography_option['heading_1'];
			//$tg_h1_font_family = self::df_get_font_name( $tg_heading1['font_family'] );
			$h1_font_family = isset($tg_heading1['font_family']) ? $tg_heading1['font_family'] : null;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_heading1['font_weight']);
			$h1_font_weight = $arr[0];
			$h1_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			//$h1_font_weight = $dv_font_weight;
			$h1_font_subsets = isset($tg_heading1['font_subsets']) ? $tg_heading1['font_subsets'] : null;

			$h1_text_transform = $tg_heading1['text_transform'];
			$h1_font_size = $tg_heading1['font_size'];
			$h1_line_height = $tg_heading1['line_height'];
			$h1_letter_spacing = $tg_heading1['letter_spacing'];

			$tg_heading2 = $typography_option['heading_2'];
			//$tg_h2_font_family = self::df_get_font_name( $tg_heading2['font_family'] );
			$h2_font_family = isset($tg_heading2['font_family']) ? $tg_heading2['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_heading2['font_weight']);
			$h2_font_weight = $arr[0];
			$h2_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$h2_font_subsets = isset($tg_heading2['font_subsets']) ? $tg_heading2['font_subsets'] : null;

			$h2_text_transform = $tg_heading2['text_transform'];
			$h2_font_size = $tg_heading2['font_size'];
			$h2_line_height = $tg_heading2['line_height'];
			$h2_letter_spacing = $tg_heading2['letter_spacing'];

			$tg_heading3 = $typography_option['heading_3'];
			//$tg_h3_font_family = self::df_get_font_name( $tg_heading3['font_family'] );
			$h3_font_family = isset($tg_heading3['font_family']) ? $tg_heading3['font_family'] : null;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_heading3['font_weight']);
			$h3_font_weight = $arr[0];
			$h3_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$h3_font_subsets = isset($tg_heading3['font_subsets']) ? $tg_heading3['font_subsets'] : null;

			$h3_text_transform = $tg_heading3['text_transform'];
			$h3_font_size = $tg_heading3['font_size'];
			$h3_line_height = $tg_heading3['line_height'];
			$h3_letter_spacing = $tg_heading3['letter_spacing'];

			$tg_heading4 = $typography_option['heading_4'];
			//$tg_h4_font_family = self::df_get_font_name( $tg_heading4['font_family'] );
			$h4_font_family = isset($tg_heading4['font_family']) ? $tg_heading4['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_heading4['font_weight']);
			$h4_font_weight = $arr[0];
			$h4_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$h4_font_subsets = isset($tg_heading4['font_subsets']) ? $tg_heading4['font_subsets'] : null;

			$h4_text_transform = $tg_heading4['text_transform'];
			$h4_font_size = $tg_heading4['font_size'];
			$h4_line_height = $tg_heading4['line_height'];
			$h4_letter_spacing = $tg_heading4['letter_spacing'];

			$tg_heading5 = $typography_option['heading_5'];
			///$tg_h5_font_family = self::df_get_font_name( $tg_heading5['font_family'] );
			$h5_font_family = isset($tg_heading5['font_family']) ? $tg_heading5['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_heading5['font_weight']);
			$h5_font_weight = $arr[0];
			$h5_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$h5_font_subsets = isset($tg_heading5['font_subsets']) ? $tg_heading5['font_subsets'] : null;

			$h5_text_transform = $tg_heading5['text_transform'];
			$h5_font_size = $tg_heading5['font_size'];
			$h5_line_height = $tg_heading5['line_height'];
			$h5_letter_spacing = $tg_heading5['letter_spacing'];

			$tg_heading6 = $typography_option['heading_6'];
			//$tg_h6_font_family = self::df_get_font_name( $tg_heading6['font_family'] );
			$h6_font_family = isset($tg_heading6['font_family']) ? $tg_heading6['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_heading6['font_weight']);
			$h6_font_weight = $arr[0];
			$h6_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$h6_font_subsets = isset($tg_heading6['font_subsets']) ? $tg_heading6['font_subsets'] : null;

			$h6_text_transform = $tg_heading6['text_transform'];
			$h6_font_size = $tg_heading6['font_size'];
			$h6_line_height = $tg_heading6['line_height'];
			$h6_letter_spacing = $tg_heading6['letter_spacing'];

			$tg_p = $typography_option['paragraph_body'];
			//$tg_p_font_family = self::df_get_font_name( $tg_p['font_family'] );
			$p_font_family = isset($tg_p['font_family']) ? $tg_p['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_p['font_weight']);
			$p_font_weight = $arr[0];
			$p_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$p_font_subsets = isset($tg_p['font_subsets']) ? $tg_p['font_subsets'] : null;

			$p_text_transform = $tg_p['text_transform'];
			$p_font_size = $tg_p['font_size'];
			$p_line_height = $tg_p['line_height'];
			$p_letter_spacing = $tg_p['letter_spacing'];

			$tg_tablet = $typography_option['paragraph_resp_tab_portrait'];
			$tablet_line_height = $tg_tablet['line_height'];
			$tablet_font_size =  $tg_tablet['font_size'];

			$tg_tablet_heading = $typography_option['heading_1_resp_tab_portrait'];
			$h1_tablet_font_size = $tg_tablet_heading['font_size'];
			$h1_tablet_line_height = $tg_tablet_heading['line_height'];

			$tg_tablet_heading = $typography_option['heading_2_resp_tab_portrait'];
			$h2_tablet_font_size = $tg_tablet_heading['font_size'];
			$h2_tablet_line_height = $tg_tablet_heading['line_height'];

			$tg_tablet_heading = $typography_option['heading_3_resp_tab_portrait'];
			$h3_tablet_font_size = $tg_tablet_heading['font_size'];
			$h3_tablet_line_height = $tg_tablet_heading['line_height'];

			$tg_tablet_heading = $typography_option['heading_4_resp_tab_portrait'];
			$h4_tablet_font_size = $tg_tablet_heading['font_size'];
			$h4_tablet_line_height = $tg_tablet_heading['line_height'];

			$tg_tablet_heading = $typography_option['heading_5_resp_tab_portrait'];
			$h5_tablet_font_size = $tg_tablet_heading['font_size'];
			$h5_tablet_line_height = $tg_tablet_heading['line_height'];

			$tg_tablet_heading = $typography_option['heading_6_resp_tab_portrait'];
			$h6_tablet_font_size = $tg_tablet_heading['font_size'];
			$h6_tablet_line_height = $tg_tablet_heading['line_height'];

			$tg_mobile_heading = $typography_option['heading_1_resp_mobile'];
			$h1_mobile_font_size = $tg_mobile_heading['font_size'];
			$h1_mobile_line_height = $tg_mobile_heading['line_height'];

			$tg_mobile_heading = $typography_option['heading_2_resp_mobile'];
			$h2_mobile_font_size = $tg_mobile_heading['font_size'];
			$h2_mobile_line_height = $tg_mobile_heading['line_height'];

			$tg_mobile_heading = $typography_option['heading_3_resp_mobile'];
			$h3_mobile_font_size = $tg_mobile_heading['font_size'];
			$h3_mobile_line_height = $tg_mobile_heading['line_height'];

			$tg_mobile_heading = $typography_option['heading_4_resp_mobile'];
			$h4_mobile_font_size = $tg_mobile_heading['font_size'];
			$h4_mobile_line_height = $tg_mobile_heading['line_height'];

			$tg_mobile_heading = $typography_option['heading_5_resp_mobile'];
			$h5_mobile_font_size = $tg_mobile_heading['font_size'];
			$h5_mobile_line_height = $tg_mobile_heading['line_height'];

			$tg_mobile_heading = $typography_option['heading_6_resp_mobile'];
			$h6_mobile_font_size = $tg_mobile_heading['font_size'];
			$h6_mobile_line_height = $tg_mobile_heading['line_height'];

			$tg_mobile = $typography_option['paragraph_resp_mobile'];
			$mobile_p_font_size = $tg_tablet['font_size'];
			$mobile_p_line_height = $tg_tablet['line_height'];

			$tg_button = $typography_option['button'];
			//$tg_button_font_family = self::df_get_font_name( $tg_button['font_family'] );
			$button_font_family = isset($tg_button['font_family']) ? $tg_button['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_button['font_weight']);
			$button_font_weight = $arr[0];
			$button_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$button_font_subsets = isset($tg_button['font_subsets']) ? $tg_button['font_subsets'] : null;

			$button_text_transform = $tg_button['text_transform'];
			$button_font_size = $tg_button['font_size'];
			$button_line_height = $tg_button['line_height'];
			$button_letter_spacing = $tg_button['letter_spacing'];

			$tg_breadcrumbs = $typography_option['breadcrumbs_typo'];
			//$tg_breadcrumbs_font_family = self::df_get_font_name( $tg_breadcrumbs['font_family'] );
			$bc_font_family = isset($tg_breadcrumbs['font_family']) ? $tg_breadcrumbs['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_breadcrumbs['font_weight']);
			$bc_font_weight = $arr[0];
			$bc_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$bc_font_subsets = isset($tg_breadcrumbs['font_subsets']) ? $tg_breadcrumbs['font_subsets'] : null;

			$bc_text_transform = $tg_breadcrumbs['text_transform'];
			$bc_font_size = $tg_breadcrumbs['font_size'];
			$bc_line_height = $tg_breadcrumbs['line_height'];
			$bc_letter_spacing = $tg_breadcrumbs['letter_spacing'];

			$tg_categories = $typography_option['categories_typo'];
			//$tg_cat_font_family = self::df_get_font_name( $tg_categories['font_family'] );
			$cat_font_family = isset($tg_categories['font_family']) ?$tg_categories['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_categories['font_weight']);
			$cat_font_weight = $arr[0];
			$cat_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$cat_font_subsets = isset($tg_categories['font_subsets']) ? $tg_categories['font_subsets'] : null;

			$cat_text_transform = $tg_categories['text_transform'];
			$cat_font_size = $tg_categories['font_size'];
			$cat_line_height = $tg_categories['line_height'];
			$cat_letter_spacing = $tg_categories['letter_spacing'];

			$tg_post_meta = $typography_option['post_meta_typo'];
			//$tg_post_meta_font_family = self::df_get_font_name( $tg_post_meta['font_family'] );
			$post_meta_font_family = isset($tg_post_meta['font_family']) ?$tg_post_meta['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_post_meta['font_weight']);
			$post_meta_font_weight = $arr[0];
			$post_meta_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$post_meta_font_subsets = isset($tg_post_meta['font_subsets']) ? $tg_post_meta['font_subsets'] : null;

			$post_meta_text_transform = $tg_post_meta['text_transform'];
			$post_meta_font_size = $tg_post_meta['font_size'];
			$post_meta_line_height = $tg_post_meta['line_height'];
			$post_meta_letter_spacing = $tg_post_meta['letter_spacing'];

			$tg_sub_quote = $typography_option['subtitle_quote_typo'];
			//$tg_sub_quote_font_family = self::df_get_font_name( $tg_sub_quote['font_family'] );
			$sub_quote_font_family = isset($tg_sub_quote['font_family']) ? $tg_sub_quote['font_family'] : null;

			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$tg_sub_quote['font_weight']);
			$sub_quote_font_weight = $arr[0];
			$sub_quote_font_style = isset($arr[1]) ? " " . $arr[1] : 'normal';
			$sub_quote_font_subsets = isset($tg_sub_quote['font_subsets']) ? $tg_sub_quote['font_subsets'] : null;

			$sub_quote_text_transform = $tg_sub_quote['text_transform'];
			$sub_quote_font_size = $tg_sub_quote['font_size'];
			$sub_quote_line_height = $tg_sub_quote['line_height'];
			$sub_quote_letter_spacing = $tg_sub_quote['letter_spacing'];
			

			$typography_style .= "
				.df-wraper h1 {
					font-family: ".$h1_font_family.";
					font-weight: ".$h1_font_weight.";
					font-style: ".$h1_font_style.";
					text-transform: ".$h1_text_transform.";
					font-size: ".$h1_font_size."px;
					line-height: ".$h1_line_height."px;
					letter-spacing: ".$h1_letter_spacing."px;
				}
				.df-wraper h2 {
					font-family: ".$h2_font_family.";
					font-weight: ".$h2_font_weight.";
					font-style: ".$h2_font_style.";
					text-transform: ".$h2_text_transform.";
					font-size: ".$h2_font_size."px;
					line-height: ".$h2_line_height."px;
					letter-spacing: ".$h2_letter_spacing."px;
				}
				.df-wraper h3 {
					font-family: ".$h3_font_family.";
					font-weight: ".$h3_font_weight.";
					font-style: ".$h3_font_style.";
					text-transform: ".$h3_text_transform.";
					font-size: ".$h3_font_size."px;
					line-height: ".$h3_line_height."px;
					letter-spacing: ".$h3_letter_spacing."px;
				}
				.df-wraper h4,
				.smartlist-number-subtitle,
				.subtitle-smartlist,
				.subtitle-smartlist.style1 li {
					font-family: ".$h4_font_family.";
					font-weight: ".$h4_font_weight.";
					font-style: ".$h4_font_style.";
					text-transform: ".$h4_text_transform.";
					font-size: ".$h4_font_size."px;
					line-height: ".$h4_line_height."px;
					letter-spacing: ".$h4_letter_spacing."px;
				}
				.df-wraper h5,
				section.widget .df-widget-title {
					font-family: ".$h5_font_family.";
					font-weight: ".$h5_font_weight.";
					font-style: ".$h5_font_style.";
					text-transform: ".$h5_text_transform.";
					font-size: ".$h5_font_size."px;
					line-height: ".$h5_line_height."px;
					letter-spacing: ".$h5_letter_spacing."px;
				}
				.df-wraper h6 {
					font-family: ".$h6_font_family.";
					font-weight: ".$h6_font_weight.";
					font-style: ".$h6_font_style.";
					text-transform: ".$h6_text_transform.";
					font-size: ".$h6_font_size."px;
					line-height: ".$h6_line_height."px;
					letter-spacing: ".$h6_letter_spacing."px;
				}
				body {
					font-family: ".$p_font_family.";
					font-weight: ".$p_font_weight.";
					font-style: ".$p_font_style.";
					text-transform: ".$p_text_transform.";
					font-size: ".$p_font_size."px;
					line-height: ".$p_line_height."px;
					letter-spacing: ".$p_letter_spacing."px;
				}
				
				input[type=submit],
				.df-btn {
					font-family: ".$button_font_family.";
					font-weight: ".$button_font_weight.";
					font-style: ".$button_font_style.";
					text-transform: ".$button_text_transform.";
					font-size: ".$button_font_size."px;
					line-height: ".$button_line_height."px;
					letter-spacing: ".$button_letter_spacing."px;
				}
				.entry-crumb li a {
					font-family: ".$bc_font_family.";
					font-weight: ".$bc_font_weight.";
					font-style: ".$bc_font_style.";
					text-transform: ".$bc_text_transform.";
					font-size: ".$bc_font_size."px;
					line-height: ".$bc_line_height."px;
					letter-spacing: ".$bc_letter_spacing."px;
				}

				.df-category a {
					font-family: ".$cat_font_family.";
					font-weight: ".$cat_font_weight.";
					font-style: ".$cat_font_style.";
					text-transform: ".$cat_text_transform.";
					font-size: ".$cat_font_size."px;
					line-height: ".$cat_line_height."px;
					letter-spacing: ".$cat_letter_spacing."px;
				}
				
				.post-meta a,
				.post-meta span,
				.post-meta i,
				.post-meta li a,
				.post-meta li span,
				.post-meta li i,
				.post-meta,
				.post-meta .post-meta-desc,
				.post-meta .post-meta-desc-top,
				.post-meta .post-meta-desc-btm,
				#df-wrapper-content-single .social-sharing-count span,
				.df-video-desc p {
					font-family: ".$post_meta_font_family.";
					font-weight: ".$post_meta_font_weight.";
					font-style: ".$post_meta_font_style.";
					text-transform: ".$post_meta_text_transform.";
					font-size: ".$post_meta_font_size."px;
					line-height: ".$post_meta_line_height."px;
					letter-spacing: ".$post_meta_letter_spacing."px;
				}
				.post-meta .article-post-meta-1-top,
				.post-meta .article-post-meta-2-top,
				.post-meta .article-post-meta-4-top,
				.post-meta .article-post-meta-6-top {
					margin-top: calc(20px - ".$post_meta_line_height."px);
				}
				.post-meta.block-1.lg .post-meta-desc-top,
				.post-meta.block-3 .post-meta-desc-top,
				.post-meta.block-7 .post-meta-desc-top,
				.post-meta.block-10.lg .post-meta-desc-top,
				.post-meta.block-12.lg .post-meta-desc-top,
				.post-meta.block-14 .post-meta-desc-top,
				.post-meta.widget-block-1.lg .post-meta-desc-top,
				.post-meta.widget-block-3 .post-meta-desc-top,
				.post-meta.widget-block-7 .post-meta-desc-top,
				.post-meta.widget-block-10.lg .post-meta-desc-top,
				.post-meta.with-margin-top .post-meta-desc-top{
					margin-top: calc(20px - ".$post_meta_line_height."px);
				}
				.post-meta .article-post-meta-5-left,
				.post-meta .article-post-meta-5-right {
					margin-top: calc(28px - ".$post_meta_line_height."px);
				}

				.df-wraper .content-single-wrap .df-post-content article blockquote > p,
				#df-wrapper-content-single .df-post-content article blockquote > p,
				.df-wraper .content-single-wrap .df-post-content .df-subtitle {
					font-family: ".$sub_quote_font_family.";
					font-weight: ".$sub_quote_font_weight.";
					font-style: ".$sub_quote_font_style.";
					text-transform: ".$sub_quote_text_transform.";
					font-size: ".$sub_quote_font_size."px;
					line-height: ".$sub_quote_line_height."px;
					letter-spacing: ".$sub_quote_letter_spacing."px;
				}
				.df-footer-description,
				.df-footer2-description,
				.df-footer-center-decription,
				.widget_archive li a,
				.widget_archive select,
				.widget_calendar #wp-calendar,
				.widget_categories li a,
				.widget_nav_menu li a,
				.widget_meta li a,
				.widget_pages li a,
				.widget_recent_comments li,
				.widget_recent_comments li a,
				.widget_recent_entries li a,
				.widget_search .df-form-search,
				.widget_tag_cloud .tagcloud a,
				.widget_text .textwidget,
				.widget .wp-calendar .caption {
					font-family: ".$p_font_family.";
					font-weight: ".$p_font_weight.";
					font-style: ".$p_font_style.";
					text-transform: ".$p_text_transform.";
					font-size: ".$p_font_size."px;
					line-height: ".$p_line_height."px;
					letter-spacing: ".$p_letter_spacing."px;
				}

				@media (max-width: 48em) {
					.df-wraper h1 {
						font-size: " .$h1_tablet_font_size. "px;
						line-height: " .$h1_tablet_line_height. "px;
					}

					.df-wraper h2 {
						font-size: " .$h2_tablet_font_size. "px;
						line-height: " .$h2_tablet_line_height. "px;
					}

					.df-wraper h3 {
						font-size: " .$h3_tablet_font_size. "px;
						line-height: " .$h3_tablet_line_height. "px;
					}

					.df-wraper h4 {
						font-size: " .$h4_tablet_font_size. "px;
						line-height: " .$h4_tablet_line_height. "px;
					}

					.df-wraper h5 {
						font-size: " .$h5_tablet_font_size. "px;
						line-height: " .$h5_tablet_line_height. "px;
					}

					.df-wraper h6 {
						font-size: " .$h6_tablet_font_size. "px;
						line-height: " .$h6_tablet_line_height. "px;
					}
					.df-wraper p{
						font-size: " .$tablet_font_size. "px;
						line-height: " .$tablet_line_height. "px;
					}
				}

				@media (max-width: 34em) {
					.df-wraper h1 {
						font-size: " .$h1_mobile_font_size. "px;
						line-height: " .$h1_mobile_line_height. "px;
					}
					.df-wraper h2 {
						font-size: " .$h2_mobile_font_size. "px;
						line-height: " .$h2_mobile_line_height. "px;
					}
					.df-wraper h3 {
						font-size: " .$h3_mobile_font_size. "px;
						line-height: " .$h3_mobile_line_height. "px;
					}
					.df-wraper h4 {
						font-size: " .$h4_mobile_font_size. "px;
						line-height: " .$h4_mobile_line_height. "px;
					}
					.df-wraper h5 {
						font-size: " .$h5_mobile_font_size. "px;
						line-height: " .$h5_mobile_line_height. "px;
					}
					.df-wraper h6 {
						font-size: " .$h6_mobile_font_size. "px;
						line-height: " .$h6_mobile_line_height. "px;
					}
					.df-wraper p {
						font-size: " .$mobile_p_font_size. "px;
						line-height: " .$mobile_p_line_height. "px;
					}
				}
			";
			$typography_style = self::minify_css( $typography_style  ); 
			wp_add_inline_style( 'custom-style', $typography_style );
		}
		
		function df_button_style(){
			  wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/inc/df-core/asset/css/custom-style.css' );
				$button_style = '';  
				$color_style = self::df_get_color_style_options();
				$button_option = $color_style['button'];
				$button = $button_option['button'];
				$button_hover = $button_option['button_hover'];
				$button_text = $button_option['button_text'];
				$button_text_hover = $button_option['button_text_hover'];
				$button_style .= "
					input[type=submit],
					.df-btn.df-btn-normal {
						color       : ". $button_text ."; 
						background  : ". $button .";
					}
					.df-btn.df-btn-normal a {
							color       : ". $button_text ." !important; 
					}
										input[type=submit]:hover,
										.df-btn.df-btn-normal:hover{
						background  : ". $button_hover .";
					}
					.df-btn.df-btn-normal:hover a {
							color       : ". $button_text_hover ." !important;
					}
					li.active .df-btn{
							color       : ". $button_text_hover ."; 
						background  : ". $button_hover .";
					}
				";
				$button_style = self::minify_css( $button_style  ); 
				wp_add_inline_style( 'custom-style', $button_style );
		}
		
		function df_get_per_category(){
			$per_category_style = "";

			wp_enqueue_style( 'custom-style', get_template_directory_uri() .'/inc/df-core/asset/css/custom-style.css' );
			$general = self::df_get_general_options();
			$global_options = $general['global'];

			$categories = self::df_get_categories_options();
			//$categories_title_template = $categories['layout'];

			if (!is_category() ){
				return;
			}
			$category = get_query_var('cat');
			$current_category = get_category( $category );
			// $per_category = $categories['per_category'][$current_category->term_id];
			$bg_color = $global_options['body_bg_color'];

			$per_category_style .= "
				#df-content-top-post .df-category-top-post,
				#archive-layout.boxed.no-padding,
				#df-content-top-post .top-post-wrap .top-post-nav-btn{
					 background-color: ".$bg_color.";
				}
			";
			
			$content_area_layout = $global_options['layout'];
			
			if( !isset( $categories['per_category'][$current_category->term_id] ) ){
				$params_setting['bg_color'] = $global_options['bg_color'];
				$params_setting['bg_position'] = $global_options['bg_position'];
				$params_setting['bg_repeat'] = $global_options['bg_repeat'];
				$params_setting['bg_attachment']= $global_options['bg_attachment'];
				$params_setting['bg_size']= $global_options['bg_size'];
				$params_setting['bg']= $global_options['bg_img'];

			}else{
				$per_category = $categories['per_category'][$current_category->term_id];
				if ( !empty( $per_category['category_color'] ) ) {
					$params_setting['category_color']= $per_category['category_color'];
					$per_category_style .= "
						.archive-wraper-1 .df-category a {
							background-color: " . $params_setting['category_color'] . "; 
						}
					";
				}
				
				if ( !isset($per_category['bg_color'] ) || empty( $per_category['bg_color'] ) ){
					$params_setting['bg_color'] = $global_options['bg_color'];
				} else {
					$params_setting['bg_color'] = $per_category['bg_color'];
				}
				
				if ( !isset($per_category['bg_position'] ) || empty( $per_category['bg_position'] ) ){
					$params_setting['bg_position'] = $global_options['bg_position'];
				} else {
					$params_setting['bg_position'] = $per_category['bg_position'];
				}
				
				if ( !isset($per_category['bg_repeat'] ) || empty( $per_category['bg_repeat'] ) ){
					$params_setting['bg_repeat'] = $global_options['bg_repeat'];
				} else {
					$params_setting['bg_repeat'] = $per_category['bg_repeat'];
				}
				
				if ( !isset($per_category['bg_attachment'] ) || empty( $per_category['bg_attachment'] ) ) {
					$params_setting['bg_attachment']= $global_options['bg_attachment'];
				} else {
					$params_setting['bg_attachment']= $per_category['bg_attachment'];
				}
				
				if ( !isset( $per_category['bg_size'] ) || empty( $per_category['bg_size'] ) ) {
					$params_setting['bg_size']= $global_options['bg_size'];
				} else {
					$params_setting['bg_size']= $per_category['bg_size'];
				}
				
				if ( !isset($per_category['bg'] ) || empty( $per_category['bg'] )) {
					$params_setting['bg']= $global_options['bg_img'];
				} else {
					$params_setting['bg']= $per_category['bg'];
				}

				$content_area_layout = ( $per_category['content_area_layout'] == 'default' ) ? $global_options['layout'] : $per_category['content_area_layout'];
			}
			
			if( $content_area_layout != 'full' ){
				// $per_category_style .= "
				// 	#df-content-wrapper{				    
				// 		background-repeat: " . $params_setting['bg_repeat'] .";
				// 		background-position: " .  $params_setting['bg_position'] .";
				// 		background-size: " .  $params_setting['bg_size'] .";
				// 		background-attachment: " . $params_setting['bg_attachment'] .";
				// 		background-color: " .  $params_setting['bg_color'] . ";
				// 	}
				// ";
				$per_category_style .= "
					.df-bg{				    
						background-repeat: " . $params_setting['bg_repeat'] .";
						background-position: " .  $params_setting['bg_position'] .";
						background-size: " .  $params_setting['bg_size'] .";
						background-attachment: " . $params_setting['bg_attachment'] .";
						background-color: " .  $params_setting['bg_color'] . ";
					}
				";
				if( !isset( $per_category['bg_color'] ) || empty( $per_category['bg_color'] ) ){
					$per_category_style .= "
					.df-bg{
							background-image: url(".$params_setting['bg'].");
					}";
				}else if( isset( $per_category['bg']) && !empty( $per_category['bg'] ) ){
					$per_category_style .= "
					.df-bg{
							background-image: url(".$params_setting['bg'].");
					}";
				}
			}else{
				$per_category_style .= "
					.df-bg{
						background-color: " .  $global_options['body_bg_color'] . ";
					}
				";
			}
		   	$per_category_style = self::minify_css( $per_category_style  ); 
			wp_add_inline_style( 'custom-style', $per_category_style );
		}

		function df_get_custom_css(){
			$custom_css = "";
			wp_enqueue_style( 'custom-style', get_template_directory_uri() .'/inc/df-core/asset/css/custom-style.css' );
			$general = self::df_get_general_options();
			$global_options = $general['custom_code'];
			$custom_css  = $global_options['custom_css'];
			$custom_css = self::minify_css( $custom_css  ); 
			wp_add_inline_style( 'custom-style', $custom_css );
			
		}
		
		function df_color_category(){
			$color_category = "";
			$CC = "";
			wp_enqueue_style( 'custom-style', get_template_directory_uri() .'/inc/df-core/asset/css/custom-style.css' );
			$general = self::df_get_general_options();
			$global_options = $general['global'];
			$categories = DF_Options::df_get_categories_options();

			$category = get_query_var('cat');
			$current_category = get_category($category);
			
			$sumCategory = get_terms( 'category', array(
									'hide_empty' => 0
									));
			$countCategory = count($sumCategory);
			for($i = 0 ; $i < $countCategory ; $i++){
					$x = $sumCategory[$i]->term_id ;
					$name = $sumCategory[$i]->name ;
					$name = str_replace(" ", "-",$name);
					$name = str_replace("&amp;", "and", $name);
					
					if( isset( $categories['per_category'][$x]['category_color'] )){
					
						$per_category = $categories['per_category'][$x]['category_color'];
						$CC = $per_category;
						if ( '#fff' == $CC || '#ffffff' == $CC ) {
							$color_category .=  ".df-category a.cat-".$name." {
								color: #000 !important;
								padding: 2px 5px 3px;
								border: 1px solid #eee;              
							}";
							$color_category .=  ".df-category-top-post .top-post-content .top-post-content-inner a.cat-".$name." {
								color: #000 !important;
								padding: 2px 5px 3px;
								border: 1px solid #eee;              
							}";
							$color_category .=  ".df-category-header .df-category-header-list.df-category.df-sub-category li a.cat-".$name.":hover {
								
								border: 1px solid #eee !important;              
							}";
							$color_category .=  ".df-category-header.df-category-header-2 .df-category-header-list.df-category.df-sub-category li a.cat-".$name." {
								color: #000 !important;
								border: 1px solid #eee !important;              
							}";
							$color_category .= ".archive-wraper.style-3.main-wraper:hover a.cat-".$name."{
								color: #000 !important;
								border: 1px solid #eee !important;
							}";
							$color_category .= ".df-shortcode-blocks.style-8.widget-blocks .df-shortcode-blocks-main.widget-grid .df-shortcode-blocks-main-inner a.cat-".$name."{
								color: #000 !important;
								border: 1px solid #eee !important;
							}";
							$color_category .= ".df-shortcode-blocks.style-11.widget-blocks .df-shortcode-blocks-main.widget-grid .df-shortcode-blocks-main-inner a.cat-".$name."{
								color: #000 !important;
								border: 1px solid #eee !important;
							}";
							$color_category .= ".df-shortcode-blocks.style-8.main-blocks .df-shortcode-blocks-main.main-grid .df-shortcode-blocks-main-inner a.cat-".$name."{
								color: #000 !important;
								border: 1px solid #eee !important;
							}";
							$color_category .= ".df-shortcode-blocks.style-11.main-blocks .df-shortcode-blocks-main.main-grid .df-shortcode-blocks-main-inner a.cat-".$name."{
								color: #000 !important;
								border: 1px solid #eee !important;
							}";
						}
					} else {
						$CC = "#000";
					}
						$color_category .=  ".df-category a.cat-".$name." {
						background-color: " . $CC . ";                   
							}";
						$color_category .=  ".df-category-header .df-category-header-list.df-category.df-sub-category li a.cat-".$name.":hover {
						background-color: " . $CC . ";   
						border-color: " . $CC . ";             
							}";
						$color_category .=  ".df-category-header.df-category-header-2 .df-category-header-list.df-category.df-sub-category li a.cat-".$name." {
						background-color: " . $CC . ";   
						border-color: " . $CC . ";             
							}";
						$color_category .=  ".df-category-header.df-category-header-2 .df-category-header-list.df-category.df-sub-category li a.cat-".$name.":hover {
						background-color: " . $CC . ";   
						border-color: " . $CC . ";             
							}";
				 }
				$color_category = self::minify_css( $color_category  );  
			  wp_add_inline_style( 'custom-style', $color_category );
		}

		static function minify_css($input) {
			    if(trim($input) === "") return $input;
			    // Force white-space(s) in `calc()`
			    if(strpos($input, 'calc(') !== false) {
			        $input = preg_replace_callback('#(?<=[\s:])calc\(\s*(.*?)\s*\)#', function($matches) {
			            return 'calc(' . preg_replace('#\s+#', "\x1A", $matches[1]) . ')';
			        }, $input);
			    }
			    return preg_replace(
			        array(
			            // Remove comment(s)
			            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
			            // Remove unused white-space(s)
			            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
			            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
			            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
			            // Replace `:0 0 0 0` with `:0`
			            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
			            // Replace `background-position:0` with `background-position:0 0`
			            '#(background-position):0(?=[;\}])#si',
			            // Replace `0.6` with `.6`, but only when preceded by a white-space or `=`, `:`, `,`, `(`, `-`
			            '#(?<=[\s=:,\(\-]|&\#32;)0+\.(\d+)#s',
			            // Minify string value
			            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][-\w]*?)\2(?=[\s\{\}\];,])#si',
			            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
			            // Minify HEX color code
			            '#(?<=[\s=:,\(]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
			            // Replace `(border|outline):none` with `(border|outline):0`
			            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
			            // Remove empty selector(s)
			            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',
			            '#\x1A#'
			        ),
			        array(
			            '$1',
			            '$1$2$3$4$5$6$7',
			            '$1',
			            ':0',
			            '$1:0 0',
			            '.$1',
			            '$1$3',
			            '$1$2$4$5',
			            '$1$2$3',
			            '$1:0',
			            '$1$2',
			            ' '
			        ),
			    $input);
		}

		/* Convert hexdec color string to rgb(a) string */
		static function hex2rgba($color, $opacity = false) {
		 
			$default = 'rgb(0,0,0)';
		 
			//Return default if no color provided
			if(empty($color))
		          return $default; 
		 
			//Sanitize $color if "#" is provided 
		        if ($color[0] == '#' ) {
		        	$color = substr( $color, 1 );
		        }
		 
		        //Check if color has 6 or 3 characters and get values
		        if (strlen($color) == 6) {
		                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		        } elseif ( strlen( $color ) == 3 ) {
		                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		        } else {
		                return $default;
		        }
		 
		        //Convert hexadec to rgb
		        $rgb =  array_map('hexdec', $hex);
		 
		        //Check if opacity is set(rgba or rgb)
		        if($opacity){
		        	if(abs($opacity) > 1)
		        		$opacity = 1.0;
		        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		        } else {
		        	$output = 'rgb('.implode(",",$rgb).')';
		        }
		 
		        //Return rgb(a) color string
		        return $output;
		}

		public function register_all_typography(){
			$menu_options = self::df_get_menu_options_options();
		}
	}

	new DF_CSS_Options();

}

/* file location: /your/file/location/[file].php */
