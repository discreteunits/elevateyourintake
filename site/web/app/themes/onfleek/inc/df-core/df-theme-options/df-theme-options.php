<?php

require get_template_directory() .'/inc/df-core/df-theme-options/df-options-source.php';

require get_template_directory() .'/inc/df-core/df-theme-options/df-element-generator.php';

if(!class_exists("DF_Theme_Options")){
	
	Class DF_Theme_Options{
		
		static $sidebar_list=array();
		
		static $css_border_style = array(
										array(
											'value' => 'dotted',
											'text' => 'dotted'
										),
										array(
											'value' => 'dashed',
											'text' => 'dashed'
										),
										array(
											'value' => 'solid',
											'text' => 'solid'
										),
										array(
											'value' => 'double',
											'text' => 'double'
										),
										array(
											'value' => 'groove',
											'text' => 'groove'
										),
										array(
											'value' => 'inset',
											'text' => 'inset'
										),
										array(
											'value' => 'outset',
											'text' => 'outset'
										),
										array(
											'value' => 'none',
											'text' => 'none'
										),
										array(
											'value' => 'hidden',
											'text' => 'hidden'
										),
										array(
											'value' => 'ridge',
											'text' => 'ridge'
										)
									);
		static $css_background_position = array(
												array(
													'value' => 'left-top',
													'text' => 'Left Top'
												),
												array(
													'value' => 'left-center',
													'text' => 'Left Center'
												),
												array(
													'value' => 'left-bottom',
													'text' => 'Left Bottom'
												),
												array(
													'value' => 'right-top',
													'text' => 'Right Top'
												),
												array(
													'value' => 'right-center',
													'text' => 'Right Center'
												),
												array(
													'value' => 'right-bottom',
													'text' => 'Right Bottom'
												),
												array(
													'value' => 'center-top',
													'text' => 'Center Top'
												),
												array(
													'value' => 'center-center',
													'text' => 'Left Center'
												),
												array(
													'value' => 'center-bottom',
													'text' => 'Center Bottom'
												)
											);
		static $css_background_repeat = array(
												array(
													'value' => 'repeat',
													'text' => 'Repeat'
												),
												array(
													'value' => 'repeat-x',
													'text' => 'Repeat X'
												),
												array(
													'value' => 'repeat-y',
													'text' => 'Repeat Y'
												),
												array(
													'value' => 'no-repeat',
													'text' => 'No Repeat'
												),
											);
		static $css_background_attachment = array(
													array(
														'value' => 'scroll',
														'text' => 'Scroll'
													),
													array(
														'value' => 'fixed',
														'text' => 'Fixed'
													),
												);
		static $css_background_size = array(
											array(
												'value' => 'auto',
												'text' => 'Auto'
											),
											array(
												'value' => 'length',
												'text' => 'Length'
											),
											array(
												'value' => 'percentage',
												'text' => 'Percentage'
											),
											array(
												'value' => 'cover',
												'text' => 'Cover'
											),
											array(
												'value' => 'contain',
												'text' => 'Contain'
											),
											array(
												'value' => 'initial',
												'text' => 'initial'
											),
											array(
												'value' => 'inherit',
												'text' => 'Inherit'
											)
										);
		static $header_style = array(
									array(
										'value' => 'inherit',
										'text' => 'Inherit / Default'
									),
									array(
										'value' => 'header-1',
										'text' => 'Header 1'
									),
									array(
										'value' => 'header-2',
										'text' => 'Header 2'
									),
									array(
										'value' => 'header-3',
										'text' => 'Header 3'
									),
									array(
										'value' => 'header-4',
										'text' => 'Header 4'
									),
									array(
										'value' => 'header-5-light',
										'text' => 'Header 5 Light'
									),
									array(
										'value' => 'header-5-dark',
										'text' => 'Header 5 Dark'
									),
									array(
										'value' => 'header-6-light',
										'text' => 'Header 6 Light'
									),
									array(
										'value' => 'header-6-dark',
										'text' => 'Header 6 Dark'
									)
								);
		static $global_header_style = array(
									array(
										'value' => 'header-1',
										'text' => 'Header 1'
									),
									array(
										'value' => 'header-2',
										'text' => 'Header 2'
									),
									array(
										'value' => 'header-3',
										'text' => 'Header 3'
									),
									array(
										'value' => 'header-4',
										'text' => 'Header 4'
									),
									array(
										'value' => 'header-5-light',
										'text' => 'Header 5 Light'
									),
									array(
										'value' => 'header-5-dark',
										'text' => 'Header 5 Dark'
									),
									array(
										'value' => 'header-6-light',
										'text' => 'Header 6 Light'
									),
									array(
										'value' => 'header-6-dark',
										'text' => 'Header 6 Dark'
									)
								);
		
		function __construct(){
			$this->df_init_oauth();
			add_action( 'admin_menu', array( $this,'df_register_theme_options' ) ); 
			add_action( 'wp_ajax_nopriv_df_get_options', array( $this, 'df_load_extended_view' ) );
			add_action( 'wp_ajax_df_load_extended_view', array( $this, 'df_load_extended_view' ) );
			add_action( 'wp_ajax_nopriv_df_load_box', array( $this, 'df_load_box' ) );
			add_action( 'wp_ajax_df_load_box', array( $this, 'df_load_box' ) );
			add_action( 'wp_ajax_nopriv_df_reset_section', array( $this, 'df_reset_section' ) );
			add_action( 'wp_ajax_df_reset_section', array( $this, 'df_reset_section' ) );
			add_action('admin_enqueue_scripts', array( $this,'df_theme_options_script' ) );
			add_action('admin_menu', array( $this,'df_active_theme' ) );
			add_action( 'wp_ajax_df_install_demo', array( $this, 'df_install_demo') );
			
		}

		public function df_register_theme_options(){
                add_theme_page( 'Theme Options', 'Theme Options', "manage_options", "df_theme_options", array( $this, "df_view_theme_options" ), null, 2 );
               	if( is_plugin_active('wordpress-importer-OCDI/wordpress-importer.php') ){
					add_theme_page( 'Demo Install', 'Demo Install', "manage_options", "df_theme_demo_install", array( $this, "df_view_theme_options_one_click_demo_instal" ), null,2 );
				}
				// add_theme_page( 'Demo Install', 'Demo Install', "manage_options", "df_theme_demo_install", array( $this, "df_view_theme_options_one_click_demo_instal" ), null,2 );
				add_theme_page( 'Theme Support', 'Theme Support', "manage_options", "df_theme_support", array( $this, "df_view_theme_support" ), null, 2 );

		}
		
		public function df_init_oauth() {
			$options=DF_Global_Options::$options;
			if ( isset( $_GET['code'] ) ) {
				
					$facebook_code = $_GET['code'];
					$options['social_account']['oauth']['facebook']['facebook_code'] = $facebook_code;
					update_option( DF_THEME_OPTIONS_NAME, $options );
				}
			if ( isset( $_GET['access_token'] ) ){
					$instagram_code = $_GET['access_token'];
					$options['social_account']['oauth']['instagram']['access_token'] = $instagram_code;
					update_option( DF_THEME_OPTIONS_NAME, $options );
				}

		}

		
		
		public function df_load_extended_view($view=null){
			if($view==null){
				$extended_view=$_POST['data'];
				$extended_view=DF_Global_Options::$menu_list['option_list']['options'][$extended_view]['view'];
				$view= require $extended_view ;
			}
			die();
			
		}
		
		public function df_active_theme(){
        if (is_admin() && isset($_GET['activated'])){
                wp_redirect(admin_url("admin.php?page=df_theme_support"));
            }

        }
		
		public function df_reset_section(){
			$data=$_POST['data'];
			$options=array();
			if( $data !== 'all' ){
				$data_section_hierarchy=DF_Global_Options::$menu_list['option_list']['options'][$data]['section_hierarchy'];
				$data_section=array();
				$options= DF_Global_Options::$options;
				$default_options = DF_Options_Source::df_filesystem_default_option_read();
				$default_options_decode=stripslashes($default_options);
				$default_options=json_decode($default_options_decode,true);
				if(is_array($data_section_hierarchy)){
					$data_section=$default_options[$data_section_hierarchy[0]][$data_section_hierarchy[1]];
					$options[$data_section_hierarchy[0]][$data_section_hierarchy[1]]=$data_section;
				} else {
					$data_section=$default_options[$data_section_hierarchy];
					$options[$data_section_hierarchy]=$data_section;
				}
				
				update_option( DF_THEME_OPTIONS_NAME, $options );
				DF_Global_Options::$options = get_option( DF_THEME_OPTIONS_NAME );
				$view=require DF_Global_Options::$menu_list['option_list']['options'][$data]['view'];
			} else {
				$default_options = DF_Options_Source::df_filesystem_default_option_read();
				$default_options_decode=stripslashes($default_options);
				$default_options=json_decode($default_options_decode,true);
				update_option( DF_THEME_OPTIONS_NAME, $default_options );
				DF_Global_Options::$options = get_option( DF_THEME_OPTIONS_NAME );
			}
			die();
		}
		public function df_load_box(){
			$extended_view = $_POST['data'];
			$view = require get_template_directory().'/inc/df-core/views/admin/df-theme-options/box-ajax/'.$extended_view['view'].'.php' ;
			die();
			
		}
		
		public function df_view_theme_options(){
			
			require get_template_directory()."/inc/df-core/views/admin/df-theme-options/df-theme-options.php";
			
		}
		
		public function view_df_theme_options_home(){
			
			require get_template_directory()."/inc/df-core/views/admin/df-theme-options/df-theme-home.php";
			
		}
		
		public function df_view_theme_options_one_click_demo_instal(){
			
			require get_template_directory()."/inc/df-core/views/admin/df-theme-options/df-theme-one-click-demo-instal.php";
			
		}
		
		public function df_view_theme_support(){
				if ( !current_user_can( 'manage_options' ) )  {
		          wp_die( __( 'You do not have sufficient permissions to access this page.' , 'onfleek') );
                }
			     require get_template_directory()."/inc/df-core/views/admin/df-theme-options/df-theme-support.php";
			
		}
		

		
		
		function df_theme_options_script(){
			wp_register_script( 'wp-df-theme-options-script', get_template_directory_uri().'/inc/df-core/asset/js/admin/df-theme-options.js');
			
			$localize_array = array(
				'templateUrl' => get_template_directory_uri()
			);
			
			wp_localize_script( 'wp-df-theme-options-script', 'dfThemeOptionObj', $localize_array );
			wp_enqueue_script( 'wp-df-theme-options-script' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_media();
			wp_enqueue_script( 'media-lib-uploader-js' );
			wp_enqueue_style( 'wp-df-df-theme-options-style', get_template_directory_uri().'/inc/df-core/asset/css/admin/df-theme-options-style.css' );
			wp_enqueue_style( 'wp-df-df-theme-options-select2', get_template_directory_uri().'/inc/df-core/asset/css/admin/select2.css' );
			wp_enqueue_style( 'wp-df-df-theme-options-fa', get_template_directory_uri().'/inc/df-core/asset/css/admin/font-awesome.css' );
		}
//Sidebars Start Here//
		
		/**
		 * All generated sidebars
		 *
		 * Get all generated sidebars.
		 *
		 * @return array
		 */
		static function df_all_generated_sidebars(){
			$all = get_option( DF_THEME_OPTIONS_NAME );
			//$all = $all['sidebars'];
			if( !empty( $all['sidebars']['additional'] ) ){
				return $all['sidebars']['additional'];
			}
			else{
				return array();
			}
		}

		//------------------------------------//--------------------------------------//
		
		
		//End Here//
		public function df_get_sidebar(){
			
			$sidebars = $GLOBALS['wp_registered_sidebars'];
			$sidebar_list=array();
			foreach($sidebars as $sidebar=> $value) { 
				array_push($sidebar_list,array('value'=>$value['id'],'text'=>$value['name']));
			}
			return $sidebar_list;
		}
		/** One Click Demo Install**/
		public function df_install_demo () {

			//global $wp_filesystem;
			if ( current_user_can( 'manage_options' ) ) {

				if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); // load importer

				if ( ! class_exists( 'WP_Importer' ) ) { // cek if main importer class doesn't exist
					$wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
					include $wp_importer;
				}

				if ( ! class_exists('WP_Import') ) { // cek if WP importer plugins doesn't exist
					$wp_import =  ABSPATH . 'wp-content/plugins/wordpress-importer-OCDI/wordpress-importer.php';
					include $wp_import;
				}

				// echo "WP Importer ada: " . class_exists( 'WP_Importer' ) . " || wp iport ada : " . class_exists( 'WP_Import' );
				// 	exit;
				if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { // check for main import class and wp import class
					if( ! isset($_POST['demo_name']) || trim($_POST['demo_name']) == '' ) {
						$demo_name = 'default';
					} else {
						$demo_name = $_POST['demo_name'];
					}

					$process = $_POST['process'];
					$section = $_POST['section'];
					if ( class_exists( 'DF_Social_Media') ) {
						DF_Social_Media::df_disable_auto_publish();	
					}
					
					switch( $process ) {
						case 'install_xml' :
							$importer = new WP_Import();
							if ( $section == 'media' ) {
								$data_file		= get_template_directory() . '/inc/df-core/asset/demo/xml/' . $demo_name .'.xml.gz';
								//Import Data Demo
								$importer->fetch_attachments = true;
								ob_start();
								$importer->import( $data_file );
								ob_end_clean();
								flush_rewrite_rules();

								echo "successful";		
							exit;
							}

							if ( $section == 'media_02' ) {
								$data_file		= get_template_directory() . '/inc/df-core/asset/demo/xml/' . $demo_name .'_02.xml.gz';
								//Import Data Demo
								$importer->fetch_attachments = true;
								ob_start();
								$importer->import( $data_file );
								ob_end_clean();
								flush_rewrite_rules();
								echo "successful";		
							exit;
							}
							if ( $section == 'media_03' ) {
								$data_file		= get_template_directory() . '/inc/df-core/asset/demo/xml/' . $demo_name .'_03.xml.gz';
								//Import Data Demo
								$importer->fetch_attachments = true;
								ob_start();
								$importer->import( $data_file );
								ob_end_clean();
								flush_rewrite_rules();
								echo "successful";		
							exit;
							}
							if ( $section == 'media_04' ) {
								$data_file		= get_template_directory() . '/inc/df-core/asset/demo/xml/' . $demo_name .'_04.xml.gz';
								//Import Data Demo
								$importer->fetch_attachments = true;
								ob_start();
								$importer->import( $data_file );
								ob_end_clean();
								flush_rewrite_rules();
								echo "successful";		
							exit;
							}
							if ( $section == 'media_05' ) {
								$data_file		= get_template_directory() . '/inc/df-core/asset/demo/xml/' . $demo_name .'_05.xml.gz';
								//Import Data Demo
								$importer->fetch_attachments = true;
								ob_start();
								$importer->import( $data_file );
								ob_end_clean();
								flush_rewrite_rules();
								echo "successful";		
							exit;
							}
							if ( $section == 'pages' ) {
								$data_file		= get_template_directory() . '/inc/df-core/asset/demo/xml/' . $demo_name .'-pages.xml.gz';
								//Import Data Demo
								$importer->fetch_attachments = true;
								ob_start();
								$importer->import( $data_file );
								ob_end_clean();
								flush_rewrite_rules();
								echo "successful";		
							exit;
							}
							
							if ( $section == 'post' ) {
								$data_file		= get_template_directory() . '/inc/df-core/asset/demo/xml/' . $demo_name .'-post.xml.gz';
								//Import Data Demo
								$importer->fetch_attachments = true;
								ob_start();
								$importer->import( $data_file );
								ob_end_clean();
								flush_rewrite_rules();
								echo "successful";		
							exit;
							}
							
							if ( $section == 'menu' ) {
								sleep(5);
								$data_file		= get_template_directory() . '/inc/df-core/asset/demo/xml/' . $demo_name .'-menu.xml.gz';
								//Import Data Demo
								$importer->fetch_attachments = true;
								ob_start();
								$importer->import( $data_file );
								ob_end_clean();
								flush_rewrite_rules();	
								echo "successful";		
							exit;
							}
							

							echo "successful";		
							exit;
						break;
						case 'install_theme_options' :

							$options_file 	= get_template_directory_uri() . '/inc/df-core/asset/demo/theme-options/' . $demo_name .'.json';
							$encode_options = wp_remote_fopen( $options_file );
							$options_array = json_decode( $encode_options,true);
							update_option( DF_THEME_OPTIONS_NAME, $options_array);
							echo "successful";		
							exit;
						break;
						case 'install_widgets' :
							$widgets_file 	= get_template_directory_uri() . '/inc/df-core//asset/demo/widget/' . $demo_name .'.wie';
							// Import Widgets
							if( isset( $widgets_file ) && $widgets_file ) {
								$widgets_json = $widgets_file; // widgets data file
								$widgets_json = wp_remote_fopen( $widgets_json );
								$widget_data = json_decode( $widgets_json );
								//thanks to Steven Gliebe for this widget importer 
								//adapt from wordpress import export plugin visit http://wordpress.org/plugins/widget-importer-exporter
								$import_widgets = self::df_import_widget_data( $widget_data ); 
							}

							echo "successful";		
							exit;	
						break;
						default :
							echo "successful";		
							exit;	

					}	
					
				}
			}
		}
		static function df_import_media ( $media_id, $file, $post_id = '', $desc = null ) {

			// require ABSPATH . 'wp-admin/includes/media.php';
			// require ABSPATH . 'wp-admin/includes/file.php';
			// require ABSPATH . 'wp-admin/includes/image.php';


			// Set variables for storage, fix file filename for query strings.
			preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
			$file_array = array();
			$file_array['name'] = basename( $matches[0] );

			// Download file to temp location.
			$file_array['tmp_name'] = download_url( $file );

			// If error storing temporarily, return the error.
			if ( is_wp_error( $file_array['tmp_name'] ) ) {
			    @unlink($file_array['tmp_name']);
			    echo 'is_wp_error $file_array: ' . $file;
			    print_r($file_array['tmp_name']);
			    return $file_array['tmp_name'];
			}

			// Do the validation and storage stuff.
			$id = media_handle_sideload( $file_array, $post_id, $desc ); //$id of attachement or wp_error

			// If error storing permanently, unlink.
			if ( is_wp_error( $id ) ) {
			    @unlink( $file_array['tmp_name'] );
			    echo 'is_wp_error $id: ' . $id->get_error_messages() . ' ' . $file;
			    return $id;
			}
			update_post_meta($id, 'demo_content', $media_id);

			return $id;

		}
		static function df_import_widget_data( $data ) {

			global $wp_registered_sidebars;

			// Have valid data?
			// If no data or could not decode
			if ( empty( $data ) || ! is_object( $data ) ) {
				wp_die(
					__( 'Import data could not be read. Please try a different file.', 'onfleek' ),
					'',
					array( 'back_link' => true )
				);
			}

			// Hook before import
			do_action( 'df_before_import' );
			$data = apply_filters( 'df_import_widget_data', $data );

			// Get all available widgets site supports
			$available_widgets = self::df_get_available_widgets();

			// Get all existing widget instances
			$widget_instances = array();
			foreach ( $available_widgets as $widget_data ) {
				$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
			}

			// Begin results
			$results = array();

			// Loop import data's sidebars
			foreach ( $data as $sidebar_id => $widgets ) {

				// Skip inactive widgets
				// (should not be in export file)
				if ( 'wp_inactive_widgets' == $sidebar_id ) {
					continue;
				}

				// Check if sidebar is available on this site
				// Otherwise add widgets to inactive, and say so
				if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
					//$sidebar_available = true;
					$use_sidebar_id = $sidebar_id;
					//$sidebar_message_type = 'success';
					//$sidebar_message = '';
				} else {
					//$sidebar_available = false;
					$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
					//$sidebar_message_type = 'error';
					//$sidebar_message = __( 'Sidebar does not exist in theme (using Inactive)', 'widget-importer-exporter' );
				}

				// Loop widgets
				foreach ( $widgets as $widget_instance_id => $widget ) {

					$fail = false;

					// Get id_base (remove -# from end) and instance ID number
					$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
					$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

					// Does site support this widget?
					if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
						$fail = true;
						$widget_message_type = 'error';
						$widget_message = __( 'Site does not support widget', 'onfleek' ); // explain why widget not imported
					}

					// Filter to modify settings object before conversion to array and import
					// Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
					// Ideally the newer wie_widget_settings_array below will be used instead of this
					$widget = apply_filters( 'df_widget_settings', $widget ); // object

					// Convert multidimensional objects to multidimensional arrays
					// Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
					// Without this, they are imported as objects and cause fatal error on Widgets page
					// If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
					// It is probably much more likely that arrays are used than objects, however
					$widget = json_decode( json_encode( $widget ), true );

					// Filter to modify settings array
					// This is preferred over the older wie_widget_settings filter above
					// Do before identical check because changes may make it identical to end result (such as URL replacements)
					$widget = apply_filters( 'df_widget_settings_array', $widget );

					// Does widget with identical settings already exist in same sidebar?
					if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

						// Get existing widgets in this sidebar
						$sidebars_widgets = get_option( 'sidebars_widgets' );
						$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

						// Loop widgets with ID base
						$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
						foreach ( $single_widget_instances as $check_id => $check_widget ) {

							// Is widget in same sidebar and has identical settings?
							if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

								$fail = true;
								$widget_message_type = 'warning';
								$widget_message = __( 'Widget already exists', 'onfleek' ); // explain why widget not imported

								break;

							}

						}

					}

					// No failure
					if ( ! $fail ) {

						// Add widget instance
						$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
						$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
						$single_widget_instances[] = $widget; // add it

							// Get the key it was given
							end( $single_widget_instances );
							$new_instance_id_number = key( $single_widget_instances );

							// If key is 0, make it 1
							// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
							if ( '0' === strval( $new_instance_id_number ) ) {
								$new_instance_id_number = 1;
								$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
								unset( $single_widget_instances[0] );
							}

							// Move _multiwidget to end of array for uniformity
							if ( isset( $single_widget_instances['_multiwidget'] ) ) {
								$multiwidget = $single_widget_instances['_multiwidget'];
								unset( $single_widget_instances['_multiwidget'] );
								$single_widget_instances['_multiwidget'] = $multiwidget;
							}

							// Update option with new widget
							update_option( 'widget_' . $id_base, $single_widget_instances );

						// Assign widget instance to sidebar
						$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
						$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
						$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
						update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

						// After widget import action
						$after_widget_import = array(
							'sidebar'           => $use_sidebar_id,
							'sidebar_old'       => $sidebar_id,
							'widget'            => $widget,
							'widget_type'       => $id_base,
							'widget_id'         => $new_instance_id,
							'widget_id_old'     => $widget_instance_id,
							'widget_id_num'     => $new_instance_id_number,
							'widget_id_num_old' => $instance_id_number
						);
						do_action( 'df_after_widget_import', $after_widget_import );

					}

				}

			}

			// Hook after import
			do_action( 'df_after_import' );

		}

		static function df_get_available_widgets() {

			global $wp_registered_widget_controls;

			$widget_controls = $wp_registered_widget_controls;

			$available_widgets = array();

			foreach ( $widget_controls as $widget ) {

				if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

					$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
					$available_widgets[$widget['id_base']]['name'] = $widget['name'];

				}

			}

			return apply_filters( 'get_available_widgets', $available_widgets );

		}

		//** End One Click Demo Install ** //



	}
}
new DF_Theme_Options();
?>
