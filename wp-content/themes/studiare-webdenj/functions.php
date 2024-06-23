<?php

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/plugins/redux-framework/redux-core/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/inc/plugins/redux-framework/redux-core/framework.php' );
}
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
/**
 * Studiare functions and definitions
 */

# Constants
define('STUDIARE_THEMEDIR', 		get_theme_file_path() . '/');
define('STUDIARE_THEMEURL', 		get_theme_file_uri() . '/');
define('STUDIARE_THEMEASSETS',	    STUDIARE_THEMEURL . 'assets/');
define('STUDIARE_TD', 			    'studiare');
define('STUDIARE_TS', 			    microtime(true));

# Initial Actions
add_action( 'after_setup_theme',    'studiare_after_setup_theme' );
add_action('init', 				    'studiare_init');

add_action('wp_enqueue_scripts',    'studiare_wp_enqueue_scripts');

if (!isset($content_width)) {
	$content_width = 1120;
}



# Core Files
require get_parent_theme_file_path( '/inc/codebean_functions.php' );
require get_parent_theme_file_path( '/inc/codebean_actions.php' );
require get_parent_theme_file_path( '/inc/codebean_filters.php' );
require get_parent_theme_file_path( '/inc/codebean_vc.php' );
require get_parent_theme_file_path( '/inc/codebean_woocommerce.php' );
require_once get_parent_theme_file_path( '/inc/mega-menus.php' );


# Widgets
require get_parent_theme_file_path( '/inc/widgets/contacts.php' );
require get_parent_theme_file_path( '/inc/widgets/banner-widget.php' );

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/inc/codebean_options.php' ) ) {
	require_once( dirname( __FILE__ ) . '/inc/codebean_options.php' );
}

# Libraries
require get_parent_theme_file_path('/inc/tgm/tgm-plugin-registration.php');

function add_class_value_in_any_lang($badge_code){
	switch($badge_code){
		case 'free':
		$result = 'رایگان';
		break;
		$result = '';
		break;
		case 'video':
		$result = 'ویدئو';
		break;
		$result = '';
		break;
		case 'exam':
		$result = 'آزمون';
		break;
		$result = '';
		break;
		case 'quiz':
		$result = 'کوئیز';
		break;
		$result = '';
		break;
		case 'lecture':
		$result = 'مقاله';
		break;
		$result = '';
		break;
		case 'practice':
		$result = 'تمرین';
		break;
		$result = '';
		break;
		case 'attachments':
		$result = 'فایل های ضمیمه';
		break;
		$result = '';
		break;
		case 'sound':
		$result = 'فایل صوتی';
		break;
		$result = '';
		break;
	}
	return $result;
}





/**
 * @snippet       Display All Products Purchased by User via Shortcode - WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=22004
 * @author        Rodolfo Melogli
 * @compatible    Woo 3.5.1
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_shortcode( 'my_products', 'bbloomer_user_products_bought' );

function bbloomer_user_products_bought() {

    global $product, $woocommerce, $woocommerce_loop;

    // GET USER
    $current_user = wp_get_current_user();

    // GET USER ORDERS (COMPLETED + PROCESSING)
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $current_user->ID,
        'post_type'   => wc_get_order_types(),
		'post_status' => array('wc-completed'),
    ) );


    // LOOP THROUGH ORDERS AND GET PRODUCT IDS
    if ( ! $customer_orders ) return;
    $product_ids = array();
    foreach ( $customer_orders as $customer_order ) {
        $order = new WC_Order( $customer_order->ID );
        $items = $order->get_items();
        foreach ( $items as $item ) {
            $product_id = $item->get_product_id();
            $product_ids[] = $product_id;
        }
    }
    $product_ids = array_unique( $product_ids );

    // QUERY PRODUCTS
	$args = array(
       'post_type' => 'product',
       'post__in' => $product_ids,
	   'posts_per_page' => -1,
    );
    $loop = new WP_Query( $args );

    // GENERATE WC LOOP
    ob_start();
    echo '<div class="products list-view courses-1-columns">';
    while ( $loop->have_posts() ) : $loop->the_post();
    wc_get_template_part( 'content-list', 'product' );
    endwhile;
	echo '</div>';
    woocommerce_product_loop_end();
    woocommerce_reset_loop();
    wp_reset_postdata();


}




#purchsed items in my account

add_filter ( 'woocommerce_account_menu_items', 'misha_purchased_products_link', 40 );
add_action( 'init', 'misha_add_products_endpoint' );
add_action( 'woocommerce_account_purchased-products_endpoint', 'misha_populate_products_page' );

// here we hook the My Account menu links and add our custom one
function misha_purchased_products_link( $menu_links ){

	// we use array_slice() because we want our link to be on the 3rd position
	return array_slice( $menu_links, 0, 2, true )
	+ array( 'purchased-products' => 'دوره های خریداری شده' )
	+ array_slice( $menu_links, 2, NULL, true );

}

// here we register our rewrite rule
function misha_add_products_endpoint() {
	add_rewrite_endpoint( 'purchased-products', EP_PAGES );
}

// here we populate the new page with the content
function misha_populate_products_page() {

	global $wpdb;

	// this SQL query allows to get all the products purchased by the current user
	// in this example we sort products by date but you can reorder them another way
	$purchased_products_ids = $wpdb->get_col( $wpdb->prepare(
		"
		SELECT      itemmeta.meta_value
		FROM        " . $wpdb->prefix . "woocommerce_order_itemmeta itemmeta
		INNER JOIN  " . $wpdb->prefix . "woocommerce_order_items items
		            ON itemmeta.order_item_id = items.order_item_id
		INNER JOIN  $wpdb->posts orders
		            ON orders.ID = items.order_id
		INNER JOIN  $wpdb->postmeta ordermeta
		            ON orders.ID = ordermeta.post_id
		WHERE       itemmeta.meta_key = '_product_id'
		            AND ordermeta.meta_key = '_customer_user'
		            AND ordermeta.meta_value = %s
		ORDER BY    orders.post_date DESC
		",
		get_current_user_id()
	) );

	// some orders may contain the same product, but we do not need it twice
	$purchased_products_ids = array_unique( $purchased_products_ids );

	// if the customer purchased something
	if( !empty( $purchased_products_ids ) ) :

		echo do_shortcode('[my_products]');


	else:
		echo 'هنوز دوره ای خریداری نشده است.';
	endif;

}

function woo_mini_wallet_callback() {
    if (!function_exists('woo_wallet') || !is_user_logged_in()) {
        return '';
    }
    ob_start();
    $title = __('Current wallet balance', 'woo-wallet');
    $mini_wallet = '<a class="woo-wallet-menu-contents" href="' . esc_url(wc_get_account_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'))) . '" title="' . $title . '">';
    $mini_wallet .= woo_wallet()->wallet->get_wallet_balance(get_current_user_id());
    $mini_wallet .= '</a>';
    echo $mini_wallet;
    return ob_get_clean();
}
add_shortcode('woo-mini-wallet', 'woo_mini_wallet_callback');


//notifications
// Register Custom Post Type
function Notifications() {

	$labels = array(
		'name'                  => _x( 'اطلاعیه ها', 'Post Type General Name', 'Notifications' ),
		'singular_name'         => _x( 'اطلاعیه ها', 'Post Type Singular Name', 'Notifications' ),
		'menu_name'             => __( 'اطلاعیه ها', 'Notifications' ),
		'name_admin_bar'        => __( 'اطلاعیه ها', 'Notifications' ),
		'archives'              => __( 'Item Archives', 'Notifications' ),
		'attributes'            => __( 'Item Attributes', 'Notifications' ),
		'parent_item_colon'     => __( 'Parent Item:', 'Notifications' ),
		'all_items'             => __( 'همه اطلاعیه ها', 'Notifications' ),
		'add_new_item'          => __( 'افزودن اطلاعیه جدید', 'Notifications' ),
		'add_new'               => __( 'افزودن', 'Notifications' ),
		'new_item'              => __( 'آیتم جدید', 'Notifications' ),
		'edit_item'             => __( 'ویرایش', 'Notifications' ),
		'update_item'           => __( 'بروزرسانی', 'Notifications' ),
		'view_item'             => __( 'نمایش', 'Notifications' ),
		'view_items'            => __( 'View Items', 'Notifications' ),
		'search_items'          => __( 'Search Item', 'Notifications' ),
		'not_found'             => __( 'Not found', 'Notifications' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'Notifications' ),
		'featured_image'        => __( 'Featured Image', 'Notifications' ),
		'set_featured_image'    => __( 'Set featured image', 'Notifications' ),
		'remove_featured_image' => __( 'Remove featured image', 'Notifications' ),
		'use_featured_image'    => __( 'Use as featured image', 'Notifications' ),
		'insert_into_item'      => __( 'Insert into item', 'Notifications' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'Notifications' ),
		'items_list'            => __( 'Items list', 'Notifications' ),
		'items_list_navigation' => __( 'Items list navigation', 'Notifications' ),
		'filter_items_list'     => __( 'Filter items list', 'Notifications' ),
	);
	$args = array(
		'label'                 => __( 'اطلاعیه ها', 'Notifications' ),
		'description'           => __( 'Post Type Description', 'Notifications' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 29,
			'menu_icon'           => 'dashicons-editor-kitchensink',
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
			'capability_type'     => 'page',
	);
	register_post_type( 'Notifications', $args );

}
add_action( 'init', 'Notifications', 0 );

function rm_post_view_count(){
	if ( is_single() ){
		global $post;
		$count_post = esc_attr( get_post_meta( $post->ID, '_post_views_count', true) );
		if( $count_post == ''){
			$count_post = 1;
			add_post_meta( $post->ID, '_post_views_count', $count_post);
		}else{
			$count_post = (int)$count_post + 1;
			update_post_meta( $post->ID, '_post_views_count', $count_post);
		}
	}
}
add_action('wp_head', 'rm_post_view_count');


if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
/*
 * کد افزودن لیست علاقه مندی به پیشخوان مشتریان
 */
add_filter ( 'woocommerce_account_menu_items', 'misha_log_history_link', 40 );
function misha_log_history_link( $menu_links ){

	$menu_links = array_slice( $menu_links, 0, 3, true )
	+ array( 'mywishlist' => 'علاقه مندی ها' )
	+ array_slice( $menu_links, 3, NULL, true );

	return $menu_links;

}
/*
 * Step 2. Register Permalink Endpoint
 */
add_action( 'init', 'misha_add_endpoint' );
function misha_add_endpoint() {

	// WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
	add_rewrite_endpoint( 'mywishlist', EP_PAGES );
}
/*
 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
 */
add_action( 'woocommerce_account_mywishlist_endpoint', 'misha_my_account_endpoint_content' );
function misha_my_account_endpoint_content() {

	// of course you can print dynamic content here, one of the most useful functions here is get_current_user_id()
	echo do_shortcode('[yith_wcwl_wishlist]');

}

}



// get video address ajax

function get_video_ajax(){

	$post_id=$_POST['post_id'];
	$url=$_POST['url'];
	if(empty($post_id)){
		echo $url;
	}else{
	 echo $course_video = get_post_meta($post_id, '_studiare_course_video', true);
	}
	wp_die();
}

add_action('wp_ajax_get_video_ajax', 'get_video_ajax');
add_action('wp_ajax_nopriv_get_video_ajax', 'get_video_ajax');



// Get Lesson Video Address Ajax

function get_lesson_video_ajax(){

	$post_id=$_POST['post_id'];
	$url=$_POST['url'];
	if(empty($post_id)){
		echo $url;
	}else{
	 echo $preview_video;
	}
	wp_die();
}

add_action('wp_ajax_get_lesson_video_ajax', 'get_lesson_video_ajax');
add_action('wp_ajax_nopriv_get_lesson_video_ajax', 'get_lesson_video_ajax');





///ham3da ///
if (defined('HTQ_SLUG'))
{
    add_action('woocommerce_save_account_details', 'save_extra_user_profile_fields', 10, 1);
}

function htq_theme_slug_widgets_init2()
{
    register_sidebar(array(
        'name'          => __('Quiz Maker Sidebar', 'htq'),
        'id'            => 'quiz_maker_sidebar_2',
        'description'   => __('Widgets in this area will be shown on tests.', 'htq'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
}
add_action('widgets_init', 'htq_theme_slug_widgets_init2');

add_action('wp_enqueue_scripts', function()
{
    wp_deregister_style( 'font-awesome-css-5' );
});


///ham3da ///

add_action( 'woocommerce_order_status_changed', 'update_product_total_sales_on_cancelled_orders', 10, 4 );
function update_product_total_sales_on_cancelled_orders( $order_id, $old_status, $new_status, $order ){
    if ( in_array( $old_status, array('processing', 'completed') ) && 'cancelled' === $new_status
    && ! $order->get_meta('_order_is_canceled') ) {

        // Loop through order items
        foreach ( $order->get_items() as $item ) {
            // Get the WC_product object (and for product variation, the parent variable product)
            $product = $item->get_variation_id() > 0 ? wc_get_product( $item->get_product_id() ) : $item->get_product();

            $total_sales   = (int) $product->get_total_sales(); // get product total sales
            $item_quantity = (int) $item->get_quantity(); // Get order item quantity

            $product->set_total_sales( $total_sales - $item_quantity ); // Decrease product total sales
            $product->save(); // save to database
        }
        $order->update_meta_data('_order_is_canceled', '1'); // Flag the order as been cancelled to avoid repetitions
        $order->save(); // save to database
    }
}

add_action( 'woocommerce_order_status_changed', 'update_product_total_sales_on_cancelled_orders_2', 10, 4 );
function update_product_total_sales_on_cancelled_orders_2( $order_id, $old_status, $new_status, $order ){
    if ( in_array( $old_status, array('processing', 'completed') ) && 'refunded' === $new_status
    && ! $order->get_meta('_order_is_refunded') ) {

        // Loop through order items
        foreach ( $order->get_items() as $item ) {
            // Get the WC_product object (and for product variation, the parent variable product)
            $product = $item->get_variation_id() > 0 ? wc_get_product( $item->get_product_id() ) : $item->get_product();

            $total_sales   = (int) $product->get_total_sales(); // get product total sales
            $item_quantity = (int) $item->get_quantity(); // Get order item quantity

            $product->set_total_sales( $total_sales - $item_quantity ); // Decrease product total sales
            $product->save(); // save to database
        }
        $order->update_meta_data('_order_is_refunded', '1'); // Flag the order as been cancelled to avoid repetitions
        $order->save(); // save to database
    }
}
