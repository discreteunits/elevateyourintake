<?php
/**
 * Class: DF_Block_Module_Post
 * Description:
 */

if( !class_exists('DF_Block_Module_Post') ) {

	Class DF_Block_Module_Post {

		function __construct() {

		}

		function df_get_column( $post_id, $column_used, $page_template ){
			$page = $page_template;
			$columns_block = 1;
			if( $page == 'true' ){
					switch ( $column_used ) {
		                case '1/1':
		                case '3/4':
		                case '5/6':
		                    $columns_block = 3;
		                    break;
		                case '1/2':
		                case '2/3':
		                    $columns_block = 2;
		                    break;
		                case '1/3':
		                case '1/4':
		                case '1/6':
		                    $columns_block = 1;
		                    break;
		            }
			}else{
				$meta_general_page_layout = get_post_meta( $post_id, "df_magz_page_layout", true );
				$sidebar_layout = '';
				if( empty( $meta_general_page_layout ) || $meta_general_page_layout == 'default' ){
					$template_setting = DF_Options::df_get_template_setting_options();
					$page_layout = $template_setting['page_template']['layout'];
					$sidebar_layout = $page_layout;
				}else{
					$sidebar_layout = $meta_general_page_layout;
				}

				if( $sidebar_layout != 'fullwidth' ){

					switch ( $column_used ) {
						case '1/1':
						case '1/2':
						case '2/3':
						case '3/4':
						case '5/6':
							$columns_block = 2;
							break;
						case '1/3':
							$columns_block = 1;
							break;
					}
				}else{
					switch ( $column_used ) {
						case '1/1':
						case '3/4':
						case '5/6':
							$columns_block = 3;
							break;
						case '1/2':
						case '2/3':
							$columns_block = 2;
							break;
						case '1/3':
						case '1/4':
						case '1/6':
							$columns_block = 1;
							break;
					}
				}
			}

			return $columns_block;
		}

		function df_render_module_1_big( $post, $class="" ){
			ob_start();
			?>
			<div class="<?php echo esc_attr( $class );?>">
				<div class="df-shortcode-blocks-main clearfix">
					<?php
						$use_layout		= 'main-blocks';
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$title_size		= 'h4';
						$is_excerpt		= 'yes';
						$is_meta_full	= 'yes';
						$use_size		= 'df_size_788x524';
					?>
					<div class="embed-responsive embed-responsive-188by125">
						<div class="embed-responsive-item">
							<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary ); ?>
						</div>
					</div>
					<?php
						echo DF_Content_View::df_load_category();
						DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
					?>
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
			</div>
			<?php
			return ob_get_clean();
		}

		function df_render_module_1_small( $post, $class="" ){
			ob_start();
			?>
				<div class="<?php echo esc_attr( $class );?>">
					<div class="df-shortcode-blocks-main">
						<?php
							$use_layout		= 'main-blocks';
							$use_size		= 'df_size_273x205';
							$is_thumbnail	= 'yes';
							$is_secondary	= 'no';
							$title_size		= 'h5';
							$is_excerpt		= 'no';
							$is_meta_full	= 'no';
							DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
						?>
						<div class="thumb-desc">
							<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );?>
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
			return ob_get_clean();
		}

		function df_render_module_1_small_reverse( $post, $class="" ){
			ob_start();
			?>
			<div class="<?php echo esc_attr( $class );?>">
				<div class="df-shortcode-blocks-main style-5">
					<?php
						$use_layout		= 'main-blocks';
						$use_size		= 'df_size_273x205';
						$is_thumbnail	= 'yes';
						$is_secondary	= 'no';
						$title_size		= 'h5';
						$is_excerpt		= 'no';
						$is_meta_full	= 'no';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
					?>
					<div class="thumb-desc">
						<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );?>
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
			return ob_get_clean();
		}

		function df_render_module_2( $post, $class="" ){
			ob_start();
			?>
			<div class="<?php echo esc_attr( $class );?>">
				<div class="df-shortcode-blocks-main clearfix">
					<?php
						$use_layout		= 'main-blocks';
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$title_size		= 'h4';
						$is_excerpt		= 'no';
						$is_meta_full	= 'no';
						$use_size		= 'df_size_788x524';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
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
			return ob_get_clean();
		}

		function df_render_module_3( $post, $class="" ){
			ob_start();
			?>
			<div class="<?php echo esc_attr( $class);?>">
				<div class="df-shortcode-blocks-main">
					<?php
						$use_layout		= 'main-blocks';
						$is_thumbnail	= 'yes';
						$title_size		= 'h5';
						$is_excerpt		= 'no';
						$is_meta_full	= 'yes';
						DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
					?>
					<div class="post-meta">
						<div class="post-meta-desc">
							<div class="post-meta-desc-top">
								<?php DF_Content::df_load_author_and_date();?>
							</div>
							<div class="post-meta-desc-btm">
								<?php DF_Content::df_load_comment_and_share( $is_meta_full );?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}

		function df_render_module_4( $post, $class="", $col_used ){
				ob_start();
				$col_type = 'one-thirds-column';
				$title_size		= 'h4';
				if ( 3 == $col_used ){
					$col_type = 'full-column';
					$title_size		= 'h2';
				} else if ( 2 == $col_used ){
					$col_type = 'two-thirds-column';
					$title_size		= 'h2';
				}
			?>
			<div class="<?php echo esc_attr( $class );?>">
				<div class="df-shortcode-blocks-main main-blocks">
					<?php
						$use_layout		= 'main-blocks';
						$use_size 		= array( 1200, 675 );
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$is_meta_full	= 'yes';
						$is_excerpt		= 'yes';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
					?>
					<div class="df-shortcode-blocks-main-inner <?php echo esc_attr( $col_type );?> clearfix">
						<?php
							echo DF_Content_View::df_load_category();
							DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
						?>
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
				</div>
			</div>
			<?php
			return ob_get_clean();
		}

		function df_render_module_5( $post, $class="" ){
			ob_start();
			?>
			<div class="<?php echo esc_attr( $class );?> no-padding">
				<div class="df-shortcode-blocks-main main-grid clearfix">
					<?php
						$use_layout		= 'main-blocks';
						$use_size 		= 'df_size_1200x675';
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$title_size		= 'h5';
						$is_excerpt		= 'no';
						$is_meta_full	= 'no';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
					?>
					<span class="overlay"></span>
					<div class="df-shortcode-blocks-main-inner">
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
			return ob_get_clean();
		}

		function df_render_module_6( $post, $class="" ){
			ob_start();
			?>
			<div class="<?php echo esc_attr( $class ) ;?>">
				<div class="df-shortcode-blocks-main">
					<?php
						$use_layout		= 'main-blocks-9';
						$use_size		= 'df_size376x250';
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$title_size		= 'h5';
						$is_excerpt		= 'no';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
						echo DF_Content_View::df_load_category();
						DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
					?>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}

		function df_render_module_7( $post, $class="" ){
			ob_start();
			?>
			<div class="<?php echo esc_attr( $class );?> main-blocks">
				<div class="df-shortcode-blocks-main main-grid clearfix">
					<?php
						$use_layout		= 'main-blocks';
						$is_thumbnail	= 'no';
						$is_secondary 	= 'no';
						$title_size		= 'h4';
						$is_excerpt		= 'no';
						$is_meta_full	= 'yes';
						$size 		= array(1200, 675);
					?>
					<div class="embed-responsive embed-responsive-16by9">
						<div class="embed-responsive-item">
							<?php DF_Content::df_load_feature_image( $use_layout, $size, $is_thumbnail, $is_secondary ); ?>
						</div>
					</div>
					<span class="overlay"></span>
					<div class="df-shortcode-blocks-main-inner">
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
			return ob_get_clean();
		}

		function df_render_module_8( $post, $class="" ){
			ob_start();
			?>
			<div class="<?php echo esc_attr( $class );?> small-blocks">
				<div class="df-shortcode-blocks-main">
					<?php
						$use_layout		= 'main-blocks';
						$use_size		= 'df_size_273x205';
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$title_size		= 'h4';
						$is_excerpt		= 'yes';
						$is_meta_full	= 'yes';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
					?>
					<div class="thumb-desc">
						<?php DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );?>
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
			return ob_get_clean();
		}

		function df_render_module_9( $post, $class="" ){
			extract( $class );
			ob_start();
			?>
			<div class="col-md-12 no-padding">
				<div class="df-shortcode-blocks-main style-13 small-blocks clearfix">
					<div class="col-md-3 col-sm-3">
						<?php
							$use_layout		= 'widget-blocks';
							$use_size		= 'df_size_273x205';
							$is_thumbnail	= 'no';
							$is_secondary	= 'no';
							$title_size		= 'h4';
							$is_excerpt		= 'no';
							$is_meta_full	= 'no';
							DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
						?>
					</div>
					<div class="col-md-9 col-sm-9">
						<div class="archive-wraper">
							<?php printf( '<'. $title_size .' class="article-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></'. $title_size .'>');?>
							<div class="post-meta">
								<div class="post-meta-desc">
									<?php
										DF_Content::df_load_author_and_date();
										DF_Content::df_load_comment_and_share( $is_meta_full );
									?>
								</div>
							</div>
							<div class="article-content blocks-content">
								<?php printf( '<p class="article-content">' . wp_trim_words( get_the_content(), 40, ' ...') . '</p>' );?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}

		function df_render_module_grid_big( $post, $class="", $img_size, $heading ){
			ob_start();
			?>
			<div class="grid big-size <?php echo esc_attr( $class );?>">
				<?php
					$use_layout		= 'main-grid';
					$use_size		= $img_size;
					$is_thumbnail	= 'no';
					$is_secondary	= 'no';
					$title_size		= $heading;
					$is_excerpt		= 'no';
					$is_meta_full	= 'no';
					DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
				?>
				<div class="df-shortcode-grid-inner">
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
			return ob_get_clean();
		}

		function df_render_module_grid_medium( $post, $class="", $img_size, $heading ){
			ob_start();
			?>
			<div class="grid medium-size <?php echo esc_attr( $class );?>">
				<?php
					$use_layout		= 'main-grid';
					$use_size		= $img_size;
					$is_thumbnail	= 'no';
					$is_secondary	= 'no';
					$title_size		= $heading;
					$is_excerpt		= 'no';
					$is_meta_full	= 'no';
					DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
				?>
				<div class="df-shortcode-grid-inner">
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
			return ob_get_clean();
		}

		function df_render_module_grid_small( $post, $class="", $img_size, $heading ){
			ob_start();
			?>
			<div class="grid small-size <?php echo esc_attr( $class );?>">
				<?php
					$use_layout		= 'main-grid';
					$use_size		= $img_size;
					$is_thumbnail	= 'no';
					$is_secondary	= 'no';
					$title_size		= $heading;
					$is_excerpt		= 'no';
					$is_meta_full	= 'no';
					DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
				?>
				<div class="df-shortcode-grid-inner">
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
			return ob_get_clean();
		}

		function df_render_module_carousel_1( $post, $class="", $img_size, $heading ){
			ob_start();
			?>
			<div class="carousel-content">
				<?php
					$use_layout		= 'main-carousel';
					$use_size		= $img_size;
					$is_thumbnail	= 'no';
					$is_secondary	= 'no';
					$title_size		= $heading;
					$is_excerpt		= 'no';
					$is_meta_full	= 'no';
					DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
				?>
				<span class="overlay"></span>
				<div class="carousel-content-inner">
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
			return ob_get_clean();
		}

		function df_render_module_carousel_2_big( $post, $class="" ){
			ob_start();
				$dv_excerpt = get_the_excerpt();
				if ( '' != $dv_excerpt ) {
					$dv_archive_content = strip_shortcodes( $dv_excerpt );
				}else {
					$dv_archive_content = strip_shortcodes( get_the_content() );
				}
			?>
			<div class="carousel-content">
				<?php
					if( DF_Framework::df_is_ipad()) {
						$use_layout		= 'main-carousel';
						$use_size       = 'df_size_788x524';
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$is_meta_full	= 'no';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
						echo  DF_Content_View::df_load_category();
						the_title('<h4 class="article-title"><a href="' . esc_url( get_permalink() ) . '">','</a></h4>');
					} else if( wp_is_mobile() ) {
						$use_layout		= 'main-carousel';
						$use_size       = 'df_size_632x474';
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$is_meta_full	= 'no';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
						echo DF_Content_View::df_load_category();
						the_title('<h4 class="article-title"><a href="' . esc_url( get_permalink() ) . '">','</a></h4>');
					} else {
						$use_layout		= 'main-carousel';
						$use_size       = 'df_size_632x474';
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
				<?php echo '<p class="article-content">' . wp_trim_words( $dv_archive_content, 40, ' ...') . '</p>';?>
			</div>
			<?php
			return ob_get_clean();
		}

		function df_render_module_carousel_2_small( $post, $class="" ){
			ob_start();
			?>
			<div class="carousel-content">
				<?php
					if( DF_Framework::df_is_ipad()) {
						$use_layout		= 'main-carousel';
						$use_size       = 'df_size_632x474';
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$title_size		= 'h5';
						$is_excerpt		= 'no';
						$is_meta_full	= 'no';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
						echo DF_Content_View::df_load_category();
						DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
					} else if( wp_is_mobile() ) {
						$use_layout		= 'main-carousel';
						$use_size       = 'df_size_632x474';
						$is_thumbnail	= 'no';
						$is_secondary	= 'no';
						$title_size		= 'h5';
						$is_excerpt		= 'no';
						$is_meta_full	= 'no';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
						echo DF_Content_View::df_load_category();
						DF_Content::df_load_title_and_content( $use_layout, $title_size, $is_thumbnail, $is_excerpt );
					} else {
						$use_layout		= 'main-carousel';
						$use_size       = 'df_size_632x474';
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
			return ob_get_clean();
		}

		function df_render_module_carousel_3_main( $post, $class="", $img_size ){
			ob_start();
			?>
			<div class="no-padding">
				<div class="carousel-content">
					<?php
						$use_layout		= 'top-post';
						$use_size		= $img_size;
						$is_secondary	= 'no';
						$is_excerpt		= 'no';
						$is_meta_full	= 'no';
						$is_thumbnail	= 'no';
						$title_size		= 'h2';
						DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
					?>
					<span class="overlay"></span>
					<div class="container carousel-content-inner">
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
			return ob_get_clean();
		}

		function df_render_module_carousel_3_nav( $post, $class="", $img_size ){
			ob_start();
			?>
			<div class="nav-carousel-inner">
				<?php
					$use_layout		= 'top-post';
					$is_secondary	= 'no';
					$is_meta_full	= 'no';
					$use_size		= $img_size;
					$is_thumbnail	= 'yes';
					$title_size		= 'h5';
					DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );
				?>
				<div class="thumb-desc">
					<?php
						if ( DF_Framework::df_is_mobile() ) {
					    	echo  '<'. $title_size .' class="article-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></'. $title_size .'>';
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
			return ob_get_clean();
		}

		function df_render_module_carousel_4( $post, $class="", $img_size ){
			ob_start();
			?>
			<div class="df-shortcode-blocks main-carousel layout-8 <?php echo esc_attr( $class );?>">
				<?php
					$use_layout		= 'main-carousel';
					$use_size		= $img_size;
					$is_thumbnail	= 'no';
					$is_secondary	= 'no';
					$title_size		= 'h2';
					$is_excerpt		= 'no';
					$is_meta_full	= 'no';
				?>
				<div class="article-img-wrap">
					<?php DF_Content::df_load_feature_image( $use_layout, $use_size, $is_thumbnail, $is_secondary );?>
				</div>
				<div class="df-shortcode-carousel-inner">
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
			return ob_get_clean();
		}
	}

}

/* file location: /your/file/location/[file].php */
