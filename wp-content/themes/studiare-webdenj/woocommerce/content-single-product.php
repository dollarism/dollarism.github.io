<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );
$related_courses_display = true;
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$course_sidebar = 'right';
$course_advice = true;
if ( class_exists('Redux') ) {
	$course_advice = codebean_option('course_advice');
	$course_share_story = codebean_option('course_share_story');
	$related_courses_display = codebean_option('related_courses_display');
	$course_sidebar = codebean_option('course_single_sidebar_position');
	$course_detail_reviews = codebean_option('course_detail_reviews');
}
$rating_enabled = get_option('woocommerce_enable_review_rating');

$course_single_sidebar_position = isset($_GET['sidebar']) ? $_GET['sidebar'] : $course_sidebar;

$course_container_classes = array('row');

if ( $course_single_sidebar_position == 'left' || $course_single_sidebar_position == 'right' ) {
	$course_container_classes[] = 'has-sidebar';
}

if ( $course_single_sidebar_position == 'left' ) {
	$course_container_classes[] = 'sidebar-left';
} elseif ( $course_single_sidebar_position == 'right' ) {
	$course_container_classes[] = 'sidebar-right';
}

// Custom Meta
$prefix = '_studiare_';
$teacher_id = get_post_meta( get_the_ID(), $prefix . 'course_teacher', true );
$teacher_2_id = get_post_meta( get_the_ID(), $prefix . 'course_teacher_2', true );
$course_video = get_post_meta(get_the_ID(), $prefix . 'course_video', true);
$course_disable_image = get_post_meta(get_the_ID(), $prefix . 'course_disable_image', true);
$poster_video_coures = get_post_meta(get_the_ID(), $prefix . 'poster_video_coures', true);
$stock = get_post_meta( get_the_ID(), '_stock', true );
$location_google_map = get_post_meta(get_the_ID(), $prefix . 'location_google_map', true);
global $product;

?>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="<?php echo esc_attr( implode( ' ', $course_container_classes ) ); ?>">

        <div class="product-single-main">

            <!-- Product Top Part-->
            <div class="product-single-top-part">

                <!-- Product Gallery -->
                <div class="course-single-gallery">

					<?php if ( $course_disable_image ) : ?>
						<?php
							$attr =  array(
							'mp4'      => $course_video,
							'poster'   => $poster_video_coures,
							'preload'  => 'none',
							'width'    => '1200',
							'height'   => '700'
							);
								echo wp_video_shortcode(  $attr );
						?>
				<?php else: ?>
					<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
				<?php endif; ?>

                </div>

            </div>

						<?php if ( wp_is_mobile() ): ?>

							<div class="product-single-meta-inside">
									<?php wc_get_template_part( 'content', 'single-product-meta-side-mob' ); ?>
							</div>
						<?php endif; ?>




			<div class="product-single-content">

			<!-- Study mode-->
			<div class="study-mode">
				<div class="study-mode-btn" tooltip="حالت مطالعه">
						<i class="fal fa-expand-arrows-alt"></i>
						<div class="study-mode-text">
							حالت مطالعه
						</div>
				</div>
			</div>

                <?php the_content(); ?>
            </div>
			<?php
            if (class_exists('HTQ_Woocommerce'))
            {
                $tests = HTQ_Woocommerce::get_tests_attached_to_product($product->get_id(), ['product']);
                // The new tab content
                if (count($tests) > 0)
                {
                    $content = '<div class="product-single-content">'
                            . '<h4>آزمو‌نهای مرتبط</h4><div class="wpb_wrapper_test"><ul>';
                    foreach ($tests as $item)
                    {
                        $content .= '<li><a href="' . get_permalink($item["id"]) . '">' . $item["title"] . '</a></li>';
                    }
                    $content .= '</ul></div></div>';
                    echo $content;
                }
            }
            ?>

						<?php if ( wp_is_mobile() ): ?>

						<?php if ( !empty( $teacher_id ) && $teacher_id != 'no-teacher' ) : ?>

							<?php
							get_template_part( '/woocommerce/teachers' );
							?>
						<?php endif; ?>
						<?php endif; ?>


			<?php if ( $location_google_map ) : ?>
			<div class="product-reviews">
                <div class="product-review-title">
                    <h3 class="inner"><i class="material-icons">location_on</i>محل برگزاری</h3>
                </div>
				<div class="product-reviews-inner">
				<?php echo($location_google_map); ?>
				</div>
            </div>
			<?php endif; ?>

			<?php echo wc_get_product_tag_list( $product->get_id(), '  ', '<div class="product-single-content"><span class="tagged_as"><i class="fal fa-tags"></i>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span></div>' ); ?>

			<?php if ( $course_advice ) : ?>
			<?php
			get_template_part( '/woocommerce/single-advice' );
			?>
			<?php endif; ?>

			<?php if ( $related_courses_display ) : ?>
			<?php get_template_part( '/inc/templates/woocommerce/related' ); ?>
			<?php endif; ?>



			<!-- Product Review -->
			<?php if ( $course_detail_reviews ) : ?>
            <div class="product-reviews">

                <div class="product-review-title">
                    <h3 class="inner"><i class="fal fa-percent"></i><?php esc_html_e( 'امتیاز دانشجویان دوره', 'studiare' ); ?></h3>
                </div>

                <div class="product-reviews-inner">
                <?php
                    if($rating_enabled == 'yes'):
                        $product = wc_get_product(get_the_id());
                        $rating_count = $product->get_rating_count();
                        $average      = $product->get_average_rating();
                        $average = round($average, 1); ?>
                        <div class="product-reviews-stats">
                            <!-- Averate Rating -->
                            <div class="average-rating">
                                <div class="avareage-rating-inner">
                                    <div class="average-rating-number"><?php echo esc_attr($average); ?></div>
                                    <div class="average-rating-stars">
                                        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                                    </div>
                                    <div class="average-rating-label">
                                        <?php echo esc_attr($rating_count.' '.esc_html__('رأی', 'studiare')); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Detailed Ratings-->
                            <?php
                            // WP_Comment_Query arguments
                            $args = array (
                                'status'         => 'approve',
                                'type'           => 'review',
                                'post_id'        => get_the_id(),
                            );

                            // The Comment Query
                            $woo_reviews = new WP_Comment_Query;
                            $comments = $woo_reviews->query( $args );

                            $rate1 = $rate2 = $rate3 = $rate4 = $rate5 = 0;
                            // The Comment Loop
                            if ( $comments ) {
                                foreach ( $comments as $comment ) {
                                    $rate = get_comment_meta($comment->comment_ID, 'rating', true);
                                    switch($rate) {
                                        case 1:
                                            $rate1++;
                                            break;
                                        case 2:
                                            $rate2++;
                                            break;
                                        case 3:
                                            $rate3++;
                                            break;
                                        case 4:
                                            $rate4++;
                                            break;
                                        case 5:
                                            $rate5++;
                                            break;
                                    } // switch
                                }
                            }
                            $rates = array('5'=>$rate5,'4'=>$rate4,'3'=>$rate3,'2'=>$rate2,'1'=>$rate1);
                            ?>
                            <div class="detailed-ratings">
                                <div class="detailed-ratings-inner">
	                                <?php foreach($rates as $key => $rate): ?>
		                                <?php
		                                if($rate !=0 or $rating_count != 0) {
			                                $fill_value = round($rate*100/$rating_count, 2);
		                                } else {
			                                $fill_value = 0;
		                                }
		                                ?>
                                        <div class="course-rating">
                                            <span class="number"><?php echo esc_attr($key.' '.__('Stars', 'studiare')); ?></span>
                                            <div class="bar">
                                                <div class="bar-fill" style="width:<?php echo esc_attr($fill_value); ?>%"></div>
                                            </div>
                                            <span class="counter"><?php echo esc_attr($rate); ?></span>
                                        </div>
	                                <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
			<?php endif; ?>

			<?php if ( comments_open() ): ?>
			<div class="product-reviews">
				<div class="product-review-title">
                    <h3 class="inner"><i class="fal fa-comment-alt-dots"></i><?php esc_html_e( 'Reviews', 'studiare' ); ?></h3>
                </div>
				<div class="product-reviews-inner">

                        <?php comments_template(); ?>

				</div>
			</div>
			<?php else: ?>
			<?php endif; ?>
        </div>
        <div class="product-single-aside sticky-sidebar">
            <div class="theiaStickySidebar">
                <?php wc_get_template_part('content-single-product-meta-side'); ?>

	            <?php if ( !empty( $teacher_id ) && $teacher_id != 'no-teacher' ) : ?>

								<?php
								get_template_part( '/woocommerce/teachers' );
								?>
							<?php endif; ?>



					<?php dynamic_sidebar('course_page_1'); ?>

					<div class="product-info-box">

						<?php echo wc_get_product_category_list( $product->get_id(), '، ', '<span class="posted_in"><i class="fal fa-list"></i>' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

						<div class="short-url-box">

							<input type="text" class="short-url-link" value="<?php echo get_bloginfo('url')."/?p=".$post->ID; ?>" id="myInput">
						</div>
						<?php if ( $course_share_story ) : ?>
							<?php
								get_template_part( '/inc/templates/sharing' );
							?>
						<?php endif; ?>
					</div>


					<?php dynamic_sidebar('course_page_2'); ?>
	                <?php wp_reset_postdata(); ?>

            </div>
        </div>

		<?php
		$current_user = wp_get_current_user();
								if ( wc_customer_bought_product( $current_user->user_email, $current_user->ID, $product->get_id())) {
									echo '<div class="sticky-add-to-cart">';
									echo '</div>';
								}
								else {
									do_action( 'woocommerce_sticky_add_to_cart' );
								}
		?>

	</div>
</div>
<?php do_action( 'woocommerce_after_single_product_summary' ); ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>
