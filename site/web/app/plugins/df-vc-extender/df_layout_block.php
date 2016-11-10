<?php
/**
 * Class: DF_Layout_Block
 * Description: for render layout [open tag, close tag etc]
 */

if( !class_exists('DF_Layout_Block') ) {

	Class DF_Layout_Block {

		var $row_open = false;
		var $div_open = false;
		
		function open_row_tag(){
			$this->row_open = true;
			return '<div class="row">';
		}

		function close_row_tag(){
			$this->row_open = false;
			return '</div>';
		}

		function open_div( $id="", $class="" ){
			$this->div_open = true;
			return '<div id="'. esc_attr( $id ).'" class="'. esc_attr( $class ) .'">';
		}

		function close_div(){
			$this->div_open = false;
			return '</div>';
		}
		
		function open_div_6(){
			return '<div class="col-md-4 col-sm-6">';
		}

		function close_all(){
			$out = '';
	        if( $this->div_open ) {
	            $out .= $this->close_div();
	        }
	        if ($this->row_open) {
	            $out .= $this->close_row();
	        }
	        return $out;
		}
	}

}

/* file location: /your/file/location/[file].php */