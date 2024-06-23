<?php
/**
 * Downloads
 *
 * Shows downloads on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/downloads.php.
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
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$woo_downloads     = WC()->customer->get_downloadable_products();
$has_downloads = (bool) $woo_downloads;

if( $has_downloads ) {
	$downloads = array();
	foreach ($woo_downloads as $download) {
		$downloads[$download['product_id']][$download['order_id']][] = $download;
	}
}

do_action( 'woocommerce_before_account_downloads', $has_downloads ); ?>

<?php if ( $has_downloads ) : ?>

	<?php do_action( 'woocommerce_before_available_downloads' ); ?>
	<ul class="wcdlar_download_list">
		<?php foreach( $downloads as $product_id => $orders_download ): ?>
			<li>
				<a href="#" class="title"><?php echo get_the_title($product_id) ?> <span class="arrow"></span></a>
                <div class="sub_items">
	                <?php foreach($orders_download  as $order_id => $download_items ): ?>
                        <ul class="wcdlar_order_wrapper">

			                <?php if( !empty($download_items) ): ?>
                                <table>
                                    <thead>
                                    <tr>
                                        <th><?php _e('File', 'woocommerce'); ?></th>
                                        <th><?php _e('Downloads remaining', 'woocommerce'); ?></th>
                                        <th><?php _e('Expires', 'woocommerce'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
					                <?php foreach($download_items  as $key => $download ): ?>
                                        <tr>
                                            <td><a href="<?php echo esc_url( $download['download_url'] ); ?>" class="download-btns"><i class="fal fa-download"></i><?php echo $download['file']['name'] ?></a></td>
                                            <td><?php echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : __( '&infin;', 'woocommerce' ); ?></td>
                                            <td>
								                <?php if ( ! empty( $download['access_expires'] ) ) : ?>
                                                    <time datetime="<?php echo date( 'Y-m-d', strtotime( $download['access_expires'] ) ); ?>" title="<?php echo esc_attr( strtotime( $download['access_expires'] ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ); ?></time>
								                <?php else : ?>
									                <?php _e( 'Never', 'woocommerce' ); ?>
								                <?php endif; ?>
                                            </td>
                                        </tr>
					                <?php endforeach; ?>
                                    </tbody>
                                </table>
			                <?php endif; ?>
                        </ul>
	                <?php endforeach; ?>
                </div>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php do_action( 'woocommerce_after_available_downloads' ); ?>
<?php else : ?>
	<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php esc_html_e( 'Go shopping', 'woocommerce' ) ?>
		</a>
		<?php esc_html_e( 'No downloads available yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_downloads', $has_downloads ); ?>
