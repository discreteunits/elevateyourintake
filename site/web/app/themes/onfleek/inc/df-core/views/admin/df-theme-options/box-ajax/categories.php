        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Content Area Layout</h4>
                    <span class="description">Choose the layout of your category archive page content area</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array( 'categories', 'per_category', $extended_view['dataID'], 'content_area_layout'),
                        'class' => 'df-to-styled-select',
                        'options' => array(
                            array(
                                'value' => 'default',
                                'text' => 'Inherit/Default'
                            ),
                            array(
                                'value' => 'full',
                                'text' => 'Full'
                            ),
                            array(
                                'value' => 'boxed',
                                'text' => 'Boxed'
                            ),
                            array(
                                'value' => 'frame',
                                'text' => 'Frame'
                            )
                        )
                    ));
                ?>
            </div>
        </div>
        
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Category Color</h4>
                    <span class="description">Pick the Body Backgorund colour for this category archive page</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_color_picker(array(
                        'name'=>array('categories', 'per_category', $extended_view['dataID'],'category_color')
                    ),'Color');
                ?>
            </div>
        </div>

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Outer Background Colour</h4>
                    <span class="description">Pick the outer Backgorund colour for this category archive page. Outer background only available for boxed or framed layout</span>
                </div>
            </div>
            <div class="df-col-2">
                <div>
                <?php
                        DF_Element_Generator::df_html_color_picker(array(
                            'name'=>array('categories', 'per_category', $extended_view['dataID'],'bg_color')
                        ),'Background Color');
                    ?>
                </div>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('categories', 'per_category', $extended_view['dataID'],'bg_position'),
                        'options' => DF_Theme_Options::$css_background_position ,
                        'class' => 'df-to-styled-select'
                    )
                    );
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('categories', 'per_category', $extended_view['dataID'],'bg_repeat'),
                        'options' => DF_Theme_Options::$css_background_repeat,
                        'class' => 'df-to-styled-select'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('categories', 'per_category', $extended_view['dataID'],'bg_attachment'),
                        'options' => DF_Theme_Options::$css_background_attachment,
                        'class' => 'df-to-styled-select'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('categories', 'per_category', $extended_view['dataID'],'bg_size'),
                        'options' => DF_Theme_Options::$css_background_size,
                        'class' => 'df-to-styled-select'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_uploader(array(
                        'name'=>array('categories', 'per_category', $extended_view['dataID'],'bg'),
                    ));
                ?>
            </div>
        </div>

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Header Style</h4>
                    <span class="description">Choose the header style for this particular category archive page</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('categories', 'per_category', $extended_view['dataID'], 'header_layout'),
                        'class'=>'df-to-styled-select',
                        'options' => DF_Theme_Options::$header_style
                    ));
                ?>
            </div>
        </div>

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Category Title Template</h4>
                    <span class="description">Choose the Category archive page title style. Only affect this particular category</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_visual_select(array(
                        'name' => array('categories', 'per_category', $extended_view['dataID'], 'category_title_template'),
                        'class'=>'df-to-styled-select',
                        'options' => array(
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/default.png',
                                'value' => 'default'
                            ),
                            array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/category-title-1.png',
                            	'value' => 'layout-1'
                            ),
                             array(
                            	'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/category-title-2.png',
                            	'value' => 'layout-2'
                            )
                        )
                    ));
                ?>
            </div>
        </div>
        
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Category Top Post Style</h4>
                    <span class="description">Choose Custom Styling  for your top posts in this particular category</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_visual_select(array(
                        'name' => array('categories', 'per_category', $extended_view['dataID'], 'category_top_post_style'),
                        'class'=>'df-to-styled-select',
                        'options' => array(
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/default.png',
                                'value' => 'default'
                            ),
							array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/none.png',
                                'value' => 'none'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/top-category-1.png',
                                'value' => 'layout-1'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/top-category-2.png',
                                'value' => 'layout-2'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/top-category-3.png',
                                'value' => 'layout-3'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/top-category-4.png',
                                'value' => 'layout-4'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/top-category-5.png',
                                'value' => 'layout-5'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/top-category-6.png',
                                'value' => 'layout-6'
                            ),
                        )
                    ));
                ?>
            </div>
        </div>
        
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Article Display Preview </h4>
                    <span class="description">Choose the Article Display Layout in this particular category</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_visual_select(array(
                         'name' => array('categories', 'per_category', $extended_view['dataID'], 'article_display_preview'),
                        'class'=>'df-to-styled-select',
                        'options' => array(
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/default.png',
                                'value' => 'default'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/archive-1.png',
                                'value' => 'layout-1'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/archive-2.png',
                                'value' => 'layout-2'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/archive-3.png',
                                'value' => 'layout-3'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/archive-4.png',
                                'value' => 'layout-4'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/archive-5.png',
                                'value' => 'layout-5'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/archive-6.png',
                                'value' => 'layout-6'
                            )
                        )
                    ));
                ?>
            </div>
        </div>

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Pagination</h4>
                    <span class="description">Set The Pagination Style for this category archive page</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('categories', 'per_category', $extended_view['dataID'], 'pagination'),
                        'class'=>'df-to-styled-select',
                        'options' => array(
                           array(
                                'value' => 'default',
                                'text' => 'Inherit/Default'
                            ), 
                         
                            array(
                                'value' => 'normal-pagination',
                                'text' => 'Normal Pagination'
                            ), 
                            array(
                                'value' => 'load-more-infinite-scroll',
                                'text' => 'Load More Infinite Scroll'
                            )
                        )
                    ));
                ?>
            </div>
        </div>

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Layout</h4>
                    <span class="description">Choose the layout style for this category archive page</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_visual_select(array(
                        'name' => array('categories', 'per_category', $extended_view['dataID'], 'category_layout'),
                        'class'=>'df-to-styled-select',
                        'options' => array(
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/default.png',
                                'value' => 'default'
                            ),
                            array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/full.png',
                                'value' => 'fullwidth'
                            ),
                             array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/sidebar-left.png',
                                'value' => 'sidebar-left'
                            ),
                              array(
                                'img' => get_template_directory_uri().'/inc/df-core/asset/images/admin/sidebar-right.png',
                                'value' => 'sidebar-right'
                            )
                        )
                    ));
                ?>
            </div>
        </div>
            
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Sidebar Widget </h4>
                    <span class="description">Choose which sidebar widget that you want to use for this category archive page</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array( 'categories', 'per_category', $extended_view['dataID'], 'sidebar_widget' ),
                        'class' => 'df-to-styled-select',
                        'options' => DF_Theme_Options::df_get_sidebar()
                    ));
                ?>
            </div>
        </div>