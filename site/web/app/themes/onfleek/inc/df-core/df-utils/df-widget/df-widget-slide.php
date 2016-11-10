<?php
/**
 * Class: DF_Widget_Slide
 * Description: class for generate widget slider
 */

if( !class_exists('DF_Widget_Slide') ) {

	Class DF_Widget_Slide extends WP_Widget{

		static $widget_baseID;
		static $widget_name;
		static $widget_desc;

		function __construct() {
			$widget_details = array(
				/*'classname' => 'DF_Widget_Slide',*/
				'description' => self::get_widget_desc()
			);
			parent::__construct(
				self::get_widget_baseID(),
				self::get_widget_name(),
				$widget_details
			);
		}

		static function df_set_widget( $baseID, $name, $desc ){
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
			$title = apply_filters('widget_title', $instance['title'] );    
			$select_by = $instance['select_by_slide'];
			$limit_post = $instance['limit_post'];
			$post_id = $instance['post_id'];
			$cat_id = $instance['cat_id'];
			$args_query = array();
			if( $select_by != '' ){
				if( $select_by == '1' ){
					$cats = explode(',',$cat_id);
					$args_query = array(
							'posts_per_page' => $limit_post,
							'cat' => $cats,
							'ignore_sticky_posts' => true,
							'cache_results' => false,
							'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
							'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
							'no_found_rows' => true
						);
				}
				if( $select_by == '2' ){
					$post_ids = explode(',', $post_id);
					$args_query = array(
							'post__in' => $post_ids,
							'posts_per_page' => $limit_post,
							'orderby' => 'post__in',
							'cache_results' => false,
							'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
							'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
							'no_found_rows' => true
						);
				}
			}else{
				$args_query = array(
						'posts_per_page' => $limit_post,
						'cache_results' => false,
						'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
						'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
						'no_found_rows' => true
					);
			}
			$post_slider = new WP_Query( $args_query );

			printf( $before_widget );
			printf( '<div class="df-widget-slide">' );
			printf( '<h5 class="df-widget-title">' );
			printf( $title );
			printf( '</h5>' );
			?>
					<div class="widget-slide-track">
						<?php
						if ( $post_slider->have_posts() ) {
							$is_secondary	= 'no';
							$use_layout		= 'widget-slide';
							$is_thumbnail	= 'no';
							$is_secondary	= 'no';
							$title_size		= 'h4';
							$is_excerpt		= 'no';
							$is_meta_full	= 'no';
							if ( DF_Framework::df_is_ipad() ) {
								$use_size = 'df_size_788x524';
							} else {
								$use_size = 'df_size_474x633';
							}
							while( $post_slider->have_posts() ) : $post_slider->the_post();
								?>
								<div class="widget-slide-track-inner df-widget-slide-article">
									<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );?>
									<span class="overlay"></span>
									<div class="df-widget-slide-article-inner">
										<?php 
											$output = DF_Content_View::df_load_category();
											printf( $output );
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
								</div>
							<?php
							endwhile;
						}
					?>
					</div>
			<?php
			printf( '</div>' );
      		wp_reset_query();
			wp_reset_postdata();
			printf( $after_widget );
		}

		/**
		 * form
		 * for widget in admin page
		 */
		public function form( $instance ){
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Slide Post', 'onfleek' );
			$select_by_slide = ! empty( $instance['select_by_slide'] ) ? $instance['select_by_slide'] : '1';
			$limit_post = ! empty( $instance['limit_post'] ) ? $instance['limit_post'] : '5';
			$post_id = ! empty( $instance['post_id'] ) ? $instance['post_id'] : '';
			$cat_id = ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : ''; 
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'select_by_slide' ) ); ?>"><?php _e( 'Show by:', 'onfleek' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'select_by_slide' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'select_by_slide' ) ); ?>">
					<option value="1" <?php selected( '1', $select_by_slide, true ); ?> >by category</option>
					<option value="2" <?php selected( '2', $select_by_slide, true ); ?> >by post id</option> 
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('limit_post') );?>"><?php _e( 'Number Post to Show: ', 'onfleek' );?></label>
				<input class="widefat" value="<?php echo esc_attr( $limit_post );?>" type="text" name="<?php echo esc_attr( $this->get_field_name('limit_post') );?>" id="<?php echo esc_attr( $this->get_field_id('limit_post') ); ?>">
			</p>
			<p id="field-cat-id" class="field-widget-slide field-cat-id">
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ) ;?>"><?php _e( 'category IDs: (separated by comma. ex: 1, 4, 5)', 'onfleek' );?></label>
				<input class="widefat" value="<?php echo esc_attr( $cat_id );?>" type="text" name="<?php echo esc_attr( $this->get_field_name('cat_id') );?>" id="<?php echo esc_attr( $this->get_field_id('cat_id') );?>">
			</p>
			<p id="field-post-id" class="field-widget-slide field-post-id">
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_id' ) );?>"><?php _e( 'Post IDs: (separated by comma. ex: 1, 4, 5)', 'onfleek' );?></label>
				<input class="widefat" value="<?php echo esc_attr( $post_id );?>" type="text" name="<?php echo esc_attr( $this->get_field_name('post_id') );?>" id="<?php echo esc_attr( $this->get_field_id('post_id') );?>">
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
			$instance['limit_post'] = ( !empty( $new_instance['limit_post'] ) ) ? $new_instance['limit_post'] : '5';
			$instance['select_by_slide'] = ( !empty( $new_instance['select_by_slide'] ) ) ? $new_instance['select_by_slide'] : '';
			$instance['post_id'] = ( !empty( $new_instance['post_id'] ) ) ? $new_instance['post_id'] : '';
			$instance['cat_id'] = ( !empty( $new_instance['cat_id'] ) ) ? $new_instance['cat_id'] : '';
			return $instance;
		}

	}

}

/* file location: /your/file/location/[file].php */
