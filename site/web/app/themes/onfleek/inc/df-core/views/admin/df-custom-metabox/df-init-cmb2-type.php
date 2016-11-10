<?php
function cmb2_before_row_render_section( $field_args, $field ) {
    printf( '<div class="df-section" id="%s" >',  $field_args['section'] );
}

function cmb2_after_row_render_section() {
    printf( '</div>');
}
if(!class_exists("DF_custom_metabox_view")){
    
    Class DF_custom_metabox_view {
        
        function __construct(){
            require get_template_directory() . '/inc/df-core/plugins/cmb2/includes/helper-functions.php';
            add_action( 'cmb2_render_df_post_layout', array($this,'cmb2_render_df_post_layout'), 10, 5 );
            add_action( 'cmb2_render_df_select_box',array($this,'cmb2_render_df_select_box'), 10, 5 );
            add_action( 'cmb2_render_df_input',array($this,'cmb2_render_df_input'), 10, 5 );
            add_action( 'cmb2_render_df_ads_background', array($this,'cmb2_render_df_ads_background'), 10, 5 );
            add_action( 'cmb2_render_df_feature_reviews', array($this,'cmb2_render_df_feature_reviews'), 10, 5 );
            add_action( 'cmb2_types_esc_df_ads_background', array($this,'cmb2_types_esc_df_ads_background_field'), 10, 4 );
            add_filter( 'cmb2_sanitize_df_ads_background', array($this,'cmb2_sanitize_df_ads_background'), 12, 4 );
            add_action( 'cmb2_render_df_wysiwyg', array($this,'cmb2_render_df_wysiwyg'), 10, 5 );
            add_action( 'cmb2_render_df_oembed',array($this,'cmb2_render_df_oembed'), 10, 5 );
            add_action( 'cmb2_render_df_colorpicker', array($this,'cmb2_render_df_colorpicker'), 10, 5 );
            add_action( 'cmb2_render_df_file', array($this,'cmb2_render_df_file'), 10, 5 );
            add_action( 'cmb2_render_df_file_list', array($this,'cmb2_render_df_file_list'), 10, 5 );
            add_action( 'cmb2_before_post_form_df_magz_post', array($this,'cmb2_df_magz_post_before_form'), 10, 5 );
            add_action( 'cmb2_before_post_form_df_magz_page', array($this,'cmb2_df_magz_post_before_form'), 10, 5  );
            add_action( 'cmb2_after_post_form_df_magz_post', array($this,'cmb2_df_magz_post_after_form'), 10, 5  );
            add_action( 'cmb2_after_post_form_df_magz_page', array($this,'cmb2_df_magz_post_after_form'), 10, 5  );
            add_filter( 'cmb2_sanitize_df_feature_reviews', array($this,'cmb2_sanitize_df_feature_reviews'), 10, 5 );
            add_filter( 'cmb2_types_esc_df_feature_reviews', array($this,'cmb2_types_esc_df_feature_reviews'), 10, 4 );
        }
        
        //require_once ( 'extras.php');

        
        function cmb2_render_df_post_layout( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
            $html = printf( '<div class="df-row df-col-1" ><div class="df-section-left df-col-5"><h4>%s</h4></div><div class="df-section-right df-col-2"><div class="df-selector">', $field->args['name'] );
            $a = $field_type_object->parse_args( $field, 'radio', array(
                'class'   => 'cmb2-radio-list cmb2-list',
                'options' => $field_type_object->concat_items( array( 'method' => 'list_input' ) ),
                'desc'    => $field_type_object->_desc( false ),
            ));
            $html .=  printf( '<ul class="%s">%s</ul>%s', $a['class'], $a['options'], $a['desc'], $a['desc']  );
            $html .= printf ( '</div></div></div>' );
        }

        

        function cmb2_render_df_select_box( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
            $html = printf( '<div class="df-row df-col-1" >
                                <div class="df-section-left df-col-5">
                                    <h4>%s</h4></div>
                                <div class="df-section-right df-col-2">
                                <div class="df-selector">', $field->args['name'] );
            $a = $field_type_object->parse_args( $field, 'select', array(
                    'class'   => 'cmb2_select df-selectopt df-styled-select',
                    'name'    => $field_type_object->_name(),
                    'id'      => $field_type_object->_id(),
                    'desc'    => $field_type_object->_desc( true ),
                    'options' => $field_type_object->concat_items(),
                ) );

            $attrs = $field_type_object->concat_attrs( $a, array( 'desc', 'options' ) );
            $html .= printf( '<select%s>%s</select>%s', $attrs, $a['options'], $a['desc'] );
            $html .= printf ( '</div></div></div>' );
        }

        

        function cmb2_render_df_ads_background(  $field, $value, $object_id, $object_type, $field_type_object) {
            $post_id = null;
            $post_id = $post_id ? $post_id : get_the_ID();
            $options_list  = $field->args['options'];
            $ads_background_options = '';
            if ( $post_id !== null ) {
            $value = get_post_meta( $post_id, 'df_magz_post_ads_background', 1 );
            $value = wp_parse_args( $value, array() );
            if ( !isset( $value ) ) {
               
                foreach ( $options_list as $types => $type ) {
                    $ads_background_options .= '<option value="'. $types .'" '. selected( $value['type'], $types, false ) .'>'. $type .'</option>';
                }

            }else {
                foreach ( $options_list as $types => $type ) {
                    $ads_background_options .= '<option value="'. $types .'">'. $type .'</option>';
                }
                $value['type'] = 'no';
                $value['url'] = '';
            }
            

            }else {
                $value = wp_parse_args( $value, array(
                'type' => '',
                'url'      => '',
                'is_open_in_new_window' => '',

                ) );
                $ads_background_options = $field->args['options'];;
            }

            
           

            $html = printf( '<div class="df-row df-col-1" ><div class="df-section-left df-col-5"><h4>%s</h4></div>
                <div class="df-section-right df-col-2"><div class="df-selector">', $field->args['name'] );
            $select_box = $field_type_object->parse_args( $field, 'select', array(
                    'class'   => 'cmb2_select df-selectopt df-styled-select',
                    'name'    => $field_type_object->_name('[type]') ,
                    'id'      => $field_type_object->_id('_type') ,
                    'desc'    => $field_type_object->_desc( true ),
                    'options' =>  $ads_background_options,
                    'checked' =>  $value['type'],
                ) );

            $attrs = $field_type_object->concat_attrs( $select_box, array( 'desc', 'options' ) );

            $html .= printf( '<select%s>%s</select>%s', $attrs, $select_box['options'], $select_box['desc'] );

            $dahz_url = 'http://www.daffyhazan.com';
            $input = $field_type_object->parse_args( $field, 'input', array(
                    'type'  => 'text',
                    'class' => 'regular-text',
                    'name'  => $field_type_object->_name('[url]') ,
                    'id'    => $field_type_object->_id('_url'),
                    'value' =>  $value['url'],
                    'desc'  => 'Overide globals, Paste your link here like : <a href= "'.$dahz_url.'">http://www.daffyhazan.com</a>',
                ) );
            $html .= printf( '<div id="background_ads_detail">' );
            $html .= printf( '<input%s/><p class="cmb2-metabox-description">%s</p>', $field_type_object->concat_attrs( $input, array( 'desc' ) ), $input['desc'] );

            $html .= printf( '<p class="cmb2-metabox-description">' );
            $checkbox = array(
                'type'  => 'checkbox',
                'class' => 'cmb2-option cmb2-list',
                'value' => 'on',
                'desc'  => 'Open in new windows',
                'name'  => $field_type_object->_name('[is_open_in_new_window]') ,
                'id'    => $field_type_object->_id('_is_open_in_new_window')  ,

            );

            $meta_value = isset($value['is_open_in_new_window']) ? $value['is_open_in_new_window'] : null;
            $is_checked = null;
            $is_checked = is_null( $is_checked )
                ? ! empty( $meta_value )
                : $is_checked;

            if ( $is_checked ) {
                $checkbox['value'] = 'on';
                $checkbox['checked'] = 'Checked';
            }

            $args = $field_type_object->parse_args( $field, 'checkbox', $checkbox );

            $html .= printf( '%s ', $field_type_object->input( $args ) );
            $html .= printf( '</p>' );
            $html .= printf ( '</div></div></div></div>' );
        }

        /* feature reviews*/
            
        function cmb2_sanitize_df_feature_reviews( $check, $meta_value, $object_id, $field_args, $sanitize_object ) {
            if ( is_array( $meta_value ) && $field_args['repeatable'] ) {
                foreach ( $meta_value as $key => $val ) {
                    if ( isset( $val['state'] ) && 'AL' == $val['state'] ) {
                        unset( $val['state'] );
                        $val = array_filter( $val );
                        if ( empty( $val ) ) {
                            unset( $meta_value[ $key ] );
                            continue;
                        } else {
                            $val['state'] = 'AL';
                        }
                    }
                    $meta_value[ $key ] = array_map( 'sanitize_text_field', $val );
                }

                return $meta_value;
            }
            return $check;
        }

        function cmb2_types_esc_df_feature_reviews( $check, $meta_value, $field_args, $field_object ) {
            if ( is_array( $meta_value ) ) {
                foreach ( $meta_value as $key => $val ) {
                    $meta_value[ $key ] = array_map( 'esc_attr', $val );
                }

                return $meta_value;
            }
            return $check;
        }

        function cmb2_render_df_feature_reviews(  $field, $value, $object_id, $object_type, $field_type_object) {
            $post_id = null;
            $post_id = $post_id ? $post_id : get_the_ID();
            if ($post_id !== null ) {
            $value = get_post_meta( $post_id, 'df_magz_post_feature_reviews', 1 );
            $value = wp_parse_args( $value, array() );    
            }else {
                $value = wp_parse_args( $value, array(
                '_review_points_name' => '' ,
                '_review_points_value' => '',
                '_review_percent_name' => '' ,
                '_review_percent_value' => '',
                '_review_percent_name' => '' ,
                '_review_percent_value' => '',
               ) );

            }

            $html = printf( '<div class="df-row df-col-1" >
                             <div class="df-section-left df-col-5">
                                <h4>%s</h4>
                             </div>
                             <div class="df-section-right df-col-2">
                                <div class="df-selector">', $field->args['name'] );

            $iterator = 0;
            //Loop value array and add a row points
            if ( ! empty( $value['_review_points_name'] ) ) {
                $count = count( $value['_review_points_name'] );
                
                $html .= printf( '<div class="review_box review_point"><p class="cmb2-metabox-description">%s</p>', 'Points Rating' );

                for ( $iterator = 0 ; $iterator < $count ; $iterator++) {
                //foreach ( (array) $value['_review_points_name'] as $key ) {
                   $input_name = $field_type_object->parse_args( $field, 'input', array(
                            'type'  => 'text',
                            'class' => 'regular-text name df-cmb-input-styled',
                            'name'  => $field_type_object->_name('[_review_points_name]['. $iterator .']') ,
                            'id'    => $field_type_object->_id('_review_points_name_' . $iterator ),
                            'value' => $value['_review_points_name'][$iterator],
                        ) );
                    $input_value = $field_type_object->parse_args( $field, 'input', array(
                            'type'  => 'number',
                            'max'   => '10',
                            'class' => 'regular-text value df-value',
                            'name'  => $field_type_object->_name('[_review_points_value][' . $iterator .']') ,
                            'id'    => $field_type_object->_id('_review_points_value_' . $iterator),
                            'value' => $value['_review_points_value'][$iterator],
                        ) ); 
                    
                    $html .= printf( '<div data-id="%s" class="review_box_wrap"><input%s /> <input%s type="number"/><a class="button delete_point_value" data-id="%s" href="#">Delete</a><a class="button reorder" href="#"><i class="dashicons dashicons-sort"></i></a></div>',
                                        $iterator,
                                        $field_type_object->concat_attrs( $input_name, array( 'desc' ) ), 
                                        $field_type_object->concat_attrs( $input_value, array( 'desc' ) ), 
                                        $iterator
                                    );

                }
                $html .= printf('<a class="copy_review_point button" href="#">Add New</a></div>');
            } else {
                // Otherwise add one row

                $html .= printf( '<div class="review_box review_point"><p class="cmb2-metabox-description">%s</p>', 'Points Rating' );
                $input_name = $field_type_object->parse_args( $field, 'input', array(
                        'type'  => 'text',
                        'class' => 'regular-text name df-cmb-input-styled',
                        'name'  => $field_type_object->_name('[_review_points_name][0]') ,
                        'id'    => $field_type_object->_id('_review_points_name_0'),
                        'value' => '',
                    ) );
                $input_value = $field_type_object->parse_args( $field, 'input', array(
                        'type'  => 'number',
                        'max'   => '10',
                        'class' => 'regular-text value df-value',
                        'name'  => $field_type_object->_name('[_review_points_value][0]') ,
                        'id'    => $field_type_object->_id('_review_points_value_0'),
                        'value' => '',
                    ) ); 
                $html .= printf( '<div class="review_box review_point">' );
                $html .= printf( '<div class="review_box_wrap"><input%s/> <input%s><a class="button delete_point_value" data-id="0" href="#">Delete</a><a class="button reorder" href="#"><i class="dashicons dashicons-sort"></i></a></div>',
                                    $field_type_object->concat_attrs( $input_name, array( 'desc' ) ), 
                                    $field_type_object->concat_attrs( $input_value, array( 'desc' ) )
                                );
                $html .= printf('<a class="copy_review_point button" href="#">Add New</a></div></div>');
            }
            //Loop value array and add a row percent
            if ( ! empty( $value['_review_percent_name'] ) ) {
                $count = count( $value['_review_percent_name'] );
                $html .= printf( '<div class="review_box review_percent"><p class="cmb2-metabox-description">%s</p>', 'Percent Rating' );

                for ( $iterator = 0 ; $iterator < $count ; $iterator++) {
                   $input_name = $field_type_object->parse_args( $field, 'input', array(
                            'type'  => 'text',
                            'class' => 'regular-text name df-cmb-input-styled',
                            'name'  => $field_type_object->_name('[_review_percent_name]['. $iterator .']') ,
                            'id'    => $field_type_object->_id('_review_percent_name_' . $iterator),
                            'value' => $value['_review_percent_name'][$iterator],
                        ) );
                    $input_value = $field_type_object->parse_args( $field, 'input', array(
                            'type'  => 'number',
                            'max'   => '100',
                            'class' => 'regular-text value df-value',
                            'name'  => $field_type_object->_name('[_review_percent_value][' . $iterator .']') ,
                            'id'    => $field_type_object->_id('_review_percent_value_' . $iterator),
                            'value' => $value['_review_percent_value'][$iterator],
                        ) ); 
                    
                    $html .= printf( '<div data-id="%s" class="review_box_wrap"><input%s /> <input%s type="number"/><a class="button delete_percent_value" data-id="%s" href="#">Delete</a><a class="button reorder" href="#"><i class="dashicons dashicons-sort"></i></a></div>',
                                        $iterator,
                                        $field_type_object->concat_attrs( $input_name, array( 'desc' ) ), 
                                        $field_type_object->concat_attrs( $input_value, array( 'desc' ) ), 
                                        $iterator
                                    );
                   //$iterator++;
                }

                $html .= printf('<a class="copy_review_percent button" href="#">Add New</a></div>');

            } else {
                // Otherwise add one row
                $html .= printf( '<div class="review_box review_percent"><p class="cmb2-metabox-description">%s</p>', 'Percent Rating' );
                $input_name = $field_type_object->parse_args( $field, 'input', array(
                        'type'  => 'text',
                        'class' => 'regular-text name df-cmb-input-styled',
                        'name'  => $field_type_object->_name('[_review_percent_name][0]') ,
                        'id'    => $field_type_object->_id('_review_percent_name_0'),
                        'value' => '',
                    ) );

                $input_value = $field_type_object->parse_args( $field, 'input', array(
                        'type'  => 'number',
                        'max'   => '100',
                        'class' => 'regular-text value df-value',
                        'name'  => $field_type_object->_name('[_review_percent_value][0]') ,
                        'id'    => $field_type_object->_id('_review_percent_value_0'),
                        'value' => '',
                    ) ); 

                $html .= printf( '<div class="review_box review_percent">' );
                $html .= printf( '<div class="review_box_wrap"><input%s/> <input%s><a class="button delete_percent_value" data-id="0" href="#">Delete</a><a class="button reorder" href="#"><i class="dashicons dashicons-sort"></i></a></div>',
                                    $field_type_object->concat_attrs( $input_name, array( 'desc' ) ), 
                                    $field_type_object->concat_attrs( $input_value, array( 'desc' ) )
                                );
                $html .= printf('<a class="copy_review_percent button" href="#">Add New</a></div></div>');
            }
            //Loop value array and add a row stars

            $options_list = array(
                    '0.5'     => '&frac12; ',
                    '1'     => '1',
                    '1.5'     => '1 &frac12; ',
                    '2'     => '2',
                    '2.5'     => '2 &frac12; ',
                    '3'     => '3',
                    '3.5'     => '3 &frac12; ',
                    '4'     => '4',
                    '4.5'     => '4 &frac12; ',
                    '5'    => '5',

                );
            //print_r($options_list);
            
            if ( ! empty( $value['_review_stars_name'] ) ) {
                //print_r( $value['_review_stars_value'] );
                $count = count( $value['_review_stars_name'] );
                $html .= printf( '<div class="review_box review_stars"><p class="cmb2-metabox-description">%s</p>', 'Stars Rating' );

                for ( $iterator = 0 ; $iterator < $count ; $iterator++) {
                    $stars_options = '';
                    foreach ( $options_list as $types => $type) {
                        $stars_options .= '<option value="'. $types .'" '. selected( $value['_review_stars_value'][$iterator], $types, false ) .'>'. $type .'</option>';
                    }

                   $input_name = $field_type_object->parse_args( $field, 'input', array(
                            'type'  => 'text',
                            'class' => 'regular-text name df-cmb-input-styled',
                            'name'  => $field_type_object->_name('[_review_stars_name]['. $iterator .']') ,
                            'id'    => $field_type_object->_id('_review_stars_name_' . $iterator),
                            'value' => $value['_review_stars_name'][$iterator],
                        ) );
                    $input_value = $field_type_object->parse_args( $field, 'select', array(
                            'type'  => 'cmb2_select',
                            //'options' =>  $stars_options,
                            'class' => 'cmb2_select-text df-selectopt value df-cmb-select',
                            'name'  => $field_type_object->_name('[_review_stars_value][' . $iterator .']') ,
                            'id'    => $field_type_object->_id('_review_stars_value_' . $iterator),
                            //'value' => $value['_review_stars_value'][$iterator],
                        ) ); 
                    

                    $html .= printf( '<div data-id="%1$s" class="review_box_wrap"><input%2$s />
                                        <select%3$s>%4$s</select><a class="button delete_stars_value" data-id="%1$s" href="#">Delete</a><a class="button reorder" href="#"><i class="dashicons dashicons-sort"></i></a></div>',
                                        $iterator,
                                        $field_type_object->concat_attrs( $input_name, array( 'desc' ) ), 
                                        $field_type_object->concat_attrs( $input_value, array( 'desc' ) ),
                                        $stars_options
                                    );
                   //$iterator++;
                }
                //print_r($stars_options);
                $html .= printf('<a class="copy_review_stars button" href="#">Add New</a></div></div>');

            } else {
                // Otherwise add one row
                $stars_options = '';
                foreach ( $options_list as $types => $type ) {
                    $stars_options .= '<option value="'. $types .'">'. $type .'</option>';
                }
                $input_name = $field_type_object->parse_args( $field, 'select', array(
                        'type'  => 'text',
                        'class' => 'regular-text name df-cmb-input-styled',
                        'name'  => $field_type_object->_name('[_review_stars_name][0]') ,
                        'id'    => $field_type_object->_id('_review_stars_name_0'),
                        'value' => '',
                    ) );

                $input_value = $field_type_object->parse_args( $field, 'input', array(
                        'type'  => 'cmb2_select',
                        //'options' =>  $stars_options,
                        'class' => 'cmb2_select-text df-selectopt value df-cmb-select',
                        'name'  => $field_type_object->_name('[_review_stars_value][0]') ,
                        'id'    => $field_type_object->_id('_review_stars_value_0'),
                    ) ); 

                $html .= printf( '<div class="review_box review_stars">' );
                             $html .= printf( '<div data-id="%1$s" class="review_box_wrap"><input%2$s /> <select%3$s>%4$s</select> <a class="button delete_stars_value" data-id="%1$s" href="#">Delete</a><a class="button reorder" href="#"><i class="dashicons dashicons-sort"></i></a></div>',
                                        0,
                                        $field_type_object->concat_attrs( $input_name, array( 'desc' ) ), 
                                        $field_type_object->concat_attrs( $input_value, array( 'desc' ) ),
                                        $stars_options
                                    );
                   //$iterator++;
                $html .= printf('<a class="copy_review_stars button" href="#">Add New</a></div></div>');
            }
            $html .= printf ( '</div></div>' );
        }

        /*END Feature Reviews*/
        function cmb2_types_esc_df_ads_background_field( $check, $meta_value, $field_args, $field_object ) {
            // if not repeatable, bail out.
            if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
                return $check;
            }
            foreach ( $meta_value as $key => $val ) {
                $meta_value[ $key ] = array_map( 'esc_attr', $val );
            }
            return $meta_value;
        }
        

        function cmb2_split_df_ads_background_values( $override_value, $value, $object_id, $field_args ) {
            if ( ! isset( $field_args['split_values'] ) || ! $field_args['split_values'] ) {
                // Don't do the override
                return $override_value;
            }
            $df_ads_background_keys = array( '_type', '_url', '_is_open_in_new_window' );
            foreach ( $df_ads_background_keys as $key ) {
                if ( ! empty( $value[ $key ] ) ) {
                    update_post_meta( $object_id, $field_args['id'] . 'df_magz_post_ads_background'. $key, $value[ $key ] );
                }
            }
            // Tell CMB2 we already did the update
            return true;
        }


        function cmb2_render_df_wysiwyg( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
            $html = printf( '<div class="df-row df-col-1" ><div class="df-section-left df-col-5"><h4>%s</h4></div><div class="df-section-right df-col-2"><div class="df-selector">', $field->args['name'] );
            $a = $field_type_object->parse_args( $field, 'input', array(
                    'id'      => $field_type_object->_id(),
                    'value'   => $field_type_object->field->escaped_value( 'stripslashes' ),
                    'desc'    => $field_type_object->_desc( true ),
                    'options' => $field_type_object->field->options(),
                ) );

            $html .= wp_editor( $a['value'], $a['id'], $a['options'] );
            $html .= printf ( $a['desc'] );
            $html .= printf ( '</div></div></div>' );
        }

        

        function cmb2_render_df_input( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
            $html = printf( '<div class="df-row df-col-1" ><div class="df-section-left df-col-5"><h4>%s</h4></div><div class="df-section-right df-col-2"><div class="df-selector">', $field->args['name'] );
                $a = $field_type_object->parse_args( $field, 'input', array(
                    'type'  => 'text',
                    'class' => 'regular-text',
                    'name'  => $field_type_object->_name(),
                    'id'    => $field_type_object->_id(),
                    'value' => $field_type_object->field->escaped_value(),
                    'desc'  => $field_type_object->_desc( true ),
                ) );

            $html .= printf( '<input%s/>%s', $field_type_object->concat_attrs( $a, array( 'desc' ) ), $a['desc'] );
            $html .= printf ( '</div></div></div>' );
        }

       

        function cmb2_render_df_oembed( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
            $html = printf( '<div class="df-row df-col-1" ><div class="df-section-left df-col-5"><h4>%s</h4></div><div class="df-section-right df-col-2"><div class="df-selector">', $field->args['name'] );
            $meta_value = trim( $field_type_object->field->escaped_value() );
                $oembed = ! empty( $meta_value )
                    ? cmb2_ajax()->get_oembed( array(
                        'url'         => $field_type_object->field->escaped_value(),
                        'object_id'   => $field_type_object->field->object_id,
                        'object_type' => $field_type_object->field->object_type,
                        'oembed_args' => array( 'width' => '640' ),
                        'field_id'    => $field_type_object->_id(),
                    ) )
                    : '';

            $html .= printf (  $field_type_object->input( array(
                                'class'           => 'cmb2-oembed regular-text',
                                'data-objectid'   => $field_type_object->field->object_id,
                                'data-objecttype' => $field_type_object->field->object_type,
                            ) )
                            );
            $html .= printf ('<p class="cmb-spinner spinner" style="display:none;"></p>' );
            $html .= printf ( '<div id="%s" class="cmb2-media-status ui-helper-clearfix embed_wrap">%s</div>' ,$field_type_object->_id( '-status' ), $oembed) ;
            $html .= printf ( '</div></div></div>' );
        }

        

        function cmb2_render_df_colorpicker( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
            $html = printf( '<div class="df-row df-col-1" ><div class="df-section-left df-col-5"><h4>%s</h4></div><div class="df-section-right df-col-2"><div class="df-selector">', $field->args['name'] );
            $meta_value = $field_type_object->field->escaped_value();
            $hex_color = '(([a-fA-F0-9]){3}){1,2}$';
            if ( preg_match( '/^' . $hex_color . '/i', $meta_value ) ) {
                // Value is just 123abc, so prepend #
                $meta_value = '#' . $meta_value;
            } elseif ( ! preg_match( '/^#' . $hex_color . '/i', $meta_value ) ) {
                // Value doesn't match #123abc, so sanitize to just #
                $meta_value = '#';
            }

            wp_enqueue_style( 'wp-color-picker' );
            CMB2_JS::add_dependencies( array( 'wp-color-picker' ) );

            $html .= printf ( $field_type_object->input( array( 'class' => 'cmb2-colorpicker cmb2-text-small', 'value' => $meta_value ) ) );
            $html .= printf ( '</div></div></div>' );
        }

        

        function cmb2_render_df_file( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
            $html = printf( '<div class="df-row df-col-1" >
                                <div class="df-section-left df-col-5">
                                    <h4>%s</h4>
                                </div>
                                <div class="df-section-right df-col-2">
                                <div class="df-selector">', $field->args['name'] );
            $meta_value = $field_type_object->field->escaped_value();
            $options    = (array) $field_type_object->field->options();
            $img_size   = $field_type_object->field->args( 'preview_size' );
            $query_args = $field_type_object->field->args( 'query_args' );

            // if options array and 'url' => false, then hide the url field
            $input_type = array_key_exists( 'url', $options ) && false === $options['url'] ? 'hidden' : 'text';

            $html .= printf( $field_type_object->input( array(
                            'type'  => $input_type,
                            'class' => 'cmb2-upload-file regular-text',
                            'size'  => 45,
                            'desc'  => '',
                            'data-previewsize' => is_array( $img_size ) ? '[' . implode( ',', $img_size ) . ']' : 350,
                            'data-queryargs'   => ! empty( $query_args ) ? json_encode( $query_args ) : '',
                            ) )
                    );

            $html .= printf( '<input class="cmb2-upload-button button" type="button" value="%s" />', esc_attr( $field_type_object->_text( 'add_upload_file_text', __( 'Add or Upload File', 'onfleek' ) ) ) );

            $field_type_object->_desc( true, true );

            $cached_id = $field_type_object->_id();

            // Reset field args for attachment ID
            $args = $field_type_object->field->args();
            // If we're looking at a file in a group, we need to get the non-prefixed id
            $args['id'] = ( $field_type_object->field->group ? $field_type_object->field->args( '_id' ) : $cached_id ) . '_id';
            unset( $args['_id'], $args['_name'] );

            // And get new field object
            $field_type_object->field = new CMB2_Field( array(
                'field_args'  => $args,
                'group_field' => $field_type_object->field->group,
                'object_type' => $field_type_object->field->object_type,
                'object_id'   => $field_type_object->field->object_id,
            ) );

            // Get ID value
            $_id_value = $field_type_object->field->escaped_value( 'absint' );

            // If there is no ID saved yet, try to get it from the url
            if ( $meta_value && ! $_id_value ) {
                $_id_value = cmb2_utils()->image_id_from_url( esc_url_raw( $meta_value ) );
            }
            $html .= printf ( $field_type_object->input( array(
                                'type'  => 'hidden',
                                'class' => 'cmb2-upload-file-id',
                                'value' => $_id_value,
                                'desc'  => '',
                                ) ) 
                            );
            $html .= printf ( '<div id="%s" class="cmb2-media-status">', $field_type_object->_id( '-status' ) );
                if ( ! empty( $meta_value ) ) {

                    if ( $field_type_object->is_valid_img_ext( $meta_value ) ) {

                        if ( $_id_value ) {
                            $image = wp_get_attachment_image( $_id_value, $img_size, null, array( 'class' => 'cmb-file-field-image' ) );
                        } else {
                            $size = is_array( $img_size ) ? $img_size[0] : 350;
                            $image = '<img style="max-width: ' . absint( $size ) . 'px; width: 100%; height: auto;" src="' . $meta_value . '" alt="" />';
                        }

                        $field_type_object->img_status_output( array(
                            'image'     => $image,
                            'tag'       => 'div',
                            'cached_id' => $cached_id,
                        ) );

                    } else {

                        $field_type_object->file_status_output( array(
                            'value'     => $meta_value,
                            'tag'       => 'div',
                            'cached_id' => $cached_id,
                        ) );

                    }
                }
            $html .= printf ( '</div>' );
            

            CMB2_JS::add_dependencies( 'media-editor' );
            $html .= printf ( '</div></div></div>' );
        }

        

        function cmb2_render_df_file_list( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
            $html = printf( '<div class="df-row df-col-1" ><div class="df-section-left df-col-5"><h4>%s</h4></div><div class="df-section-right df-col-2"><div class="df-selector">', $field->args['name'] );
            $meta_value = $field_type_object->field->escaped_value();
            $name       = $field_type_object->_name();
            $img_size   = $field_type_object->field->args( 'preview_size' );
            $query_args = $field_type_object->field->args( 'query_args' );

            $html .= printf ( $field_type_object->input( array(
                                'type'  => 'hidden',
                                'class' => 'cmb2-upload-file cmb2-upload-list',
                                'size'  => 45, 'desc'  => '', 'value'  => '',
                                'data-previewsize' => is_array( $img_size ) ? sprintf( '[%s]', implode( ',', $img_size ) ) : 50,
                                'data-queryargs'   => ! empty( $query_args ) ? json_encode( $query_args ) : '',
                                ) )
                            );
            $html .= printf ( $field_type_object->input( array(
                                    'type'  => 'button',
                                    'class' => 'cmb2-upload-button button cmb2-upload-list',
                                    'value'  => esc_html( $field_type_object->_text( 'add_upload_files_text', __( 'Add or Upload Files', 'onfleek' ) ) ),
                                    'name'  => '', 'id'  => '',
                                ) )
                            );
            $html .= printf ( '<ul id="%s" class="cmb2-media-status cmb-attach-list">', $field_type_object->_id( '-status' ) );

            if ( $meta_value && is_array( $meta_value ) ) {

                foreach ( $meta_value as $id => $fullurl ) {
                    $id_input = $field_type_object->input( array(
                        'type'    => 'hidden',
                        'value'   => $fullurl,
                        'name'    => $name . '[' . $id . ']',
                        'id'      => 'filelist-' . $id,
                        'data-id' => $id,
                        'desc'    => '',
                        'class'   => false,
                    ) );

                    if ( $field_type_object->is_valid_img_ext( $fullurl ) ) {

                        $field_type_object->img_status_output( array(
                            'image'    => wp_get_attachment_image( $id, $img_size ),
                            'tag'      => 'li',
                            'id_input' => $id_input,
                        ) );

                    } else {

                        $field_type_object->file_status_output( array(
                            'value'    => $fullurl,
                            'tag'      => 'li',
                            'id_input' => $id_input,
                        ) );

                    }
                }
            }

            $html .= printf ( '</ul>' );

            CMB2_JS::add_dependencies( 'media-editor' );
            $html .= printf ( '</div></div></div>' );
        }

        function cmb2_df_magz_post_before_form () {
            $post_type =  get_post_type( get_the_ID() );

            if ( $post_type == 'post' ) {

                    $meta_box_menu = array(
                        'general'       => array(
                                            'id_menu' => '#general', 
                                            'text_menu' => 'General Layout'
                                            ),
                        'smartlist'     => array(
                                            'id_menu' => '#smartlist', 
                                            'text_menu' => 'Listicle'
                                            ),
                        'mediaembed'    => array(
                                            'id_menu' => '#mediaembed', 
                                            'text_menu' => 'Media Embed'
                                            ),
                        'gallery'       => array(
                                            'id_menu' => '#gallery', 
                                            'text_menu' => 'Gallery'
                                            ),
                        'review'        => array(
                                            'id_menu' => '#review', 
                                            'text_menu' => 'Review'
                                            ),
                        'header'        => array(
                                            'id_menu' => '#header', 
                                            'text_menu' => 'Header'
                                            ),
                        'background'    => array(
                                            'id_menu' => '#background', 
                                            'text_menu' => 'Background'
                                            ),
                        'footer'        => array(
                                            'id_menu' => '#footer', 
                                            'text_menu' => 'Footer'
                                            ),
                    );
            } else {
                    $meta_box_menu = array(
                        'general'        => array(
                                            'id_menu' => '#general', 
                                            'text_menu' => 'General Layout'
                                                ),
                        'postsetting'    => array(
                                            'id_menu' => '#postsetting', 
                                            'text_menu' => 'Post Setting'
                                            ),
                        // 'uniquearticle'  => array(
                        //                     'id_menu' => '#uniquearticle', 
                        //                     'text_menu' => 'Unique Article'
                        //                     ),
                        'header'        => array(
                                            'id_menu' => '#header', 
                                            'text_menu' => 'Header'
                                            ),
                        'background'    => array(
                                            'id_menu' => '#background', 
                                            'text_menu' => 'Background'
                                            ),
                        'footer'        => array(
                                            'id_menu' => '#footer', 
                                            'text_menu' => 'Footer'
                                            ),
                    );
            }

            $html    = '<div class="wrapper"><div class="df-menu">';
            $html   .= '<ul>';

                foreach ($meta_box_menu as $menus => $menu) {
                    $html .= '<li><a href="' . $menu['id_menu']. '">'. $menu['text_menu'].'</a></li>';
                }
          
            $html   .= '</ul></div><div class="df-content">';
           
           printf( $html );
        }


        function cmb2_df_magz_post_after_form () {

            $html   = '</div></div>';
           
            printf( $html );
        }



    }
    new DF_custom_metabox_view();

}


