<?php
	extract( DF_Content::$search_params );
	$header = DF_Header::df_get_header_layout();
	$show_bg = '';
	if ( 'boxed' != $header ) {
		$show_bg = $bg_type;
	}
?>
<div id="df-content-wrapper" class="lazy-wrapper <?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '' ;?> <?php echo ( isset( $show_bg ) ) ? esc_attr( $show_bg ) : '' ;?>" data-pagination="<?php echo esc_attr( $pagination )?>">
	<?php
		if ( have_posts() ) {
	?>
			<div id="df-content-header">
				<div class="boxed no-padding">
					<div class="container">
						<div class="row">
							<div class="df-category-header push-top-6">
								<?php
									if ( 'no' != $is_breadcrumbs ) {
										DF_Megamenu::df_get_breadcrumb();
									}
								?>
								<h1 class="entry-title"><?php echo esc_html__( 'Search Results for: ', 'onfleek' ), '<span>' . get_search_query() . '</span>';?></h1>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="df-archive-content" data-pagination="<?php echo esc_attr( $pagination )?>">
				<div class="boxed no-padding">
					<div class="container">
						<div class="row">
							<?php
								$use_layout		= 'layout-3';
								$is_thumbnail	= 'no';
								$is_secondary	= 'no';
								$title_size		= 'h4';
								$is_excerpt		= 'no';
								$is_meta_full	= 'yes';
								if ( 'fullwidth' == $search_layout ) {
									$column 	= 'col-md-12';
									$use_size	= 'df_size_1200x675';
								} else {
								if ( 'sidebar-left' == $search_layout ){
									$column	= 'col-md-8 col-md-push-4';
								} else {
									$column	= 'col-md-8';
								}
									$use_size	= 'df_size_1200x675';
								}
							?>
							<div id="df-content-render" class="<?php echo esc_attr( $column );?> animsition df-content-sticky push-bottom-3 clearfix" data-id="<?php echo esc_attr( get_query_var( 'paged' ) );?>">
								<?php
									while( have_posts() ) : the_post();
								?>
										<div class="archive-wraper style-3 main-wraper">
											<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );?>
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
									if ( 'normal-pagination' == $pagination ) {
								?>
										<div id="df-pagination" class="col-md-12 push-top-6 push-bottom-3">
											<?php echo DF_Content_View::df_pagination();?>
										</div>
								<?php
									}
								?>
							</div>
							<?php
								if ( 'sidebar-left' == $search_layout ) {
									$sidebar_push = 'col-md-pull-8';
							?>
									<div class="col-md-4 col-xs-12 col-sm-12 <?php echo esc_attr( $sidebar_push );?> sidebar">
										<?php DF_Content::df_load_sidebar( $sidebar_widget );?>
									</div>
							<?php
								} else if ( 'sidebar-right' == $search_layout ) {
									$sidebar_push = '';
							?>
									<div class="col-md-4 col-xs-12 col-sm-12 <?php echo esc_attr( $sidebar_push );?> sidebar">
										<?php DF_Content::df_load_sidebar( $sidebar_widget );?>
									</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
			</div>
	<?php
		} else {
	?>
		<div id="df-content-header">
			<div class="boxed no-padding">
				<div class="container">
					<div class="df-category-header push-top-6">
						<?php
							if ( 'no' != $is_breadcrumbs ) {
								DF_Megamenu::df_get_breadcrumb();
							}
						?>
						<h1 class="entry-title"><?php echo esc_html__( 'Search Results for: ', 'onfleek' ), '<span>' . get_search_query() . '</span>';?></h1>
					</div>
				</div>
			</div>
		</div>
		<div id="df-archive-content" data-pagination="<?php echo esc_attr( $pagination )?>">
			<div class="boxed no-padding">
				<div class="container">
					<div class="row">
						<?php
							if ( 'fullwidth' == $search_layout ) {
								$column 	= 'col-md-12';
								$column_md	= 'col-lg-4 col-md-4';
							} else {
								if ( 'sidebar-left' == $search_layout ){
									$column	= 'col-md-8 col-md-push-4';
								} else {
									$column	= 'col-md-8';
								}
								$column_md	= 'col-lg-6 col-md-6';
							}
							if ( 'sidebar-left' == $search_layout ) {
						?>
								<div class="col-md-4 col-xs-12 col-sm-12 sidebar">
									<?php DF_Content::df_load_sidebar( $sidebar_widget );?>
								</div>
						<?php
							}
						?>
							<div id="df-content-render" class="<?php echo esc_attr( $column );?> animsition df-content-sticky push-bottom-3" data-id="<?php echo esc_attr( get_query_var( 'paged' ) );?>">
								<h3>Page or resource not found</h3>		
							</div>
							<?php
								if ( 'sidebar-left' == $search_layout ) {
									$sidebar_push = 'col-md-pull-8';
							?>
									<div class="col-md-4 col-xs-12 col-sm-12 <?php echo esc_attr( $sidebar_push );?> sidebar">
										<?php DF_Content::df_load_sidebar( $sidebar_widget );?>
									</div>
							<?php
								} else if ( 'sidebar-right' == $search_layout ) {
									$sidebar_push = '';
							?>
									<div class="col-md-4 col-xs-12 col-sm-12 <?php echo esc_attr( $sidebar_push );?> sidebar">
										<?php DF_Content::df_load_sidebar( $sidebar_widget );?>
									</div>
							<?php
								}
							?>
					</div>
				</div>
				<?php if ( 'normal-pagination' !== $pagination ) {?>
				<div class="infinite-pre-loader">
					<div class="item-loader-container">
						<div class="la-ball-pulse">
							<div></div>
							<div></div>
							<div></div>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	<?php } ?>
</div>
