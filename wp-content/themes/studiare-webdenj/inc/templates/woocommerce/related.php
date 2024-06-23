<?php
/**
 * Related Products
 */
$posts_per_page = 6;
if ( class_exists('Redux' ) ) {
	$posts_per_page = codebean_option( 'course_per_page' );
}

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 global $product, $woocommerce_loop;

 $related = wc_get_related_products( $product->get_id(), $posts_per_page );

 if ( sizeof( $related ) == 0 ) return;

 $args = apply_filters( 'woocommerce_related_products_args', array(
    'post_type'            => 'product',
    'ignore_sticky_posts'  => 1,
    'no_found_rows'        => 1,
    'posts_per_page'       => $posts_per_page,
    'post__in'             => $related,
    'post__not_in'         => array( $product->get_id() )
 ) );

 $products = new WP_Query( $args );

 if ( $products->have_posts() ) : ?>


    <div class="product-reviews">
		<div class="product-review-title">
                    <h3 class="inner">دوره های مرتبط</h3>
                </div>
		<div class="product-reviews-inner">
			<div class="products list-view courses-1-columns">

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template_part( 'content-list', 'product' ); ?>

            <?php endwhile; // end of the loop. ?>

			</div>
		</div>
    </div>

      <?php endif;

 wp_reset_postdata();
