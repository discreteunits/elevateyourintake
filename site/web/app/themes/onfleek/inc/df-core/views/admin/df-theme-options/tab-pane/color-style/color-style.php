<div class="df-to-content-inner">
		<h3>General</h3>
		<div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
		              <h4>Main Accent Color</h4>
		              <span class="description">Pick the main (accent) color for your site</span>
		      </div>
		  </div>
		  <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name' => array('color_style','general','main_accent_color'),
		                'label'	=> 'Main Acent Color'
					));
		        ?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
					<h4>Body Text Color</h4>
					<span class="description">Pick the body text color for your site</span>
		      </div>
		  </div>
		  <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('color_style','general','body_p_color'),
		                'label' => 'Body P Color'
					));
		        ?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
		  	<div class="df-col-5 df-no-padding">
		      	<div class="field">
		              <h4>Heading Text Color</h4>
		              <span class="description">Pick the Headings text color for your site</span>
		      	</div>
		  	</div>
		  	<div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('color_style','general','heading_color'),
		                'label' => 'Heading Color'
					));
		        ?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
		              <h4>Extra Color</h4>
		      </div>
		  </div>
		  <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('color_style','general','extra_color'),
		                'label' => 'Extra Color'
					));
		        ?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
		              <h4>Blockquote Color</h4>
		      </div>
		  </div>
		  <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('color_style','general','blockquote_color'),
		                'label' => 'Blockquote'
					));
		        ?>
			</div>	
		</div>
	</div>  

	<div class="df-to-content-inner">
		<h3>Button</h3>
		<div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
		              <h4>Button Color</h4>
		              <span class="description">Pick the background color for your buttons</span>
		      </div>
		  </div>
		  <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('color_style','button','button'),
		                'label' => 'Button Color'
					));
		        ?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
		              <h4>Button Text Color</h4>
		              <span class="description">Pick the text color for your buttons</span>
		      </div>
		  </div>
		  <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('color_style','button','button_text'),
		                'label' => 'Button Text Color'
					));
		        ?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
		              <h4>Button Color Hover</h4>
		              <span class="description">Pick the background color hover for your buttons</span>
		      </div>
		  </div>
		  <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('color_style','button','button_hover'),
		                'label' => 'Button Color'
					));
		        ?>
			</div>	
		</div>
		<div class="df-col-1 df-to-section">   
		  <div class="df-col-5 df-no-padding">
		      <div class="field">
		              <h4>Button Text Color Hover</h4>
		              <span class="description">Pick the text color hover for your buttons</span>
		      </div>
		  </div>
		  <div class="df-col-2">
           	    <?php
		            DF_Element_Generator::df_html_color_picker(array(
		                'name'	=> array('color_style','button','button_text_hover'),
		                'label' => 'Button Text Color'
					));
		        ?>
			</div>	
		</div>
	</div>
