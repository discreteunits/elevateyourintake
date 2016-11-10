<?php
	extract( DF_Footer::$footer_params );
?>
<div id="df-footer-wrapper" class="df-footer-light lazy-wrapper <?php echo esc_attr( $footer_area_layout ); ?> no-padding">
	<?php
	if( 'yes' == strtolower($display_footer) ){
	?>
		<div class="df-container-footer df-container-fluid">	
			<div class="container">
				<div class="df-footer-top">
					<div class="row">
					<div class="col-md-8">
						<?php dynamic_sidebar( 'df-footer-area-1' ); ?>
					</div>
					<div class="col-md-4">
						<?php dynamic_sidebar( 'df-footer-area-2' ); ?>
					</div>
					</div>
				</div>
			</div>
		</div>
	<?php		
	}
	?>
	 <div class="df-container-subfooter df-container-fluid">
		<?php
			if( 'yes' == strtolower($display_subfooter) ){

				if( DF_Framework::df_is_mobile()){
			?>  
				<div class="container">
					<div class=" df-footer-copyright">
						<ul class="list-inline">
							<?php 
							if( has_nav_menu('footer') ){
							?>
								<li>
									<?php  DF_Register_Footer_Area::df_call_footernavmenu();?>
								</li>
							<?php
							} else {     
							?> 
								<li><a href="" ><?php __('Add A Menu','onfleek'); ?></a></li>
							<?php   
							}
							?>
							<li>
								<div class="df-copyright">
									<?php
									if( !empty( $subfooter_text ) ){
										echo $subfooter_text;
									}else{
									?>
										&copy; 2005 - 2016 DAHZ THEME. ALL RIGHTS RESERVED
									<?php
									}
									?>
								</div>
							</li>
						</ul>
					</div>
				</div>  
			<?php
				} else {?>
				<div class="container">
					<div class=" df-footer-copyright">
						<ul class="list-inline">
							<li>
								<div class="df-copyright">
									<?php
									if( !empty( $subfooter_text ) ){
										echo $subfooter_text;
									}else{
									?>
										&copy; 2005 - 2016 DAHZ THEME. ALL RIGHTS RESERVED
									<?php
									}
									?>
								</div>
							</li>
							<?php 
							if( has_nav_menu('footer') ){
							?>
							<li class="pull-right">
								<?php  DF_Register_Footer_Area::df_call_footernavmenu();?>
							</li>
							<?php
							} else {     
							?> 
								<li class="pull-right"><a href="" ><?php __('Add A Menu','onfleek'); ?></a></li>
							<?php   
							}
							?>
						</ul>
					</div>
				</div>
			<?php
			}
		}
		?>
	</div>
</div>
