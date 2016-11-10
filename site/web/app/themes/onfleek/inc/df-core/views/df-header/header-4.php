<?php
/**
* header-4.php
* load header 4 style
*/
extract( DF_Header::$header_parameter_setting );
?>
<header id="df-header-wrapper" class="df-header df-header-4">
	<?php 
	if( isset( $meta_topbar) && $meta_topbar == 'yes' ){
	?>
	<nav id="top-navbar" class="df-top-bar <?php echo ($layout_type=="boxed") ? "boxed no-padding":"";?>" >
		<div class="<?php echo ($layout_type=="fullboxed") ? "boxed no-padding":"";?>">
			<div class="<?php echo ($layout_type=="fullboxed" || $layout_type=="boxed" ) ? "container-fluid":"";?> <?php echo($layout_type=="fullwidth") ? "container-fluid":"";?>">
				<?php DF_Megamenu::df_call_topbar();?>
				<ul class="df-top-bar-right pull-right">
					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">En <span class="caret"></span></a>
						<ul class="dropdown-menu df-dropdown-top-bar-right">
							<li><a href="#">De</a></li>
							<li><a href="#">As</a></li>
							<li><a href="#">In</a></li>
						</ul>
					</li>
 -->					<?php if( $social_icon_topbar == 'yes' ){?>
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
						<?php
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
	<?php
	}
		get_template_part('inc/df-core/views/df-header/mobile-header');
	?>
	<nav id="megadropdown" class="<?php echo ($layout_type=="fullwidth") ? "header-4-full":"";?><?php echo ($layout_type=="fullboxed") ? "header-4-fullboxed":"";?><?php echo ($layout_type=="boxed") ? "boxed":"";?> navbar navbar-default df-navbar df-navbar-background " >
		<div class="<?php echo ($layout_type=="fullboxed") ? "boxed no-padding":"";?> <?php echo($layout_type=="fullwidth") ? "df-container-fluid":"";?>">
			<div class="<?php echo ($layout_type=="fullboxed") ? "container-fluid no-padding":"";?>">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#container-menu" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div id="container-menu" class="no-padding collapse navbar-collapse">
					<div id="wraper-mainmenu" class="<?php echo (is_single()) ? 'single' : '';?> clearfix">
						<ul class="nav navbar-nav df-navbar-left">
							<?php
							if( isset( $side_area ) ){
								echo $side_area;
							}
							?>
							<li class="df-navbar-brand">
								<a href="<?php printf( site_url() ) ;?>">
									<?php echo DF_Header::df_get_header_logo("4");?>
								</a>
							</li>
						</ul>
						<?php
							$boxed_no_padding = '';
							$df_navbar_center = '';
							if( $content_layout_type == 'full'  ){
								printf( '<div class="wrapped-menu">' );
							}else{
								if ( ( $content_layout_type == 'boxed' || $content_layout_type == 'framed' ) && $layout_type == "boxed" ) {
									printf( '<div class="wrapped-menu">' );
								}else {
									printf( '<div class="boxed wrapped-menu">' );
								}
							}

							if( $layout_type == 'fullwidth' ){
								$boxed_no_padding = 'boxed no-padding';
							}
							$df_navbar_center = ( $layout_type == 'fullwidth' ) ? "df-navbar-center" : '';
                            $boxed_wrapper = ( $content_layout_type != 'full'  && $layout_type == 'fullwidth' ) ?  'boxed no-padding' : '';
							
							if( has_nav_menu('primary') ){
								$params =   array(
									'df_navbar_center' => $df_navbar_center,
									'boxed_no_padding' => $boxed_no_padding,
	                                'boxed_wrapper' => $boxed_wrapper
								);
								DF_Megamenu::df_call_megamenu( $params ); 
							}else{
							?>
							<ul id="df-primary-menu-megadropdown" class="nav navbar-nav df-megadropdown df-navbar-nav  df-navbar-center">
								<li class="menu-item menu-item-type-custom menu-item-object-custom df-is-not-megamenu">
								<a href="" ><?php printf( __('Add A Menu','onfleek') ); ?></a>
								</li>
							</ul>
							<?php
							}
							?>
							<?php
							printf( '</div>' );
							?>
							<ul class="nav navbar-nav df-navbar-right">
								<?php
								if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
									?>
									<li id="cart-show"><a href="#"><i class="ion-bag"><span class="cart-total">1</span></i></a></li>
									<?php
								}	
								if( isset( $search ) && $search == 'yes' ){
								?>
									<li class="df-search"><a href="#search"><i class="ion-ios-search-strong"></i></a></li>
								<?php
								}
								?>
							</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>
