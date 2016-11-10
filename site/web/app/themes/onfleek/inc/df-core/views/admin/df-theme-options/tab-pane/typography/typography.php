	<?php
		DF_Element_Generator::df_html_box_open( array(
			'title' => 'Headings'
		));
	?>
	<div class="df-to-content-inner">
	
		<div class="df-col-1 df-no-padding typography-accordion">
			<h3>In this section you can customize the font settings of each headings level in your site.</h3>
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Headings 1</h4>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_1', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_1', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_1','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'heading_1','text_transform'),
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
				<br>
				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_1','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_1','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_1','letter_spacing'),
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
					<h4>Headings 2</h4>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_2', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_2', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_2','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'heading_2','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_2','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_2','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_2','letter_spacing'),
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
					<h4>Headings 3</h4>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_3', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_3', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_3','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'heading_3','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_3','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_3','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_3','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
			</div>	
		</div>

		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field df-to-typography">
					<h4>Headings 4</h4>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_4', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_4', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_4','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'heading_4','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_4','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_4','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_4','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
			</div>	
		</div>

		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field df-to-typography">
					<h4>Headings 5</h4>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_5', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_5', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_5','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'heading_5','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_5','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_5','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_5','letter_spacing'),
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
					<h4>Headings 6</h4>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_6', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_6', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'heading_6','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'heading_6','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_6','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_6','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_6','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
			</div>	
		</div>
	
	</div>
	<?php 
		DF_Element_Generator::df_html_box_close();
	?>
	
	<?php
		DF_Element_Generator::df_html_box_open( array(
				'title' => 'Body'
			));
		?>
	<div class="df-to-content-inner "> <!-- BODY -->

		<div class="df-col-1 df-no-padding typography-accordion">
			<h3>In this Section you can Customize the Font settings for your Body/Paragraph section in your site.</h3>
		</div>	
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Paragraph (Body)</h4>
					<span class="description">Specify body text font properties</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'paragraph_body', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'paragraph_body', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'paragraph_body','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'paragraph_body','text_transform'),
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
				<br>
				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'paragraph_body','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'paragraph_body','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'paragraph_body','letter_spacing'),
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
					<h4>Paragraph Responsive (Tablet Portrait)</h4>
					<span class="description">customize how you'd like your paragraph's font when displayed in tablet portrait view</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'paragraph_resp_tab_portrait','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'paragraph_resp_tab_portrait','line_height'),
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
					<h4>Paragraph Responsive (Mobile)</h4>
					<span class="description">customize how you'd like your paragraph's font when displayed in mobile phones</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'paragraph_resp_mobile','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'paragraph_resp_mobile','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
			</div>	
		</div>
		
	</div>
	<?php 
			DF_Element_Generator::df_html_box_close();
		?>

		<!-- ELEMENT -->
	<?php
	DF_Element_Generator::df_html_box_open( array(
			'title' => 'Element'
		));
	?>
	<div class="df-to-content-inner">
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding"><!-- BUTTON -->
				<div class="field">
					<h4>Button</h4>
					<span class="description">Specify button text font properties</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'button', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'button', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'button','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'button','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'button','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'button','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'button','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
			</div>	
		</div>

		
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding"><!-- BREADCRUMBS -->
				<div class="field">
					<h4>Breadcrumbs</h4>
					<span class="description">Specify breadcrumbs text font properties</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'breadcrumbs_typo', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'breadcrumbs_typo', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'breadcrumbs_typo','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'breadcrumbs_typo','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'breadcrumbs_typo','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'breadcrumbs_typo','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'breadcrumbs_typo','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
			</div>	
		</div>

		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding"><!-- CATEGORIES -->
				<div class="field">
					<h4>Categories</h4>
					<span class="description">Specify categories text font properties</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'categories_typo', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'categories_typo', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'categories_typo','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'categories_typo','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'categories_typo','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'categories_typo','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'categories_typo','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
			</div>	
		</div>

		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding"><!-- POST META -->
				<div class="field">
					<h4>Post Meta</h4>
					<span class="description">Specify Post Meta text font properties</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'post_meta_typo', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'post_meta_typo', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography', 'post_meta_typo','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography', 'post_meta_typo','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'post_meta_typo','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'post_meta_typo','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'post_meta_typo','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value'
							,
							'label'		=> 'px'
						));
					?>
				</div>
			</div>	
		</div>
		
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding"><!-- SUBTITLE & QUOTE -->
				<div class="field">
					<h4>Subtitle & Quote</h4>
					<span class="description">Specify Subtitle & Quote text font properties</span>
				</div>
			</div>
			<div class="df-col-2">
				<div class="inline df-to-typography">
					<h4>Font-Familly</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography','subtitle_quote_typo', 'font_family'),
							'class'		=> 'select2-font df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Font-Weight</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography','subtitle_quote_typo', 'font_weight'),
							'class'		=> 'select2-variant df-to-styled-select'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Font-Subsets</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=> array('typography','subtitle_quote_typo','font_subsets'),
							'class'		=> 'select2-subset df-to-styled-select'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Text Transform</h4>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name'		=>array('typography','subtitle_quote_typo','text_transform'),
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

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography','subtitle_quote_typo','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography','subtitle_quote_typo','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Letter Spacing</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography','subtitle_quote_typo','letter_spacing'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
			</div>	
		</div>
		
	</div>
	<?php 
			DF_Element_Generator::df_html_box_close();
		?>


	<?php
			DF_Element_Generator::df_html_box_open( array(
				'title' => 'Headings Responsive (Tablet Portrait View)'
			));
		?>
	<div class="df-to-content-inner">
		<div class="df-col-1 df-no-padding typography-accordion">
			<h3>
				In this section you can Customize the Font Settings of each Headings Level in your site when displayed in Tablet Portrait View.
			</h3>
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Headings 1 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">
				
				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_1_resp_tab_portrait','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_1_resp_tab_portrait','line_height'),
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
					<h4>Headings 2 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_2_resp_tab_portrait','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_2_resp_tab_portrait','line_height'),
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
					<h4>Headings 3 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_3_resp_tab_portrait','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_3_resp_tab_portrait','line_height'),
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
					<h4>Headings 4 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_4_resp_tab_portrait','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_4_resp_tab_portrait','line_height'),
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
					<h4>Headings 5 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_5_resp_tab_portrait','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_5_resp_tab_portrait','line_height'),
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
					<h4>Headings 6 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_6_resp_tab_portrait','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_6_resp_tab_portrait','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

			</div>	
		</div>
		


	</div>
	<?php 
			DF_Element_Generator::df_html_box_close();
		?>


	<?php
			DF_Element_Generator::df_html_box_open( array(
				'title' => 'Headings Responsive (Mobile Devices)'
			));
		?>
	<div class="df-to-content-inner">
		<div class="df-col-1 df-no-padding typography-accordion">
			<h3>
				In this Section you can Customize the Font Settings of each Headings Level in your site when displayed in Mobile Phones.
			</h3>
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Headings 1 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">
				
				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_1_resp_mobile','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=>array('typography', 'heading_1_resp_mobile','line_height'),
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
					<h4>Headings 2 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_2_resp_mobile','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_2_resp_mobile','line_height'),
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
					<h4>Headings 3 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_3_resp_mobile','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_3_resp_mobile','line_height'),
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
					<h4>Headings 4 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_4_resp_mobile','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_4_resp_mobile','line_height'),
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
					<h4>Headings 5 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_5_resp_mobile','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_5_resp_mobile','line_height'),
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
					<h4>Headings 6 Responsive Style</h4>
				</div>
			</div>
			<div class="df-col-2">

				<div class="inline df-to-typography">
					<h4>Font-Size</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_6_resp_mobile','font_size'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>
				<div class="inline df-to-typography">
					<h4>Line Height</h4>
					<?php
						DF_Element_Generator::df_html_input(array(
							'name'		=> array('typography', 'heading_6_resp_mobile','line_height'),
							'class'		=> 'df-input-styled-small df-value',
							'label'		=> 'px'
						));
					?>
				</div>

			</div>	
		</div>
		

	</div>

	<?php 
			DF_Element_Generator::df_html_box_close();
		?>
