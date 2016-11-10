<?php
/**
 * Class: DF_Amp_Custom
 * Description: class for customize amp plugin
 */

if( !class_exists('DF_Amp_Custom') ) {

	Class DF_Amp_Custom {

		static $get_meta = array();
		static $review_type = '';
		static $review_summary = '';
		static $list_reviews = array();
		static $review_positive_title = '';
		static $review_name = '';
		static $review_value = '';
		static $avg_review = '';

		static $list_layout = '';
		static $list_show_number = '';
		static $list_items = array();
		static $list_ordering = '';

		/**
		 * function __construct
		 */
		function __construct() {
			add_action( 'amp_post_template_css', array( $this, 'df_style_css' ) );
			add_action( 'pre_amp_render_post', array( $this, 'df_amp_add_custom_actions' ) );
			add_filter( 'amp_post_template_data', array( $this, 'df_set_logo' ) );
			add_action( 'amp_post_template_footer', array( $this, 'df_add_footer_element' ) );
		}

		/**
		 * df_style_css
		 * set style for amp page
		 */
		function df_style_css( $amp_templates ){
			$mobile_header = DF_Options::df_get_header_selected('mobile_header');
			$bg_color = $mobile_header['menu_bg_color'];

			$color_style = DF_Options::df_get_color_style_options();
			$subfooter = $color_style['subfooter'];
			$subfooter_bg = $subfooter['background']['color'];
			$subfooter_text = $color_style['subfooter_text_color'];
			?>
			body{
				padding-bottom:0;
				font-family: 'Helvetica',Arial, sans-serif;
				font-size:13px;
			}
			blockquote {
				background: transparent;
			    padding: 0 15px;
			    margin: 8px 0 24px 0;
			    border-left: 4px solid #e8a633;
			    color: #484848;
			    font-size: 18px;
			    font-weight: bold;
			}
			.amp-wp-title{
				color: #101010;
			}
			.amp-wp-content{
				color: #4e4e4e;
			}
			nav.amp-wp-title-bar{
				padding: 12px 0;
				background: <?php printf( $bg_color );?>;
			}
			nav.amp-wp-title-bar .amp-wp-site-icon{
				border-radius:0;
				margin:0;
			}
			nav.amp-wp-title-bar a {
		        display: block;
		        height: 32px;
		        width: 128px;
		        margin: 0 auto;
		        text-indent: -9999px;
		    }
		    .df-listicle-amp{
			    margin-bottom: 20px;
		    }
		    .df-listicle-amp amp-img{
			    margin-bottom: 20px;
		    }
		    .df-amp-next-post{
		    	padding:20px;
		    	background: <?php printf( $subfooter_bg );?>;
		    	display:block;
		    	text-decoration: none;
		    	text-align:center;
		    	color: <?php printf( $subfooter_text );?>;
		    	bottom:0px;
		    	font-size: 12px;
		    	font-weight: 700;
		    }
		    .df-amp-next-post:link{
		    	color: <?php printf( $subfooter_text );?>;
		    }
		    .df-review-amp{
			    border: 4px solid #e5e5e5;
		    }
		    .df-review-sum-amp{
			    border-top: 1px solid #e5e5e5;
			    padding: 30px;
		    }
		    .df-review-sum-amp h3,
		    .df-review-score-amp h3{
			    margin-top: 0;
		    }
		    .df-review-score-amp{
			    border-top: 1px solid #e5e5e5;
			    padding: 30px;
		    }
		    .df-review-score-amp p{
			    margin-top: 15px;
			    margin-bottom: 0;
		    }
		    .df-review-sum-score-amp{
			    display: table;
			    padding: 30px;
			    width: calc(100% - 60px);
		    }
		    .pull-right{
			    float: right;
		    }
		    .df-review-sum-score-label-amp,
		    .df-review-sum-score-value-amp{
			    display: table-cell;
			    width: 50%;
		    }
		    .df-review-sum-score-value-amp{
			    text-align: right;
		    }
		    .df-review-sum-score-amp h1,
		    .df-review-sum-score-amp h3,
		    .df-review-sum-score-amp p{
			    margin: 0;
		    }
		    .ion-ios-star::before{
			    content: '\f4b3';
			    font-family: 'Ionicons';
			    font-style: normal;
		    }
		    .img-wrapper{
		        margin-bottom: 10px;
		    }
			<?php
		}

		/**
		 * df_set_logo
		 * set logo, replace site icon with mobile header logo from theme option
		 */
		function df_set_logo( $data ){
			$mobile_header = DF_Options::df_get_header_selected('mobile_header');
			$bg_color = $mobile_header['menu_bg_color'];
			$logo = $mobile_header['bg'];
			$logo = DF_Options::df_get_logo_options();
			$logo_mobile = $logo['mobile_logo'];
			$data['site_icon_url'] = $logo_mobile;
			return $data;
		}

		/**
		 * df_amp_add_custom_actions
		 */
		function df_amp_add_custom_actions() {
		    add_filter( 'the_content', array( $this, 'df_custom_content') );
		    add_filter( 'amp_post_template_meta_parts', array( $this, 'df_amp_remove_author_meta' ) );
		    add_filter( 'amp_post_template_file', array( $this, 'df_amp_set_custom_tax_meta_template' ) , 10, 3 );
		}
		

		function df_amp_set_custom_tax_meta_template( $file, $type, $post ) {

		    if ( 'meta-taxonomy' === $type ) {
		        $file = get_template_directory() . '/inc/df-core/df-utils/meta-custom-tax.php';
		    }
		    return $file;
		}

		function df_amp_remove_author_meta( $meta_parts ) {
			$post_setting = DF_Options::df_get_post_setting_options();
			$is_show_date = !isset( $post_setting['is_show_date'] ) ? 'no' : $post_setting['is_show_date'];
			$is_show_author_name = !isset( $post_setting['is_show_author_name'] ) ? 'no' : $post_setting['is_show_author_name'];
			if ($is_show_date == 'no' ){
				foreach ( array_keys( $meta_parts, 'meta-time', true ) as $key ) {
		        unset( $meta_parts[ $key ] );
		    	}
			}
			if ($is_show_author_name == 'no' ){
				foreach ( array_keys( $meta_parts, 'meta-author', true ) as $key ) {
		        unset( $meta_parts[ $key ] );
		    	}
			}
		    return $meta_parts;
		}

		/**
		 * df_custom_content
		 * add featured image to content
		 * - if post has a media embed, replace with media embed
		 */
		function df_custom_content( $content ) {
			$content_output = '';
			$featured = '';
			global $post;
			self::df_get_meta( $post->ID );
			$is_featured_image = self::$get_meta->featured_image;
		    if ( $is_featured_image == 'yes' && has_post_thumbnail($post->ID) ) {
		    	$thumb_id = get_post_thumbnail_id( $post->ID );
		        $img = wp_get_attachment_image_src( $thumb_id, 'large' );
		        $img_src = $img[0];
		        $w = $img[1];
		        $h = $img[2];
		        // $img_src_set = wp_get_attachment_image_srcset( $thumb_id, 'medium' );
		        $featured = sprintf( '<amp-img id="df-amp-featured-img" src="%s" width="%d" height="%d" layout="responsive" ></amp-img>',  $img_src, $w, $h );
		        // Just add the raw <img /> tag; our sanitizer will take care of it later.
		        // $image = sprintf( '<p class="df-featured-image">%s</p>', get_the_post_thumbnail($post->ID, $size='') );
		    }
		        /* if post has media embed (from custom metabox), replace featured with media embed */
		        $media_embed = get_post_meta( $post->ID, 'df_magz_post_media_embed', true );
		        if( !empty($media_embed) || $media_embed != '' ){
		        	$get_embed = wp_oembed_get( $media_embed );
		        	$featured = $get_embed;
		        }
		        $content_output .= self::df_render_ads_before_featured_image();
		        $content_output .= $featured;
		        $content_output .= $content;
		        
		        

  		        self::df_get_listicle_amp();
  		        if( self::$list_layout != 'no-smart-list' ) :
  		        	$listicle_params = array(
  		        		'show_number' => self::$list_show_number,
  		        		'ordering' => self::$list_ordering,
  		        		'list_items' => self::$list_items
  		        	);
  		        	$content_output .= self::df_render_listicle_amp( $listicle_params );
  		        endif;
  		        $content_output .= self::df_render_ads_after_content();
		        self::df_get_review_amp();
		        if( self::$review_type !== 'disable' ) :
			        $review_params = array(
			        		'review_type' => self::$review_type,
			        		'review_name' => self::$review_name,
			        		'review_value' => self::$review_value,
			        		'review_summary' => self::$review_summary,
			        		'review_conclusion' => self::$review_positive_title,
			        		'avg_review' => self::$avg_review
			        );
			        $content_output .= self::df_render_review_amp( $review_params );
		        endif;
		    
		    return $content_output;
		}

		/**
		 * df_add_footer_element
		 * add next article link on footer
		 */
		function df_add_footer_element( $amp_template ) {
		    $post_id = $amp_template->get( 'post_id' );

		    $next_post = get_next_post();
			if( !empty( $next_post ) ){
				$next_post_url = get_permalink( get_adjacent_post( false,'',false )->ID );
				$next_post_title = get_the_title( get_adjacent_post( false, '', false )->ID );
		    ?>
		   		<a href="<?php echo esc_url( $next_post_url );?>/amp" class="df-amp-next-post">
		   			<?php echo  __('Next: ' , 'onfleek') .  $next_post_title;?>
		   		</a>
		    <?php
		    }
		}

		/**
		 * df_get_meta
		 * get metabox value based on post_id
		 * @params $post_id
		 * @return void
		 */
		static function df_get_meta( $post_id ){
			$metabox = new DF_get_metabox();
			$metabox->df_get_post_meta_value( $post_id );
			self::$get_meta = $metabox;
		}

		/**
		 * df_get_review_amp
		 * get review's post
		 */
		static function df_get_review_amp(){
	        self::$review_type = self::$get_meta->review;

	        if ( 'disable' !== self::$review_type ) :

				self::$review_summary = self::$get_meta->summary;
				self::$list_reviews = self::$get_meta->feature_name;
				self::$review_positive_title = self::$get_meta->review_conclusion;

				switch( self::$review_type ){
					case 'percentage':
						self::$review_name = self::$list_reviews['_review_percent_name'];
						self::$review_value = self::$list_reviews['_review_percent_value'];
						self::$avg_review = self::df_avg_review( self::$review_value ) . ' %';
						break;
					case 'point':
						self::$review_name = self::$list_reviews['_review_points_name'];
						self::$review_value = self::$list_reviews['_review_points_value'];
						self::$avg_review = self::df_avg_review( self::$review_value ) . ' ';
						break;
					case 'stars':
						self::$review_name = self::$list_reviews['_review_stars_name'];
						self::$review_value = self::$list_reviews['_review_stars_value'];
						self::$avg_review = self::df_avg_review( self::$review_value ) . ' <i class="ion-ios-star"></i>';
						break;
				}

			endif;
		}

		/**
		 * df_render_review_amp
		 * render review feature from metabox
		 */
		static function df_render_review_amp( $review_params ){
			extract( $review_params );
			$output = '';
			$i = 0;
			$output .= '<div class="df-review-amp">';
			$output .= '<div class="df-review-sum-score-amp">';
			$output .= '<div class="df-review-sum-score-label-amp"><h3>' . __( 'SCORE' , 'onfleek') . '</h3></div>';
			$output .= '<div class="df-review-sum-score-value-amp">';
			$output .= '<h1>' .$avg_review. '</h1>';
			$output .= '<p>'.$review_conclusion.'</p>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="df-review-score-amp"><h3>' . __( 'REVIEW' , 'onfleek') . '</h3>';
			foreach( $review_name as $rev_name ){
				$output .= '<p>'. $rev_name;
				$output .= '<span class="pull-right">'. $review_value[$i] . '</span></p>';
				$i++;
			}
			$output .= '</div>';
			$output .= '<div class="df-review-sum-amp"><h3>' . __( 'SUMMARY & RESULTS' , 'onfleek') . '</h3>';
			$output .= '<div>'.$review_summary.'</div>';
			$output .= '</div>';
			$output .= '</div>';
			return $output;
		}

		/**
		 * df_avg_review
		 * get review's average value
		 */
		static function df_avg_review( $review_value ){
			$sum = 0;
			$count = count( $review_value );
			foreach( $review_value as $value) {
				$sum = $sum + $value;
			}
			$avg =  $sum / $count ;
			$avg = number_format( $avg, 1, '.', '');
			return $avg;
		}

		/**
		 * df_get_listicle_amp
		 * @return void
		 */
		static function df_get_listicle_amp() {
			self::$list_layout = self::$get_meta->listicle_layout;

			if( self::$list_layout != 'no-smart-list' ) :
				self::$list_show_number = self::$get_meta->show_number;
				self::$list_ordering = self::$get_meta->ordering;
				self::$list_items = self::$get_meta->list_listicle;
			endif;
		}

		/**
		 * df_render_listicle_amp
		 * render listicle feature from metabox
		 */
		static function df_render_listicle_amp( $listicle_params ){
			extract( $listicle_params );
			$output = '';
			$i = ( $ordering == 'asc' ) ? 0 : (count( $list_items ) - 1);
			foreach( $list_items as $item ){
				$output .= '<div class="df-listicle-amp">';
				$output .= '<h3>';
				$output .= ( strtolower( $show_number ) == 'enable' ) ? esc_html($i+1) . '.&nbsp;' : '' ;
				$output .= $item['df_magz_post_listicle_title'];
				$output .= '</h3>';

				$img_id = $item['df_magz_post_listicle_image_id'];
		        $img = wp_get_attachment_image_src( $img_id, 'large' );
		        $img_src = $img[0];
		        $w = $img[1];
		        $h = $img[2];
		        $list_img = sprintf( '<amp-img id="df-amp-img-%d" src="%s" width="%d" height="%d" layout="responsive" ></amp-img>', ($i+1), $img_src, $w, $h );

		        $output .= $list_img;
		        $output .= $item['df_magz_post_listicle_description'];

				if( $ordering == 'asc' ) :
					$i++;
				else:
					$i--;
				endif;

				$output .= '</div>';
			}
			return $output;
		}

		static function df_render_ads_before_featured_image(){
			$ads = DF_Global_Options::$options['advertisment'];
			$advertisment_img = $ads['amp_before_featured_image_advertisment_img'];
			$advertisment_alt = $ads['amp_before_featured_image_advertisment_alt'];
			$advertisment_url = $ads['amp_before_featured_image_advertisment_url'];
			$advertisment_googlecode = $ads['amp_before_featured_image_advertisment_googlecode'];
			$adscontent = "";
			if ( '' != $advertisment_googlecode ) {
				$adscontent =  stripslashes_deep ( $advertisment_googlecode ); 
			}else{
				
				if (!empty($advertisment_img) && $advertisment_img !== '' ){
					$image_id = DF_Content::df_get_image_id($advertisment_img);
					$img = wp_get_attachment_image_src( $image_id, 'large' );
		        	$img_src = $img[0];
		        	$w = $img[1];
		        	$h = $img[2];
		        	$adscontent = sprintf( '<div class="img-wrapper"><a href="%s"><amp-img id="df-amp-img-%d" src="%s" width="%d" height="%d" layout="responsive" ></amp-img></a></div>', esc_url( $advertisment_url ), ($i+1), $img_src, $w, $h );
				}
			}
			return $adscontent; 
		}

		static function df_render_ads_after_content(){
			$ads = DF_Global_Options::$options['advertisment'];
			$advertisment_img = $ads['amp_after_content_advertisment_img'];
			$advertisment_alt = $ads['amp_after_content_advertisment_alt'];
			$advertisment_url = $ads['amp_after_content_advertisment_url'];
			$advertisment_googlecode = $ads['amp_after_content_advertisment_googlecode'];
			$adscontent = "";
			if ( '' != $advertisment_googlecode ) {
				$adscontent =  stripslashes_deep ( $advertisment_googlecode ); 
			}else{
				
				if (!empty($advertisment_img) && $advertisment_img !== '' ){
					$image_id = DF_Content::df_get_image_id($advertisment_img);
					$img = wp_get_attachment_image_src( $image_id, 'large' );
		        	$img_src = $img[0];
		        	$w = $img[1];
		        	$h = $img[2];
		        	$adscontent = sprintf( '<div class="img-wrapper"><a href="%s"><amp-img id="df-amp-img-%d" src="%s" width="%d" height="%d" layout="responsive" ></amp-img></a></div>', esc_url( $advertisment_url ), ($i+1), $img_src, $w, $h );
				}
			}
			return $adscontent; 
			
		}

	}
	new DF_Amp_Custom();
}
/* file location: /your/file/location/[file].php */
