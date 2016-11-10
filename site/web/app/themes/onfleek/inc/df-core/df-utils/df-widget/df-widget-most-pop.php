<?php
/**
 * Class: DF_Widget_Popular_Cat
 * Description: class for generate widget popular categories
 */

if( !class_exists('DF_Widget_Most_Pop') ) {

	Class DF_Widget_Most_Pop extends WP_Widget{

		static $widget_baseID;
		static $widget_name;
		static $widget_desc;

		function __construct() {
			$widget_details 	= array(
				'description' 	=> self::get_widget_desc()
			);
			parent::__construct(
				self::get_widget_baseID(),
				self::get_widget_name(),
				$widget_details
			);
		}

		static function df_set_widget( $baseID, $name, $desc ) {
			self::$widget_baseID 	= $baseID;
			self::$widget_name		= $name;
			self::$widget_desc		= $desc;
		}

		function get_widget_baseID() {
			return self::$widget_baseID;
		}

		function get_widget_name() {
			return self::$widget_name;
		}

		function get_widget_desc() {
			return self::$widget_desc;
		}

		/**
		 * widget
		 * for displaying widget front end
		 */
		public function widget( $args, $instance ) {
			extract( $args );
			$title		= apply_filters('widget_title', $instance['title'] );    
			$limit_post = $instance['limit_post'];
			$today		= $instance['today'];
			$week		= $instance['week'];
			$month		= $instance['month'];
			$selectby	= $instance['select_by'];

			printf( $before_widget );
			
			$last7days	= '7 days ago';
			$sticky 	= get_option( 'sticky_posts' );
			$args_query = array( 
				'posts_per_page'		=> $limit_post, 
				'meta_key'				=> 'df_page_view', 
				'orderby'				=> 'meta_value_num', 
				'order'					=> 'DESC' ,
				'ignore_sticky_posts'	=> 1,
				'post__not_in'			=> $sticky,
			);
			if ( '1' == $selectby ) {
				printf( '<div class="df-widget-popular style-tab">' );
				printf( '<h5 class="df-widget-title">' );
				echo $title;
				printf( '</h5>' );
				printf( '<ul class="list-inline df-nav-tab most-pop">' );
				printf( ( '' != $today ) ? '<li class="active"><h5><a href="#today">Today</a></h5></li>' : '' );
				printf( ( '' != $week ) ? '<li><h5><a href="#week">Week</a></h5></li>' : '' );
				printf( ( '' != $month ) ? '<li><h5><a href="#month">Month</a></h5></li>' : '' );
				printf( '</ul>' );
				printf( '<div class="tab-content">' );
						if ( '' != $today ) {
							$today_query = new WP_Query( $args_query );
					?>
							<div id="today" class="tab-pane df-tab-pane fade in active">
								<?php
									if ( $today_query->have_posts() ) {
										while( $today_query->have_posts() ): $today_query->the_post();
										?>
											<div class="df-most-popular-list clearfix">
												<div class="featured-image-thumbnail">
													<?php
														$use_layout     = 'widget-popular-tab';
														$use_size       = 'df_size_273x205';
														$is_thumbnail   = 'yes';
														$is_secondary   = 'no';
														$title_size     = 'h5';
														$is_excerpt     = 'no';
														$is_meta_full   = 'no';
														DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
													?>
												</div>
												<div class="thumb-desc most-pop">
													<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt ); ?>
													<div class="post-meta">
														<div class="post-meta-desc">
															<?php
																DF_Content::df_load_author_and_date();
																DF_Content::df_load_comment_and_share( $is_meta_full );
															?>
														</div>
													</div>
												</div>
											</div>
										<?php
										endwhile;
									}
								?>
							</div>
						<?php
						}
						if ( '' != $week ) {
							$date_query = array(
											array(
												'column' => 'post_date_gmt',
												'after'  => '1 day ago'
											)
										);
							$week_query = new WP_Query( $args_query );
					?>
							<div id="week" class="tab-pane df-tab-pane fade">
								<?php
									if ( $week_query->have_posts() ) {
										while( $week_query->have_posts() ): $week_query->the_post();
								?>
											<div class="df-most-popular-list clearfix">
												<div class="featured-image-thumbnail">
													<?php
														$use_layout     = 'widget-popular-tab';
														$use_size       = 'df_size_273x205';
														$is_thumbnail   = 'yes';
														$is_secondary   = 'no';
														$title_size     = 'h5';
														$is_excerpt     = 'no';
														$is_meta_full   = 'no';
														DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
													?>
												</div>
												<div class="thumb-desc most-pop">
													<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt ); ?>
													<div class="post-meta">
														<div class="post-meta-desc">
															<?php
																DF_Content::df_load_author_and_date();
																DF_Content::df_load_comment_and_share( $is_meta_full );
															?>
														</div>
													</div>
												</div>
											</div>
								<?php
										endwhile;
									}
								?>
							</div>
					<?php
						}
						if ( '' != $month ) {
							$date_query = array(
											array(
												'column' => 'post_date_gmt',
												'after'  => '1 month ago'
											)
										);
							$month_query = new WP_Query( $args_query );
					?>
							<div id="month" class="tab-pane df-tab-pane fade">
								<?php
									if( $month_query->have_posts() ){
										while( $month_query->have_posts() ): $month_query->the_post();
								?>
											<div class="df-most-popular-list clearfix">
												<div class="featured-image-thumbnail">
													<?php
														$use_layout     = 'widget-popular-tab';
														$use_size       = 'df_size_273x205';
														$is_thumbnail   = 'yes';
														$is_secondary   = 'no';
														$title_size     = 'h5';
														$is_excerpt     = 'no';
														$is_meta_full   = 'no';
														DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
													?>
												</div>
												<div class="thumb-desc most-pop">
													<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt ); ?>
													<div class="post-meta">
														<div class="post-meta-desc">
															<?php
																DF_Content::df_load_author_and_date();
																DF_Content::df_load_comment_and_share( $is_meta_full );
															?>
														</div>
													</div>
												</div>
											</div>
								<?php
										endwhile;
									}
								?>
							</div>
					<?php
						}	
							
				printf( '</div>' );
				printf( '</div>' );
			} else {
				printf( '<div class="df-widget-popular style-list">' );
				printf( '<h5 class="df-widget-title">' );
				echo $title;
				printf( '</h5>' );

				$query = new WP_Query( $args_query );	

					if ( $query->have_posts() ) {
						$no = 1;
						while( $query->have_posts() ) : $query->the_post();					
				?>
							<div class="df-most-popular-list clearfix">
								<span class="df-list-counter"><?php printf($no);?></span>
								<div class="featured-image-thumbnail">
									<?php
										$use_layout     = 'widget-popular-tab';
										$use_size       = 'df_size_273x205';
										$is_thumbnail   = 'yes';
										$is_secondary   = 'no';
										$title_size     = 'h5';
										$is_excerpt     = 'no';
										$is_meta_full   = 'no';
										DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									?>
								</div>
								<div class="thumb-desc most-pop">
									<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt ); ?>
									<div class="post-meta">
										<div class="post-meta-desc">
											<?php
												DF_Content::df_load_author_and_date();
												DF_Content::df_load_comment_and_share( $is_meta_full );
											?>
										</div>
									</div>
								</div>
							</div>
				<?php
							$no++;
						endwhile;
					}
				echo '</div>';
			}
			wp_reset_query();
			wp_reset_postdata();
			printf( $after_widget );
		}

		/**
		 * form
		 * for widget in admin page
		 */
		public function form( $instance ) {
			
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Most Popular', 'onfleek' );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php 

			$limit_post = ! empty( $instance['limit_post'] ) ? $instance['limit_post'] : '5';
			?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'limit_post' ) ); ?>"><?php _e( 'Number Post to Show:', 'onfleek' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit_post' ) );?>" type="text" value="<?php echo esc_attr( $limit_post );?>" >
			</p>
			<?php 
			if ( isset( $instance[ 'select_by' ] ) ) {
				$select_by = $instance[ 'select_by' ];
			}
			else {
				$select_by = 1;
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'select_by' ) ); ?>"><?php _e( 'Display by:', 'onfleek' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'select_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'select_by' ) ); ?>">
					<option value="1" <?php selected( '1', $select_by, true ); ?> >Today / Week / Month</option> 
					<option value="2" <?php selected( '2', $select_by, true ); ?> >Number</option>
				</select>
			</p>

			<?php 
			$today	= !empty( $instance['today'] ) ? 'checked' : '';
			$week	= !empty( $instance['week'] ) ? 'checked' : '';
			$month	= !empty( $instance['month'] ) ? 'checked' : '';
			?>
			<ul class="by-time" >
				<li style="display:inline-block;">
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'today' ) );?>"><?php _e( 'Today', 'onfleek' ); ?></label> 
						<input value="today" <?php echo esc_attr($today);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'today' ) );?>" id="<?php echo esc_attr( $this->get_field_id('today') );?>">
					</p>
				</li>
				<li style="display:inline-block;">
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'week' ) );?>"><?php _e( 'Week', 'onfleek' ); ?></label> 
						<input value="week" <?php echo esc_attr($week);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'week' ) );?>" id="<?php echo esc_attr( $this->get_field_id('week') );?>">
					</p>
				</li>
				<li style="display:inline-block;">
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'month' ) );?>"><?php _e( 'Month', 'onfleek' ); ?></label> 
						<input value="month" <?php echo esc_attr($month);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'month' ) );?>" id="<?php echo esc_attr( $this->get_field_id('month') );?>">
					</p>
				</li>
			</ul>
			<?php
		}

		/**
		 * update
		 * sanitize widget form values as they are saved
		 */
		public function update( $new_instance, $old_instance ){
			$instance = $old_instance;
			$instance['title'] 		= ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['select_by'] 	= ( !empty( $new_instance['select_by'] ) ) ? $new_instance['select_by'] : '';
			$instance['limit_post'] = ( !empty( $new_instance['limit_post'] ) ) ? $new_instance['limit_post'] : '5';
			$instance['today'] 		= ( isset( $new_instance['today'] ) ?  $new_instance['today'] : '' );
			$instance['week'] 		= ( isset( $new_instance['week'] ) ? $new_instance['week'] : '' );
			$instance['month'] 		= ( isset( $new_instance['month'] ) ? $new_instance['month'] : '' );
			return $instance;
		}

	}

}

/* file location: /your/file/location/[file].php */
