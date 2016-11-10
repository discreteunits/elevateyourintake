	<div class="df-to-content-inner">
	<h3>Twitter OAUTH</h3>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Twitter Username</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php

					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'twitter', 'username'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
				<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Twitter UserID</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php

					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'twitter', 'userid'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Consumer Key</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'twitter', 'consumer_key'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Consumer Secret</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'twitter', 'consumer_secret'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Access Token</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'twitter', 'access_token'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Access Token Secret</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'twitter', 'access_token_secret'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Twitter Auto Post</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
					'name'=>array('social_account','oauth','twitter', 'auto_post')
				));
				?>
			</div>
		</div>
	<h3>Facebook OAUTH</h3>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Facebook Page ID</h4>
					<span class="description">Find your facebook page ID in Facebook page >> about >> bottom of Page Info</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'facebook', 'page_id'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Facebook Username</h4>
					<span class="description">Find your username in your facebook account settings</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'facebook', 'username'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Facebook App ID</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'facebook', 'app_id'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Facebook App Secret</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'facebook', 'app_secret'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Authorize Facebook</h4>
				</div>
			</div>
			<div class="df-col-2">
			<?php
			$redirect_uri =  get_admin_url().'admin.php?page=df_theme_options';
			$options=DF_Global_Options::$options;
			$app_id = isset( $options['social_account']['oauth']['facebook']['app_id'] ) ? $options['social_account']['oauth']['facebook']['app_id'] : '';
			$app_secret = isset( $options['social_account']['oauth']['facebook']['app_secret'] ) ? $options['social_account']['oauth']['facebook']['app_secret'] : '';
			$page_id = isset( $options['social_account']['oauth']['facebook']['page_id'] ) ? $options['social_account']['oauth']['facebook']['page_id'] : '';
			?>
				<a href="https://www.facebook.com/dialog/oauth?client_id=<?php echo esc_attr( $app_id ) ?>&scope=publish_actions,manage_pages,publish_pages,user_managed_groups,user_posts,user_photos&state=df-fb-auth-0&redirect_uri=<?php echo urlencode($redirect_uri); ?>">Authorize Your Facebook Account</a>

				<?php
					if ( isset( $app_id ) && isset( $app_secret ) && isset( $page_id ) ) {
						printf( DF_Social_Media::df_init_facebook( ) ); 
					}
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Facebook Auto Post</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_switch(array(
					'name'=>array('social_account','oauth','facebook', 'auto_post')
				));
				?>
			</div>
		</div>
	<h3>Instagram OAUTH</h3>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Instagram ID</h4>
					<span class="description">You can use this tool to generate your instagram ID</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'instagram', 'instagram_id'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Instagram Username</h4>
					<span class="description">Simply input your Instagram username here</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'instagram', 'username'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Instagram App ID</h4>
					<span class="description">Simply input your Instagram App ID here</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'instagram', 'app_id'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Access Token</h4>
					<span class="description">Click here for the tutorial on getting your Access token</span>
				</div>
			</div>
			<div class="df-col-2">

			<?php
			$redirect_uri =  get_admin_url().'admin.php?page=df_theme_options';

			$options=DF_Global_Options::$options;
			$options=DF_Global_Options::$options;
			$app_id = isset( $options['social_account']['oauth']['instagram']['app_id'] ) ? $options['social_account']['oauth']['instagram']['app_id'] : '';


			?>


			<?php
					DF_Element_Generator::df_html_input( array(
										'name'		=>array('social_account','oauth', 'instagram', 'access_token'),
										'class'		=> 'df-input-styled',
									));
				?>
				<p><a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo esc_attr( $app_id ); ?>&redirect_uri=<?php echo esc_url( $redirect_uri );?>&response_type=token">Authorize Your Instagram Account</a> </p>
				<p><?php echo __('Your Redirect URI' ,'df_magz') . " : " .  $redirect_uri  . "&response_type=token"; ?> </p>
			</div>
		</div>
	<h3>Google Plus OAUTH</h3>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Google+ Username</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'google_plus', 'username'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Google API Key</h4>
				</div>
			</div>
			<div class="df-col-2">
				<?php

					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'google_plus', 'api_key'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
	<h3>Youtube OAUTH</h3>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Account Type</h4>
					<span class="description">Define the type of your Youtube Account</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_radio(array(
										'name'=>array('social_account','oauth', 'youtube', 'type'),
										'class'		=> '',
										'options'	=> array ( array( 'value' => 'chanel',
																	 'text'   => 'Channel'
															 ),
															 array( 'value' => 'username',
																	 'text' => 'Username'
															 ) )
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Youtube ID</h4>
					<span class="description">Input your Youtube User or Channel ID here</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'youtube', 'ID'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Youtube API Key</h4>
					<span class="description">Input Your Youtube API Key Here</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'youtube', 'api_key'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
	<h3>Vimeo OAUTH</h3>
		<div class="df-col-1 df-to-section">
			<div class="df-col-5 df-no-padding">
				<div class="field">
					<h4>Vimeo ID</h4>
					<span class="description">Input your Vimeo Channel ID here</span>
				</div>
			</div>
			<div class="df-col-2">
				<?php
					DF_Element_Generator::df_html_input(array(
										'name'=>array('social_account','oauth', 'vimeo', 'channel'),
										'class'		=> 'df-input-styled'
									));
				?>
			</div>
		</div>
	</div>
