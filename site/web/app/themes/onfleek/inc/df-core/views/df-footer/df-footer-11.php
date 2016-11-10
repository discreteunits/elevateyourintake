<?php
	extract( DF_Footer::$footer_params );
?>
<div id="df-footer-wrapper" class="df-footer-light lazy-wrapper <?php echo esc_attr( $footer_area_layout ); ?> no-padding">
	<?php
	if( 'yes' == strtolower($display_footer) ){
	?>
		<div class="df-container-footer df-container-fluid">
			<div class="container df-footer">
				<div class="df-footer-top">
					<div class="row">
						<div class="col-lg-3 col-md-12">
							<img src="<?php echo esc_url( $footer_logo_normal ); ?>" class="df-footer-logo-img" alt="<?php echo esc_attr( get_bloginfo('name') );?>">
								<div class="df-footer-top-inner">
									<div class="df-footer-description style11">
										<?php
										if( !empty( $footer_text ) ){
											printf( $footer_text );
										}else{
										?>
											Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
										<?php
										} 
										?>
									</div>
									<?php 
									if( $footer_social_icon == 'yes' ){
									?>
										<ul class="df-footer-social-logo list-inline">
											<?php if ( $rss !== '' ) {?><li><a href="<?php echo esc_url( $rss ); ?>" class="df-top-bar-social"><i class="fa fa-rss"></i></a></li><?php } ?>
											<?php if ( $facebook !== '' ) {?><li><a href="<?php echo esc_url( $facebook ); ?>" class="df-top-bar-social"><i class="fa fa-facebook"></i></a></li><?php } ?>
											<?php if ( $twitter !== '' ) {?><li><a href="<?php echo esc_url( $twitter ); ?>" class="df-top-bar-social"><i class="fa fa-twitter"></i></a></li><?php } ?>
											<?php if ( $google_plus !== '' ) {?><li><a href="<?php echo esc_url( $google_plus ); ?>" class="df-top-bar-social"><i class="fa fa-google-plus"></i></a></li><?php } ?>
											<?php if ( $linkedin !== '' ) {?><li><a href="<?php echo esc_url( $linkedin ); ?>" class="df-top-bar-social"><i class="fa fa-linkedin"></i></a></li><?php } ?>
											<?php if ( $youtube !== '' ) {?><li><a href="<?php echo esc_url( $youtube ); ?>" class="df-top-bar-social"><i class="fa fa-youtube-play"></i></a></li><?php } ?>
											<?php if ( $vimeo !== '' ) {?><li><a href="<?php echo esc_url( $vimeo ); ?>" class="df-top-bar-social"><i class="fa fa-vimeo"></i></a></li><?php } ?>
											<?php if ( $vk !== '' ) {?><li><a href="<?php echo esc_url( $vk ); ?>" class="df-top-bar-social"><i class="fa fa-vk"></i></a></li><?php } ?>
											<?php if ( $instagram !== '' ) {?><li><a href="<?php echo esc_url( $instagram ); ?>" class="df-top-bar-social"><i class="fa fa-instagram"></i></a></li><?php } ?>
											<?php if ( $pinterest !== '' ) {?><li><a href="<?php echo esc_url( $pinterest ); ?>" class="df-top-bar-social"><i class="fa fa-pinterest"></i></a></li><?php } ?>
											<?php if ( $flickr !== '' ) {?><li><a href="<?php echo esc_url( $flickr ); ?>" class="df-top-bar-social"><i class="fa fa-flickr"></i></a></li><?php } ?>
											<?php if ( $bloglovin !== '' ) {?><li><a href="<?php echo esc_url( $bloglovin ); ?>" class="df-top-bar-social"><i class="fa fa-heart"></i></a></li><?php } ?>
											<?php if ( $spotify !== '' ) {?><li><a href="<?php echo esc_url(  $spotify ); ?>" class="df-top-bar-social"><i class="fa fa-spotify"></i></a></li><?php } ?>
										</ul>
									<?php
									}
									?>
								</div>
						</div>
						<div class="col-lg-3 col-md-4">
							<?php dynamic_sidebar( 'df-footer-area-1' ); ?>
						</div>
						<div class="col-lg-3 col-md-4">
							<?php dynamic_sidebar( 'df-footer-area-2' ); ?>
						</div>
						<div class="col-lg-3 col-md-4">
							<?php dynamic_sidebar( 'df-footer-area-3' ); ?>
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
				<div class="container df-footer">
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
				<div class="container df-footer">
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
