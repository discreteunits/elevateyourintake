<?php
if (!function_exists('vc_map_get_attributes')) {
	include get_template_directory() . "vc_templates/vc_column_base.php";
}else{
	/**
	 * Shortcode attributes
	 * @var $atts
	 * @var $el_class
	 * @var $width
	 * @var $css
	 * @var $offset
	 * @var $content - shortcode content
	 * Shortcode class
	 * @var $this WPBakeryShortCode_VC_Column
	 */
	$el_class = $width = $css = $offset = '';
	$output = '';
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
	extract( $atts );

	global $df_column_block, $df_row_block; 
	if (empty($width)) {
		$df_column_block = '1/1';
	} else {
		$df_column_block = $width;
	}

	$width = wpb_translateColumnWidthToSpan( $width );

	$new_class = str_replace('vc', 'df', $width );

	$width = vc_column_offset_class_merge( $offset, $width );

	$css_classes = array(
		$this->getExtraClass( $el_class ),
		'wpb_column',
		'vc_column_container',
		$width,
		$new_class
	);

	if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='vc_col-has-fill';
	}

	$wrapper_attributes = array();

	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

	$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
	$output .= '<div class="wpb_wrapper">';
	$output .= wpb_js_remove_wpautop( $content );
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	echo $output;
}