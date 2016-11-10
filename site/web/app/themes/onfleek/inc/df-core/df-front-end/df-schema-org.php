<?php
/**
 * Class: DF_Header
 * Description: Class for call header layout
 */

if( !class_exists('DF_Schema_Org') ){

	Class DF_Schema_Org {

		function __construct() {
			// set open graph meta via wp_head
			add_action( 'wp_head', array( $this, 'df_generate_schema_json_ld') );
		}
		static function df_generate_schema_json_ld() {
			self::df_ld_WPHeader();
			self::df_ld_organization();
			self::df_ld_web_site();
			self::df_ld_WPsidebar();
			self::df_ld_WPFooter();
			if ( is_single() ) {
				self::df_ld_news_article();
				self::df_ld_review();
			}elseif ( is_archive() ) {
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						self::df_ld_news_article();
					endwhile;
				endif;
			}
		} 

		static function df_ld_news_article() {
			global $post;
			$dv_micro_data = get_post_meta( get_the_ID() );
			$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
    		$dv_image_meta = wp_get_attachment_metadata( $post_thumbnail_id );
			$dv_uploads_dir = wp_upload_dir(); 
			$dv_logo = isset( DF_Global_Options::$options['logo']['mobile_logo'] ) ? DF_Global_Options::$options['logo']['mobile_logo'] : NULL;
			$dv_featured_image_ld = '';
			$dv_logo_ld = "";
			$dv_id_logo = DF_Framework::df_get_image_id( $dv_logo );
			if ( !empty( $dv_id_logo ) ) {
				
				$dv_logo_meta = wp_get_attachment_metadata( $dv_id_logo );	
				$dv_logo_ld = '"logo": {
						"@type": "ImageObject",
						"url": "'. $dv_logo .'",
						"height": '. $dv_logo_meta['height']. ',
						"width": '. $dv_logo_meta['width']. '
				    }';
			}else{
				return;
			}

			if (!empty( $dv_image_meta ) ) {
				$dv_featured_image_ld = '"image": {
											"@type": "ImageObject",
											"url": "' . $dv_uploads_dir['baseurl'] .'/' .$dv_image_meta['file'] . '",
											"height": '. $dv_image_meta['height']. ',
											"width": '. $dv_image_meta['width']. '
									},';
			}else{
				return;
			}

			$dv_json_ld = '<script type="application/ld+json">
					{
					  "@context": "http://schema.org",
					  "@type": "NewsArticle",
					  "mainEntityOfPage": {
					    "@type": "WebPage",
					    "@id": "'. get_permalink() .'"
					  },
					  "headline": "' . substr($post->post_title, 0, 110) . '",		  
					  ' . $dv_featured_image_ld . '
					  "datePublished": "'.  $post->post_date_gmt . '",
					  "dateModified": "'.  $post->post_modified . '",
					  "author": {
					    "@type": "Person",
					    "name": "'. get_the_author_meta('nicename' , $post->post_author ).'"
					  },
					   "publisher": {
					    "@type": "Organization",
					    "name": "'. get_bloginfo('name'). '",
					    '. $dv_logo_ld .'
					  },
					  "description": "'. get_the_excerpt().'"
					}
					</script>';
				print_r( $dv_json_ld );
		}

		static function df_ld_web_site(){
			$dv_json_ld = '<script type="application/ld+json">
				{"@context":"http://schema.org",
					"@type":"WebSite",
					"url":"'. get_site_url() .'",
					"name":"'. get_bloginfo('name'). '",
					"potentialAction":{
						"@type":"SearchAction",
						"target":"'. get_site_url() .'/?s={search_term_string}&post_type=post",
						"query-input":"required name=search_term_string"
					}
				}</script>';
			print_r( $dv_json_ld );
		}

		static function df_ld_organization(){

			$dv_logo = isset( DF_Global_Options::$options['logo']['mobile_logo'] ) ? DF_Global_Options::$options['logo']['mobile_logo'] : NULL;

			$dv_social_network = array();
			$dv_accs = DF_Global_Options::$options['social_account']['account'];

			
			foreach( $dv_accs as $dv_acc => $value  ){
				if ( isset( $value ) || $value !== '' || !empty( $value ) ) {
					array_push($dv_social_network, '"' . $value . '"' );
				}
			}

			$dv_social_network = implode (", ", $dv_social_network);
			$dv_json_ld = '<script type="application/ld+json">
				{"@context":"http://schema.org",
					"@type":"Organization",
					"url":"'. get_site_url() .'",
					"name":"'. get_bloginfo('name'). '",
					"logo": "'. $dv_logo .'",
					"sameAs" : [ ' . $dv_social_network . ']
					 	}</script>';
			print_r( $dv_json_ld );
		}

		static function df_ld_WPsidebar(){
			$dv_json_ld = '<script type="application/ld+json">
				{"@context":"http://schema.org",
					"@type":"WPSidebar",
					"@id" : "' . get_permalink(). '/#df-sidebar-wrapper"

				}</script>';
			print_r( $dv_json_ld );	
		}
		static function df_ld_WPHeader(){
			$dv_json_ld = '<script type="application/ld+json">
				{"@context":"http://schema.org",
					"@type":"WPHeader",
					"@id" : "' . get_permalink(). '/#df-header-wrapper"

				}</script>';
			print_r( $dv_json_ld );	
		}
		static function df_ld_WPFooter(){
			$dv_json_ld = '<script type="application/ld+json">
				{"@context":"http://schema.org",
					"@type":"WPFooter",
					"@id" : "' . get_permalink(). '/#df-footer-wrapper"

				}</script>';
			print_r( $dv_json_ld );	
		}

		static function df_ld_review() {
			global $post;
			$sum = 0;
			$dv_review = get_post_meta( get_the_ID(), 'df_magz_post_review_post' , true);
			switch ($dv_review) {
				case "stars":
					$dv_review_value = '_review_stars_value';
					$dv_max_value	 = 5;
				break;
				case "point":
					$dv_review_value = '_review_points_value';
					$dv_max_value	 = 10;
				break;
				case "percentage":
					$dv_review_value = '_review_percent_value';
					$dv_max_value	 = 100;
				break;
				default:
					return;
			}
			$dv_list_review = get_post_meta( get_the_ID(), 'df_magz_post_feature_reviews' , true);

			$count = count( $dv_list_review[$dv_review_value] );
			foreach( $dv_list_review[$dv_review_value] as $value) { 
				$sum = $sum + $value;
			}
			$avg =  $sum / $count ;
			$dv_review_items 	= get_post_meta( get_the_ID(), 'df_magz_post_review_items' , true);
			if( $dv_review_items == '' || empty( $dv_review_items) ) $dv_review_items = $post->post_title;
			$dv_json_ld = '<script type="application/ld+json">
							{
							  "@context": "http://schema.org/",
							  "@type": "Review",
							  "itemReviewed": {
							    "@type": "Thing",
							    "name": "'. $dv_review_items . '"
							  },
							  "author": {
							    "@type": "Person",
							    "name": "'. get_the_author_meta('nicename' , $post->post_author ) .'"
							  },
							  "reviewRating": {
							    "@type": "Rating",
							    "ratingValue": "'. $avg .'",
							    "bestRating": "'.$dv_max_value.'"
							  },
							  "publisher": {
							    "@type": "Organization",
							    "name": "'. get_bloginfo('name'). '"
							  }
							}
							</script>';
			print_r( $dv_json_ld );	
			
		}
	}
}
new DF_Schema_Org();