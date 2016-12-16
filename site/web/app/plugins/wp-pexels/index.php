<?php
/*
  Plugin Name: WP Pexels
  Plugin URI: http://wpclever.net
  Description: This plugin help you search over million free photos from https://pexels.com then insert to content or set as featured image very quickly.
  Version: 1.0
  Author: wpclever
  Author URI: http://wpclever.net/contact
 */

define( 'WPXS_URI', plugin_dir_url( __FILE__ ) );

register_activation_hook( __FILE__, 'wpxs_activate' );
add_action( 'admin_init', 'wpxs_redirect' );
function wpxs_activate() {
	add_option( 'wpxs_do_activation_redirect', true );
}

function wpxs_redirect() {
	if ( get_option( 'wpxs_do_activation_redirect', false ) ) {
		delete_option( 'wpxs_do_activation_redirect' );
		wp_redirect( 'admin.php?page=wpxs' );
	}
}

add_action( 'admin_menu', 'wpxs_menu' );
function wpxs_menu() {
	add_menu_page( 'Pexels', 'Pexels', 'manage_options', 'wpxs', 'wpxs_menu_pages', 'dashicons-format-gallery' );
}

function wpxs_menu_pages() {
	$wpxs_active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'about';
	?>
	<div class="wrap wpxs_welcome">
		<h1>Welcome to WP Pexels</h1>

		<div class="about-text">
			This plugin help you search over million free photos from <a
				href="https://pexels.com" target="_blank">https://pexels.com</a> then insert to content
			or set
			as featured image very quickly.
		</div>

		<h2 class="nav-tab-wrapper">
			<a href="?page=wpxs&amp;tab=about"
			   class="nav-tab <?php echo $wpxs_active_tab == 'about' ? 'nav-tab-active' : ''; ?>">How to use?</a>
			<a href="?page=wpxs&amp;tab=support"
			   class="nav-tab <?php echo $wpxs_active_tab == 'support' ? 'nav-tab-active' : ''; ?>">Support</a>
		</h2>
		<br/>
		<?php if ( $wpxs_active_tab == 'about' ) { ?>
			<iframe width="560" height="315" src="https://www.youtube.com/embed/nk40Ce06D4E" frameborder="0"
			        allowfullscreen></iframe>
		<?php } elseif ( $wpxs_active_tab == 'support' ) { ?>
			Thank you for choosing WP Pexels,
			<br/><strong>wpclever</strong>
			<br/>Email: cleverwp@gmail.com
			<br/>Website: <a href="http://wpclever.net" target="_blank">http://wpclever.net</a>
		<?php } ?>
	</div>
	<?php
}

function wpxs_load_scripts() {
	wp_enqueue_script( 'colorbox', WPXS_URI . 'js/jquery.colorbox.js', array( 'jquery' ) );
	wp_enqueue_style( 'colorbox', WPXS_URI . 'css/colorbox.css' );
	wp_enqueue_style( 'wpxs_css', WPXS_URI . 'css/main.css' );
	wp_enqueue_script( 'wpxs_js', WPXS_URI . 'js/main.js', array( 'jquery' ), '1.0', true );
	if ( get_option( 'wpxs_username' ) && get_option( 'wpxs_key' ) ) {
		wp_localize_script( 'wpxs_js', 'wpxs_vars', array(
			'wpxs_username' => get_option( 'wpxs_username' ),
			'wpxs_key'      => get_option( 'wpxs_key' ),
			'wpxs_ajax_url' => admin_url( 'admin-ajax.php' ),
			'wpxs_nonce'    => wp_create_nonce( 'wpxs_nonce' )
		) );
	} else {
		wp_localize_script( 'wpxs_js', 'wpxs_vars', array(
			'wpxs_username' => 'baby2j',
			'wpxs_key'      => '1485725-fcbfa6badf33d350b5eb4670a',
			'wpxs_ajax_url' => admin_url( 'admin-ajax.php' ),
			'wpxs_nonce'    => wp_create_nonce( 'wpxs_nonce' )
		) );
	}
}

add_action( 'admin_enqueue_scripts', 'wpxs_load_scripts' );

function wpxs_search_ajax() {
	if ( ! isset( $_POST['wpxs_nonce'] ) || ! wp_verify_nonce( $_POST['wpxs_nonce'], 'wpxs_nonce' ) ) {
		die( 'Permissions check failed' );
	}
	$ch   = curl_init();
	$page = isset( $_POST['page'] ) ? $_POST['page'] : 1;
	if ( isset( $_POST['key'] ) ) {
		curl_setopt( $ch, CURLOPT_URL, 'http://api.pexels.com/v1/search?query=' . esc_attr( $_POST['key'] ) . '&per_page=8&page=' . $page );
	} else {
		curl_setopt( $ch, CURLOPT_URL, 'http://api.pexels.com/v1/popular?per_page=8&page=1' );
	}
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
		'Authorization: 563492ad6f91700001000001f27710937a744dc14b607b8c6d8d72d5',
		'Content-Type: application/json'
	) );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	echo curl_exec( $ch );
	curl_close( $ch );
	die();
}

add_action( 'wp_ajax_wpxs_search', 'wpxs_search_ajax' );
add_action( 'wp_ajax_nopriv_wpxs_search', 'wpxs_search_ajax' );

function wpxs_add_button( $editor_id ) {
	echo ' <a href="#wpxs_popup" id="wpxs_btn" data-editor="' . $editor_id . '" class="wpxs_btn button add_media" title="Pexels"><span class="dashicons dashicons-format-gallery wpxs_dashicons"></span> Pexels</a><input type="hidden" id="wpxs_featured_url" name="wpxs_featured_url" value="" /> ';
}

add_action( 'media_buttons', 'wpxs_add_button' );
function wpxs_save_postdata( $post_id, $post ) {
	if ( isset( $post->post_status ) && 'auto-draft' == $post->post_status ) {
		return;
	}
	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}
	if ( ! empty( $_POST['wpxs_featured_url'] ) ) {
		if ( strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post-new.php' ) || strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post.php' ) ) {
			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				}
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}
			$wpxs_furl = sanitize_text_field( $_POST['wpxs_featured_url'] );
			wpxs_save_featured( $wpxs_furl );
		}
	}
}

add_action( 'save_post', 'wpxs_save_postdata', 10, 3 );
function wpxs_save_to_media( $vurl, $vtitle, $vfilename, $vpid ) {
	$thumbid  = 0;
	$filename = pathinfo( $vurl, PATHINFO_FILENAME );
	if ( ( $vfilename == '1' ) && ( $vtitle != '' ) ) {
		$filename = sanitize_title( $vtitle );
	}
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	@set_time_limit( 300 );
	if ( ! empty( $vurl ) ) {
		$tmp                    = download_url( $vurl );
		$ext                    = pathinfo( $vurl, PATHINFO_EXTENSION );
		$file_array['name']     = $filename . '.' . $ext;
		$file_array['tmp_name'] = $tmp;
		if ( is_wp_error( $tmp ) ) {
			@unlink( $file_array['tmp_name'] );
			$file_array['tmp_name'] = '';
		}
		$thumbid = media_handle_sideload( $file_array, $vpid, $desc = null );
		if ( is_wp_error( $thumbid ) ) {
			@unlink( $file_array['tmp_name'] );

			return $thumbid;
		}
	}
	echo wp_get_attachment_url( $thumbid );
}

function wpxs_save_featured( $vurl ) {
	global $post;
	$filename = pathinfo( $vurl, PATHINFO_FILENAME );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	@set_time_limit( 300 );
	if ( ! empty( $vurl ) ) {
		$tmp                    = download_url( $vurl );
		$ext                    = pathinfo( $vurl, PATHINFO_EXTENSION );
		$file_array['name']     = $filename . '.' . $ext;
		$file_array['tmp_name'] = $tmp;
		if ( is_wp_error( $tmp ) ) {
			@unlink( $file_array['tmp_name'] );
			$file_array['tmp_name'] = '';
		}
		$thumbid = media_handle_sideload( $file_array, $post->ID, $desc = null );
		if ( is_wp_error( $thumbid ) ) {
			@unlink( $file_array['tmp_name'] );

			return $thumbid;
		}
	}
	set_post_thumbnail( $post, $thumbid );
}

function wpxs_popup_content() {
	?>
	<div style='display:none'>
		<div id="wpxs_popup" style="width: 920px; height: 440px; position: relative; overflow: hidden">
			<table style="width: 100%; height: 100%; padding: 0; margin: 0; border-spacing: 0; vertical-align: top">
				<tr>
					<td style="width: 620px; vertical-align: top; padding: 10px">
						<div style="width:100%; display: inline-block; height:28px; line-height: 28px;">
							<input type="text" id="wpxs_input" name="wpxs_input" value=""
							       class="wpxs_input wpxs_input-normal" placeholder="keyword"/>
							<input type="button" id="wpxs_search" class="wpxs_button" value="Search"/>
							<span id="wpxs_spinner" style="display:none" class="wpxs_loading">&nbsp;</span>
							<span class="wpxs_logo"><a href="https://www.pexels.com/" target="_blank"><img
										src="<?php echo WPXS_URI; ?>/images/pexels-logo.png" height="28px"/></a></span>
						</div>
						<div id="wpxs_container" class="wpxs_container">

						</div>
						<div id="wpxs_page" class="wpxs_page"></div>
					</td>
					<td style="border-left: 1px solid #ddd; background: #fcfcfc; vertical-align: top; padding: 10px">
						<div id="wpxs_use-image" class="wpxs_use-image">
							<div class="wpxs_right" style="height: 370px; overflow-y: auto; overflow-x: hidden">
								<table class="wpxs_table">
									<tr class="wpxs_tr">
										<td colspan="2" class="wpxs_td">
											<div class="wpxs_item-single" id="wpxs_view"
											     style="margin-right: 20px;"></div>
										</td>
									</tr>
									<tr class="wpxs_tr">
										<td class="wpxs_td">Title</td>
										<td class="wpxs_td"><input type="text" id="wpxs_title" value=""
										                           class="wpxs_input"
										                           placeholder="title"/>
										</td>
									</tr>
									<tr>
										<td class="wpxs_td">Caption</td>
										<td class="wpxs_td"><textarea id="wpxs_caption" name="wpxs_caption"
										                              class="wpxs_textarea"></textarea>
										</td>
									</tr>
									<tr>
										<td class="wpxs_td">File name</td>
										<td class="wpxs_td">
											<select name="wpxs_filename" id="wpxs_filename" class="wpxs_select">
												<option value="0">Keep original file name</option>
												<option value="1">Generate from title</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="wpxs_td">Size</td>
										<td class="wpxs_td"><input type="number" id="wpxs_width" value="0"
										                           class="wpxs_input wpxs_input-small"
										                           placeholder="width"/>
											<input
												type="number" id="wpxs_height" value="0"
												class="wpxs_input wpxs_input-small"
												placeholder="height"/>
										</td>
									</tr>
									<tr>
										<td class="wpxs_td">Alignment</td>
										<td class="wpxs_td">
											<select name="wpxs_align" id="wpxs_align" class="wpxs_select">
												<option value="alignnone">None</option>
												<option value="alignleft">Left</option>
												<option value="alignright">Right</option>
												<option value="aligncenter">Center</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="wpxs_td">Link to</td>
										<td class="wpxs_td">
											<select name="wpxs_link" id="wpxs_link" class="wpxs_select">
												<option value="0">None</option>
												<option value="1">Original site</option>
												<option value="2">Original image</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="wpxs_td">&nbsp;</td>
										<td class="wpxs_td"><input name="wpxs_blank" id="wpxs_blank" type="checkbox"
										                           class="wpxs_checkbox"/> Open
											new
											windows
										</td>
									</tr>
									<tr>
										<td class="wpxs_td">&nbsp;</td>
										<td class="wpxs_td"><input name="wpxs_nofollow" id="wpxs_nofollow"
										                           type="checkbox"
										                           class="wpxs_checkbox"/>
											Rel
											nofollow
										</td>
									</tr>
								</table>
							</div>
							<p class="wpxs_p" style="margin-top: 10px; width: 100%; display: inline-block">
								<input type="hidden" id="wpxs_site" value=""/>
								<input type="hidden" id="wpxs_url" value=""/>
								<input type="hidden" id="wpxs_eid" value=""/>
								<input type="button" id="wpxs_insert" class="wpxs_button" value="Insert"/>
								<a href="http://wpclever.net"
								   target="_blank"
								   onclick="return confirm('This feature only available in Pro version!\nBuy it now?')">
									<input type="button" id="vpxb_save" class="wpxs_button_disable" value="Save&Insert" />
								</a>
								<input type="button" id="wpxs_featured" class="wpxs_button" value="Featured"/>
							</p>

							<div style="display:inline-block">
						<span class="wpxs_loading-text" id="wpxs_note"
						      style="display:none">Saving image to Media Library...</span>
								<span id="wpxs_error"></span>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php
}

add_action( 'admin_footer', 'wpxs_popup_content' );
?>