<?php
/**
 * Class: DF_Search_Ajax
 */

if ( !class_exists( 'DF_Search_Ajax' ) ) {
	
	class DF_Search_Ajax{

		function __construct() {			
			// add action for script js
   			add_action( 'wp_ajax_nopriv_df_search', array( $this, 'df_search' ) );
   			add_action( 'wp_ajax_df_search', array( $this, 'df_search' ) );
		}

		/**
		 * df_search
		 * function for collecting data from ajax request
		 */
		function df_search() {
			do_action( 'df_set_global_variable' );
			$search_param = $_POST['search_param'];
			echo $this->df_result_search( $search_param );
			die();
		}

		/**
		 * df_result_search
		 * function for query post, return posts
		 * @param $search_param
		 * @return $output 
		 */
		private function df_result_search( $search_param ) {

			$output = '';
			if ( empty( $search_param ) ) {
				return $output;
			} else {
				//call df_set_global_variable from framework to get default featured image
				DF_Framework::df_set_global_variable();
				$posts = new WP_Query( array( 's' => $search_param, 'post_type' => 'post', 'post_status' => 'publish' ) );
				ob_start();
				if ( $posts->have_posts() ) { ?>
					<?php while( $posts->have_posts() ) : $posts->the_post();?>
							<div class="col-lg-4 col-md-4 archive-wraper">
								<?php
									$use_layout		= 'layout-1';
									$use_size		= array(376,250);
									$is_thumbnail	= 'no';
									$is_secondary	= 'yes';
									$title_size		= 'h4';
									$is_excerpt		= 'no';
									$is_meta_full	= 'yes';
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
			<?php	endwhile; ?>
			<?php } else {?>
						<div class="col-md-12 df-search-result-grid-item">
							<p class="small">No Result</p>
						</div>
					<?php
				}
				$output = ob_get_contents();
				if (ob_get_contents()) ob_end_clean();
				wp_reset_query();
				wp_reset_postdata();
				return $output;
			}
		}
	} 
	new DF_Search_Ajax();
}

/* file location: [theme directory]/inc/df-core/df-search-ajax.php */
