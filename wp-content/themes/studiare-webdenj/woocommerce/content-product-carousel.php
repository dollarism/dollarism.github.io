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
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$prefix = '_studiare_';
$course_video = get_post_meta(get_the_ID(), $prefix . 'course_video', true);
$course_disable_image = get_post_meta(get_the_ID(), $prefix . 'course_disable_image', true);
$poster_video_coures = get_post_meta(get_the_ID(), $prefix . 'poster_video_coures', true);

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

$courses_cart_loop = true;
$courses_teacher_loop = true;
$course_students = true;
$courses_rating_loop = true;
if ( class_exists( 'Redux' ) ) {
	$course_students = codebean_option('course_students');
	$course_video_loop = codebean_option('course_video_loop');
	$courses_rating_loop = codebean_option('courses_rating_loop');
	$courses_teacher_loop = codebean_option('courses_teacher_loop');
	$courses_cart_loop = codebean_option('courses_cart_loop');
}

?>
<div <?php post_class( 'course-item' ); ?>>

<!--    --><?php //do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <div class="course-item-inner">



	<?php if ( ( $course_disable_image ) && ( $course_video_loop == true ) ) : ?>

		<?php
			$attr =  array(
			'mp4'      => $course_video,
			'poster'   => $poster_video_coures,
			'preload'  => 'none',
			'width'    => '585',
			'height'   => '340'
			);
			echo wp_video_shortcode(  $attr );
		?>
		<div class="course-item-sale">
		<?php
							global $product;

								if ( $product->is_on_sale() ) {

								if ( ! $product->is_type( 'variable' ) ) {

								$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;

								} else {

									$max_percentage = 0;

									foreach ( $product->get_children() as $child_id ) {
									$variation = wc_get_product( $child_id );
									$price = $variation->get_regular_price();
									$sale = $variation->get_sale_price();
									if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
									if ( $percentage > $max_percentage ) {
									$max_percentage = $percentage;
									}
									}

								}
								echo "<div class='sale-perc-badge'>";
								echo "<div class='sale-perc'>" . round($max_percentage) . "% </div>";
								echo "<div class='sale-badge-text'>تخفیف</div>";
								echo "</div>";
								}
							?>
			</div>
	<?php else: ?>
	    <?php if ( has_post_thumbnail( ) ) : ?>
            <div class="course-thumbnail-holder">
                <?php woocommerce_template_loop_product_link_open(); ?>
                    <span class="image-item">
						<?php do_action( 'woocommerce_single_product_countdown_loop' ); ?>
                        <?php woocommerce_template_loop_product_thumbnail(); ?>
                    </span>

					<?php if ( $course_video ) : ?>
						<div class="video-button">
							<a data-post-id="<?php echo get_the_ID(); ?>" href="<?php echo esc_url( $course_video ); ?>" class="cdb-video-icon video-thumbnail"><i class="fal fa-play"></i></a>
						</div>
					<?php endif; ?>
							<?php if ( $courses_cart_loop ) : ?>
								<?php woocommerce_template_loop_add_to_cart(); ?>
							<?php endif; ?>

                <?php woocommerce_template_loop_product_link_close(); ?>

							
							<?php
							global $product;

								if ( $product->is_on_sale() ) {

								if ( ! $product->is_type( 'variable' ) ) {

								$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;

								} else {

									$max_percentage = 0;

									foreach ( $product->get_children() as $child_id ) {
									$variation = wc_get_product( $child_id );
									$price = $variation->get_regular_price();
									$sale = $variation->get_sale_price();
									if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
									if ( $percentage > $max_percentage ) {
									$max_percentage = $percentage;
									}
									}

								}
								echo "<div class='sale-perc-badge'>";
								echo "<div class='sale-perc'>" . round($max_percentage) . "% </div>";
								echo "<div class='sale-badge-text'>تخفیف</div>";
								echo "</div>";
								}
							?>
            </div>
	    <?php endif; ?>

		<?php endif; ?>

        <div class="course-content-holder">

            <div class="course-content-main">
                <h3 class="course-title">
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                </h3>
	            <?php $comments_num = get_comments_number(get_the_id()); ?>

                <?php if ( $comments_num || ( !empty( $teacher_id ) && $teacher_id != 'no-teacher' ) ) : ?>
                    <div class="course-rating-teacher">
											<?php if ( $courses_rating_loop ) : ?>
												<div class="average-rating-stars">
													<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
												</div>
											<?php endif; ?>
					            <?php if ( !empty( $teacher_id ) && $teacher_id != 'no-teacher' && $courses_teacher_loop ) : ?>
                                 <div class="teacher-box">
																	 <i class="fal fa-chalkboard-teacher" title="مدرس دوره"></i>
																	  <a href="<?php echo esc_url( get_the_permalink( $teacher_id ) ); ?>" class="course_loop_teacher"><?php echo esc_attr( get_the_title( $teacher_id ) ); ?></a> </div>
					            <?php else : ?>
                                  <div class="teacher-box"></div>
					            <?php endif; ?>
                            </div>
                <?php endif; ?>


            </div>

            <div class="course-content-bottom">

	              <div class="course-students">
                                    <?php if ( $course_students ) : ?>
                                    <i class="fal fa-users"></i><span><?php $count = get_post_meta(get_the_ID(),'total_sales', true); $text = sprintf( _n( '%s', '%s', $count, 'wpdocs_textdomain' ), number_format_i18n($count));echo $text;  ?>
							<?php endif; ?>
                                </div>

                <div class="course-price">
					            <?php woocommerce_template_loop_price(); ?>
                            </div>

            </div>

        </div>

    </div>
</div>
