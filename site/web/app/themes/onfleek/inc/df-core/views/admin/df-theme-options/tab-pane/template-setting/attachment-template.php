					 	<div class="df-to-content-inner">
                            <div class="df-col-1 df-to-section">
                                <div class="df-col-5 df-no-padding">
                                    <div class="field">
                                        <h4>Header Style</h4>
                                        <span class="description">Choose the style for your header, this option will change the header style for Attachment pages</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                    <?php
										DF_Element_Generator::df_html_select(array(
											'name' => array('template_setting', 'attachment_template','header_layout'),
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
                                        <span class="description">Choose the layout style for Attachment pages</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                   	<?php
                                   		DF_Element_Generator::df_html_visual_select(array(
											'name' => array('template_setting', 'attachment_template','layout'),
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
                                        <span class="description">Choose which sidebar widget that you want to use for Attachment pages</span>
                                    </div>
                                </div>
                                <div class="df-col-2">
                                   	<?php
                                   		DF_Element_Generator::df_html_select(array(
                                   			'name' => array('template_setting', 'attachment_template', 'sidebar_widget' ),
                                   			'class' => 'df-to-styled-select',
                                   			'options' => DF_Theme_Options::df_get_sidebar()
                                   		));
                                   	?>
                                </div>
                            </div>
                            
                            
						</div>

						