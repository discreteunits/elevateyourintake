
	<div class="style1 df-post-sharing <?php echo esc_attr( $top_class ); echo esc_attr( $general_layout == 'layout-8' ) ? ' mobile':'';?> df-social-share">
		<ul class="list-inline">
		<?php 
			if ( $social_list['facebook'] == 'yes') {
		?>
			<li class="df-social-sharing-buttons popup">
				<a onclick="return false" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">
					<i class="fa fa-facebook"></i>
					<div class="df-social-butt-text">Facebook</div>
				</a>
			</li>
		<?php 
			}
			if ( $social_list['twitter'] == 'yes') {
		?>	
		 	<li class="df-social-sharing-buttons popup">
				<a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">
					<i class="fa fa-twitter"></i>
					<div class="df-social-butt-text">Twitter</div>
				</a>
			</li>
		<?php 
			}
			if ( $social_list['pinterest'] == 'yes') {
		?>	
		 	<li class="df-social-sharing-buttons popup">
				<a href="https://id.pinterest.com/pin/create/button/?url=<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">
					<i class="fa fa-pinterest-p"></i>
					<div class="df-social-butt-text">Pinterest</div>
				</a>
			</li>
		<?php 
			}
			if ( $social_list['mail'] == 'yes' || $social_list['google-plus'] == 'yes' || $social_list['linkedin'] == 'yes' ) {
		?>		
		 	<li class="df-social-sharing-buttons">
				<a class="show-social">
					<i class="ion-android-share"></i>
				</a>
				<ul class="more-social">
					<?php if ( $social_list['google-plus'] == 'yes') { ?>
					<li class="popup"><a href="https://plus.google.com/share?url=<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">Google +</a></li>
					<?php 
						}
						if ( $social_list['linkedin'] == 'yes') {
					?>
					<li class="popup"><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">Linkedin</a></li>
					<?php 
						}
						if ( $social_list['mail'] == 'yes') {
					?>
					<li><a href="mailto:?Subject=&Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">Email</a></li>
					<?php 
						}
					?>
				</ul>
			</li>
		<?php

			}
		if ( class_exists( "DF_Social_Media" ) ) {
		?>
			<li class="social-sharing-count pull-right">
				<h3><?php echo DF_Social_Media::df_get_all_social_media_counter( get_permalink( get_the_ID() ), 'get' ); ?></h3>
				<span><?php _e( 'Shares', 'onfleek' ); ?></span>
			</li>
		<?php } ?>
		</ul>
	</div>
