<?php
if( !class_exists( "DF_Framework" ) ){
	
	Class DF_Framework{
		static $default_featured_img = "";

		static $default_featured_img_id = "";

		function __construct(){
			$this->df_init_require_plugin();
			add_filter( 'script_loader_src', array('DF_Framework','_remove_script_version'), 15, 1 );
			// $this->df_set_global_variable();
			add_action( 'df_set_global_variable', array( $this, 'df_set_global_variable'));
			add_filter( 'body_class', function( $classes ) { 
				return array_merge( $classes, array( 'df-wraper' ) ); 
			} );
			add_action( 'wp_head', array( $this, 'df_google_analytic') );
			add_action( 'wp_ajax_df_lightbox_detail', array( $this, 'df_lightbox_detail') );
			add_action( 'wp_ajax_nopriv_df_lightbox_detail', array( $this, 'df_lightbox_detail') );

		}

		private function df_init_require_plugin(){
			add_action( 'tgmpa_register', array( $this,'df_register_required_plugins' ) );

			add_action('df_option_initialize', array('DF_Config_Options', 'df_init_options'), 9);

			add_action( 'admin_enqueue_scripts', array($this,'df_load_admin_js' ) );

			add_action( 'admin_enqueue_scripts', array($this,'df_load_admin_css' ) );

			add_action( 'wp_enqueue_scripts', array( $this,'df_load_js' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'df_load_css' ) );

			add_action('df_init_theme_support', array ( $this, 'df_init_theme_support'));

			add_action('restrict_manage_posts', array ( $this, 'df_post_author_filter'));

			/* lazy Load change src to data-originial
			** Avoid load image immediatly
			*/
			add_filter( 'wp_get_attachment_image_attributes', array( $this, 'df_src_attribute_attr' ), 10, 3);

            if ( in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ){
                add_action('login_head' , array ('DF_Header','df_get_fav_icon'));
            }

			if(!is_admin()){
				$this->get_all_options();
				do_action('df_init_theme_support');
				add_filter('the_content', array( $this,  'df_add_img_class'), 10, 3);
			}else{
			 	add_action('admin_head' , array ('DF_Header','df_get_fav_icon'));
			}

			add_filter( 'the_excerpt', array( $this, 'df_excerpt') );

			add_action('widgets_init', array ( $this, 'df_register_generated_sidebars'));

			add_action( 'df_image_size', array( $this, 'df_image_size' ) );

			add_filter( 'post_class',  array( $this,'df_remove_hentry' ) );
		}

		function df_init_theme_support() {
			$enable_infinite_scroll = DF_Global_Options::$options;
			$is_infinite_scroll = $enable_infinite_scroll['post_setting']['infinite_loading'];
			if ( $is_infinite_scroll  == 'yes' ) {
				
				add_theme_support( 'infinite-transporter', array(
					'container' => 'content-single-wrap',
					'footer'	=> 'page',
					'click_handle'    => false,
					)
				);	
			}else {
				remove_theme_support( 'infinite-transporter' );
			}
		}

		function df_image_size(){
// layout archive 1, 2, 6 sidebar, widget image
			add_image_size( 'df_size_376x250', 376,250, array('center', 'top') ); 
			
//  layout archive 3 no sidebar
			add_image_size( 'df_size_1200x200', 1200,200, array('center', 'center') ); 

//  layout archive 4
			add_image_size( 'df_size_376xauto', 376,0, array('center', 'top') ); 

//  layout archive 5 sidebar
			add_image_size( 'df_size_788x524', 788,524, array('center', 'center') ); 
//  layout block 9
			add_image_size( 'df_size_273x205', 273,205, array('center', 'center') ); 

//  layout block 11 full, category top post 4
			add_image_size( 'df_size_1200x675', 1200,675, array('center', 'center') );

//  layout category top post 1
			add_image_size( 'df_size_474x633', 474,633, array('center', 'center') );

//  layout category top post 3
			add_image_size( 'df_size_632x474', 632,474, array('center', 'center') );

			add_image_size( 'df_size_994x120', 994, 120, array('center', 'center') );
		}
		
		public function df_set_global_variable () {
			$general = DF_Global_Options::$options; // get general options
			$global = $general['general']['global']; // get general -> global options
			self::$default_featured_img = $global['default_feature_image'];
			self::$default_featured_img_id = self::df_get_image_id( $global['default_feature_image'] );
		}

		/**
		 * df_get_image_id
		 * @param $image_url
		 */
		static function df_get_image_id( $image_url ) {
			if ( $image_url == "" || empty( $image_url ) ) return;
			global $wpdb;
			$attachment = $wpdb->get_col( $wpdb->prepare("SELECT IFNULL(ID,0)  FROM $wpdb->posts WHERE guid='%s';", esc_url( $image_url ) ) );
         	if (null == $attachment){
            	return $attachment;
         	}else{
        	    return $attachment[0]; 
            }
			return 1;
		}
		
		public function df_load_admin_js(){
			$current_page_slug = '';
			if (isset($_GET['page'])) {
				$current_page_slug = $_GET['page'];
			}
			foreach(DF_Global_Options::$js_files_admin as $file_id=>$file){
				if(!empty($file['only_slug']) and !in_array($current_page_slug,$file['only_slug'])){
					continue;
				}
				wp_enqueue_script( $file_id, get_template_directory_uri().$file['url']);
			}
		}

		public function df_load_admin_css(){
			$current_page_slug = '';
			if ( isset( $_GET['page'] ) ) {
				$current_page_slug = $_GET['page'];
			}
			foreach( DF_Global_Options::$css_files_admin as $file_id => $file ){
				if( !empty( $file['only_slug'] ) and !in_array( $current_page_slug, $file['only_slug'] ) ){
					continue;
				}
				wp_enqueue_style( $file_id, get_template_directory_uri().$file['url'] );
			}
		}
		
		public function df_load_js(){
			global $wp_query, $post;;
			$current_page_slug = '';
			if ( isset( $_GET['page'] ) ) {
				$current_page_slug = $_GET['page'];
			}
			foreach(DF_Global_Options::$js_files as $file_id => $file){
				if( !empty( $file['only_slug'] ) and !in_array( $current_page_slug,$file['only_slug'] ) ){
					continue;
				}
				wp_enqueue_script( $file_id, get_template_directory_uri() . $file['url'],  array('jquery', 'jquery-ui-tabs'), "1.0", TRUE );
				if( ($file_id == 'df-megamenu-js') || ($file_id == 'df-search-ajax-js') || ( $file_id == 'df-frontend-general-js' )  ){
					// wp_localize_script( $file_id, 'ajax_call', array( 'ajaxurl' => get_template_directory_uri() .'/inc/df-core/df-ajax-handler.php' ) );
					wp_localize_script( $file_id, 'ajax_call', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) )) ;
					
					// if( $file_id == 'df-search-ajax-js' ){
					// 	wp_localize_script( $file_id, 'df_site', array( 'site_url' => __( site_url() ) ) );
					// }

					if( $file_id == 'df-frontend-general-js' ){
						$global_options=DF_Global_Options::$options;
						$total = $wp_query->max_num_pages;
						$current_page = '';
						$format = '';
						if( $total > 1 )  {
							 if( !$current_page = get_query_var('paged') )
								 $current_page = 1;
							 if( get_option('permalink_structure') ) {
								 $format = '/page/';
							 } else {
								 $format = '&paged=';
							 }
						}
						$object_localize=array(
							'currentPage'	=> $current_page,
							'link'			=> rtrim(get_pagenum_link(), '/'),
							'totalPages'	=> $total,
							'format'		=> $format,
							// 'ajaxurl'		=> get_template_directory_uri() .'/inc/df-core/df-ajax-handler.php',
							'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
							'postID'		=> is_object($post) ? $post->ID : null
						);
						wp_localize_script( 
							$file_id, 
							'options', 
							array( 'animationTransition' 	=> $global_options['general']['page_transition'],
								   'is_lazy_loading' 		=> $global_options['general']['global']['is_lazy_loading'],
								   'isStickySidebar' 		=> $global_options['general']['global']['is_sticky_sidebar'],
								   'isBackToTopButton' 		=> $global_options['general']['global']['is_back_to_top_button'],
								   'pagination'				=> $object_localize,
								   'stickyLogo'				=> $global_options['logo']['sticky_header'],
								   'site_url'				=> site_url(),
								   'isMobile'				=> wp_is_mobile() ? 'yes' : 'no',
								   'isStickyHeader'			=> isset($global_options['header']['sticky_header']['is_sticky_header']) ? $global_options['header']['sticky_header']['is_sticky_header'] : 'no',
								   'isStickyShare'			=> isset($global_options['post_setting']['is_sticky_menu_article_sharing']) ? $global_options['post_setting']['is_sticky_menu_article_sharing'] : 'no',
								   'isFeatureImageLightbox'			=> isset($global_options['post_setting']['is_feature_image_lightbox']) ? $global_options['post_setting']['is_feature_image_lightbox'] : 'no',
								   'isEnableSideArea'		=> isset($global_options['side_area']['enable_side_area']) ? $global_options['side_area']['enable_side_area'] : 'no',
							 ) 
						);
					}
				}
			}	
		}

		public function df_load_css(){
			$current_page_slug = '';
			if( isset( $_GET['page'] ) ) {
				$current_page_slug = $_GET['page'];
			}
			foreach ( DF_Global_Options::$css_files as $file_id => $file ) {
				if( !empty( $file['only_slug'] ) && !in_array( $current_page_slug, $file['only_slug'] ) ){
					continue;
				}
				wp_enqueue_style( $file_id, get_template_directory_uri() . $file['url'] );
			}
		}

		private function get_all_options(){
			DF_Global_Options::$options = get_option( DF_THEME_OPTIONS_NAME );			
		}

		static function df_excerpt( $excerpt ){
		    $new_excerpt = str_replace( "<p", "<p class=\"small\"", $excerpt );
			return $new_excerpt;
		}
		
		function df_src_attribute( $html, $post_id, $post_image_id ) {
			$enable_lazy_load = DF_Global_Options::$options;
			$is_lazy_loading = $enable_lazy_load['general']['global']['is_lazy_loading'];
			if ( ! is_admin() && $is_lazy_loading == 'yes' ) {
				$html = preg_replace( '/src=/', 'data-original=', $html );
			    //$html = preg_replace( '/srcset=/', 'data-srcset=', $html );
			}
		  	return $html; 
		}
		
		function df_src_attribute_attr($attr) {

			$enable_lazy_load = DF_Global_Options::$options;
			$is_lazy_loading = $enable_lazy_load['general']['global']['is_lazy_loading'];
			if ( ! is_admin() && $is_lazy_loading == 'yes' ) {
				$attr['data-original'] = $attr['src'];
				$attr['class'] = $attr['class'].' lazy';
				$placeholder = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mPcPw0AAhoBV+G+kRgAAAAASUVORK5CYII=";
				$attr['src'] = $placeholder;
				$attr['data-srcset'] = $attr['data-original'];
				if ( isset( $attr['srcset'] ) ) {
					$attr['data-srcset'] = $attr['srcset'];
					unset(  $attr['srcset'] );
				}
			}
		  return $attr;
		}

		static function df_register_required_plugins() {
			$plugins = array(
				array(
					'name'               => 'Slider Revolution',
					'slug'               => 'revslider',
					'source'             => 'revslider.zip', 
					'required'           => true, 
					'version'            => '5.2.6', 
					'force_activation'   => false, 
					'force_deactivation' => false,
					'external_url'       => 'http://themepunch.com',
					'is_callable'        => '',
				),
				array(
					'name'               => 'Visual Composer',
					'slug'               => 'js_composer',
					'source'             => 'js_composer.zip', 
					'required'           => true, 
					'version'            => '4.12.1',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => 'http://wpbakery.com',
					'is_callable'        => '',
				),
				array(
					'name'               => 'Wordpress Popular Post',
					'slug'               => 'wordpress-popular-posts',
					'source'             => 'wordpress-popular-posts.3.3.4.zip', 
					'required'           => true, 
					'version'            => '3.3.4',
					'force_activation'   => true,
					'force_deactivation' => false,
					'external_url'       => 'https://github.com/cabrerahector/wordpress-popular-posts',
					'is_callable'        => '',
				),
				array(
					'name' 				 => 'Dahz Theme Extended Shortcode for Visual Composer',
					'slug' 				 => 'df-vc-extender',
					'source'			 => 'df-vc-extender.zip',
					'required'			 => true,
					'version'			 => '1.2',
					'force_activation'	 => true,
					'force_deactivation' => false,
					'external_url' 		 => 'http://daffyhazan.com/',
					'is_callable' 		 => '',
				),
				array(
					'name' 				 => 'AMP (Accelerated Mobile Pages)',
					'slug' 				 => 'amp',
					'source'			 => 'amp.zip',
					'required'			 => true,
					'version'			 => '0.4.2',
					'force_activation'	 => false,
					'force_deactivation' => false,
					'external_url' 		 => 'https://github.com/automattic/amp-wp',
					'is_callable' 		 => '',
				),
				array(
					'name' 				 => 'DF Social Media Oauth',
					'slug' 				 => 'df_social_media',
					'source'			 => 'df-social-media-oauth.zip',
					'required'			 => true,
					'version'			 => '0.2',
					'force_activation'	 => false,
					'force_deactivation' => false,
					'external_url' 		 => 'http://daffyhazan.com/',
					'is_callable' 		 => '',
				),
				array(
					'name' 				 => 'Wordpress Importer for One Click Demo Install',
					'slug' 				 => 'wordpress-importer-OCDI',
					'source'			 => 'wordpress-importer-OCDI.zip',
					'required'			 => true,
					'version'			 => '0.6.1',
					'force_activation'	 => false,
					'force_deactivation' => false,
					'external_url' 		 => 'https://wordpress.org/plugins/wordpress-importer/',
					'is_callable' 		 => '',
				),
			);
			$config = array(
				'domain'        => 'onfleek', // Text domain - likely want to be the same as your theme.
				'default_path' 	=> get_template_directory() . '/inc/plugins/', // Default absolute path to pre-packaged plugins
				'parent_slug' 	=> 'themes.php', // Default parent menu slug
				'menu' 			=> 'tgmpa-install-plugins', // Menu slug
				'has_notices' 	=> true, // Show admin notices or not
				'is_automatic' 	=> false, // Automatically activate plugins after installation or not
				'message' 		=> '', // Message to output right before the plugins table
				'strings' 		=> array(
					'page_title' 					  => esc_attr__( 'Install Required Plugins', 'onfleek' ),
					'menu_title' 					  => esc_attr__( 'Install Plugins', 'onfleek' ),
					'installing' 					  => esc_attr__( 'Installing Plugin: %s', 'onfleek' ), // %1$s = plugin name
					'oops' 							  => esc_attr__( 'Something went wrong with the plugin API.', 'onfleek' ),
					'notice_can_install_required' 	  => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'onfleek' ), // %1$s = plugin name(s)
					'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'onfleek' ), // %1$s = plugin name(s)
					'notice_cannot_install' 		  => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'onfleek' ), // %1$s = plugin name(s)
					'notice_can_activate_required' 	  => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'onfleek' ), // %1$s = plugin name(s)
					'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'onfleek' ), // %1$s = plugin name(s)
					'notice_cannot_activate' 		  => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'onfleek' ), // %1$s = plugin name(s)
					'notice_ask_to_update' 			  => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'onfleek' ), // %1$s = plugin name(s)
					'notice_cannot_update' 			  => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'onfleek' ), // %1$s = plugin name(s)
					'install_link' 					  => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'onfleek' ),
					'activate_link' 				  => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'onfleek' ),
					'return' 						  => esc_attr__( 'Return to Required Plugins Installer', 'onfleek' ),
					'plugin_activated' 				  => esc_attr__( 'Plugin activated successfully.', 'onfleek' ),
					'complete' 						  => esc_attr__( 'All plugins installed and activated successfully. %s', 'onfleek' ), // %1$s = dashboard link
					'nag_type' 						  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
				)
			);
			tgmpa( $plugins, $config );
		}

		/**
		 * Register sidebars
		 * Register all generated sidebars
		 * @hook widgets_init
		 * @return void 
		 */
		public function df_register_generated_sidebars() {
			$global_options=DF_Global_Options::$options;
			//$sidebars = get_option( DF_THEME_OPTIONS_NAME );
			//Make sure if we have valid sidebars
			if ( !empty( $global_options['sidebars']['additional'] ) && is_array( $global_options['sidebars']['additional'] ) ){
				$global_options = $global_options['sidebars'];
				//Register each sidebar
				foreach ($global_options['additional'] as $sidebar) {
					if( isset($sidebar) && !empty($sidebar) ){

						register_sidebar(
							array(
								'name'          => $sidebar['name'],
								'id'            => $sidebar['id'],
								'description'   => $sidebar['description'],
								'before_widget' => '<section id="%1$s" class="widget %2$s">',
								'after_widget'  => '</section>',
								'before_title'  => '<div class="df-widget-title">',
								'after_title'   => '</div>',
							)
						);

					}
				}
			}
		}

		/**
		 * df_is_mobile
		 * adapted from wp_is_mobile
		 */
		static function df_is_mobile() {
		    static $is_mobile;
		    if ( isset($is_mobile) )
		        return $is_mobile;

		    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
		        $is_mobile = false;
		    } elseif (
		        strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
		        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
		        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
		        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
		        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
		            $is_mobile = true;
		    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
		            $is_mobile = true;
		    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
		        $is_mobile = false;
		    } else {
		        $is_mobile = false;
		    }
		    return $is_mobile;
		}

		static function df_is_ipad(){
			static $is_ipad;
			if( isset( $is_ipad ) ){
				return $is_ipad;
			}

			if( empty($_SERVER['HTTP_USER_AGENT'] ) ){
				$is_ipad = false;
			}else if( strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad') !== false){
				$is_ipad = true;
			}
			return $is_ipad;
		}

		static function df_add_img_class($content){
		    $my_custom_class = "img-responsive";
		    $add_class = str_replace('<img class="', '<img class="'.$my_custom_class.' ', $content); 
		    return $add_class; // display class to image
		}
		
		static function _remove_script_version( $src ){
			$parts = explode( '?', $src );
			return $parts[0];
		}

		//defining the filter that will be used so we can select posts by 'author'
		static function df_post_author_filter(){
		    //execute only on the 'post' content type
		    global $post_type;
		    if($post_type == 'post'){

		        //get a listing of all users that are 'author' or above
		        $user_args = array(
		            'show_option_all'   => 'All Users',
		            'orderby'           => 'display_name',
		            'order'             => 'ASC',
		            'name'              => 'aurthor_admin_filter',
		            'who'               => 'authors',
		            'include_selected'  => true
		        );

		        //determine if we have selected a user to be filtered by already
		        if(isset($_GET['aurthor_admin_filter'])){
		            //set the selected value to the value of the author
		            $user_args['selected'] = (int)sanitize_text_field($_GET['aurthor_admin_filter']);
		        }

		        //display the users as a drop down
		        wp_dropdown_users($user_args);
		    }
		}

		function df_google_analytic(){
			echo DF_Header::df_get_google_analytic(); 
		}

		static function df_lightbox_detail() {
			$dv_post_url 			= $_POST['postURL'];
			$social_list 			= DF_Global_Options::$options['general']['social_sharing']['sharing_button'];
			ob_start();
			?>
				<div class="lightbox" style="display:none;">
					<div class="lightbox-detail" >
						<div class="df-lightbox-article-detail-wrapper">
							<div class="df-lightbox-article-title">
								
							</div>
							<div class="df-lightbox-article-description">
							</div>
							<div class="df-lightbox-article-share df-post-sharing mobile">
								<ul class="list-inline ">
								<?php 
									if ( $social_list['facebook'] == 'yes') {
								?>
									<li class="df-social-sharing-buttons df-lightbox-sharing popup">
										<a onclick="return false" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr( $dv_post_url ) ?>">
											<i class="fa fa-facebook"></i>
											<div class="df-social-butt-text">Facebook</div>
										</a>
									</li>
								<?php 
									}
									if ( $social_list['twitter'] == 'yes') {
								?>	
								 	<li class="df-social-sharing-buttons df-lightbox-sharing popup">
										<a href="https://twitter.com/intent/tweet?url=<?php echo esc_attr( $dv_post_url ) ?>">
											<i class="fa fa-twitter"></i>
											<div class="df-social-butt-text">Twitter</div>
										</a>
									</li>
								<?php 
									}
									if ( $social_list['pinterest'] == 'yes') {
								?>	
								 	<li class="df-social-sharing-buttons df-lightbox-sharing popup">
										<a href="https://id.pinterest.com/pin/create/button/?url=<?php echo esc_attr( $dv_post_url ) ?>">
											<i class="fa fa-pinterest-p"></i>
											<div class="df-social-butt-text">Pinterest</div>
										</a>
									</li>
								<?php } 
									if ( $social_list['google-plus'] == 'yes') {
								?>	
								 	<li class="df-social-sharing-buttons df-lightbox-sharing popup">
										<a href="https://plus.google.com/share?url=<?php echo esc_attr( $dv_post_url ) ?>">
											<i class="fa fa-google-plus"></i>
											<div class="df-social-butt-text">Google +</div>
										</a>
									</li>
								<?php } 
									if ( $social_list['linkedin'] == 'yes') {
								?>	
								 	<li class="df-social-sharing-buttons df-lightbox-sharing popup">
										<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_attr( $dv_post_url ) ?>">
											<i class="fa fa-linkedin"></i>
											<div class="df-social-butt-text">Linkedin</div>
										</a>
									</li>
								<?php } 
									if ( $social_list['mail'] == 'yes') {
								?>	
								 	<li class="df-social-sharing-buttons df-lightbox-sharing popup">
										<a href="mailto:?Subject=&Body=I saw this and thought of you!  <?php echo esc_attr( $dv_post_url ) ?> ">
											<i class="fa fa-envelope"></i>
											<div class="df-social-butt-text">Mail</div>
										</a>
									</li>
								<?php } ?>
									
								</ul>
							</div>
							<div class="df-lightbox-ads">
								<?php 
									$ads = DF_Header::df_ads_header_3();
									if ( NULL != $ads['lightbox_advertisment_googlecode'] ) {
										echo stripslashes_deep ( $ads['lightbox_advertisment_googlecode'] ) ; 
									} else {
								?>
									<a href="<?php echo esc_url( $ads['lightbox_advertisment_url'] ); ?>"><img src="<?php echo esc_url( $ads['lightbox_advertisment_img'] );?>" alt="<?php echo esc_attr( $ads['lightbox_advertisment_alt'] ); ?>" class="img-responsive center-block"></a>
								<?php
									}
								?> 
							</div>
						</div>
					</div>
				</div>
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			echo $out;
			die();
		}
		static function df_remove_hentry( $classes ) {
			$classes = array_diff( $classes, array( 'hentry' ) );

			return $classes;
		}

	}
}
new DF_Framework();

do_action('df_option_initialize');
do_action( 'df_set_global_variable' );
do_action( 'df_image_size' );