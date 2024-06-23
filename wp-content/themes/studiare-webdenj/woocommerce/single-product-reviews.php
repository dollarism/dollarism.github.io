<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

$content_review_rules = '';

if ( class_exists('Redux' ) ) {
    $content_review_rules = codebean_option('content_review_rules');
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">

		<?php if ( have_comments() ) : ?>

            <ul class="commentlist">
	            <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
            </ul>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&rarr;',
					'next_text' => '&larr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else: ?>

		<?php endif; ?>

		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

            <div class="review-form-wrapper">

			<div class="product-reviews-rules">
					<h3 class="inner">قوانین ثبت دیدگاه</h3>
						<?php if ( $content_review_rules != '' ) : ?>
						<?php echo do_shortcode( $content_review_rules ); ?>
						<?php endif; ?>
					</div>

                <div class="review_form" id="review_form">
                    <?php

                        $commenter = wp_get_current_commenter();

                        $comment_form = array(
                            'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'studiare' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'studiare' ), get_the_title() ),
                            'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'studiare' ),
                            'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
                            'title_reply_after'    => '</h3>',
                            'comment_notes_after'  => '',
                            'fields'               => array(
                                'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'studiare' ) . '&nbsp;<span class="required">*</span></label> ' .
                                            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
                                'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'studiare' ) . '&nbsp;<span class="required">*</span></label> ' .
                                            '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
                            ),
                            'label_submit'  => esc_html__( 'Submit', 'studiare' ),
                            'logged_in_as'  => '',
                            'comment_field' => '',
                        );

                        if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
                            $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'studiare' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
                        }

                        $current_user = wp_get_current_user();
								if ( wc_customer_bought_product( $current_user->user_email, $current_user->ID, $product->get_id())) {
                            $comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'studiare' ) . '</label><select name="rating" id="rating" aria-required="true">
                                <option value="">' . esc_html__( 'امتیاز دوره را انتخاب کنید', 'studiare' ) . '</option>
                                <option value="5">' . esc_html__( 'Perfect', 'studiare' ) . '</option>
                                <option value="4">' . esc_html__( 'Good', 'studiare' ) . '</option>
                                <option value="3">' . esc_html__( 'Average', 'studiare' ) . '</option>
                                <option value="2">' . esc_html__( 'Not that bad', 'studiare' ) . '</option>
                                <option value="1">' . esc_html__( 'Very poor', 'studiare' ) . '</option>
                            </select></div>';
                        }

                        $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'studiare' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

                        comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

                    ?>
                </div>
            </div>

        <?php else: ?>

            <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'studiare' ); ?></p>

        <?php endif; ?>

	</div>
</div>
