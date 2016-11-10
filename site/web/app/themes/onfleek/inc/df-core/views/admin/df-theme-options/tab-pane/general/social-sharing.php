 <div class="df-to-content-inner">
	<div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Single Post Share</h4>
                <span class="description">Enabling this option will add sharing button in your single post</span>
            </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_switch(array(
                	'name' => array('general', 'social_sharing','is_share_single_post')
                ));
            ?>
        </div>
    </div>
<?php
	/**
	 * Check if WooCommerce is active
	 **/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
	<div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Share on Single Product Woocommerce </h4>
                <span class="description">Active or Deactive Social Sharing in Single Product Woocommerce</span>
            </div>
        </div>
        <div class="df-col-2">
             <?php
                DF_Element_Generator::df_html_switch(array(
                    'name' => array('general', 'social_sharing','is_share_single_woocommerce')
                ));
            ?>
        </div>
    </div>	
	<?php
	}
?>

    

    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Sharing Button</h4>
                <span class="description">Choose sharing option that you want to enable in your single post</span>
            </div>
        </div>
        <div class="df-col-2">
             <?php
                DF_Element_Generator::df_html_checkbox(array(
                   'name' =>  array('general', 'social_sharing','sharing_button', 'facebook'),
                   'label' => 'facebook'
                ));
                DF_Element_Generator::df_html_checkbox(array(
                   'name' =>  array('general', 'social_sharing','sharing_button', 'pinterest'),
                   'label' => 'pinterest'
                ));
                DF_Element_Generator::df_html_checkbox(array(
                   'name' =>  array('general', 'social_sharing','sharing_button', 'twitter'),
                   'label' => 'twitter'
                ));
                DF_Element_Generator::df_html_checkbox(array(
                   'name' =>  array('general', 'social_sharing','sharing_button', 'mail'),
                   'label' => 'mail'
                ));
                DF_Element_Generator::df_html_checkbox(array(
                   'name' =>  array('general', 'social_sharing','sharing_button', 'google-plus'),
                   'label' => 'google-plus'
                ));
                DF_Element_Generator::df_html_checkbox(array(
                   'name' =>  array('general', 'social_sharing','sharing_button', 'linkedin'),
                   'label' => 'linkedin'
                ));
            ?>
        </div>
    </div>
    <div class="df-col-1 df-to-section">
        <div class="df-col-5 df-no-padding">
            <div class="field">
                <h4>Sharing Button Style</h4>
                <span class="description">Choose your sharing button styling</span>
        </div>
        </div>
        <div class="df-col-2">
            <?php
                DF_Element_Generator::df_html_select(array(
                                        'name' => array('general', 'social_sharing','button_style'),
                                        'class'=>'df-to-styled-select',
                                        'options' => array(
                                                array(
                                                    'value' => 'share-1',
                                                    'text' => 'Style 1'
                                                ),
                                                array(
                                                    'value' => 'share-2',
                                                    'text' => 'Style 2'
                                                ),
                                            )
                                        ));
            ?>
        </div>
    </div>
 </div>