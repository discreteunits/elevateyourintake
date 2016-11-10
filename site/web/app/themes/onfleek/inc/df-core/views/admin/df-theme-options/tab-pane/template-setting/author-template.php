					 	<div class="df-to-content-inner">
                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Header Layout </h4>
                                        <span class="description">This will alter the overall styling of various theme elements</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <?php
										DF_Element_Generator::df_html_select(array(
											'name' => array('template_setting', 'author_template','header_layout'),
											'class'=>'df-to-styled-select',
											'options' => DF_Theme_Options::$header_style
										));
									?>
                                </div>
                            </div>
                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Article Display Preview</h4>
                                        <span class="description">This will alter the overall styling of various theme elements</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <?php
                                        DF_Element_Generator::df_html_visual_select(array(
                                            'name' => array('template_setting', 'author_template','article_display_preview'),
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
                                        <h4>Layout</h4>
                                        <span class="description">This will alter the overall styling of various theme elements</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <?php
                                        DF_Element_Generator::df_html_visual_select(array(
                                            'name' => array('template_setting', 'author_template','layout'),
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
                                        <h4>Sidebar Widget </h4>
                                        <span class="description">This will alter the overall styling of various theme elements</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <?php
                                        DF_Element_Generator::df_html_select(array(
                                            'name' => array('template_setting', 'author_template', 'sidebar_widget' ),
                                            'class' => 'df-to-styled-select',
                                            'options' => DF_Theme_Options::df_get_sidebar()
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
											'name' => array('template_setting','author_template','pagination'),
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
                            
						</div>

						