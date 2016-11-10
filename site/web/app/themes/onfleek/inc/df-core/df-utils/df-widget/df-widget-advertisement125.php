<?php
/**
* Class: DF_Widget_Advertisement_125
* Description: class for generate widget Advertisement 125x125
*/
if ( !class_exists('DF_Widget_Advertisement_125') ) {
	Class DF_Widget_Advertisement_125 extends WP_Widget {
		static $widget_baseID;
		static $widget_name;
		
		function __construct() {
			$widget_upload = array( 'classname' => 'DF_Media_Upload', 'description' => 'Widget that uses Advertise Your Product' );
			parent::__construct( self::get_widget_baseID(), self::get_widget_name(), $widget_upload );
		}
		
		static function df_set_widget( $baseID, $name ) {
			self::$widget_baseID 	= $baseID;
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
			$title	= $instance['title'];
			$image1 = $instance['image1'];
			$image2 = $instance['image2'];
			$image3 = $instance['image3'];
			$image4 = $instance['image4'];  
			$alt1	= $instance['alt1'];
			$alt2	= $instance['alt2'];
			$alt3	= $instance['alt3'];
			$alt4	= $instance['alt4'];
			$link1	= $instance['link1'];
			$link2	= $instance['link2'];
			$link3	= $instance['link3'];
			$link4	= $instance['link4'];
			echo $before_widget;
		?>
			<div class="df-widget-ads">
				<h5 class="df-widget-title"><?php echo esc_html( $title );?></h5>
				<div class="df-widget-ads-inner">
					<?php
						if ( isset( $image1 ) ) { ?>
							<div class="df-widget-ads-125 slot-1">
								<a href="<?php echo esc_url( $link1 );?>" target="_blank"><img src="<?php echo esc_url( $image1 );?>" alt="<?php echo esc_attr( $alt1 );?>"></a>
							</div>
					<?php
						}
						if ( isset( $image2 ) ) { ?>
							<div class="df-widget-ads-125 slot-2">
								<a href="<?php echo esc_url( $link2 );?>" target="_blank"><img src="<?php echo esc_url( $image2 );?>" alt="<?php echo esc_attr( $alt2 );?>"></a>
							</div>
					<?php
						}
						if ( isset( $image3 ) ) { ?>
							<div class="df-widget-ads-125 slot-3">
								<a href="<?php echo esc_url( $link3 );?>" target="_blank"><img src="<?php echo esc_url( $image3 );?>" alt="<?php echo esc_url( $alt3 );?>"></a>
							</div>
					<?php
						}
						if ( isset( $image4 ) ) { ?>
							<div class="df-widget-ads-125 slot-4">
								<a href="<?php echo esc_url( $link4 );?>" target="_blank"><img src="<?php echo esc_url( $image4 );?>" alt="<?php echo esc_url( $alt4 );?>"></a>
							</div>
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
			$title 	= __('For Your Advertisement ( ADS 125 )' , 'onfleek' );
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			}
			$alt1 	= __( 'Advertisement', 'onfleek' );
			if ( isset( $instance[ 'alt1' ] ) ) {
				$alt1 = $instance[ 'alt1' ];
			}
			$alt2 	= __( 'Advertisement', 'onfleek' );
			if ( isset( $instance[ 'alt2' ] ) ) {
				$alt2 = $instance[ 'alt2' ];
			}
			$alt3 	= __( 'Advertisement', 'onfleek' );
			if ( isset( $instance[ 'alt3' ] ) ) {
				$alt3 = $instance[ 'alt3' ];
			}
			$alt4 	= __( 'Advertisement', 'onfleek' );
			if ( isset( $instance[ 'alt4' ] ) ) {
				$alt4 = $instance[ 'alt4' ];
			}
			$image1 = '';
			if ( !empty( $instance[ 'image1' ] ) ) {
				$image1 = $instance[ 'image1' ];
			}
			$image2 = '';
			if ( !empty( $instance[ 'image2' ] ) ) {
				$image2 = $instance[ 'image2' ];
			}
			$image3 = '';
			if ( !empty( $instance[ 'image3' ] ) ) {
				$image3 = $instance[ 'image3' ];
			}
			$image4 = '';
			if ( !empty( $instance[ 'image4' ] ) ) {
				$image4 = $instance[ 'image4' ];
			}
			$link1	= '';
			if ( !empty( $instance[ 'link1' ] ) ) {
				$link1 = $instance['link1'];
			}
			$link2	= '';
			if ( !empty( $instance[ 'link2' ] ) ) {
				$link2 = $instance[ 'link2' ];
			}
			$link3	= '';
			if ( !empty( $instance[ 'link3' ] ) ) {
				$link3 = $instance['link3'];
			}
			$link4	= '';
			if ( !empty( $instance[ 'link4' ] ) ) {
				$link4 = $instance[ 'link4' ];
			}
		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"><?php _e( 'Title:', 'onfleek' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<?php $i = 0; while ( $i < 4 ) : $i++ ?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_name( 'image' . $i ) ); ?>"><?php _e( 'Image URL:', 'onfleek' ); ?></label>
					<input name="<?php echo esc_attr( $this->get_field_name( 'image' . $i ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' . $i ) ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( ${'image' . $i} ); ?>" />
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_name( 'alt' . $i ) ); ?>"><?php _e( 'Alt:' , 'onfleek'); ?></label>
					<input name="<?php echo esc_attr( $this->get_field_name( 'alt' . $i ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'alt' . $i ) ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_attr( ${'alt' . $i} ); ?>" />
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_name( 'link' . $i ) ); ?>"><?php _e( 'Link URL:', 'onfleek' ); ?></label>
					<input name="<?php echo esc_attr( $this->get_field_name( 'link' . $i ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'link' . $i ) ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( ${'link' . $i} ); ?>" />
				</p>
			<?php 
			endwhile; ?>
			<?php
		}
		
		
		/**
		* update
		* sanitize widget form values as they are saved
		*/
		function update( $new_instance, $old_instance ){
			$instance			= $old_instance;
			$instance['title']	= ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['image1'] = ( !empty( $new_instance['image1'] ) ) ? ( $new_instance['image1'] ) : '';
			$instance['image2'] = ( !empty( $new_instance['image2'] ) ) ? ( $new_instance['image2'] ) : '';
			$instance['image3'] = ( !empty( $new_instance['image3'] ) ) ? ( $new_instance['image3'] ) : '';
			$instance['image4'] = ( !empty( $new_instance['image4'] ) ) ? ( $new_instance['image4'] ) : '';
			
			$instance['alt1']	= ( !empty( $new_instance['alt1'] ) ) ? ( $new_instance['alt1'] ) : '';
			$instance['alt2']	= ( !empty( $new_instance['alt2'] ) ) ? ( $new_instance['alt2'] ) : '';
			$instance['alt3']	= ( !empty( $new_instance['alt3'] ) ) ? ( $new_instance['alt3'] ) : '';
			$instance['alt4']	= ( !empty( $new_instance['alt4'] ) ) ? ( $new_instance['alt4'] ) : '';
			
			$instance['link1']	= ( !empty( $new_instance['link1'] ) ) ? ( $new_instance['link1'] ) : '';
			$instance['link2']	= ( !empty( $new_instance['link2'] ) ) ? ( $new_instance['link2'] ) : '';
			$instance['link3']	= ( !empty( $new_instance['link3'] ) ) ? ( $new_instance['link3'] ) : '';
			$instance['link4']	= ( !empty( $new_instance['link4'] ) ) ? ( $new_instance['link4'] ) : '';
			return $instance;
		}
	}
}
/* file location: /your/file/location/[file].php */