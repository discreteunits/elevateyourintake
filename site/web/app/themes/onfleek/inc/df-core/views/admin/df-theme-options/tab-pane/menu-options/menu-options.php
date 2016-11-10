	<div class="df-to-content-inner">
		<h3>Topbar Typography Option</h3>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Topbar Menu Typography</h4>
					<span class="description">Customize the font settings for your topbar menu</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('menu_options', 'topbar_menu', 'font_family'),
							'class' 	=> 'select2-font df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('menu_options', 'topbar_menu', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('menu_options', 'topbar_menu','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('menu_options', 'topbar_menu','text_transform'),
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
							'name'		=> array('menu_options', 'topbar_menu','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label' 	=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('menu_options', 'topbar_menu','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label' 	=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('menu_options', 'topbar_menu','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label' 	=> 'px'
						));
					?>
				</div>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Topbar Menu Dropdown Typography</h4>
					<span class="description">Customize the font settings for your topbar menu dropdown</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
				<h4>Font-Familly</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=> array('menu_options', 'topbar_menu_dropdown', 'font_family'),
						'class'		=> 'select2-font df-to-styled-select'
					));
				?>
				</div>
				<div class="inline  df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('menu_options', 'topbar_menu_dropdown', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
				<h4>Font-Subsets</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=> array('menu_options', 'topbar_menu_dropdown','font_subsets'),
						'class'		=> 'select2-subset df-to-styled-select'
					));
				?>
				</div>
				<div class="inline  df-to-typography">
				<h4>Text Transform</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
							'name'		=>array('menu_options', 'topbar_menu_dropdown','text_transform'),
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
							'name'		=> array('menu_options', 'topbar_menu_dropdown','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('menu_options', 'topbar_menu_dropdown','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('menu_options', 'topbar_menu_dropdown','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="clearfix"></div>

				<div class="inline df-to-typography">
					<h4>Font Color</h4>
					<?php
						DF_Element_Generator::df_html_color_picker(array(
							'name'		=> array('menu_options', 'topbar_menu_dropdown','regular_color'),
							'label'		=> 'Regular Color'
						));
					?>
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=>array('menu_options', 'topbar_menu_dropdown','hover_color'),
						'label'		=> 'Hover Color'
					));
				?>
				</div>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Topbar Dropdown Background Colour</h4>
					<span class="description">Pick the Backgorund colour for your topbar dropdown area</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=>array('menu_options', 'topbar_menu_dropdown','background_color'),
						'label'		=> 'Background'
					));
				?>
				</div>
			</div>
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Topbar Dropdown Border</h4>
					<span class="description">Pick the Border Color For your topbar dropdown area</span>
				</div>
			</div>
			<div class="df-col-2">

				<?php
					DF_Element_Generator::df_html_numeric(array(
						'name'		=> array('menu_options', 'topbar_menu_dropdown','border_px'),
						'class'		=> 'df-input-styled'
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=> array('menu_options', 'topbar_menu_dropdown','border_style'),
						'options'	=> DF_Theme_Options::$css_border_style,
						'class'		=> 'df-to-styled-select'
					));
				?>
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('menu_options', 'topbar_menu_dropdown','border_color'),
						'label'		=> 'Border Color'
					));
				?>
			</div>
		</div>		
	</div>

	<div class="df-to-content-inner">
		<h3>Main Navigation Option</h3>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Main Navigation Typography</h4>
					<span class="description">Customize the font settings for your main navigation</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
				<h4>Font-Familly</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=> array('menu_options', 'main_navigation', 'font_family'),
						'class' 	=> 'select2-font df-to-styled-select'
					));
				?>
				</div>

				<div class="inline df-to-typography">
				<h4>Font-Weight</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=>array('menu_options', 'main_navigation', 'font_weight'),
						'class'		=> 'select2-variant df-to-styled-select'
					));
				?>
				</div>
				<div class="inline df-to-typography">
				<h4>Font-Subsets</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=> array('menu_options', 'main_navigation','font_subsets'),
						'class'		=> 'select2-subset df-to-styled-select'
					));
				?>
				</div>

				<div class="inline df-to-typography">
				<h4>Text Transform</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
							'name'		=>array('menu_options', 'main_navigation','text_transform'),
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
						'name'		=> array('menu_options', 'main_navigation','font_size'),
						'class'		=> 'df-input-styled-small df-value',
						'label'		=> 'px'
					));
				?>
				</div>
				<div class="inline df-to-typography">
				<h4>Line Height</h4>
				<?php
					DF_Element_Generator::df_html_input(array(
						'name'		=>array('menu_options', 'main_navigation','line_height'),
						'class'		=> 'df-input-styled-small df-value',
						'label'		=> 'px'
					));
				?>
				</div>
				<div class="inline df-to-typography">
				<h4>Letter Spacing</h4>
				<?php
					DF_Element_Generator::df_html_input(array(
						'name'		=>array('menu_options', 'main_navigation','letter_spacing'),
						'class'		=> 'df-input-styled-small df-value',
						'label'		=> 'px'
					));
				?>
				</div>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Main Navigation Dropdown Typography</h4>
					<span class="description">Customize the font settings for your main navigation dropdown</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
				<h4>Font-Familly</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=> array('menu_options', 'main_navigation_dropdown', 'font_family'),
						'class' 	=> 'select2-font df-to-styled-select'
					));
				?>
				</div>
				<div class="inline df-to-typography">
				<h4>Font-Weight</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=>array('menu_options', 'main_navigation_dropdown', 'font_weight'),
						'class'		=> 'select2-variant df-to-styled-select'
					));
				?>
				</div>
				<div class="inline df-to-typography">
				<h4>Font-Subsets</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=> array('menu_options', 'main_navigation_dropdown','font_subsets'),
						'class'		=> 'select2-subset df-to-styled-select'
					));
				?>
				</div>
				<div class="inline df-to-typography">
				<h4>Text Transform</h4>
				<?php
					DF_Element_Generator::df_html_select(array(
							'name'		=>array('menu_options', 'main_navigation_dropdown','text_transform'),
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
						'name'		=> array('menu_options', 'main_navigation_dropdown','font_size'),
						'class'		=> 'df-input-styled-small df-value',
						'label'		=> 'px'
					));
				?>
				</div>
				<div class="inline df-to-typography">
				<h4>Line Height</h4>
				<?php
					DF_Element_Generator::df_html_input(array(
						'name'		=>array('menu_options', 'main_navigation_dropdown','line_height'),
						'class'		=> 'df-input-styled-small df-value',
						'label'		=> 'px'
					));
				?>
				</div>
				<div class="inline df-to-typography">
				<h4>Letter Spacing</h4>
				<?php
					DF_Element_Generator::df_html_input(array(
						'name'		=>array('menu_options', 'main_navigation_dropdown','letter_spacing'),
						'class'		=> 'df-input-styled-small df-value',
						'label'		=> 'px'
					));
				?>
				</div>

				<div class="clearfix"></div>

				<div class="inline df-to-typography">
				<h4>Font Color</h4>
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('menu_options', 'main_navigation_dropdown','regular_color'),
						'label'		=> 'Regular Color'
					));
				?>
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=>array('menu_options', 'main_navigation_dropdown','hover_color'),
						'label'		=> 'Hover Color'
					));
				?>
				</div>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Main Navigation Dropdown Background Colour</h4>
					<span class="description">Pick the Backgorund colour for your main navigation dropdown area</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=>array('menu_options', 'main_navigation_dropdown','background_color'),
						'label'		=> 'Background'
					));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Main Navigation Dropdown Border</h4>
					<span class="description">Pick the Border Colour For your topbar main navigation area.</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
				<?php
					DF_Element_Generator::df_html_numeric(array(
						'name'		=> array('menu_options', 'main_navigation_dropdown','border_px'),
						'class'		=> 'df-input-styled'
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name'		=> array('menu_options', 'main_navigation_dropdown','border_style'),
						'options'	=> DF_Theme_Options::$css_border_style,
						'class'		=> 'df-to-styled-select'
					));
				?>
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('menu_options', 'main_navigation_dropdown','border_color'),
						'label'		=> 'Border Color'
					));
				?>
				</div>
			</div>
		</div>		
	</div>
