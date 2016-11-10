 	<div class="df-to-content-inner">
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Header Style</h4>
                    <span class="description">Choose the header style for category archive page, this option WILL override your global header style setting</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
					DF_Element_Generator::df_html_select(array(
						'name' => array('categories','header_layout'),
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
                    <span class="description">Choose the Category archive page title style</span>
                </div>
            </div>
            <div class="df-col-2">
               	<?php
               		DF_Element_Generator::df_html_visual_select(array(
						'name' => array('categories','category_title_template'),
						'class'=>'df-to-styled-select',
						'options' => array(
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
                    <span class="description">Choose Custom Styling  for your top posts in each category</span>
                </div>
            </div>
            <div class="df-col-2">
               	<?php
                    DF_Element_Generator::df_html_visual_select(array(
                        'name' => array('categories','category_top_post_style'),
                        'class'=>'df-to-styled-select',
                        'options' => array(
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
                            )
                        )
                    ));
                ?>
            </div>
        </div>
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Carousel Auto Play</h4>
                    <span class="description">Enable auto play for top post carousel in archive pages</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_switch(array(
                                        'name'=>array('categories', 'is_auto_play_carousel')
                                    ));
                ?>
            </div>
            <div class="df-col-2">
                <?php
                        DF_Element_Generator::df_html_input(array(
                                            'name'=>array('categories','auto_play_speed'),
                                            'class'     => 'df-input-styled',
                                            'description' => 'Duration of animation between slides (in ms).'
                                        ));
                    ?>
            </div>
        </div>
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Article Display Preview</h4>
                    <span class="description">Choose the Article Display Layout in for all  category archive page</span>
                </div>
            </div>
            <div class="df-col-2">
               	<?php
                    DF_Element_Generator::df_html_visual_select(array(
                        'name' => array('categories','article_display_preview'),
                        'class'=>'df-to-styled-select',
                        'options' => array(
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
                    <span class="description">Set The Pagination Style for all your category archive page</span>
                </div>
            </div>
            <div class="df-col-2">
               	<?php
               		DF_Element_Generator::df_html_select(array(
						'name' => array('categories','pagination'),
						'class'=>'df-to-styled-select',
						'options' => array(
 
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
                    <span class="description">Choose the layout style for all your category archive page</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_visual_select(array(
                        'name' => array('categories','category_layout'),
                        'class'=>'df-to-styled-select',
                        'options' => array(
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
                    <h4>Sidebar Widget</h4>
                    <span class="description">Choose which sidebar widget that you want to use for all your category archive page</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array( 'categories', 'sidebar_widget' ),
                        'class' => 'df-to-styled-select',
                        'options' => DF_Theme_Options::df_get_sidebar()
                    ));
                ?>
            </div>
        </div>
        
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Custom Category Setting</h4>
                    <span class="description">Further customize each of your category archive page, this WILL override your global settings</span>
                </div>
            </div>
        </div>
        <?php

        hierarchy_cat_tree(0);

        function hierarchy_cat_tree($cat){
            $args_cat = array(
                "orderby"   => "name",
                "order"     => "ASC",
                "parent"    => $cat
            );
            $categories = get_categories( $args_cat );
            $parent = '';
            foreach($categories as $category) { 
                
                if( $category->parent != 0 ){
                    $parent = get_the_category_by_ID( $category->parent ). ' > ';
                }
                DF_Element_Generator::html_box_ajax(array(
                    'title' => $parent.$category->name,
                    'view' => 'categories',
                    'id'    => $category->cat_ID
                ));
                hierarchy_cat_tree( $category->term_id );
            }
        }
        ?>
	</div>

	