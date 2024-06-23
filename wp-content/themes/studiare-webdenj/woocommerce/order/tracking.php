<?php
/**
 * Order tracking
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/tracking.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();
?>

<div class="tracking-order">
<div class="col-md-6">
<h2 class="tracking-title"> مورد تائید می باشد! </h2>

<?php
do_action( 'woocommerce_order_details_before_order_table_items', $order );

foreach ( $order_items as $item_id => $item ) {
	$product = $item->get_product();

	wc_get_template( 'order/order-details-item.php', array(
		'order'			     => $order,
		'item_id'		     => $item_id,
		'item'			     => $item,
		'show_purchase_note' => $show_purchase_note,
		'purchase_note'	     => $product ? $product->get_purchase_note() : '',
		'product'	         => $product,
	) );
}


?>

</div>
<div class="col-md-6">
<div class="text-center">
<?php
$customer = get_userdata($order->customer_user);
echo get_avatar( $customer->user_email, 100 );
?>
<p>
<?php
echo '<span>نام دانشجو: </span>';
echo '<span>' .$customer->first_name. ' </span>';
echo '<span>' .$customer->last_name. '</span>';
?>
</p>
</div>




<p class="order-info"><?php
	/* translators: 1: order number 2: order date 3: order status */
	echo wp_kses_post( apply_filters( 'woocommerce_order_tracking_status', sprintf(
		__( 'مدرک به شناسه: %1$s ، صادر شده در تاریخ %2$s مورد تائید می باشد.', 'woocommerce' ),
		'<mark class="order-number">' . $order->get_order_number() . '</mark>',
		'<mark class="order-date">' . wc_format_datetime( $order->get_date_created() ) . '</mark>',
		'<mark class="order-status">' . wc_get_order_status_name( $order->get_status() ) . '</mark>'
	) ) );
?></p>

</div>



</div>
