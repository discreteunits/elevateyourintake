<?php

class df_customize
{
	function __construct()
	{
		add_action('customize_register', array($this, 'df_customize_register'));
		add_action('customize_preview_init', array($this,'df_customizer_live_preview'));
		add_action('customize_controls_print_styles', array($this,'df_customizer_css'));
	}
	/**
	 * df_customize::df_customize_register()
	 * 
	 * @param mixed $wp_customize
	 * @return void
	 */
	public static function df_customize_register($wp_customize) {
		$wp_customize->remove_section("colors");
		$wp_customize->remove_section("background_image");
		$wp_customize->remove_section("header_image");
		$wp_customize->remove_setting('site_icon');
		/**
		 * Start Add Panel
		 */
		$wp_customize->add_panel('Df_Logo', array(
						'title' => __('Customize Logo','onfleek'), 
						'description' => __('Modify the Logo theme','onfleek'),
                        ));
                        
		$wp_customize->add_panel('df_color_styling', array(
						'title' => __('Customize Color-Styling','onfleek'), 
						'description' => __('Modify the Color Styling','onfleek')));
		/**
		 * End Add Panel
		 * Start Add Section
		 */
		$wp_customize->add_section('df_customize_fav_icon', array(
						'title' => __('Fav Icon','onfleek'),
						'capability' => 'manage_options',
						'panel' => 'Df_Logo',
						));
		$wp_customize->add_section('df_customize_logo_header_1', array(
						'title' => __('Logo Header 1','onfleek'),
						'capability' => 'manage_options',
						'panel' => 'Df_Logo',
						));
		$wp_customize->add_section('df_customize_logo_header_2', array(
						'title' => __('Logo Header 2','onfleek'),
						'capability' => 'manage_options',
						'panel' => 'Df_Logo',
						));
		$wp_customize->add_section('df_customize_logo_header_3', array(
						'title' => __('Logo Header 3','onfleek'),
						'capability' => 'manage_options',
						'panel' => 'Df_Logo',
						));
		$wp_customize->add_section('df_customize_logo_header_4', array(
						'title' => __('Logo Header 4','onfleek'),
						'capability' => 'manage_options',
						'panel' => 'Df_Logo',
						));
		$wp_customize->add_section('df_customize_logo_header_5&6_light', array(
						'title' => __('Logo Header 5 & 6 light','onfleek'),
						'capability' => 'manage_options',
						'panel' => 'Df_Logo',
						));
		$wp_customize->add_section('df_customize_logo_header_5&6_dark', array(
						'title' => __('Logo Header 5 & 6 dark','onfleek'),
						'capability' => 'manage_options',
						'panel' => 'Df_Logo',
						));
		$wp_customize->add_section('df_customize_sticky_header', array(
						'title' => __('Sticky Header','onfleek'),
						'capability' => 'manage_options',
						'panel' => 'Df_Logo',
						));
		$wp_customize->add_section('df_customize_mobile_logo', array(
						'title' => __('Mobile Header','onfleek'),
						'capability' => 'manage_options',
						'panel' => 'Df_Logo',
						));
		$wp_customize->add_section('df_side_area', array(
						'title' => __('Customize Background Sidearea', 'onfleek'),
						'description' => __('Custom Background Sidearea ','onfleek'),
						));
		$wp_customize->add_section('df_color_general', array(
						'title' => __('General', 'onfleek'),
						'description' => __('General Color Styling','onfleek'),
						'panel' => 'df_color_styling'));
		$wp_customize->add_section('df_sidebar', array(
						'title' => __('Sidebar', 'onfleek'),
						'description' => __('Sidebar Color Styling','onfleek'),
						'panel' => 'df_color_styling'));
		$wp_customize->add_section('df_footer', array(
						'title' => __('Footer', 'onfleek'),
						'description' => __('Footer Color Styling','onfleek'),
						'panel' => 'df_color_styling'));
		/**
		 * End Add Section
		 */
		 
		 /**
		  * Start Add Setting
		  */
		$wp_customize->add_setting('df_magz_theme_options[logo][fav_icon]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'absint',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][retina_logo_header_1]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][logo_header_1]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][retina_logo_header_2]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][logo_header_2]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						'capability' => 'edit_theme_options',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][retina_logo_header_3]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][logo_header_3]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][retina_logo_header_4]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][logo_header_4]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][retina_logo_header_5]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][logo_header_5]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][retina_logo_header_6]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][logo_header_6]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][sticky_header]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][retina_sticky_header]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][mobile_logo]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[logo][retina_mobile_logo]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][enable_side_area]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_attr'));
		$wp_customize->add_setting('df_magz_theme_options[side_area][background][color]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_hex_color',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][background][position]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_html',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][background][repeat]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_html',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][background][attachment]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_html',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][background][size]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_html',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][background][image]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_url',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][widget_title]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_hex_color',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][heading_element_color]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_hex_color',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][heading_paragraph_color]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_hex_color',
						));
		$wp_customize->add_setting('df_magz_theme_options[side_area][link_color]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'sanitize_hex_color',
						));
		$wp_customize->add_setting('df_magz_theme_options[global][background_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage',
						));
		$wp_customize->add_setting('df_magz_theme_options[color_style][general][main_accent_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[color_style][general][body_p_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[color_style][general][heading_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[color_style][general][body_background_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[color_style][general][extra_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[color_style][general][blockquote_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[color_style][button][button]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[color_style][button][button_text]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[color_style][button][button_hover]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[color_style][button][button_text_hover]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[sidebars][background_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[sidebars][widget_title_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[sidebars][heading_element_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[sidebars][p_element_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[sidebars][link_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[sidebars][extra_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[sidebars][border_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][background][color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][background][position]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'esc_html',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][background][repeat]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'esc_html',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][background][attachment]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'esc_html',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][background][size]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'esc_html',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][background][image]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'sanitize_url',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][footer_widget_title_color]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][footer_link_color]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][footer_heading_color]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][footer_p_color]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][footer_border_color]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][top_border][color]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][top_border][border]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_attr',
						));
		$wp_customize->add_setting('df_magz_theme_options[footer][top_border][style]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_attr',
						));
		$wp_customize->add_setting('df_magz_theme_options[footer][bottom_border][color]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][bottom_border][border]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'esc_attr',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][bottom_border][style]',
						array(
						'type' => 'option',
						'transport' => 'postMessage',
						'sanitize_callback' => 'esc_attr',
						));
		$wp_customize->add_setting('df_magz_theme_options[footer][subfooter][background][color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][subfooter][background][position]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'esc_html',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][subfooter][background][repeat]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'esc_html',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][subfooter][background][attachment]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'esc_html',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][subfooter][background][size]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'esc_html',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][subfooter][background][image]',
						array(
						'type' => 'option',
						'sanitize_callback' => 'sanitize_url',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('df_magz_theme_options[footer][subfooter_text_color]',
						array(
						'default' => '#fff',
						'type' => 'option',
						'sanitize_callback' => 'sanitize_hex_color',
						'transport' => 'postMessage'));
		$wp_customize->add_setting('subtitle_general_color', array('default' =>'Subtitle' , 'sanitize_callback' => 'esc_html'));
		$wp_customize->add_setting('subtitle_button_color', array('default' =>'Subtitle' , 'sanitize_callback' => 'esc_html'));
		$wp_customize->add_setting('subtitle_footer_color', array('default' =>'Subtitle' , 'sanitize_callback' => 'esc_html'));
		$wp_customize->add_setting('subtitle_subfooter_color', array('default' =>'Subtitle' , 'sanitize_callback' => 'esc_html'));
		$wp_customize->add_setting('subtitle_sidearea_background', array('default' =>'Subtitle' , 'sanitize_callback' => 'esc_html'));
		$wp_customize->add_setting('subtitle_sidearea_color', array('default' =>'Subtitle' , 'sanitize_callback' => 'esc_html'));
		/**
		 * End Add Setting
		 */
		 
		/**
		 * Start Add Control
		 */
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[global][background_color]', array(
						'label' => __('Edit Background Color', 'onfleek'),
						'section' => 'Df_Genereal_Colors',
						'settings' => 'df_magz_theme_options[global][background_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[global][link_textcolor]', array(
						'label' => __('Edit Link Color', 'onfleek'),
						'section' => 'Df_Genereal_Colors',
						'settings' => 'df_magz_theme_options[global][link_textcolor]')));
		$wp_customize->add_control(new WP_Customize_Site_Icon_Control($wp_customize,
						'df_magz_theme_options[logo][fav_icon]', array(
						'label' => __('Fav Icon', 'onfleek'),
						'description' => __('For Better Result. Icons must be square, and at least 512px wide and tall.',
										'onfleek'),
						'section' => 'df_customize_fav_icon',
						'settings' => 'df_magz_theme_options[logo][fav_icon]',
						'priority' => 60,
						'height' => 512,
						'width' => 512,
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][logo_header_1]', array(
						'label' => __('Logo Header 1', 'onfleek'),
						'description' => __('For Header Logo 1  Please Input File ',
										'onfleek'),
						'section' => 'df_customize_logo_header_1',
						'settings' => 'df_magz_theme_options[logo][logo_header_1]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][retina_logo_header_1]', array(
						'label' => __('Retina Logo Header 1', 'onfleek'),
						'description' => __('For Retina Logo Header 1 Please Input File With @2x Before Ext File ',	'onfleek'),
						'section' => 'df_customize_logo_header_1',
						'settings' => 'df_magz_theme_options[logo][retina_logo_header_1]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][logo_header_2]', array(
						'label' => __('Logo Header 2', 'onfleek'),
						'description' => __('For Desktop Logo 2 , Please Input File ',
										'onfleek'),
						'section' => 'df_customize_logo_header_2',
						'settings' => 'df_magz_theme_options[logo][logo_header_2]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][retina_logo_header_2]', array(
						'label' => __('Retina Logo Header 2', 'onfleek'),
						'description' => __('For Retina Logo Header 2, Please Input File With @2x Before Ext File ',
										'onfleek'),
						'section' => 'df_customize_logo_header_2',
						'settings' => 'df_magz_theme_options[logo][retina_logo_header_2]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][logo_header_3]', array(
						'label' => __('Logo Header 3', 'onfleek'),
						'description' => __('For Desktop Logo Header 3 , Please Input File ',
										'onfleek'),
						'section' => 'df_customize_logo_header_3',
						'settings' => 'df_magz_theme_options[logo][logo_header_3]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][retina_logo_header_3]', array(
						'label' => __('Retina Logo Header 3', 'onfleek'),
						'description' => __('For Retina Logo Header 3 , Please Input File With @2x Before Ext File ',
										'onfleek'),
						'section' => 'df_customize_logo_header_3',
						'settings' => 'df_magz_theme_options[logo][retina_logo_header_3]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][logo_header_4]', array(
						'label' => __('Logo Header 4', 'onfleek'),
						'description' => __('For Desktop Logo Header 4 , Please Input File ',
										'onfleek'),
						'section' => 'df_customize_logo_header_4',
						'settings' => 'df_magz_theme_options[logo][logo_header_4]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][retina_logo_header_4]', array(
						'label' => __('Retina Logo Header 4', 'onfleek'),
						'section' => 'df_customize_logo_header_4',
						'settings' => 'df_magz_theme_options[logo][retina_logo_header_4]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][logo_header_5]', array(
						'label' => __('Logo Header 5 & 6 Light', 'onfleek'),
						'section' => 'df_customize_logo_header_5&6_light',
						'settings' => 'df_magz_theme_options[logo][logo_header_5]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][retina_logo_header_5]', array(
						'label' => __('Retina Logo Header 5 & 6 Light', 'onfleek'),
						'section' => 'df_customize_logo_header_5&6_light',
						'settings' => 'df_magz_theme_options[logo][retina_logo_header_5]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][logo_header_6]', array(
						'label' => __('Logo Header 5&6 Dark', 'onfleek'),
						'section' => 'df_customize_logo_header_5&6_dark',
						'settings' => 'df_magz_theme_options[logo][logo_header_6]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][retina_logo_header_6]', array(
						'label' => __('Retina Logo Header 5 & 6 Dark', 'onfleek'),
						'section' => 'df_customize_logo_header_5&6_dark',
						'settings' => 'df_magz_theme_options[logo][retina_logo_header_6]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][sticky_header]', array(
						'label' => __(' Logo Desktop For Sticky Header', 'onfleek'),
						'section' => 'df_customize_sticky_header',
						'settings' => 'df_magz_theme_options[logo][sticky_header]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][retina_sticky_header]', array(
						'label' => __('Retina Logo For Sticky Header', 'onfleek'),
						'section' => 'df_customize_sticky_header',
						'settings' => 'df_magz_theme_options[logo][retina_sticky_header]',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][mobile_logo]', array(
						'label' => __('Mobile Logo', 'onfleek'),
						'section' => 'df_customize_mobile_logo',
						)));
		$wp_customize->add_control(new WP_RetinaLogo_Control($wp_customize,
						'df_magz_theme_options[logo][retina_mobile_logo]', array(
						'label' => __('Retina Logo For Mobile', 'onfleek'),
						'section' => 'df_customize_mobile_logo',
						'settings' => 'df_magz_theme_options[logo][retina_mobile_logo]',
						)));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[side_area][enable_side_area]', array(
						'type' => 'radio',
						'label' => __('Show Or Hide Side Area', 'onfleek'),
						'section' => 'df_side_area',
						'settings' => 'df_magz_theme_options[side_area][enable_side_area]',
						'choices' => array('yes' => 'Yes', 'no' => 'No'))));
		$wp_customize->add_control(new df_subtitle($wp_customize,
						'subtitle_sidearea_background', array('label' => __('Side Area Background',
										'onfleek'), 'section' => 'df_side_area')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[side_area][background][color]', array(
						'label' => __(' Background Color Side Area', 'onfleek'),
						'section' => 'df_side_area',
						'settings' => 'df_magz_theme_options[side_area][background][color]')));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[side_area][background][position]', array(
						'type' => 'select',
						'label' => __(' Background Posisition', 'onfleek'),
						'section' => 'df_side_area',
						'settings' =>   'df_magz_theme_options[side_area][background][position]',
						'choices' => array(
										' top left ' => ' Top Left ',
										' top center ' => ' Top Center ',
										' top right ' => 'Top Right',
										' center left ' => 'Center Left',
										' center center' => 'Center Center',
										' center right ' => 'Center Right',
										' bottom left ' => 'Bottom Left',
										' bottom center' => ' Bottom Center',
										' bottom right' => 'Bottom Right'))));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[side_area][background][repeat]', array(
						'type' => 'select',
						'label' => __(' Background Repeat', 'onfleek'),
						'section' => 'df_side_area',
						'settings' => 'df_magz_theme_options[side_area][background][repeat]',
						'choices' => array(
										' repeat ' => ' Repeat ',
										' repeat-x ' => ' Repeat X ',
										' repeat-y ' => 'Repeat Y',
										' no-repeat ' => 'No Repeat'))));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[side_area][background][attachment]', array(
						'type' => 'select',
						'label' => __(' Background Attachment', 'onfleek'),
						'section' =>    'df_side_area',
						'settings' =>   'df_magz_theme_options[side_area][background][attachment]',
						'choices' => array(
										' scroll ' => ' Scroll ',
										' fixed ' => ' Fixed ',
										' local ' => 'Local'))));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[side_area][background][size]', array(
						'type' => 'select',
						'label' => __(' Background Size', 'onfleek'),
						'section' => 'df_side_area',
						'settings' => 'df_magz_theme_options[side_area][background][size]',
						'choices' => array(
										' ' => '  Background Size',
										' auto ' => ' Auto ',
										' cover ' => ' Cover ',
										' contain ' => 'Contain'))));
		$wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize,
						'df_magz_theme_options[side_area][background][image]', array(
						'label' => __('Background Image For Side Area', 'onfleek'),
						'description' => __(' Upload Image For Background Side Area',
										'onfleek'),
						'section' => 'df_side_area',
						'settings' => 'df_magz_theme_options[side_area][background][image]',
						)));
		$wp_customize->add_control(new df_subtitle($wp_customize,
						'subtitle_sidearea_color', array('label' => __('Side Area Color',
										'onfleek'), 'section' => 'df_side_area')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[side_area][widget_title]', array(
						'label' => __(' Color Widget Title In Sidearea', 'onfleek'),
						'section' => 'df_side_area',
						'settings' => 'df_magz_theme_options[side_area][widget_title]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[side_area][heading_element_color]', array(
						'label' => __(' Color Heading Sidearea', 'onfleek'),
						'section' => 'df_side_area',
						'settings' =>
										'df_magz_theme_options[side_area][heading_element_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[side_area][heading_paragraph_color]', array(
						'label' => __(' Color Paragraph In Sidearea', 'onfleek'),
						'section' => 'df_side_area',
						'settings' =>
										'df_magz_theme_options[side_area][heading_paragraph_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[side_area][link_color]', array(
						'label' => __(' Color Link In Side Area', 'onfleek'),
						'section' => 'df_side_area',
						'settings' => 'df_magz_theme_options[side_area][link_color]')));
		$wp_customize->add_control(new df_subtitle($wp_customize,
						'subtitle_general_color', array('label' => __('General Color',
										'onfleek'), 'section' => 'df_color_general')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[color_style][general][main_accent_color]',
						array(
						'label' => __(' Main Accent Color', 'onfleek'),
						'section' => 'df_color_general',
						'settings' =>   'df_magz_theme_options[color_style][general][main_accent_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[color_style][general][body_p_color]', array(
						'label' => __(' Body Text Color', 'onfleek'),
						'section' =>    'df_color_general',
						'settings' =>   'df_magz_theme_options[color_style][general][body_p_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[color_style][general][heading_color]', array
						(
						'label' => __(' Heading Color', 'onfleek'),
						'section' => 'df_color_general',
						'settings' =>
										'df_magz_theme_options[color_style][general][heading_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[color_style][general][extra_color]', array(
						'label' => __(' Extra Color', 'onfleek'),
						'section' => 'df_color_general',
						'settings' =>
										'df_magz_theme_options[color_style][general][extra_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[color_style][general][blockquote_color]',
						array(
						'label' => __(' Blockquote Color', 'onfleek'),
						'section' =>    'df_color_general',
						'settings' =>   'df_magz_theme_options[color_style][general][blockquote_color]')));
		$wp_customize->add_control(new df_subtitle($wp_customize,
						'subtitle_button_color', array('label' => __('Button Color',
										'onfleek'), 'section' => 'df_color_general')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[color_style][button][button]', array(
						'label' => __(' Button Color', 'onfleek'),
						'section' => 'df_color_general',
						'settings' => 'df_magz_theme_options[color_style][button][button]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[color_style][button][button_text]', array(
						'label' => __(' Button Text Color', 'onfleek'),
						'section' => 'df_color_general',
						'settings' =>
										'df_magz_theme_options[color_style][button][button_text]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[color_style][button][button_hover]', array(
						'label' => __(' Button Hover Color', 'onfleek'),
						'section' => 'df_color_general',
						'settings' =>
										'df_magz_theme_options[color_style][button][button_hover]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[color_style][button][button_text_hover]',
						array(
						'label' => __(' Button Text Hover Color', 'onfleek'),
						'section' =>    'df_color_general',
						'settings' =>   'df_magz_theme_options[color_style][button][button_text_hover]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[sidebars][background_color]', array(
						'label' => __('Sidebars Background Color', 'onfleek'),
						'section' => 'df_sidebar',
						'settings' => 'df_magz_theme_options[sidebars][background_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[sidebars][widget_title_color]', array(
						'label' => __('Sidebars Widget Title Color', 'onfleek'),
						'section' => 'df_sidebar',
						'settings' => 'df_magz_theme_options[sidebars][widget_title_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[sidebars][heading_element_color]', array(
						'label' => __('Sidebar Heading Text Color', 'onfleek'),
						'section' => 'df_sidebar',
						'settings' =>   'df_magz_theme_options[sidebars][heading_element_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[sidebars][heading_element_color]', array(
						'label' => __('Sidebar Heading Text Color', 'onfleek'),
						'section' => 'df_sidebar',
						'settings' =>   'df_magz_theme_options[sidebars][heading_element_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[sidebars][p_element_color]', array(
						'label' => __('Sidebar Paragraph Color', 'onfleek'),
						'section' => 'df_sidebar',
						'settings' => 'df_magz_theme_options[sidebars][p_element_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[sidebars][link_color]', array(
						'label' => __('Sidebar Link Color', 'onfleek'),
						'section' => 'df_sidebar',
						'settings' => 'df_magz_theme_options[sidebars][link_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[sidebars][extra_color]', array(
						'label' => __('Sidebar Extra Color', 'onfleek'),
						'section' => 'df_sidebar',
						'settings' => 'df_magz_theme_options[sidebars][extra_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[sidebars][border_color]', array(
						'label' => __('Sidebar Border Color', 'onfleek'),
						'section' => 'df_sidebar',
						'settings' => 'df_magz_theme_options[sidebars][border_color]')));
		$wp_customize->add_control(new df_subtitle($wp_customize,
						'subtitle_footer_color', array('label' => __('Footer Color',
										'onfleek'), 'section' => 'df_footer')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][background][color]', array(
						'label' => __('Footer Background Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][background][color]')));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][background][position]', array(
						'type' => 'select',
						'label' => __(' Background Posisition', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][background][position]',
						'choices' => array(
										' top left ' => ' Top Left ',
										' top center ' => ' Top Center ',
										' top right ' => 'Top Right',
										' center left ' => 'Center Left',
										' center center' => 'Center Center',
										' center right ' => 'Center Right',
										' bottom left ' => 'Bottom Left',
										' bottom center' => ' Bottom Center',
										' bottom right' => 'Bottom Right'))));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][background][repeat]', array(
						'type' => 'select',
						'label' => __(' Background Repeat', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][background][repeat]',
						'choices' => array(
										' repeat ' => ' Repeat ',
										' repeat-x ' => ' Repeat X ',
										' repeat-y ' => 'Repeat Y',
										' no-repeat ' => 'No Repeat'))));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][background][attachment]', array(
						'type' => 'select',
						'label' => __(' Background Attachment', 'onfleek'),
						'section' => 'df_footer',
						'settings' =>   'df_magz_theme_options[footer][background][attachment]',
						'choices' => array(
										' scroll ' => ' Scroll ',
										' fixed ' => ' Fixed ',
										' local ' => 'Local'))));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][background][size]', array(
						'type' => 'select',
						'label' => __(' Background Size', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][background][size]',
						'choices' => array(
										' ' => '  Background Size',
										' auto ' => ' Auto ',
										' cover ' => ' Cover ',
										' contain ' => 'Contain'))));
		$wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize,
						'df_magz_theme_options[footer][background][image]', array(
						'label' => __('Background Image For Footer', 'onfleek'),
						'description' => __(' Upload Image For Background Side Area',
										'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][background][image]',
						)));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][footer_widget_title_color]', array(
						'label' => __('Footer Widget Title Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' =>
										'df_magz_theme_options[footer][footer_widget_title_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][footer_heading_color]', array(
						'label' => __('Footer Heading Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][footer_heading_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][footer_p_color]', array(
						'label' => __('Footer Paragraph Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][footer_p_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][footer_link_color]', array(
						'label' => __('Footer Link Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][footer_link_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][footer_border_color]', array(
						'label' => __('Footer Border Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][footer_border_color]')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][top_border][color]', array(
						'label' => __('Footer Navigation Top Border Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][top_border][color]')));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][top_border][border]', array(
						'label' => __('Footer Navigation Top Border', 'onfleek'),
						'type' => 'text',
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][top_border][border]')));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][top_border][style]', array(
						'label' => __('Footer Navigation Top Border Style', 'onfleek'),
						'type' => 'select',
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][top_border][style]',
						'choices' => array(
										'' => 'Background Size',
										'dotted' => 'Dotted',
										'dashed' => 'Dashed',
										'solid' => 'Solid',
										'double' => 'Double',
										'groove' => 'Groove',
										'inset' => 'Inset',
										'outset' => 'Outset',
										'none' => 'None',
										'hidden' => 'Hidden',
										'ridge' => 'Ridge',
										))));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][bottom_border][color]', array(
						'label' => __('Footer Navigation Bottom Border Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][bottom_border][color]')));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][bottom_border][border]', array(
						'label' => __('Footer Navigation Bottom Border', 'onfleek'),
						'type' => 'text',
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][bottom_border][border]')));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][bottom_border][style]', array(
						'label' => __('Footer Navigation Bottom Border Style', 'onfleek'),
						'type' => 'select',
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][bottom_border][style]',
						'choices' => array(
										'' => 'Background Size',
										'dotted' => 'Dotted',
										'dashed' => 'Dashed',
										'solid' => 'Solid',
										'double' => 'Double',
										'groove' => 'Groove',
										'inset' => 'Inset',
										'outset' => 'Outset',
										'none' => 'None',
										'hidden' => 'Hidden',
										'ridge' => 'Ridge',
										))));
		$wp_customize->add_control(new df_subtitle($wp_customize,
						'subtitle_subfooter_color', array('label' => __('Sub Footer Color',
										'onfleek'), 'section' => 'df_footer')));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][subfooter][background][color]', array
						(
						'label' => __('Sub Footer Background Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' =>
										'df_magz_theme_options[footer][subfooter][background][color]')));
		//
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][subfooter][background][position]',
						array(
						'type' => 'select',
						'label' => __(' Background Posisition', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][background][position]',
						'choices' => array(
										' top left ' => ' Top Left ',
										' top center ' => ' Top Center ',
										' top right ' => 'Top Right',
										' center left ' => 'Center Left',
										' center center' => 'Center Center',
										' center right ' => 'Center Right',
										' bottom left ' => 'Bottom Left',
										' bottom center' => ' Bottom Center',
										' bottom right' => 'Bottom Right'))));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][subfooter][background][repeat]',
						array(
						'type' => 'select',
						'label' => __(' Background Repeat', 'onfleek'),
						'section' => 'df_footer',
						'settings' =>   'df_magz_theme_options[footer][subfooter][background][repeat]',
						'choices' => array(
										' repeat ' => ' Repeat ',
										' repeat-x ' => ' Repeat X ',
										' repeat-y ' => 'Repeat Y',
										' no-repeat ' => 'No Repeat'))));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][subfooter][background][attachment]',
						array(
						'type' => 'select',
						'label' => __(' Background Attachment', 'onfleek'),
						'section' => 'df_footer',
						'settings' =>   'df_magz_theme_options[footer][subfooter][background][attachment]',
						'choices' => array(
										' scroll ' => ' Scroll ',
										' fixed ' => ' Fixed ',
										' local ' => 'Local'))));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize,
						'df_magz_theme_options[footer][subfooter][background][size]', array
						(
						'type' => 'select',
						'label' => __(' Background Size', 'onfleek'),
						'section' => 'df_footer',
						'settings' =>   'df_magz_theme_options[footer][subfooter][background][size]',
						'choices' => array(
										' ' => '  Background Size',
										' auto ' => ' Auto ',
										' cover ' => ' Cover ',
										' contain ' => 'Contain'))));
		$wp_customize->add_control(new WP_Customize_Upload_Control ($wp_customize,
						'df_magz_theme_options[footer][subfooter][background][image]', array
						(
						'label' => __('Background Image', 'onfleek'),
						'description' => __(' Upload Image For Background Side Area',
										'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][subfooter][background][image]',
						)));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
						'df_magz_theme_options[footer][subfooter_text_color]', array(
						'label' => __('Sub Footer Text Color', 'onfleek'),
						'section' => 'df_footer',
						'settings' => 'df_magz_theme_options[footer][subfooter_text_color]')));
	  /**
	   * End Add Control
	   */
	}

	/**
	 * df_customize::df_customizer_live_preview()
	 * 
	 * @return void
	 */
	public static function df_customizer_live_preview() {
		wp_enqueue_script('dahzcustomizer', get_template_directory_uri() . '/inc/df-core/asset/js/admin/df_preview_customize.js', array('jquery'), null, true);
	}

	function df_customizer_css() {
		?>
		<style>
		.customize-control-label{
			display: block;
			margin: 0 -12px;
			border: 1px solid #ddd;
			border-left: 0;
			border-right: 0;
			padding: 6px 12px 2px;
			font-size: 10px !important;
			font-weight: 600;
			letter-spacing: 2px;
			line-height: 1;
			text-transform: uppercase;
			color: #555;
			background-color: #fff;
			margin-bottom: 20px;
			margin-top: 20px;
		}
		</style>
		<?php
	}
}
new df_customize;