<?php
/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl(&$output,  $depth = 0, $args= array()) {	
	}
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl(&$output,  $depth = 0, $args= array()) {
	}
	
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $_wp_nav_menu_max_depth;
	    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
	
	    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	    ob_start();
	    $item_id = esc_attr( $item->ID );
	    $removed_args = array(
	        'action',
	        'customlink-tab',
	        'edit-menu-item',
	        'menu-item',
	        'page-tab',
	        '_wpnonce',
	    );
	
	    $original_title = '';
	    if ( 'taxonomy' == $item->type ) {
	        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
	        if ( is_wp_error( $original_title ) )
	            $original_title = false;
	    } elseif ( 'post_type' == $item->type ) {
	        $original_object = get_post( $item->object_id );
	        $original_title = $original_object->post_title;
	    }
	
	    $classes = array(
	        'menu-item menu-item-depth-' . $depth,
	        'menu-item-' . esc_attr( $item->object ),
	        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
	    );
	
	    $title = $item->title;
	
	    if ( ! empty( $item->_invalid ) ) {
	        $classes[] = 'menu-item-invalid';
	        /* translators: %s: title of menu item which is invalid */
	        $title = sprintf( __( '%s (Invalid)', 'onfleek' ), $item->title );
	    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
	        $classes[] = 'pending';
	        /* translators: %s: title of menu item in draft status */
	        $title = sprintf( __('%s (Pending)' , 'onfleek'), $item->title );
	    }
	
	    $title = empty( $item->label ) ? $title : $item->label;
		
		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

	    ?>
	    <li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo esc_attr( implode(' ', $classes ) ); ?>">
	        <dl class="menu-item-bar">
	            <dt class="menu-item-handle">
	                <span class="item-title"><?php echo esc_html( $title ); ?> <span class="is-submenu" <?php echo esc_attr( $submenu_text ); ?>><?php _e( 'sub item', 'onfleek' ); ?></span></span>
	                <span class="item-controls">
	                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
	                    <span class="item-order hide-if-js">
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-up-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'onfleek'); ?>">&#8593;</abbr></a>
	                        |
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-down-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'onfleek'); ?>">&#8595;</abbr></a>
	                    </span>
	                    <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'onfleek'); ?>" href="<?php
	                        echo esc_url( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
	                    ?>"><?php _e( 'Edit Menu Item', 'onfleek' ); ?></a>
	                </span>
	            </dt>
	        </dl>
	
	        <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">

	        	
	            <?php if( 'custom' == $item->type ) : ?>
	                <p class="field-url description description-wide">
	                    <label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
	                        <?php _e( 'URL', 'onfleek' ); ?><br />
	                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
	                    </label>
	                </p>
	            <?php endif; ?>
	            <p class="description description-thin">
	                <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
	                    <?php _e( 'Navigation Label', 'onfleek' ); ?><br />
	                    <input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
	                </label>
	            </p>
	            <p class="description description-thin">
	                <label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
	                    <?php _e( 'Title Attribute', 'onfleek' ); ?><br />
	                    <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
	                </label>
	            </p>
	            <p class="field-link-target description">
	                <label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
	                    <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
	                    <?php _e( 'Open link in a new window/tab', 'onfleek' ); ?>
	                </label>
	            </p>
	            <p class="field-css-classes description description-thin">
	                <label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
	                    <?php _e( 'CSS Classes (optional)', 'onfleek'); ?><br />
	                    <input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
	                </label>
	            </p>
	            <p class="field-xfn description description-thin">
	                <label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
	                    <?php _e( 'Link Relationship (XFN)' , 'onfleek'); ?><br />
	                    <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
	                </label>
	            </p>
	            <p class="field-description description description-wide">
	                <label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
	                    <?php _e( 'Description', 'onfleek' ); ?><br />
	                    <textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
	                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.' , 'onfleek' ); ?></span>
	                </label>
	            </p>   

	            <?php
	            /* New fields (select category for megamenu) starts here */
	            if(0 == $depth){ // check if depth == 0
	            	$category_key_post_meta = 'megadropdown_menu_cat';
					$megadropdown_menu_cat = get_post_meta( $item->ID, $category_key_post_meta, true );
					$cat_tree = array_merge(
						array(' - select category - ' => ''),
						$this->get_category_array(false)
					);

					$style = array(
						'style-1' => '1',
						'style-2' => '2'
					);

					$megadropdown_style_key_post_meta = 'megadropdown_menu_style';
					$megadropdown_menu_style = get_post_meta( $item->ID, $megadropdown_style_key_post_meta, true );

					?>
					<p class="description description-wide">
						<label><?php _e( 'Category Mega Dropdown', 'onfleek' ); ?></label><br>
							<select name="<?php echo esc_attr( $category_key_post_meta );?>[<?php echo esc_attr($item->ID);?>]" id="" class="widefat code edit-menu-item-url">
					<?php 
							// print_r( $cat_tree );
							foreach ($cat_tree as $category => $category_id) {
					?>
								<option value="<?php echo esc_attr( $category_id );?>" <?php echo esc_attr( selected($megadropdown_menu_cat, $category_id, false) );?>>
									<?php echo esc_attr( $category ) ;?>
								</option>
					<?php 
							}
					?>
							</select>
							<span>
								<?php _e( 'Tips: if use mega dropdown, do not add sub menu items.', 'onfleek' ); ?>
							</span>
					</p>


					<p class="description-wide description">
		            	<label for=""><?php _e( 'Megamenu Style', 'onfleek' ); ?></label><br>
		            		<select name="<?php echo esc_attr( $megadropdown_style_key_post_meta );?>[<?php echo esc_attr( $item->ID);?>]" id="" class="widefat code edit-menu-item-url">
		            <?php
		            		foreach( $style as $megamenu_style => $style_id ){
		            ?>
								<option value="<?php echo esc_attr( $style_id );?>" <?php echo selected( $megadropdown_menu_style, $style_id , false );?> >
									<?php echo esc_attr( $megamenu_style );?>
								</option>
		            <?php
		            		} 
		            ?>
		            		</select>
		            		<span>
								<?php _e( 'Style for mega dropdown with sub category', 'onfleek' ); ?>
							</span>
		            </p>
				<?php
	            }
	            ?>

	            <div class="menu-item-actions description-wide submitbox">
	                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
	                    <p class="link-to-original">
	                        <?php $dv_menu = sprintf( __('Original: %s' , 'onfleek'), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); 
	                        	  echo $dv_menu ;
	                        ?>
	                    </p>
	                <?php endif; ?>
	                <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
	                echo wp_nonce_url(
	                    add_query_arg(
	                        array(
	                            'action' => 'delete-menu-item',
	                            'menu-item' => $item_id,
	                        ),
	                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                    ),
	                    'delete-menu_item_' . $item_id
	                ); ?>"><?php _e('Remove', 'onfleek' ); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
	                    ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php _e('Cancel', 'onfleek'); ?></a>
	            </div>
	
	            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
	            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
	            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
	            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
	            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
	            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
	        </div><!-- .menu-item-settings-->

	        <ul class="menu-item-transport"></ul>
	    <?php
	    
	    $output .= ob_get_clean();

	}


	/**
     * generates a category tree
     * @param bool $add_all_category = if true 
     * ads - All categories - at the begining of the list (used for dropdowns)
     */
    static $cat_array_walker_buffer = array();
    static function get_category_array( $add_all_category = true ) {

        if ( is_admin() === false ) {
            return;
        }

        if ( empty($cat_array_walker_buffer ) ) {
            $categories = get_categories( array(
                'hide_empty' 	=> 0,
                'number' 		=> 1000
            ) );

            $cat_array_walker = new cat_array_walker;
            $cat_array_walker->walk( $categories, 4 );
            $cat_array_walker_buffer = $cat_array_walker->array_buffer;
        }

        if ( $add_all_category === true ) {
            $categories_buffer['- All categories -'] = '';
            return array_merge(
                $categories_buffer,
                $cat_array_walker_buffer
            );
        }else{
            return $cat_array_walker_buffer;
		}

    }
}


class cat_array_walker extends Walker {
    var $tree_type = 'category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }

    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }
}


