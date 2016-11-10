<?php if( DF_Framework::df_is_mobile() ){?>
	<div class="smartlist-wrap push-top-4">
		<div class="smartlist-slider-button mobile">
			<ul class="list-inline">
				<li class="df-btn df-btn-normal custom-smartlist-prev-arrow"><span class="ion-chevron-left"> <?php _e( 'Prev' , 'onfleek');?></span></li>
				<li class="df-btn df-btn-normal custom-smartlist-next-arrow"><?php _e( 'Next' , 'onfleek');?> <span class="ion-chevron-right"></span></li>
			</ul>
		</div>
		<div class="smartlist-slider">
			<?php $listicle = $meta_post_listicle;
			if ( $ordering == 'asc' ) {
				$i=0; 
			}else {
				$i = count( $listicle ) - 1;
			}
			foreach ($listicle as $listicles) {
			?>
					<div class="smarlist-slide">
						<div class="sl-number-title">
							<?php 
							if ( 'enable' == strtolower( $meta_post_show_number ) ) {
								$dv_html = sprintf('<div class="smartlist-number-subtitle">%1$s</div><div class="subtitle-smartlist style3">
									<h4>%2$s</h4></div>', esc_html( $i + 1), esc_html( $listicle[$i]['df_magz_post_listicle_title'] ) );
							}else {
								$dv_html = sprintf('<div class="subtitle-smartlist style3">
									<h4>%1$s</h4></div>', esc_html( $listicle[$i]['df_magz_post_listicle_title'] ) );
							}
							echo $dv_html;
							?>
						</div>
						<div class="sl-description">
							<div class="df-post-image df-post-image-boxed">
								<figure class="sl-figure style3">
									<?php
										$use_size = 'df_size_376x250';
										DF_Content::df_load_listicle_image( $listicle[$i], $use_size  );
									?>
								</figure>
							</div>
				<?php  global $wp_embed;
						$dv_html = sprintf( '<p class="paragraph">%s</p>',$wp_embed->run_shortcode( isset( $listicle[$i]['df_magz_post_listicle_description'] ) ? wpautop( $listicle[$i]['df_magz_post_listicle_description'] ): ""  ) );
						echo $dv_html;
				?>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
				if ( $ordering == 'asc' ) {
					$i++;
				}else {
					$i--;
				}
			} ?>
		</div>
	</div>
	<?php } else {?>
		<div class="smartlist-wrap style3 push-top-4">
			<div class="smartlist-slider-button">
				<ul class="list-inline pull-right">
					<li class="df-btn df-btn-normal custom-smartlist-prev-arrow"><span class="ion-chevron-left"> <?php _e( 'Prev' , 'onfleek');?></span></li>
					<li class="df-btn df-btn-normal custom-smartlist-next-arrow"><?php _e( 'Next' , 'onfleek');?> <span class="ion-chevron-right"></span></li>
				</ul>
			</div>
			<div class="smartlist-slider">
				<?php $listicle = $meta_post_listicle;
				if ( $ordering == 'asc' ) {
					$i=0;
				}else {
					$i = count( $listicle ) - 1;
				}
					foreach ($listicle as $listicles) {
					?>
					<div class="smarlist-slide">
						<div class="sl-number-title">
							<?php
							if ( 'enable' == strtolower( $meta_post_show_number ) ) {
								$dv_html = sprintf('<div class="smartlist-number-subtitle">%1$s</div><div class="subtitle-smartlist style3">
									<h4>%2$s</h4></div>', esc_html( $i + 1), esc_html( $listicle[$i]['df_magz_post_listicle_title'] ) );
							}else {
								$dv_html = sprintf('<div class="subtitle-smartlist style3">
									<h4>%1$s</h4></div>', esc_html( $listicle[$i]['df_magz_post_listicle_title'] ) );
							}
							echo $dv_html;
							?>
						</div>
						<div class="sl-description">
							<div class="df-post-image df-post-image-boxed">
								<figure class="sl-figure style3">
									<?php
										$use_size = 'df_size_376x250';
										DF_Content::df_load_listicle_image( $listicle[$i], $use_size  );
									?>
								</figure>
							</div>
						<?php  
								global $wp_embed;
								$dv_html = sprintf( '<p class="paragraph">%s</p>',$wp_embed->run_shortcode( isset( $listicle[$i]['df_magz_post_listicle_description'] ) ? wpautop( $listicle[$i]['df_magz_post_listicle_description'] ): ""  ) ); 
								echo $dv_html;
								?>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php
						if ( $ordering == 'asc' ) {
							$i++;
						}else {
							$i--;
						}
					} ?>
			</div>
		</div>
<?php } ?>
