	<div class="df-to-content-inner">
		
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
	            <div class="field">
	                <h4>Header Background</h4>
	                <span class="description">Choose solid color or upload a custom image for your mobile menu</span>
	            </div>
	        </div>
	        <div class="df-col-2">
	            <div>
                <?php
                        DF_Element_Generator::df_html_color_picker(array(
                            'name'	=> array('header', 'mobile_header', 'bg_color'),
                            'label' => 'Background Color'
                        ));
                    ?>
                </div>
                
	       </div>
	       <div class="df-col-2">
	       	<?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('header', 'mobile_header', 'bg_position'),
                        'options' => DF_Theme_Options::$css_background_position ,
                        'class' => 'df-to-styled-select'
                    )
                    );
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('header', 'mobile_header', 'bg_repeat'),
                        'options' => DF_Theme_Options::$css_background_repeat,
                        'class' => 'df-to-styled-select'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('header', 'mobile_header', 'bg_attachment'),
                        'options' => DF_Theme_Options::$css_background_attachment,
                        'class' => 'df-to-styled-select'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('header', 'mobile_header', 'bg_size'),
                        'options' => DF_Theme_Options::$css_background_size,
                        'class' => 'df-to-styled-select'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_uploader(array(
                        'name'=>array('header', 'mobile_header', 'bg'),
                    ));
                ?>
	       </div>
		</div>

		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
	            <div class="field">
	                <h4>Header Element Colour</h4>
	                <span class="description">Choose the element colour for mobile menu</span>
	            </div>
	        </div>
	        <div class="df-col-2">
	            <?php
	                DF_Element_Generator::df_html_color_picker(array(
						'name'		=>array('header', 'mobile_header', 'element_color'),
						'label'		=> 'Header Element Color'
					));
	            ?>
	       </div>
		</div>

		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
	            <div class="field">
	                <h4>Header Border Bottom Setting</h4>
	                <span class="description">Customize the Border Bottom setting for mobile menu</span>
	            </div>
	        </div>
	        <div class="df-col-2">
	            <?php
					DF_Element_Generator::df_html_numeric(array(
						'name'		=> array('header', 'mobile_header', 'border_px'),
						'class'		=> 'df-input-styled'
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=> array('header', 'mobile_header', 'border_style'),
						'options'	=> DF_Theme_Options::$css_border_style,
						'class'		=> 'df-to-styled-select'
					));
				?>
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('header', 'mobile_header', 'border_color'),
						'label'		=> 'Border Color'
					));
				?>
	       </div>
		</div>

		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
	            <div class="field">
	                <h4>Mobile Menu Typography</h4>
	                <span class="description">Customize the font setting for mobile menu</span>
	            </div>
	        </div>
	        <div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('header', 'mobile_header', 'font_family'),
							'class' 	=> 'select2-font df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('header', 'mobile_header', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('header', 'mobile_header', 'font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('header', 'mobile_header', 'text_transform'),
							'class'		=> 'select2-global df-to-styled-select',
							'options' => array(
								array(
									'value' => 'none',
									'text' => 'None'
								),
								array(
									'value' => 'capitalize',
									'text' => 'Capitalize'
								),
								array(
									'value' => 'uppercase',
									'text' => 'Uppercase'
								),
								array(
									'value' => 'lowercase',
									'text' => 'Lowercase'
								)
								
							)
						));
					?>
				</div>
				<div class="clearfix"></div>
				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('header', 'mobile_header', 'font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('header', 'mobile_header', 'line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label' 	=> 'px'
						));
					?>
				</div>
				
				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('header', 'mobile_header', 'letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="clearfix"></div>
				<div>
					<h4>Font Color</h4>
					<?php
						DF_Element_Generator::df_html_color_picker(array(
							'name'		=> array('header', 'mobile_header', 'regular_color'),
							'label'		=> 'Regular Color'
						));
					?>
					<?php
						DF_Element_Generator::df_html_color_picker(array(
							'name'		=>array('header', 'mobile_header', 'hover_color'),
							'label'		=> 'Hover Color'
						));
					?>
				</div>
			</div>	
		</div>

		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
	            <div class="field">
	                <h4>Mobile Menu Background</h4>
	                <span class="description">Choose custom color for your mobile menu background</span>
	            </div>
	        </div>
	        <div class="df-col-2">
	            <?php
	                DF_Element_Generator::df_html_color_picker(array(
						'name'		=>array('header', 'mobile_header', 'menu_bg_color'),
						'label'		=> 'Mobile Menu Background Color'
					));
	            ?>
	       </div>
		</div>
	</div>