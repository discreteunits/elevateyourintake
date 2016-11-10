<div class="df-to-content-inner">
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Enable Page Transition</h4>
                <span class="description">Enabling this option will add animation when revealing a new page.</span>
            </div>
        </div>
        <div class="df-col-2">
             <?php
                DF_Element_Generator::df_html_switch(array(
                                    'name'=> array('general', 'page_transition', 'is_page_transition'),
                                    'additional' => array(
                                        'event' => 'change',
                                        'type' => 'non-ajax',
                                        'area' => 'detail-page-transition'
                                        )
                                    ));
            ?>
        </div>
    </div>

</div>
<div id="detail-page-transition">
    <div class="df-to-content-inner">
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Transition Animation</h4>
                    <span class="description">Select the animation on page load.</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('general','page_transition', 'animation_transition'),
                        'class' => 'df-to-styled-select',
                        'options' => array(
                            array(
                                'value' => 'fade-in',
                                'text' => 'Fade In'
                            ),
                            array(
                                'value' => 'fade-in-down-sm',
                                'text' => 'Fade Down Small'
                            ),
                            array(
                                'value' => 'fade-in-up-sm',
                                'text' => 'Fade Up Small'
                            ),
                            array(
                                'value' => 'fade-in-left-sm',
                                'text' => 'Fade Left Small'
                            ),
                            array(
                                'value' => 'fade-in-right-sm',
                                'text' => 'Fade Right Small'
                            )
                        )
                    ));
                ?>
           </div>

        </div>

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Preloader Style</h4>
                    <span class="description">Choose to use CSS or custom image for your animation</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_select( array(
                        'name' => array( 'general', 'page_transition', 'preloader_style'),
                        'class' => 'df-to-styled-select',
                        'options' => array(
                            array(
                                'value' => 'none',
                                'text' => 'None'
                            ),
                            array( 
                                'value' => 'css-animation',
                                'text' => 'CSS Animation'
                            ),
                            array( 
                                'value' => 'image',
                                'text' => 'Image'
                            )
                        )
                    ));
                ?>
            </div>

        </div>
        
        <!-- PRELOADER STYLE = CSS ANIMATION -->
        <div id="detail-load-css-animation">
            <div class="df-col-1 df-to-section">
                <div class="df-col-5 df-no-padding">
                    <div class="field">
                        <h3>CSS animation</h3>
                        <h4>Loader Style</h4>
                        <span class="description">Choose the style for your loading animation</span>
                    </div>
                </div>
                <div class="df-col-2">
                    <?php
                        DF_Element_Generator::df_html_select( array(
                            'name' => array( 'general', 'page_transition', 'css_animation', 'loader_style'),
                            'class' => 'df-to-styled-select',
                            'options' => array(
                                array(
                                    'value' => 'style-1',
                                    'text' => 'Style 1'
                                ),
                                array( 
                                    'value' => 'style-2',
                                    'text' => 'Style 2'
                                ),
                                array( 
                                    'value' => 'style-3',
                                    'text' => 'Style 3'
                                ),
                                array( 
                                    'value' => 'style-4',
                                    'text' => 'Style 4'
                                ),
                                array( 
                                    'value' => 'style-5',
                                    'text' => 'Style 5'
                                ),
                                array( 
                                    'value' => 'style-6',
                                    'text' => 'Style 6'
                                )
                            )
                        ));
                    ?>
                </div>
            </div>

            <div class="df-col-1 df-to-section">
                <div class="df-col-5 df-no-padding">
                    <div class="field">
                        <h4>Loader Colour</h4>
                        <span class="description">Pick the colour of your loading animation</span>
                    </div>
                </div>
                <div class="df-col-2">
                    <?php
                        DF_Element_Generator::df_html_color_picker(array(
                            'name'=>array('general','page_transition','css_animation', 'loader_color')
                        ),'Color');
                    ?>
                </div>
            </div>
        </div>
        
        <!-- PRELOADER STYLE = IMAGE -->
        <div id="detail-load-image">

            <div class="df-col-1 df-to-section">
                <div class="df-col-5 df-no-padding">
                    <div class="field">
                        <h3>Custom Image</h3>
                        <h4>Upload Loader Image</h4>
                        <span class="description">Upload Custom Image for your Page transition animation</span>
                    </div>
                </div>
                <div class="df-col-2">
                    <?php
                        DF_Element_Generator::df_html_uploader(array(
                            'name'=>array('general','page_transition','image', 'loader_image')
                        ));
                    ?>
                </div>
            </div>
        </div>
        

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Loading Page Background Colour</h4>
                    <span class="description">Pick the Background colour of the transition page</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_color_picker(array(
                        'name'=>array('general','page_transition','preloader_bg_color')
                    ),'Color');
                ?>
            </div>

        </div>

    </div>
</div>
