<?php

if (class_exists( 'WP_Customize_Control' )) {
	
	class WP_RetinaLogo_Control extends WP_Customize_Upload_Control {
		public $type = 'upload';
		public $mime_type = '';
		public $button_labels = array();
		public $removed = ''; // unused
		public $context; // unused
		public $extensions = '@2x'; // unused
	}

	class df_slider extends WP_Customize_Control {
		public $type = 'numeric-slider';
		public function enqueue() {
			wp_register_script( 'numeric-slider-control', get_template_directory_uri() . '/inc/df-core/asset/js/admin/numeric-slider.js', array( 'jquery', 'customize-controls' ) );
			wp_enqueue_script( 'numeric-slider-control' );
		}
		public function render_content() {
			$this->input_attrs = wp_parse_args(
			$this->input_attrs,
			array
			(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
			)
			);
		?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
				<span class="range-min"><?php echo esc_attr( $this->input_attrs['min'] ); ?></span>
				<input type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
				<span class="range-max"><?php echo esc_attr( $this->input_attrs['max'] ); ?></span>
				<span class="range-value" style="font-weight:bold;border:1px #555 solid; padding:1px 3px;margin-left:10px;"><?php echo esc_attr( $this->value() ); ?></span>
			</label>
		<?php
		}
	}

	class df_subtitle extends WP_Customize_Control {
		public $type = 'label';
		public function render_content() {
		?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php
		}
	}

}