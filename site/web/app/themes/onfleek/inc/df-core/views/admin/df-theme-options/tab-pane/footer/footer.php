<div class="df-to-content-inner">
	<h3>Footer</h3>
	<div class="df-col-1 df-to-section">
		<div class="df-col-5 df-no-padding">
			<div class="field">
				<h4>Display Footer</h4>
				<span class="description">Enable this option to display a footer section in your site</span>
			</div>
		</div>
		<div class="df-col-2">
			<?php
                DF_Element_Generator::df_html_switch(array(
                    'name'=> array('footer', 'is_display_footer')
                ));
            ?>
		</div>
	</div>
  
   <div class="df-col-1 df-to-section">
      <div class="df-col-5 df-no-padding">
          <div class="field">
              <h4>Footer Area Layout</h4>
              <span class="description">Choose the layout of your content area.</span>
          </div>
      </div>
      <div class="df-col-2">
          <?php
            DF_Element_Generator::df_html_select(array(
              'name' => array('footer', 'footer_area_layout'),
                        'class' => 'df-to-styled-select',
              'options' => array(
                array(
                  'value' => 'full',
                  'text' => 'Full'
                ),
                array(
                  'value' => 'boxed',
                  'text' => 'Boxed'
                ),
              )
            ));
          ?>
     </div>
  </div>

	<div class="df-col-1 df-to-section">
		<div class="df-col-5 df-no-padding">
			<div class="field">
				<h4>Footer Layout</h4>
				<span class="description">Choose the default layout for your footer</span>
			</div>
		</div>
		<div class="df-col-2">
			<?php
                DF_Element_Generator::df_html_visual_select(array(
                    'name' => array('footer','footer_layout'),
                    'class'=>'df-to-styled-select',
                    'options' => array(
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-1.png',
                            'value' => 'footer-layout-1'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-2.png',
                            'value' => 'footer-layout-2'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-3.png',
                            'value' => 'footer-layout-3'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-4.png',
                            'value' => 'footer-layout-4'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-5.png',
                            'value' => 'footer-layout-5'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-6.png',
                            'value' => 'footer-layout-6'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-7.png',
                            'value' => 'footer-layout-7'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-8.png',
                            'value' => 'footer-layout-8'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-9.png',
                            'value' => 'footer-layout-9'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-10.png',
                            'value' => 'footer-layout-10'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-11.png',
                            'value' => 'footer-layout-11'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-12.png',
                            'value' => 'footer-layout-12'
                        ),
                        array(
                            'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/footer-13.png',
                            'value' => 'footer-layout-13'
                        )
                    )
                ));
            ?>
		</div>
	</div>

	<div class="df-col-1 df-to-section">
		<div class="df-col-5 df-no-padding">
			<div class="field">
				<h4>Footer Logo Upload</h4>
				<span class="description">Upload a custom image for your footer logo</span>
			</div>
		</div>
		<div class="df-col-5">
			<?php
				DF_Element_Generator::df_html_uploader(array(
					'name' => array('footer','footer_logo_normal'),
                    'label' => 'Desktop Footer Logo'
				));
			?>
		</div>
	</div>
	<div class="df-col-1 df-to-section">
		<div class="df-col-5 df-no-padding">
			<div class="field">
				<h4>Footer Retina Logo Upload</h4>
				<span class="description">upload a custom image for your footer logo.  You will need an image with twice the size of your 'normal' logo</span>
			</div>
		</div>
    <div class="df-col-2">
      <?php
        DF_Element_Generator::df_html_uploader(array(
          'name'=>array('footer','footer_logo_retina'),
                     'label' => 'Retina Footer Logo'
        ));
      ?>
    </div>
	</div>

	<div class="df-col-1 df-to-section">
		<div class="df-col-5 df-no-padding">
			<div class="field">
				<h4>Footer Text</h4>
				<span class="description">Add your Custom Footer Text here, This field also accept HTML Tags</span>
			</div>
		</div>
		<div class="df-col-2">
			<?php
				DF_Element_Generator::df_html_textarea(array(
					'name' => array( 'footer', 'footer_text'),
					'class' => 'df-code'
				));
			?>
		</div>
	</div>
    
    <div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
		              <h4>Footer Background Color</h4>
		              <span class="description">Pick the background color for your footer</span>
		      </div>
		  </div>
		  <div class="df-col-2">
            <div>
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('footer', 'background', 'color'),
		                'label' => 'Footer Background Color'
					));
		        ?>
			</div>	
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('footer','background','position'),
						'class'=>'df-to-styled-select',
						'options' => array(
							array(
								'value' =>    ' top left ',
								'text' =>     ' Top Left '
							),
							array(
								'value' =>    ' top center ',
								'text' =>     ' Top Center '
							),
				            array(
								'value' =>    ' top right ',
								'text' =>     ' Top Right '
							),
				            array(
								'value' =>    ' center left ',
								'text' =>     ' Center Left '
							),
				            array(
								'value' =>    ' center center ',
								'text' =>     ' Center Center '
							),
				            array(
								'value' =>    ' center right ',
								'text' =>     ' Center Right '
							),
				            array(
								'value' =>    ' bottom left ',
								'text' =>     ' Bottom Left '
							),
				            array(
								'value' =>    ' bottom center ',
								'text' =>     ' Bottom Center '
							),
				            array(
								'value' =>    ' bottom right ',
								'text' =>     ' Bottom Right '
							),
						)
					));
				?>	
                <?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('footer','background','repeat'),
						'class'=>'df-to-styled-select',
						'options' => array(
							array(
								'value' =>    ' repeat ',
								'text' =>     ' Repeat '
							),
							array(
								'value' =>    ' repeat-x ',
								'text' =>     ' Repeat-X '
							),
		                    array(
								'value' =>    ' repeat-y ',
								'text' =>     ' Repeat-Y '
							),
		                    array(
								'value' =>    ' no-repeat ',
								'text' =>     ' No-Repeat '
							),
						)
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('footer','background','attachment'),
						'class'=>'df-to-styled-select',
						'options' => array(
							array(
								'value' =>    ' scroll ',
								'text' =>     ' Scroll '
							),
							array(
								'value' =>    ' fixed ',
								'text' =>     ' Fixed '
							),
		                    array(
								'value' =>    ' local ',
								'text' =>     ' Local '
							),
						)
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('footer','background','size'),
						'class'=>'df-to-styled-select',
						'options' => array(
							array(
								'value' =>    ' auto ',
								'text' =>     ' Auto '
							),
		                    array(
								'value' =>    ' cover ',
								'text' =>     ' Cover '
							),
		                    array(
								'value' =>    ' contain ',
								'text' =>     ' Conntain '
							),
						)
					));
				?>
				<?php
					DF_Element_Generator::df_html_uploader(array(
						'name'=>array('footer','background','image'),
					));
				?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">   
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Footer Widget Title Color</h4>
                <span class="description">Pick the title Color for your widget in footer</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'	=> array('footer','footer_widget_title_color'),
                    'label' => 'Widget Title Color'
				));
            ?>
        </div>	
    </div>
    <div class="df-col-1 df-to-section">   
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Footer Heading Color</h4>
                <span class="description">Pick the text color for your headings in footer</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'	=> array('footer','footer_heading_color'),
                    'label' => 'Footer Heading Color'
				));
            ?>
        </div>	
    </div>
    
    <div class="df-col-1 df-to-section">   
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Footer Paragraph Color</h4>
                <span class="description">Pick the text color for your paragraph in footer</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'	=> array('footer','footer_p_color'),
                    'label' => 'Footer P Color'
				));
            ?>
        </div>	
    </div>
    
    <div class="df-col-1 df-to-section">   
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Footer Link Color</h4>
                <span class="description">Pick the text color for your links in footer</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'	=> array('footer','footer_link_color'),
                    'label' => 'Footer Link Color'
				));
            ?>
        </div>	
    </div>
    
    <div class="df-col-1 df-to-section">   
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Footer Border Color</h4>
                <span class="description">Pick the color for your border in footer</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'	=> array('footer','footer_border_color'),
                    'label' => 'Footer Border Color'
				));
            ?>
        </div>	
    </div>
    
	<div class="df-col-1 df-to-section">
		<div class="df-col-5 df-no-padding">
			<div class="field">
				<h4>Social Icons</h4>
				<span class="description">Enable/Disable Social icons in your footer</span>
			</div>
		</div>
		<div class="df-col-2">
			<?php
                DF_Element_Generator::df_html_switch(array(
                    'name'=> array('footer', 'is_social_icon')
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
														'name'=>array('footer','top_border','border'),
														'class'=>'df-input-styled'
													));
									?>
									<?php
										DF_Element_Generator::df_html_select(array(
										'name' => array('footer','top_border','style'),
										'class'=>'df-to-styled-select',
										'options' => DF_Theme_Options::$css_border_style
									));
									?>
									<?php
										DF_Element_Generator::df_html_color_picker(array(
											'name'		=>array('footer','top_border','color'),
											'label' 	=> 'Top Border Color'
										));
									?>
                                </div>
                            </div>
                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Navigation Bottom Border Colorcolor</h4>
                                        <span class="description">Customize the bottom border of your navigation area</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
									<?php
										DF_Element_Generator::df_html_numeric(array(
											'name'=>array('footer','bottom_border','border'),
											'class'=>'df-input-styled'
										));
									?>
									<?php
										DF_Element_Generator::df_html_select(array(
										'name' => array('footer','bottom_border','style'),
										'options' => DF_Theme_Options::$css_border_style,
										'class'=>'df-to-styled-select'
									));
									?>
									<?php
										DF_Element_Generator::df_html_color_picker(array(
											'name'	=>array('footer','bottom_border','color'),
											'label'	=> 'Bottom Border Color'
										));
									?>
                                </div>
                            </div>
	<h3>Sub Footer</h3>
	<div class="df-col-1 df-to-section">
		<div class="df-col-5 df-no-padding">
			<div class="field">
				<h4>Show Sub Footer</h4>
				<span class="description">Enable/Disable Sub Footer Area in your site</span>
			</div>
		</div>
		<div class="df-col-2">
			<?php
                DF_Element_Generator::df_html_switch(array(
                    'name'=> array('footer', 'is_show_subfooter')
                ));
            ?>
		</div>
	</div>

	<div class="df-col-1 df-to-section">
		<div class="df-col-5 df-no-padding">
			<div class="field">
				<h4>Sub Footer Text</h4>
				<span class="description">Add your Custom Sub Footer Text here, This field also accept HTML Tags</span>
			</div>
		</div>
		<div class="df-col-2">
			<?php
				DF_Element_Generator::df_html_textarea(array(
					'name' => array( 'footer', 'sub_footer_copyright_text'),
					'class' => 'df-code'
				));
			?>
		</div>
	</div>
    <div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
		              <h4>Sub Footer Background Color</h4>
		              <span class="description">Pick the background color for your sub footer</span>
		      </div>
		  </div>
		  <div class="df-col-2">
            <div>
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('footer', 'subfooter', 'background', 'color'),
		                'label' => 'Sub Footer Background Color'
					));
		        ?>
			</div>	
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('footer','subfooter','background','position'),
						'class'=>'df-to-styled-select',
						'options' => array(
							array(
								'value' =>    ' top left ',
								'text' =>     ' Top Left '
							),
							array(
								'value' =>    ' top center ',
								'text' =>     ' Top Center '
							),
				            array(
								'value' =>    ' top right ',
								'text' =>     ' Top Right '
							),
				            array(
								'value' =>    ' center left ',
								'text' =>     ' Center Left '
							),
				            array(
								'value' =>    ' center center ',
								'text' =>     ' Center Center '
							),
				            array(
								'value' =>    ' center right ',
								'text' =>     ' Center Right '
							),
				            array(
								'value' =>    ' bottom left ',
								'text' =>     ' Bottom Left '
							),
				            array(
								'value' =>    ' bottom center ',
								'text' =>     ' Bottom Center '
							),
				            array(
								'value' =>    ' bottom right ',
								'text' =>     ' Bottom Right '
							),
						)
					));
				?>	
                <?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('footer','subfooter','background','repeat'),
						'class'=>'df-to-styled-select',
						'options' => array(
							array(
								'value' =>    ' repeat ',
								'text' =>     ' Repeat '
							),
							array(
								'value' =>    ' repeat-x ',
								'text' =>     ' Repeat-X '
							),
		                    array(
								'value' =>    ' repeat-y ',
								'text' =>     ' Repeat-Y '
							),
		                    array(
								'value' =>    ' no-repeat ',
								'text' =>     ' No-Repeat '
							),
						)
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('footer','subfooter','background','attachment'),
						'class'=>'df-to-styled-select',
						'options' => array(
							array(
								'value' =>    ' scroll ',
								'text' =>     ' Scroll '
							),
							array(
								'value' =>    ' fixed ',
								'text' =>     ' Fixed '
							),
		                    array(
								'value' =>    ' local ',
								'text' =>     ' Local '
							),
						)
					));
				?>
				<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('footer','subfooter','background','size'),
						'class'=>'df-to-styled-select',
						'options' => array(
							array(
								'value' =>    ' auto ',
								'text' =>     ' Auto '
							),
		                    array(
								'value' =>    ' cover ',
								'text' =>     ' Cover '
							),
		                    array(
								'value' =>    ' contain ',
								'text' =>     ' Conntain '
							),
						)
					));
				?>
				<?php
					DF_Element_Generator::df_html_uploader(array(
						'name'=>array('footer','subfooter','background','image'),
					));
				?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">   
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Sub Footer Text Color</h4>
                <span class="description">Pick the text color for your sub footer</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'	=> array('footer','subfooter_text_color'),
                    'label' => 'Sub Footer Text Color'
				));
            ?>
        </div>	
    </div>
</div>
