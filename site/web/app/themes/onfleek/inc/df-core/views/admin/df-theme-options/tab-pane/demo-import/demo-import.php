	<div class="df-to-content-inner">
	<h3>EXPORT THEME SETTINGS</h3>
	<h5 class="description">Please always backup this settings periodically, especially when you add/update Plugins or Themes. Simply copy this and save it in notepad or other text editor.</h5>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-1">
				<?php
					DF_Element_Generator::df_html_export(array(
										'name'=>array('import', 'export'),
										'class' => 'df-code'
									));
				?>
			</div>
		</div>
		
		<h3>IMPORT THEME SETTINGS</h3>
	<h5 class="description">Paste the Codes here to Import your previous Settings.</h5>
		<div class="df-col-1 df-to-section">   
			<div class="df-col-1">
				<?php
					DF_Element_Generator::df_html_import(array(
										'name'=>array('import', 'import'),
										'class' => 'df-code',
									));
				?>
			</div>	
		</div>
		
		<div class="df-col-1 df-no-padding">
			<div class="btn-wrapp">
				<button class="btn btn-default btn-save df-button-import"><?php _e( 'Import Theme Settings', 'onfleek' ); ?></button>
			</div>
		</div>
	</div>	
