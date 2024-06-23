<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$comments_number = get_comments_number();

?>

<?php if ( have_comments() ) : ?>

	<div class="comment-holder">
		<h2 class="comment-title"><?php echo sprintf( _n( '1 Comment', '%d Comments', $comments_number, 'studiare' ), $comments_number ); ?></h2>
		<p class="comment-subtitle"><?php $comments_number > 0 ? esc_html_e( 'Join the discussion and tell us your opinion.', 'studiare' ) : esc_html_e( 'Be the first to comment on this article.', 'studiare' ); ?></p>

		<ul class="commentlist clearfix">
			<?php wp_list_comments(
				array(
					'type'		  => 'all',
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 80
				)
			); ?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link(); ?></div>
				<div class="nav-next"><?php next_comments_link(); ?></div>
			</div><!-- .navigation -->
		<?php } ?>

	</div>
<?php else : if ( ! comments_open() ) : ?>
	<p class="nocomments"><?php esc_html_e("Comments are closed", 'studiare'); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; ?>

<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'studiare' ); ?></p>
<?php } ?>

<?php comment_form( array(
	'comment_notes_before' => '',
	'comment_notes_after' => ''
) ); ?>
