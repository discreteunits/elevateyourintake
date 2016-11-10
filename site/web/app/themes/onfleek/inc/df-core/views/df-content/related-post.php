<div class="col-md-12">
	<?php
		extract( DF_Content::$single_related_params );

		if( isset( $cat_related ) && 'yes' == strtolower($is_related_article)){
	?>
<div class="df-related-post">
	<?php $query_related = new WP_Query( $cat_related );?>
	<?php if( $query_related->have_posts() ) : ?>
	<h4 class="archive-header-title related-post-header"><?php _e('You May Also Like', 'onfleek' ); ?></h4>
	<div class="row">
		<div class="col-md-12 no-padding related-post-wrap push-top-2">
			<?php while( $query_related->have_posts() ) : $query_related->the_post(); ?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 wrapped-item archive-wraper">
					<?php
						$use_layout		= 'layout-1';
						$use_size		= 'df_size_376x250';
						$is_thumbnail	= 'no';
						$is_secondary	= 'yes';
						$title_size		= 'h4';
						$is_excerpt		= 'yes';
						$is_meta_full	= 'yes';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
						$output = DF_Content_View::df_load_category();
						printf( $output );
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
			<?php endwhile; wp_reset_query(); wp_reset_postdata();?>
		</div>
	</div>
		<?php   
			endif;
		?>
</div>
	<?php 
	}
	?>
</div>
