<?php
/**
 * Class: DF_Widget_Author
 * Description: class for generate widget author
 */

if( !class_exists('DF_Widget_Author') ) {

	Class DF_Widget_Author extends WP_Widget {

		static $widget_baseID;
		static $widget_name;
		static $widget_desc;

		function __construct() {
			$widget_details = array( 'description' => self::get_widget_desc() );
			parent::__construct(self::get_widget_baseID(),self::get_widget_name(),$widget_details);
		}

		static function df_set_widget( $baseID, $name, $desc ) {
			self::$widget_baseID	= $baseID;
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
			$title 			= apply_filters( 'widget_title', $instance['title'] );
			$limit_author 	= $instance[ 'limit_author' ];
			$args 			= array(
				'who'		=> 'authors',
				'number'	=> $limit_author,
				'orderby'	=> 'name',
				'order'		=> 'ASC',
			);

			printf( $before_widget );
			printf( '<div class="df-widget-author-list">');
			printf( '<h5 class="df-widget-title '. esc_attr( $limit_author ).'">'. $title .'</h5>' );
			$authors = get_users( $args );
			if ( !empty($authors) ) {
				?>
				<ul>
				<?php
				foreach ( $authors as $author ) {
					global $wpdb;
					$comment = $wpdb->get_results(
						$wpdb->prepare( "
       						SELECT COUNT( * ) AS total
							FROM {$wpdb->comments}
							WHERE comment_approved = 1 AND user_id = %s
							GROUP BY user_id
						", $author->ID )
					);
					if ( isset( $comment[0] ) ) {
						$comm			= $comment[0];
						$comment_counts = $comm->total;
					} else {
						$comment_counts = "0";
					}
					?>
					<li>
						<div class="df-author-list clearfix">
							<?php printf( get_avatar( $author->ID, 64 ) );?>
							<div class="df-author-list-inner">
								<a href="<?php echo esc_url( get_author_posts_url( $author->ID ) );?>" class="author-name"><?php echo esc_html( $author->display_name );?></a>
								<br />
								<a href="#" class="post-meta"><?php printf( count_user_posts( $author->ID ) );?> posts . 
								<i class="ion-chatbubble"></i> <?php printf( $comment_counts );?> comments</a>
							</div>
						</div>
					</li>
				<?php
				} // endfor
				?>		
				</ul>
			<?php
			}
			wp_reset_query();
			wp_reset_postdata();
			printf( '</div>');
			printf( $after_widget );
		}

		/**
		 * form
		 * for widget in admin page
		 */
		public function form( $instance ){
			$title = !empty( $instance['title'] ) ? $instance['title'] : __( 'Our Authors', 'onfleek' );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php 

			$limit_author = !empty( $instance['limit_author'] ) ? $instance['limit_author'] : '1';
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'limit_author' ) );?>"><?php _e( 'Limit:', 'onfleek');?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit_author' ) );?>" type="text" value="<?php echo esc_attr( $limit_author );?>" >
			</p>
			<?php
		}

		/**
		 * update
		 * sanitize widget form values as they are saved
		 */
		public function update( $new_instance, $old_instance ){
			$instance					= $old_instance;
			$instance['title']			= ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['limit_author']	= ( !empty( $new_instance['limit_author'] ) ) ? $new_instance['limit_author'] : '';
			return $instance;
		}
	}
}

/* file location: /your/file/location/[file].php */