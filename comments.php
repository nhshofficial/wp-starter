<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package starter
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

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) : ?>

        <h2 class="comments-title">
            <?php
            $starter_post_comments_number = get_comments_number();
            if ( '1' === $starter_post_comments_number ) {
                printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'starter' ),
					'<span>' . esc_html(get_the_title()) . '</span>'
				);
            } else {
                printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $starter_post_comments_number, 'comments title', 'starter' ) ),
					esc_html( number_format_i18n( $starter_post_comments_number ) ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
            }
            ?>
        </h2><!-- .comments-title -->


        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'starter' ); ?></h2>
                <div class="nav-links d-flex justify-content-between">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'starter' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'starter' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
        <?php endif; // Check for comment navigation. ?>

        <ul class="comment-list">
            <?php
            wp_list_comments( array( 'callback' => 'starter_post_comment', 'avatar_size' => 50 ));
            ?>
        </ul><!-- .comment-list -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'starter' ); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'starter' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'starter' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
            <?php
        endif; // Check for comment navigation.

    endif; // Check for have_comments().


    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'starter' ); ?></p>
        <?php
    endif; ?>

    <?php comment_form( $args = array(
        'id_form'           => 'commentform',  // that's the wordpress default value! delete it or edit it ;)
        'id_submit'         => 'commentsubmit',
        'title_reply'       => __( 'Leave a Reply', 'starter' ),  // that's the wordpress default value! delete it or edit it ;)
		/* translators: 1: Reply Specific User */
        'title_reply_to'    => __( 'Leave a Reply to %s', 'starter' ),  // that's the wordpress default value! delete it or edit it ;)
        'cancel_reply_link' => __( 'Cancel Reply', 'starter' ),  // that's the wordpress default value! delete it or edit it ;)
        'label_submit'      => __( 'Post Comment', 'starter' ),  // that's the wordpress default value! delete it or edit it ;)

        'comment_field' =>  '<p><textarea placeholder="Start typing..." id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',

        'comment_notes_after' => '<p class="form-allowed-tags">' .
            __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'starter' ) .
            '</p><div class="alert alert-info">' . allowed_tags() . '</div>'

        // So, that was the needed stuff to have bootstrap basic styles for the form elements and buttons

        // Basically you can edit everything here!
        // Checkout the docs for more: http://codex.wordpress.org/Function_Reference/comment_form
        // Another note: some classes are added in the bootstrap-wp.js - ckeck from line 1

    ));

	?>

</div><!-- #comments -->
