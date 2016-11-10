					 	<div class="df-to-content-inner">
                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Header Style</h4>
                                        <span class="description">Choose the style for your header, this option will change the header style for 404 page</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <?php
										DF_Element_Generator::df_html_select(array(
											'name' => array('template_setting', '404_template','header_layout'),
											'class'=>'df-to-styled-select',
											'options' => DF_Theme_Options::$header_style
										));
									?>
                                </div>
                            </div>
                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Layout</h4>
                                        <span class="description">Choose the layout style for 404 page</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                   <?php
										DF_Element_Generator::df_html_select(array(
											'name' => array('template_setting', '404_template','layout_404'),
											'class'=>'df-to-styled-select',
											'options' => array(
												array(
													'value' => 'full',
													'text' => 'Full'
												),
												array(
													'value' => 'boxed',
													'text' => 'Boxed'
												),
												array(
													'value' => 'framed',
													'text' => 'Framed'
												)
											)
										));
									?>
                                </div>
                            </div>
                            
                            
                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Custom Background</h4>
                                        <span class="description">enable custom background for your 404 page by choosing solid colour or image upload</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <div>
                                    <?php
                                        DF_Element_Generator::df_html_color_picker(array(
                                            'name' => array('template_setting', '404_template','bg_color'),
                                            'label' => 'Background Color'
                                        ));
                                    ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php
                                        DF_Element_Generator::df_html_select(
                                            array(
                                                'name' => array('template_setting', '404_template','bg_position'),
                                                'options' => DF_Theme_Options::$css_background_position ,
                                                'class' => 'df-to-styled-select'
                                            )
                                        );
                                    ?>
                                    <?php
                                        DF_Element_Generator::df_html_select(array(
                                            'name' => array('template_setting', '404_template','bg_repeat'),
                                            'options' => DF_Theme_Options::$css_background_repeat,
                                            'class' => 'df-to-styled-select'
                                        ));
                                    ?>
                                    <?php
                                        DF_Element_Generator::df_html_select(array(
                                            'name' => array('template_setting', '404_template','bg_attachment'),
                                            'options' => DF_Theme_Options::$css_background_attachment,
                                            'class' => 'df-to-styled-select'
                                        ));
                                    ?>
                                    <?php
                                        DF_Element_Generator::df_html_select(array(
                                            'name' => array('template_setting', '404_template','bg_size'),
                                            'options' => DF_Theme_Options::$css_background_size,
                                            'class' => 'df-to-styled-select'
                                        ));
                                    ?>
                                    <?php
                                        DF_Element_Generator::df_html_uploader(array(
                                            'name'=>array('template_setting', '404_template','bg'),
                                        ));
                                    ?>
                                </div>
                            </div>

                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Title</h4>
                                        <span class="description">Customize your 404 page's title</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <div>
                                    <?php
                                        DF_Element_Generator::df_html_color_picker(array(
                                            'name' => array('template_setting', '404_template','title_color'),
                                            'label' => '404 Title Color'
                                        ));
                                    ?>
                                    </div>

                                    <?php
                                        DF_Element_Generator::df_html_input(array(
                                            'name' => array('template_setting', '404_template', 'title'),
                                            'class' => 'df-to-element df-input-styled'
                                        ));                                    
                                    ?>

                                </div>
                            </div>

                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Sub Title</h4>
                                        <span class="description">Customize your 404 page's sub title</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <div>
                                    <?php
                                        DF_Element_Generator::df_html_color_picker(array(
                                            'name' => array('template_setting', '404_template','subtitle_color'),
                                            'label' => '404 Sub Title Color'
                                        ));
                                    ?>
                                    </div>
                                    <?php
                                        DF_Element_Generator::df_html_input(array(
                                            'name' => array('template_setting', '404_template', 'subtitle'),
                                             'class' => 'df-to-element df-input-styled'
                                        ));
                                    ?>
                                </div>
                            </div>

                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Article Display Preview</h4>
                                        <span class="description">Choose the Article Display Layout for 404 page</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <?php
                                        DF_Element_Generator::df_html_visual_select(array(
                                            'name' => array('template_setting', '404_template','article_display_preview'),
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
                            
                            
						</div>

						