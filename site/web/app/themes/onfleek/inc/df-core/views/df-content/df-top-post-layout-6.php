<?php
$auto_play = DF_Content::df_auto_play_carousel();
$dv_data_auto_play = sprintf('data-autoplay="%1$s" data-autoplay-speed="%2$s"', esc_attr( $auto_play['auto_play'] ), esc_attr( $auto_play['auto_play_speed'] ) );
?>
<div class="<?php echo ( $layout_type != 'df-content-full') ? 'boxed':'container-fluid' ;?> no-padding lazy-wrapper top-post-wrap">
	<div class="df-category-top-post layout-6" <?php echo $dv_data_auto_play; ?>>
		<?php 
			$cat		= get_query_var('cat');
			$current	= get_category( $cat );
			$args		= array(
				'posts_per_page'	=> 4,
				'cat'				=> $current->term_id,
				'orderby'			=> 'ID',
				'order'				=> 'DESC'
				);
			$query_top_post = new WP_Query( $args );
				if ( $query_top_post->have_posts() ) : 
					while ( $query_top_post->have_posts() ) : $query_top_post->the_post();
		?>
						<div class="no-padding foundposts-<?php echo esc_attr( $query_top_post->found_posts );?>  post-id-<?php echo esc_attr( get_the_ID() );?>">
							<div class="top-post-content layout-6">
								<?php
									$use_layout		= 'top-post';
									$is_secondary	= 'no';
									$is_excerpt		= 'no';
									$is_meta_full	= 'no';
									$use_size		= 'full';
									$is_thumbnail	= 'no';
									$title_size		= 'h2';
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
								?>
								<span class="overlay"></span>
								<div class="container top-post-content-inner">
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
						</div>
		<?php 
					array_push( $exclude_posts, get_the_ID());
					endwhile;
				endif; 
			$query_top_post->rewind_posts();
		?>
	</div>
	<div class="top-post-nav-btn">
		<?php
			if ( $query_top_post->have_posts() ) : 
				while ( $query_top_post->have_posts() ) : $query_top_post->the_post(); 
		?>
					<div class="top-post-nav-btn-inner foundposts-<?php echo esc_attr( $query_top_post->found_posts );?> post-id-<?php echo esc_attr( get_the_ID() );?>">
						<?php
							$use_layout		= 'top-post';
							$is_secondary	= 'no';
							$is_meta_full	= 'no';
							$use_size		= 'df_size_273x205';
							$is_thumbnail	= 'yes';
							$title_size		= 'h5';
							DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
						?>
						<div class="thumb-desc">
							<?php
								if ( wp_is_mobile() ) {
							    	echo '<'. $title_size .' class="article-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></'. $title_size .'>';
								} else {
							    	echo '<'. $title_size .' class="article-title">' . get_the_title() . '</'. $title_size .'>';
								} ?>
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
					wp_reset_query();
					wp_reset_postdata();
				endif;
		?>
	</div>
</div>
