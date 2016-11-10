<?php
/**
 * Class: DF_Widget_Block
 * Description: class for generate widget popular categories
 */

if( !class_exists( 'DF_Widget_Block' ) ) {

	Class DF_Widget_Block extends WP_Widget {

		static $widget_baseID;
		static $widget_name;
		static $widget_desc;

		function __construct() {
			$widget_details 	= array(
				'classname' 	=> 'DF_Widget_Block clearfix',
				'description'	=> self::get_widget_desc()
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
		public function widget( $args, $instance ){
			extract( $args );
			$title_block		= apply_filters( 'widget_title', $instance['title_block'] );
			$limit_post_block	= $instance['limit_post_block'];
			$select_style_block = $instance['select_style_block'];
			$cat_id 			= $instance['cat_id'];
			$args_query 		= array( 
				'posts_per_page'		=> $limit_post_block,
				'cat' 					=> $cat_id, 
				'ignore_sticky_posts'	=> true,
				'post__not_in'			=> get_option("sticky_posts"),
				'cache_results' => false,
				'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
				'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
				'no_found_rows' => true
			);
			echo $before_widget;

			switch ( $select_style_block ) {
				case '1':
					echo $this->block_style_1( $args_query, $title_block );
					break;
				case '2':
					echo $this->block_style_2( $args_query, $title_block );
					break;
				case '3':
					echo $this->block_style_3( $args_query, $title_block );
					break;
				case '4':
					echo $this->block_style_4( $args_query, $title_block );
					break;
				case '5':
					echo $this->block_style_5( $args_query, $title_block );
					break;
				case '6':
					echo $this->block_style_6( $args_query, $title_block );
					break;
				case '7':
					echo $this->block_style_7( $args_query, $title_block );
					break;
				case '8':
					echo $this->block_style_8( $args_query, $title_block );
					break;
				case '9':
					echo $this->block_style_9( $args_query, $title_block );
					break;
				case '10':
					echo $this->block_style_10( $args_query, $title_block );
					break;
				case '11':
					echo $this->block_style_11( $args_query, $title_block );
					break;
				default:
					echo $this->block_style_1( $args_query, $title_block );
					break;
			}

			echo $after_widget;
		}

		/**
		 * form
		 * for widget in admin page
		 */
		public function form( $instance ){
			$title_block		= ! empty( $instance['title_block'] ) ? $instance['title_block'] : __( 'Widget Block', 'onfleek' );
			$limit_post_block	= ! empty( $instance['limit_post_block'] ) ? $instance['limit_post_block'] : '5';
			$cat_id				= ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : '';
			$select_style_block = ! empty( $instance['select_style_block'] ) ? $instance['select_style_block'] : '1';

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name ('title_block') ); ?>"><?php _e( 'Title:' , 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_block' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_block' ) ); ?>" type="text" value="<?php echo esc_attr( $title_block ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name ('cat_id') );?>"><?php _e( 'Category IDs: ( separated by comma. ex: 1, 4, 5 )', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat_id' ) ); ?>" type="text" value="<?php echo esc_attr( $cat_id ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name ('limit_post_block') ); ?>"><?php _e( 'Number Posts to Show: ', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit_post_block' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit_post_block' ) ); ?>" type="text" value="<?php echo esc_attr( $limit_post_block ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'select_style_block' ) ); ?>"><?php _e( 'Block Style : ', 'onfleek' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'select_style_block' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'select_style_block' ) ); ?>">
					<option value="1" <?php selected( '1', $select_style_block, true ); ?> >Style 1</option> 
					<option value="2" <?php selected( '2', $select_style_block, true ); ?> >Style 2</option>
					<option value="3" <?php selected( '3', $select_style_block, true ); ?> >Style 3</option>
					<option value="4" <?php selected( '4', $select_style_block, true ); ?> >Style 4</option>
					<option value="5" <?php selected( '5', $select_style_block, true ); ?> >Style 5</option>
					<option value="6" <?php selected( '6', $select_style_block, true ); ?> >Style 6</option>
					<option value="7" <?php selected( '7', $select_style_block, true ); ?> >Style 7</option>
					<option value="8" <?php selected( '8', $select_style_block, true ); ?> >Style 8</option>
					<option value="9" <?php selected( '9', $select_style_block, true ); ?> >Style 9</option>
					<option value="10" <?php selected( '10', $select_style_block, true ); ?> >Style 10</option>
					<option value="11" <?php selected( '11', $select_style_block, true ); ?> >Style 11</option>
				</select>
			</p>
			<?php
		}

		/**
		 * update
		 * sanitize widget form values as they are saved
		 */
		public function update( $new_instance, $old_instance ){
			$instance						= $old_instance;
			$instance['title_block']		= !empty( $new_instance['title_block'] ) ? strip_tags( $new_instance['title_block'] ) : '';
			$instance['cat_id'] 			= !empty( $new_instance['cat_id'] ) ? $new_instance['cat_id'] : '';
			$instance['limit_post_block']	= !empty( $new_instance['limit_post_block'] ) ? $new_instance['limit_post_block'] : '5';
			$instance['select_style_block'] = !empty( $new_instance['select_style_block'] ) ? $new_instance['select_style_block'] : '1';
			return $instance;
		}

		/**
		 * render output widget block: style 1
		 */
		private function block_style_1( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block ); ?></h5>
				<?php
					if ( $query->have_posts() ) :
						$no = 1;
						while( $query->have_posts() ) : $query->the_post();
							if ( 1 == $no ) {
				?>
								<div class="df-shortcode-blocks-main with-border-bottom clearfix">
									<?php
										$use_layout		= 'widget-blocks';
										$is_thumbnail	= 'no';
										$is_secondary	= 'no';
										$title_size		= 'h4';
										$is_excerpt		= 'yes';
										$is_meta_full	= 'yes';
										if ( wp_is_mobile() ) {
											$use_size		= 'df_size_788x524';
										} else {
											$use_size		= 'df_size_376x250';
										}
										DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
										echo DF_Content_View::df_load_category();
										DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
									?>
									<div class="post-meta with-margin-top">
										<div class="post-meta-avatar">
											<?php DF_Content::df_load_avatar_author(); ?>
										</div>
										<div class="post-meta-desc with-avatar">
											<div class="post-meta-desc-top">
												<?php DF_Content::df_load_author_and_date();?>
											</div>
											<div class="post-meta-desc-btm">
												<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
											</div>
										</div>
									</div>
								</div>
				<?php		} else {?>
								<div class="df-shortcode-blocks-main with-border-bottom">
									<?php
										$use_layout		= 'widget-blocks';
										$use_size		= 'df_size_273x205';
										$is_thumbnail	= 'yes';
										$is_secondary	= 'no';
										$title_size		= 'h5';
										$is_excerpt		= 'no';
										$is_meta_full	= 'no';
										DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									?>
									<div class="thumb-desc">
										<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );?>
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
				<?php 		}
						$no++;
						endwhile;
					endif;
				?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 2
		 */
		private function block_style_2( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<?php
					if ( $query->have_posts() ) :
						while( $query->have_posts() ) : $query->the_post();
				?>
							<div class="df-shortcode-blocks-main with-border-bottom clearfix">
								<?php
									$use_layout		= 'widget-blocks';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$title_size		= 'h4';
									$is_excerpt		= 'no';
									$is_meta_full	= 'no';
									if ( wp_is_mobile() ) {
										$use_size		= 'df_size_788x524';
									} else {
										$use_size		= 'df_size_376x250';
									}
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									echo DF_Content_View::df_load_category();
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
						endwhile;
					endif;
				?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 3
		 */
		private function block_style_3( $args_query, $title_block ) {
			$output	= '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<?php
					if ( $query->have_posts() ) :
						while( $query->have_posts() ) : $query->the_post();
				?>
							<div class="df-shortcode-blocks-main with-border-bottom clearfix">
								<?php
									$use_layout		= 'widget-blocks';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$title_size		= 'h4';
									$is_excerpt		= 'yes';
									$is_meta_full	= 'yes';
									if ( wp_is_mobile() ) {
										$use_size		= 'df_size_788x524';
									} else {
										$use_size		= 'df_size_376x250';
										$use_layout		= 'df-widget-block';
									}
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									echo DF_Content_View::df_load_category();
									DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
								?>
								<div class="post-meta with-margin-top">
									<div class="post-meta-avatar">
										<?php DF_Content::df_load_avatar_author(); ?>
									</div>
									<div class="post-meta-desc with-avatar">
										<div class="post-meta-desc-top">
											<?php DF_Content::df_load_author_and_date();?>
										</div>
										<div class="post-meta-desc-btm">
											<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
										</div>
									</div>
								</div>
							</div>
						<?php 
						endwhile;
					endif;
					?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 4
		 */
		private function block_style_4( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<?php
					if( $query->have_posts() ) :
						while( $query->have_posts() ) : $query->the_post();
				?>
							<div class="df-shortcode-blocks-main with-border-bottom">
								<?php
									$use_layout		= 'widget-blocks';
									$use_size		= 'df_size_273x205';
									$is_thumbnail	= 'yes';
									$is_secondary	= 'no';
									$title_size		= 'h5';
									$is_excerpt		= 'no';
									$is_meta_full	= 'no';
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
								?>
								<div class="thumb-desc">
									<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );?>
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
					endif;
				?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 5
		 */
		private function block_style_5( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks style-5 widget-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<?php
					if ( $query->have_posts() ) :
						while( $query->have_posts() ) : $query->the_post();
				?>
							<div class="df-shortcode-blocks-main with-border-bottom">
								<?php
									$use_layout		= 'widget-blocks';
									$use_size		= 'df_size_273x205';
									$is_thumbnail	= 'yes';
									$is_secondary	= 'no';
									$title_size		= 'h5';
									$is_excerpt		= 'no';
									$is_meta_full	= 'no';
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
								?>
								<div class="thumb-desc">
									<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );?>
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
					endif;
				?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 6
		 */
		private function block_style_6( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks style-6 widget-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<?php
					if ( $query->have_posts() ) :
						while( $query->have_posts() ) : $query->the_post();
				?>
							<div class="df-shortcode-blocks-main with-border-bottom">
								<?php
									$use_layout		= 'widget-blocks';
									$is_thumbnail	= 'yes';
									$title_size		= 'h5';
									$is_excerpt		= 'no';
									$is_meta_full	= 'yes';
									DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
								?>
								<div class="post-meta">
									<div class="post-meta-desc">
										<div class="post-meta-desc-top">
											<?php DF_Content::df_load_author_and_date();?>
										</div>
										<div class="post-meta-desc-btm">
											<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
										</div>
									</div>
								</div>
							</div>
				<?php
						endwhile;
					endif;
					?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 7
		 */
		private function block_style_7( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks style-7 widget-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<?php
					if( $query->have_posts() ) :
						while( $query->have_posts() ) : $query->the_post();
				?>
							<div class="df-shortcode-blocks-main with-border-bottom">
								<?php
									$use_layout		= 'widget-blocks';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$title_size		= 'h5';
									$is_excerpt		= 'no';
									$is_meta_full	= 'yes';
									if ( wp_is_mobile() ) {
										$use_size		= 'df_size_788x524';
									} else {
										$use_size		= 'df_size_376x250';
									}
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
								?>
								<div class="df-shortcode-blocks-main-inner clearfix">
									<?php
										echo DF_Content_View::df_load_category();
										DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
									?>
									<div class="post-meta with-margin-top">
										<div class="post-meta-avatar">
											<?php DF_Content::df_load_avatar_author(); ?>
										</div>
										<div class="post-meta-desc with-avatar">
											<div class="post-meta-desc-top">
												<?php DF_Content::df_load_author_and_date();?>
											</div>
											<div class="post-meta-desc-btm">
												<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
											</div>
										</div>
									</div>
								</div>
							</div>
				<?php
						endwhile;
					endif;
					?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 8
		 */
		private function block_style_8( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks style-8 widget-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<?php
					if ( $query->have_posts() ) :
						while( $query->have_posts() ) : $query->the_post();
				?>
							<div class="df-shortcode-blocks-main widget-grid">
								<?php
									$use_layout		= 'widget-blocks';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$title_size		= 'h5';
									$is_excerpt		= 'no';
									$is_meta_full	= 'no';
									if ( wp_is_mobile() ) {
										$use_size		= 'df_size_788x524';
									} else {
										$use_size		= 'df_size_376x250';
									}
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
								?>
								<span class="overlay"></span>
								<div class="df-shortcode-blocks-main-inner">
									<?php
										echo DF_Content_View::df_load_category();
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
					endif;
					?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 9
		 */
		private function block_style_9( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks style-9 widget-blocks clearfix">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<div class="wrapped-column clearfix">
			<?php
				if ( $query->have_posts() ) :
					while( $query->have_posts() ) : $query->the_post();
			?>
						<div class="df-shortcode-blocks-main col-lg-6 col-md-6 col-lg-6 col-xs-6">
							<?php
								$use_layout		= 'widget-blocks-9';
								$is_thumbnail	= 'no';
								$is_secondary	= 'no';
								$title_size		= 'h5';
								$is_excerpt		= 'no';
								if ( wp_is_mobile() ) {
									$use_size		= 'df_size_376x250';
								} else {
									$use_size		= 'df_size_376x250';
								}
								DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
								echo DF_Content_View::df_load_category();
								DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
							?>
						</div>
			<?php					
					endwhile;
				endif;
			?>
				</div>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 10
		 */
		private function block_style_10( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks style-10 widget-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<?php
					if ( $query->have_posts() ) :
						$no = 1;
						while( $query->have_posts() ) : $query->the_post();
							if ( 1 == $no ) {
				?>
								<div class="df-shortcode-blocks-main with-border-bottom clearfix">
									<?php
										$use_layout		= 'widget-blocks';
										$is_thumbnail	= 'no';
										$is_secondary	= 'no';
										$title_size		= 'h4';
										$is_excerpt		= 'yes';
										$is_meta_full	= 'yes';
										if ( wp_is_mobile() ) {
											$use_size		= 'df_size_788x524';
										} else {
											$use_size		= 'df_size_376x250';
										}
										DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
										echo DF_Content_View::df_load_category();
										DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
									?>
									<div class="post-meta with-margin-top">
										<div class="post-meta-avatar">
											<?php DF_Content::df_load_avatar_author(); ?>
										</div>
										<div class="post-meta-desc with-avatar">
											<div class="post-meta-desc-top">
												<?php DF_Content::df_load_author_and_date();?>
											</div>
											<div class="post-meta-desc-btm">
												<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
											</div>
										</div>
									</div>
								</div>
				<?php		} else {?>
								<div class="df-shortcode-blocks-main with-border-bottom">
									<?php
										$use_layout		= 'widget-blocks';
										$is_thumbnail	= 'yes';
										$title_size		= 'h5';
										$is_excerpt		= 'no';
										$is_meta_full	= 'yes';
										DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
									?>
									<div class="post-meta">
										<div class="post-meta-desc">
											<div class="post-meta-desc-top">
												<?php DF_Content::df_load_author_and_date();?>
											</div>
											<div class="post-meta-desc-btm">
												<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
											</div>
										</div>
									</div>
								</div>
				<?php
							}
							$no++;
						endwhile;
					endif;
					?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}

		/**
		 * render output widget block: style 11
		 */
		private function block_style_11( $args_query, $title_block ) {
			$output = '';
			$query	= new WP_Query( $args_query );
			ob_start();
			?>
			<div class="df-shortcode-blocks style-11 widget-blocks">
				<h5 class="df-widget-title"><?php echo esc_html( $title_block );?></h5>
				<?php
					if ( $query->have_posts() ) :
						$no = 1;
						while( $query->have_posts() ) : $query->the_post();
							if ( 1 == $no ) {
								?>
								<div class="df-shortcode-blocks-main widget-grid">
									<?php
										$use_layout		= 'widget-blocks';
										$is_thumbnail	= 'no';
										$is_secondary	= 'no';
										$title_size		= 'h5';
										$is_excerpt		= 'no';
										$is_meta_full	= 'yes';
										if ( wp_is_mobile() ) {
											$use_size		= 'df_size_788x524';
										} else {
											$use_size		= 'df_size_376x250';
										}
										DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									?>
									<span class="overlay"></span>
									<div class="df-shortcode-blocks-main-inner">
										<?php
											echo DF_Content_View::df_load_category();
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
				<?php		} else {?>
								<div class="df-shortcode-blocks-main with-border-bottom">
									<?php
										$use_layout		= 'widget-blocks';
										$use_size		= 'df_size_273x205';
										$is_thumbnail	= 'yes';
										$is_secondary	= 'no';
										$title_size		= 'h5';
										$is_excerpt		= 'no';
										$is_meta_full	= 'no';
										DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									?>
									<div class="thumb-desc">
										<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );?>
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
					$no++;		
					endwhile;
				endif;
				?>
			</div>
			<?php
			$output = ob_get_contents();
			if ( ob_get_contents() ) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $output;
		}
	}

}

/* file location: /your/file/location/[file].php */
