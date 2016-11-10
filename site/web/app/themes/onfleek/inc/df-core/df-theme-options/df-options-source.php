<?php

Class DF_Options_Source {
	
	function __construct(){
		
		add_action( 'wp_ajax_nopriv_update_options', array( $this, 'df_update_options' ) );
		add_action( 'wp_ajax_update_options', array( $this, 'df_update_options' ) );
		add_action( 'wp_ajax_nopriv_import_options', array( $this, 'df_import_options' ) );
		add_action( 'wp_ajax_import_options', array( $this, 'df_import_options' ) );
		add_action( 'admin_menu', array( $this,'df_get_all_default_options' ) ); 
		$this->df_get_all_options();
	}
	
	private static function df_get_attachment_id_from_url( $attachment_url = '' ) {
		global $wpdb;
		$attachment_id = false;
		if ( '' == $attachment_url )
			return;

	        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts  WHERE wposts.guid = '%s'", $attachment_url ) );
			return $attachment_id;
    }
    
	static function df_update_options($param){
		$newSidebar = array();
		$options=DF_Global_Options::$options;
		$data_options=$_POST['data'];
		print_r($_POST['opened_menu']);
		$name='';
		$object_name=array();
		for($i=0,$counter=count($data_options);$i<$counter;$i++){
			$name = $data_options[$i]['name'];
			parse_str($name,$parse_name);
			$array_key=self::df_array_keys_multi($parse_name);
			switch(count($array_key)){
				case 1 :
					$options[$array_key[0]]=$data_options[$i]['value'];
					break;
				case 2 :
					if ( 'logo' == $array_key[0] and 'fav_icon' == $array_key[1] ){
                        $postid = self::df_get_attachment_id_from_url(($data_options[$i]['value']));
                        $options[$array_key[0]][$array_key[1]]=$postid;
                    } else {
					   $options[$array_key[0]][$array_key[1]]=$data_options[$i]['value'];
                    } 
					break;
				case 3 :	
					$options[$array_key[0]][$array_key[1]][$array_key[2]]=$data_options[$i]['value'];

					break;
				case 4 :
					
					if ($array_key[0] == 'sidebars' && $array_key[1] == 'additional'){
						$newSidebar[$array_key[2]][$array_key[3]] = $data_options[$i]['value'];

					} else {
						$options[$array_key[0]][$array_key[1]][$array_key[2]][$array_key[3]]=$data_options[$i]['value'];	
					}
					
					break;
				case 5 :
					$options[$array_key[0]][$array_key[1]][$array_key[2]][$array_key[3]][$array_key[4]]=$data_options[$i]['value'];
					break;
				case 6 :
					$options[$array_key[0]][$array_key[1]][$array_key[2]][$array_key[3]][$array_key[4]][$array_key[5]]=$data_options[$i]['value'];
					break;
			}
		}
		if ( count($newSidebar) > 0 ){
			$options['sidebars']['additional'] = $newSidebar;	
		} else {
			$options['sidebars']['additional'] = array();
		}
		
		update_option( DF_THEME_OPTIONS_NAME, $options );
		die();
	}
	
	static function df_array_keys_multi(array $array){
		$keys = array();

		foreach ($array as $key => $value) {
			$keys[] = $key;

			if (is_array($array[$key])) {
				$keys = array_merge($keys, self::df_array_keys_multi($array[$key]));
			}
		}

		return $keys;
	}
	
	static function df_get_option_value($param){
		$options=DF_Global_Options::$options;
		if(is_array($param)){
			switch(count($param)){
				
				case 2 :
					if( isset($options[$param[0]][$param[1]]) ){
						return $options[$param[0]][$param[1]];
					} else {
						return null;
					}
					break;
				case 3 :	
					if( isset($options[$param[0]][$param[1]][$param[2]]) ){
						return $options[$param[0]][$param[1]][$param[2]];
					} else {
						return null;
					}
					break;
				case 4 :
					if( isset($options[$param[0]][$param[1]][$param[2]][$param[3]]) ){
						return $options[$param[0]][$param[1]][$param[2]][$param[3]];
					} else {
						return null;
					}
					break;
				case 5 :
					if( isset($options[$param[0]][$param[1]][$param[2]][$param[3]][$param[4]]) ){
						return $options[$param[0]][$param[1]][$param[2]][$param[3]][$param[4]];
					} else {
						return null;
					}
					break;
				case 6 :
					if( isset($options[$param[0]][$param[1]][$param[2]][$param[3]][$param[4]][$param[5]]) ){
						return $options[$param[0]][$param[1]][$param[2]][$param[3]][$param[4]][$param[5]];
					} else {
						return null;
					}
					break;
			}
		} else {

			if( isset($options[$param]) ){
				return $options[$param];
			} else {
				return null;
			}
				
		}
		
		
	}
	
	 private function df_get_all_options(){		
		 DF_Global_Options::$options = get_option( DF_THEME_OPTIONS_NAME );
	 }
	static function df_get_all_default_options(){
		
		if(DF_Global_Options::$options == null){
			$default_options = self::df_filesystem_default_option_read();
			$default_options_decode= stripslashes( $default_options );
			$default_options=json_decode($default_options_decode,true);
			update_option( DF_THEME_OPTIONS_NAME, $default_options );
			//header('Location: '.$_SERVER['REQUEST_URI']);		
		}
		
	}
	
	static function df_import_options(){
		$data_base64=$_POST['data'];
		$options_json = stripslashes( $data_base64 );
		// $options_json=base64_decode($data_base64);
		$options_array= json_decode( $options_json, true );
		if(isset($options_array['categories']['per_category'])){
			unset($options_array['categories']['per_category']);
		}
		update_option( DF_THEME_OPTIONS_NAME, $options_array);
	}
	static function df_filesystem_default_option_read(){
		global $wp_filesystem;

		$text = '';
		
		$method = '';
		$context = get_template_directory()."/inc/df-core/df-theme-options/includes";  
		
		if(!self::df_filesystem_init('', $method, $context)){
			return false;
		}

		$target_dir = $wp_filesystem->find_folder($context);
		$target_file = trailingslashit($target_dir).'default-theme-options.txt';

		if($wp_filesystem->exists($target_file)){
			
			$text = $wp_filesystem->get_contents($target_file);
			if(!$text)
				return new WP_Error('reading_error', 'Error when reading file');           
			
		}   
		return $text;    
	}
	
	static function df_filesystem_init($form_url, $method, $context, $fields = null) {
		global $wp_filesystem;

		if (false === ($creds = request_filesystem_credentials($form_url, $method, false, $context, $fields))) {

			return false;
		}
		      
		if (!WP_Filesystem($creds)) {
			
			request_filesystem_credentials($form_url, $method, true, $context);
			return false;
		}
		
		return true;
	}
	
}

new DF_Options_Source();

?>