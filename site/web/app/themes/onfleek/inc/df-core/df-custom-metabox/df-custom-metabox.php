<?php
if(!class_exists("DF_custom_metabox")){
	
	Class DF_custom_metabox{
		
		function __construct(){
			if ( file_exists( get_template_directory() . '/inc/df-core/plugins/cmb2/init.php' ) ) {
			require_once get_template_directory() . '/inc/df-core/plugins/cmb2/init.php';
			} elseif ( file_exists( get_template_directory() . '/inc/df-core/plugins/CMB2/init.php' ) ) {
				require_once get_template_directory() . '/inc/df-core/plugins/CMB2/init.php';
			}
			require get_template_directory() . '/inc/df-core/views/admin/df-custom-metabox/df-init-cmb2-type.php';

				add_action( 'cmb2_admin_init', array($this,'df_magz_post_metabox') );

				add_action( 'cmb2_admin_init', array($this,'df_magz_page_metabox') );



		}
		

		// function df_set_field_class( $args, $field ) {
		//     $field->args['attributes']['class'] ='df_bla_bla';
		// }

		function df_magz_post_metabox() { 
			
			$prefix = 'df_magz_post';

			/**
			 * Metabox for an options page. Will not be added automatically, but needs to be called with
			 * the `cmb2_metabox_form` helper function. See wiki for more info.
			 */

			$cmb_post = new_cmb2_box( array(
				'id'            => $prefix,
				'title'         => __( 'Dahz Setting', 'onfleek' ),
				'object_types'  => array( 'post',  ), // Post type
				'show_names' => false, 
				'priority'     => 'core',		// 'show_names' => true, // Show field names on the left
				'cmb_styles' => true, // false to disable the CMB stylesheet

			) );

			/* General Layout*/	
			$cmb_post->add_field( array(
				'name'         => 'Post Layout',
				'id'           => $prefix . '_post_layout',
				'desc'         => __('Choose a different layout for this particular post', 'onfleek'),
				'type'			=> 'df_post_layout',
				'section' => 'general',
				'show_option_none' => '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/default.png"></span>', 
				'options'          => array(
						//'default'  	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/default.png"></span>',
						'layout-1' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/post-style-1.png"></span>',
						'layout-2' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/post-style-2.png"></span>',
						'layout-3' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/post-style-3.png"></span>',
						'layout-4' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/post-style-4.png"></span>',
						'layout-5' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/post-style-5.png"></span>',
						'layout-6' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/post-style-6.png"></span>',
						'layout-7' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/post-style-7.png"></span>',
						'layout-8' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/post-style-8.png"></span>',
						'layout-9' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/post-style-9.png"></span>',
				),

				'before_row'   	=> 'cmb2_before_row_render_section', 
				
			) );

			$cmb_post->add_field( array(
				'name'             => 'Featured Image',
				'desc'             => __( 'Enable/Disable Featured Image for this Post', 'onfleek' ),
				'id'               => $prefix . '_featured_image',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'default' => __( 'Default', 'onfleek' ),
					'enable' => __( 'Enable', 'onfleek' ),
					'disable'   => __( 'Disable', 'onfleek' ),
				),
			) );
			
			$output_categories = array();
			$categories=get_categories();
			$output_categories[''] = 'Auto';
				foreach($categories as $category) { 
 					$output_categories[$category->cat_ID] = $category->name;
				}

			$cmb_post->add_field( array(
				'name'             => 'Primary category',
				'desc'             => __( 'Choose the Main Category for this Post.', 'onfleek' ),
				'id'               => $prefix . '_primary_category',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => $output_categories, 
			) );

			$cmb_post->add_field( array(
				'name'             => 'Layout',
				'desc'             => __( 'Choose Sidebar Layout for this Particular Post', 'onfleek' ),
				'id'               => $prefix . '_layout',
				'type'             => 'df_post_layout',
				'show_option_none' => '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/default.png"></span>',
				'options'          => array(
				        //'default' 		=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/default.png"></span>',
				        'sidebar-left'	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/sidebar-left.png"></span>',
				        'fullwidth' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/full.png"></span>',
				        'sidebar-right' => '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/sidebar-right.png"></span>',
				),
			) );
			$output_sidebars	= array();
			$sidebars 			= $GLOBALS['wp_registered_sidebars'];
				$output_sidebars['default'] = 'Default';
				foreach($sidebars as $sidebar=> $value) { 
 					$output_sidebars[$value['id']] = $value['name'];
				}

			//print_r($GLOBALS['wp_registered_sidebars']);
			//register_sidebars(array('name'=>'Foobar %d', 'id'=>'foobar'));
			$cmb_post->add_field( array(
				'name'             => 'Custom Sidebar',
				'desc'             => __('Choose Custom Sidebar for this post', 'onfleek'),
				'id'               => $prefix . '_custom_sidebar',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => $output_sidebars,
				
			) );

			$cmb_post->add_field( array(
				'name'    => 'Subtitle',
				'desc'    => __('Add a Subtitle for this post', 'onfleek'),
				'id'      => $prefix . '_subtitle',
				'type'    => 'df_wysiwyg',
				'options' => array( 'textarea_rows' => 5, ),
				'after_row'   	=> 'cmb2_after_row_render_section',
			) );


			/* End of General Layout*/

			/* Smart List*/	
			$cmb_post->add_field( array(
				'name'		=> 'List Layout',
				'id'		=> $prefix . '_smart_list',
				'desc'		=> __('Choose the layout for list', 'onfleek'),
				'type'		=> 'df_post_layout',
				'section' 	=> 'smartlist', 
				'show_option_none' => '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/listicle-no.png"></span>',
				'options'	=> array(
						//'no-smart-list' => '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/listicle-no.png"></span>',
						'smart-list-1' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/listicle-1.png"></span>',
						'smart-list-2' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/listicle-2.png"></span>',
						'smart-list-3' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/listicle-3.png"></span>',
						'smart-list-4' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/listicle-4.png"></span>',
						
				),
				'before_row'   	=> 'cmb2_before_row_render_section', 
				
			) );

			$cmb_post->add_field( array(
				'name'             => 'Show Number',
				'desc'             => __( 'Show number for this Listicle', 'onfleek' ),
				'id'               => $prefix . '_show_number',
				'type'             => 'df_select_box',
				'options'          => array(
					'enable' => __( 'Enable', 'onfleek' ),
					'disable'   => __( 'Disable', 'onfleek' ),
				),
			) );

			$group_field_id = $cmb_post->add_field( array(
					'id'          => $prefix . '_listicle',
					'type'        => 'group',
					'section' 	=> 'smartlist', 
					'description' => __( 'Add New List Item', 'onfleek' ),
					'options'     => array(
						'group_title'   => __( 'Listicle {#}', 'onfleek' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add Another List Item', 'onfleek' ),
						'sortable'      => false, // beta
						 'closed'     => true, // true to have the groups closed by default
					'after_row'   	=> 'cmb2_after_row_render_section',
					),
				) );
			$cmb_post->add_group_field( $group_field_id, array(
					'name'       => __( 'Title', 'onfleek' ),
					'id'         => $prefix . '_listicle_title',
					'type'       => 'text',
					// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
				) );
			$cmb_post->add_group_field( $group_field_id, array(
				'name' => __( 'Entry Image', 'onfleek' ),
				'id'   => $prefix . '_listicle_image',
				'type' => 'file',
			) );
			$cmb_post->add_group_field( $group_field_id, array(
				'name'        => __( 'Description', 'onfleek' ),
				'description' => __( 'Write a short description for this entry', 'onfleek' ),
				'id'          => $prefix . '_listicle_description',
				'escape_cb' => false,
				'sanitization_cb' => false,
				'type'        => 'wysiwyg',
				
			) );
			$cmb_post->add_field( array(
				'name'             => 'Ordering',
				'desc'             => __('Change the ordering of your list items', 'onfleek'),
				'id'               => $prefix . '_ordering',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'asc' => 'Ascending',
					'dsc'   => 'Descending',
				),
				'after_row'   	=> 'cmb2_after_row_render_section', // callback
			) );
			/* End Of Smart List*/

			/* Media Embed*/
			$cmb_post->add_field( array(
				'name'         	=> 'Media URL',
				'id'			=> $prefix . '_media_embed',
				'desc'			=> __('Enter Youtube, Twitter, or Instagram URL. What Sites Can I Embed From? <a href="http://codex.wordpress.org/Embeds">Here</a>', 'onfleek'),
				'type'			=> 'df_oembed',
				'section' 		=> 'mediaembed', 
				'before_row'   	=> 'cmb2_before_row_render_section', 
				'after_row'   	=> 'cmb2_after_row_render_section', // callback
			) );
			/* End of Media Embed*/

			/* Galery*/
			$cmb_post->add_field( array(
				'name'         => 'Gallery' , 
				'desc'         =>  __('Create gallery by uploading new images or use existing ones', 'onfleek'), 
				'id'           => $prefix . '_gallery',
				'type'         => 'df_file_list',
				'section' 		=> 'gallery', 
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
				'before_row'   	=> 'cmb2_before_row_render_section', 
				'after_row'   	=> 'cmb2_after_row_render_section', // callback
			) );

			/* End of Galery*/

			/* Review */
			$cmb_post->add_field( array(
				'name'             => 'Review System',
				'desc'             => __('Choose from Stars, Percentages or Points for review scores', 'onfleek'),
				'id'               => $prefix . '_review_post',
				'section' 		=> 'review', 
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'disable' => 'Disable',
					'stars'   => 'Stars',
					'point' => 'Point',
					'percentage' => 'Percentage',
				),		
				'before_row'   	=> 'cmb2_before_row_render_section', 
			) );
	
			$cmb_post->add_field( array(
				'name'             => 'Feature Name',
				'desc'             => __('Add The Reviewed Attributes', 'onfleek'),
				'id'               => $prefix . '_feature_reviews',
				'type'             => 'df_feature_reviews',
 				'escape_cb' => false,
 				'sanitization_cb' => false,
				) );

			$cmb_post->add_field( array(
				'name'             => 'Review Placement',
				'desc'             => __('Choose the location for your rating', 'onfleek'),
				'id'               => $prefix . '_review_location',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'bottom' => 'Bottom',
					'top'   => 'Top'
				),		
				
			) );

			$cmb_post->add_field( array(
				'name'             => 'Review Conclusion',
				'desc'             => 'Add your Review Conclusion here. This will be displayed under your Review result.',
				'id'               => $prefix . '_positive_title',
				'type'             => 'df_input',
				'show_option_none' => false,
			) );

			$cmb_post->add_field( array(
				'name'             => 'Item Review',
				'desc'             => 'The item that is being reviewed/rated. will also replace title for google micro data ',
				'id'               => $prefix . '_review_items',
				'type'             => 'df_input',
				'show_option_none' => false,
			) );
			
			$cmb_post->add_field( array(
				'name'    => 'Summary',
				'desc'    => __('Add Review Summary', 'onfleek'),
				'id'      => $prefix . '_summary',
				'type'    => 'df_wysiwyg',
				'options' => array( 'textarea_rows' => 5, ),
				'after_row'   	=> 'cmb2_after_row_render_section',
			) );
			/* End Review */


			/* Header */
			$cmb_post->add_field( array(
				'name'             => 'Header Style',
				'desc'             => __('Choose a custom header style for this post', 'onfleek'),
				'id'               => $prefix . '_header_type',
				'section' 		=> 'header', 
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'inherit' 	=> 'Inherit',
					'header-1'  => 'Header-1',
					'header-2' 	=> 'Header-2',
					'header-3' 	=> 'Header-3',
					'header-4' 	=> 'Header-4',
					'header-5-light' => 'Header-5-Light',
					'header-5-dark' => 'Header-5-Dark',
					'header-6-light' => 'Header-6-Light',
					'header-6-dark' => 'Header-6-Dark'
				),		
				'before_row'   	=> 'cmb2_before_row_render_section', 
			) );


			$cmb_post->add_field( array(
				'name'             => 'Top Bar',
				'desc'             => __('Enable/Disable topbar for this particular post', 'onfleek'),
				'id'               => $prefix . '_top_bar',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'inherit' => 'Inherit',
					'enable'   => 'Enable',
					'disable' => 'Disable',
				),		
				'after_row'   	=> 'cmb2_after_row_render_section', // callback 
			) );

			/* End Header */


			/* Background */
			$cmb_post->add_field( array(
				'name'             => 'Content Layout',
				'desc'             => __('Choose the default layout for this post', 'onfleek'),
				'id'               => $prefix . '_content_layout',
				'section' 		=> 'background', 
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'default' 	=> 'Default',
					'full' 		=> 'Full',
					'boxed'   	=> 'Boxed',
					'framed'	=> 'Framed'
				),	
				'before_row'   	=> 'cmb2_before_row_render_section', 
			) );

			$cmb_post->add_field( array(
				'name'             => 'Background Image',
				'desc'             => __('Upload background image for this post', 'onfleek'),
				'id'               => $prefix . '_background_image',
				'type'             => 'df_file',
				'preview_size' => array( 150, 150 )
			) );

			$cmb_post->add_field( array(
				'name'             => 'Background Repeat',
				'desc'             => __('Set how the background image will be repeated', 'onfleek'),
				'id'               => $prefix . '_background_repeat',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'no-repeat' 		=> 'No Repeat',
					'repeat'   			=> 'Tile',
					'repeat-x' => 'Tile Horizontally',
					'repeat-y'   => 'Tile Vertically',

				),		
			) );

			$cmb_post->add_field( array(
				'name'             => 'Background Position',
				'desc'             => __('Set the starting position of a background image', 'onfleek'),
				'id'               => $prefix . '_background_position',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
                    'left top' 		=> 'Left Top',
                    'left center' 	=> 'Left Center',
                    'left bottom' 	=> 'Left Bottom',
					'right top'   	=> 'Right Top',
                    'right center'  => 'Right Center',
                    'right bottom'  => 'Right Bottom',
					'center top'   	=> 'Centre Top',
					'center center' => 'Centre Center',
					'center bottom' => 'Centre Bottom',

				),
			) );
			
			$cmb_post->add_field( array(
				'name'              => 'Background Size',
				'desc'              => __('Set the starting size of a background image', 'onfleek'),
				'id'                => $prefix . '_background_size',
				'type'              => 'df_select_box',
				'show_option_none'  => false,
				'options'           => array(
                    'length' 	    => 'Length',
                    'cover'         => 'Cover',
                    'contain'       => 'Contain',
				),
			) );

			$cmb_post->add_field( array(
				'name'             => 'Background Attachment',
				'desc'             => __('Set whether a background image is fixed or scrolls with the rest of the page', 'onfleek'),
				'id'               => $prefix . '_background_attachment',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'fixed' 	=> 'Fixed',
					'scroll'   	=> 'Scroll',
				),
			) );

            
      $cmb_post->add_field( array(
				'name'          => 'Background Color',
				'desc'          => __('Choose the Background Color for this Post.', 'onfleek'),
				'id'            => $prefix . '_background_colour',
				'type'         	=> 'df_colorpicker',
				'after_row'		=> 'cmb2_after_row_render_section', // callback 
			) );

			/* End Background */

			/* footer */
			$cmb_post->add_field( array(
				'name'             => 'Footer Area',
				'desc'             => __('Enable/disable footer area in this particular post', 'onfleek'),
				'id'               => $prefix . '_display_footer',
				'section' 		   => 'footer', 
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'inherit' => 'Inherit',
					'enable'   => 'Enable',
					'disable' => 'Disable',
				),	
				'before_row'   	=> 'cmb2_before_row_render_section', 
			) );



			$cmb_post->add_field( array(
				'name'             => 'Sub Footer Area',
				'desc'             => __('Enable/disable sub footer area in this particular post', 'onfleek'),
				'id'               => $prefix . '_copyright_info',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'inherit' => 'Inherit',
					'enable'   => 'Enable',
					'disable' => 'Disable',
				),		
				'after_row'   	=> 'cmb2_after_row_render_section', // callback 
			) );
			/* end footer */


		}

		function df_magz_page_metabox () {
		/* Page */
			$prefix = 'df_magz_page';

			$cmb_page = new_cmb2_box( array(
				'id'            => $prefix ,
				'title'         => __( 'Dahz Setting', 'onfleek' ),
				'object_types'  => array( 'page',  ), // Post type
				'show_names' => false, 
				'priority'     => 'core',		// 'show_names' => true, // Show field names on the left
				'cmb_styles' => false, // false to disable the CMB stylesheet

			) );

			$cmb_page->add_field( array(
				'name'             => 'Sidebar Layout',
				'desc'             => __( 'Choose the sidebar area in this page', 'onfleek' ),
				'id'               => $prefix . '_layout',
				'section'		=> 'general', 
				'type'             => 'df_post_layout',
				'before_row'   	=> 'cmb2_before_row_render_section', 
				'show_option_none' => '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/default.png"></span>',
				'options'          => array(
				        //'default' 		=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/default.png"></span>',
				        'sidebar-left'	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/sidebar-left.png"></span>',
				        'fullwidth' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/full.png"></span>',
				        'sidebar-right' => '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/sidebar-right.png"></span>',
				),
			) );

			$output_sidebars	= array();
			$sidebars 			= $GLOBALS['wp_registered_sidebars'];
				$output_sidebars['default'] = 'Default';
				foreach($sidebars as $sidebar=> $value) { 
 					$output_sidebars[$value['id']] = $value['name'];
				}

			$cmb_page->add_field( array(
				'name'             => 'Custom Sidebar',
				'desc'             => 'Choose which sidebar that you want to use in this Page.',
				'id'               => $prefix . '_custom_sidebar',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => $output_sidebars,
			) );

			$cmb_page->add_field( array(
				'name'             => 'Unique articles',
				'desc'             => __('Note: We recommand to not use the Unique articles feature if you plan to use ajax blocks that have sub categories or pagination. This feature will make sure that only unique articles are loaded on the initial page load.', 'onfleek'),
				'id'               => $prefix . '_unique_article',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'no' 	=> 'Disable',
					'yes'	=> 'Enable',			
				),
				'after_row'   	=> 'cmb2_after_row_render_section', // callback
			) );
			$cmb_page->add_field( array(
				'name'         => 'Post Layout',
				'id'           => $prefix . '_post_layout',
				'desc'		   => __('Allow this page to populate your posts. Simply choose one of the post to enable this', 'onfleek'),
				'type'			=> 'df_post_layout',
				'section' => 'postsetting', 
				'show_option_none' => '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/default.png"></span>',
				'options'          => array(
						//'default'  	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/default.png"></span>',
						'layout-1' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/archive-1.png"></span>',
						'layout-2' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/archive-2.png"></span>',
						'layout-3' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/archive-3.png"></span>',
						'layout-4' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/archive-4.png"></span>',
						'layout-5' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/archive-5.png"></span>',
						'layout-6' 	=> '<span class="radio"><img class="img-responsive df-img" src="'. get_template_directory_uri() .'/inc/df-core/asset/images/admin/archive-6.png"></span>',
						
				),

				'before_row'   	=> 'cmb2_before_row_render_section', 
				
			) );

			$cmb_page->add_field( array(
				'name'             => 'Show List Title',
				'id'               => $prefix . '_show_list_title',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'enable' 	=> 'Enable',
					'disable'	=> 'disable',
				),		
			) );

			$cmb_page->add_field( array(
				'name'             => 'List Title',
				'desc'             => 'This Smart List put a number item , Select the counting Items',
				'id'               => $prefix . '_list_title',
				'type'             => 'df_input',
				'show_option_none' => false,
			) );

			$cmb_page->add_field( array(
				'name'             => 'Post ID Filter',
				'desc'             => __('Choose which posts to be displayed by adding post ID here. Use comma for multiple IDs', 'onfleek'),
				'id'               => $prefix . '_post_id_filter',
				'type'             => 'df_input',
				'show_option_none' => false,
			) );

				$output_categories = array();
				$categories=get_categories();
					$output_categories[''] = '-- Select Category--';
					$output_categories['all'] = 'All Category';
					foreach($categories as $category) { 
	 					$output_categories[$category->cat_ID] = $category->name;
					}

			$cmb_page->add_field( array(
				'name'             => 'Filter by Category',
				'desc'             => __('Only show post from a Category by choosing one of your category here', 'onfleek'),
				'id'               => $prefix . '_category_filter',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => $output_categories

			) );

			$cmb_page->add_field( array(
				'name'             => 'Multiple Category Filter',
				'desc'             => __('Filter the posts to only display posts from a certain category by adding category slug(s) here. Use comma for multiple categories', 'onfleek'),
				'id'               => $prefix . '_multiple_category_filter',
				'type'             => 'df_input',
				'show_option_none' => false,

			) );


			$cmb_page->add_field( array(
				'name'             => 'Filter by Tag',
				'desc'             => __('Filter the posts to only display posts from a certain tag by adding category slug(s) here. Use comma for multiple tags', 'onfleek'),
				'id'               => $prefix . '_filter_by_tag_slug',
				'type'             => 'df_input',
				'show_option_none' => false,

			) );

			$cmb_page->add_field( array(
				'name'             => 'Filter by Author',
				'desc'             => __('filter the posts to only display posts from certain author by adding Author slug(s) here. Use comma for multiple authors', 'onfleek'),
				'id'               => $prefix . '_multiple_author_filter',
				'type'             => 'df_input',
				'show_option_none' => false,

			) );

			$cmb_page->add_field( array(
				'name'             => 'Sort Order',
				'desc'             => __('Choose the order of your post', 'onfleek'),
				'id'               => $prefix . '_sort_order',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'newest_post'	=> 'Newest Post',
					'lastest_post' 	=> 'Lastest Post',
					
				),		
			) );

			$cmb_page->add_field( array(
				'name'             => 'Max Number Of Post',
				'desc'             => __('Choose the maximum number of posts to be displayed in this page', 'onfleek'),
				'id'               => $prefix . '_limit_post_order',
				'type'             => 'df_input',
				'show_option_none' => false,

			) );

			$cmb_page->add_field( array(
				'name'             => 'Pagination',
				'desc'             => __('Choose the order of your post', 'onfleek'),
				'id'               => $prefix . '_pagination',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'normal-pagination' 		=> 'Normal Pagination',
					'load-more-infinite-scroll'	=> 'Infinite Scroll',
				),
				'after_row'   	=> 'cmb2_after_row_render_section', // 	callback		
			) );

		/* Header */
			$cmb_page->add_field( array(
				'name'             => 'Header Style',
				'desc'             => __('Choose a custom header style for this page', 'onfleek'),
				'id'               => $prefix . '_header_type',
				'section' 		=> 'header', 
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'inherit' 			=> 'Inherit',
					'header-1'  		=> 'Header-1',
					'header-2' 			=> 'Header-2',
					'header-3' 			=> 'Header-3',
					'header-4' 			=> 'Header-4',
					'header-5-light' 	=> 'Header-5-Light',
					'header-5-dark' 	=> 'Header-5-Dark',
					'header-6-light' 	=> 'Header-6-Light',
					'header-6-dark' 	=> 'Header-6-Dark'
				),		
				'before_row'   	=> 'cmb2_before_row_render_section', 
			) );

			$cmb_page->add_field( array(
				'name'             => 'Top Bar',
				'desc'             => __('Enable/Disable topbar for this particular page', 'onfleek'),
				'id'               => $prefix . '_top_bar',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'inherit' => 'Inherit',
					'enable'   => 'Enable',
					'disable' => 'Disable',
				),		
				'after_row'   	=> 'cmb2_after_row_render_section', // callback 
			) );

			/* Background */
			$cmb_page->add_field( array(
				'name'             => 'Content Layout',
				'desc'             => __('Choose the default layout for this page', 'onfleek'),
				'id'               => $prefix . '_content_layout',
				'section' 		=> 'background', 
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'default' => 'Default',
					'full' => 'Full',
					'boxed'   => 'Boxed',
					'framed' => 'Framed'
				),	
				'before_row'   	=> 'cmb2_before_row_render_section', 
			) );

			$cmb_page->add_field( array(
				'name'             => 'Background Image',
				'desc'             => __('Upload background image for this page', 'onfleek'),
				'id'               => $prefix . '_background_image',
				'type'             => 'df_file',
				'preview_size' => array( 150, 150 )
			) );

			$cmb_page->add_field( array(
				'name'             => 'Background Repeat',
				'desc'             => __('Set how the background image will be repeated', 'onfleek'),
				'id'               => $prefix . '_background_repeat',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'no-repeat'    => 'No Repeat',
					'repeat'   	   => 'Tile',
					'repeat-x'     => 'Tile Horizontally',
					'repeat-y'     => 'Tile Vertically',

				),		
			) );

			$cmb_page->add_field( array(
				'name'             => 'Background Position',
				'desc'             => __('Set the starting position of a background image', 'onfleek'),
				'id'               => $prefix . '_background_position',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'left top' 		=> 'Left Top',
                    'left center' 	=> 'Left Center',
                    'left bottom' 	=> 'Left Bottom',
					'right top'   	=> 'Right Top',
                    'right center'  => 'Right Center',
                    'right bottom'  => 'Right Bottom',
					'center top'   	=> 'Centre Top',
					'center center' => 'Centre Center',
					'center bottom' => 'Centre Bottom',

				),
			) );
			
			$cmb_page->add_field( array(
				'name'              => 'Background Size',
				'desc'              => __('Set the starting size of a background image', 'onfleek'),
				'id'                => $prefix . '_background_size',
				'type'              => 'df_select_box',
				'show_option_none'  => false,
				'options'           => array(
                    'length' 	    => 'Length',
                    'cover'         => 'Cover',
                    'contain'       => 'Contain',
				),
			) );

			$cmb_page->add_field( array(
				'name'             => 'Background Attachment',
				'desc'             => __('Set whether a background image is fixed or scrolls with the rest of the page', 'onfleek'),
				'id'               => $prefix . '_background_attachment',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'fixed' 	=> 'Fixed',
					'scroll'   	=> 'Scroll',
				),
			) );
	
			$cmb_page->add_field( array(
				'name'          => 'Background Color',
				'desc'          => __('Choose the Background Color for this Page.', 'onfleek'),
				'id'            => $prefix . '_background_colour',
				'type'         	=> 'df_colorpicker',
				'after_row'		=> 'cmb2_after_row_render_section', // callback 
			) );

			/* End Background */

			/* footer */
			$cmb_page->add_field( array(
				'name'             => 'Footer Area',
				'desc'             => __('Enable/Disable Footer Area in this Particular Page.', 'onfleek'),
				'id'               => $prefix . '_display_footer',
				'section' 		   => 'footer', 
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'inherit' => 'Inherit',
					'enable'   => 'Enable',
					'disable' => 'Disable',
				),	
				'before_row'   	=> 'cmb2_before_row_render_section', 
			) );

			$cmb_page->add_field( array(
				'name'             => 'Sub Footer Area',
				'desc'             => __('Enable/Disable Sub Footer Area in this particular page.', 'onfleek'),
				'id'               => $prefix . '_copyright_info',
				'type'             => 'df_select_box',
				'show_option_none' => false,
				'options'          => array(
					'inherit' => 'Inherit',
					'enable'   => 'Enable',
					'disable' => 'Disable',
				),		
				'after_row'   	=> 'cmb2_after_row_render_section', // callback 
			) );
			/* end footer */
		}
	}
	new DF_custom_metabox();
}
