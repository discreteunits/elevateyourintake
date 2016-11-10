<div class="df-to-content-inner">
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Header Layout</h4>
                <span class="description">Choose between a fullwidth and boxed header style</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
				DF_Element_Generator::df_html_select(array(
					'name' => array('header','header_style_2','header_layout'),
					'class'=>'df-to-styled-select',
					'options' => array(
						array(
							'value' => 'fullwidth',
							'text' => 'Fullwidth'
						),
						array(
							'value' => 'boxed',
							'text' => 'Boxed'
						)
					)
				));
			?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Header Logo Top Padding</h4>
                <span class="description">Customize the top padding of your header area</span>
            </div>
        </div>
        <div class="df-col-2">
             <?php
				 DF_Element_Generator::df_html_slider_bar(array(
				 					'name'=>array('header','header_style_2','header_logo_top_padding')
				 				));
			?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">   
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Header Logo Bottom Padding</h4>
                <span class="description">Customize the bottom padding of your header area</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
				DF_Element_Generator::df_html_slider_bar(array(
					'name'=>array('header','header_style_2','header_logo_bottom_padding'),
				));
			?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Header Logo Background</h4>
                <span class="description">Customize header area background by choosing solid colour or image upload</span>
            </div>
        </div>
        <div class="df-col-2">
            <div>
            	<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'=>array('header','header_style_2','header_logo_bg','bg_color'),
						'label' => 'Background Color'
					));
				?>
            </div>
        
			<?php
				DF_Element_Generator::df_html_select(array(
					'name' => array('header','header_style_2','header_logo_bg','bg_position'),
					'options' => DF_Theme_Options::$css_background_position ,
					'class' => 'df-to-styled-select'
				)
				);
			?>
			<?php
				DF_Element_Generator::df_html_select(array(
					'name' => array('header','header_style_2','header_logo_bg','bg_repeat'),
					'options' => DF_Theme_Options::$css_background_repeat,
					'class' => 'df-to-styled-select'
				));
			?>
			<?php
				DF_Element_Generator::df_html_select(array(
					'name' => array('header','header_style_2','header_logo_bg','bg_attachment'),
					'options' => DF_Theme_Options::$css_background_attachment,
					'class' => 'df-to-styled-select'
				));
			?>
			<?php
				DF_Element_Generator::df_html_select(array(
					'name' => array('header','header_style_2','header_logo_bg','bg_size'),
					'options' => DF_Theme_Options::$css_background_size,
					'class' => 'df-to-styled-select'
				));
			?>
			<?php
				DF_Element_Generator::df_html_uploader(array(
					'name'=>array('header','header_style_2','header_logo_bg','bg'),
				));
			?>
		</div>
	</div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Navigation Background Colour</h4>
                <span class="description">Choose the Background colour of your navigation area</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
				DF_Element_Generator::df_html_color_picker(array(
					'name'	=>array('header','header_style_2','nav_bg_color'),
					'label'	=> 'Navigation Background Color' 
				));
			?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Navigation Top Border</h4>
                <span class="description">Customize the top border of your navigation area</span>
            </div>
        </div>
        <div class="df-col-2">
			<?php
				DF_Element_Generator::df_html_numeric(array(
					'name'=>array('header','header_style_2','top_border','border'),
					'class'=>'df-input-styled'
				));
			?>
			<?php
				DF_Element_Generator::df_html_select(array(
				'name' => array('header','header_style_2','top_border','style'),
				'class'=>'df-to-styled-select',
				'options' => DF_Theme_Options::$css_border_style
			));
			?>
			<?php
				DF_Element_Generator::df_html_color_picker(array(
					'name'		=>array('header','header_style_2','top_border','color'),
					'label' 	=> 'Top Border Color'
				));
			?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Navigation Bottom Border Colour</h4>
                <span class="description">Customize the bottom border of your navigation area</span>
            </div>
        </div>
        <div class="df-col-2">
			<?php
				DF_Element_Generator::df_html_numeric(array(
					'name'=>array('header','header_style_2','bottom_border','border'),
					'class'=>'df-input-styled'
				));
			?>
			<?php
				DF_Element_Generator::df_html_select(array(
				'name' => array('header', 'header_style_2','bottom_border','style'),
				'options' => DF_Theme_Options::$css_border_style,
				'class'=>'df-to-styled-select'
			));
			?>
			<?php
				DF_Element_Generator::df_html_color_picker(array(
					'name'	=>array('header','header_style_2','bottom_border','color'),
					'label'	=> 'Bottom Border Color'
				));
			?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Navigation Text Colour</h4>
                <span class="description">Customize the Text colour of your navigation area</span>
            </div>
        </div>
        <div class="df-col-2">
			<?php
				DF_Element_Generator::df_html_color_picker(array(
					'name'=>array('header','header_style_2','nav_text_color','regular_color'),
					'label' => 'Regular Color'
				));
			?>
			<div>
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'	=> array('header','header_style_2','nav_text_color','hover_color'),
						'label'	=> 'Hover Color'
					));
				?>
			</div>
		</div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Search</h4>
                <span class="description">Enable/disable search feature in your header area</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
				DF_Element_Generator::df_html_switch(array(
					'name'=>array('header','header_style_2','search')
				));
			?>
        </div>
    </div>
</div>
<div id="header-style-1-detail">
   	<div class="df-to-content-inner">
   	 	<div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Social Icon Topbar</h4>
                    <span class="description">Enable/disable Social Icon in your Topbar area</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
				DF_Element_Generator::df_html_switch(array(
					'name'=>array('header','header_style_2','social_icon_topbar')
				));
			?>
            </div>
        </div>
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Topbar Background Colour</h4>
                    <span class="description">Choose the Background colour of your topbar area</span>
                </div>
            </div>
            <div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name' 	=> array('header','header_style_2','topbar_bg_color'),
						'label' => 'Topbar Color'
					));
				?>									
            </div>
        </div>
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Topbar Bottom Border Colour</h4>
                    <span class="description">Customize the bottom border of your topbar area</span>
                </div>
            </div>
            <div class="df-col-2">
					<?php
						DF_Element_Generator::df_html_numeric(array(
							'name'=>array('header','header_style_2','topbar_bottom_border','border'),
							'class' => 'df-input-styled'
						));
					?>
					<?php
						DF_Element_Generator::df_html_select(array(
						'name' => array('header','header_style_2','topbar_bottom_border','style'),
						'options' => DF_Theme_Options::$css_border_style,
						'class' => 'df-to-styled-select'
					));
					?>
					<?php
						DF_Element_Generator::df_html_color_picker(array(
							'name'	=>array('header','header_style_2','topbar_bottom_border','color'),
							'label' => 'Bottom Border Color'
						));
					?>
            </div>
        </div>
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Topbar Text Colour</h4>
                    <span class="description">Customize the Text colour of your topbar area</span>
                </div>
            </div>
            <div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name' 	=> array('header','header_style_2','topbar_text_color','regular_color'),
						'label' => 'Regular Color'
					));
				?>
				<div>
				<?php
					DF_Element_Generator::df_html_color_picker(array(
						'name'	=>array('header','header_style_2','topbar_text_color','hover_color'),
						'label' => 'Hover Color'
					));
				?>	
				</div>									
            </div>
        </div>
   	</div>
</div>