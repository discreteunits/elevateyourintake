<div class="df-to-content-inner">
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Enable Breadcrumb</h4>
                <span class="description">Enabling this option will add breadcrumb in your site</span>
            </div>
        </div>
        <div class="df-col-2">
             <?php
                DF_Element_Generator::df_html_switch(array(
                    'name'=> array('general', 'breadcrumb', 'is_breadcrumbs'),
                    'additional' => array(
                        'event' => 'change',
                        'type' => 'non-ajax',
                        'area' => 'detail-breadcrumb'
                        )
                ));
            ?>
        </div>
    </div>
</div>

<div id="detail-breadcrumb">
    <div class="df-to-content-inner">
        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Enable 'home' link in breadcrumb</h4>
                    <span class="description">By enabling this option your breadcrumb will start from 'home'</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_switch(array(
                        'name'=> array('general','breadcrumb', 'is_show_home_link')
                    ));
                ?>
            </div>
        </div>

        <div class="df-col-1 df-to-section">
            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Enable parent link in breadcrumb</h4>
                    <span class="description">by enabling this option your breadcrumb will show parent link after home link</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_switch(array(
                        'name'=> array('general', 'breadcrumb', 'is_show_parent')
                    ));
                ?>
            </div>
        </div>

        <div class="df-col-1 df-to-section">

            <div class="df-col-5 df-no-padding">
                <div class="field">
                    <h4>Enable article title in breadcrumb</h4>
                    <span class="description">by enabling this option your breadcrumb will show article title</span>
                </div>
            </div>
            <div class="df-col-2">
                <?php
                    DF_Element_Generator::df_html_switch(array(
                        'name'=> array('general', 'breadcrumb', 'is_show_article_title')
                    ));
                ?>
            </div>
        </div>
    </div>
</div>