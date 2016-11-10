<?php
	extract( DF_Content::$archive_params );
	
	/**
	 *	set layout option from theme option: full, framed, boxed
	 *	set bg fixed, scroll 
	 */
	$header 	= DF_Header::df_get_header_layout();
	$show_bg	= '';
	if ( $header != 'boxed' || $header != 'frame') {
		$show_bg = $bg_type;
	}
	if ($header == 'boxed' && $layout_type == 'df-content-boxed') {
		$show_bg = $bg_type;
	}
?>
<div id="df-content-wrapper" class="lazy-wrapper <?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '' ;?> <?php echo ( isset( $show_bg ) ) ? esc_attr( $show_bg ) : '' ;?>">
	<div id="df-content-header" data-pagination="<?php echo esc_attr( $pagination )?>">
		<div class="boxed no-padding">
			<div class="container">
				<div class="row">
					<div class="df-category-header push-top-6 <?php echo ( isset( $category_title_template ) && 'layout-2' == $category_title_template ) ? 'df-category-header-2' : '' ;?>">
						<?php 
							if ( 'no' != $is_breadcrumbs ) {
								DF_Megamenu::df_get_breadcrumb();
							}
							DF_Content_View::df_load_category_header();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		$exclude_posts = array();
		if ( isset( $category_top_post_style ) ) {
	?>
			<div id="df-content-top-post" data-pagination="<?php echo esc_attr( $pagination )?>">
				<?php 
					if ( 'none' != $category_top_post_style ) {
						require get_template_directory(). '/inc/df-core/views/df-content/df-top-post-'.$category_top_post_style.'.php';	
					}
				?>
			</div>
	<?php
		}
	?>
	<div id="df-archive-content" data-pagination="<?php echo esc_attr( $pagination )?>">
		<div class="boxed no-padding">
			<div class="container">
				<div class="row">
					<?php
						$use_layout		= 'layout-4';
						$use_size		= 'df_size_376xauto';
						$is_thumbnail	= 'no';
						$is_secondary	= 'yes';
						$title_size		= 'h4';
						$is_excerpt		= 'yes';
						$is_meta_full	= 'yes';
						if ( 'fullwidth' == $archive_layout ) {
							$column 		= 'col-md-12';
							$column_md 		= 'col-lg-4 col-md-4';
						} else {
							if ( 'sidebar-left' == $archive_layout ){
								$column			= 'col-md-8 col-md-push-4';
							} else {
								$column			= 'col-md-8';
							}
							$column_md 		= 'col-lg-6 col-md-6';
						}
					?>
					<div id="df-content-render" class="<?php echo esc_attr( $column );?> no-padding animsition df-content-sticky push-bottom-4 clearfix" data-id="<?php echo esc_attr( get_query_var( 'paged' ) );?>">
						<?php
							if ( is_category() ) {
								$cat 			= get_query_var( 'cat' );
								$current 		= get_category( $cat );
								$args_query_cat = ( is_category() ) ? array( 'cat' => $current->term_id, 'post__not_in' => $exclude_posts, 'ignore_sticky_posts' => true, 'posts_per_page' => get_option('posts_per_page') , 'paged' => get_query_var('paged') ) : array();
								$query 			= new WP_Query( $args_query_cat );
								if ( $query->have_posts() ):
						?>
									<div class="masonry-grid">
						<?php
										while( $query->have_posts() ) : $query->the_post();
						?>
											<div class="<?php echo esc_attr( $column_md );?> col-sm-6 col-xs-12 archive-wraper grid-item">
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
									if ( 'normal-pagination' == $pagination ) {
						?>
										<div id="df-pagination" class="col-md-12 push-top-3 push-bottom-3">
											<?php echo DF_Content_View::df_pagination( $query->max_num_pages );?>
										</div>
						<?php
									}
									wp_reset_query();
									wp_reset_postdata();
								endif;
							} else {
								if ( have_posts() ) :
						?>
									<div class="masonry-grid">
						<?php
									while( have_posts() ) : the_post();
						?>	
										<div class="<?php echo esc_attr( $column_md );?> col-sm-6 col-xs-12 archive-wraper grid-item">
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
									if ( 'normal-pagination' == $pagination ) {
						?>
										<div id="df-pagination" class="col-md-12 push-top-3 push-bottom-3">
											<?php echo DF_Content_View::df_pagination( );?>
										</div>
						<?php
									}
									wp_reset_query();
									wp_reset_postdata();
								endif;
							}
						?>
					</div>
					<?php 
						if ( 'sidebar-left' == $archive_layout ) {
							$sidebar_push = 'col-md-pull-8';
					?>
							<div class="col-md-4 col-xs-12 col-sm-12 <?php echo esc_attr( $sidebar_push );?> sidebar">
								<?php DF_Content::df_load_sidebar( $sidebar_widget );?>
							</div>
					<?php
						} else if ( 'sidebar-right' == $archive_layout ) {
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
</div>
<?php DF_Content::df_load_back_top() ?>
