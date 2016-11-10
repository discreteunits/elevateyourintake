<?php 
$post_setting = DF_Options::df_get_post_setting_options(); 
$is_show_tag            = !isset( $post_setting['is_show_tag'] ) ? 'no' : $post_setting['is_show_tag'];
$is_show_categories_tag	= !isset( $post_setting['is_show_categories_tag'] ) ? 'no' : $post_setting['is_show_categories_tag'];
?>

<?php $categories = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'onfleek' ) ); ?>
<?php if ( $categories && $is_show_categories_tag == 'yes' ) : ?>
	<li class="amp-wp-tax-category">
		<span class="screen-reader-text"><?php _e('categories:', 'onfleek') ?></span>
		<?php echo $categories; ?>
	</li>
<?php endif; ?>

<?php $tags = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'onfleek' ) ); ?>
<?php if ( $tags && $is_show_tag == 'yes' ) : ?>
	<li class="amp-wp-tax-tag">
		<span class="screen-reader-text"><?php _e('Tags:', 'onfleek') ?></span>
		<?php echo $tags; ?>
	</li>
<?php endif; ?>
