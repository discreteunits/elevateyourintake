
	<div class="df-to-content-inner df-to-element">
		<div class="df-col-1 df-to-section">
	        <div class="df-col-5 df-no-padding">
	            <div class="field">
	                <h4>Google Analytics Tracking Code</h4>
	                <span class="description">Quickly add analytics/tracking code that will be added in the header section</span>
	            </div>
	        </div>
	        <div class="df-col-2">
	             <?php
	                    DF_Element_Generator::df_html_textarea(array(
	                        'name' => array( 'general', 'custom_code', 'google_analytics_code' ),
	                        'class' => 'df-code'
	                    )); 
					?>
	        </div>
		</div>
		<div class="df-col-1 df-to-section">
	        <div class="df-col-5 df-no-padding">
	            <div class="field">
	                <h4>Custom CSS</h4>
	                <span class="description">Quickly add some CSS by adding it to this field</span>
	            </div>
	        </div>
	        <div class="df-col-2">
	             <?php
	                    DF_Element_Generator::df_html_textarea(array(
	                        'name' => array( 'general', 'custom_code', 'custom_css' ),
	                        'class' => 'df-code css'
	                    )); 
					?>
	        </div>
		</div>
		<div class="df-col-1 df-to-section">
	        <div class="df-col-5">
	            <div class="field">
	                <h4>Custom JavaScript</h4>
	                <span class="description">Add JavaScript and/or analytics code that will be added in the footer section</span>
	            </div>
	        </div>
	        <div class="df-col-2">
	             <?php
	                    DF_Element_Generator::df_html_textarea(array(
	                        'name' => array( 'general', 'custom_code', 'custom_javascript' ),
	                        'class' => 'df-code'
	                    )); 
					?>
	        </div>
		</div>
	</div>