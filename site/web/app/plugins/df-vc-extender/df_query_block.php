<?php
/**
 * Class: DF_Query_Block
 * Description: [description]
 */

if( !class_exists('DF_Query_Block') ) {

	Class DF_Query_Block {

		static $args_query = array();
		static $source_param = '';
	    static $current_page = 1;

		function __construct() {
			add_action( 'wp_ajax_nopriv_nextPostsBlock', array( $this, 'nextPostsBlock' ) );
	   		add_action( 'wp_ajax_nextPostsBlock', array( $this, 'nextPostsBlock' ) );

	   		add_action( 'wp_ajax_nopriv_prevPostsBlock', array( $this, 'prevPostsBlock' ) );
	   		add_action( 'wp_ajax_prevPostsBlock', array( $this, 'prevPostsBlock' ) );

	   		add_action( 'wp_ajax_nopriv_currentPosts', array( $this, 'currentPosts' ) );
	   		add_action( 'wp_ajax_currentPosts', array( $this, 'currentPosts' ) );
		}

		static function &query_new_posts( $args ){
			$query = new WP_Query( $args );
			return $query;
		}

		static function set_query_transient( $transient_name, $value, $expire_time ){
			set_transient( $transient_name, $value, $expire_time );
		}

		static function get_query_transient( $transient_name ){
			return get_transient( $transient_name );
		}

		function delete_query_transient( $transient_name ){
			delete_transient( $transient_name );
		}

		function currentPosts(){
			$column = $_POST['column'];
			$block_id = $_POST['block_id'];
			$block_type = $_POST['block_type'];
			$sort_order = $_POST['sort_order'];
			$source = $_POST['source'];
			$source_params = $_POST['source_params'];
			$total_pages = $_POST['total_pages'];
			$current_page = $_POST['current_page'];
			$posts_per_page = $_POST['posts_per_page'];
			$post_id_page = $_POST['post_id_page'];
			$page_template = $_POST['page_template'];
			$pagination_status = $_POST['pagination_status'];

			$atts = array( 
					'posts_per_page' => $posts_per_page,
					'source' => $source,
					'paged' => $current_page
				);
			if( $source == 'by-category' ){
				$atts['categories'] = $source_params;
			}
			if( $source == 'by-post-id'){
				$atts['post_ids'] = $source_params;
			}
			if( $source == 'by-tag'){
				$atts['tag_slugs'] = $source_params;
			}
			if( $source == 'by-author' ){
				$atts['author_ids'] = $source_params;
			}
			if( $pagination_status === 'pagination-disable' ){
				$atts = wp_parse_args(
					array(
						'no_found_rows' => true
					)
				, $atts );
			}
			
			$totalpost = '';
			$totalpages = '';

			$args = $this->df_vc_atts_to_args( $atts, $sort_order );
			$new_posts = '';
			
			$new_posts_query = &self::query_new_posts( $args );
			
			$totalpost = $new_posts_query->found_posts;
			$totalpages = $new_posts_query->max_num_pages;

			$pagination = '';
			$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': '';

			$params_block = array(
								'sidebar' => '',
								'block_id' => $block_id,
								'column' => $column,
								'block_type' => $block_type,
								'source' => $source,
								'source_params' => $source_params,
								'total_pages' => $totalpages,
								'current_page' => $current_page,
								'posts_per_page' => $posts_per_page,
								'sort_order' => $sort_order, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'pagination' => $pagination
							);

			$block_render = new DF_Render_Loop();

			$new_posts .= '<div class="'.esc_attr( $block_render->div_unique_class( $block_id ) ).' clearfix">';
			switch ( $block_type ) {
				case 'df_block_1':
					$new_posts .= $block_render->df_render_block_1( $new_posts_query, $params_block );
					break;
				case 'df_block_2':
					$new_posts .= $block_render->df_render_block_2( $new_posts_query, $params_block );
					break;
				case 'df_block_3':
					$new_posts .= $block_render->df_render_block_3( $new_posts_query, $params_block );
					break;
				case 'df_block_4':
					$new_posts .= $block_render->df_render_block_4( $new_posts_query, $params_block );
					break;
				case 'df_block_5':
					$new_posts .= $block_render->df_render_block_5( $new_posts_query, $params_block );
					break;
				case 'df_block_6':
					$new_posts .= $block_render->df_render_block_6( $new_posts_query, $params_block );
					break;
				case 'df_block_7':
					$new_posts .= $block_render->df_render_block_7( $new_posts_query, $params_block );
					break;
				case 'df_block_8':
					$new_posts .= $block_render->df_render_block_8( $new_posts_query, $params_block );
					break;
				case 'df_block_9':
					$new_posts .= $block_render->df_render_block_9( $new_posts_query, $params_block );
					break;
				case 'df_block_10':
					$new_posts .= $block_render->df_render_block_10( $new_posts_query, $params_block );
					break;
				case 'df_block_11':
					$new_posts .= $block_render->df_render_block_11( $new_posts_query, $params_block );
					break;
				case 'df_block_12':
					$new_posts .= $block_render->df_render_block_12( $new_posts_query, $params_block );
					break;
				case 'df_block_13':
					$new_posts .= $block_render->df_render_block_13( $new_posts_query, $params_block );
					break;
			}
			$new_posts .= '</div>';
			$new_posts .= $block_render->pagination_block();
			die( $new_posts );
		}

		/**
		 * nextPostsBlock
		 * method for get next posts (ajax query shortcode blocks)
		 */
		function nextPostsBlock(){
			$block_id = $_POST['block_id'];
			$block_type = $_POST['block_type'];
			$source = $_POST['source'];
			$source_param = $_POST['source_param'];
			$total_pages = $_POST['total_pages'];
			$current_page = $_POST['current_page'];
			$posts_per_page = $_POST['posts_per_page'];
			$sort_order = $_POST['sort_order'];
			$sidebar = $_POST['sidebar'];
			$column = $_POST['column'];
			$post_id_page = $_POST['post_id_page'];
			$page_template = $_POST['page_template'];
			$pagination = $_POST['pagination'];
			
			$atts = array( 
					'posts_per_page' => $posts_per_page,
					'source' => $source,
					'paged' => $current_page+1
				);
			if( $source == 'by-category' ){
				$atts['categories'] = $source_param;
			}
			if( $source == 'by-post-id'){
				$atts['post_ids'] = $source_param;
			}
			if( $source == 'by-tag'){
				$atts['tag_slugs'] = $source_param;
			}
			if( $source == 'by-author' ){
				$atts['author_ids'] = $source_param;
			}

			$args = $this->df_vc_atts_to_args( $atts, $sort_order );
			$new_posts = '';
			
			$params_block = array(
								'sidebar' => '',
								'block_id' => $block_id,
								'column' => $column,
								'block_type' => $block_type,
								'source' => $source,
								'source_params' => $source_params,
								'total_pages' => $totalpages,
								'current_page' => $paged,
								'posts_per_page' => $posts_per_page,
								'sort_order' => $sort_order, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'pagination' => $pagination
							);
			$new_posts_query = &self::query_new_posts( $args );
			$block_render = new DF_Render_Loop();
			switch ( $block_type ) {
				case 'df_block_1':
					$new_posts .= $block_render->df_render_block_1( $new_posts_query, $params_block );
					break;
				case 'df_block_2':
					$new_posts .= $block_render->df_render_block_2( $new_posts_query, $params_block );
					break;
				case 'df_block_3':
					$new_posts .= $block_render->df_render_block_3( $new_posts_query, $params_block );
					break;
				case 'df_block_4':
					$new_posts .= $block_render->df_render_block_4( $new_posts_query, $params_block );
					break;
				case 'df_block_5':
					$new_posts .= $block_render->df_render_block_5( $new_posts_query, $params_block );
					break;
				case 'df_block_6':
					$new_posts .= $block_render->df_render_block_6( $new_posts_query, $params_block );
					break;
				case 'df_block_7':
					$new_posts .= $block_render->df_render_block_7( $new_posts_query, $params_block );
					break;
				case 'df_block_8':
					$new_posts .= $block_render->df_render_block_8( $new_posts_query, $params_block );
					break;
				case 'df_block_9':
					$new_posts .= $block_render->df_render_block_9( $new_posts_query, $params_block );
					break;
				case 'df_block_10':
					$new_posts .= $block_render->df_render_block_10( $new_posts_query, $params_block );
					break;
				case 'df_block_11':
					$new_posts .= $block_render->df_render_block_11( $new_posts_query, $params_block );
					break;
				case 'df_block_12':
					$new_posts .= $block_render->df_render_block_12( $new_posts_query, $params_block );
					break;
				case 'df_block_13':
					$new_posts .= $block_render->df_render_block_13( $new_posts_query, $params_block );
					break;
			}
			
			die( $new_posts );
		}

		/**
		 * prevPostsBlock
		 * method for get prev posts (ajax query shortcode blocks)
		 */
		function prevPostsBlock(){
			$block_id = $_POST['block_id'];
			$block_type = $_POST['block_type'];
			$source = $_POST['source'];
			$source_param = $_POST['source_param'];
			$total_pages = $_POST['total_pages'];
			$current_page = $_POST['current_page'];
			$posts_per_page = $_POST['posts_per_page'];
			$sort_order = $_POST['sort_order'];
			$sidebar = $_POST['sidebar'];
			$column = $_POST['column'];
			$post_id_page = $_POST['post_id_page'];
			$page_template = $_POST['page_template'];
			$pagination = $_POST['pagination'];

			$atts = array( 
					'posts_per_page' => $posts_per_page,
					'source' => $source,
					'paged' => $current_page-1,
				);
			if( $source == 'by-category' ){
				$atts['categories'] = $source_param;
			}
			if( $source == 'by-post-id'){
				$atts['post_ids'] = $source_param;
			}
			if( $source == 'by-tag'){
				$atts['tag_slugs'] = $source_param;
			}
			if( $source == 'by-author' ){
				$atts['author_ids'] = $source_param;
			}

			$args = $this->df_vc_atts_to_args( $atts, $sort_order );
			$new_posts = '';
			$params_block = array(
								'sidebar' => '',
								'block_id' => $block_id,
								'column' => $column,
								'block_type' => $block_type,
								'source' => $source,
								'source_params' => $source_params,
								'total_pages' => $totalpages,
								'current_page' => $paged,
								'posts_per_page' => $posts_per_page,
								'sort_order' => $sort_order, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'pagination' => $pagination
							);
			$new_posts_query = &self::query_new_posts( $args );
			$block_render = new DF_Render_Loop();
			switch ( $block_type ) {
				case 'df_block_1':
					$new_posts .= $block_render->df_render_block_1( $new_posts_query, $params_block );
					break;
				case 'df_block_2':
					$new_posts .= $block_render->df_render_block_2( $new_posts_query, $params_block );
					break;
				case 'df_block_3':
					$new_posts .= $block_render->df_render_block_3( $new_posts_query, $params_block );
					break;
				case 'df_block_4':
					$new_posts .= $block_render->df_render_block_4( $new_posts_query, $params_block );
					break;
				case 'df_block_5':
					$new_posts .= $block_render->df_render_block_5( $new_posts_query, $params_block );
					break;
				case 'df_block_6':
					$new_posts .= $block_render->df_render_block_6( $new_posts_query, $params_block );
					break;
				case 'df_block_7':
					$new_posts .= $block_render->df_render_block_7( $new_posts_query, $params_block );
					break;
				case 'df_block_8':
					$new_posts .= $block_render->df_render_block_8( $new_posts_query, $params_block );
					break;
				case 'df_block_9':
					$new_posts .= $block_render->df_render_block_9( $new_posts_query, $params_block );
					break;
				case 'df_block_10':
					$new_posts .= $block_render->df_render_block_10( $new_posts_query, $params_block );
					break;
				case 'df_block_11':
					$new_posts .= $block_render->df_render_block_11( $new_posts_query, $params_block );
					break;
				case 'df_block_12':
					$new_posts .= $block_render->df_render_block_12( $new_posts_query, $params_block );
					break;
				case 'df_block_13':
					$new_posts .= $block_render->df_render_block_13( $new_posts_query, $params_block );
					break;

			}
			die( $new_posts );
		}

		/**
		 * set_source_param
		 * method for set source of parameter ( most-recent, by-category, by-post-id, by-tag-slug, by-author)
		 */
		function set_source_param( $source='' ){
			self::$source_param = $source;
		}

		/**
		 * set_source_param
		 * method for get source of parameter ( most-recent, by-category, by-post-id, by-tag-slug, by-author)
		 */
		function get_source_param( ){
			return self::$source_param;
		}

		/**
		 * df_vc_atts_to_args
		 * @param $atts
		 * @return $args
		 */
		function df_vc_atts_to_args( $atts, $sort_order='' ){
			global $post;
			$is_unique_article = get_post_meta( $post->ID, 'df_magz_page_unique_article', 'true');
			if ( $is_unique_article == 'yes' ) {
				$post__not_in = DF_VC_Extender_Shortcode::$_not_in_posts;
			}else{
				$post__not_in = array();
			}
			//
			extract( $atts );
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'ignore_sticky_posts' => true,
				'post__not_in'	 => $post__not_in,
				'cache_results' => false,
				'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
				'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
			);
			switch ($source) {
				case 'most-recent':
					$args = wp_parse_args(
						array(
							'posts_per_page' => $posts_per_page
						)
					, $args);
					$this->set_source_param();
					break;
				case 'by-category':
					if(!empty($categories)){
						$cats = explode(',',$categories);
						$args = wp_parse_args(
							array(
								'posts_per_page' => $posts_per_page, 
								'cat' => $categories
							)
						, $args);
					}
					$this->set_source_param( $categories );
					break;
				case 'by-post-id':
					$posts = explode(',', $post_ids);
					$args = wp_parse_args(
						array(
							'post__in' => $posts,
							'posts_per_page' => $posts_per_page,
							'orderby' => 'post__in'
						)
					, $args);
					$this->set_source_param( $post_ids );
					break;
				case 'by-tag':
					$tags = explode(',', $tag_slugs);
					$args = wp_parse_args(
						array(
							'posts_per_page' => $posts_per_page,
							'tag_slug__in' => $tags
						)
					, $args);
					$this->set_source_param( $tag_slugs );
					break;
				case 'by-author':
					$authors = explode(',', $author_ids);
					$args = wp_parse_args(
						array(
							'posts_per_page' => $posts_per_page,
							'author__in' => $authors
						)
					, $args);
					$this->set_source_param( $author_ids );
					break;
				default:
					$args = wp_parse_args(
						array(
							'posts_per_page' => $posts_per_page
						)
					, $args);
					$this->set_source_param();
					break;
			}
			$args = wp_parse_args( array( 'paged' => $paged ), $args );
			if( isset( $no_found_rows ) ){
				$args = wp_parse_args( array( 'no_found_rows' => $no_found_rows ), $args );
			}
			// if sort order set
			if( $sort_order != '' ){
				switch( $sort_order ){
					case 'sort-random-today':
						$args = wp_parse_args( $this->df_date_query( $sort_order ), $args );
					break;
					case 'sort-random-7day':
						$args = wp_parse_args( $this->df_date_query( $sort_order ), $args );
					break;
					case 'sort-alphabetical':
						$args = wp_parse_args( $this->df_alphabetical_query( $sort_order ) , $args);
					break;
					case 'sort-popular':
						$args = wp_parse_args( $this->df_popular_query( $sort_order ) , $args );
					break;
				}
			}
			return $args;
		}

		/**
		 * df_date_query
		 * @param $args
		 * @param $sort_type
		 * @return $args
		 */
		function df_date_query( $sort_type ){
			if( $sort_type == 'sort-random-today'){
				$today = getdate();
				$args = array(
						'orderby' => 'rand',
						'date_query' => array(
								array(
									'year' => $today['year'],
									'month' => $today['mon'],
									'day' => $today['mday']
								)
							)
					);
			}else if( $sort_type == 'sort-random-7day' ){
				$week = date( 'W' );
				$year = date( 'Y' );
				$args = array(
						'orderby' => 'rand',
						'date_query' => array(
								array(
									'year' => $year,
									'week' => $week
								)
							)
					);
			}
			return $args;
		}

		/**
		 * df_alphabetical_query
		 * @param $args
		 * @param $sort_type
		 * @return $args
		 */
		function df_alphabetical_query( $sort_type ){
			if( $sort_type == 'sort-alphabetical' ){
				$args = array(
						'order' => 'ASC',
						'orderby' => 'title'
					);
			}
			return $args;
		}

		/**
		 * df_popular_query
		 * @param $args
		 * @param $sort_type
		 * @return $args
		 */
		function df_popular_query( $sort_type ){
			if(  $sort_type == 'sort-popular' ){
				$args = array(
						'order' => 'DESC',
						'orderby' => 'comment_count'
					);
			}
			return $args;
		}
	}
}

/* file location: /your/file/location/df-query-block.php */