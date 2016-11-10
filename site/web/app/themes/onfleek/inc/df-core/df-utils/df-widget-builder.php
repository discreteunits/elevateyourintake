<?php
/**
 * Class: DF_Widget_Builder
 * Description: class for build custom widget by dahz theme
 */

if( !class_exists('DF_Widget_Builder') ) {

	require get_template_directory() . '/inc/df-core/df-utils/df-widget/df-widget-author.php';
	require get_template_directory() . '/inc/df-core/df-utils/df-widget/df-widget-slide.php';
	require get_template_directory() . '/inc/df-core/df-utils/df-widget/df-widget-pop-trend.php';
	require get_template_directory() . '/inc/df-core/df-utils/df-widget/df-widget-most-pop.php';
	require get_template_directory() . '/inc/df-core/df-utils/df-widget/df-widget-recent-review.php';
	require get_template_directory() . '/inc/df-core/df-utils/df-widget/df-widget-advertisement300.php';
	require get_template_directory() . '/inc/df-core/df-utils/df-widget/df-widget-advertisement125.php';
	require get_template_directory() . '/inc/df-core/df-utils/df-widget/df-widget-block.php';

	Class DF_Widget_Builder {

		function __construct() {
			add_action( 'widgets_init', array( $this, 'df_reg_widget_author' ) );
			add_action( 'widgets_init', array( $this, 'df_reg_widget_slide') );
			add_action( 'widgets_init', array( $this, 'df_reg_widget_pop_trend') );
			add_action( 'widgets_init', array( $this, 'df_reg_widget_most_pop') );
			add_action( 'widgets_init', array( $this, 'df_reg_widget_recent_review') );
			add_action( 'widgets_init', array( $this, 'df_reg_widget_advertisement300' ) );
			add_action( 'widgets_init', array( $this, 'df_reg_widget_advertisement125' ) );
			add_action( 'widgets_init', array( $this, 'df_reg_widget_block' ) );
			add_filter( 'wp_list_categories', array($this, 'df_cat_count_span') );
			add_filter( 'get_archives_link', array($this, 'df_archive_count_span') );
			add_filter( 'get_calendar', array($this, 'df_cal_count_span') );
			add_filter( 'excerpt_length', array($this, 'wpdocs_custom_excerpt_length'), 999 );
			add_filter( 'excerpt_more',  array($this, 'df_new_excerpt_more') );
		}

		function df_reg_widget_author(){
			DF_Widget_Author::df_set_widget( 'DF_Widget_Author', 'DF Widget Author', 'Widget for Author' );
			register_widget( 'DF_Widget_Author' );
		}

		function df_reg_widget_slide(){
			DF_Widget_Slide::df_set_widget( 'DF_Widget_Slide', 'DF Widget Slide', 'Widget for load post in slider' );
			register_widget( 'DF_Widget_Slide' );
		}


		function df_reg_widget_pop_trend(){
			DF_Widget_Pop_Trend::df_set_widget( 'DF_Widget_Pop_Trend', 'DF Widget Popular / Trending / Hot', 'Widget for display Popular / Trending / Hot Posts' );
			register_widget( 'DF_Widget_Pop_Trend' );
		}

		function df_reg_widget_most_pop(){
			DF_Widget_Most_Pop::df_set_widget( 'DF_Widget_Most_Pop', 'DF Widget Most Popular Post', 'Widget for display Most Popular Posts' );
			register_widget( 'DF_Widget_Most_Pop' );
		}

		function df_reg_widget_recent_review(){
			DF_Widget_Recent_Review::df_set_widget( 'DF_Widget_Recent_Review', 'DF Widget Recent Reviews', 'Widget for display Recent Reviews' );
			register_widget( 'DF_Widget_Recent_Review' );
		}
		
		function df_reg_widget_advertisement300(){
			DF_Widget_Advertisement_300::df_set_widget( 'DF_Widget_Advertisement_300', 'DF Widget Advertisement 300', 'Widget for Advertisement' );
			register_widget( 'DF_Widget_Advertisement_300' );
		}

		function df_reg_widget_advertisement125(){
			DF_Widget_Advertisement_125::df_set_widget( 'DF_Widget_Advertisement_125', 'DF Widget Advertisement 125', 'Widget for Advertisement' );
			register_widget( 'DF_Widget_Advertisement_125' );
		}

		function df_reg_widget_block(){
			DF_Widget_Block::df_set_widget( 'DF_Widget_Block', 'DF Widget Block', 'Widget Block' );
			register_widget( 'DF_Widget_Block' );
		}
		function df_cat_count_span($links) {
			$links = str_replace('</a> (', '<span>', $links);
			$links = str_replace(')', '</span></a>', $links);
			return $links;
		}
		function df_archive_count_span($links) {
			$links = str_replace('</a>&nbsp;(', '<span>', $links);
			$links = str_replace(')', '</span></a>', $links);
			return $links;
		}
		function df_cal_count_span($links) {
			$links = str_replace('">&laquo;', '"><i class = "ion-chevron-left"></i>&nbsp;&nbsp;', $links);
			$links = str_replace('&raquo;</a>', '&nbsp;&nbsp;<i class = "ion-chevron-right"></i></a>', $links);
			return $links;
		}
		function wpdocs_custom_excerpt_length( $length ) {
		    return 20;
		}
		function df_new_excerpt_more($excerpt) 
		{
			return ' ...';
		}
	}

	new DF_Widget_Builder();

}

/* file location: /inc/df-core/df-utils/df-widget-builder.php */