<?php

require_once( get_template_directory() . '/inc/df-core/df-global.php' );

require_once( get_template_directory() . '/inc/df-core/df-config.php' );

if( is_admin() ){
	
	require_once(get_template_directory() . '/inc/class-tgm-plugin-activation.php');
	
	require_once( get_template_directory() . '/inc/df-core/df-theme-options/df-theme-options.php' );
	require_once( get_template_directory() . '/inc/df-core/df-custom-metabox/df-custom-metabox.php' );
	require_once( get_template_directory() . '/inc/df-core/plugins/multiple-post-thumbnail/multi-post-thumbnails.php' );
	
} 
require_once( get_template_directory() . '/inc/df-core/plugins/infinite-transporter/transporter.php' ); // add by fajar

require_once( get_template_directory() . '/inc/df-core/df-customizer/df-customizer.php' );	//add by robby

require_once( get_template_directory() . '/inc/df-core/df-customizer/custom-customizer.php' ); // add by robby

require_once( get_template_directory() . '/inc/df-core/df-front-end/df-options.php' );
require_once( get_template_directory() . '/inc/df-core/df-megamenu/df-megamenu.php' );

require_once( get_template_directory() . '/inc/df-core/df-utils/df-search-ajax.php' );

require_once( get_template_directory() . '/inc/df-core/df-custom-metabox/df-get-metabox.php' );

require_once( get_template_directory() . '/inc/df-core/df-utils/df-register-footer-area.php' );

require_once( get_template_directory() . '/inc/df-core/df-front-end/df-css-options.php' );

require_once( get_template_directory() . '/inc/df-core/df-utils/df-widget-builder.php' );

require_once( get_template_directory() . '/inc/df-core/df-front-end/df-script-option.php' );

require get_template_directory() . '/inc/df-core/DF-Framework.php';


require_once( get_template_directory() . '/inc/df-core/df-front-end/df-header.php' );

require_once( get_template_directory() . '/inc/df-core/views/df-content-view.php' );
require_once( get_template_directory() . '/inc/df-core/df-front-end/df-content.php' );
require_once( get_template_directory() . '/inc/df-core/df-front-end/df-schema-org.php' );
require_once( get_template_directory() . '/inc/df-core/df-front-end/df-footer.php' );
require_once( get_template_directory() . '/inc/df-core/views/df-footer-view.php' );

/**
 * bundling plugin: amp for wordpress by automaticc
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if( is_plugin_active( 'amp/amp.php' ) ): require_once( get_template_directory() . '/inc/df-core/df-utils/df-amp-custom.php' ); endif;

// require get_template_directory() . '/inc/df-core/df-front-end/df-options.php';

if ( !class_exists('Functions') ){

	Class Functions {

		function __construct(){
			add_action( 'init', array( $this, 'df_register_mobile_menu' ) );
			add_action( 'after_setup_theme', array( $this, 'df_magz_setup') );
			add_action( 'after_setup_theme', array( $this, 'df_magz_content_width' ), 0 );
			add_action( 'widgets_init', array( $this, 'df_magz_widgets_init'), 1);
			add_action( 'widgets_init', array ( $this, 'register_off_canvas_sidebar'), 2);
			add_filter( 'user_contactmethods', array( $this, 'authors_social') );
			add_action( 'wp_enqueue_scripts', array($this, 'df_magz_scripts') );
			
		}

		/**
		 * onfleek functions and definitions.
		 *
		 * @link https://developer.wordpress.org/themes/basics/theme-functions/
		 *
		 * @package onfleek
		 */
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		function df_magz_setup() {
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on onfleek, use a find and replace
			 * to change 'onfleek' to the name of your theme in all the template files.
			 */
			load_theme_textdomain( 'onfleek', get_template_directory() . '/languages/' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'primary' => esc_html__( 'Primary', 'onfleek' ),
			) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			/*
			 * Enable support for Post Formats.
			 * See https://developer.wordpress.org/themes/functionality/post-formats/
			 */
			add_theme_support( 'post-formats', array(
				'audio',
				'gallery',
				'video',
				'standard'
			) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'onfleek_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );
			//Setup Infinite Scroll

			add_editor_style();

		}

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		function df_magz_content_width() {

			$GLOBALS['content_width'] = apply_filters( 'df_magz_content_width', 640 );

		}
		
		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		function df_magz_widgets_init() {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar', 'onfleek' ),
				'id'            => 'sidebar-1',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<div class="df-widget-title">',
				'after_title'   => '</div>',
			) );
		}

		/** REGISTER MOBILE MENU **/
		function df_register_mobile_menu() {

			register_nav_menus(
				array(
					'mobile-menu' => __( 'Mobile Menu' , 'onfleek' )
				)
			);

		}

		/**
		 * register off canvas sidebar
		 */
		function register_off_canvas_sidebar() {
			register_sidebar( array(
				'name' => __( 'Off Canvas Sidebar', 'onfleek' ),
				'id' => 'sidebar-999',
				'description' => __( 'Widgets in this area will be shown on Off Canvas', 'onfleek' ),
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h5 class="df-widget-title">',
				'after_title'   => '</h5>',
			) );
        }

		/**
		 * Enqueue scripts and styles.
		 */
		function df_magz_scripts() {
			wp_enqueue_style( 'df_magz-style', get_stylesheet_uri() );

			wp_enqueue_script( 'df_magz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

			wp_enqueue_script( 'df_magz-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		
		}
		function authors_social( $contactmethods ) {
			// Add Hobby
			$contactmethods['job_title'] = __( 'Job Title', 'onfleek' );
			// Add Facebook
			$contactmethods['facebook'] = __( 'Facebook', 'onfleek' );
			// Add Twitter
			$contactmethods['twitter'] = __( 'Twitter', 'onfleek' );
			// Add Pinterest
			$contactmethods['pinterest'] = __( 'Pinterest', 'onfleek' );
			// Add Google Plus
			$contactmethods['gplus'] = __( 'Google+', 'onfleek' );
			// Add LinkedIn
			$contactmethods['linkedin'] = __( 'LinkedIn', 'onfleek' );

			return $contactmethods;
		}



	}
	$functions = new Functions();

}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

