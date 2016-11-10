	<div class="df-to-content-inner">
		<h3>Sidebar Option</h3>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Widget Top Padding</h4>
					<span class="description">Change the spacing above the content within the widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_slider_bar(array(
										'name'=>array('sidebars','widget_top_padding')
									));
				?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Widget Bottom Padding</h4>
					<span class="description">Change the spacing below the content within the widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_slider_bar(array(
										'name'=>array('sidebars','widget_bottom_padding')
									));
				?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Widget Left Padding</h4>
					<span class="description">Change the left spacing of the content within the widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_slider_bar(array(
										'name'=>array('sidebars','widget_left_padding')
									));
				?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Widget Right Padding</h4>
					<span class="description">Change the right spacing of the content within the widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_slider_bar(array(
										'name'=>array('sidebars','widget_right_padding')
									));
				?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Widget Background Colour</h4>
					<span class="description">Specify the background colour for your sidebar widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('sidebars', 'background_color'),
						'label'		=> 'Background Color'
					));
				?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Widget Title Colour</h4>
					<span class="description">Widget Title Colour</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('sidebars', 'widget_title_color'),
						'label'		=> 'Widget Title Color'
					));
				?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Heading Text Colour</h4>
					<span class="description">Specify the heading text colour for your sidebar widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('sidebars', 'heading_element_color'),
						'label'		=> 'Heading Element Color'
					));
				?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Paragraph Text Colour</h4>
					<span class="description">Specify the paragraph text colour for your sidebar widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('sidebars', 'p_element_color'),
						'label'		=> 'P Element Color'
					));
				?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Link Colour</h4>
					<span class="description">Specify the link colour for your sidebar widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('sidebars', 'link_color'),
						'label'		=> 'Link Color'
					));
				?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Extra Colour</h4>
					<span class="description">Specify the extra colour for your sidebar widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('sidebars', 'extra_color'),
						'label'		=> 'Extra Color'
					));
				?>
			</div>	
		</div>		
		<div class="df-col-1 df-to-section">   
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Border Colour</h4>
					<span class="description">Specify the border colour for your sidebar widget</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'		=> array('sidebars', 'border_color'),
						'label'		=> 'Border Color'
					));
				?>
			</div>	
		</div>
	</div>