<div id="df-sticky-nav">
	<div id="df-menu-sticky" class="<?php echo ( is_single() ) ? 'sticky-single':'sticky-non-single';?>">
		<nav id="megadropdown-sticky" class="navbar">
			<div class="container-fluid no-padding navbar-collapse">
				<div id="wraper-outer-sticky" class="<?php echo ( is_single() ) ? 'sticky-single':'sticky-non-single';?> df-sticky-nav-inner no-padding clearfix"></div>
			</div>
		</nav>
	</div>
	<?php
	if( is_single() ){
		if( !is_attachment() ){
		?>
		<div id="df-title-sticky" class="hide-this">
			<div class="container-fluid">
				<div class="df-sticky-nav-inner no-padding">
					<?php while( have_posts() ): the_post(); $cat = get_the_category(); ?>
						<ul class="nav navbar-nav df-navbar-left">
							<?php 
							$side_area = DF_Header::df_show_side_area();
							if( isset( $side_area ) ) echo $side_area;?>
							<!-- <li class="df-navigator"><a href="#"><i class="ion-navicon"></i></a></li> -->
							<li class="df-navbar-brand">
								<a href="<?php echo esc_url( site_url() ); ?>" title=""><img src="<?php echo esc_url( DF_Header::df_get_stickheader() ); ?>" alt="" /></a>
							</li>
							<li>
								<a href="<?php echo esc_url( get_category_link( esc_attr($cat[0]->term_id) ) );?>" class="df-sticky-category"><?php echo $cat[0]->name;?></a>
							</li>
							<li class="df-pipeline"><span class="df-sticky-pipeline"></span></li>
							<li><a class="df-sticky-title"><?php echo wp_trim_words( get_the_title(), 5, ' ...'); ?>
							</a></li>
						</ul>
						<?php
						$general       = DF_Content::df_get_general_options();
						$social_list   = $general['social_sharing']['sharing_button'];
						?>
						<ul class="nav navbar-nav df-navbar-right sticky-right">
						<?php if(DF_Global_Options::$options['post_setting']['is_sticky_menu_article_sharing'] == 'yes'){?>
							<li class="popup">
								<a id="sticky-share-fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_html( get_permalink( get_the_ID() ) ) ?>">
									<i class="fa fa-facebook"></i>
								</a>
							</li>
							<li class="popup">
								<a id="sticky-share-twitter" href="https://twitter.com/intent/tweet?url=<?php echo esc_html( get_permalink( get_the_ID() ) ) ?>">
									<i class="fa fa-twitter"></i>
								</a>
							</li>
							<li class="popup">
								<a id="sticky-share-pinterest" href="https://id.pinterest.com/pin/create/button/?url=<?php echo esc_html( get_permalink( get_the_ID() ) ) ?>">
									<i class="fa fa-pinterest-p"></i>
								</a>
							</li>
							<li>
								<a class="show-social"><i class="ion-android-share"></i></a>
								<ul class="more-social-sticky">
									<?php if ( 'yes' == strtolower($social_list['google-plus'] ) ) { ?>
										<li class="popup"><a id="sticky-share-google" href="https://plus.google.com/share?url=<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">Google +</a></li>
									<?php 
									}
									if ( 'yes' == strtolower($social_list['linkedin'])) {
									?>
										<li class="popup"><a id="sticky-share-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">Linkedin</a></li>
									<?php 
									}
									if ( 'yes' == strtolower($social_list['mail'])) {
									?>
										<li><a id="sticky-share-email" href="mailto:?Subject=I%20saw%20this%20and%20thought%20of%20you!%20&Body=I%20saw%20this%20and%20thought%20of%20you!%20<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">Email</a></li>
									<?php 
									}
									?>
								</ul>
							</li>
						<?php } ?>
							<li class="df-pipeline"><span class="df-sticky-pipeline"></span></li>
							<li><a class="df-sticky-comment"><i class="ion-chatbubble"></i>  <?php echo get_comments_number();?></a></li>
							<?php
							$next_post = get_next_post();
							if( !empty( $next_post ) ){
								$next_post_url = get_permalink( get_adjacent_post( false,'',false )->ID );
								$next_post_title = get_the_title( get_adjacent_post( false, '', false )->ID );
							?>
							<li class="df-sticky-next-article">
								<a href="<?php echo esc_url( $next_post_url );?>"><span class="ion-ios-arrow-right"></span></a>
							</li>
							<li>
								<a href="<?php echo esc_url( $next_post_url );?>" class="df-sticky-next-title">
									<?php echo wp_trim_words( $next_post_title, 5, ' ...');?>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					<?php
					endwhile;
					?>
				</div>
			</div>
		</div>
		<?php
		}
	}
	?>
</div>
