<div class="df-to-content-inner">
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Header Logo Top Padding</h4>
                <span class="description">Customize the top padding of your header area</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_slider_bar(array(
                    'name'=>array('header','header_style_6','header_logo_top_padding')
                ));
            ?>
        </div>
    </div>

    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Header Logo Bottom Padding</h4>
                <span class="description">Customize the bottom padding of your header area</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_slider_bar(array(
                    'name'=>array('header','header_style_6','header_logo_bottom_padding')
                ));
            ?>
        </div>
    </div>


    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h3>LIGHT HEADER</h3>
                <h4>Navigation Text Colour</h4>
                <span class="description">Customize the Text colour of your navigation area for Light Header variant</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'=>array('header','header_style_6','nav_text_color_light','regular_color')
                ),'Regular Color');
            ?>
            <div>
                <?php
                    DF_Element_Generator::df_html_color_picker(array(
                        'name'=>array('header','header_style_6','nav_text_color_light','hover_color')
                    ),'Hover Color');
                ?>
            </div>
        </div>                                      
    </div>  

    
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h3>DARK HEADER</h3>
                <h4>Navigation Text Colour</h4>
                <span class="description">Customize the Text colour of your navigation area for Dark Header variant</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'=>array('header','header_style_6','nav_text_color_dark','regular_color')
                ),'Regular Color');
            ?>
            <div>
            <?php
                DF_Element_Generator::df_html_color_picker(array(
                    'name'=>array('header','header_style_6','nav_text_color_dark','hover_color')
                ),'Hover Color');
            ?> 
            </div>                                        
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Search</h4>
                <span class="description">Enable/disable search feature in your header area</span>
            </div>
        </div>
        <div class="df-col-2">
        <?php
            DF_Element_Generator::df_html_switch(array(
                'name'=>array('header','header_style_6','search')
            ));
        ?>
        </div>
    </div>
</div>
<div id="header-style-5-detail">
    <div class="df-to-content-inner">
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Social Icon Topbar</h4>
                    <span class="description">Enable/disable Social Icon in your Topbar area</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_switch(array(
                        'name'=>array('header','header_style_6','social_icon_topbar')
                    ));
                ?>
            </div>
        </div>
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h3>LIGHT HEADER</h3>
                    <h4>Topbar Text Color</h4>
                    <span class="description">Customize the Text colour of your topbar area. Only changes the Light Header</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_color_picker(array(
                        'name'=>array('header','header_style_6','topbar_text_color_light','regular_color')
                    ),'Regular Color');
                ?>
                <div>
                <?php
                    DF_Element_Generator::df_html_color_picker(array(
                        'name'=>array('header','header_style_6','topbar_text_color_light','hover_color')
                    ),'Hover Color');
                ?>
                </div>
            </div>                                      
        </div>  
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Topbar Bottom Border Color</h4>
                    <span class="description">Customize the bottom border of your topbar area. Only changes the Light Header</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_numeric(array(
                        'name'=>array('header','header_style_6','topbar_bottom_border_light','border'),
                        'class' => 'df-input-styled'
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('header','header_style_6','topbar_bottom_border_light','style'),
                        'class' => 'df-to-styled-select',
                        'options' => DF_Theme_Options::$css_border_style
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_color_picker(array(
                        'name'=>array('header','header_style_6','topbar_bottom_border_light','color'),
                    ),'Bottom Border Color');
                ?>
                <?php
                    DF_Element_Generator::df_html_slider_bar(array(
                        'name'=>array('header','header_style_6','topbar_bottom_border_light','opacity')
                    ));
                ?>
            </div>
        </div>
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h3>DARK HEADER</h3>
                    <h4>Topbar Text Color</h4>
                    <span class="description">Customize the Text colour of your topbar area. Only changes the Dark Header</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_color_picker(array(
                                        'name'=>array('header','header_style_6','topbar_text_color_dark','regular_color')
                                    ),'Regular Color');
                ?>
                <div>
                    <?php
                        DF_Element_Generator::df_html_color_picker(array(
                                            'name'=>array('header','header_style_6','topbar_text_color_dark','hover_color')
                                        ),'Hover Color');
                    ?> 
                </div>                                        
            </div>
        </div>  
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Topbar Bottom Border Color</h4>
                    <span class="description">Customize the bottom border of your topbar area. Only changes the Dark Header</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_numeric(array(
                                    'name'=>array('header','header_style_6','topbar_bottom_border_dark','border'),
                                    'class' => 'df-input-styled'
                                ));
                ?>
                <?php
                    DF_Element_Generator::df_html_select(array(
                        'name' => array('header','header_style_6','topbar_bottom_border_dark','style'),
                        'class' => 'df-to-styled-select',
                        'options' => DF_Theme_Options::$css_border_style
                    ));
                ?>
                <?php
                    DF_Element_Generator::df_html_color_picker(array(
                        'name'=>array('header','header_style_6','topbar_bottom_border_dark','color'),
                    ),'Bottom Border Color');
                ?>
                <?php
                    DF_Element_Generator::df_html_slider_bar(array(
                        'name'=>array('header','header_style_6','topbar_bottom_border_dark','opacity')
                    ));
                ?>
            </div>
        </div>
    </div>
</div>