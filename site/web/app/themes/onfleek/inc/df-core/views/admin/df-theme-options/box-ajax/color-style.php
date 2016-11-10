						<div class="df-col-1 df-to-section">
                            <div class="df-col-5 df-no-padding">
                                <div class="field">
                                    <h4>Disable Comment On Pages</h4>
                                    <span class="description">This will alter the overall styling of various theme elements</span>
                                </div>
                            </div>
                            <div class="df-col-2">
                                <?php
									DF_Element_Generator::df_html_switch(array(
														'name'=>array('global','is_comment_on_page')
													));
								?>
                            </div>
                        </div>