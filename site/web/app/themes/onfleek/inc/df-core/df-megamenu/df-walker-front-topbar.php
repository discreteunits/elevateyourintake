<?php
/**
	 * Custom Walker
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
class DF_Topbar_Walker extends Walker_Nav_Menu {

	function start_lvl(&$output,  $depth = 0, $args= array()) {	
		$indent        	= str_repeat( "\t", $depth ); 
		$class_names	= 'dropdown-menu df-dropdown-top-bar';
		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . ' ul-'.$depth.'">' . "\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	    
       	global $wp_query, $wpdb, $wpdb2;

       	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

       	$class_names = $value = '';
       	$walkerObj = $args->walker;
       	$has_children_item_menu = $walkerObj->has_children;

        $dropdown = '';
        if( $depth > 0 ) {
            $dropdown = "dropdown-submenu";
        }else{
            $dropdown = "dropdown";
        }
       	
       	$classes = empty( $item->classes ) ? array() : (array) $item->classes;

       	$classes[] = $dropdown . ' menu-item-' . $item->ID . '-'.$depth;
       
       	$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item , $args) );
       	$class_names = ' class="'. esc_attr( $class_names ) . '"';

       	$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );

       	$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

       	$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
       	
       	$atts = array();

  	   	$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
  	   	$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
  	   	$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
  	   	$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
       	
        if( ($depth > 0 && $has_children_item_menu > 0) ){
            $atts['href'] = '#';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

       	$attributes = '';

        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        
        $ariaexpanded = '';
        $ariapopup = '';
        $role = '';
        $datatoggle = '';

        if( $has_children_item_menu > 0 && $depth == 0) {
            $ariaexpanded ='aria-expanded="false"';
            $ariapopup = 'aria-haspopup="true"';
            $role = 'role="button"';
            $datatoggle = 'data-toggle="dropdown"';
        }

        $item_output .= '<a'. $attributes .' class="" '. $ariaexpanded .' '. $ariapopup .' '. $role .' '. $datatoggle .'> ';
        	
         /** This filter is documented in wp-includes/post-template.php */
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

        
        if( ($depth > 0 && $has_children_item_menu > 0) ){
            $item_output .= '<i class="ion-arrow-down-b"></i>';
        }
       
        $item_output .= '</a>';

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        
    }

}
