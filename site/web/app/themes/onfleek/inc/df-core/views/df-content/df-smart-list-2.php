<?php $listicle = $meta_post_listicle;
	if ( 'asc' == $ordering ) {
		$i=0; 
	}else {
		$i = count( $listicle ) - 1;
	}
	foreach ($listicle as $listicles) {
	?>
		<div class="df-smartlist">
			<div class="smartlist-title">
			<?php 
			if ( 'enable' == strtolower( $meta_post_show_number ) ) {
				printf('<div class="smartlist-number-subtitle">%1$s</div><div class="subtitle-smartlist style2">%2$s</div>', esc_html( $i + 1 ), esc_html( $listicle[$i]['df_magz_post_listicle_title'] ));
			}else {
				printf('<div class="subtitle-smartlist style2">%1$s</div>', esc_html( $listicle[$i]['df_magz_post_listicle_title'] ));
			}
				
			?>
			</div>
			<div class="df-post-image df-post-image-boxed">
				<?php
					$use_size = 'df_size_1200x675';
					DF_Content::df_load_listicle_image( $listicle[$i], $use_size  );
					
				?>
			</div>
			<?php  
					global $wp_embed;
					printf( '<p class="paragraph">%s</p>',$wp_embed->run_shortcode( isset( $listicle[$i]['df_magz_post_listicle_description'] ) ? wpautop( $listicle[$i]['df_magz_post_listicle_description'] ): ""  ) ); ?>
		</div>
		<?php 
		if ( 'asc' == $ordering ) {
			$i++;
		}else {
			$i--;
		}
	}
?>
