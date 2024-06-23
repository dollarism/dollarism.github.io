<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<div class="comment-avatar">
			<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '75' ), '' ); ?>
		</div>

		<div class="comment-text">

			<div class="comment-header">
				<h5 class="comment-author"><?php comment_author(); ?><?php
					if ( user_can( $comment->user_id, 'administrator' ) ) {
						echo '<em class="admin-label">(' . esc_html__( 'مدیریت', 'studiare' ) . ')</em> ';
					}
					elseif ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ){
						if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) ){
							echo '<em class="verified">(' . esc_html__( 'verified owner', 'studiare' ) . ')</em> ';
						}
					}
					?></h5>
					
				<time class="woocommerce-review__published-date" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html( get_comment_date( wc_date_format() ) ); ?></time>
					
				<?php

				/**
				 * The woocommerce_review_before_comment_meta hook.
				 *
				 * @hooked woocommerce_review_display_rating - 10
				 */
				do_action( 'woocommerce_review_before_comment_meta', $comment );

				?>
				
				
				
			</div>
			<?php
			$comment_id = get_comment_ID();
			
			//get the setting configured in the admin panel under settings discussions "Enable threaded (nested) comments  levels deep"  
			$max_depth = get_option('thread_comments_depth');
			//add max_depth to the array and give it the value from above and set the depth to 1
			$default = array(
				'add_below'  => 'comment',
				'respond_id' => 'respond',
				'reply_text' => __('Reply'),
				'depth'      => 1,
				'before'     => '<div class = "studiare-comment-replay-btn">',
				'after'      => '</div>',
				'max_depth'  => $max_depth
				);
				
			comment_reply_link($default,$comment_id); 
			?>
			<?php
			/**
			 * The woocommerce_review_meta hook.
			 *
			 * @hooked woocommerce_review_display_meta - 10
			 * @hooked WC_Structured_Data::generate_review_data() - 20
			 */

			do_action( 'woocommerce_review_before_comment_text', $comment );

			/**
			 * The woocommerce_review_comment_text hook
			 *
			 * @hooked woocommerce_review_display_comment_text - 10
			 */
			do_action( 'woocommerce_review_comment_text', $comment );

			do_action( 'woocommerce_review_after_comment_text', $comment ); ?>

		</div>
	</div>