<?php
if( !class_exists('DF_script_Options') ) {

    Class DF_script_Options extends DF_Options{

        function __construct() {
            add_action( 'wp_enqueue_scripts' , array( $this, 'df_get_custom_javascript' ) );
        }

        function df_get_custom_javascript(){
            $custom_script = "";
            $current_version = get_bloginfo('version');
            
            if ( $current_version >= "4.5"){
                wp_register_script( 'customjavascript', get_template_directory_uri() .'/inc/df-core/asset/js/custom-script.js',array(), '1.0' , true);
                wp_enqueue_script( 'customjavascript', get_template_directory_uri() .'/inc/df-core/asset/js/custom-script.js',array(), '1.0', true );
                $general = self::df_get_general_options();
                $global_options = $general['custom_code'];
                $custom_script  = stripslashes_deep( $global_options['custom_javascript'] );
                wp_add_inline_script('customjavascript',$custom_script);
            } else {
                wp_enqueue_script('customjavascript',  get_template_directory_uri() .'/inc/df-core/asset/js/custom-script.js',array(), '1.0', true );
                wp_localize_script('customjavascript', 'pw_script_vars', array(
                        'alert' => __('Hey! You have clicked the button!', 'onfleek')
                    )
                );
            }
        }
    }
    new DF_script_Options();
}
/* file location: /your/file/location/[file].php */
