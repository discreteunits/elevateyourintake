<?php
/**
	 * Custom Walker
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
class DF_Megamenu_Walker extends Walker_Nav_Menu {
    
    private $boxed_wrapper = '';
    
	function start_lvl(&$output,  $depth = 0, $args= array()) {	
		$indent        	= str_repeat( "\t", $depth ); 
		$class_names	= 'dropdown-menu df-dropdown-main-menu';
		// build html
        $class_boxednopadding = '';
        if( $depth == 0){
            $class_boxednopadding = $this->boxed_wrapper;
        }
        $output .= "\n" . $indent . '<ul class="' . $class_names . ' ul-'.$depth.' '.$class_boxednopadding.'">' . "\n";
        
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	    
       	global $wp_query, $wpdb, $wpdb2;

       	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
       	$class_names = $value = '';
       	$walkerObj = $args->walker;
       	$has_children_item_menu = $walkerObj->has_children;
       	
       	$classes = empty( $item->classes ) ? array() : (array) $item->classes;

       	$classes[] = 'menu-item-' . $item->ID . '-'.$depth;

       	// $classes[] = ($has_children) ? 'dropdown' : '';
        if( $item->megamenu == true && $depth == 0 ){
            $this->boxed_wrapper = $item->boxed_wrapper;    
        }else{
            $this->boxed_wrapper = '';
        }
        
       	$classes[] = ($item->is_mega_menu == true) ? 'list_megamenu-'.$item->is_mega_menu.' list_megamenu' : '';

        // $is_mega_menu = ($item->is_mega_menu == true) ? 'is_mega_menu' : 'is_not_mega_menu';
        $dropdownsubmenu = ( $depth > '0') ? 'dropdown-submenu' : '';

       	$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item , $args) );
       	$class_names = ' class="'. $dropdownsubmenu ." ". esc_attr( $class_names ) . '"';

        // ( $item->is_mega_menu == true) ? $id=apply_filters( 'nav_menu_item_id', 'menu-item-', $item, $args ) : $id=apply_filters( 'nav_menu_item_id', 'menu-item-', $item, $args);
       	$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID , $item, $args );

       	$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

       	$output .= $indent . '<li id="menu-item-'. $item->ID . '-'.$item->no_item.'"' . $value . $class_names .' >';
       	$atts = array();
  	   	$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
  	   	$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
  	   	$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
  	   	$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
       	$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
       	$attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $item_output = $args->before;
        if($item->is_mega_menu == null){
        	$item_output .= '<a'. $attributes .' class="" > ';
        }	
         /** This filter is documented in wp-includes/post-template.php */
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        if( ($depth >= 1 && $has_children_item_menu > 0) ){
        	// $item_output .= '&nbsp;<span class="caret megamenu-'.$item->is_mega_menu.' depth-'.$depth.' child-'.$has_children_item_menu.'"></span>';
          $item_output .= '<i class="ion-arrow-down-b"></i>';
        }
        if ($item->is_mega_menu == null) {
            $item_output .= '</a>';
        }
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}