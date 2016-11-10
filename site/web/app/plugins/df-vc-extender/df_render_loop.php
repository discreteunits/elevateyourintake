<?php
/**
 * Class: DF_Render_Loop
 * Description: [description]
 */

if( !class_exists('DF_Render_Loop') ) {
	require_once( 'df_layout_block.php' );

	Class DF_Render_Loop {

		/**
		 * $array_data
		 */
		var $array_data = array();

		function set_array_data( $array ){
			extract( $array );
			$this->array_data = array( 
				'column' => $column,
				'block_id' => $block_id,
				'block_type' => $block_type,
				'source' => $source,
				'source_params' => $source_params,
				'total_pages' => $total_pages,
				'current_page' => $current_page,
				'posts_per_page' => $posts_per_page,
				'sort_order' => $sort_order,
				'post_id_page' => $post_id_page,
				'page_template' => $page_template,
				'pagination' => $pagination
			);
		}

		function get_array_data( ){
			return $this->array_data;
		}

		function pagination_block( ){
			$data = $this->get_array_data();
			$out = '';
			if ( !empty( $data ) ) {

				if( $data['pagination'] == 'df-pagination-yes' ){
					$nopadding = ( $data['block_type'] == 'df_block_8' ) ? 'no-padding' : '';
					$prev_status = ( $data['current_page'] == 1 ) ? 'shortcode-disable-pagination' : '';
					$next_status = ( $data['total_pages'] == $data['current_page'] ) ? 'shortcode-disable-pagination' : '';
					$out .= '<div class="'.esc_attr( $nopadding ).' '.esc_attr( $this->pagination_unique_class( $data['block_id'] ) ).' col-md-12 col-sm-12 col-xs-12">';
					$out .= '<ul class="list-inline shortcode-pagination">';
					$out .= '<li class="previous-posts">';
					$out .= '<a class="'.esc_attr( $prev_status ).'" href="#" 
									data-action="prevPostsBlock" 
									data-sidebar="" 
									data-column="'.esc_attr( $data['column'] ).'"
									data-id="'. esc_attr( $data['block_id'] ) .'" 
									data-block="'.esc_attr( $data['block_type'] ).'" 
									data-source="'.esc_attr( $data['source'] ).'" 
									data-sourceparams="'.esc_attr( $data['source_params'] ).'" 
									data-totalpages="'.esc_attr( $data['total_pages'] ).'" 
									data-current="'.esc_attr( $data['current_page'] ).'" 
									data-postsperpage="'. esc_attr( $data['posts_per_page'] ).'" 
									data-sortorder="'. esc_attr( $data['sort_order'] ).'" 
									data-postidpage="'. esc_attr( $data['post_id_page'] ) .'"
									data-pagetemplate="'. esc_attr( $data['page_template'] ).'" 
									data-pagination="'. esc_attr( $data['pagination'] ).'"><i class="ion-chevron-left"></i></a>';
					$out .= '</li>';
					$out .= '<li class="next-posts">';
					$out .= '<a class="'.esc_attr( $next_status ) .'" href="#" 
									data-action="nextPostsBlock" 
									data-sidebar="" 
									data-column="'.esc_attr( $data['column'] ) .'" 
									data-id="'.esc_attr( $data['block_id'] ) .'" 
									data-block="'.esc_attr( $data['block_type'] ) .'" 
									data-source="'. esc_attr( $data['source'] ) .'" 
									data-sourceparams="'. esc_attr( $data['source_params'] ) .'" 
									data-totalpages="'.esc_attr( $data['total_pages'] ) .'" 
									data-current="'.esc_attr( $data['current_page'] ) .'" 
									data-postsperpage="'.esc_attr( $data['posts_per_page'] ) .'" 
									data-sortorder="'.esc_attr( $data['sort_order'] ) .'" 
									data-postidpage="'.esc_attr( $data['post_id_page'] ).'"
									data-pagetemplate="'.esc_attr( $data['page_template'] ).'" 
									data-pagination="'.esc_attr( $data['pagination'] ).'"><i class="ion-chevron-right"></i></a>';
					$out .= '</li>';
					$out .= '</ul>';
					$out .= '</div>';
				}
			
			}
			
			return $out;
		}

		function div_unique_class( $id ){
			return "df-block-".$id;
		}

		function div_wrapper_unique_class( $id ){
			return "df-wrapper-block-".$id;
		}

		function pagination_unique_class( $id ){
			return "df-page-block-".$id;
		}

		function df_render_block_1( $posts, $params_block ){
			extract( $params_block );
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$this->set_array_data( $params_block );

			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case "1":
						$class = 'col-md-12 col-sm-12';
						if( $c == 1 ){
							$out .= $block_module->df_render_module_1_big( $post, $class );	
						}else{
							$out .= $block_module->df_render_module_1_small( $post, $class );
						}
						break;
					case "2":
						$class = 'col-md-6 col-sm-12';
						if( $c == 1 ){
							$out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, $class );
							$out .= $block_module->df_render_module_1_big( $post, '' );
							$out .= $block_layout->close_div();
						}else{
							if ($c==2) {$out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, $class );}
							$out .= $block_module->df_render_module_1_small( $post,  '' );
						}
						break;
					case "3":
						$class = 'col-md-4 col-sm-12';
						if( $c == 1 ){
							$out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c,$class);
							$out .= $block_module->df_render_module_1_big( $post, '' );
							$out .= $block_layout->close_div();
						}else {
							if( $c==2 ){ $out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, $class ); }
							$out .= $block_module->df_render_module_1_small( $post,  '' );
							if( $c == 7 ){ 
								$out .= $block_layout->close_div();
								$out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, $class );
							}
						}
						break;
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			return $out;
		}

		function df_render_block_2( $posts, $params_block ){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$this->set_array_data( $params_block );
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch( $block_module->df_get_column( $post_id_page, $column, $page_template ) ){
					case "1":
						$class = 'col-md-12 col-sm-12 ';
						$out .= $block_module->df_render_module_2( $post, $class );
						break;
					case "2":
						$class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
						$out .= $block_module->df_render_module_2( $post, $class );
						break;
					case "3":
						$class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
						$out .= $block_module->df_render_module_2( $post, $class );

						break;
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			return $out;
		}

		function df_render_block_3( $posts, $params_block ){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$this->set_array_data( $params_block );
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();  
			 	$post = get_post( get_the_ID() );
			 	array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
			 	switch( $block_module->df_get_column( $post_id_page, $column, $page_template ) ){
					case "1":
						$class = 'col-md-12 col-sm-12 ';
						$out .= $block_module->df_render_module_1_big( $post, $class );
						break;
					case "2":
						$class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
						$out .= $block_module->df_render_module_1_big( $post, $class );
						break;
					case "3":
						$class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
						$out .= $block_module->df_render_module_1_big( $post, $class );
						break;
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			return $out;
		}

		function df_render_block_4($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$this->set_array_data( $params_block );
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case '1':
						$class = 'col-md-12 col-sm-12 ';
						$out .= $block_module->df_render_module_1_small( $post, $class );
						break;
					case '2':
						$class = 'col-lg-6 col-md-6 col-sm-12';
						$out .= $block_module->df_render_module_1_small( $post, $class );
						break;
					case '3':
						$class = 'col-lg-4 col-md-4 col-sm-12';
						$out .= $block_module->df_render_module_1_small( $post, $class );
						break;
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			return $out;
		}

		function df_render_block_5($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$this->set_array_data( $params_block );
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case '1':
						$class = 'col-md-12 col-sm-12 ';
						$out .= $block_module->df_render_module_1_small_reverse( $post, $class );
						break;
					case '2':
						$class = 'col-lg-6 col-md-6 col-sm-12';
						$out .= $block_module->df_render_module_1_small_reverse( $post, $class );
						break;
					case '3':
						$class = 'col-lg-4 col-md-4 col-sm-12';
						$out .= $block_module->df_render_module_1_small_reverse( $post, $class );
						break;
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			return $out;
		}

		function df_render_block_6($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$this->set_array_data( $params_block );
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post(); 
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case '1':
						$class = 'col-md-12 col-sm-12 ';
						$out .= $block_module->df_render_module_3( $post, $class );
						break;
					case '2':
						$class = 'col-lg-6 col-md-6 col-sm-12';
						$out .= $block_module->df_render_module_3( $post, $class );
						break;
					case '3':
						$class = 'col-lg-4 col-md-4 col-sm-12';
						$out .= $block_module->df_render_module_3( $post, $class );
						break;
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			return $out;
		}

		function df_render_block_7($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$this->set_array_data( $params_block );
			$col_used = $block_module->df_get_column( $post_id_page, $column, $page_template );
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				$class = 'col-md-12 col-sm-12';
				$out .= $block_module->df_render_module_4( $post, $class, $col_used );
			endwhile;
			return $out;
		}

		function df_render_block_8($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$this->set_array_data( $params_block );
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch( $block_module->df_get_column( $post_id_page, $column, $page_template ) ){
					case "1":
						$class = 'col-md-12 col-sm-12 ';
						break;
					case "2":
						$class = 'col-md-6 col-sm-12 ';
						break;
					case "3":
						$class = 'col-md-4 col-sm-12 ';
						break;
				}
				$out .= $block_module->df_render_module_5( $post, $class );
			endwhile;
			return $out;
		}

		function df_render_block_9($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$this->set_array_data( $params_block );
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				$class = 'col-md-3 col-sm-6 col-xs-6';
				switch( $block_module->df_get_column( $post_id_page, $column, $page_template ) ){
					case "1":
						$class = 'col-md-3 col-sm-6 col-xs-6 ';
						if( $c == 1 || $c % 2 == 1 ){ $out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, 'col-md-12 no-padding'); }
						$out .= $block_module->df_render_module_6( $post, $class );
						if( $c % 2 == 0 ){ $out .= $block_layout->close_div(); }
						break;
					case "2":
						$class = 'col-md-3 col-sm-6 col-xs-6 ';
						if( $c == 1 || $c % 4 == 1 ){ $out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, 'col-md-12 no-padding'); }
						$out .= $block_module->df_render_module_6( $post, $class );
						if( $c % 4 == 0 ){ $out .= $block_layout->close_div(); }
						break;
					case "3":
						$class = 'col-md-3 col-sm-6 col-xs-6 ';
						if( $c == 1 || $c % 4 == 1 ){ $out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, 'col-md-12 no-padding'); }
						$out .= $block_module->df_render_module_6( $post, $class );
						if( $c % 4 == 0 ){ $out .= $block_layout->close_div(); }
						break;
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			return $out;
		}

		function df_render_block_10($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$this->set_array_data( $params_block );
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case "1":
						$class = 'col-md-12 col-sm-12 ';
						if( $c == 1 ){
							$out .= $block_module->df_render_module_1_big( $post, $class );	
						}else{
							$out .= $block_module->df_render_module_3( $post, $class );
						}
						break;
					case "2":
						$class = 'col-md-6 col-sm-12';
						if( $c == 1 ){
							$out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c,$class);
							$out .= $block_module->df_render_module_1_big( $post, '' );
							$out .= $block_layout->close_div();
						}else{
							if ($c==2) {$out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c,$class);}
							$out .= $block_module->df_render_module_3( $post,  '' );
						}
						break;
					case "3":
						$class = 'col-md-4 col-sm-12';
						if( $c == 1 ){
							$out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c,$class);
							$out .= $block_module->df_render_module_1_big( $post, '' );
							$out .= $block_layout->close_div();
						}else {
							if( $c==2 ){ $out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, $class); }
							$out .= $block_module->df_render_module_3( $post,  '' );
							if( $c == 7 ){ 
								$out .= $block_layout->close_div();
								$out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, $class );
							}
						}
						break;
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			return $out;
		}

		function df_render_block_11($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$this->set_array_data( $params_block );
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post(); 
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				$class = 'col-md-12 col-sm-12 col-xs-12';
				if( $c == 1 ){
					$out .= $block_module->df_render_module_7( $post, $class );
				}else{
					switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
						case '1':
							$out .= $block_module->df_render_module_1_small( $post, $class );
							break;
						case '2':
							if ( DF_Framework::df_is_mobile() ){
								$out .= $block_module->df_render_module_1_small( $post, $class );
							} else {
								$out .= $block_module->df_render_module_8( $post, $class );
							}
							break;
						case '3':
							if ( DF_Framework::df_is_mobile() ){
								$out .= $block_module->df_render_module_1_small( $post, $class );
							} else {
								$out .= $block_module->df_render_module_8( $post, $class );
							}
							break;
					}
				}
				$c++;
			endwhile;
			return $out;
		}

		function df_render_block_12($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$this->set_array_data( $params_block );
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch( $block_module->df_get_column( $post_id_page, $column, $page_template ) ){
					case "1":
						$class = 'col-md-12 col-sm-12 col-xs-12 ';
						if( $c == 1 ){
							$out .= $block_module->df_render_module_1_big( $post, $class );
						}else{
							$out .= $block_module->df_render_module_1_small( $post, $class );
						}
						break;
					case "2":
						$class = 'col-md-6 col-sm-6 col-xs-12 ';
						if( $c == 1 || $c % 2 == 1 ){ $out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, 'col-md-12 no-padding'); }
						if( $c == 1 || $c == 2 ){
							$out .= $block_module->df_render_module_1_big( $post, $class );
						}else{
							$out .= $block_module->df_render_module_1_small( $post, $class );
						}
						if( $c % 2 == 0 ){ $out .= $block_layout->close_div(); }
						break;
					case "3":
						$class = 'col-md-4 col-sm-4 col-xs-12 ';
						if( $c == 1 || $c % 3 == 1 ){ $out .= $block_layout->open_div( 'post-block-'.$block_id.'-'.$c, 'col-md-12 no-padding'); }
						if( $c == 1 || $c == 2 || $c == 3 ){
							$out .= $block_module->df_render_module_1_big( $post, $class );
						}else{
							$out .= $block_module->df_render_module_1_small( $post, $class );
						}
						if( $c % 3 == 0 ){  $out .= $block_layout->close_div(); }
						break;
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			return $out;
		}

		function df_render_block_13($posts, $params_block){
			extract($params_block);
			$out = '';
			$block_module = new DF_Block_Module_Post();
			$this->set_array_data( $params_block );

			while( $posts->have_posts() ) : $posts->the_post(); 
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				$class = 'col-md-12';
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case '1':
						$out .= $block_module->df_render_module_1_small( $post, $class );
						break;
					case '2':
						if ( DF_Framework::df_is_mobile() ){
							$out .= $block_module->df_render_module_1_small( $post, $class );
						} else {
							$out .= $block_module->df_render_module_8( $post, $class );
						}
						break;
					case '3':
						if ( DF_Framework::df_is_mobile() ){
							$out .= $block_module->df_render_module_1_small( $post, $class );
						} else {
							$out .= $block_module->df_render_module_8( $post, $class );
						}
						break;
				}
			endwhile;
			return $out;
		}

		function df_render_block_14($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$clm = $block_module->df_get_column( $post_id_page, $column, $page_template );
			$out = '';
			$out .= '<div class="col-md-12 no-padding">';
			$out .= '<div class="df-shortcode-blocks-slider column-used-'. esc_attr( $clm ) .'">';
			while( $posts->have_posts() ) : $posts->the_post(); 
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case '1':
						$class = 'col-md-12 col-sm-12 col-xs-12';
						$out .= $block_module->df_render_module_1_big( $post, $class );
						break;
					case '2':
						$class = 'col-md-4 col-sm-12 col-xs-12';
						$out .= $block_module->df_render_module_1_big( $post, $class );
						break;
					case '3':
						$class = 'col-md-4 col-sm-12 col-xs-12';
						$out .= $block_module->df_render_module_1_big( $post, $class );
						break;
				}
			endwhile;
			$out .= '</div>';
			$out .= '</div>';
			return $out;
		}

		function df_render_grid_1( $posts, $params_block, $show_bullet ){
			extract( $params_block );
			$use_bullet = '';
			if ( 'no' == $show_bullet ){
				$use_bullet = 'hide-bullet';
			}
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$out = '';
			$out .= '<div class="grid-slide-wrap '. esc_attr( $use_bullet ) .'">';
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				if ( $c == 1 || $c % 3 == 1 ){ $out .= $block_layout->open_div( 'post-grid-'.$block_id.'-'.$c, 'df-shortcode-blocks main-grid'); }
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case '1':
						if ( $c == 1 || $c % 3 == 1 ){
							$class = 'style-1';
							if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size = 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-1';
							if ( DF_Framework::df_is_mobile() ){
								$img_size = 'df_size_1200x675';
								$heading	= 'h4';
							}  else {
								$img_size = 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_small( $post, $class, $img_size, $heading );
						}
						break;
					case '2':
						if ( $c == 1 || $c % 3 == 1 ){
							$class = 'style-1';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_788x524';
								$heading	= 'h3';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-1';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_small( $post, $class, $img_size, $heading );
						}
						break;
					case '3':
						if ( $c == 1 || $c % 3 == 1 ){
							$class = 'style-1';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_788x524';
								$heading	= 'h4';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_788x524';
								$heading	= 'h3';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-1';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_small( $post, $class, $img_size, $heading );
						}
						break;
				}
				
				if( $c % 3 == 0 ){  $out .= $block_layout->close_div(); }
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_grid_2( $posts, $params_block, $show_bullet ){
			extract( $params_block );
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$use_bullet = '';
			if ( 'no' == $show_bullet ){
				$use_bullet = 'hide-bullet';
			}
			$out = '';
			$out .= '<div class="grid-slide-wrap '. esc_attr( $use_bullet ) .'">';
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				if ( $c == 1 || $c % 3 == 1 ){ $out .= $block_layout->open_div( 'post-grid-'.$block_id.'-'.$c, 'df-shortcode-blocks main-grid'); }
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case '1':
						if ( $c == 1 || $c % 3 == 1 ){
							$class = 'style-2';
							if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size = 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-2';
							if ( DF_Framework::df_is_mobile() ){
								$img_size = 'df_size_1200x675';
								$heading	= 'h4';
							}  else {
								$img_size = 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_medium( $post, $class, $img_size, $heading );
						}
						break;
					case '2':
						if ( $c == 1 || $c % 3 == 1 ){
							$class = 'style-2';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_788x524';
								$heading	= 'h3';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-2';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_medium( $post, $class, $img_size, $heading );
						}
						break;
					case '3':
						if ( $c == 1 || $c % 3 == 1 ){
							$class = 'style-2';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_788x524';
								$heading	= 'h4';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_788x524';
								$heading	= 'h3';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-2';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_medium( $post, $class, $img_size, $heading );
						}
						break;
				}
				
				if( $c % 3 == 0 ){  $out .= $block_layout->close_div(); }
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_grid_3( $posts, $params_block, $show_bullet ){
			extract( $params_block );
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$use_bullet = '';
			if ( 'no' == $show_bullet ){
				$use_bullet = 'hide-bullet';
			}
			$out = '';
			$out .= '<div class="grid-slide-wrap '. esc_attr( $use_bullet ) .'">';
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				if ( $c == 1 || $c % 5 == 1 ){ $out .= $block_layout->open_div( 'post-grid-'.$block_id.'-'.$c, 'df-shortcode-blocks main-grid'); }
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case '1':
						if ( $c == 1 || $c % 5 == 1 ){
							$class = 'style-3';
							if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size = 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-3';
							if ( DF_Framework::df_is_mobile() ){
								$img_size = 'df_size_1200x675';
								$heading	= 'h4';
							}  else {
								$img_size = 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_small( $post, $class, $img_size, $heading );
						}
						break;
					case '2':
						if ( $c == 1 || $c % 5 == 1 ){
							$class = 'style-3';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_788x524';
								$heading	= 'h3';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-3';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h6';
							}
							$out .= $block_module->df_render_module_grid_small( $post, $class, $img_size, $heading );
						}
						break;
					case '3':
						if ( $c == 1 || $c % 5 == 1 ){
							$class = 'style-3';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_788x524';
								$heading	= 'h4';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_788x524';
								$heading	= 'h3';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-3';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_small( $post, $class, $img_size, $heading );
						}
						break;
				}
				
				if( $c % 5 == 0 ){  $out .= $block_layout->close_div(); }
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_grid_4($posts, $params_block, $show_bullet ){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$use_bullet = '';
			if ( 'no' == $show_bullet ){
				$use_bullet = 'hide-bullet';
			}
			$out = '';
			$out .= '<div class="grid-slide-wrap '. esc_attr( $use_bullet ) .'">';
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				if( $c == 1 || $c % 7 == 1 ){ $out .= $block_layout->open_div( 'post-grid-'.$block_id.'-'.$c, 'df-shortcode-blocks main-grid'); }
				switch ( $block_module->df_get_column( $post_id_page, $column, $page_template ) ) {
					case '1';
						if ( $c==1 || $c % 7 == 1 ){
							$class = 'style-4';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else if ( ($c+1) % 7 == 0 || $c % 7 == 0 ) {
							$class = 'style-4';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_medium( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-4';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_small( $post, $class, $img_size, $heading );
						}
						break;
					case '2';
						if ( $c==1 || $c % 7 == 1 ){
							$class = 'style-4';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_788x524';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else if ( ($c+1) % 7 == 0 || $c % 7 == 0 ) {
							$class = 'style-4';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							}
							$out .= $block_module->df_render_module_grid_medium( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-4';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h6';
							}
							$out .= $block_module->df_render_module_grid_small( $post, $class, $img_size, $heading );
						}
						break;
					case '3';
						if ( $c==1 || $c % 7 == 1 ){
							$class = 'style-4';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_788x524';
								$heading	= 'h3';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_788x524';
								$heading	= 'h3';
							}
							$out .= $block_module->df_render_module_grid_big( $post, $class, $img_size, $heading );
						} else if ( ($c+1) % 7 == 0 || $c % 7 == 0 ) {
							$class = 'style-4';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							}
							$out .= $block_module->df_render_module_grid_medium( $post, $class, $img_size, $heading );
						} else {
							$class = 'style-4';
							if ( DF_Framework::df_is_ipad() ){
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							} else if ( DF_Framework::df_is_mobile() ){
								$img_size	= 'df_size_1200x675';
								$heading	= 'h4';
							} else {
								$img_size	= 'df_size_632x474';
								$heading	= 'h5';
							}
							$out .= $block_module->df_render_module_grid_small( $post, $class, $img_size, $heading );
						}
						break;
				}
				if( $c % 7 == 0 ){  $out .= $block_layout->close_div(); }
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_carousel_1($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$col_type = 'one-thirds-column';
			$col_used = $block_module->df_get_column( $post_id_page, $column, $page_template );
			if ( 3 == $col_used ){
				$col_type = 'full-column';
			} else if ( 2 == $col_used ){
				$col_type = 'two-thirds-column';
			}
			$out = '';
			$out .= '<div class="df-shortcode-blocks main-carousel layout-1 '. esc_attr( $col_type ).'" data-autoplay="'. esc_attr( $auto_play).'" data-autoplay-speed="'. esc_attr( $auto_play_speed ).'" >';
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $col_used ) {
					case '1':
						$class = '';
						$img_size = 'df_size_474x633';
						$heading	= 'h4';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '2':
						$class = '';
						$img_size = 'df_size_474x633';
						$heading	= 'h4';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '3':
						$class = '';
						$img_size = 'df_size_474x633';
						$heading	= 'h4';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
				}
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_carousel_2($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$col_type = 'one-thirds-column';
			$col_used = $block_module->df_get_column( $post_id_page, $column, $page_template );
			if ( 3 == $col_used ){
				$col_type = 'full-column';
			} else if ( 2 == $col_used ){
				$col_type = 'two-thirds-column';
			}
			$out = '';
			$out .= '<div class="df-shortcode-blocks main-carousel layout-2 '. esc_attr( $col_type ) .'" data-autoplay="'. esc_attr( $auto_play).'" data-autoplay-speed="'. esc_attr( $auto_play_speed ).'">';
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $col_used ) {
					case '1':
						$class = '';
						$img_size = 'df_size_632x474';
						$heading	= 'h4';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '2':
						$class = '';
						$img_size = 'df_size_632x474';
						$heading	= 'h4';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '3':
						$class = '';
						$img_size = 'df_size_632x474';
						$heading	= 'h4';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
				}
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_carousel_3($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$col_type = 'one-thirds-column';
			$col_used = $block_module->df_get_column( $post_id_page, $column, $page_template );
			if ( 3 == $col_used ){
				$col_type = 'full-column';
			} else if ( 2 == $col_used ){
				$col_type = 'two-thirds-column';
			}
			$out = '';
			$out .= '<div class="df-shortcode-blocks main-carousel layout-3 '. esc_attr( $col_type ) .'" data-autoplay="'. esc_attr( $auto_play).'" data-autoplay-speed="'. esc_attr( $auto_play_speed ).'">';
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				switch ( $col_used ) {
					case '1':
						$class = '';
						$img_size = 'df_size_632x474';
						$heading	= 'h5';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '2':
						$class = '';
						$img_size = 'df_size_632x474';
						$heading	= 'h5';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '3':
						$class = '';
						$img_size = 'df_size_632x474';
						$heading	= 'h5';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
				}
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_carousel_4($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$col_type = 'one-thirds-column';
			$col_used = $block_module->df_get_column( $post_id_page, $column, $page_template );
			if ( 3 == $col_used ){
				$col_type = 'full-column';
			} else if ( 2 == $col_used ){
				$col_type = 'two-thirds-column';
			}
			$out = '';
			$out .= '<div class="df-shortcode-blocks main-carousel layout-4 '. esc_attr( $col_type ) .'" data-autoplay="'. esc_attr( $auto_play).'" data-autoplay-speed="'. esc_attr( $auto_play_speed ).'">';
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $col_used ) {
					case '1':
						$class = '';
						$img_size = 'df_size_474x633';
						$heading	= 'h4';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '2':
						$class = '';
						$img_size = 'df_size_474x633';
						$heading	= 'h4';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '3':
						$class = '';
						$img_size = 'df_size_474x633';
						$heading	= 'h4';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
				}
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_carousel_5($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$col_type = 'one-thirds-column';
			$col_used = $block_module->df_get_column( $post_id_page, $column, $page_template );
			if ( 3 == $col_used ){
				$col_type = 'full-column';
			} else if ( 2 == $col_used ){
				$col_type = 'two-thirds-column';
			}
			$out = '';
			$out .= '<div class="df-shortcode-blocks main-carousel layout-5 '. esc_attr( $col_type) .'" data-autoplay="'. esc_attr( $auto_play).'" data-autoplay-speed="'. esc_attr( $auto_play_speed ).'">';
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $col_used ) {
					case '1':
						$class = '';
						$img_size = 'df_size_1200x675';
						$heading	= 'h3';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '2':
						$class = '';
						$img_size = 'df_size_1200x675';
						$heading	= 'h3';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
					case '3':
						$class = '';
						$img_size = 'df_size_1200x675';
						$heading	= 'h2';
						$out .= $block_module->df_render_module_carousel_1( $post, $class, $img_size, $heading );
						break;
				}
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_carousel_6($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$col_used = $block_module->df_get_column( $post_id_page, $column, $page_template );
			$out = '';
			$out .= '<div class="df-shortcode-blocks main-carousel layout-6 clearfix" data-autoplay="'. esc_attr( $auto_play).'" data-autoplay-speed="'. esc_attr( $auto_play_speed ).'">';
			$c = 1;
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				if ( $c == 1 ){
					if ( 1 == $col_used ){
						$out .= '<div class="col-md-12 col-sm-12 col-xs-12">';
					} else {
						$out .= '<div class="col-md-6 col-sm-12 col-xs-12 col-md-push-3">';
					}
					switch ( $col_used ) {
						case '1':
							$class = '';
							$out .= $block_module->df_render_module_carousel_2_big( $post, $class );
							break;
						case '2':
							$class = '';
							$out .= $block_module->df_render_module_carousel_2_big( $post, $class );
							break;
						case '3':
							$class = '';
							$out .= $block_module->df_render_module_carousel_2_big( $post, $class );
							break;
					}
					$out .= '</div>';
				} else {
					if ( $c == 2 ){
						if ( 1 == $col_used ){
							$out .= '<div class="col-md-6 col-sm-12 col-xs-12">';
						} else {
							$out .= '<div class="col-md-3 col-sm-6 col-xs-6 col-md-pull-6">';
						}
					} else if ( $c == 4 ){
						if ( 1 == $col_used ){
							$out .= '<div class="col-md-6 col-sm-12 col-xs-12">';
						} else {
							$out .= '<div class="col-md-3 col-sm-6 col-xs-6">';
						}
					}
					switch ( $col_used ) {
						case '1';
							$class = '';
							$out .= $block_module->df_render_module_carousel_2_small( $post, $class );
							break;
						case '2';
							$class = '';
							$out .= $block_module->df_render_module_carousel_2_small( $post, $class );
							break;
						case '3';
							$class = '';
							$out .= $block_module->df_render_module_carousel_2_small( $post, $class );
							break;
					}
					if ( $c == 3 || $c == 5 ){
						$out .= '</div>';
					}
				}
				$c++;
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_carousel_7($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$col_type = 'one-thirds-column';
			$col_used = $block_module->df_get_column( $post_id_page, $column, $page_template );
			if ( 3 == $col_used ){
				$col_type = 'full-column';
			} else if ( 2 == $col_used ){
				$col_type = 'two-thirds-column';
			}
			$out = '';
			$out .= '<div class="carousel-layout-7-wrap">';
			$out .= '<div class="df-shortcode-blocks main-carousel layout-7 '. esc_attr( $col_type ) .'" data-autoplay="'. esc_attr( $auto_play).'" data-autoplay-speed="'. esc_attr( $auto_play_speed ).'">';
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $col_used ) {
					case '1':
						$class = '';
						$img_size = 'df_size_1200x675';
						$out .= $block_module->df_render_module_carousel_3_main( $post, $class, $img_size );
						break;
					case '2':
						$class = '';
						$img_size = 'df_size_1200x675';
						$out .= $block_module->df_render_module_carousel_3_main( $post, $class, $img_size );
						break;
					case '3':
						$class = '';
						$img_size = 'df_size_1200x675';
						$out .= $block_module->df_render_module_carousel_3_main( $post, $class, $img_size );
						break;
				}
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			$out .= '<div class="df-shortcode-blocks nav-carousel layout-7 '. esc_attr( $col_type ) .'">';
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				switch ( $col_used ) {
					case '1':
						$class = '';
						$img_size = 'df_size_273x205';
						$out .= $block_module->df_render_module_carousel_3_nav( $post, $class, $img_size );
						break;
					case '2':
						$class = '';
						$img_size = 'df_size_273x205';
						$out .= $block_module->df_render_module_carousel_3_nav( $post, $class, $img_size );
						break;
					case '3':
						$class = '';
						$img_size = 'df_size_273x205';
						$out .= $block_module->df_render_module_carousel_3_nav( $post, $class, $img_size );
						break;
				}
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			$out .= '</div>';
			return $out;
		}

		function df_render_carousel_8($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$block_layout = new DF_Layout_Block();
			$col_type = 'one-thirds-column';
			$col_used = $block_module->df_get_column( $post_id_page, $column, $page_template );
			if ( 3 == $col_used ){
				$col_type = 'full-column';
			} else if ( 2 == $col_used ){
				$col_type = 'two-thirds-column';
			}
			$out = '';
			$out .= '<div class="carousel-layout-8-wrap '. esc_attr( $col_type ) .'" data-autoplay="'. esc_attr( $auto_play).'" data-autoplay-speed="'. esc_attr( $auto_play_speed ).'">';
			while( $posts->have_posts() ) : $posts->the_post();
				$post = get_post( get_the_ID() );
				array_push(DF_VC_Extender_Shortcode::$_not_in_posts,get_the_ID());
				switch ( $col_used ) {
					case '1':
						$class = $col_type;
						$img_size = 'df_size_788x524';
						$out .= $block_module->df_render_module_carousel_4( $post, $class, $img_size );
						break;
					case '2':
						$class = $col_type;
						$img_size = 'df_size_788x524';
						$out .= $block_module->df_render_module_carousel_4( $post, $class, $img_size );
						break;
					case '3':
						$class = $col_type;
						$img_size = 'df_size_788x524';
						$out .= $block_module->df_render_module_carousel_4( $post, $class, $img_size );
						break;
				}
			endwhile;
			$out .= $block_layout->close_all();
			$out .= '</div>';
			return $out;
		}

		function df_render_news_ticker($posts, $params_block){
			extract($params_block);
			$block_module = new DF_Block_Module_Post();
			$out = '';
			while( $posts->have_posts() ) : $posts->the_post();
				$title_news_ticker = explode(",",the_title('','',false));
				$title_news_ticker = $title_news_ticker[0];
				$title = '';
				switch ($block_module->df_get_column( $post_id_page, $column, $page_template )) {
					case '1':
						if(wp_is_mobile()){
						$title = substr($title_news_ticker, 0, 40);
					}else {
						$title = substr($title_news_ticker, 0, 13)."...";
					}
						break;
					case '2':
					case '3':
						$title = substr($title_news_ticker, 0, 40);
						break;
				}
				$out .= '<li class="slide">';
				$out .= '<p><a href="'.esc_url( get_permalink() ).'" style="color:'.esc_attr( $post_title_text_color ).'">'.$title.'</a></p>';
				$out .= '</li>';
			endwhile;
			return $out;
		}
	}
}

/* file location: /your/file/location/[file].php */