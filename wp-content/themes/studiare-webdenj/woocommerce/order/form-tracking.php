<?php
/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $post;
?>
<div class="tracking-order">


<div class="col-md-6 tracking-space">
<h2 class="tracking-title">فرم اعتبار سنجی مدرک دانشجویان</h2>
<p>برای پیگیری مدرک دانشجویان می توانید از فرم زیر استفاده کنید. داشتن شناسه مدرک و ایمیلی که دانشجو با آن در دوره ثبت نام کرده الزامی می باشد.</p>
</div>
<div class="col-md-6 tracking-content">
<div class="text-center">
<img class="tracking-image" src="<?php bloginfo('template_url'); ?>/assets/images/certificate.svg">
</div>
<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

	<p class="form-row form-row-first"><label for="orderid"><?php esc_html_e( 'شناسه مدرک', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" value="<?php echo isset( $_REQUEST['orderid'] ) ? esc_attr( wp_unslash( $_REQUEST['orderid'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'شناسه مدرک را وارد کنید.', 'woocommerce' ); ?>" /></p><?php // @codingStandardsIgnoreLine ?>
	<p class="form-row form-row-last"><label for="order_email"><?php esc_html_e( 'ایمیل دانشجو', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" value="<?php echo isset( $_REQUEST['order_email'] ) ? esc_attr( wp_unslash( $_REQUEST['order_email'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'ایمیلی که با آن در دوره ثبت نام شده است وارد کنید', 'woocommerce' ); ?>" /></p><?php // @codingStandardsIgnoreLine ?>
	<div class="clear"></div>

	<p class="form-row text-center"><button type="submit" class="button tracking-button" name="track" value="<?php esc_attr_e( 'اعتبار سنجی مدرک', 'woocommerce' ); ?>"><?php esc_html_e( 'اعتبار سنجی مدرک', 'woocommerce' ); ?></button></p>
	<?php wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' ); ?>

</form>

</div>

</div>
