<?php
	extract( DF_Content::$single_params );
/**
 * 	set layout option from theme option: full, framed, boxed
 *	set bg fixed, scroll 
 */
	$header = DF_Header::df_get_header_layout();
	$show_bg = '';
	if ( $header != 'boxed' ) {
		$show_bg = $bg_type;
	} else {
		$show_bg = '';
	}
	if ($header == 'boxed' && $layout_type == 'df-content-boxed') {
		$show_bg = $bg_type;
	}
?>
<div id="df-content-wrapper" class="lazy-wrapper df-content-wrapper <?php echo isset( $layout_type ) ? $layout_type: '';?> <?php echo isset( $show_bg ) ? $show_bg: '';?>">
	<div class="<?php echo ( $layout_type != 'df-content-full') ? 'boxed no-padding': '';?>">
		<div id="df-wrapper-ads-top">
			<div class="df-wrapper-inner">
				<div class="container-fluid no-padding">
					<div class="df-single-post-ads">
						<?php echo DF_Content::df_get_ads_before_content();?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="boxed no-padding">
		<div class="container">
			<div class="row">
							<div class="col-md-12 df-embed">
						<?php	switch ( $post_format ) {
									case 'gallery': 
                                        if ('' != $meta_content_post_format){ 
                                        ?>
                                        <div class="slider-image-wrap">
                                            <div class="post-slider-button">
                                                <ul class="list-inline">
                                                    <li class="df-btn custom-slider-prev-arrow"><span class="ion-chevron-left"></span></li>
                                                    <li class="df-btn custom-slider-next-arrow"><span class="ion-chevron-right"></span></li>
                                                </ul>
                                            </div>
                                            <div class="slider-df-post-image">
                                                <?php foreach ( $meta_content_post_format as $image) {?>
                                                    <div class="df-post-media">
                                                        <img src="<?php echo esc_url($image);?>" alt="Post Image" class="img-responsive center-block">
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <?php
                                        }	
                                    break;
									case 'video': 
                                    case 'audio':
                                        if ('' != $meta_content_post_format) { ?>
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <?php echo wp_oembed_get( $meta_content_post_format );?>
                                            </div> 
                                      <?php
                                      } 
							     	break;
									case 'standard':
										// standard post format
										if ( $is_featured_img == 'yes' ) {
											global $post;
											$post_id = $post->ID;
											$thumbs='';
											if ( has_post_thumbnail( $post_id ) ) {
												$thumbs = get_the_post_thumbnail( $post_id , $size='full', array( 'class' => 'img-responsive center-block' ) );
											} else {
												$image_id	= DF_Framework::$default_featured_img_id;
												$thumbs		= wp_get_attachment_image( $image_id, $size='full', false, array( 'class' => 'img-responsive center-block' ) );
											}
							?>
											<div class="df-post-image df-post-image-boxed feature-image-wrapper">
												<?php echo $thumbs;?>
											</div>
							<?php		}
									break;
									default:
										// standard post format
										if ( $is_featured_img == 'yes' ) {
											global $post;
											$post_id = $post->ID;
											$thumbs='';
											if ( has_post_thumbnail( $post_id ) ) {
												$thumbs = get_the_post_thumbnail( $post_id , $size='full', array( 'class' => 'img-responsive center-block' ) );
											} else {
												$image_id	= DF_Framework::$default_featured_img_id;
												$thumbs 	= wp_get_attachment_image( $image_id, $size='full', false, array( 'class' => 'img-responsive center-block' ) );
											}
							?>
										<div class="embed-responsive embed-responsive-16by9">
											<div class="df-post-image df-post-image-boxed feature-image-wrapper">
												<?php echo $thumbs;?>
											</div>
										</div>
							<?php		}
									break;
								}?>
							</div>
				<div class="clearfix"></div>
				<div class="content-single-wrap clearfix">
				<?php 
						if ( 'fullwidth' == $meta_post_layout ) {
							$column 		= 'col-md-12';
						} else {
							if ( 'sidebar-left' == $meta_post_layout ){
								$column			= 'col-md-8 col-md-push-4';
							} else {
								$column			= 'col-md-8';
							}
						}
						while ( have_posts() ) : the_post(); ?>
					<div class="df-single-post df-content-sticky push-top-4 <?php echo esc_attr( $column );?>">
						<div class="df-breadcrumb-container">
							<?php if( $is_breadcrumbs != 'no' ){ DF_Megamenu::df_get_breadcrumb(); }?>
						</div>
						<div class="df-post-header layout5">
							<header class="td-post-tittle">
								<?php
									if ($is_show_categories_tag == 'yes') {
										echo DF_Content_View::df_load_category();
									}
								?>
								<h1 class="entry-title"><?php the_title();?></h1>
								<span class="df-subtitle"><?php if( $meta_post_subtitle != '' ){ echo $meta_post_subtitle; }?>
								</span>
								<?php
									DF_Content::df_load_post_meta_single( $is_show_author_name, $is_show_date, $is_show_post_views, $is_show_comment_counts, "layout5" ); 	 
								?>
							</header>
						</div>
						<?php DF_Content::df_get_social_share('top');?>
						<div class="df-post-content">
							<?php DF_Content::df_get_review('top'); ?>
							<article id="post-<?php esc_attr( the_ID() ); ?>" <?php post_class();?>>
								<div class="entry-content">
									<?php
										the_content( sprintf(
											/* translators: %s: Name of current post. */
											wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'onfleek' ), array( 'span' => array( 'class' => array() ) ) ),
											the_title( '<span class="screen-reader-text">"', '"</span>', false )
										) );

										wp_link_pages( array(
											'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'onfleek' ),
											'after'  => '</div>',
										) );
									?>
								</div>
							</article>
							<?php 
									DF_Content::df_get_smart_list();
									DF_Content::df_get_review('bottom'); 
									if( $is_show_tag == 'yes') {
										echo get_the_tag_list(
											'<p class="tags">Tags:</p><ul class="list-inline tags"><li>',
											'</li><li>',
											'</li></ul>');
									}
							?>
							<div class="df-separator"></div>
							<?php DF_Content::df_get_social_share('bottom');?>
							<div class="clearfix"></div>
							<div class="df-single-post-ads df-single-post-ads-bottom">
								<?php echo DF_Content::df_get_ads_before_author();?>	
							</div>
							<?php 
							if ( $is_show_author_box == 'yes' ) { require get_template_directory().'/inc/df-core/views/df-content/df-author-box.php';}
							if( $is_show_next_prev_post == 'yes' ){
								// load pagination next-prev in single post
								require get_template_directory() .'/inc/df-core/views/df-content/df-pagination-single.php';
							}
							DF_Content_View::df_comment($is_show_comment_counts);
							?>
						</div>
					</div>
				<?php
					endwhile;
					wp_reset_query();
					wp_reset_postdata();
						if ( 'sidebar-left' == $meta_post_layout ) {
							$sidebar_push = 'col-md-pull-8';
				?>
							<div class="col-md-4 col-xs-12 col-sm-12 <?php echo esc_attr( $sidebar_push );?> sidebar push-top-4">
								<?php DF_Content::df_get_sidebar();?>
							</div>
				<?php
						} else if ( 'sidebar-right' == $meta_post_layout ) {
							$sidebar_push = '';
				?>
							<div class="col-md-4 col-xs-12 col-sm-12 <?php echo esc_attr( $sidebar_push );?> sidebar push-top-4">
								<?php DF_Content::df_get_sidebar();?>
							</div>
				<?php
						}	
				?>
				</div>
				<?php 
					echo DF_Content::df_get_ads_before_you_may_also_like();
					require get_template_directory(). '/inc/df-core/views/df-content/related-post.php'; 
					
				?>
			</div>
		</div>
	</div>
</div>
<?php DF_Content::df_load_back_top() ?>
