<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package onfleek
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
    $df_header = new DF_Header();
    $df_header->df_get_fav_icon();
	if ( is_single() ) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ) {
			$thumbs = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			if ( !empty( $thumbs[0] ) ) {
				echo '<meta property="og:image" content="' .  $thumbs[0] . '" />';
			}
		} else {
			$image_id 	= DF_Framework::$default_featured_img_id;
			$thumbs 	= wp_get_attachment_image_src( $image_id, $size = 'full' );
			if ( !empty( $thumbs[0] ) ) {
				echo '<meta property="og:image" content="' .  $thumbs[0] . '" />';
			}
		}
	}
?>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div class="animsition">

<?php $is_sticky = DF_Header::df_sticky_header();
	if( 'yes' == $is_sticky ){ get_template_part( 'inc/df-core/views/df-header/header_sticky' ); }?>
	<div id="search" class="df-modal">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="close"><i class="ion-android-close modal-close"></i></div>
					<div class="search-header">
						<div class="push-top-12 modal-search-caption">
							<?php _e( 'type in your search and press enter' , 'onfleek' );?>
						</div>
						<div class="push-top-3 modal-search-input">
							<form><input type="search" value="" placeholder="<?php echo esc_html__('Search', 'onfleek'); ?>" id="df-search-input" autocomplete="off" autofocus /></form>
						</div>
						<div class="push-top-3"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="df-search-result">
			<div class="container">
				<div class="row">
					<div class="col-md-12 no-padding archive-post-wrap has-sidebar--no">
						<div class="search-result-wraper-main">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		$header 			= DF_Header::df_get_header_layout();
		$content			= DF_Content::df_get_content_layout();
		$footer				= DF_Footer::df_get_footer_area_layout();
		$bg_type			= 'df-bg';
		$df_content_full 	= '';
		if ( 'boxed' == $header || 'fullboxed' == $header ) {
			if ( 'full' == $content ) {
				$df_content_full = 'df-content-full';
			}
		} else {
			if ( 'boxed' == $footer ) {
				if ( $content == 'full' ) {
					$df_content_full = 'df-content-full';
				}
			}
		}
		if( $content == 'full' ){
			$bg_type = '';
		}
	?>
	<div id="page" class="<?php echo esc_attr( $bg_type );?> df-allcontent-wrap <?php echo esc_attr( $df_content_full );?>">
		<?php
		$sidearea = DF_Header::df_side_area_status();
		if ( 'no' != $sidearea ) { get_template_part( 'inc/df-core/views/df-sidebar/sidearea' ); }?>
		<div id="df-off-canvas-wrap" class="<?php echo ( is_404() ) ? 'df-notfound-page' : '' ;?>">
			<div id="df-cart-canvas"></div>
			<?php DF_Header::df_get_header();?>
