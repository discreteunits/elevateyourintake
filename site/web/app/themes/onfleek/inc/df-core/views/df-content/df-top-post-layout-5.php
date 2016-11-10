<div class="boxed lazy-wrapper">
	<div class="row">
		<div class="df-category-top-post layout-5 clearfix">
			<?php 
				$cat		= get_query_var('cat');
				$current	= get_category( $cat );
				$args		= array(
					'cat'				=> $current->term_id,
					'posts_per_page'	=> '5'
					);
				$query_top_post = new WP_Query( $args );
				$counter 		= 1;
				$is_thumbnail	= 'no';
				$is_meta_full	= 'yes';
				while ( $query_top_post->have_posts() ) : $query_top_post->the_post(); 
					if ( $counter == 1 ) {
			?>
						<div class="col-md-6 col-sm-12 col-xs-12 col-md-push-3">
							<div class="top-post-content">
							<?php
								if( DF_Framework::df_is_ipad()) {
									$use_layout		= 'top-post';
									$use_size       = 'df_size_788x524';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$is_meta_full	= 'no';
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									echo DF_Content_View::df_load_category();
									the_title('<h4 class="article-title"><a href="' . esc_url( get_permalink() ) . '">','</a></h4>');
								} else if( wp_is_mobile() ) {
									$use_layout		= 'top-post';
									$use_size       = 'df_size_582x437';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$is_meta_full	= 'no';
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									echo DF_Content_View::df_load_category();
									the_title('<h4 class="article-title"><a href="' . esc_url( get_permalink() ) . '">','</a></h4>');
								} else {
									$use_layout		= 'top-post';
									$use_size       = 'df_size_582x437';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$is_meta_full	= 'no';
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									echo DF_Content_View::df_load_category();
									the_title('<h2 class="article-title"><a href="' . esc_url( get_permalink() ) . '">','</a></h2>');
								}
							?>
							<div class="post-meta">
								<div class="post-meta-desc">
									<?php
										DF_Content::df_load_author_and_date();
										DF_Content::df_load_comment_and_share( $is_meta_full );
									?>
								</div>
							</div>
							<?php echo '<p class="article-content">' . wp_trim_words( get_the_content(), 40, ' ...') . '</p>';?>
							</div>
						</div>
			<?php
					} else {
						if( $counter == 2 ) {
							echo '<div class="col-md-3 col-sm-6 col-xs-6 col-md-pull-6">';
						} else if ($counter == 4) {
							echo '<div class="col-md-3 col-sm-6 col-xs-6">';
						}
			?>	
						<div class="top-post-content">
							<?php
								if( DF_Framework::df_is_ipad()) {
									$use_layout		= 'top-post';
									$use_size       = 'df_size_273x205';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$title_size		= 'h5';
									$is_excerpt		= 'no';
									$is_meta_full	= 'no';
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									echo DF_Content_View::df_load_category();
									DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
								} else if( wp_is_mobile() ) {
									$use_layout		= 'top-post';
									$use_size       = 'df_size_273x205';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$title_size		= 'h5';
									$is_excerpt		= 'no';
									$is_meta_full	= 'no';
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									echo DF_Content_View::df_load_category();
									DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
								} else {
									$use_layout		= 'top-post';
									$use_size       = 'df_size_273x205';
									$is_thumbnail	= 'no';
									$is_secondary	= 'no';
									$title_size		= 'h5';
									$is_excerpt		= 'no';
									$is_meta_full	= 'no';
									DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
									echo DF_Content_View::df_load_category();
									DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
								}
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
			<?php
						echo ( 3 == $counter || 5 == $counter ) ? '</div>': '';
					}
					$counter++;
					array_push( $exclude_posts, get_the_ID());
				endwhile;
				wp_reset_query();
				wp_reset_postdata();
			?>
		</div>
	</div>
</div>
