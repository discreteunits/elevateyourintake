<?php
	extract( DF_Content::$not_found_params );
	
	$header = DF_Header::df_get_header_layout();
	$show_bg = '';
	if ( 'boxed' != $header ){
		$show_bg = $bg_type;
	}
	$bg_class = '';
	if ( 'df-content-full' != $layout_type ) {
		$bg_class = 'df-notfound-bg';
	}
?>
<div class="df-page-notfound lazy-wrapper <?php echo esc_attr( $bg_class ) ;?>">
	<div class="df-notfound-wrapper container-fluid">
		<div class="row">
			<div class="header-not-found-plain">
				<div class="title-not-found">
					<h1><?php echo esc_html( $notfound_title );?></h1>
				</div>
				<div class="clearfix"></div>
				<div class="description-not-found">
					<p class="small"><?php echo esc_html( $notfound_subtitle );?></p>
				</div>
				<div class="btn-not-found-homepage">
					<a href="<?php echo esc_url( site_url() ) ;?>" class="df-btn df-btn-normal"><?php _e('go to homepage', 'onfleek');?></a>
				</div>
			</div>
		</div>
	</div>
<?php 
	switch ( $notfound_option_article_display ) {
		case 'layout-1':
	?>
		<div class="<?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '';?>">
			<div class="boxed no-padding">
				<div class="container">
					<div class="row push-bottom-3">
						<?php
							$args = array(
									'posts_per_page'		=> 6,
									'ignore_sticky_posts'	=> true,
								);
							$latest_articles = new WP_Query( $args );
							if ( $latest_articles->have_posts() ) :
						?>
								<h4 class="archive-header-title push-top-4"><?php _e( 'Latest Articles', 'onfleek' );?></h4>
								<div class="wrapped-column">
									<?php
										while( $latest_articles->have_posts() ) : $latest_articles->the_post() ;
									?>	
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 archive-wraper">
												<?php
													$use_layout		= 'layout-1';
													$use_size		= 'df_size_376x250';
													$is_thumbnail	= 'no';
													$is_secondary	= 'yes';
													$title_size		= 'h4';
													$is_excerpt		= 'yes';
													$is_meta_full	= 'yes';
												?>
												<div class="article-img-wrap">
													<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );?>
												</div>
												<?php
													echo DF_Content_View::df_load_category();
													DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
												?>
												<div class="df-separator"></div>
												<div class="post-meta with-margin-top">
													<div class="post-meta-avatar">
														<?php DF_Content::df_load_avatar_author(); ?>
													</div>
													<div class="post-meta-desc with-avatar">
														<div class="post-meta-desc-top">
															<?php DF_Content::df_load_author_and_date();?>
														</div>
														<div class="post-meta-desc-btm">
															<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
														</div>
													</div>
												</div>
											</div>
									<?php
										endwhile;
									?>
								</div>
						<?php
							endif;
						?>
					</div>
				</div>
			</div>
		</div>

	<?php
			break;
		case 'layout-2':
	?>	
		<div class="<?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '';?>">
			<div class="boxed no-padding">
				<div class="container">
					<div class="row push-bottom-3">
						<?php
							$args = array(
									'posts_per_page'		=> 6,
									'ignore_sticky_posts'	=> true,
								);
							$latest_articles = new WP_Query( $args );
							if ( $latest_articles->have_posts() ) :
						?>
								<h4 class="archive-header-title push-top-4"><?php _e( 'Latest Articles', 'onfleek' );?></h4>
								<div class="wrapped-column">
									<?php
										while( $latest_articles->have_posts() ) : $latest_articles->the_post() ;
									?>	
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 archive-wraper style-2">
												<?php
													$use_layout		= 'layout-1';
													$use_size		= 'df_size_376x250';
													$is_thumbnail	= 'no';
													$is_secondary	= 'yes';
													$title_size		= 'h4';
													$is_excerpt		= 'yes';
													$is_meta_full	= 'yes';
												?>
												<div class="article-img-wrap">
													<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );?>
												</div>
												<?php
													echo DF_Content_View::df_load_category();
													DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
												?>
												<div class="df-separator"></div>
												<div class="post-meta with-margin-top">
													<div class="post-meta-avatar">
														<?php DF_Content::df_load_avatar_author(); ?>
													</div>
													<div class="post-meta-desc with-avatar">
														<div class="post-meta-desc-top">
															<?php DF_Content::df_load_author_and_date();?>
														</div>
														<div class="post-meta-desc-btm">
															<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
														</div>
													</div>
												</div>
											</div>
									<?php
										endwhile;
									?>
								</div>
						<?php
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
	<?php		
			break;
		case 'layout-3':
	?>
		<div class="<?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '';?>">
			<div class="boxed no-padding">
				<div class="container">
					<div class="push-bottom-6">
					<?php
						$args = array(
								'posts_per_page' => 6,
								'ignore_sticky_posts' => true,
							);
						$latest_articles = new WP_Query( $args );
						if ( $latest_articles->have_posts() ) :
					?>
							<h4 class="archive-header-title push-top-4 style-3"><?php _e( 'Latest Articles', 'onfleek' );?></h4>
							<?php
								while( $latest_articles->have_posts() ) : $latest_articles->the_post();?>
									<div class="archive-wraper style-3 main-wraper">
										<?php
											$use_layout		= 'layout-3';
											$use_size		= 'df_size_1200x675';
											$is_thumbnail	= 'no';
											$is_secondary	= 'no';
											$title_size		= 'h4';
											$is_excerpt		= 'no';
											$is_meta_full	= 'yes';
											DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
										?>
										<span class="overlay"></span>
										<div class="archive-wraper style-3 inner-wraper">
											<?php
												echo DF_Content_View::df_load_category();
												DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
											?>
											<div class="post-meta">
												<div class="post-meta-desc">
													<?php
														DF_Content::df_load_author_and_date();
														DF_Content::df_load_comment_and_share( $is_meta_full );
													?>
												</div>
											</div>
										</div>
									</div>
							<?php
								endwhile;
						endif;
					?>
					</div>
				</div>
			</div>
		</div>
	<?php		
			break;
		case 'layout-4':
	?>		
		<div class="<?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '';?>">
			<div class="boxed no-padding">
				<div class="container">
					<div class="row push-bottom-3">
						<?php
							$args = array(
									'posts_per_page'		=> 6,
									'ignore_sticky_posts'	=> true,
								);
							$latest_articles = new WP_Query( $args );
							if ( $latest_articles->have_posts() ) :
						?>
								<h4 class="archive-header-title push-top-4"><?php _e( 'Latest Articles', 'onfleek' );?></h4>
								<div class="masonry-grid">
									<?php
										while( $latest_articles->have_posts() ) : $latest_articles->the_post() ;
									?>	
											<div class="col-md-4 col-sm-6 col-xs-12 archive-wraper grid-item">
												<?php
													$use_layout		= 'layout-1';
													$use_size		= 'df_size_376xauto';
													$is_thumbnail	= 'no';
													$is_secondary	= 'yes';
													$title_size		= 'h4';
													$is_excerpt		= 'yes';
													$is_meta_full	= 'yes';
												?>
												<div class="article-img-wrap">
													<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );?>
												</div>
												<?php
													echo DF_Content_View::df_load_category();
													DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
												?>
												<div class="df-separator"></div>
												<div class="post-meta with-margin-top">
													<div class="post-meta-avatar">
														<?php DF_Content::df_load_avatar_author(); ?>
													</div>
													<div class="post-meta-desc with-avatar">
														<div class="post-meta-desc-top">
															<?php DF_Content::df_load_author_and_date();?>
														</div>
														<div class="post-meta-desc-btm">
															<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
														</div>
													</div>
												</div>
											</div>
									<?php
										endwhile;
									?>
								</div>
						<?php
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
	<?php		
			break;
		case 'layout-5':
	?>		
		<div class="<?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '';?>">
			<div class="boxed no-padding">
				<div class="container">
					<div class="row">
					<?php
						$args = array(
								'posts_per_page' => 6,
								'ignore_sticky_posts' => true,
							);
						$latest_articles = new WP_Query( $args );

						if ( $latest_articles->have_posts() ) :
					?>
							<h4 class="archive-header-title push-top-4"><?php _e( 'Latest Articles', 'onfleek' );?></h4>
							<?php
								while( $latest_articles->have_posts() ) : $latest_articles->the_post();
							?>
									<div class="col-md-12 archive-wraper style-5 main-wraper clearfix">
										<?php
											$use_layout		= 'layout-5';
											$use_size		= 'df_size_788x524';
											$is_thumbnail	= 'no';
											$is_secondary	= 'yes';
											$title_size		= 'h3';
											$is_excerpt		= 'yes';
											$is_meta_full	= 'yes';
										?>
										<div class="article-img-wrap">
											<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );?>
										</div>
										<div class="archive-wraper style-5 inner-wraper">
											<?php
												echo DF_Content_View::df_load_category();
												DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
											?>
											<div class="df-separator"></div>
											<?php if ( DF_Framework::df_is_mobile() ){ ?>
												<div class="post-meta with-margin-top">
													<div class="post-meta-avatar">
														<?php DF_Content::df_load_avatar_author(); ?>
													</div>
													<div class="post-meta-desc with-avatar">
														<div class="post-meta-desc-top">
															<?php DF_Content::df_load_author_and_date();?>
														</div>
														<div class="post-meta-desc-btm">
															<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
														</div>
													</div>
												</div>
										<?php } else {?>
											<div class="post-meta">
												<div class="post-meta-avatar">
													<?php DF_Content::df_load_avatar_author(); ?>
												</div>
												<div class="post-meta-desc with-avatar">
													<?php DF_Content::df_load_author_and_date();?>
													<span class="pull-right">
														<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
													</span>
												</div>
											</div>
										<?php } ?>
										</div>
									</div>
					<?php
								endwhile;
						endif;
					?>
					</div>
				</div>
			</div>
		</div>
	<?php	
			break;
		case 'layout-6':
	?>		
		<div class="<?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '';?>">
			<div class="boxed no-padding">
				<div class="container">
					<div class="row push-bottom-3">
					<?php
						$args = array(
								'posts_per_page' => 6,
								'ignore_sticky_posts' => true,
							);
						$latest_articles = new WP_Query( $args );
						if ( $latest_articles->have_posts() ) :
					?>
							<h4 class="archive-header-title push-top-4"><?php _e( 'Latest Articles', 'onfleek' );?></h4>
							<?php
								while( $latest_articles->have_posts() ) : $latest_articles->the_post();
							?>
								<div class="archive-wraper style-6 main-wraper">
									<div class="archive-wraper style-6 inner-wraper">
										<?php
											$use_layout		= 'layout-6';
											$use_size 		= 'df_size_788x524';
											$is_thumbnail	= 'no';
											$is_secondary	= 'yes';
											$title_size		= 'h4';
											$is_excerpt		= 'yes';
											$is_meta_full	= 'yes';
										?>
										<div class="article-img-wrap">
											<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );?>
										</div>
									</div>
									<div class="archive-wraper style-6 inner-wraper">
										<?php
											echo DF_Content_View::df_load_category();
											DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
										?>
										<div class="df-separator"></div>
										<div class="post-meta with-margin-top">
											<div class="post-meta-avatar">
												<?php DF_Content::df_load_avatar_author(); ?>
											</div>
											<div class="post-meta-desc with-avatar">
												<div class="post-meta-desc-top">
													<?php DF_Content::df_load_author_and_date();?>
												</div>
												<div class="post-meta-desc-btm">
													<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
												</div>
											</div>
										</div>
									</div>
								</div>
					<?php
								endwhile;
						endif;
					?>
					</div>
				</div>
			</div>
		</div>
	<?php		
			break;
		default:
	?>
		<div id="df-archive-wrapper" class="<?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '';?>">
			<div class="boxed no-padding">
				<div class="df-archive-wrapper-inner container">
					<div class="row">
						<?php
							$args = array(
									'posts_per_page'		=> 6,
									'ignore_sticky_posts'	=> true,
								);
							$latest_articles = new WP_Query( $args );
							if ( $latest_articles->have_posts() ) :
						?>
								<h4 class="archive-header-title push-top-4"><?php _e( 'Latest Articles', 'onfleek' );?></h4>
								<div class="col-md-12 no-padding archive-post-wrap has-sidebar--no">
									<?php
										while( $latest_articles->have_posts() ) : $latest_articles->the_post();
									?>	
											<div class="col-md-4 col-sm-6 col-xs-12 archive-wraper wrapped-item">
												<?php
													$use_layout		= 'layout-1';
													$use_size		= 'df_size_376x250';
													$is_thumbnail	= 'no';
													$is_secondary	= 'yes';
													$title_size		= 'h4';
													$is_excerpt		= 'yes';
													$is_meta_full	= 'yes';
													DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
													echo DF_Content_View::df_load_category();
													DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
												?>
												<div class="df-separator"></div>
												<div class="post-meta with-margin-top">
													<div class="post-meta-avatar">
														<?php DF_Content::df_load_avatar_author(); ?>
													</div>
													<div class="post-meta-desc with-avatar">
														<div class="post-meta-desc-top">
															<?php DF_Content::df_load_author_and_date();?>
														</div>
														<div class="post-meta-desc-btm">
															<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
														</div>
													</div>
												</div>
											</div>
									<?php
										endwhile;
									?>
							</div>
						<?php
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
			break;
	}
?>
</div>
<?php DF_Content::df_load_back_top() ?>
