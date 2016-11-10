<?php
/**
 * Dahz Framework
 * df_vc_extender-shortcode.php
 * Class: vc_extender_shortcode
 * Description: class for render vc extender shortcode
 */
if( !class_exists( 'DF_VC_Extender_Shortcode' ) ){

	require_once( 'df_query_block.php' );
	require_once( 'df_block_module_post.php' );

	class DF_VC_Extender_Shortcode{

		private static $query_block;
		public static $_not_in_posts = array();
		
		/**
		 * __construct()
		 */
		function __construct( $array_map ) {
			if( !function_exists( 'vc_map_get_attributes' ) ){
				return;
			}else{
				$array_map_block = $array_map;
				foreach ( $array_map_block as $amb ) {
					extract( $amb );
					add_shortcode( $base, array( $this , $base ) );
				}
			}
			add_shortcode( 'df_dropcap', array( $this , 'df_dropcap' ) );
			self::$query_block = new DF_Query_Block();
		}

		private function filtering_category( $category ){
			$cat_no_spaces = str_replace(" ", "-", strtolower( $category ) );
			$cat_no_special = preg_replace('/[^A-Za-z0-9\-]/', '', $cat_no_spaces);
			return $cat_no_special;
		}

		/**
		 * render_block_title
		 */
		private function df_render_block_title( $params_title ){
			extract( $params_title );
			$style_title = ( $show_title == 'no' ) ? 'border-bottom:0px; margin-bottom:0px; height:0;' : '';
			ob_start();
			?>
			<div class="col-md-12" <?php printf ( $show_title == 'no' ) ? 'style="height:0;"' :'';?> >
				<div class="df-shortcode-blocks-top clearfix" style="<?php printf( $style_title ); ?>" >
					<h5 class="df-shortcode-blocks-title" style="color:<?php echo esc_attr( $title_text_color );?> ;">
						<?php 
						if( $show_title == 'yes' ){
							printf ( $title_url != '' ) ? '<a href="'.esc_url( $title_url ).'" >' : '';
								echo $title;
							printf ( $title_url != '' ) ? '</a>' : '';
						}
						?>
					</h5>
					<?php 
					$ids_unique = $array_ids;
					if( $source == 'by-category' ){
						$list_cats = explode( ",", $categories );
						if( $show_title == 'yes' ){
							if( sizeof( $list_cats ) > 1 ){
								?>
								<ul class="list-inline df-category-list df-no-margin block-tab-cats">
									<li class="active">
										<p>
											<a id="block-list-<?php printf( $ids_unique[0] ); ?>" class="first-lvl shortcode-disable-pagination" 
												data-target="#all-<?php printf( $ids_unique[0] );?>"
												data-sortorder="<?php printf( $sort_order );?>"
												data-column="<?php printf( $column_used );?>"
												data-id="<?php printf( $ids_unique[0] );?>" 
												data-block="<?php printf( $block_type ) ;?>" 
												data-source="<?php printf( $source );?>" 
												data-sourceparams="<?php printf( $categories );?>" 
												data-totalpages="<?php printf( $total_pages );?>" 
												data-current="<?php printf( $current_page );?>" 
												data-postsperpage="<?php printf( $posts_per_page );?>" 
												data-postidpage="<?php printf( $post_id_page );?>"
												data-pagetemplate="<?php printf( $page_template );?>" 
												data-paginationstatus="<?php printf( $pagination_status );?>" >
											<?php echo __( 'All', 'onfleek' );?>
											</a>
										</p>
									</li>
									<?php 
									$counter = 1;
									foreach( $list_cats as $cat_id ) {
										if( $counter <= $this->df_get_tab_show( $column ) ){ ?>
											<li>
												<p>
													<a id="block-list-<?php printf( $ids_unique[$counter] );?>"  class="first-lvl"
														data-target="#<?php echo esc_attr( $this->filtering_category( get_category( $cat_id )->name ) ) ;?>-<?php printf( $ids_unique[$counter] );?>"
														data-sortorder="<?php printf( $sort_order );?>"
														data-column="<?php printf( $column_used );?>"
														data-id="<?php printf( $ids_unique[$counter] );?>" 
														data-block="<?php printf( $block_type ) ;?>" 
														data-source="<?php printf( $source );?>" 
														data-sourceparams="<?php printf( $cat_id );?>" 
														data-totalpages="<?php printf( $total_pages );?>" 
														data-current="<?php printf( $current_page );?>" 
														data-postsperpage="<?php printf( $posts_per_page );?>" 
														data-postidpage="<?php printf( $post_id_page );?>"
														data-pagetemplate="<?php printf( $page_template );?>" 
														data-paginationstatus="<?php printf( $pagination_status );?>" >
													<?php
														$cat = get_category( $cat_id )->name;
														echo $cat;
													?>
													</a>
												</p>
											</li>
										<?php
										}else{
											if( $counter == $this->df_get_tab_more( $column ) ){
												echo '<li class="dropdown">';
													echo '<p>more<span class="ion-ios-arrow-down"></span></p>';
														echo '<ul class="dropdown-menu dropdown-menu-right df-dropdown-category df-no-margin">';
											} ?>
											<li>
												<a id="block-list-<?php printf( $ids_unique[$counter] );?>" class="second-lvl"
													data-target="#<?php echo esc_attr( $this->filtering_category( get_category( $cat_id )->name ) ) ;?>-<?php printf( $ids_unique[$counter] );?>"
													data-sortorder="<?php printf( $sort_order );?>"
													data-column="<?php printf( $column_used );?>"
													data-id="<?php printf( $ids_unique[$counter] );?>" 
													data-block="<?php printf( $block_type ) ;?>" 
													data-source="<?php printf( $source );?>" 
													data-sourceparams="<?php printf( $cat_id );?>" 
													data-totalpages="<?php printf( $total_pages );?>" 
													data-current="<?php printf( $current_page );?>" 
													data-postsperpage="<?php printf( $posts_per_page );?>" 
													data-postidpage="<?php printf( $post_id_page );?>"
													data-pagetemplate="<?php printf( $page_template );?>" 
													data-paginationstatus="<?php printf( $pagination_status );?>" >
													<?php
														$cat = get_category( $cat_id )->name;
														echo $cat;
													?>
												</a>
											</li>
										<?php
											if( $counter == sizeof( $list_cats) ){
														echo '</ul>';
												echo '</li>';
											}
										}
										$counter++;	
									} ?>
								</ul>
							<?php
							}else{
							?>
								<ul class="list-inline df-category-list df-no-margin block-tab-cats">
									<li class="active">
										<p><a data-target="#all-<?php printf( $ids_unique[0] );?>" ></a></p>
									</li>
									<?php 
									$counter = 1;
									foreach ($list_cats as $cat_id ) { ?>
										<li>
											<p>
												<a data-target="#<?php echo esc_attr( $this->filtering_category( get_category( $cat_id )->name ) ) ;?>-<?php printf( $ids_unique[$counter] );?>"></a>
											</p>
										</li>
									<?php
										$counter++;	
									} ?>
								</ul>
							<?php
							}
						}else{
							?>
								<ul class="list-inline df-category-list df-no-margin block-tab-cats" style="height: 0px;">
									<li class="active">
										<p><a data-target="#all-<?php printf( $ids_unique[0] );?>"></a></p>
									</li>
								</ul>
							<?php
						}
					}else{
					?>
						<ul class="list-inline df-category-list df-no-margin block-tab-cats" style="height: 0px;">
							<li class="active">
								<p><a data-target="#all-<?php printf( $ids_unique[0] );?>"></a></p>
							</li>
						</ul>
					<?php
					}
					?>
				</div>
			</div>
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * generate_uniqid
		 * generate unique id using uniqid() function
		 */
		private function generate_uniqid(){
			$unique = uniqid( '', true );
			$id = explode( ".",  $unique );
			return $id[0].$id[1];
		}

		/**
		 * tabs_unique_id
		 * generate unique id for every tabs & content tabs
		 */
		private function tabs_unique_id( $cats_count ){
			$count = ( $cats_count == 0 ) ? 1 : $cats_count;
			$array_ids = array();
			if( $count > 1 ){
				for( $i = 1; $i <= $count; $i++ ){
					$uniqid = $this->generate_uniqid();
					array_push( $array_ids, $uniqid );
				}
			}else{
				$uniqid = $this->generate_uniqid();
				array_push( $array_ids, $uniqid );
			}
			return $array_ids;
		}

		/**
		 * df_get_tab_show
		 */
		private function df_get_tab_show( $col ){
			$tab_show = 4;
			switch ($col) {
				case '1':
					$tab_show = 0;
					break;
				case '2':
					$tab_show = 2;
					break;
				case '3':
					$tab_show = 4;
					break;
			}	
			if ( DF_Framework::df_is_mobile() ) {
				$tab_show = 0;
			}
			return $tab_show;
		}

		/**
		 * df_get_tab_more
		 */
		private function df_get_tab_more( $col ){
			$tab_more = 5;
			switch ($col) {
				case '1':
					$tab_more = 1;
					break;
				case '2': 
					$tab_more = 3;
					break;
				case '3': 
					$tab_more = 5;
					break;
			}
			if ( DF_Framework::df_is_mobile() ) {
				$tab_more = 1;
			}
			return $tab_more;
		}

		/**
		 * df_get_posts_tab_counter
		 */
		private function df_get_posts_tab_counter( $source, $show_title, $categories ){
			return ( ( $source !== 'by-category' ) || ( $source === 'by-category' && $show_title === 'no' ) ) ? 1 : sizeof( explode(",", $categories) )+1;
		}

		/**
		 * page_template_status
		 * get status of page template
		 * @param $page
		 * @return $page_template boolean true | false
		 */
		private function df_page_template_status( $page ){
			if( is_page_template( $page ) ){
				$page_template = 'true';
			}else{
				$page_template = 'false';
			}
			return $page_template;
		}

		/**
		 * df_posts_block_1
		 * render shortcode output to frontend for posts block 1
		 */
		function df_posts_block_1( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_1', $atts );
			extract( $atts ); // extract attributes from vc block
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' ); // page template used ( true : pagebuilder+archive)

			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );
			// set parameters for render title block
			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_1',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);		
			ob_start();
			?>
			<div class="df-shortcode-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
					<?php
					for( $i = 1; $i <= $posts_tab_counter; $i++ ){
						$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
						$atts = wp_parse_args(
								array(
									'posts_per_page' 	=> $posts_per_page,
									'categories'		=> $cat_param,
									'paged'				=> $paged
								)
							, $atts );
						if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
						}
						$totalpost = '';
						$totalpages = '';

						if( $i == 1 ){
							$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
							$posts = &self::$query_block->query_new_posts( $args );

							$totalpost = $posts->found_posts;
							$totalpages = $posts->max_num_pages;
						}
						$pagination = '';
						$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': '';

						$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
						$tab_pane_active = ( $i==1 ) ? 'active' : '';

						?>
						<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr($tab_pane_active).' '.esc_attr( $pagination ).' '.esc_attr( ($source != 'by-category') ? 'no-hide':'' ); ?> block-tab-pane  wraper-content-block clearfix">
							<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?>">
								<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<?php
								if( $i == 1 ){
									if( $posts->have_posts() ){
										$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
										$params_block = array(
											'sidebar' => '',
											'block_id' => $array_ids[0],
											'column' => $col,
											'block_type' => 'df_block_1',
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
										echo $block_render->df_render_block_1( $posts, $params_block );
									}
								}
								?>
								</div>
								<?php							
								echo $block_render->pagination_block(); 
								?>
							</div>
						</div>
						<?php
						wp_reset_query();
						wp_reset_postdata();
					} // endfor
					?>
				</div><!-- end block-tab-content -->
			</div><!-- end of df-shortcode-blocks-->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_2
		 * render shortcode output to frontend for posts block 2
		 */
		function df_posts_block_2( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_2', $atts );
			extract($atts);
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : ''; 
			$posts_per_page = $limit_post_number;

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' ); // page template used ( true : pagebuilder+archive)

			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_2',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
					<?php
					for($i = 1; $i <= $posts_tab_counter ; $i++ ) {
						$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
						$atts = wp_parse_args(
								array(
									'posts_per_page' 	=> $posts_per_page,
									'categories'		=> $cat_param,
									'paged' 			=> $paged
								)
							, $atts );
						if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
						}
						$totalpost = '';
						$totalpages = '';

						if( $i == 1 ){
							$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
							$posts = &self::$query_block->query_new_posts( $args );

							$totalpost = $posts->found_posts;
							$totalpages = $posts->max_num_pages;
						}
						
						$pagination = '';
						$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': '';

						$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
						$tab_pane_active = ( $i==1 ) ? 'active' : '';
						?>
							<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ) .' '. esc_attr( $pagination ); ?> block-tab-pane wraper-content-block clearfix ">
								<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
									<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
									<?php
									if( $i == 1 ){
										if( $posts->have_posts() ){
											$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
											$params_block = array(
												'sidebar' => '',
												'block_id' => $array_ids[0],
												'column' => $col,
												'block_type' => 'df_block_2',
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
											echo $block_render->df_render_block_2( $posts, $params_block );
										}
									}
									
									?>
									</div>
									<?php echo $block_render->pagination_block( ); ?>
								</div>
							</div>
						<?php
						wp_reset_query();
						wp_reset_postdata();
					} // endfor
					?>
				</div><!-- end block-tab-content -->
			</div><!-- end of df-shortcode-blocks-->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_3
		 * render shortcode output to frontend for posts block 3
		 */
		function df_posts_block_3( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_3', $atts );
			extract( $atts );
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' ); // page template used ( true : pagebuilder+archive)

			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );
			
			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_3',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title );?>
				<div class="block-tab-content clearfix">
					<?php
					for( $i=1; $i <= $posts_tab_counter ; $i++){
						$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
						$atts = wp_parse_args(
							array(
							'posts_per_page' 	=> $posts_per_page,
							'categories'		=> $cat_param,
							'paged'				=> $paged
							)
						, $atts );
						if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
						}
						$totalpost = '';
						$totalpages = '';

						if( $i == 1 ){
							$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
							$posts = &self::$query_block->query_new_posts( $args );
							$totalpost = $posts->found_posts;
							$totalpages = $posts->max_num_pages;
						}
						
						$pagination = '';
						$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

						$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
						$tab_pane_active = ( $i==1 ) ? 'active' : '';
					
						?>
						<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr($tab_pane_active).' '.esc_attr( $pagination ) ;?> block-tab-pane wraper-content-block clearfix ">
							<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<?php 
								if( $i == 1 ){
									if( $posts->have_posts() ){
										$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
										$params_block = array(
											'sidebar' => '',
											'block_id' => $array_ids[0],
											'column' => $col,
											'block_type' => 'df_block_3',
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
										echo $block_render->df_render_block_3( $posts, $params_block );
									}
								}
								?>
								</div>
								<?php echo $block_render->pagination_block( ); ?>
							</div>
						</div>
					<?php
						wp_reset_query();
						wp_reset_postdata();
					} // endfor
					?>
				</div><!-- end of block tab content -->
			</div><!-- end of shortcode blocks -->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_4
		 * render shortcode output to frontend for posts block 4
		 */
		function df_posts_block_4( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_4', $atts );
			extract($atts);
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' ); // page template used ( true : pagebuilder+archive)

			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_4',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
					<?php
					for( $i=1; $i <= $posts_tab_counter; $i++ ){

						$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
						$atts = wp_parse_args(
								array(
									'posts_per_page' 	=> $posts_per_page,
									'categories'		=> $cat_param,
									'paged' 			=> $paged
								)
							, $atts );
						if( $pagination_status === 'pagination-disable' ){
								$atts = wp_parse_args(
									array(
										'no_found_rows' => true
									)
								, $atts );
							}

						$totalpost = '';
						$totalpages = '';

						if( $i == 1 ){
							$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
							$posts = &self::$query_block->query_new_posts( $args );
							$totalpost = $posts->found_posts;
							$totalpages = $posts->max_num_pages;
						}
						
						$pagination = '';
						$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

						$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
						$tab_pane_active = ( $i==1 ) ? 'active' : '';
						?>
							<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination );?> block-tab-pane wraper-content-block clearfix ">
								<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
									<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
									<?php 
									if( $i == 1 ){
										if( $posts->have_posts() ) { 
											$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
											$params_block = array(
												'sidebar' => '',
												'block_id' => $array_ids[0],
												'column' => $col,
												'block_type' => 'df_block_4',
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
											echo $block_render->df_render_block_4( $posts, $params_block );
										}
									}
									?>
									</div>
									<?php echo $block_render->pagination_block( ); ?>
								</div>
							</div>
					<?php
						wp_reset_query();
						wp_reset_postdata();
					} //endfor
					?>
				</div><!-- end block-tab-content -->
			</div><!-- end df-shortcode-blocks -->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_5
		 * render shortcode output to frontend for posts block 5
		 */
		function df_posts_block_5( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_5', $atts );
			extract($atts);

			$title_text_color = ( isset( $title_text_color ) ) ? $title_text_color : ''; 
			$posts_per_page =  $limit_post_number;
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' ); // page template used ( true : pagebuilder+archive)

			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );
			
			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_5',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks style-5 main-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
					<?php
					for( $i = 1; $i <= $posts_tab_counter; $i++ ){
						$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
						$atts = wp_parse_args(
								array(
									'posts_per_page' 	=> $posts_per_page,
									'categories'		=> $cat_param,
									'paged' 			=> $paged
								)
							, $atts );
						if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
						}
						$totalpost = '';
						$totalpages = '';

						if( $i == 1 ){
							$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
							$posts = &self::$query_block->query_new_posts( $args );
							$totalpost = $posts->found_posts;
							$totalpages = $posts->max_num_pages;
						}
						
						$pagination = '';
						$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

						$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
						$tab_pane_active = ( $i==1 ) ? 'active' : '';
						
						?>
						<div id="<?php echo esc_attr( $div_id_tab_pane ); ?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination ) ;?> block-tab-pane wraper-content-block clearfix ">
							<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">	
								<?php 
								if( $i == 1 ){
									if( $posts->have_posts() ) { 
										$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
										$params_block = array(
											'sidebar' => '',
											'block_id' => $array_ids[0],
											'column' => $col,
											'block_type' => 'df_block_5',
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
										echo $block_render->df_render_block_5( $posts, $params_block );
									}
								}
								?>
								</div>
								<?php echo $block_render->pagination_block( ); ?>
							</div>
						</div>
					<?php
						wp_reset_query();
						wp_reset_postdata();
					} // endfor
					?>
				</div><!-- end of block tab content --> 
			</div><!-- end of shortcode block -->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_6
		 * render shortcode output to frontend for posts block 6
		 */
		function df_posts_block_6( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_6', $atts );
			extract($atts);

			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' ); // page template used ( true : pagebuilder+archive)

			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_6',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks style-6 main-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
				<?php
				for($i = 1; $i <= $posts_tab_counter; $i++ ) {

					$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
					$atts = wp_parse_args(
							array(
								'posts_per_page' 	=> $posts_per_page,
								'categories'		=> $cat_param,
								'paged' 			=> $paged
							)
						, $atts );
					if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
						}
					$totalpost = '';
					$totalpages = '';

					if( $i == 1 ){
						$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
						$posts = &self::$query_block->query_new_posts( $args );

						$totalpost = $posts->found_posts;
						$totalpages = $posts->max_num_pages;
					}
					
					$pagination = '';
					$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

					$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
					$tab_pane_active = ( $i==1 ) ? 'active' : '';
					?>
					<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination ) ;?> block-tab-pane wraper-content-block clearfix ">
						<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
							<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
							<?php
								if( $i == 1 ){
									if( $posts->have_posts() ) { 
										$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
										$params_block = array(
											'sidebar' => '',
											'block_id' => $array_ids[0],
											'column' => $col,
											'block_type' => 'df_block_6',
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
										echo $block_render->df_render_block_6( $posts, $params_block );
									}
								}
							?>
							</div>
							<?php echo $block_render->pagination_block( ); ?>
						</div>
					</div>
					<?php
					wp_reset_query();
					wp_reset_postdata();
				} // endfor
				?>
				</div> <!-- end of block-tab-content -->
			</div><!-- end of df-shortcode-blocks -->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_7
		 * render shortcode output to frontend for posts block 7
		 */
		function df_posts_block_7( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_7', $atts );
			extract($atts);
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : ''; 
			$posts_per_page = $limit_post_number;
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );
			
			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_7',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks style-7 main-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
					<?php
					for($i = 1; $i <= $posts_tab_counter; $i++ ) {
						$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
						$atts = wp_parse_args(
								array(
									'posts_per_page' 	=> $posts_per_page,
									'categories'		=> $cat_param,
									'paged' 			=> $paged
								)
							, $atts );
						if( $pagination_status === 'pagination-disable' ){
								$atts = wp_parse_args(
									array(
										'no_found_rows' => true
									)
								, $atts );
							}
						$totalpost = '';
						$totalpages = '';

						if( $i == 1 ){
							$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
							$posts = &self::$query_block->query_new_posts( $args );

							$totalpost = $posts->found_posts;
							$totalpages = $posts->max_num_pages;
						}
						$pagination = '';
						$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

						$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
						$tab_pane_active = ( $i==1 ) ? 'active' : '';
						?>
						<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination );?> block-tab-pane wraper-content-block clearfix ">
							<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<?php 
									if( $i == 1 ){
										if( $posts->have_posts() ){
											$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
											$params_block = array(
												'sidebar' => '',
												'block_id' => $array_ids[0],
												'column' => $col,
												'block_type' => 'df_block_7',
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
											echo $block_render->df_render_block_7( $posts, $params_block );
										}
									}
								?>
								</div>
								<?php echo $block_render->pagination_block();?>
							</div>
						</div>
						<?php
						wp_reset_query();
						wp_reset_postdata();
					} // endfor
					?>
				</div><!-- end of block-tab-content --> 
			</div><!-- end of df-shortcode-blocks -->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_8
		 * render shortcode output to frontend for posts block 8
		 */
		function df_posts_block_8( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_8', $atts );
			extract($atts);

			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' ); // page template used ( true : pagebuilder+archive)
			
			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_8',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks style-8 main-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
					<?php
					for( $i = 1; $i <= $posts_tab_counter; $i++ ){
						$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
						$atts = wp_parse_args(
								array(
									'posts_per_page' 	=> $posts_per_page,
									'categories'		=> $cat_param,
									'paged' 			=> $paged
								)
							, $atts );
						if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
						}
						$totalpost = '';
						$totalpages = '';

						if( $i == 1 ){
							$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
							$posts = &self::$query_block->query_new_posts( $args );

							$totalpost = $posts->found_posts;
							$totalpages = $posts->max_num_pages;
						}
						$pagination = '';
						$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

						$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
						$tab_pane_active = ( $i==1 ) ? 'active' : '';
						?>
						<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination );?> col-md-12 block-tab-pane shortcode8 wraper-content-block clearfix ">
							<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<?php 
								if( $i == 1 ){
									if( $posts->have_posts() ) {
										$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
										$params_block = array(
											'sidebar' => '',
											'block_id' => $array_ids[0],
											'column' => $col,
											'block_type' => 'df_block_8',
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
										echo $block_render->df_render_block_8( $posts, $params_block );
									}	
								}
								?>
								</div>
								<?php echo $block_render->pagination_block( ); ?>
							</div>
						</div>
					<?php
						wp_reset_query();
						wp_reset_postdata();
					} // endfor
					?>
				</div><!-- end of block-tab-content -->
			</div><!-- end of df-shortcode-blocks --> 
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_9
		 * render shortcode output to frontend for posts block 9
		 */
		function df_posts_block_9( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_9', $atts );
			extract($atts);
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' ); // page template used ( true : pagebuilder+archive)

			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_9',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
				<?php
				for( $i = 1; $i <= $posts_tab_counter; $i++ ){
					$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
					$atts = wp_parse_args(
							array(
								'posts_per_page' 	=> $posts_per_page,
								'categories'		=> $cat_param,
								'paged' 			=> $paged
							)
						, $atts );
					if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
					}
					$totalpost = '';
					$totalpages = '';

					if( $i == 1 ){
						$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
						$posts = &self::$query_block->query_new_posts( $args );

						$totalpost = $posts->found_posts;
						$totalpages = $posts->max_num_pages;
					}
					$pagination = '';
					$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

					$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
					$tab_pane_active = ( $i==1 ) ? 'active' : '';
					?>
					<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination ) ;?> block-tab-pane wraper-content-block clearfix ">
						<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
							<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
							<?php 
							if( $i == 1 ){
								if( $posts->have_posts() ) {
									$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
									$params_block = array(
										'sidebar' => '',
										'block_id' => $array_ids[0],
										'column' => $col,
										'block_type' => 'df_block_9',
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
									echo $block_render->df_render_block_9( $posts, $params_block );
								}
							}
							?>
							</div>
							<?php echo $block_render->pagination_block( ); ?>
						</div>
					</div>
					<?php
					wp_reset_query();
					wp_reset_postdata();
				} // endfor
				?>
				</div><!-- end block-tab-content -->
			</div><!-- end df-shortcode-block --> 
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_10
		 * render shortcode output to frontend for posts block 10
		 */
		function df_posts_block_10( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_1', $atts );
			extract( $atts );
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' ); // page template used ( true : pagebuilder+archive)

			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_10',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
					<?php
					for( $i=1; $i <= $posts_tab_counter; $i++ ){
						$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
						$atts = wp_parse_args(
								array(
									'posts_per_page' 	=> $posts_per_page,
									'categories'		=> $cat_param,
									'paged' 			=> $paged
								)
							, $atts );
						if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
						}
						$totalpost = '';
						$totalpages = '';

						if( $i == 1 ){
							$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
							$posts = &self::$query_block->query_new_posts( $args );

							$totalpost = $posts->found_posts;
							$totalpages = $posts->max_num_pages;
						}
						$pagination = '';
						$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

						$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
						$tab_pane_active = ( $i==1 ) ? 'active' : '';
						?>
						<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination ) .' '.esc_attr( ($source != 'by-category') ? 'no-hide':'' ) ; ?> block-tab-pane  wraper-content-block clearfix">
							<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<?php
									if( $i == 1 ){
										if( $posts->have_posts() ){
											$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
											$params_block = array(
												'sidebar' => '',
												'block_id' => $array_ids[0],
												'column' => $col,
												'block_type' => 'df_block_10',
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
											echo $block_render->df_render_block_10( $posts, $params_block );
										}
									}
								?>
								</div>
								<?php echo $block_render->pagination_block( );?>
							</div>
						</div>
						<?php
						wp_reset_query();
						wp_reset_postdata();
					}//endfor
					?>
				</div><!-- end block-tab-content -->
			</div><!-- end of df-shortcode-blocks-->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_11
		 * render shortcode output to frontend for posts block 11
		 */
		function df_posts_block_11( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_11', $atts );
			extract($atts);
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );
			
			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_11',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks style-11 clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">			
					<?php
					
					for( $i = 1; $i <= $posts_tab_counter; $i++ ){
						$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
						$atts = wp_parse_args(
								array(
									'posts_per_page' 	=> $posts_per_page,
									'categories'		=> $cat_param,
									'paged' 			=> $paged,
								)
							, $atts );
						if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
						}
						$totalpost = '';
						$totalpages = '';

						if( $i == 1 ){
							$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
							$posts = &self::$query_block->query_new_posts( $args );

							$totalpost = $posts->found_posts;
							$totalpages = $posts->max_num_pages;
						}
						$pagination = '';
						$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

						$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
						$tab_pane_active = ( $i==1 ) ? 'active' : '';
						//print_r( $posts->posts[$i]->ID );
						
						?>
							<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination );?> block-tab-pane wraper-content-block clearfix ">
								<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
									<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
									<?php 
									if( $i == 1 ){
										if( $posts->have_posts() ) {

											$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
											$params_block = array(
												'sidebar' => '',
												'block_id' => $array_ids[0],
												'column' => $col,
												'block_type' => 'df_block_11',
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
											echo $block_render->df_render_block_11( $posts, $params_block );
										}
									}
									?>
									</div>
									<?php echo $block_render->pagination_block( ); ?>
								</div>
							</div>
						<?php
						wp_reset_query();
						wp_reset_postdata();
					} // endfor
					?>
				</div><!-- end of block-tab-content -->
			</div><!-- end of df-shortcode-blocks -->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_12
		 * render shortcode output to frontend for posts block 12
		 */
		function df_posts_block_12( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_12', $atts );
			extract($atts);
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );
			
			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_12',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);	
			ob_start();
			?>
			<div class="df-shortcode-blocks clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
				<?php
				for( $i = 1; $i <= $posts_tab_counter; $i++ ){
					$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
					$atts = wp_parse_args(
							array(
								'posts_per_page' 	=> $posts_per_page,
								'categories'		=> $cat_param,
								'paged' 			=> $paged
							)
						, $atts );
					if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
					}
					$totalpost = '';
					$totalpages = '';

					if( $i == 1 ){
						$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
						$posts = &self::$query_block->query_new_posts( $args );

						$totalpost = $posts->found_posts;
						$totalpages = $posts->max_num_pages;
					}
					$pagination = '';
					$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

					$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
					$tab_pane_active = ( $i==1 ) ? 'active' : '';
					?>
						<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination );?> block-tab-pane wraper-content-block clearfix ">
							<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
								<?php
								if( $i == 1 ){
									if( $posts->have_posts() ) {
										$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
										$params_block = array(
											'sidebar' => '',
											'block_id' => $array_ids[0],
											'column' => $col,
											'block_type' => 'df_block_12',
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
										echo $block_render->df_render_block_12( $posts, $params_block );
									}
								} 
								?>
								</div>
								<?php echo $block_render->pagination_block( ); ?>
							</div>
						</div>
					<?php
					wp_reset_query();
					wp_reset_postdata();
				} // endfor
				?>
				</div> <!-- end of block-tab-content -->
			</div><!-- end of df-shortcode-blocks-->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_13
		 * render shortcode output to frontend for posts block 13
		 */
		function df_posts_block_13( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$block_module = new DF_Block_Module_Post();
			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_13', $atts );
			extract($atts);
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			$posts_per_page = $limit_post_number;

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );
			
			$posts_tab_counter = $this->df_get_posts_tab_counter( $source, $show_title, $categories );
			$cat = explode(",", $categories);
			$atts['categories'] = '';
			$paged = 1;
			$array_ids = $this->tabs_unique_id( $posts_tab_counter );

			$params_title = array(
				'title' 	=> $title,
				'title_url' => $title_url,
				'title_text_color' => $title_text_color,
				'show_title' => $show_title,
				'array_ids' => $array_ids,
				'block_type' => 'df_block_13',
				'column' 	=> $block_module->df_get_column( $post_id_page, $col, $page_template ),
				'column_used' => $col,
				'source' => $source, 
				'categories' => $categories,
				'sort_order' => $sort_order,
				'posts_per_page' => $posts_per_page,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'total_pages' => '',
				'current_page' => $paged,
				'pagination_status' => $pagination_status
			);		
			ob_start();
			?>
			<div class="df-shortcode-blocks style-13 clearfix">
				<?php echo $this->df_render_block_title( $params_title ); ?>
				<div class="block-tab-content clearfix">
				<?php
				for( $i = 1; $i <= $posts_tab_counter; $i++ ){
					$cat_param = ( $i==1 ) ? $categories : $cat[$i-2];
					$atts = wp_parse_args(
							array(
								'posts_per_page' 	=> $posts_per_page,
								'categories'		=> $cat_param,
								'paged' 			=> $paged
							)
						, $atts );
					if( $pagination_status === 'pagination-disable' ){
							$atts = wp_parse_args(
								array(
									'no_found_rows' => true
								)
							, $atts );
					}
					$totalpost = '';
					$totalpages = '';

					if( $i == 1 ){
						$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
						$posts = &self::$query_block->query_new_posts( $args );

						$totalpost = $posts->found_posts;
						$totalpages = $posts->max_num_pages;
					}
					$pagination = '';
					$pagination = ( ( $totalpost > $posts_per_page ) && ( $pagination_status === 'pagination-enable' ) ) ? 'df-pagination-yes': $pagination;

					$div_id_tab_pane = ( $i==1 ) ? 'all-'.$array_ids[0] : $this->filtering_category( get_category( $cat[$i-2] )->name .'-'. $array_ids[$i-1] );
					$tab_pane_active = ( $i==1 ) ? 'active' : '';
					?>
					<div id="<?php echo esc_attr( $div_id_tab_pane );?>" class="<?php echo esc_attr( $tab_pane_active ).' '.esc_attr( $pagination );?> block-tab-pane wraper-content-block clearfix ">
						<div class="<?php printf( $block_render->div_wrapper_unique_class( $array_ids[$i-1] ) );?> clearfix">
							<div class="<?php printf( $block_render->div_unique_class( $array_ids[$i-1] ) );?> clearfix">
							<?php 
								if( $i == 1 ){
									if( $posts->have_posts() ) {
										$source_params = ( $i == 1 ) ? self::$query_block->get_source_param() : $cat[$i-2];
										$params_block = array(
											'sidebar' => '',
											'block_id' => $array_ids[0],
											'column' => $col,
											'block_type' => 'df_block_13',
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
										echo $block_render->df_render_block_13( $posts, $params_block );
									}
								}
							?>
							</div>
							<?php echo $block_render->pagination_block();?>
						</div>
					</div>
					<?php
					wp_reset_query();
					wp_reset_postdata();
				} // endfor
				?>
				</div><!-- end of block-tab-content -->
			</div><!-- end of df-shortcode-blocks -->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * df_posts_block_14
		 * render shortcode output to frontend for posts block 14
		 */
		function df_posts_block_14( $atts, $content = null ){
			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			$block_render = new DF_Render_Loop();

			$atts = vc_map_get_attributes( 'df_posts_block_14', $atts );
			extract($atts);

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			
			$atts = wp_parse_args(
				array(
					'paged' => $paged,
					'posts_per_page' => $posts_per_page,
					'no_found_rows' => true
				)
			, $atts );
			
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );

			$totalpost = $posts->found_posts;

			if( $show_title == 'no' ){
				$zero_bottom_border = 'zero-border';
			}
			
			$title_text_color = ( isset($title_text_color) ) ? $title_text_color : '';
			ob_start();
			?>
			<div class="df-shortcode-blocks style-14">
				<div class="col-md-12">
					<div class="df-shortcode-blocks-top clearfix <?php echo esc_attr( isset( $zero_bottom_border ) ? $zero_bottom_border : '' );?>">
						<?php if( $show_title === 'yes' ): ?>
							<div class="df-shortcode-blocks-title">
								<h5 style="color:<?php echo esc_attr( $title_text_color );?> ;">
									<?php 
									echo ( $title_url != '' ) ? '<a href="'.esc_url( $title_url ).'" >' : '';
									echo $title;
									echo ( $title_url != '' ) ? '</a>' : '';
									?>
								</h5>
							</div>
						<?php endif;?>
						<ul class="df-category-slider-btn list-inline pull-right">
							<li class="custom-prev-arrow"><span class="ion-chevron-left"></span></li>
							<li class="custom-next-arrow"><span class="ion-chevron-right"></span></li>
						</ul>
					</div>
				</div>
			<?php
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template
							);
				echo $block_render->df_render_block_14( $posts, $params_block );
			}
			?>
			</div><!-- end of df-shortcode-blocks-->
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_news_ticker
		 *render shortcode news ticker output to frontend
		*/
		function df_news_ticker( $atts, $content = null ){
			if( is_page_template( 'page-pagebuilder-witharchive.php' ) ){
				$page_template = 'true';
			}else{
				$page_template = 'false';
			}

			global $post;
			$post_id_page = $post->ID;
			global $df_column_block;
			$col = $df_column_block;

			$atts = vc_map_get_attributes( 'df_news_ticker', $atts );
			
			extract($atts);
			
			$block_render = new DF_Render_Loop();
			ob_start();
			$paged = 1;
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $limit_post_number,
							'no_found_rows' => true,
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );

			if( $posts->have_posts() ){
				
			?>
			<div class="df-trending">
				<div class="df-trending-inner">
					<div class="df-trending-title <?php echo esc_attr($style); ?>" style="background: <?php echo esc_attr( $title_background_color )?>">
						<h5 style="color: <?php echo esc_attr($title_text_color)?>"><?php echo esc_attr($title_news_ticker)?></h5>
					</div>
					<div class="df-trending-display-area">
						<div id="slides">
							<ul id="slide-wrap" class="<?php printf($navigation);?>">
						<?php
							$params_block = array(
											'sidebar' => '',
											'column' => $col,
											'posts_per_page' => $limit_post_number, 
											'post_id_page' => $post_id_page,
											'page_template' => $page_template,
											'title_text_color' => $title_text_color,
											'post_title_text_color' => $post_title_text_color,
										);
							echo $block_render->df_render_news_ticker( $posts, $params_block );
						?>
							</ul>
						</div>
					</div>
					<div class="df-next-prev-wrap">
						<div id="buttons">
							<a href="#" return="false" style="color:<?php echo esc_attr($post_title_text_color)?>"><i class="ion-chevron-left prev-news"></i></a>
							<a href="#" return="false" style="color:<?php echo esc_attr($post_title_text_color)?>"><i class="ion-chevron-right next-news"></i></a>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_grid_1
		 *render shortcode grid 1 output to frontend
		*/
		function df_posts_grid_1( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_grid_1', $atts );
			extract($atts);
			$use_bullet = $show_bullet;
			$block_render = new DF_Render_Loop();
			
			$uniqid = $this->generate_uniqid();
			// global $page_template;
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );

			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'block_id' => $uniqid
							);
				echo $block_render->df_render_grid_1( $posts, $params_block, $use_bullet );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_grid_2
		 *render shortcode grid 2 output to frontend
		*/
		function df_posts_grid_2( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_grid_2', $atts );
			extract($atts);
			$use_bullet = $show_bullet;
			$block_render = new DF_Render_Loop();
			
			$uniqid = $this->generate_uniqid();

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );
			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'block_id' => $uniqid
							);
				echo $block_render->df_render_grid_2( $posts, $params_block, $use_bullet );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_grid_3
		 *render shortcode grid 3 output to frontend
		*/
		function df_posts_grid_3( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_grid_3', $atts );
			extract($atts);
			$use_bullet = $show_bullet;
			$block_render = new DF_Render_Loop();
			
			$uniqid = $this->generate_uniqid();

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );
			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'block_id' => $uniqid
							);
				echo $block_render->df_render_grid_3( $posts, $params_block, $use_bullet ) ;
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_grid_4
		 *render shortcode grid 4 output to frontend
		*/
		function df_posts_grid_4( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_grid_4', $atts );
			extract($atts);
			$use_bullet = $show_bullet;
			$block_render = new DF_Render_Loop();
			
			$uniqid = $this->generate_uniqid();

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );

			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'block_id' => $uniqid
							);
				echo $block_render->df_render_grid_4( $posts, $params_block, $use_bullet );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_carousel_1
		 *render shortcode carousel 1 output to frontend
		*/
		function df_posts_carousel_1( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_carousel_1', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );

			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'auto_play' => isset( $auto_play ) ? $auto_play : false,
								'auto_play_speed' =>isset( $auto_play_speed ) ? $auto_play_speed : 5000
							);
				echo $block_render->df_render_carousel_1( $posts, $params_block );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_carousel_2
		 *render shortcode carousel 2 output to frontend
		*/
		function df_posts_carousel_2( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_carousel_2', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();
				
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );
			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'auto_play' => isset( $auto_play ) ? $auto_play : false,
								'auto_play_speed' =>isset( $auto_play_speed ) ? $auto_play_speed : 5000
							);
				echo $block_render->df_render_carousel_2( $posts, $params_block );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_carousel_3
		 *render shortcode carousel 3 output to frontend
		*/
		function df_posts_carousel_3( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_carousel_3', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );
			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'auto_play' => isset( $auto_play ) ? $auto_play : false,
								'auto_play_speed' =>isset( $auto_play_speed ) ? $auto_play_speed : 5000
							);
				echo $block_render->df_render_carousel_3( $posts, $params_block );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/*
		 *df_posts_carousel_4
		 *render shortcode carousel 4 output to frontend
		*/
		function df_posts_carousel_4( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_carousel_4', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();

			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );
			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'auto_play' => isset( $auto_play ) ? $auto_play : false,
								'auto_play_speed' =>isset( $auto_play_speed ) ? $auto_play_speed : 5000
							);
				echo $block_render->df_render_carousel_4( $posts, $params_block );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_carousel_5
		 *render shortcode carousel 5 output to frontend
		*/
		function df_posts_carousel_5( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_carousel_5', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );
			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'auto_play' => isset( $auto_play ) ? $auto_play : false,
								'auto_play_speed' =>isset( $auto_play_speed ) ? $auto_play_speed : 5000
							);
				echo $block_render->df_render_carousel_5( $posts, $params_block );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_carousel_6
		 *render shortcode carousel 6 output to frontend
		*/
		function df_posts_carousel_6( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_carousel_6', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );
			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'auto_play' => isset( $auto_play ) ? $auto_play : false,
								'auto_play_speed' =>isset( $auto_play_speed ) ? $auto_play_speed : 5000
							);
				echo $block_render->df_render_carousel_6( $posts, $params_block );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_carousel_7
		 *render shortcode carousel 7 output to frontend
		*/
		function df_posts_carousel_7( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_carousel_7', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();
			
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );
			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'auto_play' => isset( $auto_play ) ? $auto_play : false,
								'auto_play_speed' =>isset( $auto_play_speed ) ? $auto_play_speed : 5000
							);
				echo $block_render->df_render_carousel_7( $posts, $params_block );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}

		/**
		 *df_posts_carousel_8
		 *render shortcode carousel 8 output to frontend
		*/
		function df_posts_carousel_8( $atts, $content = null ){
			$atts = vc_map_get_attributes( 'df_posts_carousel_8', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );

			global $post, $df_column_block;
			$post_id_page = $post->ID;
			$col = $df_column_block;

			$paged = 1;
			$posts_per_page = $limit_post_number;
			$sidebar = 'no';
			$atts = wp_parse_args(
						array(
							'paged' => $paged,
							'posts_per_page' => $posts_per_page,
							'no_found_rows' => true
						)
					, $atts );
			$args = self::$query_block->df_vc_atts_to_args( $atts, $sort_order );
			$posts = &self::$query_block->query_new_posts( $args );
			ob_start();
			if( $posts->have_posts() ){
				$params_block = array(
								'sidebar' => $sidebar,
								'column' => $col,
								'posts_per_page' => $posts_per_page, 
								'post_id_page' => $post_id_page,
								'page_template' => $page_template,
								'auto_play' => isset( $auto_play ) ? $auto_play : false,
								'auto_play_speed' =>isset( $auto_play_speed ) ? $auto_play_speed : 5000
							);
				echo $block_render->df_render_carousel_8( $posts, $params_block );
			}
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			wp_reset_query();
			wp_reset_postdata();
			return $out;
		}
		
		/*
		 *df_video_playlist
		 *render shortcode video playlist
		 */
		function df_youtube_playlist( $atts, $content = null ){
			global $post;
			$post_id_page = $post->ID;
			global $df_column_block;
			$col = $df_column_block;
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );
			
			$atts = vc_map_get_attributes( 'df_youtube_playlist', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();
			$block_module = new DF_Block_Module_Post();	

			$column_used = $block_module->df_get_column( $post_id_page, $col, $page_template );
			$class_used_vid = '';
			$class_used_list = '';
			switch ($column_used ) {
				case '3':
					$class_used_vid = 'col-md-8 df-video full no-padding';
					$class_used_list = 'col-md-4 df-video-list-wrap full no-padding';
					$class_used_list_inner = 'df-video-list full'; 
					break;
				case '2':
				case '1':
					$class_used_vid = 'col-md-12 no-padding';
					$class_used_list = 'col-md-12 no-padding';
					$class_used_list_inner = 'df-video-list small';
					break;
			}
			ob_start();
			?>
				<div class="df-video-playlist-wrap">
					<div class="<?php echo esc_attr($class_used_vid); ?>">
						<div class="df-video-embed">
							<!-- 16:9 aspect ratio -->
							<div class="embed-responsive embed-responsive-16by9">
							<?php 
							$vid = explode(",", $youtube_id);
							$video_link = 'https://www.youtube.com/embed/'.$vid[0].'?autoplay='.$video_auto;
							?>
								<iframe class="embed-responsive-item youtube" allowfullscreen="1" src="<?php printf($video_link)?>">
								</iframe>
							</div>
						</div>
					</div>
					<div class="<?php echo esc_attr($class_used_list); ?>">
						<div class="df-current-play youtube">
							<i class="ion-ios-play"></i>
							<h5><?php 
								$dv_result = self::getVideoInfo( str_replace( " ", "", $vid[0] ) );
								echo substr($dv_result['title'], 0, 70);
								?>
							</h5>
						</div>
						<div class="<?php printf($class_used_list_inner);?>">
						<?php 
						$lenghtvid = sizeof( $vid );
						for( $i = 0; $i < $lenghtvid; $i++ ){
						$video_info = self::getVideoInfo( str_replace( " ", "", $vid[$i] ) );
						$seconds = $video_info['length_seconds'];
						$thumbnail = $video_info['thumbnail_url'];
						$title_youtube = $video_info['title'];
						$title_counters = mb_strlen($title_youtube);
						$title_limit = substr($title_youtube, 0, 27);
						$dots = '';
						if($title_counters > 27){
							$dots = '...';
						}
							if($video_info != ''){ 
						?>

							<div class="df-video-list-inner" data-source="youtube" data-url="https://www.youtube.com/embed/<?php printf( str_replace( " ", "", $vid[$i] ) )?>?autoplay=<?php printf($video_auto)?>">
								<div class="df-video-thumbnail">
									<img src="<?php printf( $thumbnail );?>" alt="" class="img-responsive">
								</div>
								<div class="df-video-desc youtube">
									<h5 data-title="<?php printf( $title_youtube );?>"><?php printf($title_limit.$dots);?></h5>
									<p><?php echo gmdate('H:i:s', $seconds);?></p>
								</div>
							</div>
						<?php
							}
						}
						?>
						</div>
					</div>
				</div>
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 * getVideoInfo Youtube
		 */
		function getVideoInfo($vid) {
			$content = @file_get_contents("https://youtube.com/get_video_info?video_id=" . str_replace(" ", "", $vid) . "");
			parse_str($content, $ytarr);
			return $ytarr;
		}

		/**
		 *df_video_playlist
		 *render shortcode video playlist
		*/
		function df_vimeo_playlist( $atts, $content = null ){
			global $post;
			$post_id_page = $post->ID;
			global $df_column_block;
			$col = $df_column_block;
			$page_template = $this->df_page_template_status( 'page-pagebuilder-witharchive.php' );
			
			$atts = vc_map_get_attributes( 'df_vimeo_playlist', $atts );
			extract($atts);
			$block_render = new DF_Render_Loop();
			$block_module = new DF_Block_Module_Post();	

			$column_used = $block_module->df_get_column( $post_id_page, $col, $page_template );
			$class_used_vid = '';
			$class_used_list = '';
			switch ($column_used ) {
				case '3':
					$class_used_vid = 'col-md-8 df-video full no-padding';
					$class_used_list = 'col-md-4 df-video-list-wrap full no-padding';
					$class_used_list_inner = 'df-video-list full';
					break;
				case '2':
				case '1':
					$class_used_vid = 'col-md-12 no-padding';
					$class_used_list = 'col-md-12 no-padding';
					$class_used_list_inner = 'df-video-list small';
					break;
			}
			ob_start();
			?>
				<div class="df-video-playlist-wrap">
					<div class="<?php echo esc_attr($class_used_vid); ?>">
						<div class="df-video-embed">
							<!-- 16:9 aspect ratio -->
							<div class="embed-responsive embed-responsive-16by9">
							<?php 
							$vimeo_vid = explode(",", $vimeo_id);
							?>
								<iframe class="embed-responsive-item vimeo" allowfullscreen="1" src="https://player.vimeo.com/video/<?php echo ($vimeo_vid[0])?>?autoplay=<?php echo ($video_auto)?>"></iframe>
							</div>
						</div>
					</div>
					<div class="<?php echo esc_attr($class_used_list); ?>">
						<div class="df-current-play vimeo">
							<i class="ion-ios-play"></i>
							<h5>
								<?php
									$vi = unserialize(@file_get_contents("http://vimeo.com/api/v2/video/".str_replace( " ", "", $vimeo_vid[0] ).".php"));
								 	printf( substr($vi[0]['title'], 0, 70) )
							 	?>
						 	</h5>
						</div>
						<div class="<?php printf($class_used_list_inner);?>">
						<?php 
						$lenghtvid = sizeof( $vimeo_vid );
						for( $i = 0; $i < $lenghtvid; $i++ ){
						$vimeo = unserialize(@file_get_contents("http://vimeo.com/api/v2/video/".str_replace( " ", "", $vimeo_vid[$i] ).".php"));
						$large = $vimeo[0]['thumbnail_medium'];
						$title = $vimeo[0]['title'];
						$duration = $vimeo[0]['duration'];
						$title_counters = mb_strlen($title);
						$title_limit = substr($title, 0, 27);
						$dots = '';
						if($title_counters > 27){
							$dots = '...';
						}
							if($vimeo != ''){ 
							?>
								<div class="df-video-list-inner" data-source="vimeo" data-url="https://player.vimeo.com/video/<?php printf( str_replace( " ", "", $vimeo_vid[$i] ) )?>?autoplay=<?php printf($video_auto)?>">
									<div class="df-video-thumbnail vimeo">
										<img src="<?php echo esc_url( $large ) ?>" alt="" class="img-responsive">
									</div>
									<div class="df-video-desc vimeo">
										<h5 data-title="<?php printf($title)?>">
											<?php
												printf($title_limit.$dots);
											?>	
										</h5>
										<p><?php echo gmdate('H:i:s', $duration);?></p>
									</div>
								</div>
							<?php
							}
						}
						?>
						</div>
					</div>
				</div>
			<?php
			$out = ob_get_contents();
			if (ob_get_contents()) ob_end_clean();
			return $out;
		}

		/**
		 *df_dropcap
		 *render dropcap
		*/
		function df_dropcap( $atts, $content = null ) {
			$out = '';
			$out .='<blockquote id="df-dropcap"><p>'.$content.'</p></blockquote>';
			return $out;
		}
	}
}
/* file location: [theme directory]/inc/df-core/df-vc-extender/df-vc-extender-shortcode.php */