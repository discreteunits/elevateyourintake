<?php if( DF_Framework::df_is_mobile()) {?>
<div class="df-author-box-wrap mobile">
	<ul class="list-inline">
		<li class="authors-content">
			<div class="authors-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, $default = '' , $alt ='' , array( 'class' => 'img-circle')  ); ?>
				<!-- <img src="../images/comments.jpg" alt="" class="img-circle"> -->
			</div>
			<div class="vcard">
				<h5 class="df-author">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php echo get_the_author();?></a>
				</h5>
				<?php if( get_the_author_meta('job_title') !== '') {?>
				<p>
					<?php echo the_author_meta('job_title');?>
				</p>
				<?php
				}
				?>
			</div>
			<div class="authors-post">
				<div class="author-description push-top-2">
					<p><?php echo the_author_meta("description"); ?></p>
				</div>
				<div class="df-post-sharing style3">
					<?php DF_Content::df_load_authorbox_social(); ?>
				</div>
			</div>
		</li>
	</ul>
</div>

<?php } else { ?>

<div class="df-author-box-wrap">
	<ul class="list-inline">
		<li class="authors-content">
			<div class="authors-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, $default = '' , $alt ='' , array( 'class' => 'img-circle')  ); ?>
			</div>
			<div class="authors-post">
				<div class="vcard">
					<h5 class="author">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php echo get_the_author();?></a>
					</h5>
					<?php if(get_the_author_meta('job_title') !== '') {?>
					<p>
						<?php echo the_author_meta('job_title');?>
					</p>
					<?php
					}
					?>
				</div>
				<div class="author-description push-top-2">
					<p><?php echo the_author_meta("description"); ?></p>
				</div>
				<div class="df-post-sharing push-top-2 style3">
					<?php DF_Content::df_load_authorbox_social()?>
				</div>
			</div>
		</li>
	</ul>
</div>
<?php } ?>
