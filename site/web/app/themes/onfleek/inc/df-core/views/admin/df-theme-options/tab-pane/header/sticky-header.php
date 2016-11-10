<div class="df-to-content-inner">
	<div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Sticky Header</h4>
                <span class="description">Enable/Disable Sticky Header</span>
            </div>
        </div>
        <div class="df-col-2">
              <?php
				 DF_Element_Generator::df_html_switch(array(
					'name'=>array('header','sticky_header','is_sticky_header'),
					'additional'=>array(
						 'event'=>'change',
						 'type'=>'non-ajax',
						 'area'=>'detail-sticky-header'
					)
				 ));
			 ?>
        </div>
    </div>
</div>
<div id="detail-sticky-header">
    <div class="df-to-content-inner">
    	<div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Sticky Header Background</h4>
                    <span class="description">Choose solid color or upload a custom image for your sticky header background</span>
                </div>
            </div>
			<div class="df-col-2">
                <div>
                	<?php
						DF_Element_Generator::df_html_color_picker(array(
							'name'	=> array('header','sticky_header','sticky_header_bg','bg_color'),
							'label' => 'Background Color'
						));
					?>
                </div>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('header','sticky_header','sticky_header_bg','bg_position'),
						'class' => 'df-to-styled-select',
						'options' => DF_Theme_Options::$css_background_position
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('header','sticky_header','sticky_header_bg','bg_repeat'),
						'class' => 'df-to-styled-select',
						'options' => DF_Theme_Options::$css_background_repeat
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('header','sticky_header','sticky_header_bg','bg_attachment'),
						'class' => 'df-to-styled-select',
						'options' => DF_Theme_Options::$css_background_attachment
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('header','sticky_header','sticky_header_bg','bg_size'),
						'class' => 'df-to-styled-select',
						'options' => DF_Theme_Options::$css_background_size
					));
				?>
				<?php
					DF_Element_Generator::df_html_uploader(array(
						'name'=>array('header', 'sticky_header','sticky_header_bg','bg')
					));
				?>
			</div>
        </div>
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Sticky Header Border Bottom Setting</h4>
                    <span class="description">Customize the Border Bottom setting for your sticky header</span>
                </div>
            </div>
            <div class="df-col-2">
					<?php
						DF_Element_Generator::df_html_numeric(array(
							'name'=>array('header','sticky_header','bottom_border','border'),
							'class' => 'df-input-styled'
						));
					?>
					<?php
						DF_Element_Generator::df_html_select(array(
							'name' => array('header','sticky_header','bottom_border','style'),
							'class' => 'df-to-styled-select',
							'options' => DF_Theme_Options::$css_border_style
						));
					?>
					<?php
						DF_Element_Generator::df_html_color_picker(array(
							'name'	=> array('header','sticky_header','bottom_border','color'),
							'label' => 'Bottom Border Color'
						));
					?>
            </div>
        </div>
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Sticky Header Text Colour</h4>
                    <span class="description">Customize the text colour of your sticky header navigation</span>
                </div>
            </div>
            <div class="df-col-2">
				<div>
					<?php
						DF_Element_Generator::df_html_color_picker(array(
							'name'	=> array('header','sticky_header','nav_text_color','regular_color'),
							'label' => 'Regular Color'
						));
					?>
				</div>
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'	=> array('header','sticky_header','nav_text_color','hover_color'),
						'label' => 'Hover Color'
					));
				?>
			</div>											
        </div>
    </div>
</div>