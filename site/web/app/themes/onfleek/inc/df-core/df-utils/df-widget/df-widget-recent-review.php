<?php
/**
 * Class: DF_Widget_Popular_Cat
 * Description: class for generate widget popular categories
 */

if( !class_exists('DF_Widget_Recent_Review') ) {

	Class DF_Widget_Recent_Review extends WP_Widget{

		static $widget_baseID;
		static $widget_name;
		static $widget_desc;

		function __construct() {
			$widget_details = array(
				'description' => self::get_widget_desc()
			);
			parent::__construct(
				self::get_widget_baseID(),
				self::get_widget_name(),
				$widget_details
			);
		}

		static function df_set_widget( $baseID, $name, $desc ) {
			self::$widget_baseID	= $baseID;
			self::$widget_name		= $name;
			self::$widget_desc		= $desc;
		}

		function get_widget_baseID(){
			return self::$widget_baseID;
		}

		function get_widget_name(){
			return self::$widget_name;
		}

		function get_widget_desc(){
			return self::$widget_desc;
		}

		/**
		 * widget
		 * for displaying widget front end
		 */
		public function widget( $args, $instance ) {
			extract( $args );
			$title					= apply_filters('widget_title', $instance['title'] );
			$limit_post_review		= $instance['limit_post_review'];
			$select_style_review	= $instance['select_style_review'];
			printf( $before_widget );
			$sticky 	= get_option( 'sticky_posts' );
			$args_query = array( 
				'posts_per_page'	=> $limit_post_review,
				'meta_query'		=> array(
						array(
							'key'		=> 'df_magz_post_review_post',
							'value'		=> 'disable',
							'compare'	=> '!='
						)
					),
			);
			$post_review = new WP_Query( $args_query );
			
			if ( $post_review->have_posts() ) {
			?>
			<div class="<?php echo esc_attr( ( '1' == $select_style_review ) ? 'df-widget-recent-review style-list' : 'df-widget-recent-review' );?>">
				<h5 class="df-widget-title"><?php echo esc_html( $title ); ?></h5>
			<?php
			printf( ( '1' == $select_style_review ) ? '<ul>' : '' ); 
				while( $post_review->have_posts() ): $post_review->the_post();
					$review_status = get_post_meta( get_the_ID(), 'df_magz_post_review_post', true );
					if ( ( !empty( $review_status ) || '' != $review_status ) ) {
						if ( 'disable' != $review_status ) {
							$value_review	= '';
							$review_feature = get_post_meta( get_the_ID(), 'df_magz_post_feature_reviews', true );
							/**
							 * reviews stars
							 */
							if ( 'stars' == $review_status ) {
								$sum			= 0;
								$count_stars	= count( $review_feature['_review_stars_value'] );
								foreach( $review_feature['_review_stars_value'] as $value) { 
									$sum		= $sum + $value;
								}
								if ( '1' == $select_style_review ){
									$value_review = '
										<div class="df-meta-score star-rating">
											' . number_format( $sum / $count_stars, 1, '.','' ) . ' <i class="ion-ios-star-outline"></i>
										</div>';
								} else {
									$value_review = '
										<div class="df-meta-score--small star-rating">
											' . number_format( $sum / $count_stars, 1, '.', '' ) . ' 
											<i class="ion-ios-star-outline"></i>
										</div>';
								}
							}

							/**
							 * review point
							 */
							if ( 'point' == $review_status ) {
								$sum			= 0;
								$count_point	= count( $review_feature['_review_points_value'] );
								foreach( $review_feature['_review_points_value'] as $value) { 
									$sum		= $sum + $value;
								}
								if ( '1' == $select_style_review ) {
									$value_review = '
										<div class="df-meta-score point-rating">
										' . number_format( $sum / $count_point, 1, '.', '' ) .'
										</div>';
								} else {
									$value_review = '
										<div class="df-meta-score--small point-rating">
											' . number_format( $sum / $count_point, 1, '.', '' ) .'
										</div>';
								}
							}

							/**
							 * review percentage
							 */
							if ( 'percentage' == $review_status ) {
								$sum			= 0;
								$count_percent	= count( $review_feature['_review_percent_value'] );
								foreach( $review_feature['_review_percent_value'] as $value) { 
									$sum		= $sum + $value;
								}
								if ( '1' == $select_style_review ) {
									$value_review = '
										<div class="df-meta-score percent-rating">' . number_format( $sum / $count_percent, 1, '.', '' ) .' %</div>';
								} else {
									$value_review = '
										<div class="df-meta-score--small percent-rating">'. number_format( $sum / $count_percent, 1, '.', '' ) .' %</div>';
								}
							}

							if ( '1' == $select_style_review ) {
			?>
								<li>
									<div class="df-recent-review clearfix">
										<div class="df-recent-review-inner">
											<?php
												$use_layout		= 'widget-review';
												$is_thumbnail	= 'no';
												$is_secondary	= 'no';
												$title_size		= 'h6';
												$is_excerpt		= 'no';
												$is_meta_full	= 'no';
												$output = DF_Content_View::df_load_category();
												echo $output;
												DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
											?>
											<div class="post-meta">
												<div class="post-meta-desc">
													<?php
														DF_Content::df_load_author_and_date();
														DF_Content::df_load_comment_and_share( $is_meta_full );
													?>
												</div>
											</div>
										</div>
										<?php echo $value_review .'%';?>
									</div>
								</li>
			<?php			} else {?>		
								<div class="df-recent-review-inner non-list">
									<?php
										$use_layout		= 'widget-review';
										$is_thumbnail	= 'no';
										$is_secondary	= 'no';
										$title_size		= 'h5';
										$is_excerpt		= 'no';
										$is_meta_full	= 'no';
										if ( DF_Framework::df_is_ipad() ) {
											$use_size		= 'df_size_788x524';
										} else {
											$use_size		= 'df_size_376x250';
										}
										DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
										echo $value_review;
										$output = DF_Content_View::df_load_category();
										echo $output;
										DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
									?>
									<div class="post-meta">
										<div class="post-meta-desc">
											<?php
												DF_Content::df_load_author_and_date();
												DF_Content::df_load_comment_and_share( $is_meta_full );
											?>
										</div>
									</div>
								</div>
			<?php
							} // end if style selection
						} // end if review disable
					}
				endwhile;
			printf( ( $select_style_review == '1' ) ? '</ul>' : '' ); 
			?>
			</div>
			<?php
			}
			wp_reset_query();
			wp_reset_postdata();
			printf( $after_widget );
		}

		/**
		 * form
		 * for widget in admin page
		 */
		public function form( $instance ){
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Recent Review', 'onfleek' );
			$limit_post_review = !empty( $instance['limit_post_review'] ) ? $instance['limit_post_review'] : '5';

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name ('title') ); ?>"><?php _e( 'Title: ', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name ('limit_post_review') ); ?>"><?php _e( 'Number Review to Show: ', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit_post_review' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit_post_review' ) ); ?>" type="text" value="<?php echo esc_attr( $limit_post_review ); ?>" />
			</p>
			<?php 
			if ( isset( $instance[ 'select_style_review' ] ) ) {
				$select_style_review = $instance[ 'select_style_review' ];
			}
			else {
				$select_style_review = '1';
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'select_style_review' ) ); ?>"><?php _e( 'Style Review:', 'onfleek' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'select_style_review' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'select_style_review' ) ); ?>">
					<option value="1" <?php selected( '1', $select_style_review, true ); ?> >Style 1: List</option> 
					<option value="2" <?php selected( '2', $select_style_review, true ); ?> >Style 2</option>
				</select>
			</p>
			<?php 
		}

		/**
		 * update
		 * sanitize widget form values as they are saved
		 */
		public function update( $new_instance, $old_instance ){
			$instance = $old_instance;
			$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['limit_post_review'] = ( !empty( $new_instance['limit_post_review'] ) ) ? $new_instance['limit_post_review'] : '5';
			$instance['select_style_review'] = ( !empty( $new_instance['select_style_review'] ) ) ? $new_instance['select_style_review'] : '1';
			return $instance;
		}

	}

}

/* file location: /your/file/location/[file].php */
