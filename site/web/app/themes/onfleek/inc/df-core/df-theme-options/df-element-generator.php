<?php
if(!class_exists("DF_Element_Generator")){
	
class DF_Element_Generator{
	
	static function df_generate_name($param){
		if(is_array($param)){
			switch(count($param)){
				
				case 2 :
					return $param[0].'['.$param[1].']';
					break;
				case 3 :	
					return $param[0].'['.$param[1].']'.'['.$param[2].']';
					break;
				case 4 :
					return $param[0].'['.$param[1].']'.'['.$param[2].']'.'['.$param[3].']';
					break;
				case 5 :
					return $param[0].'['.$param[1].']'.'['.$param[2].']'.'['.$param[3].']'.'['.$param[4].']';
					break;
				case 6 :
					return $param[0].'['.$param[1].']'.'['.$param[2].']'.'['.$param[3].']'.'['.$param[4].']'.'['.$param[5].']';
					break;
				
			}
		} else {
			
			return $param;
			
		}
	}	
	static private function df_generate_id($length = 10) {
		
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$id = '';
		for ($i = 0; $i < $length; $i++) {
			$id .= $characters[rand(0, $charactersLength - 1)];
		}
		return $id;
	}
	
	static function df_html_input($param){
		
		$class='';
		$name=self::df_generate_name($param['name']);
		$value=DF_Options_Source::df_get_option_value($param['name']);
		if(isset($param['class'])){
			$class=$param['class'];
		}
		printf( '<input type="text" class="df-to-element %s" name="%s" data-status="%s" id="%s" value="%s" data-default="%s"/>%s<p class="description">%s</p>',
				 esc_attr($class),
				 esc_attr($name),
				 $value == null ? esc_attr('changed') : null,
				 esc_attr($name),
				 esc_attr($value),
				 esc_attr($value),
				 isset( $param['label'] ) ? '<span class="df-add-on">'.esc_html( $param['label'] ).'</span>' : '',
				 esc_html(isset( $param['description'] ) ? $param['description'] : '')
			  );
		
	}
	
	static function df_html_numeric($param){
		$class='';
		$name=self::df_generate_name($param['name']);
		$value=DF_Options_Source::df_get_option_value($param['name']);
		if(isset($param['class'])){
			$class=$param['class'];
		}
		printf( '<input type="number" class="df-to-element %s" name="%s" data-status="%s" id="%s" value="%d" data-default="%d"/>%s<span>%s</span>',
				esc_attr( $class ),
				esc_attr( $name ),
				$value == null ? esc_attr('changed') : null,
				esc_attr( $name ),
				$value == null ? esc_attr('0') : esc_attr( $value ),
				$value == null ? esc_attr('0') : esc_attr( $value ),
				isset( $param['label'] ) ? '<span class="df-add-on">'.esc_html( $param['label'] ).'</span>' : '',
				esc_html( isset( $param['description'] ) ? $param['description'] : '' )
			  );
	}
	
	static function df_html_textarea($param){
		$class='';
		$name=self::df_generate_name($param['name']);
		$value=DF_Options_Source::df_get_option_value($param['name']);
		if(isset($param['class'])){
			$class=$param['class'];
		}
		printf( '<textarea class="df-to-element %s" name="%s" data-status="%s" id="%s" data-default="%s">%s</textarea><span>%s</span>',
				 esc_attr( $class ),
				 esc_attr( $name ),
				 $value == null ? esc_attr('changed') : null,
				 esc_attr( $name ),
				 esc_attr( stripslashes( $value ) ),//esc_attr( esc_js( $value ) ),
				 stripslashes( $value ),// esc_attr( esc_js( $value ) ),
				 esc_html( isset( $param['description'] ) ? $param['description'] : '' )
			  );
	}
	static function df_html_import($param){
		$class='';
		$name=self::df_generate_name($param['name']);
		$value=DF_Options_Source::df_get_option_value($param['name']);
		if(isset($param['class'])){
			$class=$param['class'];
		}
		printf( '<textarea class="%s" name="%s" id="%s" data-default="%s">%s</textarea><span>%s</span>',
				 esc_attr( $class ),
				 esc_attr( $name ),
				 esc_attr( $name ),
				 esc_attr( stripslashes( $value ) ),//esc_attr( esc_js( $value ) ),
				 stripslashes( $value ),// esc_attr( esc_js( $value ) ),
				 esc_html( isset( $param['description'] ) ? $param['description'] : '' )
			  );
	}
	
	static function df_html_export($param){
		$class='';
		if(isset($param['class'])){
			$class=$param['class'];
		}
		$name=self::df_generate_name($param['name']);
		$json_encode = json_encode(DF_Global_Options::$options);
		// $base64_encode = base64_encode($json_encode);
		printf( '<textarea class="%s" name="%s" id="%s" readonly="readonly">%s</textarea><span>%s</span>',
				 esc_attr( $class ),
				 esc_attr( $name ),
				 esc_attr( $name ),
				 stripslashes( $json_encode ),// esc_attr( esc_js( $value ) ),
				 esc_html( isset( $param['description'] ) ? $param['description'] : '' )
			  );
	}
	
	static function df_html_text_editor($param){
		wp_editor( DF_Options_Source::df_get_option_value($param['name']), 
					str_replace(']','-',str_replace('[','-',self::df_generate_name($param['name']))),
					array( 'textarea_name' => self::df_generate_name($param['name']), 'media_buttons' => false , 'teeny' => true) );
	}
	
	static function df_html_select($param){
		$selected="";
		$class='';
		$name=self::df_generate_name($param['name']);
		if(isset($param['class'])){
			$class=$param['class'];
		}
		if( null !== DF_Options_Source::df_get_option_value($param['name']) ){
			$selected=DF_Options_Source::df_get_option_value($param['name']);
		}
		
		if(isset($param['options'])){
			$select = printf('<select name="%s" data-status="%s" id="%s" class="df-to-element %s" data-default="%s">',
				 esc_attr( $name ),
				 $selected == '' ? esc_attr('changed') : null,
				 esc_attr( $name ),
				 esc_attr( $class ),
				 esc_attr( $selected )
				 );
			foreach( $param['options'] as $option ){
				if( $selected == $option['value'] ){
					$select.= printf('<option value="%s" selected="selected">%s</option>',
							  esc_attr( $option['value'] ),
							  esc_html( $option['text'] ) ) ;
				} else {
					$select.= printf('<option value="%s">%s</option>',
							  esc_attr( $option['value'] ),
							  esc_html( $option['text'] ) );
				}
				
			}
			$select .= printf('</select><span>%s</span>',
						   esc_html( isset( $param['description'] ) ? $param['description'] : '' )
						   
						 );			
		} else {
			$select = printf('<input type="text" name="%s" data-status="%s" id="%s" class="df-to-element %s" data-default="%s">%s<span>%s</span>',
				 esc_attr( $name ),
				 $selected == '' ? esc_attr('changed') : null,
				 esc_attr( $name ),
				 esc_attr( $class ),
				 esc_attr( $selected ),
				 esc_html( isset( $param['label'] ) ? '<span class="df-add-on">'.$param['label'].'</span>' : '' ),
				 esc_html( isset( $param['description'] ) ? $param['description'] : '' )
				 );
		}
		
		
	}
	
	static function df_html_visual_select($param){
		$selected="";
		$name=self::df_generate_name($param['name']);
		if( null!== DF_Options_Source::df_get_option_value($param['name'])){
			$selected=DF_Options_Source::df_get_option_value($param['name']);
		} else {
			$selected='default_df_theme_option';
		}
		$select = printf('<div class="df-visual-select"><input type="hidden" name="%s" data-status="%s" id="%s" class="df-to-element" value="%s" data-default="%s">',
						  esc_attr( $name ),
						  $selected == '' ? esc_attr('changed') : null,
						  esc_attr( $name ),
						  esc_attr( $selected ),
						  esc_attr( $selected )
						) ;
		$select.=printf('<ul>');
		foreach( $param['options'] as $option ){
			if( $selected == $option['value'] || $selected == 'default_df_theme_option'){
				$select.= printf('<li class="selected"><img src="%s" data-id="%s"></li>',
								  esc_url( $option['img'] ),
								  esc_attr( $option['value'] )
								);
				$selected='';
			} else {
				$select.= printf('<li><img src="%s" data-id="%s"></li>',
								  esc_url( $option['img'] ),
								  esc_attr( $option['value'] )
								);
			}
			
		}
		$select.=printf('</ul>');
		$select .= printf('<span>%s</span></div>',
						 esc_html ( isset( $param['description'] ) ? $param['description'] : '' )
						 ) ;
		
	}
	
	static function df_html_checkbox( $param ){
		
		$class='';
		$name=self::df_generate_name($param['name']);
		$value=DF_Options_Source::df_get_option_value($param['name']);
		if(isset($param['class'])){
			$class=$param['class'];
		}
		printf( '<div class="checkbox-wrap clearfix"><div class="df-to-checkbox"><input type="hidden" class="df-to-element %s" name="%s" data-status="%s" id="%s" value="%s" data-default="%s" /><i class="iconcheck ion-checkmark"></i></div><span>%s</span></div>', 
				 esc_attr( $class ),
				 esc_attr( $name ),
				 $value == null ? esc_attr('changed') : null,				 
				 esc_attr( $name ), 
				 $value == null ? esc_attr('no') : esc_attr( $value ),
				 $value == null ? esc_attr('no') : esc_attr( $value ),
				 esc_html( isset( $param['label'] ) ? $param['label'] : '' )
				 );                                 
	}
	
	static function df_html_switch( $param ){
		$name=self::df_generate_name($param['name']);
		$value=DF_Options_Source::df_get_option_value($param['name']); 
		printf('<div class="df-switch Off" 
					data-additional="%s"
					data-event="%s"
					data-type="%s"
					data-area="%s"
					data-extend-view="%s">
					<div class="Toggle"></div>
					<input type="hidden" 
					class="df-to-element" 
					name="%s"  data-status="%s"
					id="%s" 
					value="%s" 
					data-default="%s"
					></div><span>%s</span>',
					esc_attr( isset( $param['additional'] ) ? 'true' : 'false' ),
					esc_attr( isset( $param['additional']['event'] ) ? $param['additional']['event'] : '' ),
					esc_attr( isset( $param['additional']['type'] ) ? $param['additional']['type'] : '' ),
					esc_attr( isset( $param['additional']['area'] ) ? $param['additional']['area'] : '' ),
					esc_attr( isset( $param['additional']['view'] ) ? $param['additional']['view'] : '' ),
					esc_attr( $name ),
					$value == null ? esc_attr('changed') : null,	
					esc_attr( $name ),
					$value == null ? esc_attr('no') : esc_attr( $value ),
					$value == null ? esc_attr('no') : esc_attr( $value ),
					esc_html( isset( $param['description'] ) ? $param['description'] : '' )
			  );									                           
	}
	
	static function df_html_color_picker($param){
		$name=self::df_generate_name($param['name']);
		$value=DF_Options_Source::df_get_option_value($param['name']); 
		printf('<div class="inline"><input type="text" class="df-to-element my-color-field" name="%s" data-status="%s" id="%s" value="%s" data-title="%s"/></div>',
			   esc_attr( $name ),
			   $value == null ? esc_attr('changed') : null,	
			   esc_attr( $name ),
			   $value !== null ? esc_attr( $value ) : esc_attr('#000000'),
			   esc_attr( isset( $param['label'] ) ? $param['label'] : 'Select Colour' )
			   );
	}
	
	static function df_html_slider_bar($param){
		$name=self::df_generate_name($param['name']);
		$value=DF_Options_Source::df_get_option_value($param['name']);
		printf('<div>
				<div class="df-value-bar-container">
					<input type="number" class="df-to-element slider-value df-value " name="%s" data-status="%s" id="%s" value="%d" maxlength="3" max="100" min="0" data-default="%d"/>
				</div>
				<div class="df-slider-bar"></div>
				</div>
				<span>%s</span>',
				esc_attr($name),
				$value == null ? esc_attr('changed') : null,
				esc_attr($name),
				$value == null ? esc_attr('0') : esc_attr($value),
				$value == null ? esc_attr('0') : esc_attr($value),
				esc_html(isset( $param['description'] ) ? $param['description'] : '')
			  );
	}
	
	static function df_html_uploader($param){
		$name=self::df_generate_name($param['name']);
		$value=DF_Options_Source::df_get_option_value($param['name']);
		$image=get_template_directory_uri().'/inc/df-core/asset/images/admin/no_img_upload.png';
		if(DF_Options_Source::df_get_option_value($param['name']) !== null and DF_Options_Source::df_get_option_value($param['name']) !== '' and $name !='logo[fav_icon]'){
			$image=DF_Options_Source::df_get_option_value($param['name']);
		} else if($name =='logo[fav_icon]' and $value !== null){
			$image=wp_get_attachment_image_src( $value );
			$image = $image[0];
		}
		printf('<div class="df-uploader" id="%s">
				  <img src="%s">
					<div class="df-to-upload-button">
						<input type="hidden" class="df-to-element df-uploader-path" name="%s" value="%s" data-default="%s"/>
						<a type="button" class="button df-upload-button">Upload Image</a>
						<a type="button" class="button df-delete-upload-button">Remove</a>
					</div>
					<span>%s</span>
				</div>',
				esc_attr( $name ),
				esc_url( $image ),
				esc_attr( $name ),
				esc_attr( $value ),
				esc_attr( $value ),
				esc_html(isset( $param['description'] ) ? $param['description'] : '' )
			 );
	}
	
	static function df_html_radio($param){
		$selected="";
		$class='';
		$name=self::df_generate_name($param['name']);
		if(isset($param['class'])){
			$class=$param['class'];
		}
		if( null !== DF_Options_Source::df_get_option_value($param['name']) ){
			$selected=DF_Options_Source::df_get_option_value($param['name']);
		}
		$select='';
		foreach( $param['options'] as $option ){
			if( $selected == $option['value'] ){
				$select.= printf('<div class="df-to-radio-button"><input type="radio" class="df-to-element %s" name="%s" id="%s" value="%s" data-default="%s" checked><span>%s</span></div>',
						  esc_attr( $class ),
						  esc_attr( $name ),
						  esc_attr( $name ),
						  esc_attr( $option['value'] ),
						  esc_attr( $selected ),
						  esc_html( $option['text'] )
						  );
			} else {
				$select.= printf('<div class="df-to-radio-button"><input type="radio" class="df-to-element %s" name="%s" id="%s" value="%s" data-default="%s"><span>%s</span></div>',
						  esc_attr( $class ),
						  esc_attr( $name ),
						  esc_attr( $name ),
						  esc_attr( $option['value'] ),
						  esc_attr( $selected ),
						  esc_html( $option['text'] )
						  );
			}
			
		}
	}
	
	static function df_sidebar_list () {
			$all = DF_Theme_Options::df_all_generated_sidebars();
			$list = '<div id="df-sidebars" class="accordion-container df-sidebars-list ">';
			$list .= '<ul class="connected-sidebars-lists ui-sortable">';
				if( !empty( $all ) ){
					foreach ( (array) $all as $key => $value ) {
						$list .= sprintf( '<li id="%s" class="control-section accordion-section">', $value['id'] );
						$list .= sprintf( '<h3 class="accordion-section-title">%1$s<a href="#" class="df-sidebars-delete" data-id="%2$s"><i class="fa fa-trash-o"></i></a></h3>', $value['name'], $value['id'] ) ;
						$list .= '<div class="accordion-section-content">';
						$list .= sprintf( '<div><h4>%s</h4>', esc_html( 'Name' ) );

						$list .= sprintf ('<input id="sidebars[additional][%1$s][name]" class="df-input-styled df-to-element" type="text" value="%2$s"  data-default="%2$s" name="sidebars[additional][%1$s][name]">', 
											 esc_attr( $value['id'] ), 
 											 esc_attr( $value['name'] ) 
										 );
						$list .= '</div>';
						$list .= sprintf ('<input id="sidebars[additional][%1$s][id]" class="df-input-styled df-to-element" type="hidden" value="%1$s"  data-status="changed" data-default="%1$s" name="sidebars[additional][%1$s][id]">', 
											 esc_attr( $value['id'] ) );
						$list .= sprintf( '<div><h4>%s</h4>', 'Description' );
						$list .= sprintf ('<textarea id="sidebars[additional][%1$s][description]" class="large-text code df-to-element" data-default="%2$s" data-status="changed" name="sidebars[additional][%1$s][description]">%2$s</textarea>', 
											 esc_attr( $value['id'] ), 
											 esc_attr( $value['name'] )
										 );
						$list .= '</div>';
						$list .= '</li>';

					}
				}
			$list .= '</ul>';
			$list .= '</div>';
			print_r( $list );
	}
	
	static function df_html_box_open($param){
		$list = printf('<div class="df-box-element df-col-1"><div class="accordion-container df-sidebars-list" >
						<ul class="ui-sortable">
							<li id="" class="control-section accordion-section">
								<h3 class="accordion-section-title">%s</h3>
									<div class="accordion-section-content">',
					  esc_html(isset($param['title'])?$param['title']:'')
					  );
	}
	
	static function df_html_box_close(){
		$list = printf('
							</div>
						</li>
					</ul>
				</div></div>');
	}
	
	static function html_box_ajax($param){
		$list = printf('<div class="df-box-element df-col-1">
							<div class="accordion-container df-sidebars-list" >
								<ul class="ui-sortable">
									<li id="" class="control-section accordion-section" is-ajax="true" data-view="%s">
										<h3 class="accordion-section-title">%s</h3>
										<div class="accordion-section-content" data-content="none" id="%s" data-id="%s" data-name="%s"></div>
									</li>
								</ul>
							</div>
						</div>',
					  esc_attr(isset($param['view'])?$param['view']:''),
					  esc_html(isset($param['title'])?$param['title']:''),
					  esc_attr(self::df_generate_id()),
					  esc_attr(isset($param['id'])?$param['id']:''),
					  esc_attr(isset($param['view'])?$param['title']:'')
					  );
	}

	
}

}
?>
