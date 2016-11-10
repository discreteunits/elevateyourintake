<div class="smartlist-wrap">
<?php if( DF_Framework::df_is_mobile() ){?>
	<div class="smartlist-slider-button mobile">
		<ul class="list-inline">
			<li class="df-btn df-btn-normal custom-smartlist-prev-arrow"><span class="ion-chevron-left"></span></li>
		 	<li class="df-btn df-btn-normal custom-smartlist-next-arrow"><span class="ion-chevron-right"></span></li>
		</ul>
	</div>
	<?php } else { ?>
	<div class="smartlist-slider-button">
		<ul class="list-inline">
			<li class="df-btn df-btn-normal custom-smartlist-prev-arrow"><span class="ion-chevron-left"> <span class="next-button"> <?php _e( 'Prev' , 'onfleek');?> </span></span></li>
			<li class="df-btn df-btn-normal custom-smartlist-next-arrow"><span class="prev-button"><?php _e( 'Next' , 'onfleek');?></span> <span class="ion-chevron-right"></span></li>
		</ul>
	</div>
	<?php } ?>
	<div class="smartlist-slider">

		<?php $listicle = $meta_post_listicle;
		if ( 'asc' == strtolower( $ordering ) ) {
			$i=0; 
		}else {
			$i = count( $meta_post_listicle ) - 1;
		}
		foreach ( $listicle as  $listicles ) {
		?>
			<div class="smarlist-slide">
				<div class="df-post-content">
					<div class="sl-number-title">
						<div class="smartlist-title style1">
							<div class="subtitle-smartlist style1">
								<ul class="list-inline no-padding">
									<?php
									if ( 'enable' == strtolower( $meta_post_show_number ) ) {
										printf('<h4>%1$s. %2$s</h4>', esc_html( $i + 1 ), esc_html( $listicle[$i]['df_magz_post_listicle_title'] ) );	
									}else {
										printf('<h4>%1$s</h4>',  esc_html( $listicle[$i]['df_magz_post_listicle_title'] ) );	
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				<div class="sl-description">
					<div class="df-post-image df-post-image-boxed">
						<?php
							$use_size = 'df_size_1200x675';
							DF_Content::df_load_listicle_image( $listicle[$i], $use_size );
						?>
					</div>
				<?php  
					global $wp_embed;
					printf( '<p class="paragraph">%s</p>',$wp_embed->run_shortcode( isset( $listicle[$i]['df_magz_post_listicle_description'] ) ? wpautop( $listicle[$i]['df_magz_post_listicle_description'] ) : ""  ) ); ?>
				</div>
				</div>	
			</div>
		<?php 
		if ('asc' == strtolower( $ordering ) ) {
			$i++;	
		}else {
			$i--;
		} 
		}?>
	</div>
</div>
