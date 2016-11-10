<?php
if ( !current_user_can( 'manage_options' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'onfleek' ) );
}
	$df_demo_url 	= "http://dahztheme.com/demo/onfleek/";
	$df_demos 				= array(
								'rhapsody' 			=> array(),
								'revival' 			=> array(),
								);
$df_version = wp_get_theme();
	
$failed_url = 'http://support.daffyhazan.com/knowledgebase/how-to-fix-failed-to-import/';
$tgmpa = 'themes.php?page=tgmpa-install-plugins';

?>
<!DOCTYPE html>
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
			<a href="#" class="nav-tab nav-tab-active"><?php _e( 'Install Demo','onfleek' ); ?></a>
			<a href="<?php echo esc_url(admin_url("admin.php?page=df_theme_support")); ?>" class="nav-tab"><?php _e( 'Support','onfleek' ); ?></a>
			
	   </h2>
	<div class="df-dahz-logo">
		<span class="df-magazine-version"></span>
	</div>
	<div class="df-updated df-error">
		<p><strong>Failed to import. please check your server requirement and demo files, learn more <a href="<?php printf( esc_url( $failed_url ) );?>" target="_blank"> here </a></strong></p>
	</div>
	<div class="df-updated df-success" id="success-message">
		<p><strong>Import Successful</strong></p>
	</div>
	<div class="df-dahz-important-notice">
		<p class="df-about-description">You are just a few clicks away from replicating our demo content and start building your blog. by installing the the demo content you will get the demo layout along with the sliders, pages, posts, customizer settings, widgets, sidebars and other settings in your site. to ensure a successful import, please do the following steps :  
		<br>
			<br>1. Export Customizer Setting to <a href="<?php printf( esc_url( $tgmpa ) );?>"> backup </a> your current setting. 
			<br>2. Install the <a href="<?php printf( esc_url( $tgmpa ) );?>"> required plugins  </a>
			<br>3. set your server memory limit to 256M and Max Execution Time (php time limit) to 900 Seconds. 
		<br>
		<br>
		<strong>Your Server Status</strong>
		<br>Max Execution Time is <span style="color: #ff0000;"><?php echo ini_get('max_execution_time');  ?></span>  seconds. 
		<br>Server Memory limit is <span style="color: #ff0000;"> <?php echo ini_get('memory_limit');  ?></span> 
		<br>
		<br>Done all that? choose the one you like, and just click install!
		</p>
	</div>
	<div class="df-dahz-demo-themes">
		<?php
		   foreach ( $df_demos as $demo => $demo_details ) { ?>
				<div class="df-theme">
					<div class="df-theme-wrapper">
						<div class="df-theme-screenshot">
							<?php printf("<img src='%s/inc/df-core/asset/demo/images/demo-%s.jpg'/>",esc_attr( get_template_directory_uri() ), esc_attr( $demo ) ); ?>  
						</div>
							<?php //printf("<div class='df_progressbar %s'></div>",$demo); ?> 
						<h3 class="df-theme-name">
							<?php printf("<span class='df-theme-name-edit'>%s</span>", esc_attr( $demo ) ); ?> 
						</h3>
						<div class="df-theme-action">
							<?php printf("<a class='df-button df-button-primary install-button' href='#' data-demo-name='%s'> Install </a>",esc_attr( $demo ) ); ?> 
							<?php printf("<a class='df-button df-button-primary' href='%s' target='_blank'>Preview</a>", esc_url( $df_demo_url . $demo ) ); ?> 
						</div>    
									   
						<div class="df-demo-import-loader <?php echo esc_attr( $demo );  ?>">
							<div class="df-words-loading <?php echo esc_attr( $demo );  ?>">
								<span>Importing....</span>
								<br>
								<span>Please do NOT close this window or click the Back button on your browser.</span>
								<br>
								<span>(this process can take approx 15 mins)</span>
							</div>
							<div class="meter  <?php echo esc_attr( $demo ); ?> ">
								<span></span>
							</div>
						</div>
					</div>
				</div>
		<?php } ?>
		</div>
	  </div>
 <div>
</div>
</body>
</html>
