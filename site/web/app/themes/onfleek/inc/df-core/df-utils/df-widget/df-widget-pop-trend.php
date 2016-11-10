<?php
/**
 * Class: DF_Widget_Popular_Cat
 * Description: class for generate widget popular categories
 */

if ( !class_exists('DF_Widget_Pop_Trend') ) {

	Class DF_Widget_Pop_Trend extends WP_Widget {

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
			self::$widget_baseID = $baseID;
			self::$widget_name = $name;
			self::$widget_desc = $desc;
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
		public function widget( $args, $instance ){
			extract( $args );
			global $wpdb;
			$title 		= apply_filters('widget_title', $instance['title'] );   
			$limit_post = $instance['limit_post'];
			$popular 	= $instance['popular'];
			$trending 	= $instance['trending'];
			$hot 		= $instance['hot'];
			$table_name = $wpdb->prefix . "popularposts";
			printf( $before_widget );

			$array_title = ( explode( ",", $title ) );
			$now =current_time('mysql');
			printf( '<div class="df-widget-popular style-tab">');
			printf( '<ul class="list-inline df-nav-tab">' );
			printf( ( '' != $popular ) ? '<li class="active"><h5><a href="#popular">'. $array_title[0] .'</a></h5></li>' : '' );
			printf( ( '' != $trending ) ? '<li><h5><a href="#trending">'. $array_title[1] .'</a></h5></li>' : '' );
			printf( ( '' != $hot ) ? '<li><h5><a href="#hot">'. $array_title[2] .'</a></h5></li>' : '' );
			printf( '</ul>' );
			printf( '<div class="tab-content">' );
					if ( '' != $popular && class_exists('WordpressPopularPosts')) {
						$querystr	=	"SELECT p.*
									FROM {$table_name}summary v 
									LEFT JOIN {$wpdb->posts} p ON v.postid = p.ID 
									WHERE 1 = 1 AND p.post_type = 'post' 
									AND v.last_viewed > DATE_SUB('{$now}',  INTERVAL 1 MONTH) 
									AND p.post_status = 'publish' GROUP BY v.postid ORDER BY pageviews DESC LIMIT {$limit_post}";
						$pop_query = $wpdb->get_results($querystr, OBJECT);
						?>
						<div id="popular" class="tab-pane df-tab-pane fade in active">
						<?php
							if ( $pop_query ) {
							global $post;
								foreach ($pop_query as $post){
	 						 		setup_postdata($post);
										?>
										<div class="df-most-popular-list clearfix">
											<?php
												$use_layout		= 'widget-popular-tab';
												$use_size		= 'df_size_273x205';
												$is_thumbnail	= 'yes';
												$is_secondary	= 'no';
												$title_size		= 'h5';
												$is_excerpt		= 'no';
												$is_meta_full	= 'no';
												DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
											?>
											<div class="thumb-desc">
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
								}
							}
						?>
						</div>
						<?php
					}
					if ( '' != $trending && class_exists('WordpressPopularPosts')) {
						$querystr	=	"SELECT p.*
									FROM {$table_name}summary v
									LEFT JOIN {$wpdb->posts} p ON v.postid = p.ID 
									WHERE 1 = 1 AND p.post_type = 'post' 
									AND v.last_viewed > DATE_SUB('{$now}',  INTERVAL 1 Day) 
									AND p.post_status = 'publish' GROUP BY v.postid ORDER BY pageviews DESC LIMIT {$limit_post}";
						$trending_query = $wpdb->get_results($querystr, OBJECT);
						?>
						<div id="trending" class="tab-pane df-tab-pane fade">
						<?php
						if ( $trending_query ) {
							global $post;
							foreach ($trending_query as $post){
 						 		setup_postdata($post);
									?>
									<div class="df-most-popular-list clearfix">
										<?php
											$use_layout		= 'widget-popular-tab';
											$use_size		= 'df_size_273x205';
											$is_thumbnail	= 'yes';
											$is_secondary	= 'no';
											$title_size		= 'h5';
											$is_excerpt		= 'no';
											$is_meta_full	= 'no';
											DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
										?>
										<div class="thumb-desc">
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
								}
							}
							?>
						</div>
				<?php
					}
					if( '' != $hot  && class_exists('WordpressPopularPosts')){
						$querystr	=	"SELECT p.*
									FROM {$table_name}summary v
									LEFT JOIN {$wpdb->posts} p ON v.postid = p.ID 
									WHERE 1 = 1 AND p.post_type = 'post' 
									AND v.last_viewed > DATE_SUB('{$now}',  INTERVAL 1 Day) 
									AND p.post_status = 'publish' GROUP BY v.postid ORDER BY pageviews DESC LIMIT {$limit_post}";
						$hot_query = $wpdb->get_results($querystr, OBJECT);
						?>
						<div id="hot" class="tab-pane df-tab-pane fade">
						<?php
						if ( $hot_query ) {
							global $post;
							foreach ($hot_query as $post){
 						 		setup_postdata($post);
								?>
								<div class="df-most-popular-list clearfix">
									<?php
										$use_layout		= 'widget-popular-tab';
										$use_size		= 'df_size_273x205';
										$is_thumbnail	= 'yes';
										$is_secondary	= 'no';
										$title_size		= 'h5';
										$is_excerpt		= 'no';
										$is_meta_full	= 'no';
										DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									?>
									<div class="thumb-desc">
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
							}
						}
						?>
						</div>
					<?php
					}	
			wp_reset_query();
			wp_reset_postdata();
						
			printf( '</div>' );
			printf( '</div>' );

			printf( $after_widget );
		}

		/**
		 * form
		 * for widget in admin page
		 */
		public function form( $instance ){
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Popular, Trending, Hot', 'onfleek' );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title: ( Separated by comma. Ex: Popular, Trending, Hot )', 'onfleek' ); ?></label>
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
			$popular = !empty( $instance['popular'] ) ? 'checked' : '';
			$trending = !empty( $instance['trending'] ) ? 'checked' : '';
			$hot = !empty( $instance['hot'] ) ? 'checked' : '';
			?>
			<ul class="">
				<li>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'popular' ) );?>"><?php _e( 'Popular', 'onfleek' ); ?></label> 
						<input value="popular" <?php echo esc_attr($popular);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'popular' ) );?>" id="<?php echo esc_attr( $this->get_field_id('popular') );?>">
					</p>
				</li>
				<li>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'trending' ) );?>"><?php _e( 'Trending', 'onfleek' ); ?></label> 
						<input value="trending" <?php echo esc_attr($trending);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'trending' ) );?>" id="<?php echo esc_attr( $this->get_field_id('trending') );?>">
					</p>
				</li>
				<li>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'hot' ) );?>"><?php _e( 'Hot', 'onfleek' ); ?></label> 
						<input value="hot" <?php echo esc_attr($hot);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'hot' ) );?>" id="<?php echo esc_attr( $this->get_field_id('hot') );?>">
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
			$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['limit_post'] = ( !empty( $new_instance['limit_post'] ) ) ? $new_instance['limit_post'] : '5';
			$instance['popular'] = ( isset( $new_instance['popular'] ) ?  $new_instance['popular'] : '' );
			$instance['trending'] = ( isset( $new_instance['trending'] ) ? $new_instance['trending'] : '' );
			$instance['hot'] = ( isset( $new_instance['hot'] ) ? $new_instance['hot'] : '' );
			return $instance;
		}
	}
}

/* file location: /your/file/location/[file].php */
