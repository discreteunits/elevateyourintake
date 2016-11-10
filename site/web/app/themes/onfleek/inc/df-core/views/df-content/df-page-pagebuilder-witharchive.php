<?php
	extract( DF_Content::$page_params );
/**
 * 	set layout option from theme option: full, framed, boxed
 *	set bg fixed, scroll 
 */
?>
<div id="df-content-wrapper" class="lazy-wrapper <?php echo ( isset( $layout_type ) ) ? esc_attr( $layout_type ) : '';?> <?php echo ( isset( $bg_type ) ) ? esc_attr( $bg_type ) : '';?>">
	<div class="boxed boxed-modifier-wrapper no-padding">
		<div class="container df-bg-content">
			<div class="row">
				<?php while ( have_posts() ) : the_post();?>
					<div class="col-md-12 df-single-page">
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
					</div>
					<div class="clearfix"></div>
				<?php
					endwhile; // End of the loop.
					DF_Content_View::df_archive_custom_loop( DF_Content::$page_params ); // Call template layout for post setting
				?>
			</div>
		</div>
	</div>
</div>