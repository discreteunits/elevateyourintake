<?php
	extract( DF_Content::$page_params );
/**
 * 	set layout option from theme option: full, framed, boxed
 *	set bg fixed, scroll 
 */
?>
<div id="df-content-wrapper" class="lazy-wrapper df-content-wrapper <?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '' ;?> <?php echo ( isset( $bg_type ) ) ? esc_attr( $bg_type ) : '' ;?>">
	<div class="boxed boxed-modifier-wrapper no-padding">
		<div id="df-wrapper-content-single">
			<div class="df-wrapper-inner">
				<div class="container df-bg-content">
					<div class="row">
					<div class="clearfix"></div>
					<?php	

							if( !DF_Framework::df_is_mobile() ){
								if ( $general_page_layout == 'sidebar-left') {
							?>
								<div class="col-md-4 sidebar push-top-6">
									<?php DF_Content::df_load_sidebar( $custom_sidebar );?>
								</div>
							<?php
								}
							}
							while ( have_posts() ) : the_post();
					?>
					<div class="<?php echo ( 'sidebar-right' == $general_page_layout || 'sidebar-left' == $general_page_layout ) ? 'col-md-8' : 'col-md-12';?> df-single-page">
						<div class="clearfix"></div>
						<div class="df-post-content">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
							<div class="df-line-light"></div>
							<div class="clearfix"></div>
							<?php if ( comments_open() || get_comments_number() ) :?>
							<div id="df-comments-wrap" class="df-comments-wrap">
								<ul class="df-comments-area-title list-inline">
									<li class="comments-show">
										<h4>Show Comments<span class="df-comments-number">(<?php echo get_comments_number();?>)</span></h4>
									</li>
									<li class="collapse-button">
										<i class="ion-plus comments-show"></i>
									</li>
								</ul>
								<div class="df-comments-inner">
									<?php comments_template();?>
								</div>
							</div>
							<?php endif;?>
						</div>
					</div>
					<?php 
						if( DF_Framework::df_is_mobile() && $general_page_layout !== 'fullwidth'){ ?>
							<div class="col-md-4 sidebar push-top-6">
								<?php DF_Content::df_load_sidebar( $custom_sidebar );?>
							</div>
						<?php
						}else{
							if ( $general_page_layout == 'sidebar-right' ){
						?>
							<div class="col-md-4 sidebar push-top-6">
								<?php DF_Content::df_load_sidebar( $custom_sidebar );?>
							</div>
						<?php
							}
						}
						endwhile; // End of the loop.
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php DF_Content::df_load_back_top() ?>
