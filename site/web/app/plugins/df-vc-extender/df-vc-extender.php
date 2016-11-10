<?php
/*
Plugin Name: Visual Composer Extender
Description: Extender Custom Shortcode for Visual Composer by Dahz Theme
Version: 1.2
Author: Dahz Theme
Author URI: http://daffyhazan.com/
change :
03-08-2016 : - auto play carousel
*/

require_once('df-vc-extender-shortcode.php');
require_once('df_render_loop.php');

define("VC_EXTENDER_CATEGORY", "by Dahz Themes");
define("VC_EXTENDER_GROUP_GENERAL", "General");
define("VC_EXTENDER_GROUP_FILTER", "Filter");

class DF_VC_Extender {

	private $params_map = array();
	private $params_block = array();
	private $extender_shortcode;

	/**
	 * __construct()
	 */
	function __construct() {
		$this->df_set_params_map();
		add_action( 'init', array( $this, 'df_mapping_block' ) );
		add_action( 'vc_after_init', array( $this, 'df_disable_frontend_link') );
		add_action( 'vc_after_init', array( $this, 'df_textfield_disable_setting') );
		add_action( 'after_setup_theme', array( $this, 'df_after_theme_init') );
	}

	/**
	 * df_after_theme_init
	 * init add_shortcode after theme setup
	 */
	function df_after_theme_init(){
		$extender_shortcode = new DF_VC_Extender_Shortcode( $this->params_map );
	}

	/**
	 * df_textfield_disable_setting
	 * @param - 
	 * @return -
	 */
	function df_textfield_disable_setting(){
		vc_add_shortcode_param( 'textfield_disable', array( $this, 'textfield_disable_setting' ) );
	}

	/**
	 * df_disable_frontend_link
	 * @param - 
	 * @return -
	 */
	function df_disable_frontend_link(){
		vc_disable_frontend();
	}

	/**
	 * df_set_params_map()
	 * function for set params of vc_map() function 
	 */
	function df_set_params_map(){
		$this->params_map = array(
				"df block 1" => array(
									"name" => "Posts Block 1",
									"base" => "df_posts_block_1",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df_block 2" => array(
									"name" => "Posts Block 2",
									"base" => "df_posts_block_2",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 3" => array(
									"name" => "Posts Block 3",
									"base" => "df_posts_block_3",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 4" => array(
									"name" => "Posts Block 4",
									"base" => "df_posts_block_4",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 5" => array(
									"name" => "Posts Block 5",
									"base" => "df_posts_block_5",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 6" => array(
									"name" => "Posts Block 6",
									"base" => "df_posts_block_6",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 7" => array(
									"name" => "Posts Block 7",
									"base" => "df_posts_block_7",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 8" => array(
									"name" => "Posts Block 8",
									"base" => "df_posts_block_8",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 9" => array(
									"name" => "Posts Block 9",
									"base" => "df_posts_block_9",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 10" => array(
									"name" => "Posts Block 10",
									"base" => "df_posts_block_10",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 11" => array(
									"name" => "Posts Block 11",
									"base" => "df_posts_block_11",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 12" => array(
									"name" => "Posts Block 12",
									"base" => "df_posts_block_12",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 13" => array(
									"name" => "Posts Block 13",
									"base" => "df_posts_block_13",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df block 14" => array(
									"name" => "Posts Block 14",
									"base" => "df_posts_block_14",
									"params" => $this->df_set_params_block( "post_block" )
								),
				"df news ticker" => array(
									"name" => "News Ticker",
									"base" => "df_news_ticker",
									"params" => $this->df_set_params_block( "news_ticker" )
								),
				"df grid 1" 	=> array(
									"name" => "Posts Grid 1",
									"base" => "df_posts_grid_1",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df grid 2" 	=> array(
									"name" => "Posts Grid 2",
									"base" => "df_posts_grid_2",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df grid 3" 	=> array(
									"name" => "Posts Grid 3",
									"base" => "df_posts_grid_3",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df grid 4" 	=> array(
									"name" => "Posts Grid 4",
									"base" => "df_posts_grid_4",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df carousel 1" => array(
									"name" => "Posts Carousel 1",
									"base" => "df_posts_carousel_1",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df carousel 2" 	=> array(
									"name" => "Posts Carousel 2",
									"base" => "df_posts_carousel_2",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df carousel 3" 	=> array(
									"name" => "Posts Carousel 3",
									"base" => "df_posts_carousel_3",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df carousel 4" 	=> array(
									"name" => "Posts Carousel 4",
									"base" => "df_posts_carousel_4",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df carousel 5" 	=> array(
									"name" => "Posts Carousel 5",
									"base" => "df_posts_carousel_5",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df carousel 6" 	=> array(
									"name" => "Posts Carousel 6",
									"base" => "df_posts_carousel_6",
									"params" => $this->df_set_params_block( "post_grid_carousel", 'df_posts_carousel_6' )
								),
				"df carousel 7" 	=> array(
									"name" => "Posts Carousel 7",
									"base" => "df_posts_carousel_7",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
								),
				"df carousel 8" 	=> array(
									"name" => "Posts Carousel 8",
									"base" => "df_posts_carousel_8",
									"params" => $this->df_set_params_block( "post_grid_carousel" )
									),
				"df youtube playlist" => array(
									"name" => "Youtube Video Playlist",
									"base" => "df_youtube_playlist",
									"params" => $this->df_set_params_block( "youtube_video" )
								),
				"df vimeo playlist" => array(
									"name" => "Vimeo Video Playlist",
									"base" => "df_vimeo_playlist",
									"params" => $this->df_set_params_block( "vimeo_video" )
								),
				/*"df author box" => array(
									"name" => "Authors Box",
									"description" => "Display Authors",
									"base" => "df_authors_box",
									"params" => $this->df_set_params_block( "authors_box" )
								),
				"df audio embed" => array(
									"name" => "Audio",
									"description" => "Embed Audio (ex: from soundcloud.com)",
									"base" => "df_audio_embed",
									"params" => $this->df_set_params_block( "audio_embed" )
								),
							*/
				); // end of array

	}

	/**
	 * df_mapping_block()
	 * function for create block using vc_map()
	 */
	function df_mapping_block(){
		// loop $params_map, call vc_map() 
		foreach ( $this->params_map as $aom ) {
			extract( $aom );
			$this->df_vc_map_block( $name, $base, $params );
		}
	}

	/**
	 * df_vc_map_block()
	 * @param $name_block
	 * @param $desc_block
	 * @param $base_block
	 * @param $params
	 * function call for vc_map()
	 */
	function df_vc_map_block($name_block, $base_block, $params){
		vc_map(
			array(
				"name" => $name_block,
				"description" => '',
				"category" => VC_EXTENDER_CATEGORY,
				"class" => 'df-icon-block',
				"base" => $base_block,
				"icon" => get_template_directory_uri() . "/inc/df-core/asset/images/admin/shortcode_icons/".$base_block.".png",
				"content_element" => true,
				"params" => $params,
			)
		);
	}

	/**
	 * df_render_categories()	
	 * @return list checkboxes of categories
	 */
	function df_render_categories(){
		$blog_categories = get_categories();
		$out = array();
		foreach( $blog_categories as $category ) {
			$out[$category->name] = $category->cat_ID;
		}
		return $out;
	}

	/**
	 * df_set_params_block()
	 * @param $block_type
	 * function for set params of "params" vc_map()
	 */
	function df_set_params_block( $block_type, $base='' ){

		switch ( $block_type ) {
			case 'post_block':
				$this->params_block = array(
							array(
								"type" => "textfield",
								"heading" => "Custom Title", 
								"value" => "Block Title",
								"param_name" => "title",
								"admin_label" => true,
								"description" => "Optional, a title for this block",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "textfield",
								"heading" => "Title Url",
								"param_name" => "title_url",
								"admin_label" => true,
								"description" => "Optional, a custom url when block title is clicked",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "colorpicker",
								"heading" => "Title Text Color",
								"param_name" => "title_text_color",
								"admin_label" => true,
								"description" => "Optional, choose custom text color for block title",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "dropdown",
								"heading" => "Show Title",
								"param_name" => "show_title",
								"value" => array(
									"Yes" 	=> "yes",
									"No" 	=> "no"
								),
								"std" => "yes",
								"admin_label" => true,
								"description" => "Show or Hide Title Block",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "textfield",
								"heading" => "Limit Post Number",
								"param_name" => "limit_post_number",
								"admin_label" => true,
								"value" => 10, // default value
								// "description" => "If empty, number of posts will be the number from Wordpress Settings -> Reading",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "dropdown",
								"heading" => "Post Source",
								"param_name" => "source",
								"value" => array(
									"Most Recent" => "most-recent",
									"By Category" => "by-category",
									"By Post ID" => "by-post-id",
									"By Tag" => "by-tag",
									"By Author" => "by-author"
								),
								"std" => "most-recent",
								"admin_label" => true,
								"description" => "Select the source of the posts",
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// checkboxes categories filter
							array(
								"type" => "checkbox",
								"heading" => "Posts Categories",
								"param_name" => "categories",
								"value" => $this->df_render_categories(),
								"description" => "Which categories would you like to show?",
								"dependency" => array("element" => "source", "value" => array('by-category')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// textfield Post IDs filter
							array(
								"type" => "textfield",
								"heading" => "Post IDs",
								"param_name" => "post_ids",
								"description" => "Enter the post IDs you would like to display (separated by comma)",
								"dependency" => array("element" => "source", "value" => array('by-post-id')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// textfield Tag slug filter
							array(
								"type" => "textfield",
								"heading" => "Tag Slugs",
								"param_name" => "tag_slugs",
								"description" => "Enter the tag slugs you would like to display (separated by comma)", 
								"dependency" => array("element" => "source", "value" => array('by-tag')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// textfield Author IDs filter
							array(
								"type" => "textfield",
								"heading" => "Author IDs",
								"param_name" => "author_ids",
								"description" => "Enter the Author IDs you would like to display (separated by comma)",
								"dependency" => array("element" => "source", "value" => array('by-author')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							array(
								"type" => "dropdown",
								"heading" => "Sort Order",
								"param_name" => "sort_order",
								"value" => array(
										"Latest" => "sort-latest",
										"Random Posts Today" => "sort-random-today",
										"Random Posts from Last 7 day" => "sort-random-7day",
										"Alphabetical" => "sort-alphabetical",
										"Popular" => "sort-popular"
									),
								"std" => "sort-latest",
								"admin_label" => true,
								"description" => "Select Sort Order",
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							array(
								"type" => "dropdown",
								"heading" => "Pagination",
								"param_name" => "pagination_status",
								"value" => array(
										"Enable Pagination" => "pagination-enable",
										"Disable Pagination" => "pagination-disable",
									),
								"std" => "pagination-enable",
								"admin_label" => true,
								"description" => "Enable / Disable Pagination",
								"group" => VC_EXTENDER_GROUP_FILTER
							)
					);
				break;
			case 'post_grid_carousel':
				$value = 10;
				$description = '';
				$typefield = 'textfield';
				if ( $base == 'df_posts_carousel_6'){
					$value = 5;
					$typefield = 'textfield_disable';
					$description = 'The maximum number of posts you can have in this shortcode is 5';
				}
				$this->params_block = array(
							array(
								"type" => "dropdown",
								"heading" => "Show Bullet",
								"param_name" => "show_bullet",
								"value" => array(
									"Yes" 	=> "yes",
									"No" 	=> "no"
								),
								"std" => "yes",
								"admin_label" => true,
								"description" => "Show or Hide Grid Bullet",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => $typefield,
								"heading" => "Limit Post Number",
								"param_name" => "limit_post_number",
								"admin_label" => true,
								"value" => $value,
								"description" => $description,
								"group" => VC_EXTENDER_GROUP_GENERAL
							),

							array(
								"type" => "dropdown",
								"heading" => "Post Source",
								"param_name" => "source",
								"value" => array(
									"Most Recent" => "most-recent",
									"By Category" => "by-category",
									"By Post ID" => "by-post-id",
									"By Tag" => "by-tag",
									"By Author" => "by-author"
								),
								"std" => "most-recent",
								"admin_label" => true,
								"description" => "Select the source of the posts",
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// checkboxes categories filter
							array(
								"type" => "checkbox",
								"heading" => "Posts Categories",
								"param_name" => "categories",
								"value" => $this->df_render_categories(),
								"description" => "Which categories would you like to show?",
								"dependency" => array("element" => "source", "value" => array('by-category')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// textfield Post IDs filter
							array(
								"type" => "textfield",
								"heading" => "Post IDs",
								"param_name" => "post_ids",
								"description" => "Enter the post IDs you would like to display (separated by comma)",
								"dependency" => array("element" => "source", "value" => array('by-post-id')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// textfield Tag slug filter
							array(
								"type" => "textfield",
								"heading" => "Tag Slugs",
								"param_name" => "tag_slugs",
								"description" => "Enter the tag slugs you would like to display (separated by comma)", 
								"dependency" => array("element" => "source", "value" => array('by-tag')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// textfield Author IDs filter
							array(
								"type" => "textfield",
								"heading" => "Author IDs",
								"param_name" => "author_ids",
								"description" => "Enter the Author IDs you would like to display (separated by comma)",
								"dependency" => array("element" => "source", "value" => array('by-author')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							array(
								"type" => "dropdown",
								"heading" => "Sort Order",
								"param_name" => "sort_order",
								"value" => array(
										"Latest" => "sort-latest",
										"Random Posts Today" => "sort-random-today",
										"Random Posts from Last 7 day" => "sort-random-7day",
										"Alphabetical" => "sort-alphabetical",
										"Popular" => "sort-popular"
									),
								"std" => "sort-latest",
								"admin_label" => true,
								"description" => "Select Sort Order",
								"group" => VC_EXTENDER_GROUP_FILTER
							)
					);
				$auto_play_carousel = array(
											/** Auto Play Carousel **/
											array(
												"type" => "dropdown",
												"heading" => "Auto Play",
												"param_name" => "auto_play",
												"value" => array(
													"Enable" 	=> "true",
													"Disable" 	=> "false"
												),
												"std" => "false",
												"admin_label" => true,
												"description" => "Auto Play Carousel",
												"group" => VC_EXTENDER_GROUP_GENERAL
											),
											array(
												"type" => "textfield",
												"heading" => "Auto Play Speed",
												"param_name" => "auto_play_speed",
												"admin_label" => true,
												"value" => 5000,
												"description" => 'Duration of animation between slides (in ms).',
												"group" => VC_EXTENDER_GROUP_GENERAL
											),
											/**ENd Auto Play Carousel **/
										);
				if ( $base !== 'df_posts_carousel_6'){
					foreach ($auto_play_carousel as $key => $value) {
		    			array_push($this->params_block, $auto_play_carousel[$key] ); 
						}
				}
				break;
			case 'news_ticker':
				$this->params_block = array(
							array(
								"type" => "textfield",
								"heading" => "News Ticker Title",
								"value" => "Trending Now",
								"param_name" => "title_news_ticker",
								"admin_label" => true,
								"description" => "Default : Trending Now",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "dropdown",
								"heading" => "Navigation",
								"value" => array(
									"Auto" 	=> "auto-slide",
									"Manual" 	=> "manual"
								),
								"param_name" => "navigation",
								"admin_label" => true,
								"description" => "If set on `Auto` will set the `Trending Now` block to auto start rotating posts",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "dropdown",
								"heading" => "Style",
								"value" => array(
									"Style 1" 	=> "style1",
									"Style 2" 	=> "style2"
								),
								"param_name" => "style",
								"admin_label" => true,
								"description" => "Style of the `Trending Now` box",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "colorpicker",
								"heading" => "Title Text Color",
								"param_name" => "title_text_color",
								"admin_label" => true,
								"value" => "#333",
								"description" => "Optional - Choose a custom title text color for this block",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "colorpicker",
								"heading" => "Title Background Color",
								"param_name" => "title_background_color",
								"admin_label" => true,
								"description" => "Optional - Choose a custom title background color for this block",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "colorpicker",
								"heading" => "Post Title Text Color",
								"param_name" => "post_title_text_color",
								"admin_label" => true,
								"description" => "Optional - Choose a custom post title text color for this block",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "textfield",
								"heading" => "Limit Post Number",
								"param_name" => "limit_post_number",
								"admin_label" => true,
								"value" => 5, // default value
								// "description" => "If empty, number of posts will be the number from Wordpress Settings -> Reading",
								"group" => VC_EXTENDER_GROUP_GENERAL
							),
							array(
								"type" => "dropdown",
								"heading" => "Post Source",
								"param_name" => "source",
								"value" => array(
									"Most Recent" => "most-recent",
									"By Category" => "by-category",
									"By Post ID" => "by-post-id",
									"By Tag" => "by-tag",
									"By Author" => "by-author"
								),
								"std" => "most-recent",
								"admin_label" => true,
								"description" => "Select the source of the posts",
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// checkboxes categories filter
							array(
								"type" => "checkbox",
								"heading" => "Posts Categories",
								"param_name" => "categories",
								"value" => $this->df_render_categories(),
								"description" => "Which categories would you like to show?",
								"dependency" => array("element" => "source", "value" => array('by-category')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// textfield Post IDs filter
							array(
								"type" => "textfield",
								"heading" => "Post IDs",
								"param_name" => "post_ids",
								"description" => "Enter the post IDs you would like to display (separated by comma)",
								"dependency" => array("element" => "source", "value" => array('by-post-id')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// textfield Tag slug filter
							array(
								"type" => "textfield",
								"heading" => "Tag Slugs",
								"param_name" => "tag_slugs",
								"description" => "Enter the tag slugs you would like to display (separated by comma)", 
								"dependency" => array("element" => "source", "value" => array('by-tag')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							// textfield Author IDs filter
							array(
								"type" => "textfield",
								"heading" => "Author IDs",
								"param_name" => "author_ids",
								"description" => "Enter the Author IDs you would like to display (separated by comma)",
								"dependency" => array("element" => "source", "value" => array('by-author')),
								"group" => VC_EXTENDER_GROUP_FILTER
							),
							array(
								"type" => "dropdown",
								"heading" => "Sort Order",
								"param_name" => "sort_order",
								"value" => array(
										"Latest" => "sort-latest",
										"Random Posts Today" => "sort-random-today",
										"Random Posts from Last 7 day" => "sort-random-7day",
										"Alphabetical" => "sort-alphabetical",
										"Popular" => "sort-popular"
									),
								"std" => "sort-latest",
								"admin_label" => true,
								"description" => "Select Sort Order",
								"group" => VC_EXTENDER_GROUP_FILTER
							),
					);
				break;

			case 'youtube_video':
				$this->params_block = array(
						array(
							"type" => "textfield",
							"heading" => "List of youtube id's separated by comma: ",
							"value" => "",
							"param_name" => "youtube_id",
							"admin_label" => true,
							"description" => "Ex: O9sgllm_Bhc, rYV8An8kwuk, 2H0hH7cYXUc",
						),
						array(
							"type" => "dropdown",
							"heading" => "Autoplay ON / OFF:",
							"param_name" => "video_auto",
							"value" => array(
								"OFF" => "0",
								"ON" => "1"
							),
							"admin_label" => true,
							"description" => "Autoplay does not work on mobile devices (android, windows phone, iOS)",
						),
					);
				break;
			case 'vimeo_video':
				$this->params_block = array(
						array(
							"type" => "textfield",
							"heading" => "List of vimeo id's separated by comma: ",
							"value" => "",
							"param_name" => "vimeo_id",
							"admin_label" => true,
							"description" => "Ex: 167807122, 168339606, 167409747",
						),
						array(
							"type" => "dropdown",
							"heading" => "Autoplay ON / OFF:",
							"param_name" => "video_auto",
							"value" => array(
								"OFF" => "0",
								"ON" => "1"
							),
							"admin_label" => true,
							"description" => "Autoplay does not work on mobile devices (android, windows phone, iOS)",
						),
					);
				break;
		}
		return $this->params_block;
	}

	function textfield_disable_setting( $settings, $value ){
		return '<input disabled name="'.esc_attr( $settings['param_name']).'" class="wpb_vc_param_value wpb-textinput '.esc_attr( $settings['param_name'] ).'" type="text" value="'.esc_attr( $value ).'"/>';
	}
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active( 'js_composer/js_composer.php' ) ) {
  	new DF_VC_Extender();
} 
/* file location: [theme directory]/inc/df-core/df-vc-extender/df-vc-extender.php */