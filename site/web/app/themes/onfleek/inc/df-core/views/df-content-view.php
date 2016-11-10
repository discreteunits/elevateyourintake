<?php
/**
 * Class: DF_Content_View
 * Description: class for load content view
 */
if( !class_exists( 'DF_Content_View' ) ){

	class DF_Content_View {

		function __construct() {
			add_action( 'wp_ajax_nopriv_df_archive_custom_loop_ajax', array( $this, 'df_archive_custom_loop_ajax' ) );
			add_action( 'wp_ajax_df_archive_custom_loop_ajax', array( $this, 'df_archive_custom_loop_ajax' ) );
		}

		static function df_load_content( $params_setting ) {
            extract( $params_setting );
       //      if ( 'default' == $option_layout_type){
       //          if( $general_option_layout_type == 'boxed' ){
    			// 	$layout_type = 'df-content-boxed';
    			// }else if( $general_option_layout_type == 'frame' || $general_option_layout_type == 'framed') {
    			// 	$layout_type = 'df-content-frame';
    			// }else{
    			// 	$layout_type = 'df-content-full';
    			// } 
       //      }else{
       //          if( $option_layout_type == 'boxed' ){
				   //  $layout_type = 'df-content-boxed';
			    //  }else if( $option_layout_type == 'frame' || $option_layout_type == 'framed') {
				   //  $layout_type = 'df-content-frame';
			    //  }else{
				   //  $layout_type = 'df-content-full';
			    //  }
       //      }

			// extract background type
			// $bg_type = '';
			// if( isset( $option_bg_type ) ){
			// 	if( $option_bg_type == 'df-bg' ){
			// 		$bg_type = $option_bg_type;
			// 	}
			// }
			
			/**
			 * home / index / blog post
			 */
			if( isset( $home_article_display ) ){
				get_template_part( "inc/df-core/views/df-content/df-home", $home_article_display);
			}

			if( isset( $general_post_layout ) ){
				/*check first if user set wrong type style depend on post format 
				**if format audio and the style is not supported we force change the style to layout-4 that that run correctly
				*/
				if ( ( $post_format == 'audio'  ||  $post_format == 'video' ) && !in_array($general_post_layout , DF_Global_Options::$post_format_style['audio_and_video'] ) ) {
					$general_post_layout = 'layout-4';
				}
				if ( ( $post_format == 'standard'  ||  $post_format == 'gallery' ) && !in_array($general_post_layout , DF_Global_Options::$post_format_style['standard_and_gallery'] ) ) {
					$general_post_layout = 'layout-5';
				}
				if( is_attachment() ){
					$general_post_layout = 'layout-1';
				}
				get_template_part( 'inc/df-core/views/df-content/df-post', $general_post_layout );
			}

			if( isset( $general_page_layout ) ){
				
				switch ( $post_setting['page_type'] ) {
					case 'pagebuilder-witharchive':
						get_template_part( 'inc/df-core/views/df-content/df-page', $page_type );
						break;
					case 'pagebuilder':
						get_template_part( 'inc/df-core/views/df-content/df-page', $page_type );
						break;
					case 'default':
						get_template_part( 'inc/df-core/views/df-content/df-page', $page_type );
						break;
					default:
						get_template_part( 'inc/df-core/views/df-content/df-page-default' );
						break;
				}
			}
			
			if( isset( $archive_option_article_display ) ){
				get_template_part( 'inc/df-core/views/df-content/df-archive', $archive_option_article_display );
			}
			
			if( isset( $search_option_article_display ) ){
				get_template_part( 'inc/df-core/views/df-content/df-search', $search_option_article_display );
			}

			if( isset( $notfound_option_article_display ) ){
				get_template_part( 'inc/df-core/views/df-content/df-404-layout' );
			}
		}

		static function df_load_category(){									
			$categories = get_the_category();
			$output = '';
			if($categories) {
				$output = '<ul class="list-inline df-category article-category clearfix">';
				foreach($categories as $category) {
		            $name = $category->cat_name;
					$name = str_replace(" ","-",$name);
					$name = str_replace("&amp;", "and", $name);

					$output .= '<li class="entry-category">
								<a href="'. esc_url( get_category_link( $category->term_id ) ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'onfleek' ), $category->term_id ) ) . '" class="cat-'.$name.'">'.$category->cat_name.'</a>
								</li>';
				}
				$output .= '</ul>';
			}
			return $output;								        
		}
        
		static function df_load_sub_category($parentcategoryid){									
			$categories = get_categories('child_of='.$parentcategoryid.'&hide_empty=0');
			$output = '';
			if($categories) {
				$output = '<ul class="list-inline df-category article-category clearfix">';
				foreach($categories as $category) {
		            $name = $category->cat_name;
		             $name = str_replace(" ","-",$name);
					$output .= '<li class="entry-category">
								<a href="'. esc_url( get_category_link( $category->term_id ) ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'onfleek' ), $category->term_id ) ) . '" class="cat-'.$name.'">'.$category->cat_name.'</a>
								</li>';
				}
				$output .= '</ul>';
			}
			return $output;								        
		}
        
        static function df_load_category_header(){
    		?>
            <div class="entry-title df-category-header-title">
    		<h1>
    		<?php
    			if ( is_date() ) {
    				if ( is_day() ) {
    					printf( get_the_time( 'F' ) . " " . get_the_time( 'd' ) . ", " . get_the_time( 'Y' ) );
    				}
    				if ( is_month() ) {
    					printf( get_the_time( 'F' ) . ", " . get_the_time( 'Y' ) );	
    				}
    				if ( is_year() ) {
    					printf( get_the_time( 'Y' ) );
    				}
    			}
    			if ( is_tag() ) {
    				single_tag_title( 'Tag: ', true );
    			}
    			if ( is_author() ) {
    				$current_author = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
    				$author_id = $current_author->ID;
    				echo $current_author->data->display_name . " ";
    				echo get_avatar( get_the_author_meta( 'ID', $author_id ), 64, $default = '', $alt = '', array( 'class' => 'df-archive-author-title-image img-circle') ) ;
    			}
    			if ( is_category() ) {
    				single_cat_title();
    			}
    		?>
    		</h1>
            <?php 
                
            ?>
    		</div>
        
        	<?php
    		if ( is_category() ) {
                $cat		= get_query_var( 'cat' );
				$current	= get_category( $cat );
				
				$current_id = $current->term_id;
				$categorydescription = category_description( $current_id );
    			if ( $categorydescription != '' || !empty( $categorydescription ) ) {
                    	?>
                    	<div class="df-category-header-description">
                    		<?php echo category_description( $current_id );?>
                    	</div>
        	           <?php
    			     }
				$categories = get_categories('child_of='.$current_id.'&hide_empty=0');
				$output = '';
				if($categories) {
					$output = '<ul class="list-inline df-category article-category clearfix">';
					foreach($categories as $category) {
						$name = $category->cat_name;
						 $name = str_replace(" ","-",$name);
						$output .= '<li class="entry-category">
									<a href="'. esc_url( get_category_link( $category->term_id ) ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'onfleek' ), $category->term_id ) ) . '" class="cat-'.$name.'">'.$category->cat_name.'</a>
									</li>';
					}
					$output .= '</ul>';
				}
				echo $output;
    		} else if ( is_author() ) {
    		?>
	        <div class="author-description push-top-2">
	            <?php echo the_author_meta("description");?>
	        </div>
			<?php
			}
        }

		static function df_pagination( $max = null ) {
			$prev_arrow = is_rtl() ? '<i class="ion-chevron-right"></i>' : '<i class="ion-chevron-left"></i>';
			$next_arrow = is_rtl() ? '<i class="ion-chevron-left"></i>' : '<i class="ion-chevron-right"></i>';
			global $wp_query, $wp_rewrite;
			$total = ( $max == null ) ? $wp_query->max_num_pages : $max;

			$big = 999999999; // need an unlikely integer
			if( $total > 1 )  {
				 if( !$current_page = get_query_var('paged') )
					 $current_page = 1;
				  if( get_option('permalink_structure') && !is_search()) {
					  $format = 'page/%#%/';
				  } else {
					 $format = '&paged=%#%';
				 }
				$pagination=array(
					'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'		=> $format,
					'current'		=> max( 1, get_query_var('paged') ),
					'total' 		=> $total,
					'mid_size'		=> 3,
					'type' 			=> 'list',
					'prev_text'		=> $prev_arrow,
					'next_text'		=> $next_arrow,
				 );

				return paginate_links( $pagination );
			}
		}
		
		static function df_archive_custom_loop( $params_setting ) {
			$pagination='';
			extract( $params_setting );
            if( $option_layout_type == 'boxed' ){
				$layout_type = 'df-content-boxed';
			}else if( $option_layout_type == 'frame' || $option_layout_type == 'framed') {
				$layout_type = 'df-content-frame';
			}else{
				$layout_type = 'df-content-full';
			}
			$bg_type = '';
			if( isset( $option_bg_type ) ){
				if( $option_bg_type == 'df-bg' ){
					$bg_type = $option_bg_type;
				}
			}

			$post_setting_layout = $post_setting['page_post_layout'];
			$num_layout = explode( "-", $post_setting_layout );

			if( $post_setting['sort_order'] == 'lastest_post' ){
				$order = 'ASC'; 
			}else{
				$order = 'DESC';
			}

			$args_query = array(
					'posts_per_page' 	=> $post_setting['limit_post_order'],
					'order'				=> $order,
					'orderby' 			=> 'ID',
					'ignore_sticky_posts'=> true,
				);
			
			switch ($post_setting['filter_use']) {
				case 'post_id':
					$args_query['post__in'] = explode(",", $post_setting['post_setting_param'] );
					break;
				case 'category':
					$args_query['cat'] = $post_setting['post_setting_param'];
					break;
				case 'multi_category':
					$args_query['category_name'] = $post_setting['post_setting_param']; 
					break;
				case 'tag':
					$args_query['tag_slug__in'] = explode(",", $post_setting['post_setting_param'] );
					break;
				case 'author':
					$args_query['author__in'] = explode(",", $post_setting['post_setting_param'] ); 
					break;
				default:
					break;
			}

			$query = new WP_Query( $args_query );

			$query->query_vars['paged']=$query->query_vars['paged'] <= 1 ? 1 : $query->query_vars['paged'];
			
			$total = $query->max_num_pages;
			if( $total > 1 ){
				$pagination=self::custom_pagination($post_setting['limit_post_order'], $query->query_vars['paged'], 0, $total);
			}

			require get_template_directory(). '/inc/df-core/views/df-content/df-page-post-setting-'. $num_layout[1] .'.php';
		}
		
		static function df_archive_custom_loop_ajax() {
			$pagination='';
			$post_id=$_POST['post_id'];
			$page=$_POST['page'];
			$params_setting = DF_Content::df_get_content_parameters($post_id);

			extract($params_setting);

			if( $option_layout_type == 'boxed' ){
				$layout_type = 'df-content-boxed';
			} else if( $option_layout_type == 'frame' || $option_layout_type == 'framed') {
				$layout_type = 'df-content-frame';
			} else {
				$layout_type = 'df-content-full';
			}

			$bg_type = '';
			if( isset( $option_bg_type ) ){
				if( $option_bg_type == 'df-bg' ){
					$bg_type = $option_bg_type;
				}
			}
			
			$post_setting_layout = $post_setting['page_post_layout'];
			$num_layout = explode( "-", $post_setting_layout );

			if( $post_setting['sort_order'] == 'lastest_post' ){
				$order = 'ASC'; 
			}else{
				$order = 'DESC';
			}

			$args_query = array(
					'posts_per_page' 	=> $post_setting['limit_post_order'],
					'order'				=> $order,
					'orderby' 			=> 'ID',
					'ignore_sticky_posts'=> true,
					'paged' => $page
				);

			switch ($post_setting['filter_use']) {
				case 'post_id':
					$args_query['post__in'] = explode(",", $post_setting['post_setting_param'] );
					break;
				case 'category':
					$args_query['cat'] = $post_setting['post_setting_param'];
					break;
				case 'multi_category':
					$args_query['category_name'] = $post_setting['post_setting_param'];
					break;
				case 'tag':
					$args_query['tag_slug__in'] = explode(",", $post_setting['post_setting_param'] );
					break;
				case 'author':
					$args_query['author__in'] = explode(",", $post_setting['post_setting_param'] ); 
					break;
				default:
					break;
			}

			$query = new WP_Query( $args_query );

			// $query->query_vars['paged'] = $query->query_vars['paged'] <= 1 ? 1 : $_POST['page'];

			$total = $query->max_num_pages;
			if( $total > 1 ){
				$pagination=self::custom_pagination( $post_setting['limit_post_order'], $page, 0, $total);
			}

			require get_template_directory() .'/inc/df-core/views/df-content/df-page-post-setting-'. $num_layout[1] .'.php';
		}
		
		static function custom_pagination($item_per_page, $current_page, $total_records, $total_pages){
			$pagination = '';
			if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ 

				$pagination .= '<div class="df-custom-pagination"><ul class="page-numbers list-inline df-pagination-list">';
				
				$right_links    = $current_page + 3; 
				$previous       = $current_page - 3; 
				$previ       =   $current_page - 1;      
				$next           = $current_page + 1;
				$first_link     = true;
				
				if($current_page > 1){
					$previous_link = ($previous==0)?1:$previous;
					$pagination .= '<li class="prev page-numbers"><a href="#"  data-page="'.$previ.'" title="Previous"><p><i class="ion-chevron-left"></i></p></a></li>';
						for($i = ($current_page-2); $i < $current_page; $i++){
							if($i > 0){
								$pagination .= '<li><a class="page-numbers" href="#" data-page="'.$i.'" title="Page'.$i.'"><p>'.$i.'</p></a></li>';
							}
						}   
					$first_link = false;
				}
				if($first_link){ 
					$pagination .= '<li class="page-numbers current active"><p class="page-numbers current">'.$current_page.'</p></li>';
				}elseif($current_page == $total_pages){ 
					$pagination .= '<li class="page-numbers current active"><p class="page-numbers current">'.$current_page.'</p></li>';
				}else{ 
					$pagination .= '<li class="page-numbers current active"><p class="page-numbers current">'.$current_page.'</p></li>';
				}
					

				for($i = $current_page+1; $i < $right_links ; $i++){
					if($i<=$total_pages){
						$pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'"><p>'.$i.'</p></a></li>';
					}
				}


				if($current_page < $total_pages){ 
						$next_link = ($i > $total_pages)? $total_pages : $i;
						$pagination .= '<li class="next page-numbers"><a href="#"   data-page="'.$next.'" title="Next"><p><i class="ion-chevron-right"></i></p></a></li>';
				} 			

				$pagination .= '</ul></div>'; 


			}
			return $pagination;
		}
		
		static function df_comment($is_show_comment_counts){
			if ( comments_open() || get_comments_number() ) :	
			?>
				<div class="df-comments-wrap">
					<ul class="df-comments-area-title list-inline">
						<li class="comments-show">
							<h4><?php _e('Show Comments', 'onfleek' ); ?>
								<span class="df-comments-number">
								<?php if($is_show_comment_counts == "yes"){ ?>
									(<?php echo get_comments_number();?>)
								<?php } ?>
								</span>
							</h4>
						</li>
						<li class="collapse-button">
							<i class="ion-plus comments-show"></i>
						</li>
					</ul>
					<div class="df-comments-inner">
						<?php comments_template();?>
					</div>
				</div>
				<?php 
			endif;					
		}
	}
	new DF_Content_View();
}
