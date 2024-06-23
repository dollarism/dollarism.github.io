<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

add_filter( 'excerpt_length', 'studiare_product_custom_excerpt_length', 999 );

// Custom Meta
$sale_price = $product->get_sale_price();
$regular_price = $product->get_regular_price();
$prefix = '_studiare_';
$teacher_id = get_post_meta( get_the_ID(), $prefix . 'course_teacher', true );
$stock = get_post_meta( get_the_ID(), '_stock', true );

$course_students = true;
if ( class_exists( 'Redux' ) ) {
	$course_students = codebean_option('course_students');
}


?>
<div <?php post_class( 'course-item' ); ?>>

<!--    --><?php //do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <div class="course-item-inner">

	    <?php if ( has_post_thumbnail( ) ) : ?>
            <div class="course-thumbnail-holder">
                <?php woocommerce_template_loop_product_link_open(); ?>
                    <span class="image-item">
                        <?php the_post_thumbnail('studiare-course-thumb', array('class'=>'img-fluid')); ?>
                    </span>
                <?php woocommerce_template_loop_product_link_close(); ?>



            </div>
	    <?php endif; ?>

        <div class="course-content-holder">

            <div class="course-content-main">
                <h4 class="course-title">
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                </h4>
	            <?php $comments_num = get_comments_number(get_the_id()); ?>
                <div class="course-description">
	                <?php the_excerpt(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
