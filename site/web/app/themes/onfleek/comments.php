<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package onfleek
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ; ?>

		<div class="df-comments-pagination">

		<div class="prev-comments">
		<?php previous_comments_link( '<i class="fa fa-chevron-left df-btn"></i> Older Comments ' ); ?>
		</div>
		<div class="next-comments">
		<?php next_comments_link( 'Newer Comments <i class="fa fa-chevron-right df-btn"></i> ' ); ?>
		</div>
			
		</div>

		<?php endif; // Check for comment navigation. ?>

		<ul class="list-inline">
			<?php
				$df_comment_args = array(
					'callback' => 'df_comment_template',
					'style'	=> 'ul',
				);

				wp_list_comments( $df_comment_args );
			?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ; ?>

		<div class="df-comments-pagination">

      <div class="prev-comments">
        <?php previous_comments_link( '<i class="fa fa-chevron-left df-btn"></i> Older Comments ' ); ?>
      </div>
      <div class="next-comments">
        <?php next_comments_link( 'Newer Comments <i class="fa fa-chevron-right df-btn"></i> ' ); ?>
      </div>
			
		</div>

		<?php endif; // Check for comment navigation. 

	endif; // Check for have_comments(). 


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'onfleek' ); ?></p>
	<?php
	endif;

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$args_comment = array(
		'class_form' 	=> 'comment-form',
		'comment_notes_before' 	=> '<p class="reply-description">
									Your email address will not be published. Required fields are marked *
									</p><div class="comment-form-input">',
		'comment_notes_after' 	=> '',
		'logged_in_as' 			=> '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. 
									<a href="%3$s" title="Log out of this account">Log out?</a>', 'onfleek' ), 
									admin_url( 'profile.php' ), 
									$user_identity, 
									wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>
									<div class="comment-form-input">',

		'comment_field' 		=>  '<p class="form-title">comment *</p>
									<textarea name="comment" id="comment" cols="106" rows="10"></textarea>',
		'fields' 				=> apply_filters( 'comment_form_default_fields', array(
				            'author' => '<ul class="comment-form-info list-inline">
				            			<li class="comment-author">
											<p class="form-title">name *</p>
											<input type="text" id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) .'" '.$aria_req.'>
										</li><!--',
				            'email' => '--><li class="comment-email">
											<p class="form-title">email *</p>
											<input type="text" id="email" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" '.$aria_req.' >
										</li><!--',
				            'url' 	=> '--><li class="comment-website">
											<p class="form-title">website *</p>
											<input type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" aria-required="true"  >
										</li></ul>'
				          	)
        ),
		'title_reply_before' 	=> '<ul class="df-reply list-inline">
									<li class="reply-title">',	
		'title_reply_after' 	=> '</li></ul>',
		'label_submit' 			=> 'submit your comment',
		'class_submit' 			=> 'df-btn df-btn-normal comment-submit',
		'submit_field' 			=> '</div><div class="df-btn-submit-comment">%1$s %2$s</div>'
	);

	comment_form( $args_comment );




	function df_comment_template( $comment, $args, $depth ){
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
			case 'pingback':
			case 'trackback': ?>
				<li <?php comment_class(); ?> id="comment<?php comment_ID(); ?>">
            	<div class="back-link">< ?php comment_author_link(); ?></div>
			<?php
				break;
			default:
			?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		            <div <?php comment_class('df-comments-inner');?> >
		            	<div class="comments-avatar">
		            		<?php echo get_avatar( $comment, 100, '','', array( 'class' => 'img-circle' ) );?>
		            	</div>
		            	<div class="comments-post">
		            		<div class="vcard">
		            			<h5 class="author"><?php comment_author();?></h5> 
		            		</div>
		            		<div class="comments">
		            			<?php comment_text();?>
		            		</div>
		            		<div class="comments-footer">
		            			<ul class="list-inline">
		            				<li><span class="post-date"><?php comment_date();?></span></li>
		            				<li class="comments-button">
		            					<span id="show-input">
		            						<?php 
								            comment_reply_link( array_merge( $args, 
								            	array( 
								            		'reply_text' => 'Reply',
								            		'depth' => $depth,
								            		'max_depth' => $args['max_depth'] 
								            		) 
								            	) 
								            ); 
								            ?>	
		            					</span>
		            				</li>
		            			</ul>
		            		</div>
		            	</div>
		            </div>
		        <?php // End the default styling of comment
				break;
		}
	}
?>
