<?php


// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

list( $query_args, $products_query ) = vc_build_loop_query( $products_query );

// Element Class
$class_to_filter = "products grid-view courses-{$columns}-columns";
$class_to_filter .= $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

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

<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
    <?php if ( $products_query->have_posts() ) : $i = 0; ?>
        <?php while( $products_query->have_posts() ) : $products_query->the_post(); ?>
            <?php
                global $product;

                // Custom Meta
                $prefix = '_studiare_';
				$course_video = get_post_meta(get_the_ID(), $prefix . 'course_video', true);
				$course_disable_image = get_post_meta(get_the_ID(), $prefix . 'course_disable_image', true);
				$poster_video_coures = get_post_meta(get_the_ID(), $prefix . 'poster_video_coures', true);
                $teacher_id = get_post_meta( get_the_ID(), $prefix . 'course_teacher', true );
                $stock = get_post_meta( get_the_ID(), '_stock', true );
                $regular_price = get_post_meta(get_the_id(), '_regular_price', true );
                $sale_price = get_post_meta(get_the_id(), '_sale_price', true );
		    ?>
            <div <?php post_class( 'course-item' ); ?>>
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
                            <a href="<?php the_permalink(); ?>">
								<?php do_action( 'woocommerce_single_product_countdown_loop' ); ?>
					            <?php woocommerce_template_loop_product_thumbnail(); ?>
                            </a>
														<?php if ( $course_video ) : ?>
															<div class="video-button">
																<a data-post-id="<?php echo get_the_ID(); ?>" href="<?php echo esc_url( $course_video ); ?>" class="cdb-video-icon video-thumbnail"><i class="fal fa-play"></i></a>
															</div>
														<?php endif; ?>
																<?php if ( $courses_cart_loop ) : ?>
																	<?php woocommerce_template_loop_add_to_cart(); ?>
																<?php endif; ?>

							

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
						<div class="course-top-content">
                            <h3 class="course-title">
                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                            </h3>
						</div>
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
        <?php $i++; endwhile; wp_reset_postdata(); ?>
    <?php endif; ?>
</div>
