<?php
/**
 * Class: DF_Widget_Social_Counter
 * Description: class for generate widget Social Media Counter
 */

if( !class_exists('DF_Widget_Social_Counter') ) {

	Class DF_Widget_Social_Counter extends WP_Widget{

		function __construct() {
			load_plugin_textdomain( 'df_sosmed' );
			parent::__construct(
				'DF_Widget_Social_Counter',
				__( 'DF Widget Social Counter' , 'df_sosmed'),
				array( 'description' => __( 'Widget for display Social Counter' , 'df_sosmed') )
			);
			// if ( is_active_widget( false, false, $this->id_base ) ) {
			//	do something when widget is active
			// }
		}

		/**
		 * widget
		 * for displaying widget front end
		 */
		public function widget( $args, $instance ){
			extract( $args );
			$title = apply_filters('widget_title', $instance['title'] );
			$options = DF_Global_Options::$options;
			$account = $options['social_account']['account'];
			printf( $before_widget );
			$facebook = !empty( $instance['facebook'] ) ? 'checked' : '';
			$twitter = !empty( $instance['twitter'] ) ? 'checked' : '';
			$googleplus = !empty( $instance['googleplus'] ) ? 'checked' : '';
			$vimeo = !empty( $instance['vimeo'] ) ? 'checked' : '';
			$youtube = !empty( $instance['youtube'] ) ? 'checked' : '';
			$instagram = !empty( $instance['instagram'] ) ? 'checked' : '';
			?>
			<!-- Social Counter -->
				<div class="df-widget-social-counter">
					<h5 class="df-widget-title">
						<?php echo esc_html( $title ); ?>
					</h5>
					<ul>
					

					<?php
						if ( '' !== $facebook ) {
							$rating = DF_Social_Media::df_get_facebook_like();
							$dv_facebook_count = sprintf( _n( ' %s Like', ' %s Likes', $rating, 'df_magz' ), $rating );
					?>
						<li class="fb-social-counter">
							<a href="<?php echo esc_url( $account['facebook'] ); ?>">
								<i class="ion-social-facebook ion-social-icon-size"></i> <?php echo $dv_facebook_count ; ?> <span class="pull-right">like</span>
							</a>
						</li>
					<?php
						}
						if ( '' !== $twitter ) {
							$rating = DF_Social_Media::df_get_facebook_like();
							$dv_twitter_count = sprintf( _n( ' %s Follower', ' %s Followers', $rating, 'df_magz' ), $rating );
					?>
						<li class="tw-social-counter">
							<a href="<?php echo esc_url( $account['twitter'] ); ?>">
								<i class="ion-social-twitter ion-social-icon-size"></i> <?php echo $dv_twitter_count ; ?> <span class="pull-right">follow</span>
							</a>
						</li>
					<?php
						}
						if ( '' !== $googleplus ) {
							$rating = DF_Social_Media::df_get_google_plus_follower();
							$dv_googleplus_count =  sprintf( _n( ' %s Follower', ' %s Followers', $rating, 'df_magz' ), $rating );
							
					?>
						<li class="gp-social-counter">
							<a href="<?php echo esc_url( $account['google_plus'] ); ?>">
								<i class="ion-social-googleplus ion-social-icon-size"></i> <?php echo $dv_googleplus_count; ?> <span class="pull-right">follow</span>
							</a>
						</li>
					<?php
						}
						if ( '' !== $youtube ) {
							$rating = DF_Social_Media::df_get_youtube_follower();
							$dv_youtube_count = sprintf( _n( ' %s Subscriber', ' %s Subscribers', $rating, 'df_magz' ), $rating );
					?>
						<li class="yt-social-counter">
							<a href="<?php echo esc_url( $account['youtube'] ); ?>">
								<i class="ion-social-youtube ion-social-icon-size"></i> <?php echo $dv_youtube_count; ?> <span class="pull-right">subscribe</span>
							</a>
						</li>
					<?php
						}
						if ( '' !== $instagram ) {
							$rating = DF_Social_Media::df_get_instagram_follower();
							$dv_instagram_count = sprintf( _n( ' %s Follower', ' %s Followers', $rating, 'df_magz' ), $rating );
					?>
						<li class="ig-social-counter">
							<a href="<?php echo esc_url( $account['instagram'] ); ?>">
								<i class="ion-social-instagram-outline ion-social-icon-size"></i> <?php echo $dv_instagram_count; ?> <span class="pull-right">follow</span>
							</a>
						</li>
					<?php
						}
						if ( '' !== $vimeo ) {
							$rating = DF_Social_Media::df_get_vimeo_follower();
							$dv_vimeo_count = sprintf( _n( ' %s Follower', ' %s Followers', $rating, 'df_magz' ), $rating );
					?>
						<li class="vim-social-counter">
							<a href="<?php echo esc_url( $account['vimeo'] ); ?>">
								<i class="ion-social-vimeo ion-social-icon-size"></i> <?php echo $dv_vimeo_count; ?> <span class="pull-right">like</span>
							</a>
						</li>
					<?php
						}
					?>
					</ul>
				</div>
			<?php
			 printf( $after_widget );
		}

		/**
		 * form
		 * for widget in admin page
		 */
		public function form( $instance ){
			$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Social Counter', 'onfleek' );
			$facebook = !empty( $instance['facebook'] ) ? 'checked' : '';
			$twitter = !empty( $instance['twitter'] ) ? 'checked' : '';
			$googleplus = !empty( $instance['googleplus'] ) ? 'checked' : '';
			$vimeo = !empty( $instance['vimeo'] ) ? 'checked' : '';
			$youtube = !empty( $instance['youtube'] ) ? 'checked' : '';
			$instagram = !empty( $instance['instagram'] ) ? 'checked' : '';
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name ('title') ); ?>"><?php _e( 'Title: ', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
				<ul class="social-media-counter" >
					<li style="display:inline-block;">
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) );?>"><?php _e( 'Facebook', 'onfleek' ); ?></label>
							<input value="today" <?php echo esc_attr($facebook);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) );?>" id="<?php echo esc_attr( $this->get_field_id('facebook') );?>">
						</p>
					</li>
					<li style="display:inline-block;">
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) );?>"><?php _e( 'Twitter', 'onfleek' ); ?></label>
							<input value="week" <?php echo esc_attr($twitter);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) );?>" id="<?php echo esc_attr( $this->get_field_id('twitter') );?>">
						</p>
					</li>
					<li style="display:inline-block;">
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) );?>"><?php _e( 'Instagram', 'onfleek' ); ?></label>
							<input value="month" <?php echo esc_attr($instagram);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) );?>" id="<?php echo esc_attr( $this->get_field_id('instagram') );?>">
						</p>
					</li>
					<li style="display:inline-block;">
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) );?>"><?php _e( 'Google+', 'onfleek' ); ?></label>
							<input value="today" <?php echo esc_attr($googleplus);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'googleplus' ) );?>" id="<?php echo esc_attr( $this->get_field_id('googleplus') );?>">
						</p>
					</li>
					<li style="display:inline-block;">
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) );?>"><?php _e( 'Youtube', 'onfleek' ); ?></label>
							<input value="week" <?php echo esc_attr($youtube);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) );?>" id="<?php echo esc_attr( $this->get_field_id('youtube') );?>">
						</p>
					</li>
					<li style="display:inline-block;">
						<p>
							<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) );?>"><?php _e( 'Vimeo', 'onfleek' ); ?></label>
							<input value="week" <?php echo esc_attr($vimeo);?> type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) );?>" id="<?php echo esc_attr( $this->get_field_id('vimeo') );?>">
						</p>
					</li>
				</ul>
			<!-- </p> -->
			<?php
		}

		/**
		 * update
		 * sanitize widget form values as they are saved
		 */
		public function update( $new_instance, $old_instance ){
			$instance = $old_instance;
			$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['facebook'] = ( !empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
			$instance['twitter'] = ( !empty( $new_instance['twitter'] ) ) ? $new_instance['twitter'] : '';
			$instance['instagram'] = ( !empty( $new_instance['instagram'] ) ) ? $new_instance['instagram'] : '';
			$instance['googleplus'] = ( isset( $new_instance['googleplus'] ) ?  $new_instance['googleplus'] : '' );
			$instance['youtube'] = ( isset( $new_instance['youtube'] ) ? $new_instance['youtube'] : '' );
			$instance['vimeo'] = ( isset( $new_instance['vimeo'] ) ? $new_instance['vimeo'] : '' );
			return $instance;
		}

	}

}

function df_social_media_counter_register_widgets() {
	register_widget( 'DF_Widget_Social_Counter' );
}

add_action( 'widgets_init', 'df_social_media_counter_register_widgets' );
