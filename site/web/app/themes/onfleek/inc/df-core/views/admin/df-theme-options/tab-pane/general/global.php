    <div class="df-to-content-inner">
    <div class="df-col-1 df-to-section">
        
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Header Style</h4>
                <span class="description">Choose the style for your header, You can customize it further in header section.  See live preview (link)</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_select(array(
                    'name' => array('general', 'global','header_layout'),
                    'class' => 'df-to-styled-select',
                    'options' => DF_Theme_Options::$global_header_style
                ));
            ?>
       </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Top Bar</h4>
                <span class="description">Hide or show the topbar.</span>
            </div>
        </div>
        <div class="df-col-2">
             <?php
                DF_Element_Generator::df_html_switch(array(
                    'name'=> array('general', 'global', 'is_topbar')
                ));
            ?>
        </div>
    </div>
    
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Content Area Layout</h4>
                <span class="description">Choose the layout of your content area.</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
				DF_Element_Generator::df_html_select(array(
					'name' => array('general', 'global','layout'),
                    'class' => 'df-to-styled-select',
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
                <h4>Body Background Color</h4>
                <span class="description">Pick the default Body Background Color for your website.</span>
            </div>
        </div>
        <div class="df-col-2">
            <div class="inline df-to-typography">
                <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'      =>array('general', 'global','body_bg_color'),
                    'label'     => 'Background'
                ));
                ?>
            </div>
        </div>
    </div>

    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Outer Background Color</h4>
                <span class="description">Pick the default outer Background Color for your website. Outer background only available for <strong>boxed</strong> or <strong>framed</strong> layout</span>
            </div>
        </div>
        <div class="df-col-2">
            <div class="inline df-to-typography">
                    <?php
                        DF_Element_Generator::df_html_color_picker(array(
                            'name'=>array('general','global','bg_color'),
                            'label' => 'Background Color'
                        ));
                    ?>
                <div class="clearfix"></div>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('general','global','bg_position'),
                        'options' => DF_Theme_Options::$css_background_position ,
                        'class' => 'df-to-styled-select'
                    )
                    );
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('general','global','bg_repeat'),
                        'options' => DF_Theme_Options::$css_background_repeat,
                        'class' => 'df-to-styled-select'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('general','global','bg_attachment'),
                        'options' => DF_Theme_Options::$css_background_attachment,
                        'class' => 'df-to-styled-select'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('general','global','bg_size'),
                        'options' => DF_Theme_Options::$css_background_size,
                        'class' => 'df-to-styled-select'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_uploader(array(
                        'name'=>array('general','global','bg_img'),
                    ));
                ?>    
            </div>
        </div>
    </div>


    


    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Disable comment on pages</h4>
                <span class="description">Enabling this option will hide the comment box in normal pages.</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
				DF_Element_Generator::df_html_switch(array(
									'name'=>array('general', 'global','is_comment_on_page')
								));
			?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Enable Lazy load</h4>
                <span class="description">Enabling this option will turn on lazy load in your site.</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
				DF_Element_Generator::df_html_switch(array(
									'name'=>array('general', 'global','is_lazy_loading')
								   )
                                );
			?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Enable Sticky Sidebar</h4>
                <span class="description">Enabling this option will turn your sidebar to sticky sidebar.</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
				DF_Element_Generator::df_html_switch(array(
									'name'=>array('general', 'global','is_sticky_sidebar')
								));
			?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Enable Back to Top</h4>
                <span class="description">Enabling this option will turn on back to top button</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_switch(array(
                                    'name'=>array('general', 'global','is_back_to_top_button')
                                ));
            ?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Default Feature image</h4>
                <span class="description">Upload the default image for your posts. This will only shown in posts without featured image</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_uploader(array(
                                    'name'=>array('general', 'global','default_feature_image')
                                ));
            ?>
        </div>
    </div>
</div>
