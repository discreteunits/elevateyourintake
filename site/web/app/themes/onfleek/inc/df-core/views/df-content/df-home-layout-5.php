<?php
	extract( DF_Content::$home_params );
	
	$header		= DF_Header::df_get_header_layout();
	$show_bg	= '';
	if ( 'boxed' != $header ) {
		$show_bg = $bg_type;
	}
	if ( have_posts() ) :
?>
<div id="df-content-wrapper" class="lazy-wrapper <?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '' ;?> <?php echo ( isset( $show_bg ) ) ? esc_attr( $show_bg ) : '' ;?>">
	<div class="boxed no-padding">
		<div id="df-archive-content" class="container" data-pagination="<?php echo esc_attr( $pagination )?>">
			<div class="row">
				<?php
					$use_layout		= 'layout-5';
					$is_thumbnail	= 'no';
					$is_secondary	= 'yes';
					$title_size		= 'h3';
					$is_excerpt		= 'yes';
					$is_meta_full	= 'yes';
					if ( 'fullwidth' == $home_layout ) {
						$column			= 'col-md-12';
						$main_wraper	= 'main-wraper';
						$use_size		= 'df_size_788x524';
					} else {
						if ( 'sidebar-left' == $home_layout ){
							$column		= 'col-md-8 col-md-push-4';
						} else {
							$column		= 'col-md-8';
						}
						$main_wraper	= 'main-wraper with-sidebar';
						$use_size		= 'df_size_788x524';
					}
				?>
				<div id="df-content-render" class="<?php echo esc_attr( $column );?> no-padding animsition df-content-sticky push-top-6 clearfix" data-id="<?php echo esc_attr( get_query_var( 'paged' ) );?>">
					<?php	while( have_posts() ) : the_post();?>
						<div class="col-md-12 archive-wraper style-5 <?php echo esc_attr( $main_wraper );?> clearfix">
							<div class="article-img-wrap">
								<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary ); ?>
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
					<?php	endwhile;
							if ( 'normal-pagination' == $pagination ) {
					?>
								<div id="df-pagination" class="col-md-12 push-bottom-6">
									<?php echo DF_Content_View::df_pagination();?>
								</div>
					<?php	}?>
				</div>
				<?php
					if ( 'sidebar-left' == $home_layout ) {
						$sidebar_push = 'col-md-pull-8';
				?>
						<div class="col-md-4 col-xs-12 col-sm-12 <?php echo esc_attr( $sidebar_push );?> sidebar push-top-6">
							<?php DF_Content::df_load_sidebar( $sidebar_widget );?>
						</div>
				<?php
					} else if ( 'sidebar-right' == $home_layout ) {
						$sidebar_push = '';
				?>
						<div class="col-md-4 col-xs-12 col-sm-12 <?php echo esc_attr( $sidebar_push );?> sidebar push-top-6">
							<?php DF_Content::df_load_sidebar( $sidebar_widget );?>
						</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
<?php
	endif;
?>
</div>
<?php DF_Content::df_load_back_top() ?>
