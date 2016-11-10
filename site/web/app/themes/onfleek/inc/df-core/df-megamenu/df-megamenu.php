<?php 
/*
 * Class: df_megamenu
 */
if( !class_exists( 'DF_Megamenu' ) ){

	require get_template_directory().'/inc/df-core/df-megamenu/df-custom-walker-front.php'; // front end menu generates here!
	require get_template_directory().'/inc/df-core/df-megamenu/df-custom-walker-admin.php'; // add custom field to admin menu panel

	require get_template_directory().'/inc/df-core/df-megamenu/df-walker-admin-topbar.php'; // add custom field to admin menu panel
	require get_template_directory().'/inc/df-core/df-megamenu/df-walker-front-topbar.php'; // custom walker for topbar in front end

	class DF_Megamenu {
		var $current_page = 1; // Default page number
		var $found_posts; // found_posts
		var $total_pages; // set_total_pages
		var $boxed_no_padding = '';
        var $boxed_wrapper = '';
		/**
		 * Constructor
		 */
		function __construct() {
			add_action( 'init', array( $this, 'df_register_topbar' ) );
			
			if(is_admin()) {

				// add action for save custom field
				add_action( 'wp_update_nav_menu_item', array($this, 'df_update_custom_category'), 10, 3 );

				// add filter for edit menu walker (admin page)
				add_filter( 'wp_edit_nav_menu_walker', array($this, 'df_edit_nav_menu_walker'), 10, 2 );
			}

			add_filter( 'wp_nav_menu_objects', array( $this, 'df_generate_nav_menu_object' ), 10, 2 );

	   		add_action( 'wp_ajax_nopriv_getNextPage', array( $this, 'getNextPage' ) );
	   		add_action( 'wp_ajax_getNextPage', array( $this, 'getNextPage' ) );

	   		add_action( 'wp_ajax_nopriv_getPrevPage', array( $this, 'getPrevPage' ) );
	   		add_action( 'wp_ajax_getPrevPage', array( $this, 'getPrevPage' ) );

	   		add_action( 'df_generate_megamenu', array( $this, 'df_generate_megamenu' ), 10, 1 );
	   		add_action( 'df_generate_topbar', array( $this, 'df_generate_topbar' ) );
	   		add_action( 'df_generate_mobile_menu', array( $this, 'df_generate_mobile_menu' ) );
		}
		// end of constructor 
		
		/**
		 * set_page
		 * function to set page number
		 * @param $pagenumber
		 * @return - 
		 */
		function df_set_current_page($pagenumber){
			$this->current_page = $pagenumber;
		}

		/**
		 * get_page
		 * function to get page number
		 * @param -
		 * @return $this->page
		 */
		function df_get_current_page(){
			return $this->current_page;
		}

		/**
		 * set_found_posts
		 * set found_posts 
		 * @param $found
		 * @return -
		 */
		function df_set_found_posts($found){
			$this->found_posts = $found;
		}

		/**
		 * get_found_posts
		 * get found_posts number
		 * @param - 
		 * @return $found_posts
		 */
		function df_get_found_posts(){
			return $this->found_posts;
		}

		/**
		 * set_total_pages
		 * set total page from [max_number_pages]
		 * @param $total
		 * @return -
		 */
		function df_set_total_pages($total){
			$this->total_pages = $total;
		}

		/**
		 * df_get_total_pages()
		 * get total pages value
		 * @param -
		 * @return $total_pages
		 */
		function df_get_total_pages(){
			return $this->total_pages;
		}

	    /**
		 * df_register_topbar
		 * function for register topbar menu position to wordpress 
		 */
		function df_register_topbar() {

			register_nav_menus(
				array(
					'top-bar' => __( 'Top Bar', 'onfleek' )
				)
			);

		}

		function df_set_boxed( $boxed ){
			$this->boxed_no_padding = $boxed;
		}

		function df_get_boxed(){
			return $this->boxed_no_padding;
		}

	    /**
	     * df_generate_megamenu
	     * @param -
	     * @return $out
	     */
	    function df_generate_megamenu( $params ){
	    	extract( $params );
	    	//if( $boxed_no_padding != '' ){
	    	if( isset( $boxed_no_padding ) ){
	    		$this->df_set_boxed( $boxed_no_padding );	    		
	    	}else{
	    		$this->df_set_boxed( '' );
	    	}
            if( isset( $boxed_wrapper ) ){
                $this->boxed_wrapper = $boxed_wrapper;
            }
	    	// $this->df_set_boxed( $boxed_no_padding );

			if( class_exists( 'DF_Megamenu_Walker' ) ){
				$params_menu =  array(
							'theme_location' 	=> 'primary', 
							'menu_id' 			=> 'df-primary-menu-megadropdown' , 
							'menu' 				=> 'main',  
							'walker' 			=> new DF_Megamenu_Walker, // DF_Megamenu_Walker for megamenu 
							'menu_class' 		=> 'nav navbar-nav df-megadropdown df-navbar-nav lazy-wrapper '. ( ( isset( $df_navbar_center ) ) ? $df_navbar_center: "") , 
							'container'			=> false,
							'fallback_cb'		=> true
				);

			}else{
				$params_menu = array(
							'theme_location' 	=> 'primary', 
							'menu_id' 			=> 'df-primary-menu-megadropdown',
							'menu' 				=> 'main',
							'menu_class'		=> 'nav navbar-nav df-navbar-main lazy-wrapper',
							'container' 		=> false,
							'fallback_cb'		=> true
				);
			}
			echo wp_nav_menu( $params_menu );
	    }

	   
	    /**
		 * df_generate_topbar
		 * function for generate topbar menu
		 */
		function df_generate_topbar() {
			if( class_exists( 'DF_Topbar_Walker' ) ){
				$params_topbar = array(
					'theme_location'=> 'top-bar',
					'container' 	=> false,
					'menu_class'  	=> 'df-top-bar-left pull-left no-padding ',
					'walker' 		=> new DF_Topbar_Walker,
					'fallback_cb' 	=> true
				);
			}else{
				$params_topbar = array(
					'theme_location' => 'top-bar',
					'container' => false,
					'menu_class' => 'df-top-bar-left pull-left ',
					'fallback_cb' 	=> true
				);
			}
			echo wp_nav_menu( $params_topbar );
		}		

		/** 
		 * df_generate_megamenu
		 * do_action('df_generate_megamenu')
		 */
		static function df_call_megamenu( $params ){

			do_action( 'df_generate_megamenu', $params );

		}

		/**
		 * df_call_topbar
		 * function for call topbar / execute action 'df_generate_topbar'
		 */
		static function df_call_topbar() {

			do_action( 'df_generate_topbar' );

		}

		/*
		 * save custom field 
		 * md_update_custom_category
		 * @param $menu_id
		 * @param $menu_item_db_id
		 * @param args
		 */
		function df_update_custom_category( $menu_id, $menu_item_db_id, $args ){
			if( isset( $_POST['megadropdown_menu_cat'][$menu_item_db_id] ) ){
				update_post_meta( $menu_item_db_id, 'megadropdown_menu_cat', $_POST['megadropdown_menu_cat'][$menu_item_db_id] );
			}
			if( isset( $_POST['megadropdown_menu_style'][$menu_item_db_id]) ){
				update_post_meta( $menu_item_db_id, 'megadropdown_menu_style', $_POST['megadropdown_menu_style'][$menu_item_db_id] );
			}
		}

		/*
		 * edit / custom field in admin
		 * md_edit_nav_menu_walker
		 * @param $walker
		 * @param $menu_id
		 */
		function df_edit_nav_menu_walker( $walker, $menu_id ){
			// walker_nav_menu_edit_custom from edit_custom_walker.php
			$menu_locations = get_nav_menu_locations();
  			if( !isset( $menu_locations['primary']) ){
  				// return $walker;
  				return 'Walker_Nav_Menu_Edit_Custom'; 
  			}else if( !isset( $menu_locations['top-bar']) ){
  				$primary_nav_obj = get_term( $menu_locations['primary'], 'nav_menu' );
  				if( $primary_nav_obj->term_id == $menu_id ){
  					return 'Walker_Nav_Menu_Edit_Custom';
  				}else{
  					return $walker;	
  				}
  				
  			}else{
  				$primary_nav_obj = get_term( $menu_locations['primary'], 'nav_menu' );
  				$topbar_nav_obj = get_term( $menu_locations['top-bar'], 'nav_menu' );
  				// echo "menu id:" .$menu_id . '<br>';
  				// echo "primary".$primary_nav_obj;
  				if( $primary_nav_obj->term_id == $menu_id ){
	  				return 'Walker_Nav_Menu_Edit_Custom'; 
	  			}elseif( $topbar_nav_obj->term_id == $menu_id ){
	  				return 'Walker_Nav_Menu_Topbar';
	  			}else{
	  				return $walker;
	  			}
  			}
		}

		function df_get_sub_cat_posts($args) {
			$category = get_categories($args); 
			return $category;
		}

		/*
		 * add mega menu support
		 * @param $items
		 * @param $args
		 * @return array
		 */
		function df_generate_nav_menu_object($items, $args = '') {
			$output_items = array();
			$category_key_post_meta = 'megadropdown_menu_cat';
			$megadropdown_style_key_post_meta = 'megadropdown_menu_style';
			// $posts_per_page = 4; // DEFAULT VALUE | OR limit FOR query

			$has_sub_cat; 

			$no_item = 1;
			foreach ($items as &$item) {
				$item->is_mega_menu = false;
                $item->megamenu = false;
				
				$megadropdown_menu_cat = get_post_meta($item->ID, $category_key_post_meta, true);
				$megadropdown_style = get_post_meta( $item->ID, $megadropdown_style_key_post_meta, true );

				if($megadropdown_menu_cat != ''){
                    $item->megamenu = true;
                    $item->boxed_wrapper = $this->boxed_wrapper;
					$sub_args = array(
						'parent' => $megadropdown_menu_cat
					);
					$sub_cat = $this->df_get_sub_cat_posts($sub_args);

					// $sizeof = (sizeof($sub_cat) == 0) ? 'no sub' : 'has sub categories with post';

					$item->classes[] = 'df-md-menuitem';
					$item->classes[] = 'df-is-megamenu dropdown';

					$output_items[] = $item;

					// generate wp post
					$new_output_item = $this->df_generate_post(); // generate menu item
					$new_output_item->is_mega_menu = true;
					$new_output_item->menu_item_parent = $item->ID;
					$new_output_item->cat_id = $megadropdown_menu_cat; // category id
					$new_output_item->no_item = $no_item;
					$new_output_item->url = '';
                    
					$posts_per_page = (sizeof($sub_cat) == 0) ? 5 : 4;
					$style_sub_cat = '';
					// open tag for megamenu
					$new_output_item->title = '<div class="df-wraper-box-megamenu  '.$this->df_get_boxed().'">';

					if( empty($megadropdown_style) ){
						$megadropdown_style = '1';
					}
					if( $megadropdown_style == '1' ){
						$megastyle = 'df-mega-style-1';
					}else if( $megadropdown_style == '2' ){
						$megastyle = 'df-mega-style-2';
					}else{
						$megastyle = 'df-mega-no-style';
					}
                    
					$new_output_item->title .= '<div class="'. $megastyle .' df-block-megamenu df-block-megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">'; 
					
					$new_output_item->title .= '<div class="row row-megamenu">'; // open tag for row
    

					if(sizeof($sub_cat) == 0){ // if cat has no sub-cat with posts
						$megadropdown_style = '';
						$has_sub_cat = 'false'; // 

						$offset = $this->df_get_offset($this->df_get_current_page(), $posts_per_page);

						// loading div container
						$new_output_item->title .= '<div class="df-loading df-loading-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'"><div class="la-ball-pulse"><div></div><div></div><div></div></div></div>';
						// open tag for inner megamenu
						$new_output_item->title .= '<div class="df-block-inner-megamenu df-block-inner-megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">'; 

						// query post by category
						$querypostbyCat = $this->df_get_posts_by_cat($megadropdown_menu_cat, $posts_per_page, $offset);

						// set found_posts
						$this->df_set_found_posts($querypostbyCat->found_posts);
						// set and passing found_posts to $new_output_item
						$new_output_item->found_posts = $this->df_get_found_posts();
						$this->df_set_total_pages($querypostbyCat->max_num_pages);

						$new_output_item->current_page = $this->df_get_current_page();
						$new_output_item->last_page = $this->df_get_total_pages();

						$new_output_item->offset = $offset;

						$new_output_item->title .= '<input type="hidden" name="df-total-pages-'.esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_total_pages() ) .'" class="df-total-pages-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
						$new_output_item->title .= '<input type="hidden" name="df-posts-per-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $posts_per_page ) .'" class="df-posts-per-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
						$new_output_item->title .= '<input type="hidden" name="df-current-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_current_page() ) .'" class="df-current-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
						$new_output_item->title .= '<input type="hidden" name="df-has-sub-cat-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $has_sub_cat ) .'" class="df-has-sub-cat-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
						$new_output_item->title .= '<input type="hidden" name="df-mega-style-'. esc_attr( $megadropdown_menu_cat ).'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $megadropdown_style ) .'" class="df-mega-style-'. esc_attr( $megadropdown_menu_cat ) .'-'.esc_attr( $no_item ) .'" >';
						
						// render result query
						$new_output_item->title .= $this->df_render_inner($querypostbyCat->posts, $megadropdown_menu_cat, $no_item, $has_sub_cat, $megadropdown_style );

						$new_output_item->title .= '</div>'; // close tag for inner megamenu

					}else{// if cat has sub-cat with posts
						$has_sub_cat = 'true';
						
						if( $megadropdown_style != '' ){
							if( $megadropdown_style == '1' ){
								// for style 1
								// load sub categories as navigation
								$new_output_item->title .= '<div class="megamenu-col-1 df-subcat-stack">';
								// $new_output_item->title .= '<ul class="nav nav-stacked df-megamenu-nav-sub" id="megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">';
								// $new_output_item->title .= '<ul class="nav nav-stacked df-megamenu-nav-sub section-sub-stack" id="megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">';
								$new_output_item->title .= '<ul class="df-megamenu-nav-sub section-sub-stack" id="megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">';
								$new_output_item->title .= '<li class="active">';
								// $new_output_item->title .= '<a data-target="#df-pane-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">All</a>';
								$new_output_item->title .= '<a data-toggle="tab" data-target="#df-pane-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">All</a>';
								$new_output_item->title .= '</li>';
								foreach($sub_cat as $sc){
									$new_output_item->title .= '<li class="">';
										$new_output_item->title .= '<a data-toggle="tab" data-target="#df-pane-'.esc_attr( $sc->cat_ID ).'-'.esc_attr( $no_item ).'" class="">'.$sc->cat_name.'</a>';
									$new_output_item->title .= '</li>';
								}
								$new_output_item->title .= '</ul>';
								$new_output_item->title .= '</div>';
								// load sub categories end here

								$offset = $this->df_get_offset($this->df_get_current_page(), $posts_per_page);

								$querypostbyCat = $this->df_get_posts_by_cat($megadropdown_menu_cat, $posts_per_page, $offset);
								
								// load content posts here
								$new_output_item->title .= '<div class="df-container-tab-content megamenu-col-4 df-container-tab-content-style-1">'; // open tag for col-md-9 (container of tab content)
								$new_output_item->title .= '<div class="tab-content tab-content-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">'; // open tag for tab content

								// open tag for tab-content_inner / pane
								$new_output_item->title .= '<div id="df-pane-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'" class="tab-pane fade active in df-tab-content-inner-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">'; 

								// set found_posts
								$this->df_set_found_posts($querypostbyCat->found_posts);
								$new_output_item->found_posts = $this->df_get_found_posts();
								$this->df_set_total_pages($querypostbyCat->max_num_pages);

				           		$new_output_item->title .= '<div class="row-inner row-megamenu">';// open tag for row block inner megamenu

								// loading div container
								$new_output_item->title .= '<div class="df-loading df-loading-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'"><div class="la-ball-pulse"><div></div><div></div><div></div></div></div>';
								//  open tag for block inner megamenu
								$new_output_item->title .= '<div class="df-block-inner-megamenu df-block-inner-megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">'; 
								$new_output_item->title .= '<input type="hidden" name="df-total-pages-'.esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_total_pages() ) .'" class="df-total-pages-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
								$new_output_item->title .= '<input type="hidden" name="df-posts-per-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $posts_per_page ) .'" class="df-posts-per-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
								$new_output_item->title .= '<input type="hidden" name="df-current-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_current_page() ) .'" class="df-current-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
								$new_output_item->title .= '<input type="hidden" name="df-has-sub-cat-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $has_sub_cat ) .'" class="df-has-sub-cat-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
								$new_output_item->title .= '<input type="hidden" name="df-mega-style-'. esc_attr( $megadropdown_menu_cat ).'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $megadropdown_style ) .'" class="df-mega-style-'. esc_attr( $megadropdown_menu_cat ) .'-'.esc_attr( $no_item ) .'" >';

								$new_output_item->title .= $this->df_render_inner($querypostbyCat->posts, $megadropdown_menu_cat, $no_item, 'true', $megadropdown_style );
								$new_output_item->title .= '</div>'; // close tag for block inner megamenu

								$new_output_item->title .= '</div>';// close tag for row block inner megamenu

								if($this->df_get_found_posts() > 4){
			    					$stylefirst = 'pointer-events: none; cursor: default; color: #ccc';
			    					$link_cat = get_category_link( esc_attr( $megadropdown_menu_cat ) );
					       			$new_output_item->title .= '<div class="row row-nav-subcat">
					       							<div class="row_next_prev hidden-xs row_next_prev-'.esc_attr($megadropdown_menu_cat).'-'.esc_attr($no_item).'">
							       						<div class="" style="float:left; width:8%;">
							       							<a href="#" style="'.$stylefirst.'" data-cat="'.esc_attr($megadropdown_menu_cat).'" data-item="'.esc_attr($no_item).'" id="prev-'.esc_attr($megadropdown_menu_cat).'-'.esc_attr($no_item).'" class="prev_megamenu"><i class="ion-chevron-left"></i></a>
							       							<a href="#" style="" data-cat="'.esc_attr($megadropdown_menu_cat).'" data-item="'.esc_attr($no_item).'" id="next-'.esc_attr($megadropdown_menu_cat).'-'.esc_attr($no_item).'" class="next_megamenu"><i class="ion-chevron-right"></i></a>
							       						</div>
							       						<div class="" style="float:left; width:83%; margin-top:-10px;">
															<hr/>
					                                    </div>
					                                    <div class="" style="float:left; width:9%;text-align:right;">
															<a href="'.$link_cat.'" style="font-size:11px;">See All</a>
					                                    </div>
							       					</div>
						                            </div>';
				           		}else{
				           			$new_output_item->title .= '<div class="row row-nav-subcat" style="">
					       							<div class="row_next_prev hidden-xs row_next_prev-'.esc_attr($megadropdown_menu_cat).'-'.esc_attr($no_item).'">
							       						<div class="" style="">
							       							
							       						</div>
							       					</div>
						                            </div>';
				           		}

								$new_output_item->title .= '</div>'; // close tag for tab-content_inner / pane
								foreach ($sub_cat as $countersc) {
									// $new_output_item->title .= $countersc->cat_ID;
									$new_output_item->title .= '<div id="df-pane-'.$countersc->cat_ID.'-'.$no_item.'" class="tab-pane fade df-tab-content-inner-'.$countersc->cat_ID.'-'.$no_item.'">'; // open tag for tab-content_inner
									// query post by category
									$querypostbyCat = $this->df_get_posts_by_cat($countersc->cat_ID, $posts_per_page, $offset);

									// set found_posts
									$this->df_set_found_posts($querypostbyCat->found_posts);
									$new_output_item->found_posts = $this->df_get_found_posts();
									$this->df_set_total_pages($querypostbyCat->max_num_pages);

					           		$new_output_item->title .= '<div class="row-inner row-megamenu">';// open tag for row block inner megamenu
									// open tag for inner megamenu
									$new_output_item->title .= '<div class="df-loading df-loading-'.esc_attr( $countersc->cat_ID  ).'-'.esc_attr( $no_item ).'"><div class="la-ball-pulse"><div></div><div></div><div></div></div></div>';

									$new_output_item->title .= '<div class="df-block-inner-megamenu df-block-inner-megamenu-'.esc_attr( $countersc->cat_ID ).'-'.esc_attr( $no_item ).'">'; // open tag for block inner megamenu
									$new_output_item->title .= '<input type="hidden" name="df-total-pages-'.esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_total_pages() ) .'" class="df-total-pages-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'">';
									$new_output_item->title .= '<input type="hidden" name="df-posts-per-page-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $posts_per_page ) .'" class="df-posts-per-page-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'">';
									$new_output_item->title .= '<input type="hidden" name="df-current-page-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_current_page() ) .'" class="df-current-page-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'">';
									$new_output_item->title .= '<input type="hidden" name="df-has-sub-cat-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $has_sub_cat ) .'" class="df-has-sub-cat-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'">';
									$new_output_item->title .= '<input type="hidden" name="df-mega-style-'. esc_attr( $countersc->cat_ID ).'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $megadropdown_style ) .'" class="df-mega-style-'. esc_attr( $countersc->cat_ID ) .'-'.esc_attr( $no_item ) .'" >';

									$new_output_item->title .= $this->df_render_inner( $querypostbyCat->posts, $countersc->cat_ID, $no_item, $has_sub_cat, $megadropdown_style );
									$new_output_item->title .= '</div>'; // close tag for block inner megamenu

									$new_output_item->title .= '</div>';// close tag for row block inner megamenu

									if($this->df_get_found_posts() > 4){
				    					$stylefirst = 'pointer-events: none; cursor: default; color: #ccc';
				    					$link_cat = get_category_link( esc_attr( esc_attr($countersc->cat_ID) ) );
						       			$new_output_item->title .= '<div class="row row-nav-subcat">
						       								<div class="row_next_prev hidden-xs row_next_prev-'.esc_attr($countersc->cat_ID).'-'.esc_attr($no_item).'">
					       										<div class="" style="float:left; width:8%;">
					       											<a href="#" style="'.$stylefirst.'" data-cat="'.esc_attr($countersc->cat_ID).'" data-item="'.esc_attr($no_item).'" id="prev-'.esc_attr($countersc->cat_ID).'-'.esc_attr($no_item).'" class="prev_megamenu"><i class="ion-chevron-left"></i></a>
					       											<a href="#" style="" data-cat="'.esc_attr($countersc->cat_ID).'" data-item="'.esc_attr($no_item).'" id="next-'.esc_attr($countersc->cat_ID).'-'.esc_attr($no_item).'" class="next_megamenu"><i class="ion-chevron-right"></i></a>
					       										</div>
					       										<div class="" style="float:left; width:83%; margin-top:-10px;">
																	<hr/>
							                                    </div>
							                                    <div class="" style="float:left; width:9%;text-align:right;">
																	<a href="'.$link_cat.'" style="font-size:11px; ">See All</a>
							                                    </div>
					       									</div>
				                            				</div>';
					           		}else{
					           			$new_output_item->title .= '<div class="row row-nav-subcat">
						       								<div class="row_next_prev hidden-xs row_next_prev-'.esc_attr($countersc->cat_ID).'-'.esc_attr($no_item).'">
					       										<div class="" style="">
					       											
					       										</div>
					       									</div>
				                            				</div>';
					           		}


									$new_output_item->title .= '</div>'; // close tag for tab-content_inner
								}
								$new_output_item->title .= '</div>'; // close tag for tab content 
								$new_output_item->title .= '</div>'; // close tag for col-md-9 (container of tab content)
								// load content posts end here
							}else{
								// for style 2
								$posts_per_page = 5;
								// load sub categories as navigation
								$new_output_item->title .= '<div class="df-subcat-pills">';
								// $new_output_item->title .= '<ul class="nav nav-pills df-megamenu-nav-sub" id="megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">';
								// $new_output_item->title .= '<ul class="nav nav-pills list-inline df-megamenu-nav-sub section-sub-inline" id="megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">';
								$new_output_item->title .= '<ul class="list-inline df-megamenu-nav-sub section-sub-inline" id="megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">';
								$new_output_item->title .= '<li class="active">';
								// $new_output_item->title .= '<a data-target="#df-pane-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">All</a>';
								$new_output_item->title .= '<a data-toggle="tab" data-target="#df-pane-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">All</a>';
								$new_output_item->title .= '</li>';
								foreach($sub_cat as $sc){
									$new_output_item->title .= '<li class="">';
										$new_output_item->title .= '<a data-toggle="tab" data-target="#df-pane-'.esc_attr( $sc->cat_ID ).'-'.esc_attr( $no_item ).'" class="">'.$sc->cat_name.'</a>';
									$new_output_item->title .= '</li>';
								}
								$new_output_item->title .= '</ul>';
								$new_output_item->title .= '</div>';
								// load sub categories end here

								$offset = $this->df_get_offset($this->df_get_current_page(), $posts_per_page);

								$querypostbyCat = $this->df_get_posts_by_cat($megadropdown_menu_cat, $posts_per_page, $offset);
								
								// load content posts here
								$new_output_item->title .= '<div class="df-container-tab-content df-container-tab-content-style-2">'; // open tag for col-md-9 (container of tab content)
								$new_output_item->title .= '<div class="tab-content tab-content-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">'; // open tag for tab content

								// open tag for tab-content_inner / pane
								$new_output_item->title .= '<div id="df-pane-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'" class="tab-pane fade active in df-tab-content-inner-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">'; 

								// set found_posts
								$this->df_set_found_posts($querypostbyCat->found_posts);
								$new_output_item->found_posts = $this->df_get_found_posts();
								$this->df_set_total_pages($querypostbyCat->max_num_pages);

				           		$new_output_item->title .= '<div class="row-inner row-megamenu">';// open tag for row block inner megamenu

								// loading div container
								$new_output_item->title .= '<div class="df-loading df-loading-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'"><div class="la-ball-pulse"><div></div><div></div><div></div></div></div>';
								//  open tag for block inner megamenu
								$new_output_item->title .= '<div class="df-block-inner-megamenu df-block-inner-megamenu-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">'; 
								$new_output_item->title .= '<input type="hidden" name="df-total-pages-'.esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_total_pages() ) .'" class="df-total-pages-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
								$new_output_item->title .= '<input type="hidden" name="df-posts-per-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $posts_per_page ) .'" class="df-posts-per-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
								$new_output_item->title .= '<input type="hidden" name="df-current-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_current_page() ) .'" class="df-current-page-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
								$new_output_item->title .= '<input type="hidden" name="df-has-sub-cat-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $has_sub_cat ) .'" class="df-has-sub-cat-'. esc_attr( $megadropdown_menu_cat ) .'-'. esc_attr( $no_item ) .'">';
								$new_output_item->title .= '<input type="hidden" name="df-mega-style-'. esc_attr( $megadropdown_menu_cat ).'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $megadropdown_style ) .'" class="df-mega-style-'. esc_attr( $megadropdown_menu_cat ) .'-'.esc_attr( $no_item ) .'" >';

								$new_output_item->title .= $this->df_render_inner($querypostbyCat->posts, $megadropdown_menu_cat, $no_item, 'true', $megadropdown_style );
								$new_output_item->title .= '</div>'; // close tag for block inner megamenu

								$new_output_item->title .= '</div>';// close tag for row block inner megamenu

								if($this->df_get_found_posts() > 5){
			    					$stylefirst = 'pointer-events: none; cursor: default; color: #ccc';
			    					$link_cat = get_category_link( esc_attr( $megadropdown_menu_cat ) );
					       			$new_output_item->title .= '<div class="row row-nav-subcat">
					       							<div class="row_next_prev hidden-xs row_next_prev-'.esc_attr($megadropdown_menu_cat).'-'.esc_attr($no_item).'">
							       						<div class="" style="float:left; width:7%;">
							       							<a href="#" style="'.$stylefirst.'" data-cat="'.esc_attr($megadropdown_menu_cat).'" data-item="'.esc_attr($no_item).'" id="prev-'.esc_attr($megadropdown_menu_cat).'-'.esc_attr($no_item).'" class="prev_megamenu"><i class="ion-chevron-left"></i></a>
							       							<a href="#" style="" data-cat="'.esc_attr($megadropdown_menu_cat).'" data-item="'.esc_attr($no_item).'" id="next-'.esc_attr($megadropdown_menu_cat).'-'.esc_attr($no_item).'" class="next_megamenu"><i class="ion-chevron-right"></i></a>
							       						</div>
							       						<div class="" style="float:left; width:84%; margin-top:-10px;">
															<hr/>
					                                    </div>
					                                    <div class="" style="float:left; width:9%;text-align:right;">
															<a href="'.$link_cat.'" style="font-size:11px;">See All</a>
					                                    </div>
							       					</div>
						                            </div>';
				           		}else{
				           			$new_output_item->title .= '<div class="row row-nav-subcat" style="">
					       							<div class="row_next_prev hidden-xs row_next_prev-'.esc_attr($megadropdown_menu_cat).'-'.esc_attr($no_item).'">
							       						<div class="" style="">
							       							
							       						</div>
							       					</div>
						                            </div>';
				           		}

								$new_output_item->title .= '</div>'; // close tag for tab-content_inner / pane
								foreach ($sub_cat as $countersc) {
									// $new_output_item->title .= $countersc->cat_ID;


									$new_output_item->title .= '<div id="df-pane-'.$countersc->cat_ID.'-'.$no_item.'" class="tab-pane fade df-tab-content-inner-'.$countersc->cat_ID.'-'.$no_item.'">'; // open tag for tab-content_inner
									// query post by category
									$querypostbyCat = $this->df_get_posts_by_cat($countersc->cat_ID, $posts_per_page, $offset);

									// set found_posts
									$this->df_set_found_posts($querypostbyCat->found_posts);
									$new_output_item->found_posts = $this->df_get_found_posts();
									$this->df_set_total_pages($querypostbyCat->max_num_pages);

					           		$new_output_item->title .= '<div class="row-inner row-megamenu">';// open tag for row block inner megamenu
									// open tag for inner megamenu
									$new_output_item->title .= '<div class="df-loading df-loading-'.esc_attr( $countersc->cat_ID  ).'-'.esc_attr( $no_item ).'"><div class="la-ball-pulse"><div></div><div></div><div></div></div></div>';

									$new_output_item->title .= '<div class="df-block-inner-megamenu df-block-inner-megamenu-'.esc_attr( $countersc->cat_ID ).'-'.esc_attr( $no_item ).'">'; // open tag for block inner megamenu
									$new_output_item->title .= '<input type="hidden" name="df-total-pages-'.esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_total_pages() ) .'" class="df-total-pages-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'">';
									$new_output_item->title .= '<input type="hidden" name="df-posts-per-page-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $posts_per_page ) .'" class="df-posts-per-page-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'">';
									$new_output_item->title .= '<input type="hidden" name="df-current-page-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $this->df_get_current_page() ) .'" class="df-current-page-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'">';
									$new_output_item->title .= '<input type="hidden" name="df-has-sub-cat-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $has_sub_cat ) .'" class="df-has-sub-cat-'. esc_attr( $countersc->cat_ID ) .'-'. esc_attr( $no_item ) .'">';
									$new_output_item->title .= '<input type="hidden" name="df-mega-style-'. esc_attr( $countersc->cat_ID ).'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $megadropdown_style ) .'" class="df-mega-style-'. esc_attr( $countersc->cat_ID ) .'-'.esc_attr( $no_item ) .'" >';

									$new_output_item->title .= $this->df_render_inner($querypostbyCat->posts, $countersc->cat_ID, $no_item, $has_sub_cat, $megadropdown_style );
									$new_output_item->title .= '</div>'; // close tag for block inner megamenu

									$new_output_item->title .= '</div>';// close tag for row block inner megamenu

									if($this->df_get_found_posts() > 5){
				    					$stylefirst = 'pointer-events: none; cursor: default; color: #ccc';
				    					$link_cat = get_category_link( esc_attr( esc_attr($countersc->cat_ID) ) );
						       			$new_output_item->title .= '<div class="row row-nav-subcat">
						       								<div class="row_next_prev hidden-xs row_next_prev-'.esc_attr($countersc->cat_ID).'-'.esc_attr($no_item).'">
					       										<div class="" style="float:left; width:7%;">
					       											<a href="#" style="'.$stylefirst.'" data-cat="'.esc_attr($countersc->cat_ID).'" data-item="'.esc_attr($no_item).'" id="prev-'.esc_attr($countersc->cat_ID).'-'.esc_attr($no_item).'" class="prev_megamenu"><i class="ion-chevron-left"></i></a>
					       											<a href="#" style="" data-cat="'.esc_attr($countersc->cat_ID).'" data-item="'.esc_attr($no_item).'" id="next-'.esc_attr($countersc->cat_ID).'-'.esc_attr($no_item).'" class="next_megamenu"><i class="ion-chevron-right"></i></a>
					       										</div>
					       										<div class="" style="float:left; width:86%; margin-top:-10px;">
																	<hr/>
							                                    </div>
							                                    <div class="" style="float:left; width:7%;text-align:right;">
																	<a href="'.$link_cat.'" style="font-size:11px; ">See All</a>
							                                    </div>
					       									</div>
				                            				</div>';
					           		}else{
					           			$new_output_item->title .= '<div class="row row-nav-subcat">
						       								<div class="row_next_prev hidden-xs row_next_prev-'.esc_attr($countersc->cat_ID).'-'.esc_attr($no_item).'">
					       										<div class="" style="">
					       											
					       										</div>
					       									</div>
				                            				</div>';
					           		}
									$new_output_item->title .= '</div>'; // close tag for tab-content_inner
								}
								$new_output_item->title .= '</div>'; // close tag for tab content 
								$new_output_item->title .= '</div>'; // close tag for col-md-9 (container of tab content)
								// load content posts end here
							}
						}
						// loading div container
						// $new_output_item->title .= '<div class="df-loading df-loading-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">LOADING</div>';
					}

					$new_output_item->title .= '</div>'; // close tag for row
					$new_output_item->title .= '</div>'; // close tag for megamenu

					$new_output_item->title .= '</div>';

					if(sizeof($sub_cat) == 0){
						$boxed='';
						$padding = '';
						// if($item->is_mega_menu == '1'){
			            if($this->df_get_found_posts() > 5){
			            	$link_cat = get_category_link( esc_attr( $megadropdown_menu_cat ) );
			                $stylefirst = 'pointer-events: none; cursor: default; color: #ccc';

			                if( $this->boxed_no_padding != ''){
			                	$boxed = 'boxed';
			                	$padding = 'padding-left:36px; padding-right:36px;';
			                }else{
			                	$boxed = '';
			                }
			                
			                $new_output_item->title .= '<div class="row row-nav-no-subcat '.$boxed.'" style="'.$padding.'">
			                                <div class="row_next_prev hidden-xs row_next_prev-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'">
			                                    <div class="" style="float:left; width:7%;">
			                                        <a href="#" style="'.$stylefirst.'" data-cat="'.esc_attr( $megadropdown_menu_cat ).'" data-item="'.esc_attr( $no_item ).'" id="prev-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'" class="prev_megamenu"><i class="ion-chevron-left"></i></a>
			                                        <a href="#" style="" data-cat="'.esc_attr( $megadropdown_menu_cat ).'" data-item="'.esc_attr( $no_item ).'" id="next-'.esc_attr( $megadropdown_menu_cat ).'-'.esc_attr( $no_item ).'" class="next_megamenu"><i class="ion-chevron-right"></i></a>
			                                    </div>
			                                    <div class="" style="float:left; width:84%; margin-top:-10px;">
													<hr/>
			                                    </div>
			                                    <div class="" style="float:left; width:9%;text-align:right;">
													<a href="'.$link_cat.'" style="font-size:11px; ">See All</a>
			                                    </div>
			                                </div>
			                            </div>';
			            }
				        // }
					}
					$output_items[] = $new_output_item;
				}else{
					$item->classes[] = 'df-md-menuitem';
					$item->classes[] = 'dropdown df-is-not-megamenu';
					$item->megamenu = false;
					$output_items[] = $item;
				}
				$no_item++;
			}
			return $output_items;
		}

		/**
		 * get_posts_by_cat
		 * @param $cat
		 * @param $posts_per_page
		 * @param $offset
		 * @return WP_Query Object
		 */
		function df_get_posts_by_cat($cat, $posts_per_page, $offset){
			$params = array(
					'cat' => $cat,
					'posts_per_page' => $posts_per_page,
					'offset' => $offset,
					'post_status' => array( 'publish' ),
				);
			return new WP_Query($params);
		}

		/**
		 * get_offset
		 * get offset for pagination
		 * @param $posts_per_page
		 * @param $current_page
		 * ($this->df_get_current_page() * $posts_per_page) - $posts_per_page;
		 * @return
		 */
		function df_get_offset($current_page, $posts_per_page){
			return ($current_page * $posts_per_page) - $posts_per_page;
		}

		/**
		 * df_generate_post
		 * @param -
		 * @return WP_Post()
		 */
		function df_generate_post() {
	        $post = new stdClass;
	        $post->ID = '0';
	        $post->post_author = '';
	        $post->post_date = '';
	        $post->post_date_gmt = '';
	        $post->post_password = '';
	        $post->post_type = 'nav_menu_item';
	        $post->post_status = 'publish';
	        $post->to_ping = '';
	        $post->pinged = '';
	        $post->comment_status = '';
	        $post->ping_status = '';
	        $post->post_pingback = '';
	        //$post->post_category = '';
	        $post->page_template = 'default';
	        $post->post_parent = 0;
	        $post->menu_order = 0;
	        return new WP_Post($post);
	    }
	     /**
	      * render inner post
	      * @param $posts
	      * @return div megamenu 
	      */
	    function df_render_inner($posts, $cat_id, $no_item, $has_sub_cat, $megadropdown_style = '' ){
	    	$out = '';
	    	
	    	if(!empty($posts)) {

	    		if($has_sub_cat == 'false'){
	    			$out .= '<div class="megamenu-grid-container-'.esc_attr($cat_id).'-'.esc_attr($no_item).'">';
		    		$counter = 1;
		    		foreach ($posts as $post) {
		    			$out .= '<div class="megamenu-span megamenu-col-1">';
		    			$out .= '<a href="'. $this->df_get_href($post) .'" >';
		    			$out .= '<div class="wrapper-img-megamenu">';
		    			$out .= $this->df_image_post($post->ID);
		    			$out .= '</div>';
		    			$out .= '<p class="megamenu-item-title">'. $post->post_title .'</p>';
		    			$out .= '</a>';
		    			$out .= '<p class="post-meta megamenu-item-date">'. date("F d, Y",strtotime($post->post_date)) .'</p>';
		    			$out .= '</div>';
		    			$counter++;
		    		}
		    		$out .= '</div>';
	    		}else{
	    			// if( $megadropdown_style != '' ){
	    				if( $megadropdown_style == '2' ){
	    					$col = 'megamenu-col-1';
	    					
	    					$out .= '<div class="row row-megamenu megamenu-grid-container-'.esc_attr($cat_id).'-'.esc_attr($no_item).'">';
				    		foreach ($posts as $post) {
				    			$out .= '<div class="megamenu-span '.esc_attr( $col ).'">';
				    			$out .= '<a href="'. $this->df_get_href($post) .'" >';
				    			$out .= '<div class="wrapper-img-megamenu">';
				    			$out .= $this->df_image_post($post->ID);
				    			$out .= '</div>';
				    			$out .= '<p class="megamenu-item-title">'.$post->post_title.'</p>';
				    			$out .= '</a>';
				    			$out .= '<p class="post-meta megamenu-item-date">'. date( "F d, Y",strtotime($post->post_date) ) .'</p>';
				    			$out .= '</div>';
				    		}
				    		$out .= '</div>';
		    			}else{
		    				$col = 'megamenu-col-4-inner';
		    				$out .= '<div class="row row-megamenu megamenu-grid-container-'.esc_attr($cat_id).'-'.esc_attr($no_item).'">';
				    		foreach ($posts as $post) {
				    			$out .= '<div class="megamenu-span '.esc_attr( $col ).'">';
				    			$out .= '<a href="'. $this->df_get_href($post) .'" >';
				    			$out .= '<div class="wrapper-img-megamenu">';
				    			$out .= $this->df_image_post($post->ID);
				    			$out .= '</div>';
				    			$out .= '<p class="megamenu-item-title">'.$post->post_title.'</p>';
				    			$out .= '</a>';
				    			$out .= '<p class="post-meta megamenu-item-date">'. date( "F d, Y",strtotime($post->post_date) ) .'</p>';
				    			$out .= '</div>';
				    		}
				    		$out .= '</div>';
		    			}
	    			// }else{
	    			// 	$out .= '<div class="row row-megamenu megamenu-grid-container-'.esc_attr($cat_id).'-'.esc_attr($no_item).'">';
				    // 	$out .= 'no result';	
				    // 	$out .= '</div>';
		    			
	    			// }
	    		}
	    	}
	    	return $out;
	    }

	    /**
	     * df_image_post
	     * @param $post
	     * @return featured image of post
	     */
	    function df_image_post( $post_id ){
	    	$thumbs='';
	    	if ( has_post_thumbnail( $post_id ) ) {
				$thumbs = get_the_post_thumbnail( $post_id, $size='df_size_376x250', array( 'class' => 'img-responsive center-block' ) );
			} else {
				$image_id = DF_Framework::$default_featured_img_id;
				$thumbs = wp_get_attachment_image( $image_id, $size='df_size_376x250', false, array( 'class' => 'img-responsive center-block' ) );
			}
	    	return $thumbs;
	    }

	    /**
	     * df_get_href
	     * @param $post
	     * @return url / href / permalink of post
	     */
	    function df_get_href($post){
	    	$url='';
	    	return $url = esc_url( get_permalink( $post->ID ) );
	    }

	    /**
	     * df_generate_nextprev_posts
	     * generate prev/next posts in megamenu
	     * @param $args
	     * @return $new_posts
	     */
	    function df_generate_nextprev_posts( $args = array() ){
	    	$no_item = $args['no_item'];
	    	$cat_id = $args['category_id'];
	    	$total_pages = $args['total_pages'];
	    	// $found_posts = $args['found_posts'];
	    	$posts_per_page = $args['posts_per_page'];
	    	$before_page = $args['current_page'];
	    	$has_sub_cat = $args['has_sub_cat'];
	    	$type = $args['type'];
	    	$mega_style = $args['mega_style'];

	    	// type 'next'
	    	if($type == 'next'){
	    		if($before_page == '1' ){
		    		$current_page = $before_page + 1;
		    	}else{
		    		if($before_page <  $total_pages){
		    			$current_page = $before_page + 1;
		    		}else{
		    			$current_page = $total_pages;
		    		}
		    	}
	    	}else{
	    		// type 'prev'
	    		$current_page = $before_page - 1;
	    	}
	    	
	    	$offset = $this->df_get_offset($current_page, $posts_per_page);

	    	$query = $this->df_get_posts_by_cat($cat_id, $posts_per_page, $offset);

	    	if( $query->have_posts() ){
	    		$new_posts = '<div class="df-block-inner-megamenu-'.esc_attr( $cat_id ).'-'.esc_attr( $no_item ).'">';

	    		$new_posts .= '<input type="hidden" name="df-total-pages-'.esc_attr( $cat_id ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $total_pages ) .'" class="df-total-pages-'. esc_attr( $cat_id ) .'-'. esc_attr( $no_item ) .'">';
				$new_posts .= '<input type="hidden" name="df-posts-per-page-'. esc_attr( $cat_id ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $posts_per_page ) .'" class="df-posts-per-page-'. esc_attr( $cat_id ) .'-'. esc_attr( $no_item ) .'">';
				$new_posts .= '<input type="hidden" name="df-current-page-'. esc_attr( $cat_id ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $current_page ) .'" class="df-current-page-'. esc_attr( $cat_id ) .'-'. esc_attr( $no_item ) .'">';
				$new_posts .= '<input type="hidden" name="df-has-sub-cat-'. esc_attr( $cat_id ) .'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $has_sub_cat ) .'" class="df-has-sub-cat-'. esc_attr( $cat_id ) .'-'. esc_attr( $no_item ) .'">';
				$new_posts .= '<input type="hidden" name="df-mega-style-'. esc_attr( $cat_id ).'-'. esc_attr( $no_item ) .'" value="'. esc_attr( $mega_style ) .'" class="df-mega-style-'. esc_attr( $cat_id ) .'-'. esc_attr( $no_item ) .'" >';

	    		$new_posts .= $this->df_render_inner($query->posts, $cat_id, $no_item, $has_sub_cat, $mega_style );

	    		$new_posts .= '</div>';
	    	} else {
	    		$new_posts = '<div class="df-block-inner-megamenu-'.esc_attr( $cat_id ).'-'.esc_attr( $no_item ).'">';
	    		$new_posts .= 'category: '.$cat_id;
	    		$new_posts .= 'posts_per_page: '. $posts_per_page;
	    		$new_posts .= 'offset: '.$offset;
	    		$new_posts .= 'current page: '.$current_page;
	    		$new_posts .= '</div>';
	    		
	    		$new_posts .= json_encode($query->posts);
	    	}
	    	return $new_posts;
	    }

	    /**
	     * getNextPage
	     * @param -
	   	 * @return -
	     */
		function getNextPage(){
			$no_item = $_POST['no_item'];
			$category_id = $_POST['category_id'];
			$total_pages = $_POST['total_pages'];
			$posts_per_page = $_POST['posts_per_page'];
			$current_page = $_POST['current_page'];
			$has_sub_cat = $_POST['has_sub_cat'];
			$type = $_POST['type'];
			$mega_style = $_POST['mega_style'];

			$params = array(
				'no_item' => $no_item,
				'category_id' => $category_id,
				'total_pages' => $total_pages,
				// 'found_posts' => $found_posts,
				'posts_per_page' => $posts_per_page,
				'current_page' => $current_page,
				'has_sub_cat' => $has_sub_cat,
				'type' => $type,
				'mega_style' => $mega_style
				);

			$results = $this->df_generate_nextprev_posts( $params );
			die($results);
		}

		/**
		 * getPrevPage
		 * @param - 
		 * @return -
		 */
		function getPrevPage(){
			$no_item = $_POST['no_item'];
			$category_id = $_POST['category_id'];
			$total_pages = $_POST['total_pages'];
			$posts_per_page = $_POST['posts_per_page'];
			$current_page = $_POST['current_page'];
			$has_sub_cat = $_POST['has_sub_cat'];
			$type = $_POST['type'];
			$mega_style = $_POST['mega_style'];

			$params = array(
				'no_item' => $no_item,
				'category_id' => $category_id,
				'total_pages' => $total_pages,
				// 'found_posts' => $found_posts,
				'posts_per_page' => $posts_per_page,
				'current_page' => $current_page,
				'has_sub_cat' => $has_sub_cat,
				'type' => $type,
				'mega_style' => $mega_style
				);

			$results = $this->df_generate_nextprev_posts( $params );
			die($results);
		}

		/**
		 * df_get_breadcrumb
		 */
		static function df_get_breadcrumb() {
			/**
			 * reference code: http://www.qualitytuts.com/wordpress-custom-breadcrumbs-without-plugin/
			 */
			$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
			$delimiter = ' '; // delimiter between crumbs
			$home = 'Home'; // text for the 'Home' link
			$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
			$before = '<li><a class="active" href="#">'; // tag before the current crumb
			$after = '</a></li>'; // tag after the current crumb
			$general = DF_Options::df_get_general_options();
			$global_options = $general['breadcrumb'];
            $is_home_breadcrumb = $global_options['is_show_home_link'];
            $is_show_parent = $global_options['is_show_parent'];
            $is_show_article_title = $global_options['is_show_article_title'];
			global $post;
			// $homeLink = get_bloginfo('url');
			$homeLink = home_url();
			printf( '<ul class="list-inline entry-crumb">' );
			if (is_home() || is_front_page()) {

			if ($showOnHome == 1) echo '<li><a href="' . $homeLink . '">' . $home . '</a></li>';

			} else {
                if ("yes" == $is_home_breadcrumb  && !is_category() ) {  
				    echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
                }
				if ( is_category() ) {
				  $thisCat = get_category(get_query_var('cat'), false);
				  	// if ($thisCat->parent != 0) echo get_category_parents( $thisCat->parent, TRUE, ' ' . $delimiter . ' ' );
				  	$dv_cat = sprintf( $before . 'Archive by category %s' . $after, single_cat_title('', false ) );
				  	echo $dv_cat;

				} elseif ( is_search() ) {
				  	$dv_search = sprintf( $before . 'Search results for "' . get_search_query() . '"' . $after );
				  	echo $dv_search;
				} elseif ( is_day() ) {
				  	printf( '<li> <a href="' . get_year_link(get_the_time('Y')) . '"> ' . get_the_time('Y') . ' </a> </li> ' . $delimiter . ' ' );
				  	printf( '<li> <a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> </li> ' . $delimiter . ' ' );
				  	printf( $before . get_the_time('d') . $after );

				} elseif ( is_month() ) {
				 	printf( '<li> <a href="' . get_year_link(get_the_time('Y')) . '"> ' . get_the_time('Y') . ' </a> </li> ' . $delimiter . ' ' );
				  	printf( $before . get_the_time('F') . $after );

				} elseif ( is_year() ) {
					printf( $before . get_the_time('Y') . $after );

				} elseif ( is_single() && !is_attachment() ) {
				  if ( get_post_type() != 'post' ) {
				    
				    $post_type = get_post_type_object(get_post_type());
				    $slug = $post_type->rewrite;
				    echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
				    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				} else {
				    global $post;
				    $primary_category = get_post_meta($post->ID, 'df_magz_post_primary_category', true);
                   
                    if ( NULL != $primary_category  ){
                        if ($showCurrent == 0) $primary_category = preg_replace("#^(.+)\s$delimiter\s$#", " $1 ", $primary_category);
                        if ( "yes" == $is_show_parent){
                            echo '<li><a href = '. get_category_link($primary_category) .' >' . get_cat_name( $primary_category ) . '</a></li>';
                        }
				         if ( "yes" == $is_show_article_title){
				            if ($showCurrent == 1) echo  $before . '%s' .$after, get_the_title();
                        }
                    } else {
                        $cat = get_the_category();
                        $cat = $cat[0];
    				    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
    				    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", " $1 ", $cats);
                        if ( "yes" == $is_show_parent){
                                echo '<li>' . $cats . '</li>';
                            }
    				    if ( "yes" == $is_show_article_title){
    				           	if ($showCurrent == 1) echo $before . get_the_title(). $after;
    				    }
                    }
				}

				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				  $post_type = get_post_type_object(get_post_type());
				 echo $before . $post_type->labels->singular_name . $after;

				} elseif ( is_attachment() ) {
				  $parent = get_post($post->post_parent);
				  
				  $cat = get_the_category($parent->ID); 
				  if ( !empty($cat ) ) {
				  	$cat = $cat[0];
				  echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				  echo '<li> <a href="' . get_permalink($parent) . '"> ' . $parent->post_title . '</a> </li>';
				  if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				  }
				  

				} elseif ( is_page() && !$post->post_parent ) {
				  if ($showCurrent == 1) echo $before . get_the_title() . $after;

				} elseif ( is_page() && $post->post_parent ) {
				  	$parent_id  = $post->post_parent;
				  	$breadcrumbs = array();
				  	while ($parent_id) {
					    $page = get_page($parent_id);
					    $breadcrumbs[] = '<li> <a href="' . get_permalink($page->ID) . '"> ' . get_the_title($page->ID) . ' </a> </li>';
					    $parent_id  = $page->post_parent;
				  	}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						echo $breadcrumbs[$i];
						if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
					}
				  	if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

				} elseif ( is_tag() ) {
				  	$dv_tag =  sprintf( $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after );
				  	echo $dv_tag;

				} elseif ( is_author() ) {
				   	global $author;
				  	$userdata = get_userdata($author);
					$dv_auth = sprintf( $before . 'Articles posted by %s'. $after, $userdata->display_name );
					echo $dv_auth;

				} elseif ( is_404() ) {
				 	$dv_404 = sprintf( $before . 'Error 404' . $after );
				 	echo $dv_404;
				}

				echo '<span class="wraper-page-breadcrumb">';
				if ( get_query_var('paged') ) {
				  	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				  	echo __('Page' ,'onfleek') . ' ' . get_query_var('paged');
				  	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
				}
				echo '</span>';

				echo '</ul>';

			}
		}

		/**
		 * df_generate_mobile_menu
		 */
		function df_generate_mobile_menu() {
			$params_mobile_menu = array(
				'theme_location' => 'mobile-menu',
				'container' => 'nav',
				'container_class' => 'df-mobile-menu-wraper',
				'menu_class' => 'df-mobile-menu-inner',
				'fallback_cb' 	=> true,
				'items_wrap'
			);
			echo wp_nav_menu( $params_mobile_menu );
		}

		/**
		 * df_call_mobile_menu
		 */
		static function df_call_mobile_menu() {
			do_action( 'df_generate_mobile_menu' );
		}
	}

	new DF_Megamenu();
}
