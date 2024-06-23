<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $product;

$prefix = '_studiare_';

$course_video = get_post_meta(get_the_ID(), $prefix . 'course_video', true);

$thumb_image_size = 'shop_single';

$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
) );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="product-image-wrapper">
		<?php

		$attributes = array(
			'title'                   => $image_title,
			'data-src'                => $full_size_image[0]
		);

		if ( has_post_thumbnail() ) {
			$html = get_the_post_thumbnail( $post->ID, 'full', $attributes );
		} else {
			$html  = sprintf( '<img src="%s" alt="%s" data-src="%s" data-large_image="%s" data-large_image_width="800" data-large_image_height="600" class="attachment-shop_single size-shop_single wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'studiare' ), esc_url( wc_placeholder_img_src() ), esc_url( wc_placeholder_img_src() ) );
        }

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); ?>

		<?php if ( $course_video ) : ?>
						<div class="video-button">
							<a data-post-id="<?php echo get_the_ID(); ?>" href="<?php echo esc_url( $course_video ); ?>" class="cdb-video-icon video-thumbnail"><i class="fal fa-play"></i></a>
						</div>
					<?php endif; ?>

        <?php do_action( 'woocommerce_product_thumbnails' ); ?>
	</div>
</div>
