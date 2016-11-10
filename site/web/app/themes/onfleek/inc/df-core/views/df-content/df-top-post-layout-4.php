<?php
$auto_play = DF_Content::df_auto_play_carousel();
$dv_data_auto_play = sprintf('data-autoplay="%1$s" data-autoplay-speed="%2$s"', esc_attr( $auto_play['auto_play'] ), esc_attr( $auto_play['auto_play_speed'] ) );
?>
<div class="<?php echo ( 'df-content-full' != $layout_type ) ? 'boxed' : 'container-fluid' ;?> no-padding lazy-wrapper">
	<div class="df-category-top-post layout-4" <?php echo $dv_data_auto_play; ?>>
		<?php
			$cat		= get_query_var( 'cat' );
			$current	= get_category( $cat );
			$args		= array(
				'cat' 				=> $current->term_id,
				'posts_per_page' 	=> '6'
				);
			$query_top_post = new WP_Query( $args );
			$use_layout		= 'top-post';
			$use_size		= 'df_size_1200x675';
			$is_thumbnail	= 'no';
			$is_secondary	= 'no';
			$title_size		= 'h2';
			$is_excerpt		= 'no';
			$is_meta_full	= 'no';
		?>
		<?php 
			if ( $query_top_post->have_posts() ) :
				while ( $query_top_post->have_posts() ) : $query_top_post->the_post();
		?>
					<div class="top-post-content layout-4">
						<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );?>
						<span class="overlay"></span>
						<div class="top-post-content-inner">
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
				array_push( $exclude_posts, get_the_ID());
				endwhile; 
				wp_reset_query();
				wp_reset_postdata();
			else : 
		?>
				<p><?php _e( 'Sorry, no posts matched your criteria.', 'onfleek' ); ?></p>
		<?php
			endif;
		?>
	</div>
</div>
