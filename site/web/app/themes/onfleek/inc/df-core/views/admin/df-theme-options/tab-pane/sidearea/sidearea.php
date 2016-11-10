    <div class="df-to-content-inner">
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Enable Side Area</h4>
                    <span class="description">Enable an off canvas area in your website</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
	                DF_Element_Generator::df_html_switch(array(
					    'name'=>array('side_area','enable_side_area')
	                ));
	            ?>
            </div>
        </div>  

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                 <div class="field">
                    <h4>Side Area Background Colour</h4>
                    <span class="description">Upload image or choose the colour of the side area background here</span>
                    </div>
            </div>
            <div class="df-col-2">
            	<div>
            		<?php
			            DF_Element_Generator::df_html_color_picker(array(
			                'name'=>array('side_area','background','color')
							),'Background Color');
			        ?>
            	</div>
            	<?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('side_area','background','position'),
						'class'=>'df-to-styled-select',
						'options' => array(
				            array(
								'value' =>    '  ',
								'text' =>     ' Select Background Posisition '
							),
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
						'name' => array('side_area','background','repeat'),
						'class'=>'df-to-styled-select',
						'options' => array(
		                    array(
								'value' =>    '  ',
								'text' =>     ' Select Background Repeat '
							),
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
						'name' => array('side_area','background','attachment'),
						'class'=>'df-to-styled-select',
						'options' => array(
		                    array(
								'value' =>    '  ',
								'text' =>     ' Select Background Attachment '
							),
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
						'name' => array('side_area','background','size'),
						'class'=>'df-to-styled-select',
						'options' => array(
		                    array(
								'value' =>    '  ',
								'text' =>     ' Select Background Size '
							),
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
						'name'=>array('side_area','background','image'),
	                    'label' => 'Background Side Area Image'
					));
				?>
            </div>
            
        </div> 
    
        
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">  
                <div class="field">
                    <h4>Widget Title Colour</h4>
                    <span class="description">Choose the widget title colour for your Side Area</span>
                </div>
                
            </div>
            <div class="df-col-2">
	       	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'=>array('side_area','widget_title')
					),'Widget Title');
		        ?>
	        </div>
        </div>
        
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">  
                <div class="field">
                    <h4>Heading Colour</h4>
                    <span class="description">Choose the colour of your side area's headings here</span>
                </div>
                
            </div>
            <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'=>array('side_area','heading_element_color')
					),'Heading Element');
		        ?>
	        </div>
        </div>
        

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">  
                <div class="field">
                    <h4>Paragraph Colour</h4>
                    <span class="description">Choose the colour of your side area's paragraphs here</span>
                </div>
                
            </div>
            <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'=>array('side_area','heading_paragraph_color')
						),'Heading Paragraph');
		        ?>
            </div>
        </div>
        
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">  
                <div class="field">
                    <h4>Link Colour</h4>
                    <span class="description">Choose the colour of your side area's links here</span>
                </div>
                
            </div>
            <div class="df-col-2">
               	    <?php
			            DF_Element_Generator::df_html_color_picker(array(
			                'name'=>array('side_area','link_color')
							),'Link Color');
			        ?>
            </div>
        </div>
        
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">  
                <div class="field">
                    <h4>Border Colour</h4>
                    <span class="description">Choose the colour of your side area's border here</span>
                </div>
                
            </div>
            <div class="df-col-2">
               	    <?php
			            DF_Element_Generator::df_html_color_picker(array(
			                'name'=>array('side_area','border_color')
							),'Border Color');
			        ?>
            </div>
        </div>
        
        
        
</div>