<?php
/**
* header-5.php
* load header 5 style
*/
extract( DF_Header::$header_parameter_setting );
?>
<?php 
$color_style = '';
$topbar_status = '';
if( $header_color_style == 'light' ){
	$color_style = 'df-navbar-transparent-light';
	$currentheader = "5";
}else{
	$color_style = 'df-navbar-transparent-dark';
	$currentheader = "6";
}
?>
<header id="df-header-wrapper" class="df-header <?php echo esc_attr( $color_style );?> df-header-5">
	<div class="df-header-trans">
		<?php 
		if( isset( $meta_topbar ) ){
			if( $meta_topbar == 'yes' ){
		?>    
				<nav id="top-navbar" class="df-top-bar" >
					<div class=" <?php echo ($layout_type=="boxed") ? "boxed no-padding":"";?>"> 
						<div class=" <?php echo($layout_type == "fullwidth" || $layout_type == "boxed" ) ? "container-fluid":"";?> topbar-inner-wrapper">
							<?php
							DF_Megamenu::df_call_topbar();
							?>
							<ul class="df-top-bar-right pull-right">
								<!-- <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">En <span class="caret"></span></a>
									<ul class="dropdown-menu df-dropdown-top-bar-right">
									<li><a href="#">De</a></li>
									<li><a href="#">As</a></li>
									<li><a href="#">In</a></li>
									</ul>
								</li> -->
								<?php
								if( $social_icon_topbar == 'yes' ){
								?>
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
				$topbar_status = '';
			}else{
				$topbar_status = 'disable';
			}
		}
			get_template_part('inc/df-core/views/df-header/mobile-header');
		?>
		<nav id="megadropdown" class="<?php echo ($layout_type == 'fullwidth') ? 'header-5-full': '';?> navbar navbar-default df-navbar <?php echo ($topbar_status == 'disable') ? 'df-no-topbar':'';?>" > <!-- role="navigation" --><!-- add class df-navbar-background if bg is img -->
			<div class="<?php echo ($layout_type=="boxed") ? "boxed no-padding":"";?> <?php echo($layout_type=="fullwidth") ? "df-container-fluid":"";?>">
				<!-- <div class="<?php// echo ($layout_type=="fullboxed") ? "container-fluid":"";?>"> -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#container-menu" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
					</div>
					<div id="container-menu" class="collapse navbar-collapse no-padding">
						<div id="wraper-mainmenu" class="<?php echo (is_single()) ? 'single' : '';?> clearfix">
							<ul class="nav navbar-nav df-navbar-left">
								<?php
								if( isset( $side_area ) ){
									echo $side_area;
								}
								?>
								<li class="df-navbar-brand">
								<a href="<?php printf( site_url() );?>">
									<?php echo DF_Header::df_get_header_logo($currentheader);?>
								</a>
								</li>
							</ul>
							<?php
							// printf( ($layout_type == 'fullwidth' ) ? '<div class="">': '<div class="">' );
							printf( ($layout_type == 'boxed' ) ? '<div class="container-fluid ">': '' );
							
							$boxed_no_padding = 'boxed no-padding';
							if( $content_layout_type == 'full'  ){
								printf( '<div class="wrapped-menu">' );
							}else{
								if ( ( $content_layout_type == 'boxed' || $content_layout_type == 'framed' ) && $layout_type == "boxed" ) {
									printf( '<div class="wrapped-menu">' );
								}else {
									printf( '<div class="boxed wrapped-menu">' );
								}
							}
							$boxed_wrapper = '';
                            if( $layout_type == 'fullwidth' ){
                                if( $content_layout_type != 'full' ){
                                    $boxed_wrapper = 'boxed no-padding';
                                }
                            }else{ // boxed header
                                $boxed_wrapper = 'boxed no-padding';
                            }
                            
							if( has_nav_menu('primary') ){
								$df_navbar_center = ( $layout_type == 'fullwidth' ) ? 'df-navbar-center':'';
								$params = array(
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
							printf( ($layout_type == 'boxed' ) ? '</div>': '' ); 
							// printf( '</div>' ); 
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
				<!-- </div> -->
			</div>
		</nav>
	</div>
</header>
