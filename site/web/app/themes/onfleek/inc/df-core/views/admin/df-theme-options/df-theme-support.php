<?php
$df_version = wp_get_theme();
$fb = 'https://www.facebook.com/Dahztheme/';
$tw = 'https://twitter.com/Dahztheme';
$support = 'http://support.daffyhazan.com/';
$documentation = 'http://staging.daffyhazan.com/onfleek/';
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
</head>
<body>
	<div class="wrap about-wrap">
		<h1><?php printf( __( 'Welcome to OnFleek!','onfleek' ) ); ?></h1>
		<div class="updated registration-notice-1">
			<p>
				<strong>
					Thanks for registering your purchase. You will now receive the automatic updates. 
				</strong>
			</p>
		</div>
		<div class="updated error registration-notice-2">
			<p>
				<strong>
					Please provide all the three details for registering your copy of DfMagz!..
				</strong>
			</p>
		</div>
		<div class="updated error registration-notice-3">
			<p>
				<strong>
					Something went wrong. Please verify your details and try again.
				</strong>
			</p>
		</div>
		<div class="about-text">
			Thanks for installing Onfleek, We are very happy that you join us here. Start personalize your website by going to theme option tab or if you like one of our demo please use our one click demo installer below.
		</div>
		<div class="df-th-logo">
			<span class="df-th-version">
				<?php printf (__('Version','onfleek') .' '. $df_version->get( 'Version' )); ?>
			</span>
		</div>
		<h2 class="nav-tab-wrapper wp-clearfix">
			<?php
		        if( is_plugin_active('wordpress-importer-OCDI/wordpress-importer.php') ){
					?><a href="<?php echo admin_url("admin.php?page=df_theme_demo_install"); ?>" class="nav-tab"><?php _e( 'Install Demo' , "onfleek"); ?></a><?php
				} 
			?>
			<a href="#" class="nav-tab  nav-tab-active"><?php _e( 'Support','onfleek' ); ?></a>
		</h2>
			<div class="df-theme">
				<div class="df-col-4">
					<h3><?php echo __( "Documentation", "onfleek" ); ?></h3>
					<p><?php echo __( "This is where you can learn about this theme, the documentation covers basic guide such as installation, settings and theme's feature.", "onfleek" ); ?></p>
					<?php printf( '<a href="%s" class="button button-large button-primary" target="_blank">%s</a>', $documentation, __( "Documentation", "onfleek" ) ); ?>
				</div>
				<div class="df-col-4">
					<h3><?php echo __( "Support Forum", "onfleek" ); ?></h3>
					<p><?php echo __( "this is where we provide support to you. feel free to ask questions or drop by to say hi, our developers will be glad to hear from you!.", "onfleek" ); ?></p>
					<?php printf( '<a href="%s" class="button button-large button-primary" target="_blank">%s</a>', $support, __( "Community Forum", "onfleek" ) ); ?>
				</div>            
				<div class="df-col-4 last-feature">
					<h3><?php echo __( "Follow Us", "onfleek" ); ?></h3>
					<p><?php echo __( "Get the latest news of Onfleek development from us by liking & following our FB and Twitter page.", "onfleek" ); ?></p>
					<?php printf( '<a href="%s" class="button button-large button-primary" target="_blank">%s</a>', esc_url( $fb ),esc_attr(__( "Facebook", "onfleek" ) ) ); ?>
					<?php printf( '<a href="%s" class="button button-large button-primary" target="_blank">%s</a>', esc_url( $tw ),esc_attr(__( "Twitter", "onfleek" ) ) ); ?>
				</div> 
		</div>
	</div>
</body>
</html>