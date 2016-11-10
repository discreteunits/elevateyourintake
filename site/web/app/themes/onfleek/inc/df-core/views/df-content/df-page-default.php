<?php
	extract( DF_Content::$page_params );
/**
 * 	set layout option from theme option: full, framed, boxed
 *	set bg fixed, scroll 
 */
?>
<div id="df-content-wrapper" class="lazy-wrapper df-content-wrapper <?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '';?> <?php echo ( isset( $bg_type ) ) ? esc_attr( $bg_type ) : '';?>">
	<div class="boxed boxed-modifier-wrapper no-padding">
		<div id="df-wrapper-content-single">
			<div class="df-wrapper-inner">
				<div class="container df-bg-content push-top-6">
					<div class="row">
					<?php while ( have_posts() ) : the_post();?>
					<div class="col-md-12 no-padding">
						<div class="df-category-header">
							<div class="df-breadcrumb-container">
								<div class="entry-crumb">
									<?php if ( 'no' != $breadcrumb ) { DF_Megamenu::df_get_breadcrumb(); }?>
								</div>
							</div>
							<div class="df-post-header">
								<header class="td-post-tittle">
									<?php the_title( '<h1 class="entry-title">', '</h1>' );?>
								</header>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
						<?php
							if ( $general_page_layout == 'sidebar-left') {
						?>
							<div class="col-md-4 sidebar">
								<?php DF_Content::df_load_sidebar( $custom_sidebar );?>
							</div>
						<?php
							}
					?>
					<div class="<?php echo ( 'sidebar-right' == $general_page_layout || 'sidebar-left' == $general_page_layout ) ? 'col-md-8' : 'col-md-12';?> df-single-page df-content-sticky">
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
							
							<?php 
							$is_comment_on_page = isset(DF_Global_Options::$options['general']['global']['is_comment_on_page']) ? DF_Global_Options::$options['general']['global']['is_comment_on_page'] : 'no';
							if ( ($is_comment_on_page == 'no') && (comments_open() || get_comments_number()) ) :?>
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
						if ( $general_page_layout == 'sidebar-right' ){
					?>
						<div class="col-md-4 sidebar">
							<?php DF_Content::df_load_sidebar( $custom_sidebar );?>
						</div>
					<?php
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