<?php 
extract( DF_Header::$header_parameter_setting );
?><div class="mobile-menu">
	<div class="mobile-menu-wrap">
		<div class="navbar-header">
			<div class="col-xs-3 col-sm-3 no-padding ham-menu">
				<ul>
					<?php if( isset( $side_area ) ){
							echo $side_area;
						}
					?>
				</ul>
			</div>
			
			<div class="col-xs-6 col-sm-6 no-padding logo-menu">
				<div class="df-logo-inner">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php echo DF_Header::df_get_header_logo("mobile"); ?>
					</a>
				</div>
			</div>
			<div class="col-xs-3 col-sm-3 no-padding float-menu">
				<button type="button" class="nav-toggle">
					<span class="ion-ios-more"></span>
				</button>
			</div>
		</div>
		<div class="menu-wrap" aria-hidden="true">
			<div class="container">
				<ul class="list-inline mobile-menu-header">
					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">En <span class="caret"></span></a>
						<ul class="dropdown-menu df-dropdown-top-bar-right">
						<li><a href="#">De</a></li>
						<li><a href="#">As</a></li>
						<li><a href="#">In</a></li>
						</ul>
					</li> -->
				    <?php
					if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					?>
						<li id="cart-show"><a href="#"><i class="ion-bag"><span class="cart-total">1</span></i></a></li>
					<?php
					}
					?>
					<li class="pull-right"><a class="ion-android-close nav-close"></a></li>
				</ul>
            </div>
            <div class="df-separator"></div>
            <div class="container">
					<?php
						if( isset( $search ) && 'yes' == strtolower($search) ){
					?>
				<div id="m-search" class="mobile-search">
					<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) );?>" class="input-group">
						<input type="search" class="form-control mobile-form-search" placeholder="Search" value="<?php echo get_search_query()?>" name="s" title="search">
						<span class="input-group-btn">
							<button class="submit button df-btn df-button-search" type="submit" name="submit" value="<?php _e('Search', 'onfleek');?>">
								<span class="ion-search ion-search-large"></span>
							</button>
						</span>
						<div class="df-separator"></div>
					</form>
				</div>
        		<span class="dropdown-mobile-toggle"><i class="ion-ios-dropdown"></i></span>
				<?php
				DF_Megamenu::df_call_mobile_menu();
				}
				?>
				<ul class="list-inline mobile-social">
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
	</div>
</div>
