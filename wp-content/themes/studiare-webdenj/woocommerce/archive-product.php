<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

global $courses_archive_classes, $sidebar_position;

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$sidebar_position = 'right';

if ( class_exists('Redux' ) ) {
    $sidebar_position = codebean_option('shop_sidebar');
}

// Sidebar View Demo
if( isset($_GET['courses_sidebar']) ){
	if( $_GET['courses_sidebar'] == 'left' ){
		$sidebar_position = 'left';
	}else{
		$sidebar_position = 'right';
	}
}

$courses_archive_classes = array('course-main-wrapper');

if ( is_active_sidebar( 'sidebar_shop' ) ) {
	if ( $sidebar_position == 'right' ) {
		$courses_archive_classes[] = 'has-sidebar shop-sidebar-right';
	} elseif ( $sidebar_position == 'left' ) {
		$courses_archive_classes[] = 'has-sidebar shop-sidebar-left';
	}
}

$courses_holder_classes = array('courses-holder');

do_action( 'woocommerce_before_main_content' );

?>

	<div <?php studiare_class_attribute( $courses_archive_classes ); ?>>
		<div class="course-wrapper-inner">

			<div <?php studiare_class_attribute( $courses_holder_classes ); ?>>

				<?php wc_get_template_part('global/helpbar');?>
				

				<?php if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

         ?>


			<?php do_action( 'woocommerce_archive_description' ); ?>


            </div>

			<?php if ( $sidebar_position !== 'none' ) {
	            do_action( 'woocommerce_sidebar' );
            } ?>

		</div>
	</div>

<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
