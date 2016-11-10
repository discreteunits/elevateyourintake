<div class="df-post-pagination">
	<?php
		$use_size = '';
		if( $meta_post_layout == 'fullwidth' ){
			$use_size = 'df_size_994x120';
		}else{
			$use_size = 'df_size_994x120';
		}
		$next_post = get_next_post();
		$prev_post = get_previous_post();						
		if ( !empty( $next_post ) ) {
			$next_post_url = get_permalink( get_adjacent_post( false,'',false )->ID );
			$next_post_title = get_the_title( get_adjacent_post( false, '', false )->ID );
			$next_first_img = '';
			$next_secondary_img = '';
			$id_next_secondary_img = get_post_meta( get_adjacent_post( false,'',false )->ID , 'post_secondary-image_thumbnail_id', true);
			if ( has_post_thumbnail( get_adjacent_post( false,'',false )->ID ) ) {
				$next_first_img = get_the_post_thumbnail( get_adjacent_post( false,'',false )->ID , $size = $use_size, array( 'class' => 'center-block'  ) );
			} else {
				$image_id = DF_Framework::$default_featured_img_id;
				if ( !empty($id_next_secondary_img) || $id_next_secondary_img !=='' ) {
					$next_first_img = wp_get_attachment_image(  $image_id , $size = $use_size, array( 'class' => 'center-block' ) );
				}
				
			}
			if ( empty($id_next_secondary_img) || $id_next_secondary_img=='' ) {
				$next_secondary_img = $next_first_img;
			} else {
				$next_secondary_img =  wp_get_attachment_image(  $id_next_secondary_img , $size = $use_size , false, array( 'class' => 'center-block' ) );
			}
	?>
		<div class="pagination-image">
			<a href="<?php echo esc_url( $next_post_url );?>">
				<?php echo $next_first_img . $next_secondary_img;?>
				<div class="post-next-inner">
					<span><?php _e('NEXT STORY', 'onfleek' );?></span>
					<h5><?php echo $next_post_title ;?></h5>
				</div>
				<span class="overlay-post-next"></span>
			</a>
		</div>
	<?php
		}
	?>
	</div>
	<div class="df-post-pagination">
	<?php
		if ( !empty( $prev_post ) ) {
			$previous_post_url = get_permalink( get_adjacent_post( false,'',true )->ID );
			$previous_post_title = get_the_title( get_adjacent_post( false, '', true )->ID );
			$prev_first_img = '';
			$prev_secondary_img = '';
			$id_prev_secondary_img = get_post_meta( get_adjacent_post( false,'',true )->ID , 'post_secondary-image_thumbnail_id', true);
			if ( has_post_thumbnail( get_adjacent_post( false,'',true )->ID ) ) {
				$prev_first_img = get_the_post_thumbnail( get_adjacent_post( false,'',true )->ID , $size = $use_size, array( 'class' => 'img-responsive center-block'  ) );
			} else {
				$image_id = DF_Framework::$default_featured_img_id;
				if ( !empty($id_prev_secondary_img) || $id_prev_secondary_img !=='' ) {
					$prev_first_img = wp_get_attachment_image(  $image_id , $size = $use_size, array( 'class' => 'center-block' ) );
				}
			}
			if ( empty( $id_prev_secondary_img ) || $id_prev_secondary_img =='' ) {
				$prev_secondary_img = $prev_first_img;
			} else {
				$prev_secondary_img =  wp_get_attachment_image( $id_prev_secondary_img , $size = $use_size , false, array( 'class' => 'img-responsive center-block' ) );
			}
	?>
		<div class="pagination-image">
			<a href="<?php echo esc_attr( $previous_post_url );?>">
				<?php echo $prev_first_img . $prev_secondary_img;?>
				<div class="post-prev-inner">
					<span><?php _e('PREV STORY', 'onfleek');?></span>
					<h5><?php echo $previous_post_title;?></h5>
				</div>
				<span class="overlay-post-prev"></span>
			</a>
		</div>
	<?php
		}
	?>
	</div>
