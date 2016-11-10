<?php
/**
* Class: DF_Widget_Advertisement_300
* Description: class for generate widget Advertisement 300x300
*/
if( !class_exists('DF_Widget_Advertisement_300') ) {
	Class DF_Widget_Advertisement_300 extends WP_Widget {
		static $widget_baseID;
		static $widget_name;
	
		function __construct() {
			$widget_upload = array( 'classname' => 'DF_Media_Upload', 'description' => 'Widget that uses Advertise Your Product' );
			parent::__construct( self::get_widget_baseID(), self::get_widget_name(), $widget_upload );
		}
	
		static function df_set_widget( $baseID, $name ) {
			self::$widget_baseID	= $baseID;
			self::$widget_name		= $name;
		}
	
		function get_widget_baseID() {
			return self::$widget_baseID;
		}
	
		function get_widget_name() {
			return self::$widget_name;
		}
	
	/**
	* widget
	* for displaying widget front end
	*/
		public function widget( $args, $instance ) {
			extract( $args );
			$img		= $instance['image'];
			$title		= $instance['title'];
			$alt		= $instance['alt'];
			$link		= $instance['link'];
			$googlecode = $instance['googlecode'] ? : '';
			echo $before_widget;
			?>
			<div class="df-widget-ads">
				<h5 class="df-widget-title"><?php echo $title;?></h5>
				<div class="df-widget-ads-inner">
					<?php 
					if ( '' !== $googlecode ) {
						echo $googlecode;
					} else { ?>
						<a href="<?php echo esc_url( $link );?>" target="_blank"><img src="<?php echo esc_url( $img ); ?>"  alt="<?php echo esc_attr( $alt ); ?>"></a>
					<?php
					}
					?>
				</div>
			</div>
			<?php
		echo $after_widget;
		}
	
	/**
	* form
	* for widget in admin page
	*/
		public function form( $instance ){
			$title = __('For Your Advertisement ( ADS 300 )' , 'onfleek' );
			if(isset($instance['title'])){
				$title = $instance['title'];
			}
			$alt = __('Advertisement', 'onfleek' );
			if(isset($instance['alt'])) {
				$alt = $instance['alt'];
			}
			$image = '';
			if( !empty($instance['image'] ) ){
				$image = $instance['image'];
			}
			$link = '';
			if( !empty($instance['link'] ) ){
				$link = $instance['link'];
			}
			$googlecode = '';
			if( !empty($instance['googlecode'] ) ){
				$googlecode = $instance['googlecode'];
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"><?php _e( 'Title:', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>"><?php _e( 'Image URL:', 'onfleek' ); ?></label>
				<input name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ) ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'alt' ) ); ?>"><?php _e( 'Alt:' , 'onfleek' ); ?></label>
				<input name="<?php echo esc_attr( $this->get_field_name( 'alt' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'alt' ) ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_attr( $alt ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>"><?php _e( 'Link URL:', 'onfleek' ); ?></label>
				<input name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $link ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'googlecode' ) ); ?>"><?php _e( 'Google Code:', 'onfleek' ); ?></label>
				<textarea name="<?php echo esc_attr( $this->get_field_name( 'googlecode' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'googlecode' ) ); ?>" class="widefat" value="<?php echo esc_attr( $googlecode ); ?>" /></textarea>
			</p>
		<?php
		}
	
	/**
	* update
	* sanitize widget form values as they are saved
	*/
		function update( $new_instance, $old_instance ){
			$instance = $old_instance;
			$instance['title']		= ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['image']		= ( !empty( $new_instance['image'] ) ) ? ( $new_instance['image'] ) : '';
			$instance['alt']		= ( !empty( $new_instance['alt'] ) ) ? ( $new_instance['alt'] ) : '';
			$instance['link']		= ( !empty( $new_instance['link'] ) ) ? ( $new_instance['link'] ) : '';
			$instance['googlecode'] = ( !empty( $new_instance['googlecode'] ) ) ? ( $new_instance['googlecode'] ) : '';
			return $instance;
		}
	
	}

}
// endif
/* file location: [theme_directory]/inc/df-core/df-utils/df-widget/df-widget-advertisement300.php */