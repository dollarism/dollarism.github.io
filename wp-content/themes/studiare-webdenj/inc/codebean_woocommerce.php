<?php
/**
 * Codebean WooCommerce functions, actons and filters
 */

// Remove Woo Styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Remove result count and catalog ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove Cross-Sells from the shopping cart page
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

// Change out of stock text
add_filter( 'woocommerce_get_availability', 'studiare_custom_get_availability', 1, 2);

// Our hooked in function $availablity is passed via the filter!
function studiare_custom_get_availability( $availability, $_product ) {
	if ( !$_product->is_in_stock() ) $availability['availability'] = esc_html__('No available seats', 'studiare');

	return $availability;
}

//Change the breadcrumb separator
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '<i class="fa fa-angle-right"></i>';
	return $defaults;
}

// Remove breadcrumb before content add it on page title
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// Remove tabs & upsell display
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

// Remove functions before single product summary
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_custom_meta', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Remove thumbnails from product single
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );


/**
 * Get Teachers List and Return it as array
 */
if ( ! function_exists( 'studiare_get_teachers_list' ) ) {
	function studiare_get_teachers_list() {

		$teachers = array(
			'no-teacher' => esc_html__( 'Choose a Teacher', 'studiare' ),
		);

		$teachers_args = array(
			'post_type'     => 'teacher',
			'post_status'   => 'publish',
			'posts_per_page'=> -1,
		);

		// Makes a query for the teacher post type
		$teachers_query = new WP_Query( $teachers_args );

		// Adds every teacher to the $teachers array
		foreach( $teachers_query->posts as $teacher ){
			$teachers[$teacher->ID] = $teacher->post_title;
		}

		// Return these teachers
		return $teachers;
	}
}

/**
 * Shop products per page
 */
function studiare_shop_products_per_page() {

	$shop_per_page = '12';

	if ( class_exists('Redux') ) {
		$shop_per_page = codebean_option('shop_per_page');
	}

	$per_page = 12;
	$number = apply_filters('studiare_shop_per_page', $shop_per_page );
	if( is_numeric( $number )  &&  $number > 0) {
		$per_page = $number;
	}

	return $per_page;
}

add_filter( 'loop_shop_per_page', 'studiare_shop_products_per_page', 20 );


if( ! function_exists( 'studiare_cart_data' ) ) {
	add_filter('woocommerce_add_to_cart_fragments', 'studiare_cart_data', 30);
	function studiare_cart_data( $array ) {
		ob_start();
		studiare_cart_count();
		$count = ob_get_clean();

		ob_start();
		studiare_cart_subtotal();
		$subtotal = ob_get_clean();

		$array['span.studiare-cart-number'] = $count;
		$array['span.studiare-cart-subtotal'] = $subtotal;

		return $array;
	}
}

if( ! function_exists( 'studiare_cart_count' ) ) {
	function studiare_cart_count() {
		$count = WC()->cart->cart_contents_count;
		?>
		<span class="studiare-cart-number"><?php echo esc_html($count); ?></span>
		<?php
	}
}

if( ! function_exists( 'studiare_cart_subtotal' ) ) {
	function studiare_cart_subtotal() {
		?>
		<span class="studiare-cart-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
		<?php
	}
}

/**
 * Remove sidebar from single product
 */
function remove_sidebar_shop() {
	if ( is_singular('product') ) {
		remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
	}
}
add_action('template_redirect', 'remove_sidebar_shop');

/**
 * Render custom price html
 */
function studiare_custom_get_price_html( $price, $product ) {
	if ( $product->get_price() == 0 ) {
		if ( $product->is_on_sale() && $product->get_regular_price() ) {
			$regular_price = '<del class="amount-free">' . wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) ) . '</del>';

			$price = wc_format_price_range( $regular_price, esc_html__( 'Free!', 'studiare' ) );
		} else {
			$price = '<span class="amount">' . esc_html__( 'Free!', 'studiare' ) . '</span>';
		}
	}

	return $price;
}

add_filter( 'woocommerce_get_price_html', 'studiare_custom_get_price_html', 10, 2 );



/**
 * Cart Page markup
 */
add_action( 'woocommerce_before_cart', function() {
	echo '<div class="cart-page-inner row">';
}, 1);

add_action( 'woocommerce_after_cart', function() {
	echo '</div><!--.cart-totals-inner-->';
}, 200);

/**
 * Custom Excerpt for Products
 */
function studiare_product_custom_excerpt_length( $length ) {
	global $post;
	if ($post->post_type == 'product') {
		return 20;
	}
}

/**
 * Cart Mobile Menu Item
 */
function studiare_get_menu_item_cart() {
    $show_cart_item = true;

	if ( class_exists( 'Redux' ) ) {
		$show_cart_item = codebean_option('off_canvas_cart');
	}

	if ( ! $show_cart_item || ! function_exists( 'WC' ) ) {
		return;
	}

	$cart_items = WC()->cart->get_cart_contents_count();

	?>
    <div class="off-canvas-cart">
        <a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon-link">
            <span class="bag-icon"><?php get_template_part( 'assets/images/shop-bag.svg' ); ?></span>
            <span class="cart-text"><?php esc_html_e( 'Cart', 'studiare' ); ?></span>
            <?php studiare_cart_count(); ?>
        </a>
    </div>
    <?php
}

/**
 * ------------------------------------------------------------------------------------------------
 * Determine is it product attribute archieve page
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'studiare_is_product_attribute_archieve' ) ) {
	function studiare_is_product_attribute_archieve() {
		$queried_object = get_queried_object();
		if( $queried_object && property_exists( $queried_object, 'taxonomy' ) ) {
			$taxonomy = $queried_object->taxonomy;
			return substr($taxonomy, 0, 3) == 'pa_';
		}
		return false;
	}
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'add_to_cart_text' );
function add_to_cart_text() {
	$prefix = '_studiare_';
	$course_add_to_cart_text = get_post_meta(get_the_ID(), $prefix . 'course_add_to_cart_text', true);
	$add_to_cart_text = 'ثبت نام در دوره';
if ( class_exists('Redux') ) {
	$add_to_cart_text = codebean_option('add_to_cart_text');
}
if ( $course_add_to_cart_text ) {
	$add_to_cart_text = $course_add_to_cart_text;
}
        return __( $add_to_cart_text );
}

// دکمه خرید چسبان //
add_action( 'woocommerce_sticky_add_to_cart', 'stick_add_to_cart', 30 );
function stick_add_to_cart() {
  global $product;
  ?>
	<div class="sticky-add-to-cart hidden-stick-button">
		<?php if ( $product->is_type( 'simple' ) ): ?>
			<?php woocommerce_simple_add_to_cart(); ?>
		<?php endif; ?>
	</div>
<?php
}

// بازنویسی ابزارک فیلتر قیمت //
add_action( 'widgets_init', 'override_woocommerce_widgets', 15 );
function override_woocommerce_widgets() {
    if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
    unregister_widget( 'WC_Widget_Price_Filter' );

	include get_template_directory().'/inc/widgets/class-wc-widget-price-filter.php';
    register_widget( 'Studiare_Widget_Price_Filter' );
  }
}



// بازنویسی ابزارک محصولات ووکامرس //
add_action( 'widgets_init', 'override_woocommerce_widgets_products', 15 );
function override_woocommerce_widgets_products() {
    if ( class_exists( 'WC_Widget_Products' ) ) {
    unregister_widget( 'WC_Widget_Products' );

	include get_template_directory().'/inc/widgets/class-wc-widget-products.php';
    register_widget( 'Stduaires_Widget_Products' );
  }
}




/*  Sale Product Countdown
/* --------------------------------------------------------------------- */
if( ! function_exists( 'emallshop_sale_product_countdown' ) ) {
	function emallshop_sale_product_countdown() {
		global $product;

		if ( $product->is_on_sale() ) :
			$time_sale_end = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
			$time_sale_start = get_post_meta( $product->get_id(), '_sale_price_dates_from', true );
		endif;

		$timezone = wc_timezone_string();

		?>

		<?php if( $product->is_on_sale() && $time_sale_end ) :?>
			<div class="deal_timer_single">
				<div class="deal-text">
					<i class="fal fa-clock"></i>
					پیشنهاد<span>شگفت انگیز</span>
				</div>
				<div class="countdown-timer-holder-loop">
					<div class="countdown-item" data-date="<?php echo date('Y-m-d 00:00:00', $time_sale_end) ;?>"></div>
				</div>
			</div>
		<?php endif;?>

	<?php }
}

add_action( 'woocommerce_single_product_countdown', 'emallshop_sale_product_countdown', 14 );



/*  Sale Product Countdown on loops
/* --------------------------------------------------------------------- */
/* if( ! function_exists( 'emallshop_sale_product_countdown_loop' ) ) {
	function emallshop_sale_product_countdown_loop() {
		global $product;

		if ( $product->is_on_sale() ) :
			$time_sale = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
		endif;

		?>

		<?php if( $product->is_on_sale() && $time_sale ) :?>
			<div class="deal_timer_loop">
				<div class="countdown-timer-holder-loop">
					<div class="countdown-item" data-date="<?php echo date('Y/m/d',$time_sale);?>"></div>
				</div>
			</div>
		<?php endif;?>

	<?php }
}

add_action( 'woocommerce_single_product_countdown_loop', 'emallshop_sale_product_countdown_loop', 14 );
*/


add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price( $price, $product ) {

     $price = 'از ';

     $price .= wc_price($product->get_price());

     return $price;
}
