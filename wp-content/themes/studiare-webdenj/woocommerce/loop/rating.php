<?php
/**
 * Loop Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/rating.php.
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
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$average      = $product->get_average_rating();
$average_number = $average;
$class = null;

$vote_title = sprintf( esc_html__( '%s Votes', 'studiare' ), $rating_count );

if ( $rating_count > 0 ) {
	$title = sprintf( esc_html__( 'Rated %s out of 5', 'studiare' ), $average );
	$class = 'has-ratings';
} else {
	$title = esc_html__( 'Not yet rated', 'studiare' );
	$average = esc_html__( 'No Votes', 'studiare' );
	$class = 'no-ratings';
} ?>

<div class="star-rating <?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $title ); ?>">
	<span style="width:<?php echo ( ( $average_number / 5 ) * 100 ); ?>%">
		<span class="rating"><?php echo esc_html( $average ); ?></span>
		<span class="votes-number"><?php echo esc_html( $vote_title ); ?></span>
	</span>
</div>

<?php //echo wc_get_rating_html( $product->get_average_rating() ); ?>