<?php $listicle = $meta_post_listicle;
	if ( $ordering == 'asc' ) {
		$i=0; 
	}else {
		$i = count( $listicle ) - 1;
	}
	foreach ($listicle as $listicles) {
		?>
			<div class="df-smartlist">
				<?php 
					$use_size = 'thumbnail';
					
				?>
				<figure class="sl-figure style4"><?php DF_Content::df_load_listicle_image( $listicle[$i], $use_size  ) ?></figure>
				<div class="smartlist-title">
					<?php
					if ( 'enable' == strtolower( $meta_post_show_number ) ) {
						printf('<div class="smartlist-number-subtitle">%1$s</div><div class="subtitle-smartlist style2">%2$s</div>', esc_html( $i + 1 ), esc_html( $listicle[$i]['df_magz_post_listicle_title'] ));
					}else {
						printf('<div class="subtitle-smartlist style2">%1$s</div>', esc_html( $listicle[$i]['df_magz_post_listicle_title'] ));
					}
					?>
				</div>
				<?php  
					global $wp_embed;
					printf( '<p class="paragraph">%s</p>',$wp_embed->run_shortcode( isset( $listicle[$i]['df_magz_post_listicle_description'] ) ? wpautop( $listicle[$i]['df_magz_post_listicle_description'] ) : ""  ) ); ?>
			</div>
			<?php
			if ( $ordering == 'asc' ) {
				$i++;
			}else {
				$i--;
			}
	} 
?>