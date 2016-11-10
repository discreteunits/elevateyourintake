                    <div class="df-to-content-inner">
                        <div class="df-col-1">
                            <table class="form-table table">
                                <tbody>
                                    <tr>
                                        <th class="col-sm-12 col-lg-5">
                                            <div class="field">
                                                <h4>Layout ( only happen in content )</h4>
                                                <span class="description">This will alter the overall styling of various theme elements</span>
                                            </div>
                                        </th>
                                        <th class="opt-wrapp col-sm-12 col-lg-7">
                                            <?php
												DF_Element_Generator::df_html_select(array(
													'module' => 'df-magz-theme-options',
													'section' => 'global',
													'name' => 'layout',
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
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <table class="form-table table">
                                <tbody>
                                    <tr>
                                        <th class="col-sm-12 col-lg-5">
                                            <div class="field">
                                                <h4>Disable Comment On Pages</h4>
                                                <span class="description">This will alter the overall styling of various theme elements</span>
                                            </div>
                                        </th>
                                        <th class="opt-wrapp col-sm-12 col-lg-7">
                                            <?php
												DF_Element_Generator::df_html_switch(array(
																	'module'=>'df-magz-theme-options',
																	'section'=>'global',
																	'name'=>'is_comment_on_page'
																));
											?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <table class="form-table table">
                                <tbody>
                                    <tr>
                                        <th class="col-sm-12 col-lg-5">
                                            <div class="field">
                                                <h4>Lazy Loading</h4>
                                                <span class="description">This will alter the overall styling of various theme elements</span>
                                            </div>
                                        </th>
                                        <th class="opt-wrapp col-sm-12 col-lg-7">
                                            <?php
												DF_Element_Generator::df_html_switch(array(
																	'module'=>'df-magz-theme-options',
																	'section'=>'global',
																	'name'=>'is_lazy_loading'
																   )
                                                                );
											?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <table class="form-table table">
                                <tbody>
                                    <tr>
                                        <th class="col-sm-12 col-lg-5">
                                            <div class="field">
                                                <h4>Sticky SideBar</h4>
                                                <span class="description">This will alter the overall styling of various theme elements</span>
                                            </div>
                                        </th>
                                        <th class="opt-wrapp col-sm-12 col-lg-7">
                                            <?php
												DF_Element_Generator::df_html_switch(array(
																	'module'=>'df-magz-theme-options',
																	'section'=>'global',
																	'name'=>'is_sticky_sidebar'
																));
											?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <table class="form-table table">
                                <tbody>
                                    <tr>
                                        <th class="col-sm-12 col-lg-5">
                                            <div class="field">
                                                <h4>Back To Top Button</h4>
                                                <span class="description">This will alter the overall styling of various theme elements</span>
                                            </div>
                                        </th>
                                        <th class="opt-wrapp col-sm-12 col-lg-7">
                                            <?php
												DF_Element_Generator::df_html_switch(array(
																	'module'=>'df-magz-theme-options',
																	'section'=>'global',
																	'name'=>'is_back_to_top_button'
																));
											?>
                                        </th>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <table class="form-table table">
                                <tbody>
                                    <tr>
                                        <th class="col-sm-12 col-lg-5">
                                            <div class="field">
                                                <h4>Default Feature Image</h4>
                                                <span class="description">This will alter the overall styling of various theme elements</span>
                                            </div>
                                        </th>
                                        <th class="opt-wrapp col-sm-12 col-lg-7">
                                            <?php
												DF_Element_Generator::df_html_uploader(array(
																	'module'=>'df-magz-theme-options',
																	'section'=>'global',
																	'name'=>'default_feature_image'
																));
											?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
