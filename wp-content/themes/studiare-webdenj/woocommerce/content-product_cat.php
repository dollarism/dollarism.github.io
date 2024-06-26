<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div <?php post_class( 'course-item' ); ?>>

	<div class="course-item-inner product-category">
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>


			<div class="course-content-holder">

            <div class="course-content-main">
			<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
				<h3 class="category-title">
				<?php
				echo $category->name;
				if ( $category->count > 0 ) {
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count"> </span>', $category );
				}
				?>
				</h3>
			</a>

			</div>
			</div>


		</a>
	</div>
</div>
